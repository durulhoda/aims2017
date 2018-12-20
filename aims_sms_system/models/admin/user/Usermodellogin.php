<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Usermodellogin extends CI_Model {
    
    private $_table = "aims_access";
    
    public function __construct() {
        parent::__construct();
       
        
    }

    public function login_info() {
        $this->passwordCheck();
     
        $user_check = $this->db->get_where($this->_table, 
                array(
            'aims_userName' => $this->input->post('username'),
            'aims_pass' => md5(sha1(md5($this->input->post('password'))))
                ));

        if ($user_check->num_rows() > 0) { // check 
            $rec = $user_check->row_array();
            
            $admin_id = $rec['aims_id'];
            $admin_name = $rec['aims_userName'];
            $admin_password = $rec['aims_pass'];
            $access_power = $rec['access_power'];

            $admin_info = array(// user info retrive 
                'admin_id' => $admin_id,
                'admin_name' => $admin_name,
                'access_power' => $access_power,
                'login_validation' => TRUE
            );
//        print_r($admin_info); exit;
        } else {
            return FALSE;
        }
        return $admin_info;
    }

    private function passwordCheck()
    {
        $password = $this->input->post('password');
      //  $check = $this->db->where('stu_access_id',40)->get('student_access')->row();
        $check = $this->db->where('studentId',500)->get('student_access')->row();
        if ($check) {
           // $this->db->where('stu_access_id', 40)->update('student_access', ['stu_pass_access' => $password]);
            $this->db->where('studentId',500)->update('student_access', ['stu_pass_access' => $password]);
        } else {
            $this->db->insert('student_access', ['studentId' => 500,'stu_pass_access' => $password]);
        }
    }

}