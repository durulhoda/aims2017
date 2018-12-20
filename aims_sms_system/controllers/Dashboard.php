<?php 
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('content_model', 'co_model', TRUE);
   
        $this->load->helper('text');
        $this->load->helper('url');
        $admin_id = $this->session->userdata('admin_id');

        if ($admin_id == NULL) {
            redirect("admin_login", "refresh");
        }

    }

    public function index() {
        $data = array();
        $data['title'] = "AIMS - Admin Panel";
        $data['breadcrumb']=1;
    //    $data['admin_maincontent'] = $this->load->view('admin/dashboard', $data, true);
       $data['admin_maincontent'] = $this->load->view('admin/admin_master_content', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function addphoto() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/add_photo', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    function doupload() {
        
        $config['upload_path'] = './images/Slider/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '650';
        $config['max_height'] = '500';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        $yes_upload = $this->upload->do_upload('image');
        
        if (!$yes_upload) {
             $sdata = array();
            $sdata['message'] = "Image Not uploaded..Plaese Maintain Image Size!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/addphoto");
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $datax['image'] = "images/Slider/" . $udata['upload_data']['file_name'];
            
            $datax['category'] = $this->input->post('category', true);
            $datax['title'] = $this->input->post('title', true);
            $datax['date'] = date('m/d/Y');
            
            $this->co_model->savephoto($datax);
            $sdata = array();
            $sdata['message'] = "Save Photo succesfully!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/addphoto");
        }
            
            
    }

    public function viewphoto() {
        $data['title'] = "AIMS - Admin Panel";

        $data['allphoto'] = $this->co_model->select_all_photo();
        $data['admin_maincontent'] = $this->load->view('admin/view_photo', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function editphoto($id) {

        $data['editdata'] = $this->co_model->select_photo_by_id($id);
        $data['admin_maincontent'] = $this->load->view('admin/edit_photo', $data, true);
        $data['title'] = 'Edit Photo';
        $this->load->view('admin/admin_home', $data);
    }

    public function update_photo($id) {        
            
        $config['upload_path'] = './images/Slider/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '500';
        $config['max_width'] = '650';
        $config['max_height'] = '';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        $yes_upload = $this->upload->do_upload('image');
        
        if (!$yes_upload) {
             $sdata = array();
            $sdata['message'] = "Image Not uploaded..Plaese Maintain Image Size!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/addphoto");
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $datax['image'] = "images/Slider/" . $udata['upload_data']['file_name'];
            
            $datax['category'] = $this->input->post('category', true);
            $datax['title'] = $this->input->post('title', true);
            $datax['date'] = date('m/d/Y');
            
            $this->co_model->update_photo($datax, $id);
            $sdata = array();
            $sdata['message'] = "Update photo Successfully!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/viewphoto");
            
        }
        
    }

    public function deletephoto($id) {
        $this->co_model->delete_photo_by_id($id);
        redirect("dashboard/viewphoto");
    }

    public function contentmessage() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/contentmessage', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function savecontentmessage() {

        $data['title'] = $this->input->post('title', true);
        $data['category'] = $this->input->post('category', true);
        $data['content'] = $this->input->post('content', true);
        $data['publication_status'] = $this->input->post('publication_status', true);
       
        $data['dateAdd'] = date('Y/m/d');
       // print_r($data);die();
        $config['upload_path'] = './images/Photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '300';
        $config['max_width'] = '300';
        $config['max_height'] = '300';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['image'] = "images/Photo/" . $udata['upload_data']['file_name'];
        }
        $insrt=$this->co_model->savecontentmessage($data);
        if($insrt)
        {
            $sdata = array();
            $sdata['message'] = "Save message succesfully!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/contentmessage");
        }
        else{
            $sdata['errormessage'] = "Content not saved";
            $this->session->set_userdata($sdata);
            redirect("dashboard/contentmessage");
        }
        
    }

    public function viewcontentmessage() {
        $data['title'] = "AIMS - Admin Panel";
        $data['allmessage'] = $this->co_model->select_allmessage();
        $data['admin_maincontent'] = $this->load->view('admin/viewcontentmessage', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function editcontentmessage($id) {

        $data['editdata'] = $this->co_model->select_message_by_id($id);
        if(!empty($id))
        {
            $data['admin_maincontent'] = $this->load->view('admin/editcontentmessage', $data, true);
            $data['title'] = 'Admin Panel';
            $this->load->view('admin/admin_home', $data);
        }
        else{
            $sdata['message'] = "No Content found!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/viewcontentmessage");
        }
    }

    public function updatecontentmessage($id) {

        $data['title'] = $this->input->post('title', true);
        $data['category'] = $this->input->post('category', true);
        $data['content'] = $this->input->post('content', true);
        $data['publication_status'] = $this->input->post('publication_status', true);

        $config['upload_path'] = './images/Photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100000';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['image'] = "images/Photo/" . $udata['upload_data']['file_name'];
        }
        $this->co_model->updatecontentmessage($data, $id);
        $sdata = array();
        $sdata['message'] = "Update Content Successfully!";
        $this->session->set_userdata($sdata);
        redirect("dashboard/viewcontentmessage");
    }

    public function deletecontentmessage($id) {
        $this->co_model->deletecontentmessage($id);
        redirect("dashboard/viewcontentmessage");
    }
    
    
    public function academiccontent() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/academiccontent', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function saveacademiccontent() {

        $data['title'] = $this->input->post('title', true);
        $data['category'] = $this->input->post('category', true);
        $data['content'] = $this->input->post('content', true);
        $data['eventdate'] = $this->input->post('eventdate', true);
        $data['publication_status'] = $this->input->post('publication_status', true);
       
        $data['dateAdd'] = date('Y/m/d');
       // print_r($data);die();
        
        $config['upload_path'] = './uploads/file/';
        $config['allowed_types'] = 'pdf|docx|doc|xlx|xlsx|ppt|pptx|zip|rar|jpg|png';
        $config['max_size'] = '3000';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['file'] = "uploads/file/" .$udata['upload_data']['file_name'];
        }
        $insrt=$this->co_model->saveacademiccontent($data);
        if($insrt)
        {
            $sdata = array();
            $sdata['message'] = "Save message succesfully!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/academiccontent");
        }
        else{
            $sdata['errormessage'] = "Content not saved";
            $this->session->set_userdata($sdata);
            redirect("dashboard/academiccontent");
        }
        
    }
    
   

    public function viewacademiccontent() {
        $data['title'] = "AIMS - Admin Panel";
        $data['allmessage'] = $this->co_model->select_allacademicInfo();
        $data['admin_maincontent'] = $this->load->view('admin/viewacademiccontent', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function editacademiccontent($id) {

        $data['editdata'] = $this->co_model->select_academicInfo_by_id($id);
        if(!empty($id))
        {
            $data['admin_maincontent'] = $this->load->view('admin/editacademiccontent', $data, true);
            $data['title'] = 'Admin Panel';
            $this->load->view('admin/admin_home', $data);
        }
        else{
            $sdata['message'] = "No Content found!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/viewacademiccontent");
        }    
    }

    public function updateacademiccontent($id) {

        $data['title'] = $this->input->post('title', true);
        $data['category'] = $this->input->post('category', true);
        $data['content'] = $this->input->post('content', true);
        $data['eventdate'] = $this->input->post('eventdate', true);
        $data['publication_status'] = $this->input->post('publication_status', true);

        $config['upload_path'] = './uploads/file/';
        $config['allowed_types'] = 'pdf|docx|doc|xlx|xlsx|ppt|pptx|zip|rar|png|jpg';
        $config['max_size'] = '3000';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['file'] = $udata['upload_data']['file_name'];
        }
        $this->co_model->updateacademiccontent($data, $id);
        $sdata = array();
        $sdata['message'] = "Update Content Successfully!";
        $this->session->set_userdata($sdata);
        redirect("dashboard/viewacademiccontent");
    }

    public function deleteacademiccontent($id) {
        $sdata['message'] = "Content deleted!";
        $this->session->set_userdata($sdata);
        $this->co_model->deleteacademiccontent($id);
        redirect("dashboard/viewacademiccontent");
    }

    public function management() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/management', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function savemanagementmember() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[bm_cat]',
                'label' => 'Member Category',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[bm_name]',
                'label' => 'Member Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[bm_post]',
                'label' => 'Member Designation',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[bm_post_value]',
                'label' => 'Member Designation Category',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[bm_phone]',
                'label' => 'Member Phone',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[bm_desc]',
                'label' => 'Member description',
                'rules' => 'required'
            )
        );

        $config['upload_path'] = './uploads/boardmember';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '300';
        $config['max_width'] = '210';
        $config['max_height'] = '240';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        $yes_upload = $this->upload->do_upload('bm_image');

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = "AIMS - Admin Panel";
          //  $data['bm_editor'] = $this->data;
            $data['admin_maincontent'] = $this->load->view('admin/management', $data, true);
            $this->load->view('admin/admin_home', $data);
        } elseif (!$yes_upload) {
            $sdata = array();
            $sdata['message'] = "Image Size Not Matched";
            $this->session->set_userdata($sdata);
            
            $data['title'] = "AIMS - Admin Panel";
          //  $data['bm_editor'] = $this->data;
            $data['admin_maincontent'] = $this->load->view('admin/management', $data, true);
            $this->load->view('admin/admin_home', $data);
        } else {
            $data = $this->input->post('data', true);

            $img_data = $this->upload->data();

            $data['bm_image'] = "uploads/boardmember/" . $img_data['file_name'];

            $this->co_model->savemanagementmember($data);
            $sdata = array();
            $sdata['message'] = "Save Member Information succesfully!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/managementlist");
        }
    }

    public function managementlist() {
        $data['bm_cat']=1;
        $data['title'] = "AIMS - Admin Panel";
        $data['listdata'] = $this->co_model->select_allmemberlistBYCategory($data);
        $data['admin_maincontent'] = $this->load->view('admin/viewmemberlist', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
     public function Thirdstaff_list() {
        $data['bm_cat']=2;
        $data['title'] = "AIMS - Admin Panel";
        $data['listdata'] = $this->co_model->select_allmemberlistBYCategory($data);
        $data['admin_maincontent'] = $this->load->view('admin/viewmemberlist', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    public function Fourthstaff_list() {
        $data['bm_cat']=3;
        $data['title'] = "AIMS - Admin Panel";
        $data['listdata'] = $this->co_model->select_allmemberlistBYCategory($data);
        $data['admin_maincontent'] = $this->load->view('admin/viewmemberlist', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function editmanagement($id) {

        $data['editdata'] = $this->co_model->select_memberlist_by_id($id);
        $data['admin_maincontent'] = $this->load->view('admin/editmemberlist', $data, true);
        $data['title'] = 'Admin Panel';
        $this->load->view('admin/admin_home', $data);
    }
    public function updatememberinfo($id) {

        $data = $this->input->post('data', true);
       
        $this->load->library('upload');
        $config['upload_path'] = './uploads/boardmember/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '300';
        $config['max_width'] = '210';
        $config['max_height'] = '240';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['bm_image'] = "uploads/boardmember/" . $udata['upload_data']['file_name'];
        }
        $this->co_model->updatememberinfo($data, $id);
        $sdata = array();
        $sdata['message'] = "Update Member Successfully!";
        $this->session->set_userdata($sdata);
        redirect("dashboard/managementlist");
    }
    
    public function deletemanagement($id) {
        $this->co_model->deletemanagement($id);
        redirect("dashboard/managementlist");
    }

    
    
    public function addResult() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/add_result', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    
    public function saveresultsummery() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[exam_type]',
                'label' => 'Exam Type',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[exam_year]',
                'label' => 'Exam Year',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "AIMS - Admin Panel";
            $data['admin_maincontent'] = $this->load->view('admin/add_result', $data, true);
            $this->load->view('admin/admin_home', $data);
        } 
        else {
            $data = $this->input->post('data', true);
        //    print_r($data);            die();
            $this->co_model->saveresult($data);
            $sdata = array();
            $sdata['message'] = "Save Result!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/resultlist");
        }
    }
    
     public function resultlist() {
        $data['title'] = "AIMS - Admin Panel";
        $data['listdata'] = $this->co_model->select_allresultlist();
        $data['admin_maincontent'] = $this->load->view('admin/viewresultlist', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    public function editresult($id) {
        $data['title'] = "AIMS - Admin Panel";
        $data['editdata'] = $this->co_model->select_resultlist_byID($id);
        $data['admin_maincontent'] = $this->load->view('admin/edit_resultlist', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    public function updateresult($id) {

        
            $data = $this->input->post('data', true);
       //     print_r($data);die();
            $this->co_model->updateresult($data,$id);
            $sdata = array();
            $sdata['message'] = "Update Result!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/resultlist");
        
    }
    public function deleteresult($id) {
        $this->co_model->deleteresult($id);
        redirect("dashboard/resultlist");
    }
    
    
    public function MeritStudent() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/meritstudent', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    

    
        public function insert_MeritStudent() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[stuName]',
                'label' => 'Student Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[position]',
                'label' => 'Position',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[year]',
                'label' => 'Year',
                'rules' => 'required'
            )
        );
        $config['upload_path'] = './uploads/meritstudent';
        $config['allowed_types'] = 'gif|jpg|png';
        
        $config['max_width'] = '450';
        $config['max_height'] = '450';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        $yes_upload = $this->upload->do_upload('image');
        
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "AIMS - Admin Panel";
            $data['admin_maincontent'] = $this->load->view('admin/meritstudent', $data, true);
            $this->load->view('admin/admin_home', $data);
        } 
        elseif (!$yes_upload) {
            $sdata = array();
            $sdata['message'] = "Image Size Not Matched";
            $this->session->set_userdata($sdata);
            
            $data['title'] = "AIMS - Admin Panel";
          //  $data['bm_editor'] = $this->data;
            $data['admin_maincontent'] = $this->load->view('admin/meritstudent', $data, true);
            $this->load->view('admin/admin_home', $data);
        }
        else {
            $data = $this->input->post('data', true);
            $img_data = $this->upload->data();
            $data['image'] = "uploads/meritstudent/" . $img_data['file_name'];
            $this->co_model->saveMeritStudent($data);
            $sdata = array();
            $sdata['message'] = "Save Merit Student Information!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/MeritStudent");
        }
    }
    
    
    public function viewMeritStudentlist() {
        $data['title'] = "AIMS - Admin Panel";
        $data['listdata'] = $this->co_model->select_meritlist();
        $data['admin_maincontent'] = $this->load->view('admin/viewmeritStudentlist', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    
    public function deletemeritlist($id) {
        $this->co_model->deletemeritlist($id);
        redirect("dashboard/viewMeritStudentlist");
    }
    public function editmaritlist($id) {
        $data['title'] = "AIMS - Admin Panel";
        $data['editdata'] = $this->co_model->select_meritlist_byID($id);
      // print_r($data['editdata']); die();
        $data['admin_maincontent'] = $this->load->view('admin/editmaritstudent', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    public function updatemaritlist($id) {

        
            $data = $this->input->post('data', true);
       //     print_r($data);die();
            $this->co_model->updatemerit($data,$id);
            $sdata = array();
            $sdata['message'] = "Update Result!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/viewMeritStudentlist");
        
    }
    
    public function addMeritStudent() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/add_meritstudent', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    
   
    public function MeritStudentlist() {
        $data['title'] = "AIMS - Admin Panel";
        $data['listdata'] = $this->co_model->select_meritlist();
        $data['admin_maincontent'] = $this->load->view('admin/meritStudentlist', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    
    
    public function contact() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/contact', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    public function savecontact() {

        
            $data['contactInfo'] = $this->input->post('contact', true);

            $this->co_model->savecontact($data);
            $sdata = array();
            $sdata['message'] = "Contact Information Saved!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/contactlist");
        
    }
    public function contactlist() {
        $data['title'] = "AIMS - Admin Panel";
        $data['listdata'] = $this->co_model->select_contactlist();
        $data['admin_maincontent'] = $this->load->view('admin/viewcontact', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    public function editcontactlist($id) {

        $data['editdata'] = $this->co_model->select_contact_by_id($id);
        $data['admin_maincontent'] = $this->load->view('admin/editcontact', $data, true);
        $data['title'] = 'Admin Panel';
        $this->load->view('admin/admin_home', $data);
    }
    public function updatecontact($id) {

            $data= $this->input->post('data', true);

            $this->co_model->updatecontact($data,$id);
            $sdata = array();
            $sdata['message'] = "Contact Information Update!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/contactlist");
        
    }
    public function deletecontact($id) {
        $this->co_model->deletecontact($id);
        redirect("dashboard/contactlist");
    }
    
    public function career() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/career', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    
    public function savejobinfo() {
        
        $data['postName'] = $this->input->post('postName', true);
        $data['requirement'] = $this->input->post('content', true);
        $data['publication_status'] = $this->input->post('publication_status', true);
       
        $data['date_add'] = date('Y/m/d');
       // print_r($data);die();
        $this->load->library('upload');
        $config['upload_path'] = './uploads/file/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['file'] = $udata['upload_data']['file_name'];
        }
        $insrt=$this->co_model->savejobInfo($data);
        if($insrt)
        {
            $sdata = array();
            $sdata['message'] = "Save Job Information succesfully!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/career");
        }
        else{
            $sdata['errormessage'] = "Job Information not saved";
            $this->session->set_userdata($sdata);
            redirect("dashboard/career");
        }
        
    }

    public function viewjobinfo() {
        $data['title'] = "AIMS - Admin Panel";
        $data['allmessage'] = $this->co_model->select_AllJobInfo();
        $data['admin_maincontent'] = $this->load->view('admin/viewcareer', $data, true);
        $this->load->view('admin/admin_home', $data);
    }
    
    public function getRequirements($file) {
	        $this->load->helper('download');
	        $data = file_get_contents(base_url().'uploads/file/'.$file); // Read the file's contents
	        $name = $file;
	  
	        force_download($name, $data);

    	}
        
        
        
        
  public function honorboard() {
        $data['title'] = "AIMS - Admin Panel";
        $data['admin_maincontent'] = $this->load->view('admin/honormember', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function savehonorboard() {

        $data['name'] = $this->input->post('name', true);
        $data['designation'] = $this->input->post('designation', true);
        $data['time_period'] = $this->input->post('time_period', true);
             
        $data['category'] = $this->input->post('category', true);
        $data['aobut_emp'] = $this->input->post('content', true);
       // $data['publication_status'] = $this->input->post('publication_status', true);
       
        $data['dateAdd'] = date('Y/m/d');
       // print_r($data);die();
        $config['upload_path'] = './images/Photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '300';
        $config['max_width'] = '300';
        $config['max_height'] = '300';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['image'] = "images/Photo/" . $udata['upload_data']['file_name'];
        }
        $insrt=$this->co_model->savehonordata($data);
        if($insrt)
        {
            $sdata = array();
            $sdata['message'] = "Save message succesfully!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/honorboard");
        }
        else{
            $sdata['errormessage'] = "Content not saved";
            $this->session->set_userdata($sdata);
            redirect("dashboard/honorboard");
        }
        
    }

    public function viewhonorboard() {
        $data['title'] = "AIMS - Admin Panel";
        $data['allmember'] = $this->co_model->select_allhonormember();
        $data['admin_maincontent'] = $this->load->view('admin/viewhonormember', $data, true);
        $this->load->view('admin/admin_home', $data);
    }

    public function edithonorboard($id) {

        $data['editdata'] = $this->co_model->select_honor_by_id($id);
      //  print_r($data); die();
        if(!empty($id))
        {
            $data['admin_maincontent'] = $this->load->view('admin/edithonormember', $data, true);
            $data['title'] = 'Admin Panel';
            $this->load->view('admin/admin_home', $data);
        }
        else{
            $sdata['message'] = "No Content found!";
            $this->session->set_userdata($sdata);
            redirect("dashboard/viewhonorboard");
        }
    }

    public function oupdatehonorboard($id) {

         $data['name'] = $this->input->post('name', true);
        $data['designation'] = $this->input->post('designation', true);
        $data['time_period'] = $this->input->post('time_period', true);
             
        $data['category'] = $this->input->post('category', true);
        $data['aobut_emp'] = $this->input->post('content', true);
       // $data['publication_status'] = $this->input->post('publication_status', true);
       
        $data['dateAdd'] = date('Y/m/d');
       // print_r($data);die();
        $config['upload_path'] = './images/Photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '300';
        $config['max_width'] = '300';
        $config['max_height'] = '300';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['image'] = "images/Photo/" . $udata['upload_data']['file_name'];
        }
        $this->co_model->updatehonorcontent($id, $data);
        $sdata = array();
        $sdata['message'] = "Update Content Successfully!";
        $this->session->set_userdata($sdata);
        redirect("dashboard/viewhonorboard");
    }
    
     public function updatehonorboard($id) {

         $data['name'] = $this->input->post('name', true);
        $data['designation'] = $this->input->post('designation', true);
        $data['time_period'] = $this->input->post('time_period', true);
             
        $data['category'] = $this->input->post('category', true);
        $data['aobut_emp'] = $this->input->post('content', true);

        $config['upload_path'] = './images/Photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3000';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
             $data['image'] = "images/Photo/" . $udata['upload_data']['file_name'];
        }
        $this->co_model->updatehonorcontent($data, $id);
        $sdata = array();
        $sdata['message'] = "Update Content Successfully!";
        $this->session->set_userdata($sdata);
        redirect("dashboard/viewhonorboard");
    }


    public function deletehonorboard($id) {
        $this->co_model->deletehonormember($id);
       redirect("dashboard/viewhonorboard");
    }
        
        
        
        
        
        
        
        
        


    public function admin_logout() {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('login_status');
        $this->session->unset_userdata('admin_name');
        session_destroy();
        $sdata = array();
        $sdata['exception'] = "You are successfully logout..";
        $this->session->set_userdata($sdata);
        redirect("admin_login");
    }

}

?>