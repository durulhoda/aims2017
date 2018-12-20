<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class InventoryLoss extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/inventoryloss/InventoryLossModleAdmin', 'InventoryLossModleAdmin');
    }

    public function index() {
        $data['inventory'] = 'active';
        $data['itemloss'] = 'active';
        $data['inventorylosslist'] = $this->InventoryLossModleAdmin->getinventorylossList();

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/inventory/inventoryloss/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    
    public function insertinventoryloss() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[categoryId]',
                'label' => 'Category Id',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[inventoryName]',
                'label' => 'Inventory Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[itemPiece]',
                'label' => 'Piee of Item',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[itemUse]',
                'label' => 'Use item',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[itemLoss]',
                'label' => 'Loss item',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            
            redirect(admin_Url() . "/inventoryloss/index");
            
        } else {
            $data = $this->input->post('data', TRUE);
             $data['addDate']= date("d-m-Y");
            //print_r($data['addDate']); die();
            $this->InventoryLossModleAdmin->addInventoryLoss($data);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/inventoryloss/index");
        }
    }

    public function inventorylosslist() {

        $data['inventorylosslist'] = $this->InventoryLossModleAdmin->getinventorylossList();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/inventoryloss/viewinventorylosslist', $data);
        $this->load->view('templates/admin/common/footer');
    }
    

    public function editinventoryloss($id) {

       

        $data['editData'] = $this->InventoryLossModleAdmin->editinventoryloss($id);
           $this->load->view('system_path/admin/common/header_link'); // header Css link
           $this->load->view('system_path/admin/common/header'); // body header
           $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
           $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
           $this->load->view('system_path/admin/inventory/inventoryloss/editinventoryloss', $data); // ...........body content page...........
           $this->load->view('system_path/admin/common/footer'); // footer & script link

    }
    public function updateinventoryloss($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        print_r($_POST);
       $config = array(
            array(
                'field' => 'data[categoryId]',
                'label' => 'Category Id',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[inventoryName]',
                'label' => 'Inventory Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[itemPiece]',
                'label' => 'Piece Of item',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[itemUse]',
                'label' => 'Use item',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[itemLoss]',
                'label' => 'Loss item',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {


            $data['editData'] = $this->InventoryLossModleAdmin->editinventoryloss($id);
            
            redirect(admin_Url() . "/inventoryloss/index");
        } else {
            $data = $this->input->post('data', TRUE);
            $this->InventoryLossModleAdmin->updateinventorylossInfo($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

           redirect(admin_Url() . "/inventoryloss/index");
        }
    }

    public function deleteinventoryloss($id) {

        $dlt=  $this->InventoryLossModleAdmin->deleteinventorylossInfo($id);
   if($dlt){
        $sdata['message'] = 'Successfully Deleted!';
        $this->session->set_userdata($sdata);
       
        redirect(admin_Url() . "/inventoryloss/index");
   }else
   {
       
      $sdata['errormessage'] = 'Some Problems Here!';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/inventoryloss/index");
   }
    }
    
    
    
    //put your code here
}

