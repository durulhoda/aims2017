<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Result_model_admin extends CI_Model{
    public $subj = 1;
    public $obj = 2;
    public $prti = 3;
    public $sba = 4;
    public function __construct() {
        parent::__construct();
    }

    public function getInstituteInfo()
    {
        $record = $this->db
            ->select('
                        TRIM(i.instituteName) AS institute_name,
                        CONCAT(TRIM(i.town),", ",TRIM(i.city),", ",TRIM(d.name_en)) AS address,
                        i.logo
                        ',false)
            ->from('institute AS i')
            ->join('districts AS d','i.district = d.id','left')
            ->get()
            ->row();
        return $record;
    }

    public function get_publish_status($student_id,$semester_id,$program_offer_id)
    {
        $result['result_status']=false;
        $this->db->select('result_status');
        $this->db->from('publishedresult');
        $this->db->where('studentId',$student_id);
        $this->db->where('semesterId',$semester_id);
        $this->db->where('programOfferId',$program_offer_id);
        $result=$this->db->get()->row_array();
        return $result['result_status'];
    }

    public function getStudentInfo($stuent_id = 0)
    {
        $record = $this->db
            ->select('
                        s.studentId,
                        si.firstName,
                        si.photo
                        ',false)
            ->from('student AS s')
            ->join('studentinfo si', 'si.applicationId = s.applicationId')
            ->where('studentId', $stuent_id)
            ->get()
            ->row();
        return $record;
    }

    public function get_Program_offer_Id($id)
    {
        $this->db->select('p.programOfferId');
        $this->db->from('promotedstudent p');
        $this->db->where('p.studentId',$id);
        $this->db->order_by('p.promotionId',"DESC");
        return $this->db->get()->row_array();
    }

    public function get_roll_no($id)
    {
        $this->db->select('p.roll_no');
        $this->db->from('promotedstudent p');
        $this->db->where('p.studentId',$id);
        $result=$this->db->get()->row_array();
        return $result;
    }

    public function getProgramInfo($program_offer_id = 0)
    {
        $record = $this->db
            ->select('
                        p.programName AS program_name,
                        g.groupName AS group_name,
                        sh.shiftName AS shift_name,
                        se.sectionName AS section_name,
                        ses.session AS session_name
                        ',false)
            ->from('programoffer AS pgo')
            ->join('program AS p', 'p.programId = pgo.programId')
            ->join('group AS g','pgo.groupId = g.groupId')
            ->join('shift AS sh','pgo.shiftId = sh.shiftId')
            ->join('section AS se', 'pgo.sectionId = se.sectionId')
            ->join('session As ses','pgo.sessionId = ses.sessionId')
            ->where('programofferId',$program_offer_id)
            ->get()
            ->row();
        return $record;
    }
////hgjhgjhgjhgjhgj
    public function getStudentResult($student_id = 0, $program_offer_id = 0, $semester_id = 0)
    {
        //$records = $this->getAssignCourse($student_id, $program_offer_id, $semester_id);
        $where = [];
        if ($student_id) {
            $where['stdm.studentId'] = $student_id;
        }
        if ($program_offer_id) {
            $where['stdm.programOfferId'] = $program_offer_id;
        }
        if ($semester_id) {
            $where['stdm.semesterId'] = $semester_id;
        }
        $records = $this->db
            ->select('
                        stdm.courseId AS course_id,
                        c.courseName AS course_name,
                        c.courseCode AS course_code,
                        stdm.divide_mark,
                        co.marks AS full_mark,
                        pgo.programLevel AS program_level,
                        md.mark_cat_id,
                        md.divide_mark AS define_mark,
                        md.mark_percent
                        ')
            ->from('studentmarks AS stdm')
            ->join('course AS c', 'stdm.courseId = c.courseId')
            ->join('programoffer AS pgo', 'stdm.programOfferId = pgo.programOfferId')
            ->join('courseoffer AS co','stdm.courseId = co.courseId AND co.programOfferId = '.$program_offer_id.'')
            ->join('mark_divide AS md','co.offerId = md.course_offerId')
            ->where($where)
            ->order_by('c.courseCode')
            ->get()
            ->result();
        //echo "<pre>";print_r($records);exit;
        //              echo "<pre>";print_r($records1);die();
        // print_r($this->db->last_query($records));exit;
        $result = $this->rma->getStudentResultList($records,  $student_id, $program_offer_id, $semester_id);
        //echo "<pre>";print_r($result);die();
        return $result;
    }

    public function getStudentResultList($records = [], $student_id = 0, $program_offer_id = 0, $semester_id = 0)
    {
        // echo 'hi';
        //echo '<pre>';print_r($records);exit;
        $data = [];
        $count = count($records);
        $merge_count = 1;
        $merge_result = $this->getMergeResult($records, $program_offer_id);
        // print_r($count);exit;
        //echo '<pre>'; print_r($merge_result);
        //print_r($merge_result['ob_mark'][5]);
        // echo "<pre>";print_r($merge_result);die();
        for ($i = 0; $i<$count; $i++) {
            $cal_mark = $this->getCalculateMark($records[$i], $i); //here we have to check Tanay
            if ($merge_result) {
                $merge_count = $this->getMergeCount($records[$i]->course_id, $program_offer_id, $student_id, $semester_id);
            }
            // if ($i == 0) {
            //     $cal_mark;exit;
            // }
            if ($records[$i]->full_mark == 100) {
                $total_mark = ($cal_mark['total_mark'] > 100) ? 100 : $cal_mark['total_mark'];
            }
            if ($records[$i]->full_mark == 50) {
                $total_mark = ($cal_mark['total_mark'] > 50) ? 50 : $cal_mark['total_mark'];
            }

//            echo $total_mark;exit;

            $course_status = $this->getCourseStatus($records[$i]->course_id, $student_id, $program_offer_id, $i);
            $merge_course = $this->getMergeSubjectName($records[$i]->course_id, $program_offer_id);
            $merge_id = isset($merge_course['merge_id']) ? $merge_course['merge_id'] : 0;
            $merge_mark = isset($merge_result['ob_mark'][$merge_id]) ? $merge_result['ob_mark'][$merge_id]: '';
            $merge_mark_dm = isset($merge_result['ob_mark_dm'][$merge_id]) ? $merge_result['ob_mark_dm'][$merge_id]: '';
            $m_total_mark = isset($merge_result['m_total_mark'][$merge_id]) ? $merge_result['m_total_mark'][$merge_id]: 0;
            $gpa = $this->getStudentGpa($total_mark, $records[$i],$merge_mark,$merge_mark_dm, $m_total_mark, $i);
            // if ($i == 3) {
            //     print_r($merge_mark);
            // }
            //var_dump((float)$cal_mark['ob_mark']);

            $data[] = [
                'course_name' => $records[$i]->course_name,
                'course_code' => $records[$i]->course_code,
                'course_id' => $records[$i]->course_id,
                'full_mark' => $records[$i]->full_mark,
                'cal_mark' => $cal_mark['ob_mark'],
                'total_mark' => $total_mark,
                'merge_id' => $merge_id,
                'merge_count' => $merge_count,
                'merge_course_name' => isset($merge_course['merge_course_name']) ? $merge_course['merge_course_name'] : '',
                'gpa_point' => isset($gpa['gpa_point']) ? $gpa['gpa_point'] : 0,
                'gpa_letter' => isset($gpa['gpa_letter']) ? $gpa['gpa_letter'] : 'F',
                'course_status' => $course_status,
                'divide_mark' => $records[$i]->divide_mark,
                'define_mark' => $records[$i]->define_mark,
                'mark_percent' => $records[$i]->mark_percent,
            ];
        }
        $result['record'] = $data;
        $result['total'] = $this->getSTotalResult($data, $student_id, $program_offer_id);
        //echo '<pre>';print_r($result);die();
        //echo '<pre>';print_r($data);exit;
        //echo '<pre>';print_r($result);exit;
        return $result;
    }

    private function getMergeCount($course_id = 0, $program_offer_id = 0, $stuent_id = 0, $semester_id = 0)
    {
        $merge_id = 0;
        $where = [];
        if ($program_offer_id) {
            $where['m.programOfferId'] = $program_offer_id;
        }        if ($course_id) {
        $where['mc.course_id'] = $course_id;
    }
        $row = $this->db
            ->select('
                        mc.merge_id
                        ')
            ->from('merge AS m')
            ->join('merge_course AS mc', 'm.id = mc.merge_id')
            ->where($where)
            ->get()
            ->row();
        if ($row) {
            $merge_id = $row->merge_id;
        }
        $mer_course = [];
        $mer_courses = $this->db
            ->select('course_id')
            ->where('merge_id', $merge_id)
            ->get('merge_course')
            ->result();
        foreach ($mer_courses as $key => $val) {
            $mer_course[$key] = $val->course_id;
        }
        $c = 1;
        if ($mer_course) {
            $m_count = $this->db
                ->select('count(courseId) AS count')
                ->where('programOfferId', $program_offer_id)
                ->where('studentId', $stuent_id)
                ->where('semesterId', $semester_id)
                ->where_in('courseId', $mer_course)
                ->get('studentmarks')
                ->row();
            if ($m_count){
                $c = $m_count->count;
            }
        }

        return $c;
    }

    public function getMergeResult($records = [], $program_offer_id = 0) {
        //echo '<pre>'; print_r($records);
        $data = [];
        $count = count($records);
        $merge = [];
        $result = [];
        $result_dm = [];
        $ssum = 0;
        for ($i = 0; $i<$count; $i++) {
            $merge_course = $this->getMergeSubjectName($records[$i]->course_id, $program_offer_id);
            if ($merge_course) {
                //$full_mark
                $s = $this->getMergeCalculate($records[$i], $this->subj);
                $o = $this->getMergeCalculate($records[$i], $this->obj);
                $p = $this->getMergeCalculate($records[$i], $this->prti);
                $sba = $this->getMergeCalculate($records[$i], $this->sba);
                $data[] = [
                    'merge_id' => isset($merge_course['merge_id']) ? $merge_course['merge_id'] : 0,
                    's' => $s['mark'],
                    'o' => $o['mark'],
                    'p' => $p['mark'],
                    'sba' => $sba['mark'],
                    's_dm' => $s['m_define_mark'],
                    'o_dm' => $o['m_define_mark'],
                    'p_dm' => $p['m_define_mark'],
                    'sba_dm' => $sba['m_define_mark'],
                    'mark_cat_id' => $records[$i]->mark_cat_id,
                    'm_full_mark' => $records[$i]->full_mark
                ];
            }
        }

        //echo '<pre>';print_r($data);

        foreach ($data as $key => $val) {
            if (isset($merge[$val['merge_id']])) {
                $merge[$val['merge_id']]['s'] += $val['s'];
                $merge[$val['merge_id']]['o'] += $val['o'];
                $merge[$val['merge_id']]['p'] += $val['p'];
                $merge[$val['merge_id']]['sba'] += $val['sba'];
                $merge[$val['merge_id']]['s_dm'] += $val['s_dm'];
                $merge[$val['merge_id']]['o_dm'] += $val['o_dm'];
                $merge[$val['merge_id']]['p_dm'] += $val['p_dm'];
                $merge[$val['merge_id']]['sba_dm'] += $val['sba_dm'];
                $merge[$val['merge_id']]['m_full_mark'] += $val['m_full_mark'];
            } else {
                $merge[$val['merge_id']]= [
                    'merge_id' => $val['merge_id'],
                    's' => $val['s'],
                    'o' => $val['o'],
                    'p' => $val['p'],
                    'sba' => $val['sba'],
                    's_dm' => $val['s_dm'],
                    'o_dm' => $val['o_dm'],
                    'p_dm' => $val['p_dm'],
                    'sba_dm' => $val['sba_dm'],
                    'mark_cat_id' => $val['mark_cat_id'],
                    'm_full_mark' => $val['m_full_mark']
                ];
            }
        }

        //echo '<pre>'; print_r($merge);
        $mresult = [];

        foreach ($merge as $key => $row) {


            //
            if ($key) {
                $mark_cat = explode(',', substr($row['mark_cat_id'], 1, -1));

                $s = $this->defineCheck($mark_cat, $this->subj);
                $s = ($s) ? $row['s']."," : '';
                $s_dm = ($s) ? $row['s_dm']."," : '';

                $o = $this->defineCheck($mark_cat, $this->obj);
                $o = ($o) ? $row['o']."," : '';
                $o_dm = ($o) ? $row['o_dm']."," : '';

                $p = $this->defineCheck($mark_cat, $this->prti);
                $p = ($p) ? $row['p']."," : '';
                $p_dm = ($p) ? $row['p_dm']."," : '';

                $sba = $this->defineCheck($mark_cat, $this->sba);
                $sba = ($sba) ? $row['sba']."," : '';
                $sba_dm = ($sba) ? $row['sba_dm']."," : '';

                $re = $s.$o.$p.$sba;
                $ch = substr($re, -1);
                $re = ($ch == ',') ? substr($re, 0, -1): $re;

                $re_dm = $s_dm.$o_dm.$p_dm.$sba_dm;
                $ch_dm = substr($re_dm, -1);
                $re_dm = ($ch_dm == ',') ? substr($re_dm, 0, -1): $re_dm;

                $result[$row['merge_id']] = $re;
                $result_dm[$row['merge_id']] = $re_dm;
                $mresult[$row['merge_id']] = $row['m_full_mark'];
            }
        }
        $arr = [];
        $arr = [
            'ob_mark' => $result,
            'ob_mark_dm' => $result_dm,
            'm_total_mark' => $mresult
        ];

        // $k = "1111,1,";
        // $j = substr($k, -1);
        // if ($j == ',') {
        //     $k = substr($k, 0, -1);
        // }
        // print_r($k);
        // echo '<pre>';print_r($arr);
        return $arr;
    }

    private function defineCheck($cat = [], $type)
    {
        $r = false;
        if( in_array( $type ,$cat ) )
        {
            $r = true;
        }
        return $r;
    }

    private function getMergeCalculate($record, $type){
        $result = [];
        $mark = 0;
        $m_define_mark = 0;
        $mark_cat = explode(',', substr($record->mark_cat_id, 1, -1));
        $result_mark = explode(',', substr($record->divide_mark, 1, -1));
        $percent_mark = explode(',', substr($record->mark_percent, 1, -1));
        $define_mark = explode(',', substr($record->define_mark, 1, -1));
        if ($mark_cat) {
            $length = count($mark_cat);
            for ($i = 0; $i < $length; $i++)
            {
                $r_mark = isset($result_mark[$i]) ? $result_mark[$i] : 0;
                $d_mark = isset($define_mark[$i]) ? $define_mark[$i] : 0;
                //$r_mark = ($record->full_mark == 100) ? $r_mark : ($r_mark * 2);
                $marks = $this->getCalculateResult($r_mark, $percent_mark[$i]);
                $m_define_marks = $this->getCalculateResult($d_mark, $percent_mark[$i]);
                // $m_dif_marks = ($r_mark - $marks);
                if ($mark_cat[$i] == $type)
                {
                    $mark = $marks;
                    $m_define_mark = $m_define_marks;
                }
            }
        }

        return $result = ['mark' => $mark, 'm_define_mark' => $m_define_mark];
    }

    private function getMergeSubjectName($course_id = 0, $program_offer_id = 0)
    {
        $merge_course_name  = [];
        $record = $this->db
            ->select('m.merge_course_name,m.id')
            ->from('merge AS m')
            ->join('merge_course AS mc','m.id = mc.merge_id')
            ->where('m.programOfferId', $program_offer_id)
            ->where('mc.course_id', $course_id)
            ->get()
            ->row();
        if ($record) {
            $merge_course_name = ["merge_id" => $record->id ,"merge_course_name" => $record->merge_course_name];
        }

        return $merge_course_name;
    }
///////jhgjhgjhgjhgjhgjh
    private function getCalculateMark($record, $k)  //Tanay
    {
        $result = [];
        $or_result = "";
        $total_mark = 0;
        $mark_cat = explode(',', substr($record->mark_cat_id, 1, -1));
        $result_mark = explode(',', substr($record->divide_mark, 1, -1));
        $percent_mark = explode(',', substr($record->mark_percent, 1, -1));
        // echo '<pre>'; print_r($mark_cat);die();
        // if ($k == 0) {
        //     print_r($percent_mark);
        // }
        if ($mark_cat) {
            $length = count($mark_cat);
            for ($i = 0; $i < $length; $i++)
            {
                $r_mark = isset($result_mark[$i]) ? $result_mark[$i] : 0;

                $record = $this->getCalculateResult($r_mark, $percent_mark[$i]);
                // }
                if ($mark_cat[$i] == $this->subj)
                {
                    $or_result .= "C:".$record." ";
                } elseif ($mark_cat[$i] == $this->obj) {
                    $or_result .= "O:".$record." ";
                } elseif ($mark_cat[$i] == $this->prti) {
                    $or_result .= "P:".$record." ";
                } elseif ($mark_cat[$i] == $this->sba) {
                    $or_result .= "S:".$record." ";
                }
                $total_mark += (float)$record;
                //echo "<pre>";print_r($total_mark);die();
            }
        }
        $result = ['ob_mark' => $or_result, 'total_mark' => $total_mark];
        // echo "<pre>";print_r($result);die();
        return $result;
    }

    private function getCourseStatus($course_id = 0, $student_id = 0, $program_offer_id = 0, $i = 0)
    {
        $course_status = 0;
        $where = [];
        if ($student_id) {
            $where['studentId'] = $student_id;
        }
        if ($program_offer_id) {
            $where['programOfferId'] = $program_offer_id;
        }
        $record = $this->db
            ->select('courseId, courseStatus')
            ->where($where)
            ->get('studentassigncourse')
            ->row();
        if ($record) :

            $num = count($record->courseId);
            for($x=0;$x<$num;$x++)
            {
                if($record->courseId[$x]!=',')
                {
                    $record->courseId = ','.$record->courseId;
                }
            }

            $num1 = count($record->courseStatus);
            for($x=0;$x<$num1;$x++)
            {
                if($record->courseStatus[$x]!=',')
                {
                    $record->courseStatus = ','.$record->courseStatus;
                }
            }

            $course_ids = explode(',', substr($record->courseId, 1, -1));
            $course_statuses = explode(',', substr($record->courseStatus, 1, -1));

            $length = count($course_ids);
            for ($i = 0; $i < $length; $i++)
            {
                if ($course_ids[$i] == $course_id)
                {
                    $course_status = $course_statuses[$i];
                }
            }
        endif;
        return $course_status;
    }

    private function getStudentGpa($marks = 0, $record = [], $merge_mark= '', $merge_marks_dm = '', $m_total_mark = 0, $i) {

        $full_mark = $record->full_mark;
        $program_level = $record->program_level;

        $marks = ($merge_mark) ? array_sum(explode(',', $merge_mark)) : $marks;

        // if ($merge_mark && $program_level == 3) {
        //    $marks = (($marks*100)/$m_total_mark);
        // } else {
        //      $marks = ($this->checkMark($record, $merge_mark,$i)) ? $marks: 1;

        //      if ($merge_mark && $marks > 1) {
        //         $marks = (($marks*100)/$m_total_mark);
        //      }
        // }
        $marks = ($this->checkMark($record, $merge_mark, $merge_marks_dm, $i)) ? $marks: 1;
        if ($merge_mark && $marks > 1) {
            $marks = (($marks*100)/$m_total_mark);
        }
        if (!$merge_mark) {
            $marks = ($full_mark == 100) ? $marks : ($marks*2);
        }

        // if ($i == 0) {
        //     print_r($marks);
        // }
        $gpa = $this->getGpa((float)$marks);
        // if ($record->course_id == 31){
        //     print_r($marks);
        //  }
        // if ($i == 1) {
        //     print_r($full_mark);
        // }
        return $gpa;
    }

    private function getGpa($marks = 0)
    {
        //var_dump($marks);
        $marks = ($marks <= 0) ? 1 : $marks;
        switch ($marks) {
            case $marks >= 80 && $marks <= 100:
                $gpa_point = 5;
                $gpa_letter= 'A+';
                break;
            case $marks >= 70 && $marks <=79.99:
                $gpa_point = 4;
                $gpa_letter= 'A';
                break;
            case $marks >= 60 && $marks <=69.99:
                $gpa_point = 3.5;
                $gpa_letter= 'A-';
                break;
            case $marks >= 50 && $marks <=59.99:
                $gpa_point = 3;
                $gpa_letter= 'B';
                break;
            case $marks >= 40 && $marks <=49.99:
                $gpa_point = 2;
                $gpa_letter= 'C';
                break;
            case $marks >= 33 && $marks <=39.99:
                $gpa_point = 1;
                $gpa_letter= 'D';
                break;
            case $marks <= 32:
                $gpa_point = 0;
                $gpa_letter= 'F';
                break;
            default :
                $gpa_point = 0;
                $gpa_letter = 'F';
        }
        return $gpa = ['gpa_point' => $gpa_point, 'gpa_letter' => $gpa_letter];
    }

    private function checkMark($record = [], $merge_marks = '', $merge_marks_dm = '', $j)
    {
        // print_r($i);

        $mark = '';
        $result = true;
        $merge_arr = [];
        $merge_sum = 0;
        $mark_cat = explode(',', substr($record->mark_cat_id, 1, -1));
        $result_mark = explode(',', substr($record->divide_mark, 1, -1));
        $percent_mark = explode(',', substr($record->mark_percent, 1, -1));
        $define_mark = explode(',', substr($record->define_mark, 1, -1));
        $merge_mark = explode(',', $merge_marks);
        $merge_mark_dm = explode(',', $merge_marks_dm);
        //  print_r($merge_mark);
        // if ($j == 2){
        //     print_r($merge_mark);
        // }


        $program_level = $record->program_level;
        if ($mark_cat) {
            $length = count($mark_cat);
            for ($i = 0; $i < $length; $i++)
            {
                $r_mark = isset($result_mark[$i]) ? $result_mark[$i] : 0;

                $mark_obtained = $this->getCalculateResult($r_mark, $percent_mark[$i]);
                $dif_mark = $this->getCalculateResult($define_mark[$i], $percent_mark[$i]);

                if ($merge_marks && $program_level == 4) {
                    // if ($j == 2 && $i == 0)
                    //     {
                    //         print_r($define_mark[$i]);
                    //     }
                    $mark_cal = $this->markCal($merge_mark[$i], $merge_mark_dm[$i]);
                    $mark .= $mark_cal;
                } elseif ($program_level == 4) {

                    $mark_cal = $this->markCal($mark_obtained, $dif_mark);
                    $mark .= $mark_cal;
                }
                if ($mark_cat[$i] == $this->sba) {
                    $mark_cal = $this->markCal($mark_obtained, $dif_mark);
                    $mark .= $mark_cal;
                }
            }
        }

        if (preg_match('/2/',$mark)){
            $result = false;
        }
        //  if($j == 2) {
        //     print_r($mark);
        // }
        // if ($record->course_id == 33){
        //    print_r($mark);
        // }
        return $result;
    }

    private function markCal($mark_obtained = 0, $define_mark = 0)
    {
        $cal = 1;
        $cal_mark = (($mark_obtained*100)/$define_mark);
        if ($cal_mark <= 32) {
            $cal = 2;
        }
        return $cal;
    }

    private function getCalculateResult($result = 0, $percent = 100)
    {
        if (!$percent) {
            $percent = 100;
        }
        return ceil(($result*$percent)/100);
    }

    private function getSTotalResult($data = [], $student_id = 0, $program_offer_id = 0) {
        //echo '<pre>';print_r($data);exit;
        $merge = [];
        $total_marks = 0;
        $total_obtain_marks = 0;
        $gpa_point = 0;
        $gpa_letter = '';
        $result_comment = '';
        $course_count = 0;
        if ($data) {
            $subject_count = 0;
            $comon_gpa = 0;
            $comon_count = 0;
            $merge_gpa = 0;
            $merge_count = 0;
            $total_gpa = 0;
            $optional_gpa = 0;
            $re = '';
            $gpa_check = true;
            $tot_fail_subj = 0;
            $com_fail_subj = 0;
            $mer_fail_subj = 0;
            $op_fail_subj = 0;
            $common_full = 0;
            $common_final = 0;
            $total_marks = $this->getAssignTotalMark($student_id, $program_offer_id);

//            echo '<pre>';
//            print_r($total_marks);
//            print_r($data);exit;

            foreach ($data as $key => $val) {

                if($val['course_status']==1)
                {
                    $common_final = $common_final + $val['total_mark'];
                    $common_full = $common_full + intval($val['full_mark']);
                }
                if($val['course_status']==2)
                {
                    if($val['total_mark']>40)
                    {
                        $common_final = $common_final + ($val['total_mark']-40);
                    }
                }

                if ($val['merge_id']) {
                    $merge[$val['merge_id']] = isset($merge[$val['merge_id']]) ? 1 : 2;
                }
                //$total_marks += $val['full_mark'];
                $total_obtain_marks += $val['total_mark'];

                if (($val['course_status'] == 1 || $val['course_status'] == 3) && !$val['merge_id']) {
                    $comon_gpa += $val['gpa_point'];
                    $comon_count++;
                    if ($val['gpa_point'] == 0) $com_fail_subj++;
                }

                if ($val['merge_id'] && $merge[$val['merge_id']] == 2) {
                    $merge_gpa += $val['gpa_point'];
                    $merge_count++;
                    if ($val['gpa_point'] == 0) $mer_fail_subj++;
                }

                if ($val['course_status'] == 2) {
                    $optional_gpa += $val['gpa_point'];
                    $optional_gpa = ($optional_gpa <= 2)? 0 : ($optional_gpa - 2);
                    if ($val['gpa_point'] == 0) $op_fail_subj++;
                }

                $subject_count = ($comon_count + $merge_count);
                $total_gpa = ($comon_gpa + $merge_gpa);
                /*    check point */

                if ($val['course_status'] == 1 || $val['course_status'] == 3) {
                    $re .= ($val['gpa_point'] == 0) ? 2 : 1;
                    if (preg_match('/2/',$re)){
                        $gpa_check = false;
                    }
                }
                // if ($key == 0) {
                //     print_r($val['gpa_point']);
                //  }
                $gpa_point = round((($total_gpa + $optional_gpa)/$subject_count), 2);
                $dd = round(($total_gpa/$subject_count), 2);
                $gpa_point = ($gpa_check) ? $gpa_point : 0;
                $tot_fail_subj = ($com_fail_subj + $mer_fail_subj + $op_fail_subj);
            }
            $gpa_point = ($gpa_point > 5) ? 5 :$gpa_point;
            $gpa_letter = $this->getTotalGrade((float)$gpa_point);
            $result_comment = $this->getResultComment((float)$gpa_point);
        }
        if ($gpa_point) {
            if ($total_marks['course_count'] > $comon_count)
            {
                $gpa_point = 0.00;
                $gpa_letter = "F";
            }
        }
        //echo $total_marks['total_marks'];exit;

        return ['student_id' => $student_id, 'total_marks' => $total_marks['total_marks'], 'total_obtain_marks' => $total_obtain_marks, 'total_common_marks' => $common_full, 'total_obtain_common_marks' => $common_final, 'gpa_point' => $gpa_point, 'gpa_letter' => $gpa_letter, 'result_comment' => $result_comment,'tot_fail_subj' => $tot_fail_subj,'tot_op_fail_sub' => $op_fail_subj,'program_offer_id' => $program_offer_id];
    }

    private function getAssignTotalMark($studentId = 0, $programofferId = 0)
    {
        $total_marks = 0;
        $course_count = 0;
        $arr = [];
        $record = $this->db
            ->where('studentId', $studentId)
            ->where('programofferId', $programofferId)
            ->get('studentassigncourse')
            ->row();
        if ($record) {


            $num = count($record->courseId);
            for($x=0;$x<$num;$x++)
            {
                if($record->courseId[$x]!=',')
                {
                    $record->courseId = ','.$record->courseId;
                }
            }

            $num1 = count($record->courseStatus);
            for($x=0;$x<$num1;$x++)
            {
                if($record->courseStatus[$x]!=',')
                {
                    $record->courseStatus = ','.$record->courseStatus;
                }
            }


            $course_marks = $this->getCourseMark($programofferId);
            $course_ids = explode(',', substr($record->courseId, 1, -1));
            $course_status = explode(',', substr($record->courseStatus, 1, -1));
            $merge_course_id = $this->getMergeCourseId($programofferId);
            $length = count($course_ids);
            for ($i = 0; $i < $length; $i++)
            {
                $course_id = (isset($course_ids[$i]) ? $course_ids[$i] : 0);
                $merge_id = isset($merge_course_id[$course_id]) ? $merge_course_id[$course_id] : 0;
                $total_marks += (isset($course_marks[$course_id]) ? $course_marks[$course_id] : 0);
                if (($course_status[$i] == 1 || $course_status[$i] == 3) && !$merge_id)
                {
                    $course_count++;
                }

            }
        }
        return $arr = ['total_marks' => $total_marks,'course_count' => $course_count];
    }

    private function getCourseMark($programOfferId = 0)
    {
        $arr = [];
        $records = $this->db
            ->where('programOfferId', $programOfferId)
            ->get('courseoffer')->result();
        if ($records) {
            foreach ($records as $key => $val) {
                $arr[$val->courseId] = (float)$val->marks;
            }
        }
        return $arr;
    }

    private function getMergeCourseId($programOfferId = 0) {
        $arr = [];
        $records = $this->db
            ->from('merge AS m')
            ->join('merge_course As mc','m.id = mc.merge_id')
            ->where('m.programOfferId', $programOfferId)
            ->get()
            ->result();
        if ($records) {
            foreach ($records as $key => $val) {
                $arr[$val->course_id] = $val->course_id;
            }
        }
        return $arr;
    }

    private function getTotalGrade($gpa = 0)
    {
        if($gpa >= 5 ){
            return 'A+';
        }
        elseif($gpa >= 4 && $gpa < 5 ){
            return 'A';
        }
        elseif($gpa >= 3.5 && $gpa < 4 ){
            return 'A-';
        }
        elseif($gpa >= 3 && $gpa < 3.5){
            return 'B';
        }
        elseif($gpa >= 2 && $gpa < 3 ){
            return 'C';
        }
        elseif($gpa >= 1 && $gpa < 2){
            return 'D';
        }
        else
            return 'F';
    }

    private function getResultComment($gpa = 0)
    {
        if($gpa >= 5 ){
            return 'Excellent Result';
        }
        elseif($gpa >= 4 && $gpa < 5 ){
            return 'Very Good Result';
        }
        elseif($gpa >= 3.5 && $gpa < 4 ){
            return 'Keep Trying Better';
        }
        elseif($gpa >= 3 && $gpa < 3.5){
            return 'Try Hard Work';
        }
        elseif($gpa >= 2 && $gpa < 3 ){
            return 'Result Not Good';
        }
        elseif($gpa >= 1 && $gpa < 2){
            return 'Below Average Result';
        }
        else
            return 'Fail';
    }


    private function getAllStuent($program_offer_id = 0, $semester_id = 0)
    {
        $where = [];

        if ($program_offer_id) {
            $where['stdm.programOfferId'] = $program_offer_id;
        }
        if ($semester_id) {
            $where['stdm.semesterId'] = $semester_id;
        }
        $records = $this->db
            ->select('
                        stdm.studentId AS student_id,
                        si.firstName AS student_name
                        ')
            ->from('studentmarks AS stdm')
            // ->join('studentinfo AS s','stdm.studentId = s.')
            ->join('student AS s', 'stdm.studentId = s.studentId','left')
            ->join('studentinfo AS si', 's.applicationId = si.applicationId','left')
            ->where($where)
            ->group_by('stdm.studentId')
            ->get()
            ->result();
        return $records;
    }

    private function getAllStudentResultInfo($program_offer_id = 0, $semester_id = 0)
    {
        $std_info = [];
        $all_student = $this->getAllStuent($program_offer_id, $semester_id);
        foreach ($all_student as $key => $val) {
            $result_info = $this->getStudentResult($val->student_id, $program_offer_id, $semester_id);
//            echo '<pre>';
//            print_r($result_info);exit;
            $common=0;
            foreach($result_info['record'] as $item)
            {
                if($item['course_status']==1)
                {
                    $common = $common + $item['total_mark'];
                }
                if($item['course_status']==2)
                {
                    if($item['total_mark']>40)
                    {
                        $common = $common + ($item['total_mark']-40);
                    }
                }
            }

            $fail_sub = ($result_info['total']['tot_fail_subj'] - $result_info['total']['tot_fail_subj']);
            $std_info[] = [
                'student_id' => $val->student_id,
                'student_name' => $val->student_name,
                'total_marks' => $result_info['total']['total_marks'],
                'total_obtain_marks' => $result_info['total']['total_obtain_marks'],
                'total_obtain_common_marks' => $common,
                'gpa_point' => $result_info['total']['gpa_point'],
                'gpa_letter' => $result_info['total']['gpa_letter'],
                'tot_op_fail_sub' => $result_info['total']['tot_op_fail_sub'],
                'tot_fail_subj' => $result_info['total']['tot_fail_subj'],
                'tot_cal_fail_subj' => ($fail_sub < 0) ? 0 : $fail_sub
            ];
        }

        return $std_info;
    }

    public function getStudentResultInfo($program_offer_id = 0, $semester_id = 0)
    {
        // print_r($semester_id);exit;
        $result_info = $this->getAllStudentResultInfo($program_offer_id, $semester_id);
//        echo '<pre>';
//        print_r($result_info);exit;
        foreach ($result_info as $m_key => $row) {
            $fail[$m_key]  = $row['tot_cal_fail_subj'];
            $gpa[$m_key] = $row['gpa_point'];
            $mark[$m_key] = $row['total_obtain_common_marks'];
        }
        if ($result_info) {
            array_multisort($fail, SORT_ASC, $gpa, SORT_DESC, $mark, SORT_DESC, $result_info);
        }

        $arr = [];
        if ($result_info) {
            foreach ($result_info as $k => $v) {
                $arr[$v['student_id']] = [
                    'student_id' => $v['student_id'],
                    'student_name' => $v['student_name'],
                    'position' => $k+1,
                    'total_marks' => $v['total_marks'],
                    'total_obtain_marks' => $v['total_obtain_marks'],
                    'gpa_point' => $v['gpa_point'],
                    'gpa_letter' => $v['gpa_letter'],
                    'tot_op_fail_sub' => $v['tot_op_fail_sub'],
                    'tot_fail_subj' => $v['tot_fail_subj'],
                    'tot_cal_fail_subj' => $v['tot_cal_fail_subj']
                ];
            }
        }
        //echo '<pre>';print_r($arr);
        return $arr;
    }
//jhgjhgjhg
    public function generate_transcript($programOfferId = 0, $semesterId = 0)
    {
        $position =  $this->getStudentResultInfo($programOfferId, $semesterId);
      // echo '<pre>';print_r($position);exit;
        $records = $this->db
            ->select('studentId')
            ->where('programOfferId', $programOfferId)
            ->where('semesterId', $semesterId)
            ->group_by('studentId')
            ->get('studentmarks')
            ->result();
            // echo '<pre>';print_r($records);exit;
        if ($records) {
            $this->markSheetDelete($programOfferId, $semesterId);
            foreach ($records as $key => $val) {
                $data = $this->getStudentResult($val->studentId, $programOfferId, $semesterId);
                 // echo '<pre>';print_r($records);exit;
                foreach($data as $key=>$data_item)
                {
                    if($key=='record')
                    {
                        // echo 'recorded';
                        // echo $key;
                        if(is_nan($data_item['gpa_point']))
                        {
                            // echo $key;
                            // echo 'recorded data';
                            $data_item['gpa_point']=0;
                        }
                    }
                }
                if(is_nan($data['total']['gpa_point']))
                {
                    $data['total']['gpa_point']=0;
                }
                // echo '<pre>';
                // echo 'total data';
                // echo $data['total']['gpa_point'];
                // exit;
                // foreach($data['total'] as $total_item)
                // {
                //     echo 'cgpa'.$total_item['gpa_point'];
                //     echo 'ok';
                //     //exit;
                // }

                $this->insertTranscript($data, $programOfferId, $semesterId, $position);
            }
        }
    }

    private function markSheetDelete($programOfferId = 0, $semesterId = 0)
    {

        $this->db
            ->where('program_offer_id', $programOfferId)
            ->where('semester_id', $semesterId)
            ->delete('marksheet_mst');

        $this->db
            ->where('program_offer_id', $programOfferId)
            ->where('semester_id', $semesterId)
            ->delete('marksheet_dtls');
    }
//kjhkjhkjhk
    private function insertTranscript($data = [], $programOfferId = 0, $semesterId = 0, $position = [])
    {
        $student_id = $data['total']['student_id'];
        $master_data = [
            'student_id' => $data['total']['student_id'],
            'position' => isset($position[$student_id]['position']) ? $position[$student_id]['position'] : 0,
            'total_marks' => $data['total']['total_marks'],
            'total_obtain_marks' => $data['total']['total_obtain_marks'],
            'total_common_marks' => $data['total']['total_common_marks'],
            'total_obtain_common_marks' => $data['total']['total_obtain_common_marks'],
            'gpa_point' => $data['total']['gpa_point'],
            'gpa_letter' => $data['total']['gpa_letter'],
            'result_comment' => $data['total']['result_comment'],
            'tot_fail_subj' => $data['total']['tot_fail_subj'],
            'tot_op_fail_sub' => $data['total']['tot_op_fail_sub'],
            'program_offer_id' => $programOfferId,
            'semester_id' => $semesterId,
            'created_by' => 1
        ];

        $this->db->insert('marksheet_mst', $master_data);
        $insert_id = $this->db->insert_id();
        $len = count($data['record']);
        for ($i = 0; $i < $len; $i++) {
            $dtls_data = [
                'master_id' => $insert_id,
                'course_name' => $data['record'][$i]['course_name'],
                'course_code' => $data['record'][$i]['course_code'],
                'course_id' => $data['record'][$i]['course_id'],
                'full_mark' => $data['record'][$i]['full_mark'],
                'cal_mark' => $data['record'][$i]['cal_mark'],
                'total_mark' => $data['record'][$i]['total_mark'],
                'merge_id' => $data['record'][$i]['merge_id'],
                'merge_count' => $data['record'][$i]['merge_count'],
                'merge_course_name' => $data['record'][$i]['merge_course_name'],
                'gpa_point' => $data['record'][$i]['gpa_point'],
                'gpa_letter' => $data['record'][$i]['gpa_letter'],
                'course_status' => $data['record'][$i]['course_status'],
                'program_offer_id' => $programOfferId,
                'semester_id' => $semesterId
            ];
             // echo '<pre>';print_r($dtls_data);exit;
            $this->db->insert('marksheet_dtls', $dtls_data);
        }
    }

    public function getStudentMarkSheet($programOfferId = 0, $semesterId = 0, $studentId = 0)
    {
        $data = [];
        $total = $this->db
            ->where('program_offer_id', $programOfferId)
            ->where('student_id', $studentId)
            ->where('semester_id', $semesterId)
            ->get('marksheet_mst')
            ->row_array();
           // echo '<pre>'; print_r($total);exit;
        if ($total) {
            $master_id = $total['id'];
            // $data['record'] = $this->db
            //     ->where('master_id', $master_id)
            //     ->get('marksheet_dtls')
            //     ->result_array();
            ///sdn
            $data['record'] = $this->db
            ->select('marksheet_dtls.*,section.sectionId,section.sectionName,marksheet_mst.position,marksheet_mst.program_offer_id,programoffer.*')
            ->from('marksheet_dtls')
            ->join('marksheet_mst','marksheet_mst.id=marksheet_dtls.master_id')
            ->join('programoffer','programoffer.programOfferId=marksheet_dtls.program_offer_id')
            ->join('section','programoffer.sectionId=section.sectionId')
            ->where('master_id', $master_id)
            ->get()
            ->result_array();
             // echo '<pre>'; print_r($data['record']);exit;
            $common=0;
            $optional=0;
            $extra=0;
            $common_full=0;
            $common_final=0;
            $optional_full=0;
            $extra_full=0;
            foreach($data['record'] as $item)
            {
                if($item['course_status']==1)
                {
                    $common = $common + $item['total_mark'];
                    $common_final = $common_final + $item['total_mark'];
                    $common_full = $common_full + intval($item['full_mark']);
                }
                if($item['course_status']==2)
                {
                    if($item['total_mark']>40)
                    {
                        $common_final = $common_final + ($item['total_mark']-40);
                    }
                    $optional = $optional + $item['total_mark'];
                    $optional_full = $optional_full + intval($item['full_mark']);
                }
                if($item['course_status']==4)
                {
                    $extra = $extra + $item['total_mark'];
                    $extra_full = $extra_full + intval($item['full_mark']);
                }
                // echo '<pre>';
                // print_r($item['sectionName']);exit;
            }

            $data['total'] = $total;
            $data['total']['total_marks_common_full'] = $common_full;
            $data['total']['total_marks_common_final'] = $common_final;
            $data['total']['total_marks_optional_full'] = $optional_full;
            $data['total']['total_marks_extra_full'] = $extra_full;
            $data['total']['grand_total_marks_full'] = $common_full+$optional_full+$extra_full;
            $data['total']['grand_total_marks'] = $common+$optional+$extra;

//            $data['total']['total_marks_common'] = $common;
//            $data['total']['total_marks_with_option'] = $common + $optional;
//            $data['total']['total_marks_with_option_and_extra'] = $common + $optional + $extra;
//            $data['total']['total_obtained_marks_new'] = $common + $optional;

            $this->db->select('MAX(total_obtain_marks) total_obtain_marks');
            $this->db->from('marksheet_mst');
            $this->db->where('program_offer_id',$programOfferId);
            $this->db->where('semester_id',$semesterId);
            $data['highest']=$this->db->get()->row_array();
        }

        return $data;
    }

}