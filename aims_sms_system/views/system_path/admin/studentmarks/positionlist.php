<!-- /Content Section  -->    
<?php
 function get_gp($marks){
 if($marks >= 80 && $marks <= 100){
  return 5;
}
elseif($marks >= 70 && $marks <=79.99){
  return 4;
} 

elseif($marks >= 60 && $marks <=69.99){
  return 3.5;
}
elseif($marks >= 50 && $marks <=59.99){
  return 3;
} 
elseif($marks >= 40 && $marks <=49.99){
  return 2;
}
elseif($marks >= 33 && $marks <=39.99){
  return 1;
}
else 
  return 0;
}
?>                
<div class="page-header">
    <h1>
        Student Position
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            All Student Position
        </small>
    </h1>
    
</div><!-- /.page-header -->

<?php
if (empty($markslist)) {
    ?>
<div class="row">
    <?php
    $message = $this->session->userdata('message');
    if (isset($message)) {
        ?>
        <div class="alert alert-block alert-success">
            <i class="ace-icon fa fa-check green"></i>
            <?php
            echo $message;
            $this->session->unset_userdata('message');
            ?>
        </div>
        <?php
    }

    $errormessage = $this->session->userdata('errormessage');
    if (isset($errormessage)) {
        ?>
        <div class="alert alert-block alert-danger">
            <i class="ace-icon fa fa-times red"></i>
            <?php
            echo $errormessage;
            $this->session->unset_userdata('errormessage');
            ?>
        </div>
        <?php
    }
    ?>              
    <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentmarks/search_position" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>

                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid"  data-placeholder="Select" name="data[semesterId]"  class="form-control">
                            <option value="">Select</option>
                             <?php foreach(getSemesterInfoArray() as $velues){?>
                                         <option value="<?php echo $velues['semesterId'];?>" 
                                             <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE)?>><?php echo $velues['semester']?></option>
                                         <?php }?>
                        </select>
                    </div>
                            
                </div>  
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Exam Type  &nbsp; <?php echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[examtypeId]" class="form-control" id="form-field-select-1">
                       <option value="">Select </option>
                            <?php foreach(getExamList() as $velues){?>
                             <option value="<?php echo $velues['examtypeId'];?>" <?php echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE)?>><?php echo $velues['examtypeName']?></option>
                             <?php }?>

                    </select>
                </div>
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Search Student
                            </button>
                            <button class="btn btn-purple" name="print" type="submit">
                                <i class="ace-icon fa fa-print bigger-120"></i>
                               Print List
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
             
        </div>
</div> <!-- /.row --> 

