<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Paymenthead  extends MY_Controller{
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
         $this->load->model('admin/paymentshead/PaymentsHeadModleAdmin', 'PaymentsHeadModleAdmin');
    }
    
    public function index(){
        $data['paymentheadlist'] = $this->PaymentsHeadModleAdmin->getlistpaymenthead();
        $data['stupayment']="active";
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/paymenthead/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        
    }
    
    public function insertpaymenthead(){
        
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
            array(
                'field' => 'data[headCategory]',
                'label' => 'Payment Head Category',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[headName]',
                'label' => 'Payment Name',
                'rules' => 'required'
            )
            
            
        );
        
          $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE){
                $data['stupayment']="active";
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/payment/paymenthead/index'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link

		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $result = $this->PaymentsHeadModleAdmin->duplicatePaymentheadInfo($data);

                 if (!$result) {
                    $this->PaymentsHeadModleAdmin->addPaymentheadInfo($data);
                    $sdata['message'] = 'Successful ';
                     $this->session->set_userdata($sdata);
                    redirect(admin_Url()."/paymenthead");
                    
                    } else {
                        $sdata['message'] = 'Duplicate Entry Found!';
                        $this->session->set_userdata($sdata);

                        redirect(admin_Url()."/paymenthead");
                    }
//			$this->load->view('formsuccess');
		}

        
    } 
    
//    public function paymentheadlist() {
//
//        $data['paymentheadlist'] = $this->PaymentsHeadModleAdmin->getlistpaymenthead();
//        //        print_r($mediumlist);
//      //  $data['payment']="active";
//        $this->load->view('system_path/admin/common/header_link'); // header Css link
//        $this->load->view('system_path/admin/common/header'); // body header
//        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
//        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
//        $this->load->view('system_path/admin/payment/paymenthead/index',$data); // ...........body content page...........
//        $this->load->view('system_path/admin/common/footer'); // footer & script link
//        $this->load->view('system_path/jsquery'); // footer & script link
//    }

    public function editdpaymenthead($id) {

        $data['editData'] = $this->PaymentsHeadModleAdmin->editpaymentheadInfo($id);
//        print_r($data);
        $data['stupayment'] = "active";
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/paymenthead/editpaymenthead', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function updatepaymenthead($id) {

        $data = $this->input->post('data', TRUE);
        $result = $this->PaymentsHeadModleAdmin->duplicatePaymentheadInfo($data);

        if (!$result) {
            $this->PaymentsHeadModleAdmin->updatepaymentheadInfo($data, $id);
            $sdata['message'] = 'Successful ';
                     $this->session->set_userdata($sdata);
                    redirect(admin_Url()."/paymenthead");
        } else {
            $sdata['errormessage'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url()."/paymenthead");
        }
    }

    public function deletepaymenthead($id) {


        $this->PaymentsHeadModleAdmin->deletepaymentheadInfo($id);
        $sdata['message'] = 'Successful ';
                     $this->session->set_userdata($sdata);
        redirect(admin_Url()."/paymenthead");
    }

    
    //put your code here
}

?>
