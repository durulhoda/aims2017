<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Discount_setup extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/paymentshead/PaymentsHeadModleAdmin', 'PaymentsHeadModleAdmin');
    }
    
    public function index()
    {
        $data['records'] = $this->getDiscountList();
        $data['stupayment']      = "active";
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/discount_setup/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        
    }

    private function getDiscountList()
    {
        $result = $this->db
                    ->where('is_deleted', 0)
                    ->get('student_discounts');
        return $result->result_array(); 
    }
    
    public function insert_discount()
    {
        
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[name]',
                'label' => 'Discount Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[type]',
                'label' => 'Discount Type',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[amount]',
                'label' => 'Discount Amount',
                'rules' => 'required'
            )
            
            
        );
        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['stupayment'] = "active";
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/payment/discount_setup/index'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
            
        } else {
            $data   = $this->input->post('data', TRUE);
            $result = $this->duplicateDiscountInfo($data);
            
            if (!$result) {
                $this->add($data);
                $sdata['message'] = 'Successful ';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/discount_setup");
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/discount_setup");
            }
            //          $this->load->view('formsuccess');
        }
        
        
    }

    private function duplicateDiscountInfo($data) {
//        $this->db->select('campusName');    
        $arr = [
            'name' => $data['name'],
            'type' => $data['type'],
            'amount' => $data['amount']
        ];    
        $qu = $this->db
            ->where($arr)
            ->get('student_discounts');
        $reault = $qu->row_array();
        return $reault;
    }

    private function add($data)
    {
        $this->db->insert('student_discounts', $data);
        return $this->db->insert_id();  
    }
    
    public function edit($id)
    {
        
        $data['editData']   = $this->getDiscountInfo($id);
        //        print_r($data);
        $data['stupayment'] = "active";
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/discount_setup/edit', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function getDiscountInfo($id) {
        $qu = $this->db->get_where('student_discounts', array('id' => $id));
        return $qu->row_array();
    }
    
    public function update($id)
    {
        
        $data   = $this->input->post('data', TRUE);
        $result = $this->duplicateDiscountInfo($data);
        
        if (!$result) {
            $this->update_discount($data, $id);
            $sdata['message'] = 'Successful ';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/discount_setup");
        } else {
            $sdata['errormessage'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);
            
            redirect(admin_Url() . "/discount_setup");
        }
    }

    private function update_discount($data, $id)
    {
        $qu = $this->db->where('id', $id);
        $this->db->update('student_discounts', $data);
        return $this->db->affected_rows();
    }
    
    public function delete($id)
    {
        
        
        $this->delete_discount($id);
        $sdata['message'] = 'Successful ';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/discount_setup");
    }

    public function delete_discount($id) {

        $qu = $this->db->where('id', $id);
        $this->db->update('student_discounts', ['is_deleted' => 1]);
        return $this->db->affected_rows();
    }
    
    
    //put your code here
}

?>
