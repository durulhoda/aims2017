<?php
/**
 * Created by PhpStorm.
 * User: Adventure-Soft
 * Date: 10/6/18
 * Time: 5:52 PM
 */

class SetSummaryPercentage extends MY_Controller{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $data['add_per'] = 'active';
        $data['result_home'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/set_summary_percentage/select_class'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link

    }

    public function percentagelist()
    {
        $this->db->select('set_percentage.*,semester.semester');
        $this->db->from('set_percentage');
        $this->db->join('semester','semester.semesterId = set_percentage.semester_id','INNER');
        $data['results']=$this->db->get()->result_array();
        foreach($data['results'] as $item)
        {
            $data['exam'][$item['program_offer_id']]['semester'][]=$item['semester'];
            $data['exam'][$item['program_offer_id']]['percentage_value'][]=$item['percentage_value'];
        }
        $data['result'] = 'active';
        $data['result_home'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/set_summary_percentage/list',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
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

    public function exam_list()
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
            $check=$this->db->get()->result_array();
            if($check)
            {
                $data['add_per'] = 'active';
                $data['result_home'] = 'active';
                $sdata['errormessage'] = "Set Already";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/SetSummaryPercentage", "refresh");
            }

            $this->db->select('marksheet_mst.semester_id,semester.semester');
            $this->db->from('marksheet_mst');
            $this->db->join('semester','semester.semesterId=marksheet_mst.semester_id','INNER');
            $this->db->where('marksheet_mst.program_offer_id',$data['programOfferId']['programOfferId']);
            $this->db->group_by('marksheet_mst.semester_id');
            $data['exam_list']=$this->db->get()->result_array();
            $count = count($data['exam_list']);
            if($count>1)
            {
                $data['result'] = 'active';
                $data['result_home'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/set_summary_percentage/set_percentage',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }
            else
            {
                $data['add_per'] = 'active';
                $data['result_home'] = 'active';
                $sdata['errormessage'] = "Minimum two semester result need to published !!";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/SetSummaryPercentage", "refresh");
            }
        }
        else
        {
            $data['add_per'] = 'active';
            $data['result_home'] = 'active';
            $sdata['errormessage'] = "Please fill all the fields";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/SetSummaryPercentage", "refresh");
        }
    }

    public function editpercentage($id)
    {
        $data['programOfferId'] = $id;
        $this->db->select('set_percentage.*,semester.semester');
        $this->db->from('set_percentage');
        $this->db->join('semester','semester.semesterId = set_percentage.semester_id','INNER');
        $this->db->where('set_percentage.program_offer_id',$id);
        $results=$this->db->get()->result_array();
        foreach($results as $result)
        {
            $data['percentage'][$result['semester_id']] = $result['percentage_value'];
        }

        $this->db->select('marksheet_mst.semester_id,semester.semester');
        $this->db->from('marksheet_mst');
        $this->db->join('semester','semester.semesterId=marksheet_mst.semester_id','INNER');
        $this->db->where('marksheet_mst.program_offer_id',$id);
        $this->db->group_by('marksheet_mst.semester_id');
        $data['exam_list']=$this->db->get()->result_array();

        $data['result_home'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/set_summary_percentage/edit_percentage',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link

    }

    public function update_percentage()
    {
        $semester = $this->input->post('semester', TRUE);
        $program_offer_id = $this->input->post('programOfferId', TRUE);
        $this->db->select('set_percentage.*');
        $this->db->from('set_percentage');
        $this->db->where('set_percentage.program_offer_id',$program_offer_id);
        $results=$this->db->get()->result_array();
        $sum=0;
        foreach($semester as $s)
        {
            $sum=$sum+$s;
        }
        if($sum!=100)
        {
            $data['result_home'] = 'active';
            $sdata['errormessage'] = "Total Percentage Value must be Hundred";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/SetSummaryPercentage/editpercentage/$program_offer_id", "refresh");
        }
        foreach($results as $result)
        {
            $old_semesters[]=$result['semester_id'];
        }
        foreach($semester as $index=>$value)
        {
            if(in_array($index,$old_semesters))
            {
                $this->db->set('percentage_value',$value);
                $this->db->update('set_percentage');
                $this->db->where('program_offer_id',$program_offer_id);
                $this->db->where('semester_id',$index);
            }
            else
            {
                $new_array=array();
                $new_array['program_offer_id']=$program_offer_id;
                $new_array['semester_id']=$index;
                $new_array['percentage_value']=$value;
                $this->db->insert('set_percentage',$new_array);
            }
        }
        $data['result_home'] = 'active';
        $sdata['message'] = "Successfully Updated";
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/SetSummaryPercentage/percentagelist", "refresh");
    }

    public function deletepercentage($id)
    {
        $this->db->where('program_offer_id',$id);
        $delete=$this->db->delete('set_percentage');
        if($delete)
        {
            $data['result'] = 'active';
            $data['result_home'] = 'active';
            $sdata['message'] = "Successfully Deleted";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/SetSummaryPercentage/percentagelist", "refresh");
        }
        else
        {
            $data['result'] = 'active';
            $data['result_home'] = 'active';
            $sdata['errormessage'] = "Failed to Delete";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/SetSummaryPercentage/percentagelist", "refresh");
        }
    }


    public function insert_percentage()
    {
        $programOfferId=$this->input->post('programOfferId');
        $semester=$this->input->post('semester');
        $sum=0;
        foreach($semester as $s)
        {
            $sum=$sum+$s;
        }
        if($sum!=100)
        {
            $data['add_per'] = 'active';
            $data['result_home'] = 'active';
            $sdata['errormessage'] = "Total Percentage Must be Hundred";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/SetSummaryPercentage", "refresh");
        }

        foreach($semester as $index=>$value)
        {
            $new_array=array();
            $new_array['program_offer_id']=$programOfferId;
            $new_array['semester_id']=$index;
            $new_array['percentage_value']=$value;
            $this->db->insert('set_percentage',$new_array);
        }
        $sdata['message'] = "Successfully Inserted";
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/SetSummaryPercentage/percentagelist", "refresh");
    }

} 