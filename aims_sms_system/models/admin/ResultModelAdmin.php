<?php
class ResultModelAdmin extends CI_Model{
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

    public function getStudentResult($student_id = 0, $program_offer_id = 0, $semester_id = 0)
    {
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
       // print_r($this->db->last_query($records));exit;
        $result = $this->rma->getStudentResultList($records,  $student_id, $program_offer_id);
        //echo "<pre>";print_r($result);die();
        return $result;
    }

    public function getStudentResultList($records = [], $student_id = 0, $program_offer_id = 0)
    {
       // echo 'hi';
       // echo '<pre>';print_r($records);exit;
        $data = [];
        $count = count($records);
        $merge_result = $this->getMergeResult($records, $program_offer_id);
        // echo "<pre>";print_r($merge_result);die();
        for ($i = 0; $i<$count; $i++) {
            $cal_mark = $this->getCalculateMark($records[$i], $i); //here we have to check Tanay
            // if ($i == 0) {
            //     $cal_mark;exit;
            // }
            if ($records[$i]->full_mark == 100) {
                $total_mark = ($cal_mark['total_mark'] > 100) ? 100 : $cal_mark['total_mark'];
            }
            if ($records[$i]->full_mark == 50) {
                $total_mark = ($cal_mark['total_mark'] > 50) ? 50 : $cal_mark['total_mark'];
            }

            $course_status = $this->getCourseStatus($records[$i]->course_id, $student_id, $program_offer_id);
            $merge_course = $this->getMergeSubjectName($records[$i]->course_id, $program_offer_id);
            $merge_id = isset($merge_course['merge_id']) ? $merge_course['merge_id'] : 0;
            $merge_mark = isset($merge_result[$merge_id]) ? $merge_result[$merge_id]: '';
            $gpa = $this->getStudentGpa($total_mark, $records[$i],$merge_mark);

            $data[] = [
                'course_name' => $records[$i]->course_name,
                'course_code' => $records[$i]->course_code,
                'full_mark' => $records[$i]->full_mark,
                'cal_mark' => $cal_mark['ob_mark'],
                'total_mark' => $total_mark,
                'merge_id' => $merge_id,
                'merge_course_name' => isset($merge_course['merge_course_name']) ? $merge_course['merge_course_name'] : '',
                'gpa_point' => isset($gpa['gpa_point']) ? $gpa['gpa_point'] : 0,
                'gpa_letter' => isset($gpa['gpa_letter']) ? $gpa['gpa_letter'] : 'F',
                'course_status' => $course_status,
                ];
        }
        $result['record'] = $data;
        $result['total'] = $this->getSTotalResult($data, $student_id);
       // echo '<pre>';print_r($result['record']);die();
      // echo '<pre>';print_r($data);
      // echo '<pre>';print_r($result);exit;
        return $result;
    }

