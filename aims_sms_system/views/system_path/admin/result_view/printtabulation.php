<style>
  .table, .table th, .table td {
      border: 0px solid black;
      border-collapse: collapse;
  }
  .toptable{
    border: 0px solid black;
  }
  .table th, .table td {
      padding: 5px;
      text-align: left;

  }
      .table{
         width: 100%; 
            height: 400px;
      }
 
      .rotate{
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;
      }

      .color{
        color: red;
      }
  </style>   
<div class="row">
        <br><br>
        <div class="page-header">
                 <a href="<?php echo base_url('systemaccess/Result_view'); ?>" class="btn btn-grey">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Go Back
                 </a>
                <button class="btn btn-success " onclick="printDiv('printableArea')">
                    Print
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>           
        </div>
        <div class="col-xs-12 col-sm-12" id="printableArea">
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
            <div id="printDIV" >
                <div style="margin: 10px auto 0px;  width: 100%; border: 0px solid #000; " > 
                    <div style=" border: 1px solid #d9d9d9;">      
                        <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">                                
                                <tr style=" font-family: cambria;"> 
                                    <th colspan="7"  style="text-align: center;">
                                        <p style="margin-left:5px;">
                                        <?php
                                            $ins_info = getInstituteInfo();
                                        ?>                                           
                                       
                            <img style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">     
                              <br>   
                                <div style="font-size: 20px; font-size: 35px; color: royalblue;">   
                                  <?php 
                                        $ins_name=getInstituteInfo(); 
                                        echo $ins_name['instituteName'] ;
                                  ?>
                                            </div>                                           
                                <div style="line-height: 3px; font-size: 18px; color: #444;"> 
  <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?>
                                </div>
                                           
                                        </p>

                                    </th>


                                </tr>
                                <tr> 
                                    <th colspan="7" style="text-align: center; "> <u><h3 style="font-family: Algerian;">TABULATION SHEET</h3></u> </th> 
                                </tr>
                                <tr class="center">
                                    <th>
                                        Class :  <?php echo getProgramName($programId); ?> 
                                    </th> 

                                    <th>
                                        Medium :  <?php echo getmediumName($mediumId); ?>  
                                    </th>
                                    <th>
                                        Shift :  <?php echo getshiftName($shiftId); ?> 
                                    </th>
                                    <th>
                                        Group :  <?php echo getGroupName($groupId); ?> 
                                    </th>
                                    <th>
                                        Section : <?php echo getsectionName($sectionId); ?> 
                                    </th>
                                    <th>
                                        Session : <?php echo getSessionName($sessionId); ?> 
                                    </th>
                                    <th>
                                        <b>Semester : <?php echo getSemesterName($semesterId); ?></b> 
                                    </th>

                                </tr>
                            </table>                       
                    </div>
                </div>     

        
        <table border="1" padding="1" text-align="center">          
          <thead>                
            <tr>
              <th style="" rowspan="2" colspan="1" data-field="name" tabindex="0">
                <div >Serial</div>
              </th>
              <th rowspan="2" colspan="1" data-field="name" tabindex="0" width="300px">
                <div style="width: 130px;text-align: center;" >Name & ID</div>
                <div style="width: 210px;">&nbsp;</div>
              </th>
              
              <?php
                $s=0;
                
                foreach ($listdata as $vab) { // 1st Loop - with Student Info
                  # code...  
                 $CourseDevideList = getMarkCategory_ByCourse($vab['courseId'],$vab['programOfferId']);
                 $explode_words = array_filter(explode(",", $CourseDevideList['mark_cat_id']));  
                  $colspan =1;        
                  
              ?>
              <th style="width:100px" rowspan="1" colspan="<?php echo count($explode_words)+1; ?>" >
                <?php
                    if (!empty($vab['courseId'])) {
                        echo getCourseName($vab['courseId']);
                    }
                ?>                                                                   
              </th>
              <?php
                }
              ?>

             <!--  <th style="" rowspan="1" colspan="1" tabindex="0"></th> -->
              <th style="text-align: center;" rowspan="1" colspan="5" tabindex="0">RESULT</th>
            </tr>


            <tr style="border:1px solid #000;">
              <?php
              foreach ($listdata as $vab) {
                $CourseDevideList = getMarkCategory_ByCourse($vab['courseId'],$vab['programOfferId']);
                $explode_words = array_filter(explode(",", $CourseDevideList['mark_cat_id']));
               //echo "<pre>"; print_r($explode_words);

                      foreach ($explode_words as $word_val) {
                  ?>
                     
                <th style="   -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;"  rowspan="1" colspan="1" tabindex="0">
                  <?php 
                    $CatagoryTitle=getMarkTitle($word_val);
                    echo substr($CatagoryTitle,0,33);   
                  ?>                                
                </th>
              
              <?php
                  }
              ?>    
                <th style="   -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;" rowspan="1" colspan="1" tabindex="0">
                  <div >Total</div>
                </th>
              <?php
                }
              ?>

              
              <!-- <th style="   -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;" rowspan="1" colspan="1" tabindex="0"></th> -->

              <th style="   -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;" class="" rowspan="1" colspan="1" tabindex="0">
                <div >Total Mark</div>
              </th>
              <th style="    -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;" class="" rowspan="1" colspan="1" tabindex="0">
                <div>GP</div>
              </th>
              <th style="   -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;" class="" rowspan="1" colspan="1" tabindex="0">
                <div >Grade</div>
              </th>
              <th style="   -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;" class="" rowspan="1" colspan="1" tabindex="0">
                <div >Fail Subject</div>
              </th>
              <th style="   -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        writing-mode: lr-tb;
        padding: 0px;     
        width: 50px;
        height: 91px; 
        text-align: left;" class="" rowspan="1" colspan="1" tabindex="0">
                <div >Position</div>
              </th>
            </tr>

          </thead>
          <tbody>
                      
                                               
                            <?php
                            $s = 1;
                            $chkID = 0;
                            foreach ($studentlistdata as $vabs) {
                                if ($chkID != $vabs['studentId']) {
                                    ?>
                                    <tr>
                                        <td>
                                        <?php echo $s++; ?>
                                        </td>
                                    
                                
                                               <td width="100px" style="text-align: left; font-size: 15px; padding-left: 1px;">
                                          
                                             <?php
                                            if (!empty($vabs['studentId'])) {
                                                echo $vabs['firstName'] . " " . $vabs['lastName']."<br>". "(". $vabs['studentId'].")";
                                            }
                                            ?>
                                            
                                        </td>
                                  

                                        
                                        <!--//////////////// STUDENT ASSIGN LIST /////////////////////-->                      


                                                    <?php
                                                    $assigncourselist = GetStudentAssignCourse($vabs['programOfferId'], $vabs['studentId']);
                                                    $AssignedSubject = explode(",", trim($assigncourselist['courseId'], ","));

                                                    //echo "<pre>"."LISt ";  print_r($listdata);

                                                    $AssignSubjectStatus = explode(",", trim($assigncourselist['courseStatus'], ","));
                                                    // echo "<pre>"."Optional Status 1=Common,2=Optional"; 
                                                    // print_r($AssignSubjectStatus);

                                                    $optional_key = array_search('2', $AssignSubjectStatus);
                                                    ?>
                                                    <!--//////////////// End STUDENT ASSIGN LIST /////////////////////- -->  
                                                    
                                        <?php
                                        $CountSubject = 1;
                                        
                                        foreach ($listdata as $vab) {
                $CourseDevideList = getMarkCategory_ByCourse($vab['courseId'],$vab['programOfferId']);
                $explode_words = array_filter(explode(",", $CourseDevideList['mark_cat_id']));
                                                 // $Total_SubjectMarks = 0;
                                            $SubjectResult = 0;
                                            $SubjectResult = GetMarkBy_StuId_CouId_PrgId($vabs['studentId'],$vab['programOfferId'], $semesterId, $vab['courseId']);
                                        //  echo "<pre>"; print_r($SubjectResult);
                                            
                                                 //############################## Percentage marks ####################################                              
                                            
                                      $data['programOfferId']=$vab['programOfferId'];
                                      $data['courseId']=$vab['courseId'];
                                      $marks_devide = getMarkDevidevalue($data);
                                      
                                         $marks = 0;
                                         $print_category_mark="";
                                         $print_optional_category_mark="";
                                         $ex_pld = explode(",", trim($marks_devide['mark_cat_id']));
                                         $ex_pld_assng_dvd = explode(",", trim($marks_devide['dis_divide_mark']));
                                         $ex_pld_dvd = explode(",", trim($vabs['divide_mark'])); // this mark is from student marks table
                                         $ex_pld_percnt = explode(",", trim($marks_devide['mark_percent']));
                                      //  echo "<pre>"; print_r($ex_pld_percnt); 
                                     
                                         
      //############################## Percentage marks ####################################   
                                        
                                             
                                            $ArrayResultMark = explode(',', $SubjectResult);
                                           // echo "<pre>"; print_r($ArrayResultMark);
                                            $filter_data[$vab['courseId']] = array_filter($ArrayResultMark);
                                            $filter_Result_Percent[$vab['courseId']] = array_filter($ex_pld_percnt);

                                            if(!empty($SubjectResult))
                                            {
                                                $MarkedSubject = $vab['courseId'];
                                                $CountSubject += count($SubjectResult);
                                            }
                                           
                                            
                                            //OPTIONAL SUBJECT

                                            if(!empty($optional_key))
                                            {
                                                $optional_SubjectId = $AssignedSubject[$optional_key];

                                                if($vab['courseId'] == $optional_SubjectId)
                                                {
                                                   $optionalCode = 3; // Match/CHeck optional subject
                                                   
                                                }
                                            }
                                            
                                            $arry = array(
                                                'programOfferId' => $vab['programOfferId'],
                                                'courseId' => $vab['courseId']
                                            );
                                            
                                     
                                         $SubMarks = getCourseMarks($arry);
                                            $calculate = ($SubMarks * 33) / 100;
                                    ?>

                                            <?php
                                            foreach ($filter_data[$vab['courseId']] as $keyReslt=>$value){

                                                    foreach ($filter_Result_Percent[$vab['courseId']] as $keyPercnt=>$valuePercent) {
                                                            # code...
                                                       if($keyReslt == $keyPercnt){
                                                   ?>
                                                   <td style=" text-align: center; font-size: 16px;">
                                                       
                                                       
                                                            <?php
                                                               $S_SubMark = $value * ($valuePercent/100);
                                                               echo floor($S_SubMark);
                                                            ?>
                                                    </td> 
                                                        <?php   
                                                                   $S_SubMarkArray[] = $S_SubMark; 
                                                                }

                                                //End 2nd Filter Loop    
                                                    }
                                         //End 1st Filter Loop                       
                                                }  
                                                   if(!empty($S_SubMarkArray))
                                                   {
                                                        $Total_SubjectMarks= array_sum($S_SubMarkArray);
                                                        unset($S_SubMarkArray);
                                                   }   
                                                   else{
                                                        $Total_SubjectMarks= array_sum($filter_data[$vab['courseId']]);
                                                   }      
                                                    
                                                  // echo "<pre>"; print_r($SubjectResult);
                                                ?>          
                                                 

                                                <?php
                                                if(empty($SubjectResult))
                                                {
                                                 
                                                    for ($i=0; $i < (count($explode_words)+1) ; $i++) {
                                                ?>
                                                    <td style=" text-align: center; font-size: 16px;">-</td>
                                                <?php        
                                                    }
                                                 }    
                                                 else
                                                 {
                                               ?>

                                                 <td style=" text-align: center; font-size: 16px;">
                                               <?php     
                                                    if (!empty($filter_data)) {
                                                        echo "<span style=\"color:red; weight:bold;\">" .
                                                        floor($Total_SubjectMarks) . "</span>";
                                                    } else {
                                                        echo "<span style=\"color:red;\">" . 0 . "</span>";
                                                    }                
                                                                    
                                                ?> 
                                                </td> 
                                                <?php  } ?>
                                        <?php
                                                            $Array_TotalMarks[$vab['courseId']] = $Total_SubjectMarks;
//echo "<pre>"; print_r($Array_TotalMarks);
                                                            if (!empty($MarkedSubject)) {
                                                                $PercentMarks = (100 / $vab['marks']) * $Total_SubjectMarks;
                                                                $convertmarks = doubleval(intval($PercentMarks));

                                                                if (in_array($convertmarks, range(80.00, 100.00))) {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 3;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 5;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 5; // Grade POint
                                                                    }
                                                                } elseif (in_array($convertmarks, range(70.00, 79.00))) {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 2;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 4;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 4;
                                                                    }
                                                                } elseif (in_array($convertmarks, range(60.00, 69.00))) {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 1.5;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 3.5;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 3.5;
                                                                    }
                                                                } elseif (in_array($convertmarks, range(50.00, 59.00))) {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 1;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 3;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 3;
                                                                    }
                                                                } elseif (in_array($convertmarks, range(40.00, 49.00))) {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 0;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 2;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 2;
                                                                    }
                                                                } elseif (in_array($convertmarks, range(33.00, 39.00))) {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 0;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 1;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 1;
                                                                    }
                                                                } elseif (in_array($convertmarks, range(0, 32.00))) {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 0;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 0;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 0;
                                                                    }
                                                                } else {
                                                                    if (!empty($optional_SubjectId)) {
                                                                        if ($MarkedSubject == $optional_SubjectId) {
                                                                            $optionalMinus = 0;
                                                                            $gradepoint = 0; // Grade POint                           
                                                                        } else {
                                                                            $gradepoint = 0;
                                                                        }
                                                                    } else {
                                                                        $gradepoint = 0;
                                                                    }
                                                                }
                                                                $TotalGradePoint_arraysum[$vab['courseCode']] = $gradepoint;

                                                                if (!empty($optional_SubjectId)) {
                                                                    if ($vab['courseId'] == $optional_SubjectId) {
                                                                        unset($TotalGradePoint_arraysum[$vab['courseCode']]);
                                                                    }
                                                                }
                                                            }


                                                            $MarkedSubject = 0;
                                                        }
                                                        //echo "<pre>"; print_r($TotalGradePoint_arraysum);
                                                        $FinalGradePoint = array_sum($TotalGradePoint_arraysum);

                                                        if (!empty($optionalMinus) && $optionalMinus > 0) {
                                                            $FinalGradePoint = $FinalGradePoint + $optionalMinus;
                                                        }
                                                        if (!empty($optionalCode)) {
                                                            $CountSubject = $CountSubject - 1;
                                                        }
                                                       
                                                        $FinalGradePoint = $FinalGradePoint / $CountSubject;
                                                        $PublishGradePoint = substr($FinalGradePoint, 0, 4);

                                                        // echo "<pre>";
                                                        // print_r($TotalGradePoint_arraysum);  
                                                        ?>
                                                        <?php
                      $total_marks = isset($result_info[$vabs['studentId']]['total_obtain_marks']) ? $result_info[$vabs['studentId']]['total_obtain_marks'] : 0;
                      if ($total_marks == 0): ?>
                      <td>0</td>
                    <?php endif; ?>
                                                         <td style=" text-align: center; font-size: 16px;">
                                                        <?php echo $total_marks;?>
                                                        </td>
                                       <td style=" text-align: center; font-size: 16px;"> 
                                       <?php echo isset($result_info[$vabs['studentId']]['gpa_point']) ? $result_info[$vabs['studentId']]['gpa_point'] : 0;?>
                                      </td>
                                    <td style=" text-align: center; font-size: 16px;">
                                      <?php echo isset($result_info[$vabs['studentId']]['gpa_letter']) ? $result_info[$vabs['studentId']]['gpa_letter'] : 0;?>
                                    </td>
                                    <td style=" text-align: center; font-size: 16px;">
                                    <?php echo isset($result_info[$vabs['studentId']]['tot_fail_subj']) ? $result_info[$vabs['studentId']]['tot_fail_subj'] : 0;?>
                                    </td>
                                    <td style=" text-align: center; font-size: 16px;">
                                    <?php echo isset($result_info[$vabs['studentId']]['position']) ? $result_info[$vabs['studentId']]['position'] : 0;?>
                                    </td>
                                                </tr>

                                    <?php
                                    $chkID = $vabs['studentId'];
                                     unset($Array_TotalSum);
                                     
                                        
                                         
                                         
                                }
                            }
                            ?>

                        </tbody>
                </table>  
                     
             </div>  

                
            </div>   
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    </div>
        </div>

    
            
