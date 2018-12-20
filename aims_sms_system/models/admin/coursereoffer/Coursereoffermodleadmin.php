<?php
class CoursereofferModleAdmin extends CI_Model{
    private $_table = "courseoffer";
    public function __construct() {
        parent::__construct();
    }
    public function searchcourseofferlist($data_programOfferId){
//        print_r($data);       
        
       if(!empty($data_programOfferId)){
            $this->db->where('programOfferId',$data_programOfferId);
            $query = $this->db->get($this->_table);
            $result = $query->result_array();
            log_message('error','show '.print_r($result,true));
            return $result;
        }        
  }
  
  public function deleteCourseoffer($data) {
  //      print_r($offerId); echo ("--");   
        $qu = $this->db->where('offerId', $data['offerId']);
        $this->db->delete($this->_table);
        return $this->db->affected_rows()> 0;
    }

     public function insertCourseofferInfo($data){
   //  print_r($data); die();
        $this->db->insert($this->_table, $data);
       return $this->db->insert_id();
    }

      public function search_specific_course_details($data_programOfferId){

            if(!empty($data_programOfferId)){
            $this->db->select('c­ou_offer.offerId,cou­_offer.courseId,cou_­offer.marks,cou_offe­r.status,cour.course­Name,cour.courseCode­,prg_offer.programOf­ferId,emp.employeeId­,emp.firstName,emp.m­iddleName,emp.lastNa­me')
            ->from('courseoffer cou_offer');
            $this->db->join('pro­gramoffer prg_offer', 'cou_offer.programOf­ferId= prg_offer.programOff­erId');
            $this->db->join('emp­loyee emp', 'emp.employeeId= cou_offer.employeeId­');
            $this->db->join('cou­rse cour', 'cour.courseId= cou_offer.courseId')­;

            $this->db->where('co­u_offer.programOffer­Id',$data_programOfferId);
            $this->db->order_by(­'cour.courseCode','A­SC');
            $query = $this->db->get();

            $result = $query->result_array();
            if(!empty($result)){
            return $result;
            }

        }
    }
  }
?>

