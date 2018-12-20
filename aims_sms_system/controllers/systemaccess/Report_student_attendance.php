<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Adventure-Soft
 * Date: 10/17/18
 * Time: 12:39 PM
 */

class Report_student_attendance extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->my_admin();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');
    }

    public function index()
    {
        $data['report_employee'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/report_student_attendance/search'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function search_attendance()
    {
        $time=time();
        $data['fromDate']=$this->input->post('from_date');
        $data['toDate']=$this->input->post('to_date');
        if(!$data['fromDate'])
        {
            $data['fromDate']=date("Y-m-d",$time);
        }
        if(!$data['toDate'])
        {
            $data['toDate']=date("Y-m-d",$time);
        }
        $data['fromDate1'] = $data['fromDate'];
        $data['fromDate_int'] = strtotime($data['fromDate']);
        $data['toDate1'] = $data['toDate'];
        $data['toDate_int'] = strtotime($data['toDate'])+86399;

        $data['studentId'] = '';
        $data['status'] = '';
        $this->db->select('GROUP_CONCAT(programoffer.programOfferId) as program_offer_ids,programoffer.programId,program.programName');
        $this->db->from('programoffer');
        $this->db->join('program','program.programId=programoffer.programId','INNER');
        $this->db->where('programoffer.classStatus',1);
        $this->db->group_by('programoffer.programId');
        $program_offers = $this->db->get()->result_array();

        $this->db->select('programOfferId');
        $this->db->from('programoffer');
        $this->db->where('classStatus',1);
        $results=$this->db->get()->result_array();
        foreach($results as $result)
        {
            $data['programOfferId'][]=$result['programOfferId'];
        }
        foreach($program_offers as $item)
        {
            $programs[$item['programId']]=explode(',',$item['program_offer_ids']);
            $data['programs'][$item['programId']]=$item['programName'];
        }
        //all student attendance list
        $student_list = $this->StudentattendanceModleAdmin->get_student_attendance_from_both_table($data);
        $attendance=array();
        if(isset($student_list['manual']))
        {
            foreach ($student_list['manual'] as $sl) {
                $attendance[$sl['attendanceDate']][$sl['programOfferId']][$sl['studentId']] = 'Present';
            }
        }
        if(isset($student_list['machine']))
        {
            foreach ($student_list['machine'] as $sl) {
                $attendance[$sl['attendanceDate']][$sl['programOfferId']][$sl['studentId']] = 'Present';
            }
        }

        // Start Date Range
        $period = new DatePeriod(new DateTime($data['fromDate']), new DateInterval('P1D'), new DateTime("$data[toDate] +1 day"));
        foreach ($period as $date)
        {
            $data['dates'][] = $date->format("Y-m-d");
        }
        // End Date Range
        $count_attendance=array();
        foreach($data['dates'] as $dt)
        {
            foreach($data['programOfferId'] as $p)
            {
                if(!isset($attendance[$dt][$p]))
                {
                    $attendance[$dt][$p]=array();
                }
                $count_attendance[$dt][$p]=count($attendance[$dt][$p]);
            }
        }
        foreach($data['dates'] as $dt)
        {
            foreach($programs as $index=>$program_values)
            {
                $data['program_attendance'][$dt][$index]=0;
            }
        }
        foreach($count_attendance as $dt=>$item)
        {
            foreach($item as $p_offer=>$value)
            {
                foreach($programs as $index=>$program_values)
                {
                    if(in_array($p_offer,$program_values))
                    {
                        $data['program_attendance'][$dt][$index]=$data['program_attendance'][$dt][$index]+$value;
                    }
                }
            }
        }

        $data['program_student']=array();
        $this->db->select('COUNT(studentId) as total_student,programOfferId');
        $this->db->from('student');
        $this->db->group_by('programOfferId');
        $results=$this->db->get()->result_array();
        foreach($results as $result)
        {
            $data['program_student'][$result['programOfferId']]=$result['total_student'];
        }

        foreach($data['program_student'] as $program_student)
        {
            foreach($programs as $index=>$program_values)
            {
                $data['program_total_student'][$index]=0;
            }
        }
        foreach($data['program_student'] as $o_id=>$program_student)
        {
            foreach($programs as $index=>$program_values)
            {
                if(in_array($o_id,$program_values))
                {
                    $data['program_total_student'][$index]=$program_student+$data['program_total_student'][$index];
                }
            }
        }

        $data['all_class_attendance']=array();
        foreach($data['program_attendance'] as $dat=>$item_array)
        {
            foreach($item_array as $prgm=>$item)
            {
                $data['all_class_attendance'][$dat][$prgm]['number']=$item;
                $data['all_class_attendance'][$dat][$prgm]['total']=$data['program_total_student'][$prgm];
                $data['all_class_attendance'][$dat][$prgm]['rate']=number_format((($item/$data['program_total_student'][$prgm])*100),2);
            }
        }
        // Start School Calendar Information
        $this->db->select('*');
        $this->db->select('STR_TO_DATE(startdate,"%d-%m-%Y") as date');
        $this->db->from('calendar');
        $this->db->where('STR_TO_DATE(startdate,"%d-%m-%Y") >=', $data['fromDate']);
        $this->db->where('STR_TO_DATE(startdate,"%d-%m-%Y") <=', $data['toDate']);
        $calendar=$this->db->get()->result_array();
        $data['calendar']=array();
        foreach($calendar as $c)
        {
            $data['calendar'][$c['date']]=$c['color'];
        }
        // End School Calendar Information

        $data['report_employee'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/report_student_attendance/list'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
}