    public function getMergeResult($records = [], $program_offer_id = 0) {
        $data = [];
        $count = count($records);
        $merge = [];
        $result = [];
        $ssum = 0;
        for ($i = 0; $i<$count; $i++) {
            $merge_course = $this->getMergeSubjectName($records[$i]->course_id, $program_offer_id);
            if ($merge_course) {
                $s = $this->getMergeCalculate($records[$i], $this->subj);
                $o = $this->getMergeCalculate($records[$i], $this->obj);
                $p = $this->getMergeCalculate($records[$i], $this->prti);
                $sba = $this->getMergeCalculate($records[$i], $this->sba);
                $data[] = [
                    'merge_id' => isset($merge_course['merge_id']) ? $merge_course['merge_id'] : 0,
                    's' => $s,
                    'o' => $o,
                    'p' => $p,
                    'sba' => $sba,
                    'mark_cat_id' => $records[$i]->mark_cat_id
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
            } else {
                $merge[$val['merge_id']]= [
                    'merge_id' => $val['merge_id'],
                    's' => $val['s'],
                    'o' => $val['o'],
                    'p' => $val['p'],
                    'sba' => $val['sba'],
                    'mark_cat_id' => $val['mark_cat_id']
                ];
            }
        }

        foreach ($merge as $key => $row) {
           
          
           // 
            if ($key) {
                 $mark_cat = explode(',', substr($row['mark_cat_id'], 1, -1));

                 $s = $this->defineCheck($mark_cat, $this->subj);
                 $s = ($s) ? $row['s']."," : '';

                 $o = $this->defineCheck($mark_cat, $this->obj);
                 $o = ($o) ? $row['o']."," : '';

                 $p = $this->defineCheck($mark_cat, $this->prti);
                 $p = ($p) ? $row['p']."," : '';
                 $sba = $this->defineCheck($mark_cat, $this->sba);
                 $sba = ($sba) ? $row['sba']."," : '';
                 $re = $s.$o.$p.$sba;
                 $ch = substr($re, -1);
                 $re = ($ch == ',') ? substr($re, 0, -1): $re;
                $result[$row['merge_id']] = $re;
            }
        }
        // $k = "1111,1,";
        // $j = substr($k, -1);
        // if ($j == ',') {
        //     $k = substr($k, 0, -1);
        // }
        // print_r($k);
        //echo '<pre>';print_r($result);
        return $result;
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
        $mark = 0;
        $mark_cat = explode(',', substr($record->mark_cat_id, 1, -1));
        $result_mark = explode(',', substr($record->divide_mark, 1, -1));
        $percent_mark = explode(',', substr($record->mark_percent, 1, -1));
        if ($mark_cat) {
             $length = count($mark_cat);
             for ($i = 0; $i < $length; $i++)
             {
                $r_mark = isset($result_mark[$i]) ? $result_mark[$i] : 0;
                $marks = $this->getCalculateResult($r_mark, $percent_mark[$i]);
                if ($mark_cat[$i] == $type)
                {
                    $mark = $marks;
                }
             }
        }
       
        return $mark;
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
                    $or_result .= "S:".$record." ";
                } elseif ($mark_cat[$i] == $this->obj) {
                    $or_result .= "O:".$record." ";
                } elseif ($mark_cat[$i] == $this->prti) {
                    $or_result .= "P:".$record." ";
                } elseif ($mark_cat[$i] == $this->sba) {
                    $or_result .= "SBA:".$record." ";
                }
                $total_mark += (float)$record;
                //echo "<pre>";print_r($total_mark);die();
             }
        }
        $result = ['ob_mark' => $or_result, 'total_mark' => $total_mark];
      // echo "<pre>";print_r($result);die();
        return $result;
    }

    private function getCourseStatus($course_id = 0, $student_id = 0, $program_offer_id = 0)
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
       return $course_status;
    }

    private function getStudentGpa($marks = 0, $record = [], $merge_mark= '') {

        $full_mark = $record->full_mark;
        $marks = ($merge_mark) ? (array_sum(explode(',', $merge_mark))/2) : $marks;
        $marks = ($this->checkMark($record, $merge_mark)) ? $marks: 1;
        $marks = ($full_mark == 100) ? $marks : ($marks*2);
        $gpa = $this->getGpa((float)$marks);
        // if ($record->course_id == 31){
        //     print_r($marks);
        //  }
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

    private function checkMark($record = [], $merge_marks = '')
    {
        //print_r($merge_marks);
        $mark = '';
        $result = true;
        $merge_arr = [];
        $merge_sum = 0;
        $mark_cat = explode(',', substr($record->mark_cat_id, 1, -1));
        $result_mark = explode(',', substr($record->divide_mark, 1, -1));
        $percent_mark = explode(',', substr($record->mark_percent, 1, -1));
        $define_mark = explode(',', substr($record->define_mark, 1, -1));
        $merge_mark = explode(',', $merge_marks);

        $program_level = $record->program_level;
        if ($mark_cat) {
             $length = count($mark_cat);
             for ($i = 0; $i < $length; $i++)
             {
                if ($merge_marks && $program_level == 4) {
                    $mark_cal = $this->markCal($merge_mark[$i], ($define_mark[$i] * 2));
                    $mark .= $mark_cal;

                } else {
                    $r_mark = isset($result_mark[$i]) ? $result_mark[$i] : 0;
                    if ($program_level == 4) {
                        $mark_obtained = $this->getCalculateResult($r_mark, $percent_mark[$i]);
                        $mark_cal = $this->markCal($mark_obtained, $define_mark[$i]);
                        $mark .= $mark_cal;
                    } elseif ($mark_cat[$i] == $this->sba) {
                        $mark_obtained = $this->getCalculateResult($r_mark, $percent_mark[$i]);
                        $mark_cal = $this->markCal($mark_obtained, $define_mark[$i]);
                        $mark .= $mark_cal;
                    }
                }
             }
        }
         if (preg_match('/2/',$mark)){
             $result = false;
         }
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
        return (($result*$percent)/100);
    }

    private function getSTotalResult($data = [], $student_id = 0) {
        $merge = [];
        $total_marks = 0;
        $total_obtain_marks = 0;
        $gpa_point = 0;
        $gpa_letter = '';
        $result_comment = '';
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
            foreach ($data as $key => $val) {
                if ($val['merge_id']) {
                    $merge[$val['merge_id']] = isset($merge[$val['merge_id']]) ? 1 : 2;
                }
                $total_marks += $val['full_mark'];
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
                $gpa_point = round((($total_gpa + $optional_gpa)/$subject_count), 2);
                //$dd = round(($total_gpa/$subject_count), 2);
                $gpa_point = ($gpa_check) ? $gpa_point : 0;
                $tot_fail_subj = ($com_fail_subj + $mer_fail_subj + $op_fail_subj);
            }
            $gpa_point = ($gpa_point > 5) ? 5 :$gpa_point;
            $gpa_letter = $this->getTotalGrade((float)$gpa_point);
            $result_comment = $this->getResultComment((float)$gpa_point);
        }

        return ['student_id' => $student_id, 'total_marks' => $total_marks, 'total_obtain_marks' => $total_obtain_marks, 'gpa_point' => $gpa_point, 'gpa_letter' => $gpa_letter, 'result_comment' => $result_comment,'tot_fail_subj' => $tot_fail_subj,'tot_op_fail_sub' => $op_fail_subj];
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
            $fail_sub = ($result_info['total']['tot_fail_subj'] - $result_info['total']['tot_fail_subj']);
            $std_info[] = [
                'student_id' => $val->student_id,
                'student_name' => $val->student_name,
                'total_marks' => $result_info['total']['total_marks'],
                'total_obtain_marks' => $result_info['total']['total_obtain_marks'],
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
        foreach ($result_info as $m_key => $row) {
            $fail[$m_key]  = $row['tot_cal_fail_subj'];
            $gpa[$m_key] = $row['gpa_point'];
            $mark[$m_key] = $row['total_obtain_marks'];
        }
        array_multisort($fail, SORT_ASC, $gpa, SORT_DESC, $mark, SORT_DESC, $result_info);

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
       // echo '<pre>';print_r($arr);
        return $arr;
    }

}