<?php
        }
        if (!empty($markslist)) {
    ?>
<button class="btn btn-success" onclick="printDiv('printableArea')">
                    Print
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>
    <div id="printableArea">
         <div class="widget-box ">
            <div class="widget-header widget-header-large">

                <div class="center"> 
                    <img alt="<?php
                    if (!empty($data_info['instituteName'])) {
                        echo $data_info['instituteName'];
                    }
                    ?>" id="avatar3" src="<?php
                         if (file_exists($data_info['logo'])) {
                             echo base_url() . $data_info['logo'];
                         } else {
                             echo base_url() . "all_upload/default/aims.png";
                         }
                         ?>" width="50"/>
                    <h3><p class="user" > &nbsp; <?php
                        if (!empty($data_info['instituteName'])) {
                            echo "" . $data_info['instituteName'];
                        }
                         ?> </p>
                    </h3>
                    <div class="time">
                        &nbsp;
                        <span class="editable" id="country"><?php
                            if (!empty($data_info['town'])) {
                                echo $data_info['town'];
                            }
                            ?></span>,
                 
                        <span class="editable" id="country">
                            <?php
                            if (!empty($data_info['district'])) {
                                foreach (getDistrictName() as $key => $value) {
                                    if ($key == $data_info['district']) {
                                        echo $value;
                                    }
                                }
                            }
                            ?>
                        </span><br>
                        <h4> Student Position List </h4>
                    </div>

                </div>
                <br>
                <center>
                        <div id="id-message-infobar" style="background: #e5e5e5 none repeat scroll 0 0; margin-left: -18px; padding: 3px;">
                            <span class="blue bigger-130"><?php if(!empty($programId)){ echo "Session : ".getSessionName($sessionId)." - Class : ".getProgramName($programId)." - Group : ".getGroupName($groupId)." - Shift : ".getShiftName($shiftId)." - Section : ".getSectionName($sectionId)." - Semester :  ".getSemesterName($semesterId); } ?> </span>
                        </div>
                    </center> 
                 
            </div>
        <table id="simple-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">Class Position</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>Total Mark</th>
                    <th>Obtain Mark</th>
                    <th>GPA</th>
                    <th>Grade Letter</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sl = 1; 
                    $countOptional = 0;
                    
                    foreach ($markslist as $value) {
                        
                       // if($sl==1)
                       // {         
                       //  $sl++;            
                        $stu_data['studentId']=$value['studentId'];
                        $stu_data['programOfferId']=$value['programOfferId'];
                        $valuess = getCourseIdByStudent($stu_data);

                         $t_sub_mark = getAssignCourseListByPrg_stuid($programOfferId, $value['studentId']);
                                if (!empty($t_sub_mark)) {
                                  $editDatas = explode(",", trim($t_sub_mark['courseId'], ","));
                               // echo "<pre>"; print_r($editDatas);                  
                                                $countcourse = count($editDatas);

                                                $totalcoursemark = 0;
                                                $BngEngcoursemark = 0;
                                                $totalmark = 0;
                                                $totalgradepoint = 0;
                                                
                                                $optional_subject=0;
                                                
                                                 $datax['programOfferId'] = $programOfferId;
                                                 $datax['studentId'] = $value['studentId'];
                                                 $datax['semesterId'] = $value['semesterId'];
                                                 $datax['examtypeId']=$value['examtypeId'];
                                                 
                                                 $get_MarkSubject=getStudentResult($datax);
                                                 
                                                 if (!empty($valuess['courseStatus'])) {
                              $explodeCourseStatus = explode(",", trim($valuess['courseStatus'], ","));
                                                 }
                                                    
                                           //echo "<pre>"; print_r($get_MarkSubject); 
                                               // echo "<pre>"; print_r($explodeCourseStatus);
                                                 $get_grade_arry="";
                                                for ($x = 0; $x < $countcourse; $x++) {                                                    
                                                    
                                                  foreach($get_MarkSubject as $m_sub)
                                                  {       
                                                                             
                                                      $chk_status = $explodeCourseStatus[$x]; // get COURSE STATUS------
                                                     // echo $m_sub['courseId']." - ".$editDatas[$x]."<br>";

                                                      if ($chk_status==2 && $m_sub['courseId']==$editDatas[$x]) {
                                                       // echo "2";
                                                          $optional_subject=2; 
                                                          $countOptional = 1;
                                                          $optional_subject_id=$m_sub['courseId'];
                                                          break;
                                                      }
                                                  }

                                                 //  unset($_fail_gradepoint);
                                                  foreach($get_MarkSubject as $m_sub)
                                                  { 

                                                    if($m_sub['courseId']==$editDatas[$x])
                                                    {                 
                                                         $datax['courseId'] = $editDatas[$x];
                                                         $datax['programOfferId']=$programOfferId;

                          $marks_devide = getMarkDevidevalue($datax);
                           // get Student Divided AMrks By Subject
                          $divided_marks = getDivideMarks_bySubject($datax);  

                          $ex_pld = explode(",", trim($marks_devide['mark_cat_id']));
                          $ex_pld_assng_dvd = explode(",", trim($marks_devide['dis_divide_mark']));
                          // this mark is from student marks table
                          $ex_pld_dvd = explode(",", trim($divided_marks['divide_mark'])); 
                          $ex_pld_percnt = explode(",", trim($marks_devide['mark_percent']));
                                                         
                          $marks=0; 
                          $percent_marks=0;
                          $PassStatus = array();
                          $Not_Execute_1= array('101','102');
                          $Not_Execute_2= array('107','108');
                    //   print_r(($ex_pld_assng_dvd));
                        // echo " <br>Sub Code: ".$m_sub['courseCode'];
                         // echo "<pre>"; print_r($ex_pld_dvd);

                          for($ck_val=1;$ck_val<count($ex_pld)-1; $ck_val++)
                          {
                              //echo $ex_pld_assng_dvd[$ck_val]."++".$ex_pld_percnt[$ck_val];
                              
                            $mrk_string=getMarkTitle($ex_pld[$ck_val]);

                              $SubPassMark = round(($ex_pld_assng_dvd[$ck_val] * ($ex_pld_percnt[$ck_val] / 100)) * (0.333));
                              
                              if(!empty($ex_pld_percnt[$ck_val]))
                              {
                                  $percent_marks = ($ex_pld_percnt[$ck_val] * $ex_pld_dvd[$ck_val]) / 100; 

                                  if($value['programLevel'] == 4)
                                  {       
                                                                        
                                    if(in_array($m_sub['courseCode'], $Not_Execute_1) )
                                    {
                                      //mark Assign
                                      $BanglaAssign[$m_sub['courseCode']]= $ex_pld_assng_dvd;
                                      $BanglaPercent[$m_sub['courseCode']]= $ex_pld_percnt;
                                      //Bangla Mark
                                      $BanglaMark[$m_sub['courseCode']] = $ex_pld_dvd;
                                    }
                                    elseif(in_array($m_sub['courseCode'], $Not_Execute_2) )
                                    {
                                      //mark Assign
                                      $EnglishAssign[$m_sub['courseCode']]= $ex_pld_assng_dvd;
                                      $EnglishPercent[$m_sub['courseCode']]= $ex_pld_percnt;
                                      //Bangla Mark
                                      $EnglishMark[$m_sub['courseCode']] = $ex_pld_dvd;
                                    }
                                    else
                                    {
                                      if(!empty($optional_subject)==2 && $optional_subject_id == $m_sub['courseId']){ 
                                        
                                          $GradeStatus = 1; // Pass
                                           $marks = round($marks + $percent_marks);
                                       }   
                                       else  
                                       {     
     // Subjective/Objective/SBA/Practical Mark Check by assign mark
     // BNG (Subj Pass Mark <= Obtain Sub Mark)
                                            if($SubPassMark <= $percent_marks)
                                            {
                                               $PassStatus[] = 1; // If Pass
                                            }
                                            else
                                            {
                                              $PassStatus[] = 0; // If Fail
                                            }
                                            
                                            if(in_array(0, $PassStatus))
                                            {
                                               $marks = round($marks + $percent_marks);
                                               $GradeStatus = 0; // Fail
                                            } 
                                            else
                                            {
                                               $marks = round($marks + $percent_marks);
                                               $GradeStatus = 1; // Pass
                                            }
                                       }
                                    }

                                       
                                   }
                                   else
                                   {
                                      $GradeStatus = 1; // No Check
                                      $PassStatus[] = 1; // No Check
                                      $marks = round($marks + $percent_marks); 
                                   }
                              }


                          }
                          
                          if((in_array($m_sub['courseCode'], $Not_Execute_1)) || (in_array($m_sub['courseCode'], $Not_Execute_2)) )
                          {
                            $coursemark = getCourseMarksAnother($datax); 
                            $BngEngcoursemark += $coursemark;

                            continue;
                          }
                          else
                          {
                            $coursemark = getCourseMarksAnother($datax); 
                            // Institute Subject Total Mark
                            $totalcoursemark = $coursemark + $totalcoursemark; // Institute Total Subject Marks

                            if($coursemark != 0)
                            {
                              $percentmarks = (100 / $coursemark) * $marks;
                            }
                            else
                            {
                              $percentmarks =0;
                            }
                            
                            $convertmarks = doubleval(intval($percentmarks));

                            if (in_array($convertmarks, range(80.00, 100.00))) {
                                if(!empty($optional_subject)==2 && $optional_subject_id==$m_sub['courseId']){ 
                                    $minus_point = 5;
                                    $gradepoint = 0;
                                    $_fail_gradepoint = 5;
                                } else {
                                  if($GradeStatus == 0)
                                  {
                                      $gradepoint = 0;
                                      $_fail_gradepoint = 0;  
                                  }
                                  else
                                  {
                                      $gradepoint = 5;
                                      $_fail_gradepoint = 5;
                                  }   
                                    
                                }                                                        
                                //    echo $a;
                            } elseif (in_array($convertmarks, range(70.00, 79.00))) {
                                if(!empty($optional_subject)==2 && $optional_subject_id==$m_sub['courseId']){ 
                                    $minus_point = 4;
                                    $gradepoint = 0;
                                    $_fail_gradepoint = 4;
                                } else {
                                    if($GradeStatus == 0)
                                    {
                                        $gradepoint = 0;
                                        $_fail_gradepoint = 0;  
                                    }
                                    else
                                    {
                                        $gradepoint = 4;
                                        $_fail_gradepoint = 4;
                                    } 
                                }
                                //    echo $a;
                            } elseif (in_array($convertmarks, range(60.00, 69.00))) {
                                if(!empty($optional_subject)==2 && $optional_subject_id==$m_sub['courseId']){ 
                                    $minus_point = 3.5;
                                    $gradepoint = 0;
                                    $_fail_gradepoint = 3.5;
                                } else {
                                    if($GradeStatus == 0)
                                    {
                                        $gradepoint = 0;
                                        $_fail_gradepoint = 0;  
                                    }
                                    else
                                    {
                                        $gradepoint = 3.5;
                                        $_fail_gradepoint = 3.5;
                                    } 
                                }
                                //    echo $a;
                            } elseif (in_array($convertmarks, range(50.00, 59.00))) {
                                if(!empty($optional_subject)==2 && $optional_subject_id==$m_sub['courseId']){ 
                                    $minus_point = 3;
                                    $gradepoint = 0;
                                    $_fail_gradepoint = 3;
                                } else {
                                    if($GradeStatus == 0)
                                    {
                                        $gradepoint = 0;
                                        $_fail_gradepoint = 0;  
                                    }
                                    else
                                    {
                                        $gradepoint = 3;
                                        $_fail_gradepoint = 3;
                                    }
                                }
                                //    echo $a;
                            } elseif (in_array($convertmarks, range(40.00, 49.00))) {
                                if(!empty($optional_subject)==2 && $optional_subject_id==$m_sub['courseId']){ 
                                    $minus_point = 2;
                                    $gradepoint = 0;
                                    $_fail_gradepoint = 2;
                                } else {
                                    if($GradeStatus == 0)
                                    { 
                                        $gradepoint = 0;
                                        $_fail_gradepoint = 0;  
                                    }
                                    else
                                    {
                                        $gradepoint = 2;
                                        $_fail_gradepoint = 2;
                                    }
                                }
                                //    echo $a;
                            } elseif (in_array($convertmarks, range(33.00, 39.00))) {
                                if(!empty($optional_subject)==2 && $optional_subject_id==$m_sub['courseId']){ 
                                    $minus_point = 1;
                                    $gradepoint = 0;
                                    $_fail_gradepoint = 1;
                                } else {
                                    if($GradeStatus == 0)
                                    {
                                        $gradepoint = 0;
                                        $_fail_gradepoint = 0;  
                                    }
                                    else
                                    {
                                        $gradepoint = 1;
                                        $_fail_gradepoint = 1;
                                    }
                                }
                                //    echo $a;
                            } else {
                                $gradepoint = 0;
                                $_fail_gradepoint = 0;
                            }

                            $get_grade_arry[]=$_fail_gradepoint;
                          }//End In Array Checking IF

                                  $count_subject = $x; // count subject 1 by 1
                                  $totalmark = $marks + $totalmark;
                                  $totalgradepoint = $gradepoint + $totalgradepoint; // Student Total Grade POint
                          }
                        }
                            
                        
                      }
                          
                               $count_i = $count_subject + 1; // Total Subject
                      // Print This total Course Mark        
                               $print_totalcoursemark=$totalcoursemark; // Total ALl Subjects Marks
                      // Print This Course Mark         
                               $print_coursemark= $totalmark; // Total Student Subjects wise Marks
                               $totalgradepoint; // Total Student grade point
                      }
                      else {
                          $print_totalcoursemark=0;
                      }
                      //For Counting Bangla & English
                   //   for($start=1;$start<count($ex_pld)-1; $ck_val++)                    
                                         
                                                
                    $Bangla1_Sub= !empty($BanglaMark[101][1]);       
                    $Bangla1_Obj= !empty($BanglaMark[101][2]);       
                    $Bangla2_Sub= !empty($BanglaMark[102][1]);       
                    $Bangla2_Obj= !empty($BanglaMark[102][2]);       
                    $English1_Sub= $EnglishMark[107][1];       
                    $English1_Obj= $EnglishMark[107][2];    
                    $English2_Sub= $EnglishMark[108][1];       
                    $English2_Obj= $EnglishMark[108][2];       

                    $bangla_Subjective = $Bangla1_Sub + $Bangla2_Sub;
                    $bangla_Objective = $Bangla1_Obj + $Bangla2_Obj;

                    $BngSubPassMark_1 = round((!empty($BanglaAssign[101][1]) * (!empty($BanglaPercent[101][1]) / 100)) * (0.333));
                    $BngSubPassMark_2 = round((!empty($BanglaAssign[102][1]) * (!empty($BanglaPercent[102][1]) / 100)) * (0.333));

                    $BngObjPassMark_1 = round((!empty($BanglaAssign[101][2]) * (!empty($BanglaPercent[101][2]) / 100)) * (0.333));
                    $BngObjPassMark_2 = round((!empty($BanglaAssign[102][2]) * (!empty($BanglaPercent[102][2]) / 100)) * (0.333));
                    //---
                    $English_Subjective = $English1_Sub + $English2_Sub;
                    $English_Objective = $English1_Obj + $English2_Obj;

                    $EngSubPassMark_1 = round(($EnglishAssign[107][1] * ($EnglishPercent[107][1] / 100)) * (0.333));
                    $EngSubPassMark_2 = round(($EnglishAssign[108][1] * ($EnglishPercent[108][1] / 100)) * (0.333));

                    $EngObjPassMark_1 = round(($EnglishAssign[107][2] * ($EnglishPercent[107][2] / 100)) * (0.333));
                    $EngObjPassMark_2 = round(($EnglishAssign[108][2] * ($EnglishPercent[108][2] / 100)) * (0.333));

                    //----------Check Subjective & Objective
                    if($bangla_Subjective >= ($BngSubPassMark_1 + $BngSubPassMark_2) )
                    {
                      $get_grade_arry[]= 1; // Status Pass
                      $bngResult[] = 1; // Status Pass
                    }
                    else{
                      $get_grade_arry[]= 0; // Status Fail
                      $bngResult[] = 0; // Status Fail
                    }

                    if($bangla_Objective >= ($BngObjPassMark_1 + $BngObjPassMark_2) )
                    {
                      $get_grade_arry[]= 1; // Status Pass
                      $bngResult[] = 1; // Status Pass
                    }
                    else{
                      $get_grade_arry[]= 0; // Status Fail
                      $bngResult[] = 0; // Status Fail
                    }

                    //------------English Check
                    if($English_Subjective >= ($EngSubPassMark_1 + $EngSubPassMark_2) )
                    {
                      $get_grade_arry[]= 1; // Status Pass
                      $engResult[] = 1; // Status Pass
                    }
                    else{
                      $get_grade_arry[]= 0; // Status Fail
                      $engResult[] = 0; // Status Fail
                    }

                    if($English_Objective >= ($EngObjPassMark_1 + $EngObjPassMark_2) )
                    {
                      $get_grade_arry[]= 1; // Status Pass
                      $engResult[] = 1; // Status Pass
                    }
                    else{
                      $get_grade_arry[]= 0; // Status Fail
                      $engResult[] = 0; // Status Fail
                    }

                  $Count_BanglaMark = ($bangla_Subjective + $bangla_Objective);
                  $Count_EnglishMark = ($English_Subjective + $English_Objective);

                 $banglaGP = get_gp(round($Count_BanglaMark/2));
                 $englishGP = get_gp(round($Count_EnglishMark/2));
                 $print_coursemark = $print_coursemark + $Count_BanglaMark + $Count_EnglishMark;
                 $print_totalcoursemark = $print_totalcoursemark + $BngEngcoursemark;
                 
                  $count_i = $count_i-4+2;

                  $totalgradepoint = $totalgradepoint + $banglaGP + $englishGP;

       // echo "<pre>"; print_r($get_grade_arry);
                       // =========================================================//
 //$get_grade_arry="";
                                      if (in_array(0, $get_grade_arry)) {
                                           $grade_mark = 0;
                                          $print_grade_mark=$grade_mark; // Print This Grade Mark;
                                      } else {
                                          // echo "MInus<<".$minus_point.">>";
                                          if (!empty($minus_point)) {

                                              $minus_i = $count_i - 1;
                                              $minus = $minus_point - 2;
                                              $total_minus_point = $totalgradepoint + $minus;
                                              $cgpa = $total_minus_point / $minus_i;

                                              $total_minus_point."/".$minus_i;
                                              $substr = substr($cgpa, 0, 4);
                                              if ($substr > 5) {
                                                  $grade_mark = (int) $substr;
                                                  $print_grade_mark=$grade_mark; // Print This Grade Mark;
                                              } 
                                              elseif ($substr < 0) {
                                                  $grade_mark = $substr;
                                                  $print_grade_mark=$grade_mark; // Print This Grade Mark;
                                              }
                                              else {
                                                  $grade_mark = $substr;
                                                  $print_grade_mark=$grade_mark; // Print This Grade Mark;
                                              }
                                          } else {
                                              $cgpa = $totalgradepoint / $count_i;
                                              $echo_cgpa = substr($cgpa, 0, 4);

                                              if ($echo_cgpa == 5 || $echo_cgpa > 5) {
                                                  $grade_mark = (int) $echo_cgpa;
                                                  $print_grade_mark=$grade_mark; // Print This Grade Mark;
                                              } else {
                                                  $grade_mark = $echo_cgpa;
                                                  $print_grade_mark=$grade_mark; // Print This Grade Mark;
                                              }
                                          }
                                      }

                /// =============================================================//
                
                                    if (in_array(0, $get_grade_arry)) {
                                        $grd = "F";
                                        $print_grade=$grd; // Print This Grade;
                                    } else {
                                        if (in_array($grade_mark, range(0, 1))) {
                                            //if ($convertmark <0) {
                                            $grd = "F";
                                            $print_grade=$grd; // Print This Grade;
                                        } elseif ($grade_mark >= 5) {
                                            $grd = "A+";
                                            $print_grade=$grd; // Print This Grade;
                                            //    echo $a;
                                        } elseif (4 <= $grade_mark && $grade_mark <= 5) {
                                            $grd = "A";
                                            $print_grade=$grd; // Print This Grade;
                                            //    echo $a;
                                        } elseif (3.5 <= $grade_mark && $grade_mark <= 3.99) {
                                            $grd = "A-";
                                            $print_grade=$grd; // Print This Grade;
                                            //    echo $a;
                                        } elseif (3 <= $grade_mark && $grade_mark <= 3.49) {
                                            $grd = "B";
                                            $print_grade=$grd; // Print This Grade;
                                            //    echo $a;
                                        } elseif (2 <= $grade_mark && $grade_mark <= 2.99) {
                                            $grd = "C";
                                            $print_grade=$grd; // Print This Grade;
                                            //    echo $a;
                                        } elseif (1 <= $grade_mark && $grade_mark <= 1.99) {
                                            $grd = "D";
                                            $print_grade=$grd; // Print This Grade;
                                            //    echo $a;
                                        } else {
                                            $grd = "F";
                                            $print_grade=$grd; // Print This Grade;
                                        }
                                    }                      
                  // ====================//=============//=============// ===============//========
                     
                          if($print_grade=="A+")
                          {
                          //  $sorted_array_A_plus[]=$value['studentId'].",".$print_totalcoursemark.",".$print_coursemark.",".$print_grade_mark.",".$print_grade;

                           $sorted_array_A_plus[] = array('StudentID' => $value['studentId'], 'FullMark' =>$print_totalcoursemark, 'Obtain' => $print_coursemark, 'GP' =>$print_grade_mark, 'Grade' =>$print_grade);

                           array_multisort(array_column($sorted_array_A_plus, 'GP'), SORT_DESC, array_column($sorted_array_A_plus, 'Obtain'), SORT_DESC,$sorted_array_A_plus); 

                           // $ar_sort_A_plus[]=$print_grade_mark;//Sort By Grade Point
                           // arsort($ar_sort_A_plus); 
                          }
                          
                          if($print_grade=="A")
                          {
                            //$sorted_array_A[]=$value['studentId'].",".$print_totalcoursemark.",".$print_coursemark.",".$print_grade_mark.",".$print_grade;

                            $sorted_array_A[]=array('StudentID' => $value['studentId'], 'FullMark' =>$print_totalcoursemark, 'Obtain' => $print_coursemark, 'GP' =>$print_grade_mark, 'Grade' =>$print_grade);

                            array_multisort(array_column($sorted_array_A, 'GP'), SORT_DESC, array_column($sorted_array_A, 'Obtain'), SORT_DESC,$sorted_array_A); 

                           
                          }
                          
                          if($print_grade=="A-")
                          {
                            //$sorted_array_A_minus[]=$value['studentId'].",".$print_totalcoursemark.",".$print_coursemark.",".$print_grade_mark.",".$print_grade;
                            $sorted_array_A_minus[]= array('StudentID' => $value['studentId'], 'FullMark' =>$print_totalcoursemark, 'Obtain' => $print_coursemark, 'GP' =>$print_grade_mark, 'Grade' =>$print_grade);

                            array_multisort(array_column($sorted_array_A_minus, 'GP'), SORT_DESC, array_column($sorted_array_A_minus, 'Obtain'), SORT_DESC,$sorted_array_A_minus); 

                            
                          }
                          
                          if($print_grade=="B")
                          {
                          //  $sorted_array_B[]=$value['studentId'].",".$print_totalcoursemark.",".$print_coursemark.",".$print_grade_mark.",".$print_grade;

                            $sorted_array_B[]= array('StudentID' => $value['studentId'], 'FullMark' =>$print_totalcoursemark, 'Obtain' => $print_coursemark, 'GP' =>$print_grade_mark, 'Grade' =>$print_grade);

                            array_multisort(array_column($sorted_array_B, 'GP'), SORT_DESC, array_column($sorted_array_B, 'Obtain'), SORT_DESC,$sorted_array_B); 
                          }
                          
                          if($print_grade=="C")
                          {
                          //  $sorted_array_C[]=$value['studentId'].",".$print_totalcoursemark.",".$print_coursemark.",".$print_grade_mark.",".$print_grade;

                            $sorted_array_C[]= array('StudentID' => $value['studentId'], 'FullMark' =>$print_totalcoursemark, 'Obtain' => $print_coursemark, 'GP' =>$print_grade_mark, 'Grade' =>$print_grade);

                            array_multisort(array_column($sorted_array_C, 'GP'), SORT_DESC, array_column($sorted_array_C, 'Obtain'), SORT_DESC,$sorted_array_C); 
                          }
                          
                          if($print_grade=="D")
                          {
                          //  $sorted_array_D[]=$value['studentId'].",".$print_totalcoursemark.",".$print_coursemark.",".$print_grade_mark.",".$print_grade;

                            $sorted_array_D[]= array('StudentID' => $value['studentId'], 'FullMark' =>$print_totalcoursemark, 'Obtain' => $print_coursemark, 'GP' =>$print_grade_mark, 'Grade' =>$print_grade);

                            array_multisort(array_column($sorted_array_D, 'GP'), SORT_DESC, array_column($sorted_array_D, 'Obtain'), SORT_DESC,$sorted_array_D); 
                          }
                          
                          if($print_grade=="F")
                          {
                            //$sorted_array_F[]=$value['studentId'].",".$print_totalcoursemark.",".$print_coursemark.",".$print_grade_mark.",".$print_grade;

                            $sorted_array_F[]= array('StudentID' => $value['studentId'], 'FullMark' =>$print_totalcoursemark, 'Obtain' => $print_coursemark, 'GP' =>$print_grade_mark, 'Grade' =>$print_grade);

                            array_multisort(array_column($sorted_array_F, 'GP'), SORT_DESC, array_column($sorted_array_F, 'Obtain'), SORT_DESC,$sorted_array_F); 
                          }



                    }      
        //     }    

                  // Start Result loop for A+ Student List
                                 if(!empty($sorted_array_A_plus))
                                 {   

                                   $serial=0;
                                   //for($f_s=0;$f_s<count($sorted_array_A_plus); $f_s++)
                                    foreach($sorted_array_A_plus as $Aplus_Key => $xpld)
                                   {
                                      // $explode=$sorted_array_A_plus[$f_s];                                                    
                                    //   $xpld=explode(",",$explode);
                                         
                                                                       
                              ?>
                                <tr>
                                    <td> 
                                        <?php 
                                            
                                            echo $serial=$serial+1;
                                        ?>
                                    </td>
                                    <td> 
                                        <?php 
                                            if(!empty($xpld['StudentID'])){ echo $xpld['StudentID']; }
                                            
                                        ?>
                                    </td>
                                  
                                    <td> 
                                        <?php 
                                            if(!empty($xpld['StudentID'])){ $name=getStudentName_Image($xpld['StudentID']); echo $name['firstName'] . " " . $name['lastName']; }
                                            
                                        ?>
                                    </td>
                                    
                                    <!--  ====+++ Start Total Marks Column +++====  --> 
                                    <td> 
                                         <?php                                            
                                              if (!empty($xpld['FullMark'])) {
                                                  echo $xpld['FullMark'];
                                              }                                           
                                                
                                          ?>
                                    </td>  
                                    
                                   <!--  ====+++ End Total Marks Column +++====  --> 
                                    
                                    <!--  ====+++ Start Obtain Marks Column +++====  -->
                                     <td> 
                                         <?php                                            
                                              if (!empty($xpld['Obtain'])) {
                                                  echo $xpld['Obtain'];
                                              }                                           
                                                
                                          ?>
                                          
                                     </td>
                                   <!--  ====+++ End Obtain Marks Column +++====  -->     
                                   
                                   
                                   <!--  ====+++ Start Grade Point Column +++====  -->     
                                     <td> 
                                         <?php                                            
                                              if (!empty($xpld['GP'])) {
                                                  echo $xpld['GP'];
                                              }  
                                              else
                                              {
                                                echo 0;
                                              }                                         
                                                
                                          ?>
                                          
                                     </td>
                                <!--  ====+++ End Grade Point Column +++====  -->        
                                     
                                <!--  ====+++ Start Grade Letter Column +++====  -->     
                                     <td> 
                                          <?php                                            
                                              if (!empty($xpld['Grade'])) {
                                                  echo $xpld['Grade'];
                                              }                                           
                                                
                                          ?>
                                    
                                     </td>
                                    <!--  ====+++ End Grade Letter Column +++====  -->  
                                    
                                </tr>
                                <?php
                                      }
                                      //$grdpoint_stu=0;

                                    }

                                // END Result loop for A+ Student List 

                           // Start Result loop for A Student List
                                          if(!empty($sorted_array_A))
                                          {   
                                            if(empty($serial))
                                            {                                               
                                               $serial=0;
                                            }
                                            //for($f_s=0;$f_s<count($sorted_array_A); $f_s++)
                                            foreach($sorted_array_A as $A_Key => $xpld)
                                            {
                                           //     $explode=$sorted_array_A[$f_s];                                                    
                                       //         $xpld=explode(",",$explode);
                                                  
                                                                                
                                       ?>
                                         <tr>
                                             <td> 
                                                 <?php 
                                                     echo $serial=$serial+1;
                                                 ?>
                                             </td>
                                             <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ echo $xpld['StudentID']; }
                                                    
                                                ?>
                                            </td>
                                          
                                            <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ $name=getStudentName_Image($xpld['StudentID']); echo $name['firstName'] . " " . $name['lastName']; }
                                                    
                                                ?>
                                            </td>
                                            
                                            <!--  ====+++ Start Total Marks Column +++====  --> 
                                            <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['FullMark'])) {
                                                          echo $xpld['FullMark'];
                                                      }                                           
                                                        
                                                  ?>
                                            </td>  
                                            
                                           <!--  ====+++ End Total Marks Column +++====  --> 
                                            
                                            <!--  ====+++ Start Obtain Marks Column +++====  -->
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['Obtain'])) {
                                                          echo $xpld['Obtain'];
                                                      }                                           
                                                        
                                                  ?>
                                                  
                                             </td>
                                           <!--  ====+++ End Obtain Marks Column +++====  -->     
                                           
                                           
                                           <!--  ====+++ Start Grade Point Column +++====  -->     
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['GP'])) {
                                                          echo $xpld['GP'];
                                                      }  
                                                      else
                                                      {
                                                        echo 0;
                                                      }                                         
                                                        
                                                  ?>
                                                  
                                             </td>
                                        <!--  ====+++ End Grade Point Column +++====  -->        
                                             
                                        <!--  ====+++ Start Grade Letter Column +++====  -->     
                                             <td> 
                                                  <?php                                            
                                                      if (!empty($xpld['Grade'])) {
                                                          echo $xpld['Grade'];
                                                      }                                           
                                                        
                                                  ?>
                                            
                                             </td>
                                             <!--  ====+++ End Grade Letter Column +++====  -->  
                                             
                                         </tr>
                                         <?php
                                               }
                                               //$grdpoint_stu=0;

                                             }

                                         // END Result loop for A Student List          
                             // Start Result loop for A Student List
                                          if(!empty($sorted_array_A_minus))
                                          {   

                                            if(empty($serial))
                                            {                                               
                                               $serial=0;
                                            }
                                            //for($f_s=0;$f_s<count($sorted_array_A); $f_s++)
                                            foreach($sorted_array_A_minus as $A_Key => $xpld)
                                            {
                                           //     $explode=$sorted_array_A[$f_s];                                                    
                                       //         $xpld=explode(",",$explode);
                                                  
                                                                                
                                       ?>
                                         <tr>
                                             <td> 
                                                 <?php 
                                                     echo $serial=$serial+1;
                                                 ?>
                                             </td>
                                             <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ echo $xpld['StudentID']; }
                                                    
                                                ?>
                                            </td>
                                          
                                            <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ $name=getStudentName_Image($xpld['StudentID']); echo $name['firstName'] . " " . $name['lastName']; }
                                                    
                                                ?>
                                            </td>
                                            
                                            <!--  ====+++ Start Total Marks Column +++====  --> 
                                            <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['FullMark'])) {
                                                          echo $xpld['FullMark'];
                                                      }                                           
                                                        
                                                  ?>
                                            </td>  
                                            
                                           <!--  ====+++ End Total Marks Column +++====  --> 
                                            
                                            <!--  ====+++ Start Obtain Marks Column +++====  -->
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['Obtain'])) {
                                                          echo $xpld['Obtain'];
                                                      }                                           
                                                        
                                                  ?>
                                                  
                                             </td>
                                           <!--  ====+++ End Obtain Marks Column +++====  -->     
                                           
                                           
                                           <!--  ====+++ Start Grade Point Column +++====  -->     
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['GP'])) {
                                                          echo $xpld['GP'];
                                                      }  
                                                      else
                                                      {
                                                        echo 0;
                                                      }                                         
                                                        
                                                  ?>
                                                  
                                             </td>
                                        <!--  ====+++ End Grade Point Column +++====  -->        
                                             
                                        <!--  ====+++ Start Grade Letter Column +++====  -->     
                                             <td> 
                                                  <?php                                            
                                                      if (!empty($xpld['Grade'])) {
                                                          echo $xpld['Grade'];
                                                      }                                           
                                                        
                                                  ?>
                                            
                                             </td>
                                             <!--  ====+++ End Grade Letter Column +++====  -->  
                                             
                                         </tr>
                                         <?php
                                               }
                                               //$grdpoint_stu=0;

                                             }

                                         // END Result loop for B Student List                                       

                                        if(!empty($sorted_array_B))
                                        {   

                                          if(empty($serial))
                                            {                                               
                                               $serial=0;
                                            }
                                            //for($f_s=0;$f_s<count($sorted_array_A); $f_s++)
                                            foreach($sorted_array_B as $A_Key => $xpld)
                                            {
                                           //     $explode=$sorted_array_A[$f_s];                                                    
                                       //         $xpld=explode(",",$explode);
                                                  
                                                                                
                                       ?>
                                         <tr>
                                             <td> 
                                                 <?php 
                                                     echo $serial=$serial+1;
                                                 ?>
                                             </td>
                                             <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ echo $xpld['StudentID']; }
                                                    
                                                ?>
                                            </td>
                                          
                                            <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ $name=getStudentName_Image($xpld['StudentID']); echo $name['firstName'] . " " . $name['lastName']; }
                                                    
                                                ?>
                                            </td>
                                            
                                            <!--  ====+++ Start Total Marks Column +++====  --> 
                                            <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['FullMark'])) {
                                                          echo $xpld['FullMark'];
                                                      }                                           
                                                        
                                                  ?>
                                            </td>  
                                            
                                           <!--  ====+++ End Total Marks Column +++====  --> 
                                            
                                            <!--  ====+++ Start Obtain Marks Column +++====  -->
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['Obtain'])) {
                                                          echo $xpld['Obtain'];
                                                      }                                           
                                                        
                                                  ?>
                                                  
                                             </td>
                                           <!--  ====+++ End Obtain Marks Column +++====  -->     
                                           
                                           
                                           <!--  ====+++ Start Grade Point Column +++====  -->     
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['GP'])) {
                                                          echo $xpld['GP'];
                                                      }  
                                                      else
                                                      {
                                                        echo 0;
                                                      }                                         
                                                        
                                                  ?>
                                                  
                                             </td>
                                        <!--  ====+++ End Grade Point Column +++====  -->        
                                             
                                        <!--  ====+++ Start Grade Letter Column +++====  -->     
                                             <td> 
                                                  <?php                                            
                                                      if (!empty($xpld['Grade'])) {
                                                          echo $xpld['Grade'];
                                                      }                                           
                                                        
                                                  ?>
                                            
                                             </td>
                                           <!--  ====+++ End Grade Letter Column +++====  -->  
                                           
                                       </tr>
                                       <?php
                                             }
                                             //$grdpoint_stu=0;

                                           }

                                       // END Result loop for B Student List          
                                    // END Result loop for C Student List                                       

                                   if(!empty($sorted_array_C))
                                   {   

                                     if(empty($serial))
                                            {                                               
                                               $serial=0;
                                            }
                                            //for($f_s=0;$f_s<count($sorted_array_A); $f_s++)
                                            foreach($sorted_array_C as $A_Key => $xpld)
                                            {
                                           //     $explode=$sorted_array_A[$f_s];                                                    
                                       //         $xpld=explode(",",$explode);
                                                  
                                                                                
                                       ?>
                                         <tr>
                                             <td> 
                                                 <?php 
                                                     echo $serial=$serial+1;
                                                 ?>
                                             </td>
                                             <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ echo $xpld['StudentID']; }
                                                    
                                                ?>
                                            </td>
                                          
                                            <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ $name=getStudentName_Image($xpld['StudentID']); echo $name['firstName'] . " " . $name['lastName']; }
                                                    
                                                ?>
                                            </td>
                                            
                                            <!--  ====+++ Start Total Marks Column +++====  --> 
                                            <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['FullMark'])) {
                                                          echo $xpld['FullMark'];
                                                      }                                           
                                                        
                                                  ?>
                                            </td>  
                                            
                                           <!--  ====+++ End Total Marks Column +++====  --> 
                                            
                                            <!--  ====+++ Start Obtain Marks Column +++====  -->
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['Obtain'])) {
                                                          echo $xpld['Obtain'];
                                                      }                                           
                                                        
                                                  ?>
                                                  
                                             </td>
                                           <!--  ====+++ End Obtain Marks Column +++====  -->     
                                           
                                           
                                           <!--  ====+++ Start Grade Point Column +++====  -->     
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['GP'])) {
                                                          echo $xpld['GP'];
                                                      }  
                                                      else
                                                      {
                                                        echo 0;
                                                      }                                         
                                                        
                                                  ?>
                                                  
                                             </td>
                                        <!--  ====+++ End Grade Point Column +++====  -->        
                                             
                                        <!--  ====+++ Start Grade Letter Column +++====  -->     
                                             <td> 
                                                  <?php                                            
                                                      if (!empty($xpld['Grade'])) {
                                                          echo $xpld['Grade'];
                                                      }                                           
                                                        
                                                  ?>
                                            
                                             </td>
                                      <!--  ====+++ End Grade Letter Column +++====  -->  
                                      
                                  </tr>
                                  <?php
                                        }
                                        //$grdpoint_stu=0;

                                      }

                                  // END Result loop for C Student List               
                                                                

                                 if(!empty($sorted_array_D))
                                 {   

                                            if(empty($serial))
                                            {                                               
                                               $serial=0;
                                            }
                                            //for($f_s=0;$f_s<count($sorted_array_A); $f_s++)
                                            foreach($sorted_array_D as $A_Key => $xpld)
                                            {
                                           //     $explode=$sorted_array_A[$f_s];                                                    
                                       //         $xpld=explode(",",$explode);
                                                  
                                                                                
                                       ?>
                                         <tr>
                                             <td> 
                                                 <?php 
                                                     echo $serial=$serial+1;
                                                 ?>
                                             </td>
                                             <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ echo $xpld['StudentID']; }
                                                    
                                                ?>
                                            </td>
                                          
                                            <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ $name=getStudentName_Image($xpld['StudentID']); echo $name['firstName'] . " " . $name['lastName']; }
                                                    
                                                ?>
                                            </td>
                                            
                                            <!--  ====+++ Start Total Marks Column +++====  --> 
                                            <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['FullMark'])) {
                                                          echo $xpld['FullMark'];
                                                      }                                           
                                                        
                                                  ?>
                                            </td>  
                                            
                                           <!--  ====+++ End Total Marks Column +++====  --> 
                                            
                                            <!--  ====+++ Start Obtain Marks Column +++====  -->
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['Obtain'])) {
                                                          echo $xpld['Obtain'];
                                                      }                                           
                                                        
                                                  ?>
                                                  
                                             </td>
                                           <!--  ====+++ End Obtain Marks Column +++====  -->     
                                           
                                           
                                           <!--  ====+++ Start Grade Point Column +++====  -->     
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['GP'])) {
                                                          echo $xpld['GP'];
                                                      }  
                                                      else
                                                      {
                                                        echo 0;
                                                      }                                         
                                                        
                                                  ?>
                                                  
                                             </td>
                                        <!--  ====+++ End Grade Point Column +++====  -->        
                                             
                                        <!--  ====+++ Start Grade Letter Column +++====  -->     
                                             <td> 
                                                  <?php                                            
                                                      if (!empty($xpld['Grade'])) {
                                                          echo $xpld['Grade'];
                                                      }                                           
                                                        
                                                  ?>
                                            
                                             </td>
                                    <!--  ====+++ End Grade Letter Column +++====  -->  
                                    
                                </tr>
                                <?php
                                      }
                                      //$grdpoint_stu=0;

                                    }

                                // END Result loop for D Student List              

                               if(!empty($sorted_array_F))
                               {   

                                          if(empty($serial))
                                            {                                               
                                               $serial=0;
                                            }
                                            //for($f_s=0;$f_s<count($sorted_array_A); $f_s++)
                                            foreach($sorted_array_F as $A_Key => $xpld)
                                            {
                                           //     $explode=$sorted_array_A[$f_s];                                                    
                                       //         $xpld=explode(",",$explode);
                                                  
                                                                                
                                       ?>
                                         <tr>
                                             <td> 
                                                 <?php 
                                                     echo $serial=$serial+1;
                                                 ?>
                                             </td>
                                             <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ echo $xpld['StudentID']; }
                                                    
                                                ?>
                                            </td>
                                          
                                            <td> 
                                                <?php 
                                                    if(!empty($xpld['StudentID'])){ $name=getStudentName_Image($xpld['StudentID']); echo $name['firstName'] . " " . $name['lastName']; }
                                                    
                                                ?>
                                            </td>
                                            
                                            <!--  ====+++ Start Total Marks Column +++====  --> 
                                            <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['FullMark'])) {
                                                          echo $xpld['FullMark'];
                                                      }                                           
                                                        
                                                  ?>
                                            </td>  
                                            
                                           <!--  ====+++ End Total Marks Column +++====  --> 
                                            
                                            <!--  ====+++ Start Obtain Marks Column +++====  -->
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['Obtain'])) {
                                                          echo $xpld['Obtain'];
                                                      }                                           
                                                        
                                                  ?>
                                                  
                                             </td>
                                           <!--  ====+++ End Obtain Marks Column +++====  -->     
                                           
                                           
                                           <!--  ====+++ Start Grade Point Column +++====  -->     
                                             <td> 
                                                 <?php                                            
                                                      if (!empty($xpld['GP'])) {
                                                          echo $xpld['GP'];
                                                      }  
                                                      else
                                                      {
                                                        echo 0;
                                                      }                                         
                                                        
                                                  ?>
                                                  
                                             </td>
                                        <!--  ====+++ End Grade Point Column +++====  -->        
                                             
                                        <!--  ====+++ Start Grade Letter Column +++====  -->     
                                             <td> 
                                                  <?php                                            
                                                      if (!empty($xpld['Grade'])) {
                                                          echo $xpld['Grade'];
                                                      }                                           
                                                        
                                                  ?>
                                            
                                             </td>
                                  <!--  ====+++ End Grade Letter Column +++====  -->  
                                  
                              </tr>
                              <?php
                                    }
                                    //$grdpoint_stu=0;

                                  }

                              // END Result loop for F Student List         

                          ?>        

                    

            </tbody>   
        </table>   
      </div>        
    </div>    


    <?php
}
?>


<!-- Right Side/Main Content End --> 
