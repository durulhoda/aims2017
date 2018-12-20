<?php
/*
 * Project Name : Virtual Imaging 
 * Project Description : It's a vertual imaging solution which can be used for patients' clinical reports.
 * Project coordinator : Animesh Chadnra Bain
 * Project Manager : Nusrat Akhter
 * Project url: http://vimage.comjagat.com
 * Author's email : animesh@comjagat.com
 * Project version : 0.1
 */
class AccountsModleAdmin extends CI_Model {
    
    private $_table = "acounts_access";
    
    public function __construct() {
        parent::__construct();       
        
    }

    public function login_info() {
     
        $user_check = $this->db->get_where($this->_table, 
                array(
            'access_userName' => $this->input->post('username'),
            'access_userPass' => md5($this->input->post('password'))
                ));

        if ($user_check->num_rows() > 0) { // check 
            $rec = $user_check->row_array();
            
            $loginId = $rec['aims_id'];
            $access_userName = $rec['access_userName'];
            $access_userPass = $rec['access_userPass'];
         
            $access_power = $rec['access_power'];

            $crs_info = array(// user info retrive 
                'aims_id' => $loginId,
                'access_userName' => $access_userName,
                'access_userPass' => $access_userPass,
                'access_power' => $access_power,
                'login_validation' => TRUE
            );
//        print_r($admin_info); exit;
        } else {
            return FALSE;
        }
        return $crs_info;
    }

}