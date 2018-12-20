<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class InventoryStock extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/inventorystock/InventoryStockModleAdmin', 'InventoryStockModleAdmin');
    }

    public function index() {
        $this->load->library('form_validation');

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/inventorystock/index');
        $this->load->view('templates/admin/common/footer');
    }

    
    public function insertinventorystock() {
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
                'field' => 'data[itemStock]',
                'label' => 'Stock item',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
       redirect(admin_Url() . "/inventorystock/inventorystocklist");
        } else {
           
         //   print_r($data); die();
            $data = $this->input->post('data', TRUE);
             $data['addDate']= date("d-m-Y");
            $this->InventoryStockModleAdmin->addInventoryStock($data);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

       redirect(admin_Url() . "/inventorystock/inventorystocklist");
        }
    }

    public function inventorystocklist() {
        $data['inventory'] = 'active';
        $data['itemstock'] = 'active';
        $data['inventorystocklist'] = $this->InventoryStockModleAdmin->getinventorystockList();
        
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/inventory/inventorystock/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    

    public function editinventorystock($id) {


        $data['editData'] = $this->InventoryStockModleAdmin->editinventorystock($id);

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/inventory/inventorystock/editinventorystock', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updateinventorystock($id) {
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
                'field' => 'data[itemStock]',
                'label' => 'Stock item',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {


            $data['editData'] = $this->InventoryStockModleAdmin->editinventorystock($id);
            redirect(admin_Url() . "/inventorystock/inventorystocklist");
        } else {
            $data = $this->input->post('data', TRUE);
            $this->InventoryStockModleAdmin->updateinventorystockInfo($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

           redirect(admin_Url() . "/inventorystock/inventorystocklist");
        }
    }

    public function deleteinventorystock($id) {

        $dlt=  $this->InventoryStockModleAdmin->deleteinventorystockInfo($id);
   if($dlt){
        $sdata['message'] = 'Successfully Deleted!';
        $this->session->set_userdata($sdata);
       
        redirect(admin_Url() . "/inventorystock/inventorystocklist");
   }else
   {
       
      $sdata['errormessage'] = 'Some Problems Here!';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/inventorystock/inventorystocklist"); 
   }
    }
    
    
    
    //put your code here
}

