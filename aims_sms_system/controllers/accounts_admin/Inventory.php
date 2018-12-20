<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Inventory extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->account_access();
        $this->load->model('admin/inventory/InventoryModleAdmin', 'InventoryModleAdmin');
    }

    public function index() {

        $data['inventory'] = 'active';
        $data['invencat']='active';
        $data['itemcategorylist'] = $this->InventoryModleAdmin->getinventorycategoryList();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/index',$data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function itemcategory() {
        $this->load->library('form_validation');

        $this->load->view('templates/accounts/common/header');
        $this->load->view('templates/accounts/inventory/itemcategory');
        $this->load->view('templates/accounts/common/footer');
    }

    public function insertcategory() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[categoryName]',
                'label' => 'categoryName',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            redirect(acc_Url() . "/inventory/index");
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->InventoryModleAdmin->duplicateInventorycategoryInfo($data);

            if (!$result) {
                $this->InventoryModleAdmin->addInventorycategoryInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url() . "/inventory/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

            redirect(acc_Url() . "/inventory/index");
            
            }
        }
    }

    public function itemcategorylist() {

        $data['itemcategorylist'] = $this->InventoryModleAdmin->getinventorycategoryList();

        $this->load->view('templates/accounts/common/header');
        $this->load->view('templates/accounts/inventory/viewitemcategorylist', $data);
        $this->load->view('templates/accounts/common/footer');
    }

    
    public function edititemcategory($id) {

    

        $data['editData'] = $this->InventoryModleAdmin->edititemcategory($id);
        $data['inventory'] = 'active';
        $data['invencat'] = 'active';
        //$data['itemcategorylist'] = $this->InventoryModleAdmin->getinventorycategoryList();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/editcatagory', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function updateitemcategory($id) {
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        print_r($_POST);
        $config = array(
            array(
                'field' => 'data[categoryName]',
                'label' => 'Category Name',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
                
            redirect(acc_Url() . "/inventory/index");
            
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->InventoryModleAdmin->duplicateInventorycategoryInfo($data);

            if (!$result) {
                $this->InventoryModleAdmin->updateitemcategory($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url() . "/inventory/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               

                $data['editData'] = $this->InventoryModleAdmin->edititemcategory($id);
             redirect(acc_Url() . "/inventory/index");
            }
        }
    }

    public function deleteitemcategory($id) {


       $result= $this->InventoryModleAdmin->deleteitemcategory($id);
      if($result){
                $sdata['message'] = 'Deleted!';
                $this->session->set_userdata($sdata);
       redirect(acc_Url() . "/inventory/index");
      }else {
           $sdata['errormessage'] = 'Some Problems Found Here!';
                $this->session->set_userdata($sdata);
             redirect(acc_Url() . "/inventory/index");
      }
    }
    
    public function insertinventory() {
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
                'field' => 'data[price]',
                'label' => 'Price',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[boughtBy]',
                'label' => 'Purchaser Id',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
             $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/inventinfo',$data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $this->InventoryModleAdmin->addInventory($data);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect(acc_Url() . "/inventory/addinventdata");
        }
    }

    public function iteminventorylist() {

        $data['inventorylist'] = $this->InventoryModleAdmin->getinventoryList();
        $data['inventory'] = 'active';
        $data['inventadd'] = 'active';
        $data['viewinven'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/viewinventoryinfo', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }
    
    public function addinventdata(){
        $data['inventory'] = 'active';
        $data['inventadd'] = 'active';
        $data['inventorylist'] = $this->InventoryModleAdmin->getinventoryList();
        $data['itemcategorylist'] = $this->InventoryModleAdmin->getinventorycategoryList();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/inventinfo',$data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function editinventory($id) {



        $data['editData'] = $this->InventoryModleAdmin->editinventory($id);

        
        $data['deleteinventory'] = $this->InventoryModleAdmin->getinventoryList();
        $data['inventory'] = 'active';
        $data['inventadd'] = 'active';
        $data['viewinven'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/editinventory', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function updateinventory($id) {
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
                'field' => 'data[price]',
                'label' => 'Price',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[boughtBy]',
                'label' => 'Purchaser Id',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/section'));
          

            $data['editData'] = $this->InventoryModleAdmin->editinventory($id);
            redirect(acc_Url() . "/inventory/iteminventorylist");
        } else {
            $data = $this->input->post('data', TRUE);
            $this->InventoryModleAdmin->updateinventoryInfo($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect(acc_Url() . "/inventory/iteminventorylist");
        }
    }

    public function deleteinventory($id) {


      $dlt= $this->InventoryModleAdmin->deleteinventoryInfo($id);
   if($dlt){
        $sdata['message'] = 'Successfully Deleted!';
        $this->session->set_userdata($sdata);
       
        redirect(acc_Url() . "/inventory/iteminventorylist");
   }else
   {
       
      $sdata['errormessage'] = 'Some Problems Here!';
        $this->session->set_userdata($sdata);
        redirect(acc_Url() . "/inventory/iteminventorylist"); 
   }
       
       
 
       }
   
    
    
    public function requirement() {
        $data['inventory'] = 'active';
        $data['requireinvent'] = 'active';
        $data['requirementlist'] = $this->InventoryModleAdmin->getinventoryrequirementList();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/requirement/index', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }
    
    
    
    public function insertrequirement() {
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
                'label' => 'Item Piece',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
  redirect(acc_Url() . "/inventory/requirement"); 
        } else {
            $data = $this->input->post('data', TRUE);
            $this->InventoryModleAdmin->addInventoryRequirement($data);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

             redirect(acc_Url() . "/inventory/requirement"); 
        }
    }
    public function requirementlist() {

        $data['requirementlist'] = $this->InventoryModleAdmin->getinventoryrequirementList();

        $this->load->view('templates/accounts/common/header');
        $this->load->view('templates/accounts/inventoryrequirement/viewrequirementlist', $data);
        $this->load->view('templates/accounts/common/footer');
    }
    
    public function editrequirement($id) {

        $data['editData'] = $this->InventoryModleAdmin->editrequirement($id);
     
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/inventory/requirement/editrequirement', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function updaterequirement($id) {
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
                'label' => 'Item Piece',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/section'));
        
            

        $data['editData'] = $this->InventoryModleAdmin->editrequirement($id);
        
            redirect(acc_Url() . "/inventory/requirement"); 
            
        } else {
            $data = $this->input->post('data', TRUE);
            $this->InventoryModleAdmin->updaterequirementInfo($data, $id);
            $sdata['message'] = 'Successfully Updated!';
            $this->session->set_userdata($sdata);

          redirect(acc_Url() . "/inventory/requirement"); 
        }
    }

    public function deleterequirement($id) {
 
      $dlt= $this->InventoryModleAdmin->deleterequirementInfo($id);
   if($dlt){
        $sdata['message'] = 'Successfully Deleted!';
        $this->session->set_userdata($sdata);
       
        redirect(acc_Url() . "/inventory/requirement");
   }else
   {
       
      $sdata['errormessage'] = 'Some Problems Here!';
        $this->session->set_userdata($sdata);
        redirect(acc_Url() . "/inventory/requirement"); 
   }
    }
    
    
    //put your code here
}

