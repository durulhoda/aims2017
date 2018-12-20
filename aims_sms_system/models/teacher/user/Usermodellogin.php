<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Usermodellogin extends CI_Model {
    
    private $_table = "employee_access";
    
    public function __construct() {
        parent::__construct();       
        
    }

    public function login_info() {
     
        $user_check = $this->db->get_where($this->_table, 
                array(
            'emp_userName' => $this->input->post('username'),
            'emp_pass' => md5($this->input->post('password'))
                ));

        if ($user_check->num_rows() > 0) { // check 
            $rec = $user_check->row_array();
            
            $t_loginId = $rec['t_loginId'];
            $emp_userName = $rec['emp_userName'];
            $hr = $rec['hr'];
            $hrAdmin = $rec['hrAdmin'];
            $academic = $rec['academic'];
            $academicAdmin = $rec['academicAdmin'];
            $finance = $rec['finance'];
            $financeAdmin = $rec['financeAdmin'];
            $admissionAndResult = $rec['admissionAndResult'];
            $admissionAndResultAdmin = $rec['admissionAndResultAdmin'];
            $emp_access_power = $rec['emp_access_power'];

            $teacher_info = array(// user info retrive 
                't_loginId' => $t_loginId,
                'emp_userName' => $emp_userName,
                'hr' => $hr,
                'hrAdmin' => $hrAdmin,
                'academic' => $academic,
                'academicAdmin' => $academicAdmin,
                'finance' => $finance,
                'financeAdmin' => $financeAdmin,
                'admissionAndResult' => $admissionAndResult,
                'admissionAndResultAdmin' => $admissionAndResultAdmin,
                'access_power' => $emp_access_power,
                'login_validation' => TRUE
            );
//        print_r($admin_info); exit;
        } else {
            return FALSE;
        }
        return $teacher_info;
    }

}