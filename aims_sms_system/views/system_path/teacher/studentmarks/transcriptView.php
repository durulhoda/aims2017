<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
    
    <div class="page-header">
       
        <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
            <span class="btn btn-purple no-border">
                <i class="ace-icon fa fa-print bigger-130"></i>
                <span class="bigger-110">Print Transcript</span>
            </span>
        </button>
    </div><!-- /.page-header -->


            <div id="printableArea" >


                <div style="margin: 20px auto;  width: 850px; border: 0px solid #cccccc; " > 
                    <div style=" border: 1px solid #d9d9d9;">      
                        <div >   
                            <table style="width:100%; ">
                                <tr> <td style="text-align: center;"> <h2>ACADEMIC TRANSCRIPT</h2> </td> </tr>
                                <tr> 

                                    <td >


                                        <p style="margin-left:5px;">
                                                              <?php
                    $ins_info = getInstituteInfo();
                    ?>
                                            
                                      
                                         <img  src="<?php echo base_Url() . $ins_info['logo'] ?>" height="90" left="2px;" align="middle">
                                   
                    
                                            <span style="font-size: 20px; margin-left: 10px; font-size: 28px; color: red;">   <?php 
                    $ins_name=getInstituteInfo(); 
                    echo $ins_name['instituteName'] ;
              ?>
                                            </span>
                                            <div style="float: left; font-size: 18px; margin-left: 129px; margin-top: -48px; color: #444;"> 
  <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?></div>
                                           
                                        </p>

                                    </td>


                                </tr>

                            </table>         

                            <hr>
                            <br/>
                            <div style='float:left; border:0px solid red; width:193px; margin-left: 9px;'>
                                   <?php
                                         if ($studentlist['photo']) {
                                      ?>
                                         <img  src="<?php if (file_exists($studentlist['photo'])) { echo base_url() . $studentlist['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="152" height="auto" align="middle">
                                     <?php 
                                            } 
                                     ?> 
                            </div>
                            <div style='margin: 0px 0px 5px;float:left; width:642px; border:0px solid red;'>


                                <table style="width:56%; float: left;border:0px solid red; line-height: 18px;">


                                    <tr>
                                        <td style="text-align: left; ">    <span style="font-size: 14px;"><strong>  Student ID <strong> </span>                                       
                                        </td>
                                        <td>   
                                            <span style="font-size: 14px;">
                                                <strong>  : </strong><strong><?php echo ($studentlist['studentId']); ?> </strong>
                                            </span>

                                        </td>
                                    </tr>
                                    
                                    <tr style="line-height: 30px;">
                                        <td style="text-align: left; margin-top: 2px; ">
                                            <span style="font-size: 14px;"><strong> Name <strong> </span>                                       
                                                        </td>
                                                        <td>   
                                                            <span style="font-size: 14px;  margin-top: 2px;">
                                                                <strong>  : </strong><strong><?php if(!empty($studentlist['firstName'])){ echo $studentlist['firstName'];} ?> </strong>
                                                            </span>

                                                        </td>
                                                        </tr>  
                                    
                                         <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;">Class </span>                                        
                                        </td>
                                        
                                        <td> 
                                            <?php if(!empty($programinfo['programId'])){ ?>
                                            <p>
                                             <strong>  : </strong>  <?php echo getProgramName($programinfo['programId']);  ?>
                                            </p>
                                            <?php } ?>
                                        </td>
                                        
                                    </tr> 
                                    
                                        <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;"> Shift </span>                                       
                                        </td>
                                        <td>  
                                            <?php if (!empty($programinfo['shiftId'])) { ?>
                                            <p>
                                              <strong>  : </strong> <?php echo getshiftName($programinfo['shiftId']); ?>
                                            </p>
                                            <?php } ?>
                                        </td>
                                        
                                    </tr> 
                                    
                                        <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;"> Group </span>                                       
                                        </td>
                                        <td> 
                                            <?php if (!empty($programinfo['groupId'])) { ?>
                                             <p>
                                          <strong>  : </strong>  <?php echo getGroupName($programinfo['groupId']); ?>
                                            </p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    
                                        <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;">Section </span>                                        
                                        </td>
                                        <td>    
                                            <?php if (!empty($programinfo['sectionId'])) { ?>
                                            <p>
                                              <strong>  : </strong> <?php echo getsectionName($programinfo['sectionId']); ?>
                                            </p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    
                                    
                                        <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;">Exam Name </span>                                       
                                        </td>
                                        <td>   
                                            <?php if (!empty($semesterId)) { ?>
                                            <p>
                                           <strong>  : </strong>   <?php echo getSemesterName($semesterId); ?>
                                            </p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    
                                    
                                        <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;"> Session </span>                                       
                                        </td>
                                        
                                        <td>  
                                            <?php if (!empty($programinfo['sessionId'])) { ?>
                                            <p>
                                              <strong>  : </strong> <?php echo getSessionName($programinfo['sessionId']); ?>
                                            </p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                 

                                </table>

                                <table style="width:42%; float: right; border: 2px solid #cccccc; margin-right: 8px; border-collapse: collapse; ">
                                    <tr >
                                        <td style=" border: 1px solid #cccccc; text-align: center">Grade <br> Letter</td>
                                        <td style=" border: 1px solid #cccccc; text-align: center">Exam <br> Marks</td>
                                        <td style=" border: 1px solid #cccccc; text-align: center">Grade <br> Point</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center"> 
                                            A+                                       
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            80-100
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            5
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center"> 
                                            A                                       
                                        </td>
                                        <td style=" padding: 3px;border: 1px solid #cccccc; text-align: center">    
                                            70-79
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            4
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style=" padding: 3px; border: 1px solid #cccccc; text-align: center"> 
                                            A-                                       
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            60-69
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            3.50
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center"> 
                                            B                                       
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            50-59
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            3
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center"> 
                                            C                                       
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            40-49
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            2
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center"> 
                                            D                                       
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            33-39
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            1
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center"> 
                                            F                                       
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            0-32
                                        </td>
                                        <td style="padding: 3px; border: 1px solid #cccccc; text-align: center">    
                                            0
                                        </td>
                                    </tr>
                                </table>

                            </div>


                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Sl no.</th>
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Subject</th>
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Code</th>
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Full Mark</th>                                    
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Ob Marks</th>
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Total Mark</th>
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">L.G.</th>
                                    <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">GP</th>

                                </tr>

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
                                <tr style="border: 1px solid #D8D8D8; " >
                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                        <?php echo $serial=$f_s+1; ?>
                                    </td>

                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                       <?php 
                                            if(!empty($xpld[0])){ echo $xpld[0]; } 
                                        ?>
                                  
                                    </td>
                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                        <?php 
                                            if(!empty($xpld[1])){ echo $xpld[1]; } 
                                        ?>
                                    </td>

                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                        <?php 
                                            if(!empty($xpld[2])){ echo $xpld[2]; } 
                                        ?>
                                    </td>  
                                                
                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                        <?php 
                                            if(!empty($xpld[3])){ 
                                                $explodexx=$xpld[3];
                                                $xpldx=explode("+",$explodexx); 
                                                for($c=1; $c<count($xpldx); $c++)
                                                {
                                                    echo $xpldx[$c];
                                                    if($c!=count($xpldx)-1)
                                                    {
                                                        echo ", ";
                                                    }
                                                }
                                                
                                         } 
                                        ?>
                                    </td>

                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">   
                                         <?php 
                                            if(!empty($xpld[4])){ echo $xpld[4]; } 
                                        ?>
                                    </td>

                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                        <?php 
                                            if(!empty($xpld[5])){ echo $xpld[5]; } 
                                        ?>
                                    </td>
                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                        <?php 
                                            if(!empty($xpld[6])){ echo $xpld[6]; } 
                                        ?>
                                        
                                    </td>
                                </tr>
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
                            <tr>
                                <td colspan="8" style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">Optional Subject (GP above 2)</td>
                            </tr>
                            <tr style="border: 1px solid #D8D8D8; " >
                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                    <?php echo $serial=$serial+1; ?>
                                </td>

                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                   <?php 
                                        if(!empty($xpld[0])){ echo $xpld[0]; } 
                                    ?>                                  
                                </td>
                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                    <?php 
                                        if(!empty($xpld[1])){ echo $xpld[1]; } 
                                    ?>
                                </td>

                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                    <?php 
                                        if(!empty($xpld[2])){ echo $xpld[2]; } 
                                    ?>
                                </td>  
                                            
                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                    <?php 
                                            if(!empty($xpld[3])){ 
                                                $explodexx=$xpld[3];
                                                $xpldx=explode("+",$explodexx); 
                                                for($c=1; $c<count($xpldx); $c++)
                                                {
                                                    echo $xpldx[$c];
                                                    if($c!=count($xpldx)-1)
                                                    {
                                                        echo ", ";
                                                    }
                                                }
                                                
                                         } 
                                        ?>
                                </td>

                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">   
                                     <?php 
                                        if(!empty($xpld[4])){ echo $xpld[4]; } 
                                    ?>
                                </td>

                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                    <?php 
                                        if(!empty($xpld[5])){ echo $xpld[5]; } 
                                    ?>
                                </td>
                                <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                    <?php 
                                        if(!empty($xpld[6])){ echo $xpld[6]; } 
                                    ?>
                                    
                                </td>
                            </tr>

                         <?php
                                }
                             }

                        ?>    


                                <tr>
                                    <td colspan="2" style="padding:20px 0px;text-align: center; font-size: 16px; font-weight: bold;"> 
                                        Total Marks :  <?php
                                        if(!empty ($totalmark)){
                                            echo $totalmark;
                                        }else{                                         
                                            echo $totalmark;                              
                                        }
                                ?>
                                        
                                        


                                    </td>
                                    <td colspan="3" style="padding:20px 0px;text-align: center; font-size: 16px; font-weight: bold;"> 
                                       GPA : <?php
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
                                        ?>
                                    </td>
                                    <td colspan="2" style="padding:20px 0px;text-align: center; font-size: 16px; font-weight: bold;"> 
                                        Letter Grade : <?php
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

                                    <td colspan="7" style="padding:20px 0px;text-align: center; font-size: 20px; font-weight: bold;"> 
                                        <hr>
                                        Result Comments :  <?php echo ($grd == 'A+') ? "Excellent Result" : ""; ?>
                                        <?php echo ($grd == 'A') ? "Very Good Result" : ""; ?>
                                        <?php echo ($grd == 'A-') ? "Keep Trying Better" : ""; ?>
                                        <?php echo ($grd == 'B') ? "Try Hard Work" : ""; ?>
                                        <?php echo ($grd == 'C') ? "Result Not Good" : ""; ?>
                                        <?php echo ($grd == 'D') ? "Below Average Result" : ""; ?>
                                        <?php echo ($grd == 'F') ? "Fail" : ""; ?>


                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:30px 0px 10px 10px;text-align: left; font-size: 12px; font-weight: bold;"> .............................................<br>Class Teacher </td>
                                    <td colspan="4" style="padding:30px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;">.............................................<br> Exam Controller </td>
                                </tr>    


                            </table>




                        </div>
                    </div>
                </div>
          
           </div>
         
        </div>
    </div>
</div>
<!-- Right Side/Main Content End --> 







