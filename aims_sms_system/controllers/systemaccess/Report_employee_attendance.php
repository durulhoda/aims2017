<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Adventure-Soft
 * Date: 10/17/18
 * Time: 12:39 PM
 */

class Report_employee_attendance extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->my_admin();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');

    }

    public function index()
    {
        $data['report_employee'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/report_employee_attendance/search'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function search_attendance()
    {
        $from_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        if(!$from_date)
        {
            $sdata['errormessage'] = 'From Date is required !!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/report_employee_attendance");
        }
        else
        {
            $from=strtotime($from_date);
            $datax['from_date'] = date("Y-m-d", $from);
            if(!$to_date)
            {
                $to = time();
                $to_date = date("d-m-Y", $to);
                $datax['to_date'] = date("Y-m-d", $to);
            }
            else
            {
                $to = strtotime($to_date);
                $datax['to_date'] = date("Y-m-d", $to);
            }
            if($from>$to)
            {
                $sdata['errormessage'] = 'To-Date should be greater than From-Date !!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/report_employee_attendance");
            }
            else
            {
                $data=array();
				$data['report_employee'] = 'active';
                $designations=getdesignation();

                $this->db->select('employee.*,department.departmentName');
                $this->db->from('employee');
                $this->db->join('department','department.departmentId=employee.departmentId','INNER');
                $this->db->where('employee.employeeStatus',1);
                $this->db->order_by('employee.positionNumber','ASC');
                $data['employees'] = $this->db->get()->result_array();

                foreach($data['employees'] as &$emp)
                {
                    $emp['designation_name']=$designations[$emp['designation']];
                }

                $period = new DatePeriod(new DateTime($from_date), new DateInterval('P1D'), new DateTime("$to_date +1 day"));
                foreach ($period as $date)
                {
                    $data['dates'][] = $date->format("Y-m-d");
                }

                $manual_attendance_list = $this->EmployeeModleAdmin->getEmployeeattendanceByDate($datax['from_date'],$datax['to_date'],null);
                $finger_attendance_list = $this->EmployeeModleAdmin->getEmployeefingerattendanceByDate($datax['from_date'],$datax['to_date'],null);

                foreach ($finger_attendance_list as $key => $value)
                {
                    $finger_attendance_list[$key]['in_time'] = date('H:i:s', $finger_attendance_list[$key]['in_time']);
                    $finger_attendance_list[$key]['out_time'] = date('H:i:s', $finger_attendance_list[$key]['out_time']);
                }

                foreach($data['dates'] as $dt)
                {
                    foreach($data['employees'] as $employee)
                    {
                        if($manual_attendance_list)
                        {
                            foreach($manual_attendance_list as $index=>$m_a_l)
                            {
                                if($manual_attendance_list[$index]['emp_id'] == $employee['employeeId'] && $manual_attendance_list[$index]['attendance_date'] == $dt)
                                {
                                    $data['attendance_list'][$dt][$employee['employeeId']] = $manual_attendance_list[$index];
                                }
                            }
                        }

                        if($finger_attendance_list)
                        {
                            foreach($finger_attendance_list as $key=>$f_a_l)
                            {
                                if($finger_attendance_list[$key]['emp_id'] == $employee['employeeId'] && $finger_attendance_list[$key]['attendance_date'] == $dt)
                                {
                                    $data['attendance_list'][$dt][$employee['employeeId']] = $finger_attendance_list[$key];
                                }
                            }
                        }
                    }
                }

                foreach($data['dates'] as $dt)
                {
                    foreach($data['employees'] as $employee)
                    {
                        if(isset($data['attendance_list'][$dt][$employee['employeeId']]))
                        {
                            if(isset($data['attendance_list'][$dt][$employee['employeeId']]['in_time']))
                            {
                                $data['attendance'][$dt][$employee['employeeId']]['in_time'] = $data['attendance_list'][$dt][$employee['employeeId']]['in_time'];
                                $data['attendance'][$dt][$employee['employeeId']]['out_time'] = $data['attendance_list'][$dt][$employee['employeeId']]['out_time'];
                                $data['attendance'][$dt][$employee['employeeId']]['hour'] = gmdate("H:i:s", $data['attendance_list'][$dt][$employee['employeeId']]['seconds']);
                            }
                            else
                            {
                                $data['attendance'][$dt][$employee['employeeId']]['in_time'] = '00:00:00';
                                $data['attendance'][$dt][$employee['employeeId']]['out_time'] = '00:00:00';
                                $data['attendance'][$dt][$employee['employeeId']]['hour'] = '00:00:00';
                            }
                        }
                        else
                        {
                            $data['attendance'][$dt][$employee['employeeId']]['in_time'] = '-';
                            $data['attendance'][$dt][$employee['employeeId']]['out_time'] = '-';
                            $data['attendance'][$dt][$employee['employeeId']]['hour'] = '-';
                        }
                    }
                }

                $this->db->select('*');
                $this->db->select('STR_TO_DATE(startdate,"%d-%m-%Y") as date');
                $this->db->from('calendar');
                $this->db->where('STR_TO_DATE(startdate,"%d-%m-%Y") >=', $datax['from_date']);
                $this->db->where('STR_TO_DATE(startdate,"%d-%m-%Y") <=', $datax['to_date']);
                $calendar=$this->db->get()->result_array();

                $data['calendar']=array();
                foreach($calendar as $c)
                {
                    $data['calendar'][$c['date']]=$c['color'];
                }

//                echo '<pre>';
//                print_r($data['employees']);exit;
//                print_r($data['calendar']);exit;

                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/report_employee_attendance/list', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }
        }
    }

} 