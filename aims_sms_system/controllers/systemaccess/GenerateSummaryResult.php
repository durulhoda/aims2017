<?php
/**
 * Created by PhpStorm.
 * User: Adventure-Soft
 * Date: 10/6/18
 * Time: 5:52 PM
 */

class GenerateSummaryResult extends MY_Controller{

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/result/Result_model_admin', 'rma');
    }

    public function index()
    {
        $data['generate'] = 'active';
        $data['result_home'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/generate_summary_result/generate_summery_result'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function generate_summary_result()
    {
        $data=array();
        $this->validation_check();
        if ($this->form_validation->run() == TRUE)
        {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);
            $this->db->select('*');
            $this->db->from('set_percentage');
            $this->db->where('program_offer_id',$data['programOfferId']['programOfferId']);
            $percentages=$this->db->get()->result_array();
            $program_offer_id=$data['programOfferId']['programOfferId'];
            if($percentages)
            {
                $this->db->select('*');
                $this->db->from('summary_result');
                $this->db->where('program_offer_id',$program_offer_id);
                $exist=$this->db->get()->row_array();
                if(!$exist)
                {
                    $this->db->trans_start();
                    foreach($percentages as $percent)
                    {
                        $percent_value[$percent['semester_id']]=$percent['percentage_value'];
                        $student_marks=array();
                        $this->db->select('master.student_id,details.*');
                        $this->db->from('marksheet_mst master');
                        $this->db->join('marksheet_dtls details','details.master_id=master.id','INNER');
                        $this->db->where('master.program_offer_id',$percent['program_offer_id']);
                        $this->db->where('master.semester_id',$percent['semester_id']);
                        $this->db->order_by('master.student_id','ASC');
                        $this->db->order_by('details.course_code','ASC');
                        $student_marks=$this->db->get()->result_array();
                        foreach($student_marks as $student)
                        {
                            $semester_marks[$student['student_id']][$student['semester_id']][$student['merge_id']][] = $student;
                        }
                    }
                    $number_of_semester=count($percent_value);
                    foreach($semester_marks as $student_id=>$s_marks)
                    {
                        $data['master_row']=array();
                        $temp_data=array();
                        $data['master_row']['student_id'] = $student_id;
                        $data['master_row']['program_offer_id'] = $program_offer_id;
                        $this->db->insert('summary_result',$data['master_row']);
                        $insert_id=$this->db->insert_id();
                        foreach($s_marks as $semester_id=>$marks)
                        {
                            foreach($marks as $merge_id=>$mark)
                            {
                                foreach($mark as $subject_mark)
                                {
                                    if($subject_mark['merge_id']==0)
                                    {
                                        $obtain_subject_marks[$subject_mark['course_code']]=0;
                                        $total_subject_marks[$subject_mark['course_code']]=0;
                                    }
                                    else
                                    {
                                        $obtain_subject_marks['m_'.$subject_mark['merge_id']]=0;
                                        $total_subject_marks['m_'.$subject_mark['merge_id']]=0;
                                    }
                                    $data['child_row']=array();
                                    $data['child_row']['master_id']=$insert_id;
                                    $data['child_row']['student_id']=$student_id;
                                    $data['child_row']['program_offer_id']=$program_offer_id;
                                    $data['child_row']['semester_id']=$semester_id;
                                    $data['child_row']['course_id']=$subject_mark['course_id'];
                                    $data['child_row']['course_code']=$subject_mark['course_code'];
                                    $data['child_row']['course_name']=$subject_mark['course_name'];
                                    $data['child_row']['obtain_mark']=((($subject_mark['total_mark']*100)/$subject_mark['full_mark'])*(($subject_mark['full_mark']*$percent_value[$semester_id])/100))/100;
                                    $data['child_row']['full_mark']=($subject_mark['full_mark']*$percent_value[$semester_id])/100;
                                    $data['child_row']['merge_id']=$subject_mark['merge_id'];
                                    $data['child_row']['merge_count']=$subject_mark['merge_count'];
                                    $data['child_row']['merge_course_name']=$subject_mark['merge_course_name'];
                                    $this->db->insert('summary_result_details',$data['child_row']);
                                    $temp_data[$student_id][$semester_id][$subject_mark['merge_id']][]=$data['child_row'];
                                }
                            }
                        }
                        foreach($temp_data as $std_id=>$student_data)
                        {
                            $total_marks[$std_id]=0;
                            $obtained_marks[$std_id]=0;
                            foreach($student_data as $sem_id=>$sem_data)
                            {
                                foreach($sem_data as $mrg_id=>$sub_data)
                                {
                                    if($mrg_id==0)
                                    {
                                        foreach($sub_data as $mark)
                                        {
                                            $obtain_subject_marks[$mark['course_code']]+=$mark['obtain_mark'];
                                            $total_subject_marks[$mark['course_code']]+=$mark['full_mark'];
                                            $total_marks[$std_id]+=$mark['full_mark'];
                                            $obtained_marks[$std_id]+=$mark['obtain_mark'];
                                        }
                                    }
                                    else
                                    {
                                        $sem_merge_obtain=0;
                                        $sem_merge_total=0;
                                        foreach($sub_data as $mark)
                                        {
                                            $sem_merge_obtain+=$mark['obtain_mark'];
                                            $sem_merge_total+=$mark['full_mark'];
                                        }
                                        $total_marks[$std_id]+=$sem_merge_total/2;
                                        $obtained_marks[$std_id]+=$sem_merge_obtain/2;
                                        $total_subject_marks['m_'.$mrg_id]+=$sem_merge_total/2;
                                        $obtain_subject_marks['m_'.$mrg_id]+=$sem_merge_obtain/2;
                                    }
                                }
                            }
                        }
                        $check_result[$student_id]['result_status']='Pass';
                        $check_result[$student_id]['number_of_failed_subject']=0;
                        foreach($obtain_subject_marks as $code=>$item)
                        {
                            if(!((($item*100)/$total_subject_marks[$code])>32))
                            {
                                $check_result[$student_id]['result_status']='Fail';
                                $check_result[$student_id]['number_of_failed_subject']+=1;
                            }
                        }
                    }
                    foreach($check_result as $s_id=>$result)
                    {
                        $data=array();
                        $data['total_marks']=$total_marks[$s_id];
                        $data['obtained_marks']=$obtained_marks[$s_id];
                        $data['number_of_failed_subject']=$result['number_of_failed_subject'];
                        $data['result_status']=$result['result_status'];
                        $data['number_of_semester']=$number_of_semester;
                        $this->db->where('program_offer_id', $program_offer_id);
                        $this->db->where('student_id', $s_id);
                        $this->db->update('summary_result', $data);
                    }
                    //position
                    $this->db->select('summary_result.student_id');
                    $this->db->select('studentinfo.firstName');
                    $this->db->from('summary_result');
                    $this->db->join('student','student.studentId=summary_result.student_id','INNER');
                    $this->db->join('studentinfo','studentinfo.applicationId=student.applicationId','INNER');
                    $this->db->where('summary_result.program_offer_id', $program_offer_id);
                    $this->db->order_by('summary_result.number_of_failed_subject','ASC');
                    $this->db->order_by('summary_result.obtained_marks','DESC');
                    $this->db->order_by('studentinfo.firstName','ASC');
                    $position_list=$this->db->get()->result_array();
                    foreach($position_list as $key=>$p_list)
                    {
                        $data=array();
                        $data['position']=$key+1;
                        $this->db->where('program_offer_id', $program_offer_id);
                        $this->db->where('student_id', $p_list['student_id']);
                        $this->db->update('summary_result', $data);
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        $data['generate'] = 'active';
                        $data['result_home'] = 'active';
                        $sdata['errormessage'] = "Something is wrong.. try again or contact with admin.";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/generatesummaryresult", "refresh");
                    }
                    else
                    {
                        $data['generate'] = 'active';
                        $data['result_home'] = 'active';
                        $sdata['message'] = "Generated Successfully";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/generatesummaryresult", "refresh");
                    }
                }
                else
                {
                    $data['generate'] = 'active';
                    $data['result_home'] = 'active';
                    $sdata['errormessage'] = "Summary result generated already for this section";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/generatesummaryresult", "refresh");
                }
            }
            else
            {
                $data['generate'] = 'active';
                $data['result_home'] = 'active';
                $sdata['errormessage'] = "Please set percentage to generate summary result";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/generatesummaryresult", "refresh");
            }
        }
        else
        {
            $data['generate'] = 'active';
            $data['result_home'] = 'active';
            $sdata['errormessage'] = "Please fill all the fields";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/generatesummaryresult", "refresh");
        }
    }
      public function generate_summary_resultsd()
    {
        $data=array();
        $this->validation_check();
        if ($this->form_validation->run() == TRUE)
        {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);
            // echo '<pre>';print_r($data['programOfferId']);exit;
            $this->db->select('*');
            $this->db->from('set_percentage');
            $this->db->where('program_offer_id',$data['programOfferId']['programOfferId']);
            $percentages=$this->db->get()->result_array();
            $program_offer_id=$data['programOfferId']['programOfferId'];
            $sessionId=$data['programOfferId']['sessionId'];
            $programLevel=$data['programOfferId']['programLevel'];
            $programId=$data['programOfferId']['programId'];
            $mediumId=$data['programOfferId']['mediumId'];
            $groupId=$data['programOfferId']['groupId'];
            $shiftId=$data['programOfferId']['shiftId'];
            $sectionId=$data['programOfferId']['sectionId'];
            // echo '<pre>';print_r($data['shiftId']);exit;
            if($percentages)
            {
                $this->db->select('*');
                $this->db->from('summary_resultsd');
                $this->db->where('program_offer_id',$program_offer_id);
                $exist=$this->db->get()->row_array();
                if(!$exist)
                {
                    $this->db->trans_start();
                    foreach($percentages as $percent)
                    {
                        $percent_value[$percent['semester_id']]=$percent['percentage_value'];
                        $student_marks=array();
                        $this->db->select('master.student_id,details.*');
                        $this->db->from('marksheet_mst master');
                        $this->db->join('marksheet_dtls details','details.master_id=master.id','INNER');
                        $this->db->where('master.program_offer_id',$percent['program_offer_id']);
                        $this->db->where('master.semester_id',$percent['semester_id']);
                        $this->db->order_by('master.student_id','ASC');
                        $this->db->order_by('details.course_code','ASC');
                        $student_marks=$this->db->get()->result_array();
                        foreach($student_marks as $student)
                        {
                            $semester_marks[$student['student_id']][$student['semester_id']][$student['merge_id']][] = $student;
                        }
                    }
                    $number_of_semester=count($percent_value);
                    foreach($semester_marks as $student_id=>$s_marks)
                    {
                        $data['master_row']=array();
                        $temp_data=array();
                        $data['master_row']['student_id'] = $student_id;
                        $data['master_row']['program_offer_id'] = $program_offer_id;
                        $data['master_row']['sessionId'] = $sessionId;
                        $data['master_row']['programLevel'] = $programLevel;
                        $data['master_row']['programId'] = $programId;
                        $data['master_row']['mediumId'] = $mediumId;
                        $data['master_row']['groupId'] = $groupId;
                        $data['master_row']['shiftId'] = $shiftId;
                        $data['master_row']['sectionId'] = $sectionId;
                        $this->db->insert('summary_resultsd',$data['master_row']);
                        $insert_id=$this->db->insert_id();
                        foreach($s_marks as $semester_id=>$marks)
                        {
                            foreach($marks as $merge_id=>$mark)
                            {
                                foreach($mark as $subject_mark)
                                {
                                    if($subject_mark['merge_id']==0)
                                    {
                                        $obtain_subject_marks[$subject_mark['course_code']]=0;
                                        $total_subject_marks[$subject_mark['course_code']]=0;
                                    }
                                    else
                                    {
                                        $obtain_subject_marks['m_'.$subject_mark['merge_id']]=0;
                                        $total_subject_marks['m_'.$subject_mark['merge_id']]=0;
                                    }
                                    $data['child_row']=array();
                                    $data['child_row']['program_offer_id']=$program_offer_id;
                                    $data['child_row']['sessionId'] = $sessionId;
                                    $data['child_row']['programLevel'] = $programLevel;
                                    $data['child_row']['programId'] = $programId;
                                    $data['child_row']['mediumId'] = $mediumId;
                                    $data['child_row']['groupId'] = $groupId;
                                    $data['child_row']['shiftId'] = $shiftId;
                                    $data['child_row']['sectionId'] = $sectionId;
                                    $data['child_row']['master_id']=$insert_id;
                                    $data['child_row']['student_id']=$student_id;
                                    $data['child_row']['semester_id']=$semester_id;
                                    $data['child_row']['course_id']=$subject_mark['course_id'];
                                    $data['child_row']['course_code']=$subject_mark['course_code'];
                                    $data['child_row']['course_name']=$subject_mark['course_name'];
                                    $data['child_row']['obtain_mark']=((($subject_mark['total_mark']*100)/$subject_mark['full_mark'])*(($subject_mark['full_mark']*$percent_value[$semester_id])/100))/100;
                                    $data['child_row']['full_mark']=($subject_mark['full_mark']*$percent_value[$semester_id])/100;
                                    $data['child_row']['merge_id']=$subject_mark['merge_id'];
                                    $data['child_row']['merge_count']=$subject_mark['merge_count'];
                                    $data['child_row']['merge_course_name']=$subject_mark['merge_course_name'];
                                    $this->db->insert('summary_result_detailssd',$data['child_row']);
                                    $temp_data[$student_id][$semester_id][$subject_mark['merge_id']][]=$data['child_row'];
                                }
                            }
                        }
                        foreach($temp_data as $std_id=>$student_data)
                        {
                            $total_marks[$std_id]=0;
                            $obtained_marks[$std_id]=0;
                            foreach($student_data as $sem_id=>$sem_data)
                            {
                                foreach($sem_data as $mrg_id=>$sub_data)
                                {
                                    if($mrg_id==0)
                                    {
                                        foreach($sub_data as $mark)
                                        {
                                            $obtain_subject_marks[$mark['course_code']]+=$mark['obtain_mark'];
                                            $total_subject_marks[$mark['course_code']]+=$mark['full_mark'];
                                            $total_marks[$std_id]+=$mark['full_mark'];
                                            $obtained_marks[$std_id]+=$mark['obtain_mark'];
                                        }
                                    }
                                    else
                                    {
                                        $sem_merge_obtain=0;
                                        $sem_merge_total=0;
                                        foreach($sub_data as $mark)
                                        {
                                            $sem_merge_obtain+=$mark['obtain_mark'];
                                            $sem_merge_total+=$mark['full_mark'];
                                        }
                                        $total_marks[$std_id]+=$sem_merge_total/2;
                                        $obtained_marks[$std_id]+=$sem_merge_obtain/2;
                                        $total_subject_marks['m_'.$mrg_id]+=$sem_merge_total/2;
                                        $obtain_subject_marks['m_'.$mrg_id]+=$sem_merge_obtain/2;
                                    }
                                }
                            }
                        }
                        $check_result[$student_id]['result_status']='Pass';
                        $check_result[$student_id]['number_of_failed_subject']=0;
                        foreach($obtain_subject_marks as $code=>$item)
                        {
                            if(!((($item*100)/$total_subject_marks[$code])>32))
                            {
                                $check_result[$student_id]['result_status']='Fail';
                                $check_result[$student_id]['number_of_failed_subject']+=1;
                            }
                        }
                    }
                    foreach($check_result as $s_id=>$result)
                    {
                        $data=array();
                        $data['total_marks']=$total_marks[$s_id];
                        $data['obtained_marks']=$obtained_marks[$s_id];
                        $data['number_of_failed_subject']=$result['number_of_failed_subject'];
                        $data['result_status']=$result['result_status'];
                        $data['number_of_semester']=$number_of_semester;
                        $this->db->where('program_offer_id', $program_offer_id);
                        $this->db->where('student_id', $s_id);
                        $this->db->update('summary_resultsd', $data);
                    }
                    //position
                    $this->db->select('summary_resultsd.student_id');
                    $this->db->select('studentinfo.firstName');
                    $this->db->from('summary_resultsd');
                    $this->db->join('student','student.studentId=summary_resultsd.student_id','INNER');
                    $this->db->join('studentinfo','studentinfo.applicationId=student.applicationId','INNER');
                    $this->db->where('summary_resultsd.program_offer_id', $program_offer_id);
                    $this->db->order_by('summary_resultsd.number_of_failed_subject','ASC');
                    $this->db->order_by('summary_resultsd.obtained_marks','DESC');
                    $this->db->order_by('studentinfo.firstName','ASC');
                    $position_list=$this->db->get()->result_array();
                    foreach($position_list as $key=>$p_list)
                    {
                        $data=array();
                        $data['position']=$key+1;
                        $this->db->where('program_offer_id', $program_offer_id);
                        $this->db->where('student_id', $p_list['student_id']);
                        $this->db->update('summary_resultsd', $data);
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        $data['generate'] = 'active';
                        $data['result_home'] = 'active';
                        $sdata['errormessage'] = "Something is wrong.. try again or contact with admin.";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/generatesummaryresult", "refresh");
                    }
                    else
                    {
                        $data['generate'] = 'active';
                        $data['result_home'] = 'active';
                        $sdata['message'] = "Generated Successfully";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/generatesummaryresult", "refresh");
                    }
                }
                else
                {
                    $data['generate'] = 'active';
                    $data['result_home'] = 'active';
                    $sdata['errormessage'] = "Summary result generated already for this section";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/generatesummaryresult", "refresh");
                }
            }
            else
            {
                $data['generate'] = 'active';
                $data['result_home'] = 'active';
                $sdata['errormessage'] = "Please set percentage to generate summary result";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/generatesummaryresult", "refresh");
            }
        }
        else
        {
            $data['generate'] = 'active';
            $data['result_home'] = 'active';
            $sdata['errormessage'] = "Please fill all the fields";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/generatesummaryresult", "refresh");
        }
    }


    private function validation_check()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
    }
     private function validation_checksd()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
    }
    public function result_view()
    {
        $data['generate'] = 'active';
        $data['result_home'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/generate_summary_result/search_result'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery');
    }
    public function result_viewsd()
    {
        $data['generate'] = 'active';
        $data['result_home'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/generate_summary_result/search_resultsd'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery');
    }
    public function view_list()
    {
        $data=array();
        $this->validation_check();
        if ($this->form_validation->run() == TRUE)
        {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);
            if($data['programOfferId']['programOfferId'])
            {
                $program_offer_id=$data['programOfferId']['programOfferId'];
                $data['institute_info'] = $this->rma->getInstituteInfo();
                $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll($program_offer_id);
                $data['studentInfo'] = $this->ProgramModleAdmin->getStudentInfo($program_offer_id);

                $this->db->select('*');
                $this->db->from('summary_result');
                $this->db->where('program_offer_id',$program_offer_id);
                $this->db->order_by('position','ASC');
                $data['students']=$this->db->get()->result_array();
                if ($data['students']) {
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/generate_summary_result/position_list'); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata = array();
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/generatesummaryresult/result_view", "refresh");
                }

            }
            else
            {
                $sdata = array();
                $sdata['errormessage'] = "No Offer Id Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/generatesummaryresult/result_view", "refresh");
            }
        }
        else
        {
            $data['generate'] = 'active';
            $data['result_home'] = 'active';
            $sdata['errormessage'] = "Please fill all the fields";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/generatesummaryresult/result_view", "refresh");
        }
    }
     public function view_listsd()
        {
            $data=array();
            $this->validation_checksd();
            if ($this->form_validation->run() == TRUE)
            {
                $inputdata = $this->input->post('data', TRUE);
                // echo '<pre>';print_r($data);exit;
                $this->db->select('summary_resultsd.program_offer_id,summary_resultsd.sectionId');
                $this->db->from('summary_resultsd');
                $this->db->where('sessionId',$inputdata['sessionId']);
                $this->db->where('programId',$inputdata['programId']);
                $this->db->where('mediumId',$inputdata['mediumId']);
                $this->db->where('shiftId',$inputdata['shiftId']);
                $this->db->where('groupId',$inputdata['groupId']);
                $this->db->group_by('program_offer_id');
                $resultsd=$this->db->get()->result_array();
                if($resultsd!=null){
                    $data['institute_info'] = $this->rma->getInstituteInfo();
                    foreach ($resultsd as $x) {
                        $datasd=array();
                        $datasd['sessionId']=$inputdata['sessionId'];
                        $datasd['programId']=$inputdata['programId'];
                        $datasd['mediumId']=$inputdata['mediumId'];
                        $datasd['shiftId']=$inputdata['shiftId'];
                        $datasd['groupId']=$inputdata['groupId'];
                        $datasd['sectionId']=$x['sectionId'];
                        $data['programOfferId'] = getProgramOfferId($datasd);
                        $tempRolls=$this->StudentModleAdmin->getStudentRoll($data['programOfferId']['programOfferId']);
                        $tempstudentInfoList= $this->ProgramModleAdmin->getStudentInfo($data['programOfferId']['programOfferId']);
                        foreach ($tempRolls as $key => $y) {
                           $data['student_roll'][$key]=$y;
                        }
                        foreach ($tempstudentInfoList as $key => $y) {
                           $data['studentInfo'][$key]=$y;
                        }
                     }
                    $this->db->select('summary_resultsd.*,section.sectionName');
                    $this->db->from('summary_resultsd');
                    $this->db->join('programoffer', 'summary_resultsd.program_offer_id = programoffer.programOfferId');
                    $this->db->join('section', 'programoffer.sectionId= section.sectionId');
                    $this->db->where('summary_resultsd.sessionId',$inputdata['sessionId']);
                    $this->db->where('summary_resultsd.programId',$inputdata['programId']);
                    $this->db->where('summary_resultsd.mediumId',$inputdata['mediumId']);
                    $this->db->where('summary_resultsd.shiftId',$inputdata['shiftId']);
                    $this->db->where('summary_resultsd.groupId',$inputdata['groupId']);
                    $this->db->order_by('obtained_marks','DESC');
                    $data['students']=$this->db->get()->result_array();
                    // echo '<pre>';print_r($data['students']);exit;
                    if ($data['students']) {
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/generate_summary_result/position_listsd'); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    }else{
                         $sdata = array();
                        $sdata['errormessage'] = "No Result Found";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/generatesummaryresult/result_viewsd", "refresh");
                    }
                 }else{
                    $sdata = array();
                    $sdata['errormessage'] = "Result not Created yet";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/generatesummaryresult/result_viewsd", "refresh");
                 }
            }else{
                $data['generate'] = 'active';
                $data['result_home'] = 'active';
                $sdata['errormessage'] = "Please fill all the fields";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/generatesummaryresult/result_viewsd", "refresh");
            }
        }
    public function transcript_view()
    {
        $data=array();
        if($_GET)
        {
            $student_id = $_GET['student_id'];
            $program_offer_id = $_GET['program_offer_id'];

            $this->db->select('set_percentage.*,semester.semester');
            $this->db->from('set_percentage');
            $this->db->join('semester','semester.semesterId=set_percentage.semester_id','INNER');
            $this->db->where('set_percentage.program_offer_id',$program_offer_id);
            $data['percentages']=$this->db->get()->result_array();
            $data['no_of_semester']=count($data['percentages']);

            $this->db->select('*');
            $this->db->from('summary_result');
            $this->db->where('program_offer_id',$program_offer_id);
            $this->db->where('student_id',$student_id);
            $data['master']=$this->db->get()->row_array();
            // echo '<pre>';
            // print_r($data['master']);
            // exit;

            $this->db->select('*');
            $this->db->from('summary_result_details');
            $this->db->where('master_id',$data['master']['id']);
            $child_data=$this->db->get()->result_array();

            // echo '<pre>';
            // print_r($data['child']);
            // exit;
            $summary_result=array();
            foreach($child_data as $child_item)
            {
                $summary_result[$child_item['course_id']][$child_item['semester_id']]=$child_item;
            }
            // echo '<pre>';
            // print_r($summary_result);
            // exit;

            foreach($summary_result as $key=>$summary_item)
            {
                foreach($summary_item as $item_summary)
                {
                    echo '<pre>';
                    print_r($item_summary);
                    exit;
                }
            }

            // $student_marks=array();
            // foreach($data['child'] as $child_item)
            // {
            //     $student_marks[$child_item['student_id']][$child_item['semester_id']]=$child_item;
            // }
            // echo '<pre>';
            // print_r($student_marks);
            // exit;


            foreach($data['child'] as $item)
            {
                if($item['merge_id']==0)
                {
                    $data['student_marks'][$item['course_code']][]=$item;
                }
                if($item['merge_id']!=0)
                {
                    $data['student_marks'][$item['merge_id']][]=$item;
                }
            }
            //echo count($data['student_marks']);
            // echo '<pre>';
            // print_r($data['student_marks']);
            // exit;
            $data['institute_info'] = $this->rma->getInstituteInfo();
            $data['student_info'] = $this->rma->getStudentInfo($student_id);
            $data['roll_no'] = $this->rma->get_roll_no($student_id,$program_offer_id);
            $data['program_info'] = $this->rma->getProgramInfo($program_offer_id);

            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/generate_summary_result/summary_view', $data);// ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
    }
} 