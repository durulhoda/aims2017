<?php 
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
	defined('BASEPATH') or exit('No Direct Script Access Allowed');

	class Get_course_list extends CI_Model{
		public function get_courses(){
        $this->db->select('*');
        $this->db->from('course');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
  }
?>