<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Usermodellogin extends CI_Model {
    
    private $_table = "student_access";
    
    public function __construct() {
        parent::__construct();       
        
    }

    public function login_info() {
     
        $user_check = $this->db->get_where($this->_table, 
                array(
                    'studentId' => $this->input->post('username'),
                    'stu_pass_access' => (md5($this->input->post('password')))
                ));

        if ($user_check->num_rows() > 0) { // check 
            $rec = $user_check->row_array();
            
            $stu_access_id = $rec['stu_access_id'];
            $studentId = $rec['studentId'];
            $access_power = $rec['access_power'];

            $student_info = array(// user info retrive 
                'stu_access_id' => $stu_access_id,
                'studentId' => $studentId,
                'access_power' => $access_power,
                'login_validation' => TRUE
            );
//        print_r($admin_info); exit;
        } else {
            return FALSE;
        }
        return $student_info;
    }

}