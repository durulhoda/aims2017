<!-- /Content Section  -->                    
    <div class="page-header">
       
        <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
            <span class="btn btn-purple no-border">
                <i class="ace-icon fa fa-print bigger-130"></i>
                <span class="bigger-110">Print Transcript</span>
            </span>
        </button>
    </div><!-- /.page-header -->
<div class="row" id="printableArea">
    <div class="widget-header-small align-center">
        <h5 class="red lighter">
             Academic Transcript           
        </h5> 
        <h4 class="red lighter bolder">
            <?php 
                    $ins_name=getInstituteInfo(); 
                    echo $ins_name['instituteName'] ;
              ?>
        </h4>                    
    </div>
    <div class="col-sm-7 col-xs-7">
        <div class="widget-box">
           
            <div class="widget-body">
                <div class="widget-main">
                    
                    <div class="row">
                        <div class="col-xs-8">
                            <span class="pull-left">
                                <span class="green bolder">
                                    <i class="ace-icon fa fa-user"></i>&nbsp;
                                    <?php if(!empty($studentlist['firstName'])){ echo $studentlist['firstName'];} ?>
                                </span>
                                <div class="space-6"></div>
                                <span class="red bolder">
                                    Student Id: 
                                    <cite title="Applicant Gender" class="red bolder"> <?php echo ($studentlist['studentId']); ?> </cite>                                    
                                </span>
                              
                            </span>
                        </div>   
                          <div class="col-xs-4">  
                            <div class="profile-contact-info pull-right">
                                <div class="profile-contact-links align-left">
                           
                                    <?php
                                         if ($studentlist['photo']) {
                                      ?>
                                         <img  src="<?php if (file_exists($studentlist['photo'])) { echo base_url() . $studentlist['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60">
                                     <?php 
                                            } 
                                     ?>                           
                                </div>
                            </div>  
                            
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="profile-contact-info">
                                <div class="profile-contact-links align-left">
                                    <a href="#" class="btn btn-link">
                                       <?php if(!empty($programinfo['programId'])){ ?>
                                            <small>        
                                                <span class="red"> Class: </span>
                                                <cite title="Class"> <?php echo getProgramName($programinfo['programId']);  ?> </cite>                                    
                                            </small>
                                        <?php } ?> 
                                    </a>

                                    <a href="#" class="btn btn-link">
                                        <?php if (!empty($programinfo['mediumId'])) { ?>
                                            <small>        
                                                <span class="red"> Medium: </span>
                                                <cite title="Medium"> <?php echo getmediumName($programinfo['mediumId']); ?> </cite>                                    
                                            </small>
                                        <?php } ?>
                                    </a>
                                    
                                    <a href="#" class="btn btn-link">
                                        <?php if (!empty($programinfo['sectionId'])) { ?>
                                            <small>        
                                                <span class="red"> Section: </span>
                                                <cite title="Section"> <?php echo getsectionName($programinfo['sectionId']); ?> </cite>                                    
                                            </small>
                                        <?php } ?>
                                    </a>

                                    <a href="#" class="btn btn-link">
                                         <?php if (!empty($programinfo['groupId'])) { ?>
                                            <small>        
                                                <span class="red"> Group: </span>
                                                <cite title="Group"> <?php echo getGroupName($programinfo['groupId']); ?> </cite>                                    
                                            </small>
                                        <?php } ?>

                                    </a>
                                    <a href="#" class="btn btn-link">
                                        <?php if (!empty($programinfo['shiftId'])) { ?>
                                            <small>        
                                                <span class="red"> Shift: </span>
                                                <cite title="Shift"> <?php echo getshiftName($programinfo['shiftId']); ?> </cite>                                    
                                            </small>
                                        <?php } ?>
                                    </a>

                                    

                                    <a href="#" class="btn btn-link">
                                        <?php if (!empty($programinfo['sessionId'])) { ?>
                                            <small>        
                                                <span class="red"> Session: </span>
                                                <cite title="Session"> <?php echo getSessionName($programinfo['sessionId']); ?> </cite>                                    
                                            </small>
                                        <?php } ?>

                                    </a>
                                    <a href="#" class="btn btn-link">
                                        <?php if (!empty($semesterId)) { ?>
                                            <small>        
                                                <span class="red"> Semester: </span>
                                                <cite title="semesterId"><?php echo getSemesterName($semesterId); ?> </cite>                                    
                                            </small>
                                        <?php } ?>

                                    </a>
                                    
                                </div>

                            </div>
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-5">       

        <div class="row">
            <div class="col-xs-5">
                <div class="pull-left width-30  col-md-offset-1">
                    <small class="bolder">
                        Grade Letter
                    </small>
                    <div class="ace-settings-item">
                        A+
                    </div>

                    <div class="ace-settings-item">
                        A
                    </div>

                    <div class="ace-settings-item">
                        A-
                    </div>

                    <div class="ace-settings-item">
                        B
                    </div>

                    <div class="ace-settings-item">
                        C
                    </div>
                    <div class="ace-settings-item">
                        D
                    </div>
                    <div class="ace-settings-item">
                        F
                    </div>
                </div><!-- /.pull-left -->

                <div class="pull-left width-30">
                    <small class="bolder">
                        Exam Marks
                    </small>    
                    <div class="ace-settings-item">
                        80-100
                    </div>

                    <div class="ace-settings-item">
                        70-79
                    </div>

                    <div class="ace-settings-item">
                        65-69
                    </div>
                    <div class="ace-settings-item">
                        60-64
                    </div>

                    <div class="ace-settings-item">
                        50-59
                    </div>

                    <div class="ace-settings-item">
                        40-49
                    </div>
                    <div class="ace-settings-item">
                        0-39
                    </div>
                </div><!-- /.pull-left -->
                <div class="pull-left width-30">
                    <small class="bolder">
                        Grade Point
                    </small>  
                    <div class="ace-settings-item">
                        5
                    </div>

                    <div class="ace-settings-item">
                        4
                    </div>

                    <div class="ace-settings-item">
                        3.50
                    </div>
                    <div class="ace-settings-item">
                        3
                    </div>
                    <div class="ace-settings-item">
                        2
                    </div>

                    <div class="ace-settings-item">
                        1
                    </div>
                    <div class="ace-settings-item">
                        0
                    </div>
                </div>      
                    
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-xs-12">
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        
                        <tr>
                            <th>Sl No</th>
                            <th>Subject</th>
                            <th class="hidden-480">Subject Code</th>
                            <th>Full Mark</th>
                            <th style="text-align:center">
                                Mark List
                                <!-- <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                    <?php
                                        $allcategory=getmarkcategoryList();
                                        if(!empty($allcategory))
                                        {
                                            foreach($allcategory as $d_mark)
                                            {
                                    ?>    
                                                <td><?php 
                                                        $mrk_string=$d_mark['category_title']; 
                                                        echo substr($mrk_string,0,2);
                                                    ?></td>
                                    <?php
                                            }

                                        }   
                                    ?>
                                    </tr>    
                                </table> -->
                            </th>
                            <th>Obtain Mark</th>
                            <th>Grade Point</th>
                            <th>Grade Letter</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
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
                                ?>
                         
                        <tr style="background:<?php if(!empty($optional_subject)==2){ echo "#FFE2BA"; } ?>">
                            <td> <?php echo $i; ?> </td>
                            <td>
                                    <?php
                                        if (!empty($value['courseId'])) {
                                            echo ($value['courseName']);
                                        }
                                    ?>                  
                            </td>
                            <td class="hidden-480">
                                    <?php
                                        if (!empty($value['courseId'])) {
                                            echo ($value['courseCode']);
                                        }
                                    ?>
                            </td>
                            <td>
                                    <?php
                                        if (!empty($value['courseId'])) {
                                            echo $coursemark = getCourseMarks($value);
                                        }
                                    ?>
                            </td>
                            <td>                              
                                        <?php
                                               
                                               $data['courseId'] = $value['courseId'];                                              
                                               
                                               $data['programOfferId']=$programOfferId;

                                                $marks_devide = getMarkDevidevalue($data);                                            
                                                 
                                                 //   echo "<pre>"; print_r($marks_devide);
                                                    $ex_pld = explode(",", trim($marks_devide['mark_cat_id']));
                                                    $ex_pld_assng_dvd = explode(",", trim($marks_devide['dis_divide_mark']));
                                                    $ex_pld_dvd = explode(",", trim($value['divide_mark'])); // this mark is from student marks table
                                                    $ex_pld_percnt = explode(",", trim($marks_devide['mark_percent']));
                                                     
                                                    $marks=0; 
                                                    for($ck_val=1;$ck_val<count($ex_pld)-1; $ck_val++)
                                                    {
                                                        //echo $ex_pld_assng_dvd[$ck_val]."++".$ex_pld_percnt[$ck_val];
                                                        
                                                        $mrk_string=getMarkTitle($ex_pld[$ck_val]);
                                                        echo "<span style=\"padding:0 2px;width:60px;border:1px solid #ccc;float:left;\">".substr($mrk_string,0,2)." - ".$ex_pld_dvd[$ck_val]."</span>";  
                                                        if(!empty($ex_pld_percnt[$ck_val]))
                                                        {
                                                            $percent_marks = ($ex_pld_percnt[$ck_val] * $ex_pld_dvd[$ck_val]) / 100; 
                                                            $marks=$marks+$percent_marks;
                                                        }
                                                    }    
                                                                         
                                        ?>
                                    
                                    
                            </td>
                            <td>
                                    <?php
                                   
                                    if (!empty($marks)) {
                                          
                                        echo  $marks ;
                                    }
                                    ?>
                            </td>
                            <td>
                                            <?PHP
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
                                                    echo $minus_point = 5;
                                                    $gradepoint = 0;
                                                    $_fail_gradepoint = 5;
                                                } else {
                                                    echo $gradepoint = 5;
                                                    $_fail_gradepoint = 5;
                                                }

                                                //    echo $a;
                                            } elseif (in_array($convertmarks, range(70.00, 79.00))) {
                                                if (!empty($optional_subject) == 2) {
                                                    echo $minus_point = 4;
                                                    $gradepoint = 0;
                                                    $_fail_gradepoint = 4;
                                                } else {
                                                    echo $gradepoint = 4;
                                                    $_fail_gradepoint = 4;
                                                }
                                                //    echo $a;
                                            } elseif (in_array($convertmarks, range(60.00, 69.00))) {
                                                if (!empty($optional_subject) == 2) {
                                                    echo $minus_point = 3.5;
                                                    $gradepoint = 0;
                                                    $_fail_gradepoint = 3.5;
                                                } else {
                                                    echo $gradepoint = 3.5;
                                                    $_fail_gradepoint = 3.5;
                                                }
                                                //    echo $a;
                                            } elseif (in_array($convertmarks, range(50.00, 59.00))) {
                                                if (!empty($optional_subject) == 2) {
                                                    echo $minus_point = 3;
                                                    $gradepoint = 0;
                                                    $_fail_gradepoint = 3;
                                                } else {
                                                    echo $gradepoint = 3;
                                                    $_fail_gradepoint = 3;
                                                }
                                                //    echo $a;
                                            } elseif (in_array($convertmarks, range(40.00, 49.00))) {
                                                if (!empty($optional_subject) == 2) {
                                                    echo $minus_point = 2;
                                                    $gradepoint = 0;
                                                    $_fail_gradepoint = 2;
                                                } else {
                                                    echo $gradepoint = 2;
                                                    $_fail_gradepoint = 2;
                                                }
                                                //    echo $a;
                                            } elseif (in_array($convertmarks, range(33.00, 39.00))) {
                                                if (!empty($optional_subject) == 2) {
                                                    echo $minus_point = 1;
                                                    $gradepoint = 0;
                                                    $_fail_gradepoint = 1;
                                                } else {
                                                    echo $gradepoint = 1;
                                                    $_fail_gradepoint = 1;
                                                }
                                                //    echo $a;
                                            } else {
                                                echo $gradepoint = 0;
                                                $_fail_gradepoint = 0;
                                            }
                                            ?>
                            </td>

                            <td>
                                            <?php
                                            $data['studentId'] = $value['studentId'];
                                            $data['semester'] = $value['semester'];
                                            $data['courseId'] = $value['courseId'];

                                            $percentmark = (100 / $coursemark) * $marks;
                                            $convertmark = doubleval(intval($percentmark));
                                            if (in_array($convertmark, range(80, 100))) {
                                                echo "A+";
                                                //    echo $a;
                                            } elseif (in_array($convertmark, range(70, 79))) {
                                                echo "A";
                                                //    echo $a;
                                            } elseif (in_array($convertmark, range(60, 69))) {
                                                echo "A-";
                                                //    echo $a;
                                            } elseif (in_array($convertmark, range(50, 59))) {
                                                echo "B";
                                                //    echo $a;
                                            } elseif (in_array($convertmark, range(40, 49))) {
                                                echo "C";
                                                //    echo $a;
                                            } elseif (in_array($convertmark, range(33, 39))) {
                                                echo "D";
                                                //    echo $a;
                                            }
                                            else {
                                                echo "<span class=\"bolder red\">F</span>";
                                            }
                                            ?>
                            </td>
                            
                        </tr>
                                    <?php
                                    $count_i = $i;

                                    $totalcoursemark = $coursemark + $totalcoursemark;
                                    $totalmark = $marks + $totalmark;
                                    $totalgradepoint = $gradepoint + $totalgradepoint;
                                    $get_grade_arry[] = $_fail_gradepoint;

                                            $i++;
                                        }
                                    }
                                }
                                //End Foreach----------------------

                                $checkarraymark = array($convertmark);
                        ?>
                        <tr>
                            <td colspan="3" class="align-right bolder red"> 
                                Total: 
                               
                            </td>
                            <td colspan="2" class="align-left bolder red"> 
                              
                                <?php
                                echo $totalcoursemark;
                                ?>

                            </td>
                            <td  class="align-left bolder red"> 
                              
                                <?php
                                echo $totalmark;
                                ?>

                            </td>
                            <td class="align-center bolder red">
                                CGPA : 
                                   <?php
                                   
                                        if(in_array(0, $get_grade_arry)) {
                                            echo $grade_mark = 0;
                                        } 
                                        else
                                        {
                                            if (!empty($minus_point)) {
                                                $minus_i = $count_i - 1;
                                                $minus = $minus_point - 2;
                                                
                                                $t_grade_witout_optional_point=$totalgradepoint+$minus;
                                              
                                                $cgpa = $t_grade_witout_optional_point / $minus_i;
                                                $substr = substr($cgpa, 0, 4);                                                
                                                echo $grade_mark = $substr;
                                            } else {
                                                $cgpa = $totalgradepoint / $count_i;
                                                echo $grade_mark = substr($cgpa, 0, 4);
                                            }
                                        }
                                  ?>
                            </td>
                            <td class="align-center bolder red">
                                Grade Letter : 
                                <?php
                                       if(in_array(0, $get_grade_arry)) {
                                             $grade_mark = 0;
                                           echo  $grd = "F";
                                        }
                                        else
                                        {
                                                $convertmark=$grade_mark;;
                                                if (in_array($convertmark, range(0, 1))) {
                                                        //if ($convertmark <0) {
                                                        echo $grd = "F";
                                                    } elseif ($convertmark>=5) {
                                                        echo $grd = "A+";
                                                        //    echo $a;
                                                    } 
                                                    elseif(4<= $convertmark &&  $convertmark<= 5) {    
                                                        echo $grd = "A";
                                                        //    echo $a;
                                                    } elseif(3.5<= $convertmark &&  $convertmark<= 3.99) {  
                                                        echo $grd = "A-";
                                                        //    echo $a;
                                                    } elseif(3<= $convertmark &&  $convertmark<= 3.49) {  
                                                        echo $grd = "B";
                                                        //    echo $a;
                                                    } elseif(2<= $convertmark &&  $convertmark<= 2.99) {  
                                                        echo $grd = "C";
                                                        //    echo $a;
                                                    } elseif(1<= $convertmark &&  $convertmark<= 1.99) { 
                                                        echo $grd = "D";
                                                        //    echo $a;
                                                    }
                                                    else {
                                                        echo $grd = "F";
                                                    }
                                        }
                                  ?>             
                            </td>
                            
                        </tr>
                        <tr>

                            <td colspan="8" class="align-center bolder red"> 
                              
                                Result Comments : 
                                <?php echo ($grd == 'A+')? "Excellent Result" : ""; ?>
                                <?php echo ($grd == 'A') ? "Very Good Result" : ""; ?>
                                <?php echo ($grd == 'A-')? "Keep Trying Better" : ""; ?>
                                <?php echo ($grd == 'B') ? "Try Hard Work" : ""; ?>
                                <?php echo ($grd == 'C') ? "Result Not Good" : ""; ?>
                                <?php echo ($grd == 'D') ? "Below Average Result" : ""; ?>
                                <?php echo ($grd == 'F') ? "Fail" : ""; ?>

                            </td>
                        </tr>
                    </tbody>  
                </table>   
            </div>
     </div>        
</div><!-- PAGE CONTENT ENDS -->



