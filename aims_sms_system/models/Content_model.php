<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Content_Model extends CI_Model {
    
    private $_management='management';
    private $_resultsummery ='resultsummery';
    private $_meritious_student ='meritious_student';
    private $_contact ='contact';
    private $_tbl_photo ='tbl_photo';
    private $_honor_board ='honor_board';
   
 


    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function check_login_info($admin_username,$admin_password)
    {
        $this->db2->select('*');
        $this->db2->from('tbl_admin');
        $this->db2->where('username',$admin_username);
        $this->db2->where('admin_password',md5($admin_password));
        $query_result=$this->db2->get();
        $result=$query_result->row();
        return $result;
   }
    
    public function savephoto($data)
    {
            $this->db2->insert('tbl_photo',$data);
     }
   
     public function select_sliderphoto()
    {
     $this->db2->select('*');
     $this->db2->from('tbl_photo');
     $this->db2->where('category',1); 
     $this->db2->order_by('id','DESC'); 
      $this->db2->limit(7); 
     $query_result=$this->db2->get();
     $allcontent_info=$query_result->result();
     return $allcontent_info;
    }
    
    public function savecontentmessage($data)
    {            
        $this->db2->insert('message',$data);
        return $this->db2->insert_id();
    }
       public function savehonordata($data)
    {            
        $this->db2->insert('honor_board',$data);
        return $this->db2->insert_id();
    }
    
    public function savejobInfo($data)
    {            
        $this->db2->insert('career',$data);
        return $this->db2->insert_id();
    }
    
    
    public function saveacademiccontent($data)
    {            
        $this->db2->insert('academic',$data);
        return $this->db2->insert_id();
    }
    
  
    public function select_aboutInfoByCategory($data)
    {
        $this->db2->select('*');
        $this->db2->from('message');    
        $this->db2->where('category',$data['category']); 
        $this->db2->where('publication_status',1); 
        $this->db2->order_by('id','DESC');
         $this->db2->limit(1);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->row_array();
        return $allcontent_info;
    }
    
        public function select_abouthInfoByCategory($hdata)
    {
        $this->db2->select('*');
        $this->db2->from('message');    
        $this->db2->where('category',$hdata['category']); 
        $this->db2->where('publication_status',1); 
      //  $this->db2->order_by('id','DESC');
         $this->db2->limit(1);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
    
            public function pselect_aboutInfoByCategory($pmsg)
    {
        $this->db2->select('*');
        $this->db2->from('message');    
        $this->db2->where('category',$pmsg['category']); 
        $this->db2->where('publication_status',1); 
        $this->db2->order_by('id','DESC');
         $this->db2->limit(1);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->row_array();
        return $allcontent_info;
    }
    
       public function rulesselect_abouthInfoByCategory($rulesdata)
    {
        $this->db2->select('*');
        $this->db2->from('message');    
        $this->db2->where('category',$rulesdata['category']); 
       
        $this->db2->where('publication_status',1); 
      //  $this->db2->order_by('id','DESC');
         $this->db2->limit(1);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
    
           public function missionselect_abouthInfoByCategory($missiondata)
    {
        $this->db2->select('*');
        $this->db2->from('message');    
       
         $this->db2->where('category',$missiondata['category']); 
        $this->db2->where('publication_status',1); 
      //  $this->db2->order_by('id','DESC');
         $this->db2->limit(1);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
    
    
    public function select_AcademicInfoByCategory($data)
    {
       $this->db2->select('*');
        $this->db2->from('academic');    
        $this->db2->where('category',$data['category']); 
        $this->db2->where('publication_status',1); 
        $this->db2->order_by('id','DESC');
         $this->db2->limit(1);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->row_array();
        return $allcontent_info;
    }
    public function selectArray_AcademicInfoByCategory($data)
    {
       $this->db2->select('*');
        $this->db2->from('academic');    
        $this->db2->where('category',$data['category']); 
        $this->db2->where('publication_status',1); 
        $this->db2->order_by('id','DESC');
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
    
    public function select_NoticeBoard()
    {
        $this->db2->select('*');
        $this->db2->from('academic');    
        $this->db2->where('category',7); 
        $this->db2->order_by('id','DESC');
         $this->db2->limit(4);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
    
        public function select_UpcomingNotice($upnotice)
    {
        $this->db2->select('*');
        $this->db2->from('academic');    
        $this->db2->where('category',14); 
        
        $this->db2->order_by('id','DESC');
       
         $this->db2->limit(2);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
      public function select_UpcomingNoticedata($upnotice)
    {
        $this->db2->select('*');
        $this->db2->from('academic');    
        $this->db2->where('category',14); 
        
        $this->db2->order_by('id','DESC');
       
         $this->db2->limit(3);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
    
       public function getEmployeeInfo_byType($empcat){
         $this->db2->select('*');
        $this->db2->from('management');    
        $this->db2->where('bm_cat',1); 
       
         $this->db2->limit(3);
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
    
    public function select_boardMember()
    {
        $this->db2->select('*');
        $this->db2->from('management');    
        $this->db2->order_by('bm_post_value','ASC');
        $query_result=$this->db2->get();
        $allcontent_info=$query_result->result_array();
        return $allcontent_info;
    }
     public function select_memberinfo_by_id($id)
    {
     $this->db2->select('*');
     $this->db2->from('management');    
     $this->db2->where('bmId',$id);
     
     $query_result = $this->db2->get();
        $result = $query_result->row();
        return $result;
    }
    public function updatememberinfo($data,$id)
    {
      $this->db2->where('bmId',$id);
      $this->db2->update('management',$data);
      return $this->db2->affected_rows();  
     }
     public function deletemanagement($id)
    {
        $this->db2->where('bmId',$id);
        $this->db2->delete('management');
    }
    public function select_allmessage()
    {
     $this->db2->select('*');
     $this->db2->from('message'); 
     $this->db2->order_by('id','DESC'); 
     
     $query_result=$this->db2->get();
     $allcontent_info=$query_result->result();
     return $allcontent_info;
    }
    
    public function select_AllJobInfo()
    {
     $this->db2->select('*');
     $this->db2->from('career'); 
     $this->db2->order_by('ca_id','DESC'); 
     
     $query_result=$this->db2->get();
     $allcontent_info=$query_result->result();
     return $allcontent_info;
    }
    
    public function select_publishedJobInfo()
    {
     $this->db2->select('*');
     $this->db2->from('career'); 
     $this->db2->where('publication_status','1'); 
     $this->db2->order_by('ca_id','DESC'); 
     
     $query_result=$this->db2->get();
     $allcontent_info=$query_result->result_array();
     return $allcontent_info;
    }
    
     public function select_JobInfo_by_id($id)
    {
     $this->db2->select('*');
     $this->db2->from('career');    
     $this->db2->where('ca_id',$id);
     
     $query_result = $this->db2->get();
        $result = $query_result->row();
        return $result;
    }
    
    public function select_message_by_id($id)
    {
     $this->db2->select('*');
     $this->db2->from('message');    
     $this->db2->where('id',$id);
     
     $query_result = $this->db2->get();
        $result = $query_result->row();
        return $result;
    }
    
    public function updatecontentmessage($data,$id)
    {
      $this->db2->where('id',$id);
      $this->db2->update('message',$data);
      return $this->db2->affected_rows();  
     }
    
    public function deletecontentmessage($id)
    {
        $this->db2->where('id',$id);
        $this->db2->delete('message');
    }
    
    public function select_allacademicInfo()
    {
     $this->db2->select('*');
     $this->db2->from('academic'); 
     $this->db2->order_by('id','DESC'); 
     
     $query_result=$this->db2->get();
     $allcontent_info=$query_result->result();
     return $allcontent_info;
    }
    
    public function select_academicInfo_by_id($id)
    {
     $this->db2->select('*');
     $this->db2->from('academic');    
     $this->db2->where('id',$id);
     
     $query_result = $this->db2->get();
     $result = $query_result->row();
     return $result;
    }
    
    
    public function updateacademiccontent($data,$id)
    {
      $this->db2->where('id',$id);
      $this->db2->update('academic',$data);
      return $this->db2->affected_rows();  
     }
    
    public function deleteacademiccontent($id)
    {
        $this->db2->where('id',$id);
        $this->db2->delete('academic');
    }
    
     public function savemanagementmember($data)
    {
            
            $this->db2->insert($this->_management, $data);
            return $this->db2->insert_id(); 
        
    }
    
    public function select_allmemberlistBYCategory($data)
    {
        $this->db2->select('*');
        $this->db2->where('bm_cat',$data['bm_cat']);
        $qu = $this->db2->get($this->_management);
        return $qu->result_array();
    }
    
    public function select_memberlist_by_id($id) {
        $qu = $this->db2->get_where($this->_management, array('bmId' => $id));
        return $qu->row_array();
    }
    
    public function saveresult($data)
    {
            $this->db2->insert('resultsummery',$data);
     }
    public function select_allresultlist()
    {
        $this->db2->select('*');
        $this->db2->order_by('exam_year',"DESC");
        $qu = $this->db2->get($this->_resultsummery);
        return $qu->result_array();
    }
    public function select_resultlist_byID($id) {
        $qu = $this->db2->get_where($this->_resultsummery, array('rs_Id' => $id));
        return $qu->row_array();
    }
    public function updateresult($data,$id)
    {
      $this->db2->where('rs_Id',$id);
      $this->db2->update($this->_resultsummery,$data);
      return $this->db2->affected_rows();  
     }
    public function deleteresult($id){
        $qu = $this->db2->where('rs_Id', $id);
        $this->db2->delete($this->_resultsummery);
        return $this->db2->affected_rows();
        
    }
    public function select_all_photo()
    {
        $this->db2->select('*');
        $this->db2->order_by('id','DESC');
        $qu = $this->db2->get($this->_tbl_photo);
        return $qu->result_array();
    }
    public function select_limited_photo()
    {
        $this->db2->select('*');
        $this->db2->order_by('id','DESC');
        $this->db2->limit(60);
        $qu = $this->db2->get($this->_tbl_photo);
        return $qu->result_array();
    }
    
        public function select_gallery_photo($photogaldata)
    {
        $this->db2->select('*');
         $this->db2->where('category',$photogaldata['category']);
        $this->db2->order_by('id','DESC');
        $this->db2->limit(6);
        $qu = $this->db2->get($this->_tbl_photo);
        return $qu->result_array();
    }
    
     public function select_photo_by_id($id) {
         
        $qu = $this->db2->get_where($this->_tbl_photo, array('id' => $id));
        return $qu->row_array();
    }
    
    public function update_photo($data,$id){
         $qu = $this->db2->where('id', $id);
        $this->db2->update($this->_tbl_photo, $data);
        return $this->db2->affected_rows();
        
    }
     public function delete_photo_by_id($id){
        $qu = $this->db2->where('id', $id);
        $this->db2->delete($this->_tbl_photo);
        return $this->db2->affected_rows();
        
    }
       
    public function savecontact($data)
    {
            $this->db2->insert('contact',$data);
     }
    
    public function select_contact_details()
    {
        $this->db2->select('*');
        $this->db2->order_by('co_id','DESC');
        $this->db2->limit(1);
        $qu = $this->db2->get($this->_contact);
        return $qu->result_array();
    }
    public function select_contactlist()
    {
        $this->db2->select('*');
        $this->db2->order_by('co_id','DESC');
        $qu = $this->db2->get($this->_contact);
        return $qu->result_array();
    }
    public function select_contact_by_id($id) {
         
        $qu = $this->db2->get_where($this->_contact, array('co_id' => $id));
        return $qu->row_array();
    }
    
    public function updatecontact($data,$id){
        $this->db2->where('co_id', $id);
        $this->db2->update($this->_contact, $data);
        return $this->db2->affected_rows();
        
    }
     public function deletecontact($id){
        $qu = $this->db2->where('co_id', $id);
        $this->db2->delete($this->_contact);
        return $this->db2->affected_rows();
        
    }
    
     public function saveMeritStudent($data)
    {
        $this->db2->insert('meritious_student',$data);
        return $this->db2->insert_id();
     }
    public function select_meritlist()
    {
        $this->db2->select('*');
        $qu = $this->db2->get($this->_meritious_student);
        return $qu->result_array();
    }
    
    
    
     public function deletemeritlist($id){
        $qu = $this->db2->where('student_Id', $id);
        $this->db2->delete($this->_meritious_student);
        return $this->db2->affected_rows();
        
    }
       public function select_meritlist_byID($id) {
        $qu = $this->db2->get_where($this->_meritious_student, array('student_Id' => $id));
        return $qu->row_array();
    }
    
      public function updatemerit($data,$id)
    {
      $this->db2->where('student_Id',$id);
      $this->db2->update($this->_meritious_student,$data);
      return $this->db2->affected_rows();  
     }


       public function select_allhonormember()
    {
        $this->db2->select('*');
        $qu = $this->db2->get($this->_honor_board);
        return $qu->result_array();
    }
    
        public function select_honor_by_id($id)
    {
     $this->db2->select('*');
     $this->db2->from('honor_board');    
     $this->db2->where('honor_id',$id);
     
     $query_result = $this->db2->get();
        $result = $query_result->row();
        return $result;
    }

        public function updatehonorcontent($data, $id) {
        $this->db2->where('honor_id', $id);
        $this->db2->update($this->_honor_board, $data);
        return $this->db2->affected_rows();
    }
    
       public function deletehonormember($id)
    {
        $this->db2->where('honor_id',$id);
        $this->db2->delete('honor_board');
    }
    
        public function ophonorlist($pnc)
    {
      $this->db2->select('*');
        $qu = $this->db2->get($this->_honor_board);
        return $qu->result_array();
    }
    
    public function phonorlist()
    {
     $this->db2->select('*');
     $this->db2->where('category',1); 
        $qu = $this->db2->get($this->_honor_board);
        return $qu->result_array();
    }

    public function alldonormember()
    {
     $this->db2->select('*');
     $this->db2->where('category',0); 
        $qu = $this->db2->get($this->_honor_board);
        return $qu->result_array();
    }

    public function prehonorlist()
    {
        $this->db2->select('*');
        $this->db2->where('category',2); 
        $qu = $this->db2->get($this->_honor_board);
        return $qu->result_array();
    }
    
    public function honor_info_byid($id)
    {
        $this->db2->select('*');
        $this->db2->from('honor_board');
        $this->db2->where('honor_id',$id);
        $qu = $this->db2->get();
        return $qu->row_array();
    }
    
}

?>