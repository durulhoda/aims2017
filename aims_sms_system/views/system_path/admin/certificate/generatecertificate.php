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
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-barcode red"></i>
                    Certificate
                </h3>

            </div>
        </div>
        <div class="widget-box transparent ">
            <div class="widget-header widget-header-large">
                <div class="widget-toolbar pull-left">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                    <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Search Again By Individual Student </a>

                </div>


                <div class="pull-right">


                    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
                        <span class="btn btn-purple no-border">
                            <i class="ace-icon fa fa-print bigger-130"></i>
                            <span class="bigger-110">Print Transcript</span>
                        </span>
                    </button>
                    <!-- /.page-header -->



                </div>

            </div>
        </div>


        <div id="modal-table_student" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            Search Again By Individual Student
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-body no-padding">

                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/Certificate/genrtStudentcertificate" method="post">
                                <div class="col-xs-12 col-sm-12">  
                                    <!-- PAGE CONTENT BEGINS -->
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">StudentId &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <input type="text" name="data[studentId]" required="1" value="<?php echo set_value("data[studentId]"); ?>" class="form-control" id="form-field-1" placeholder="Student Id" />
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select name="data[semesterId]" class="form-control" id="form-field-select-1">
                                            <option value="">Select</option>
                                            <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                                <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE) ?>>
                                                    <?php echo $velues['semester'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select name="data[sessionId]" required="1" class="form-control" id="form-field-select-1">
                                            <option value=""></option> 
                                            <?php foreach (getOfferedSession() as $value) { ?>
                                                <option value="<?php echo $value['sessionId']; ?>" 
                                                        <?php echo set_select('data[sessionId]', $value['session'], FALSE) ?> >
                                                    <?php echo $value['session']; ?></option>                                                
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div> 


                                <div class="col-xs-12">
                                    <div class="clearfix form-actions">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" name="search" type="submit">
                                                <i class="ace-icon fa fa-search bigger-120"></i>
                                                Generate Certificate
                                            </button>

                                        </div>
                                    </div>
                                </div>        
                            </form>

                        </div>    
                    </div>       
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS -->

        <div id="printableArea">          
            <div style="width:100%; margin-left: auto; margin-right: auto; padding: 36px;  border: 2px dashed;">
                <div style="border: 0px solid #e1e1d2; padding: 10px; border-radius:2px;">
                    <div style="text-align: center;">
                        <?php
                        $ins_info = getInstituteInfo();
                        ?>
                        <h2 style="color: #000; font-family: Algerian; text-transform: uppercase;"> <?php
                        $ins_name = getInstituteInfo();
                        echo $ins_name['instituteName'];
                        ?></h2>
                        <h4 style="color: #000 !important; text-transform: uppercase;"> <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?> </h4>

                    </div>
                    <div style="width: 100%;">
                        <div style="float: left; width: 30%; height: auto; margin-left: 20px; padding: 4px;">
                            <p>Serial No.  
                            
<?php
$input = $studentId;
echo mb_strimwidth("$input", 5, 10, ".");
// outputs Hello W...
?>

                            </p>
                  
                        </div>
                        <?php
                        $ins_info = getInstituteInfo();
                        ?>

                        <div style="float: left; width: 30%; height: auto; margin-left: 20px; padding: 4px;">
                            <center> <img  src="<?php echo base_Url() . $ins_info['logo'] ?>" height="90" left="2px;" align="middle"></center>

                        </div>


                        <div style="float: right; width: 30%; height: auto; text-align: right;">
                          <p>    <?php echo "Date:" . date("d/m/Y") . "<br>";?> &nbsp; &nbsp; &nbsp; &nbsp;</p>
                      
                        


                        </div>
                    </div>  


                    <br> <br> <br><br> <br> <br><br> 
                    <div style="width: 100%; text-align: center; ">
                      <span style="font-size: 18px;">  <b> Certificate/Testimonial</b></span>
                    </div>

                    <div style="width: 100%; text-align: center; margin-top: 18px; border: 2px solid lightblue; font-family: Lucida Calligraphy;">
                        <br>
                        <P>This is to certify that  <span style="font-size: 18px; font-weight: 600;"><?php echo "<b>" . ($studentinfo['firstName'] . " " . $studentinfo['lastName'])."," ." "."ID-$studentId". "</b>"; ?></span>
                            Son/daughter of </p><p> <span style="font-size: 18px; font-weight: 600;"><?php echo "<b>" . ( " " . $studentinfo['fatherName']) . "</b>"; ?></span><span style="font-size: 20px;"> & </span><span style="font-size: 18px; font-weight: 600;"> <?php echo "<b>" . ( " " . $studentinfo['motherName']) . "</b>"; ?></span></P>
                        
                        
                        <P>of    <span style="font-size: 18px; font-weight: 600;">  <?php echo "<b>" . $ins_name['instituteName'] . "</b>"; ?></span></P>
                        <P>Bearing Student ID No. <span style="font-size: 18px; font-weight: 600;"> <?php echo "<b>" . $studentId . "</b>"; ?> </span>Only passed the</P>
                        <P>Examination of  <span style="font-size: 18px; font-weight: 600;"><?php
                            echo "<b>" . getProgramName($programoffer_info['programId']) . "</b>";
                        ?></span>, Session-<span style="font-size: 18px; font-weight: 600;"><?php
                            echo "<b>" . getSessionName($programoffer_info['sessionId']) . "</b>";
                        ?></span>, Group-<span style="font-size: 18px; font-weight: 600;"><?php
                            echo "<b>" . getGroupName($programoffer_info['groupId']) . "</b>";
                        ?></span>
                        
                        </P>
                        <P>The Candidate has been awarded the Grade Point <?php
                                $i = 1;

                                $totalcoursemark = 0;
                                $totalmark = 0;
                                $totalgradepoint = 0;
                                
                                $infox['studentId'] = $studentlist['studentId'];
                                $infox['programOfferId'] = $programOfferId;
                                $valuess = getCourseIdByStudent($infox);
                                
                                foreach ($markslist as $value) {
                                    $assigncourselist = getAssignCourseListByPrg_stuid($value['programOfferId'], $value['studentId']);
                                    $editDatas = explode(",", trim($assigncourselist['courseId'], ","));
                                    $countcourse = count($editDatas);
                                    $expld_course=0;
                                    for ($x = 0; $x < $countcourse; $x++) {

                                        if ($editDatas[$x] == $value['courseId']) {
                                           
                                            $optional_subject = 0;
                                            $explodeCourse = explode(',', trim($valuess['courseId']));
                                            $explodeCourseStatus = explode(',', trim($valuess['courseStatus']));
                                            for ($sll = 0; $sll < count($explodeCourse); $sll++) {
                                                $chk_status = $explodeCourseStatus[$sll]; // get COURSE STATUS------
                                                if ($chk_status == 2 && $explodeCourse[$sll] == $value['courseId']) {
                                                    $optional_subject = 2;
                                                    $expld_course=$explodeCourse[$sll];
                                                    break;
                                                }
                                            }

                                   // Subject ----NAme & Code

                                        if (!empty($value['courseId'])) {
                                            $print_course_name=($value['courseName']);
                                            if(!empty($optional_subject)==2)
                                            {
                                              // print optional subject 
                                              $print_optional_course_name = ($value['courseName']); 
                                            }     
                                        }

                                        if (!empty($value['courseId'])) {
                                            $print_course_code=($value['courseCode']);
                                            if(!empty($optional_subject)==2)
                                            {
                                              // print optional subject 
                                              $print_optional_course_code = ($value['courseCode']); 
                                            }
                                        }

                                   //-------------------------------------         
                                   // Subject Assign Full Marks -------------------
                                        if (!empty($value['courseId'])) {
                                            $coursemark = getCourseMarks($value);
                                            $print_course_mark=$coursemark;
                                            if(!empty($optional_subject)==2)
                                            {
                                              $print_optional_course_mark = $coursemark; 
                                            }
                                        }
                                   //===================================    

                                   // Marks By Category -------------------
                                         $data['courseId'] = $value['courseId'];

                                         $data['programOfferId'] = $programOfferId;

                                         $marks_devide = getMarkDevidevalue($data);

                                         //   echo "<pre>"; print_r($marks_devide);
                                         $ex_pld = explode(",", trim($marks_devide['mark_cat_id']));
                                         $ex_pld_assng_dvd = explode(",", trim($marks_devide['dis_divide_mark']));
                                         $ex_pld_dvd = explode(",", trim($value['divide_mark'])); // this mark is from student marks table
                                         $ex_pld_percnt = explode(",", trim($marks_devide['mark_percent']));

                                         $marks = 0;
                                         $print_category_mark="";
                                         $print_optional_category_mark="";
                                         for ($ck_val = 1; $ck_val < count($ex_pld) - 1; $ck_val++) {
                                             //echo $ex_pld_assng_dvd[$ck_val]."++".$ex_pld_percnt[$ck_val];

                                             $mrk_string = getMarkTitle($ex_pld[$ck_val]);
                                             
                                             $category_mark= substr($mrk_string, 0, 1)." - ".$ex_pld_dvd[$ck_val];
                                            
                                             if (!empty($ex_pld_percnt[$ck_val])) {
                                                 $percent_marks = ($ex_pld_percnt[$ck_val] * $ex_pld_dvd[$ck_val]) / 100;
                                                 $marks = $marks + $percent_marks;
                                             }
                                             
                                             $print_category_mark =$print_category_mark."+".$category_mark;
                                             if(!empty($optional_subject)==2)
                                             {
                                               $print_optional_category_mark =$print_optional_category_mark."+".$category_mark; 
                                             }
                                         }  
                                         
                                   //====================================== 

                                   // Subject Obtain Marks---------------------
                                        if (!empty($marks)) {
                                              
                                            $print_obtain_mark=$marks ;
                                            if(!empty($optional_subject)==2)
                                            {
                                              $print_optional_obtain_mark =$marks; 
                                            }
                                        }

                                   //============================================   

                                   // Subject Grade Point=-----------------------
                                        //echo "OP".$optional_subject."-";
                                        $data['studentId'] = $value['studentId'];
                                        $data['semester'] = $value['semester'];
                                        $data['courseId'] = $value['courseId'];
                                        //                                        $data['exam_type']=$value['exam_type'];
                                        //   $mark= getExamMarks($data);

                                        $percentmarks = (100 / $coursemark) * $marks;

                                        $convertmarks = doubleval(intval($percentmarks));

                                        if (in_array($convertmarks, range(80.00, 100.00))) {
                                            if (!empty($optional_subject) == 2) {
                                                $minus_point = 5;
                                                $gradepoint = 0;
                                                $_fail_gradepoint = 5;

                                                $print_optional_gradepoint =$minus_point; 

                                            } else {
                                                $gradepoint = 5;
                                                $_fail_gradepoint = 5;

                                                $print_gradepoint=$gradepoint ;
                                                
                                            }

                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(70.00, 79.00))) {
                                            if (!empty($optional_subject) == 2) {
                                                $minus_point = 4;
                                                $gradepoint = 0;
                                                $_fail_gradepoint = 4;

                                                $print_optional_gradepoint =$minus_point; 
                                            } else {
                                                $gradepoint = 4;
                                                $_fail_gradepoint = 4;

                                                $print_gradepoint=$gradepoint ;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(60.00, 69.00))) {
                                            if (!empty($optional_subject) == 2) {
                                                $minus_point = 3.5;
                                                $gradepoint = 0;
                                                $_fail_gradepoint = 3.5;

                                                $print_optional_gradepoint =$minus_point; 
                                            } else {
                                                $gradepoint = 3.5;
                                                $_fail_gradepoint = 3.5;

                                                $print_gradepoint=$gradepoint ;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(50.00, 59.00))) {
                                            if (!empty($optional_subject) == 2) {
                                                $minus_point = 3;
                                                $gradepoint = 0;
                                                $_fail_gradepoint = 3;

                                                $print_optional_gradepoint =$minus_point; 
                                            } else {
                                                $gradepoint = 3;
                                                $_fail_gradepoint = 3;

                                                $print_gradepoint=$gradepoint ;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(40.00, 49.00))) {
                                            if (!empty($optional_subject) == 2) {
                                                $minus_point = 2;
                                                $gradepoint = 0;
                                                $_fail_gradepoint = 2;

                                                $print_optional_gradepoint =$minus_point; 
                                            } else {
                                                $gradepoint = 2;
                                                $_fail_gradepoint = 2;

                                                 $print_gradepoint=$gradepoint ;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(33.00, 39.00))) {
                                            if (!empty($optional_subject) == 2) {
                                                $minus_point = 1;
                                                $gradepoint = 0;
                                                $_fail_gradepoint = 1;

                                                $print_optional_gradepoint =$minus_point; 
                                            } else {
                                                $gradepoint = 1;
                                                $_fail_gradepoint = 1;

                                                $print_gradepoint=$gradepoint ;
                                            }
                                            //    echo $a;
                                        } else {
                                            $gradepoint = 0;
                                            $_fail_gradepoint = 0;
                                            $minus_point = 1;
                                            $print_gradepoint=$gradepoint ;
                                            $print_optional_gradepoint =$minus_point; 
                                        }

                                    //======================================================            

                                    // ---------------------------------------------
                                        if (in_array($convertmarks, range(80, 100))) {
                                            $get_grade="A+";

                                            $print_grademark=$get_grade;
                                            if(!empty($optional_subject)==2){ 
                                                $print_optional_grademark=$get_grade;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(70, 79))) {
                                            $get_grade="A";

                                            $print_grademark=$get_grade;
                                            if(!empty($optional_subject)==2){ 
                                                $print_optional_grademark=$get_grade;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(60, 69))) {
                                            $get_grade="A-";

                                            $print_grademark=$get_grade;
                                            if(!empty($optional_subject)==2){ 
                                                $print_optional_grademark=$get_grade;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(50, 59))) {
                                            $get_grade="B";

                                            $print_grademark=$get_grade;
                                            if(!empty($optional_subject)==2){ 
                                                $print_optional_grademark=$get_grade;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(40, 49))) {
                                            $get_grade="C";

                                            $print_grademark=$get_grade;
                                            if(!empty($optional_subject)==2){ 
                                                $print_optional_grademark=$get_grade;
                                            }
                                            //    echo $a;
                                        } elseif (in_array($convertmarks, range(33, 39))) {
                                            $get_grade="D";

                                            $print_grademark=$get_grade;
                                            if(!empty($optional_subject)==2){ 
                                                $print_optional_grademark=$get_grade;
                                            }
                                            //    echo $a;
                                        } else {
                                            $get_grade="F";

                                            $print_grademark=$get_grade;
                                            if(!empty($optional_subject)==2){ 
                                                $print_optional_grademark=$get_grade;
                                            }
                                        }   

                                    // --------------------------------------------
                                    
                                    // End Foreach Counting====================
                                            $count_i = $i;

                                            $totalcoursemark = $coursemark + $totalcoursemark;
                                            $totalmark = $marks + $totalmark;
                                            $totalgradepoint = $gradepoint + $totalgradepoint;
                                            $get_grade_arry[] = $_fail_gradepoint;

                                            $i++;


                                            // Now merge in array------------------------------
                                            
                                            if((!empty($optional_subject)!=2))
                                            {        

                                                //$print_category_mark                                         
                                                $sorted_array_marks[]=$print_course_name.">".$print_course_code.">".$print_course_mark.">".$print_category_mark.">".$print_obtain_mark.">".$print_gradepoint.">".$print_grademark;
                                               
                                            }
                                            elseif(!empty($optional_subject)==2){ 
                                                //$print_optional_category_mark
                                                $sorted_array_optionalmark[]=$print_optional_course_name.">".$print_optional_course_code.">".$print_optional_course_mark.">".$print_optional_category_mark.">".$print_optional_obtain_mark.">".$print_optional_gradepoint.">".$print_optional_grademark;
                                            }  
                                            


                               // ENd foreach....             
                                        }
                                    }
                                        
                                }
                             //End Foreach----------------------

                                        $checkarraymark = array($convertmarks);
                                   
                            //===================================================         
                                 
                                  if(!empty($sorted_array_marks))
                                  {   

                                     $serial=0;
                                    for($f_s=0;$f_s<count($sorted_array_marks); $f_s++)
                                    {
                                        $explode=$sorted_array_marks[$f_s];                                                    
                                        $xpld=explode(">",$explode);            

                                ?>  
                            
                        <?php
                            
                               }
                            }   

                           
                           if(!empty($sorted_array_optionalmark))
                            {   

                              if(empty($serial)) 
                              {
                                 $serial=0;
                              }
                              for($f_s=0;$f_s<count($sorted_array_optionalmark); $f_s++)
                              {
                                  $explode=$sorted_array_optionalmark[$f_s];                                                    
                                  $xpld=explode(">",$explode);
                           
                        ?>
                           

                         <?php
                                }
                             }

                        ?>    


                    
                                        
                                        


                                            <span style="font-size: 20px; font-weight: 600;"> <?php
                                        if (in_array(0, $get_grade_arry)) {
                                            echo $grade_mark = 0;
                                        } else {
                                            if (!empty($minus_point)) {
                                                $minus_i = $count_i - 1;
                                                $minus = $minus_point - 2;

                                                $t_grade_witout_optional_point = $totalgradepoint + $minus;

                                                $cgpa = $t_grade_witout_optional_point / $minus_i;
                                                $substr = substr($cgpa, 0, 4);
                                                echo $grade_mark = $substr;
                                            } else {
                                                $cgpa = $totalgradepoint / $count_i;
                                                echo $grade_mark = substr($cgpa, 0, 4);
                                            }
                                        }
                                        ?></span> for his/her performance.</P>
                        <P>His/Her date of birth is <span style="font-size: 18px; font-weight: 600;"><?php echo '<b>' . $studentinfo['dateOfBirth'] . '</b>'; ?></span></P>


                    </div>


                    <br> <br> <br>
                    <div style="width: 45%; float: left; padding: 3px;"> Date Of Publication of Result: <?php echo $certificatedatebydate['entryDate']; ?></div>
                    <div style="width: 45%; float: right; padding:3px; text-align: right; margin-top: -35px;">
                        <img src="<?php echo base_url();?>images/Photo/examcontr.jpg" width="75px" left="20px"><br>
                        Controller Of Examinations </div>
                    <br><br><br>
                </div>
                <p style="color:red; text-align: center;"> Note: This Certificate is issued without any alteration or erasure.</p>

 
            </div>
        </div>
    </div>
</div>

                                 