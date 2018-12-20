<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Result Tabulation Sheet
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Generate Tabulation Sheet
        </small>
    </h1>
</div><!-- /.page-header -->   
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

    <?php
    if (!empty($studentlistdata)) {
        $ins_logo = getInstituteLogo();
        ?>
        <div class="col-xs-12 col-sm-12">

            <!-- div.dataTables_borderWrap -->
            <div id="printDIV" >

                <div class="viewBox text-center fix" >
                    <div class="page-header">

                        <h1>
                            <img src="<?php
                            if (file_exists($ins_logo)) {
                                echo base_url() . $ins_logo;
                            } else {
                                echo base_url() . "uploads/default/aims.png";
                            }
                            ?>" width="60">
                            <strong> <?php echo getInstituteName(); ?></strong>
                         
                        </h1>
                    </div><!-- /.page-header -->   
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">
                                    Class :  <?php echo getProgramName($programId); ?> 
                                </th>

                                <th class="hidden-680">
                                    Medium :  <?php echo getmediumName($mediumId); ?>  
                                </th>
                                <th class="hidden-680">
                                    Shift :  <?php echo getshiftName($shiftId); ?> 
                                </th>
                                <th class="hidden-680">
                                    Group :  <?php echo getGroupName($groupId); ?> 
                                </th>
                                <th class="hidden-480">
                                    Section : <?php echo getsectionName($sectionId); ?> 
                                </th>
                                <th class="hidden-480">
                                    Session : <?php echo getSessionName($sessionId); ?> 
                                </th>
                                <th class="hidden-480">
                                    <b>Semester : <?php echo getSemesterName($semesterId); ?></b> 
                                </th>

                            </tr>
                        </thead>
                    </table>          

                </div>
                
                <div style="background: #eee none repeat scroll 0 0; font-size: 19px;margin-top: -40px;padding: 16px;text-align: center;">Tabulation Sheet</div>
                
                <div style="overflow-x: scroll">
                    
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="15px">
                                    Sl No.
                                </th>

                                <th width="100px">Student</th>


                                <?php


                                foreach ($listdata as $vab) {
                                    ?>
                                    <th>
                                        <table>
                                            <tr style=" border: 1px solid #cccccc;"> <td colspan="4"><?php
                                                    if (!empty($vab['courseId'])) {
                                                        echo getCourseName($vab['courseId']);
                                                    }
                                                    ?></td></tr>
                                            <tr style=" border: 1px solid #cccccc;"> <td colspan="4" class="text-danger"><?php
                                                    if (!empty($vab['marks'])) {
                                                        echo $vab['marks'];
                                                    }
                                                    ?>


                                                </td></tr>
                                            <tr style=" border: 1px solid #cccccc;"> 
                                                <?php
                                             
                                                $CourseDevideList = getMarkCategory_ByCourse($vab['courseId'],$vab['programOfferId']);
                                                $explode_words = array_filter(explode(",", $CourseDevideList['mark_cat_id']));
                                                        foreach ($explode_words as $word_val) {
                                                    ?>                                            
                                                    <td style="border-right: 1px solid #cccccc;padding:4px">
                                                <?php          
                                                    $CatagoryTitle=getMarkTitle($word_val);
                                                    echo substr($CatagoryTitle,0,2);        
                                                        ?>
                                                    </td>
                                                <?php  }  ?>    
                                                <td class="text-success" style="border-right: 1px solid #cccccc; padding:3px; color: red; ">Tot.</td>

                                            </tr>
                                              
                                        </table>
                                    </th>
    <?php } ?>
                                     <th>TOTAL</th>
                                     <th>GRADE POINT</th>
                                     <th>GRADE</th>

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
                                        <td class="center">
                                        <?php echo $s++; ?>
                                        </td>
                                        <?php
                                        if (!empty($vabs['divide_mark'])) {
                                            // echo $vabs['divide_mark'];
                                        }
                                        ?>
                                        <td>

                                            <?php
                                            if (!empty($vabs['studentId'])) {
                                                echo "<b>" . $vabs['studentId'] . "</b><br>";
                                            }
                                            ?>
                                            <?php
                                            if (!empty($vabs['studentId'])) {
                                                echo $vabs['firstName'] . " " . $vabs['lastName'];
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

                                        $CountSubject = 0;
                                        
                                        foreach ($listdata as $vab) {
                                           // $Total_SubjectMarks = 0;
                                            $SubjectResult = 0;
                                            $SubjectResult = GetMarkBy_StuId_CouId_PrgId($vabs['studentId'],$vab['programOfferId'], $semesterId, $vab['courseId']);
                                        //   print_r($SubjectResult);
                                            $ArrayResultMark = explode(',', $SubjectResult);
                                            $filter_data[$vab['courseId']] = array_filter($ArrayResultMark);

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
                                            //$SubMarks = getCourseMarks($arry);
                                            $calculate = ($vab['marks'] * 33) / 100;
                                            
                                       
                                            ?>

                                            <td width="100px" style=" border: 1px solid #cccccc; text-align: left">
                                                <table>

                                                    <tr style=" border: 1px solid #cccccc;"> 
                                                       
                                                       <?php
                                          
                                                         foreach ($filter_data[$vab['courseId']] as $key=>$value){
                                                       ?>
                                                           <td style="border-right: 1px solid #cccccc; padding:5px">                                                              
                                                                    <?php 

                                                                      echo $value;
                                                                    //  $TotalSum_FilterData += $value;
                                                                    ?>
                                                            </td> 
                                                        <?php        
                                                            }  
                                                            $Total_SubjectMarks= array_sum($filter_data[$vab['courseId']]);
                                                        ?>
                                                             
                                                        <td style="padding:8px; "> 

                                                            <?php
                                                            if (!empty($filter_data)) {
                                                echo "<span style=\"color:red; weight:bold;\">" .
                                                                $Total_SubjectMarks . "</span>";
                                                            } else {
                                                                echo "<span style=\"color:red;\">" . 0 . "</span>";
                                                            }
                                                            ?> </td>



                                                    </tr>
                                                </table>
                                            </td>

                                        <?php

                                            
                                            $Array_TotalMarks[$vab['courseId']] = $Total_SubjectMarks;
//echo "<pre>"; print_r($Array_TotalMarks);
                                            if($MarkedSubject)
                                            {
                                                $PercentMarks = (100 / $vab['marks']) * $Total_SubjectMarks;
                                                $convertmarks = doubleval(intval($PercentMarks));
                                                
                                                if(in_array($convertmarks, range(80.00, 100.00))){
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 3;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 5;                          
                                                    }
                                                  }                        
                                                  else
                                                  {
                                                    $gradepoint = 5; // Grade POint
                                                  }
                                                    
                                                }
                                                elseif(in_array($convertmarks, range(70.00, 79.00))){ 
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 2;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 4;                          
                                                    }
                                                  } 
                                                  else
                                                  {  
                                                    $gradepoint = 4;                          
                                                   }
                                                }
                                                elseif(in_array($convertmarks, range(60.00, 69.00))){ 
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 1.5;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 3.5;                          
                                                    }
                                                  } 
                                                  else
                                                  { 
                                                    $gradepoint = 3.5;
                                                  }
                                                }
                                                elseif(in_array($convertmarks, range(50.00, 59.00))){ 
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 1;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 3;                          
                                                    }
                                                  } 
                                                  else
                                                  { 
                                                    $gradepoint = 3;
                                                  }
                                                }
                                                elseif(in_array($convertmarks, range(40.00, 49.00))){ 
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 0;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 2;                          
                                                    }
                                                  } 
                                                  else
                                                  { 
                                                    $gradepoint = 2;
                                                   }
                                                }
                                                elseif(in_array($convertmarks, range(33.00, 39.00))){ 
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 0;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 1;                          
                                                    }
                                                  } 
                                                  else
                                                  {
                                                    $gradepoint = 1;
                                                  }
                                                }
                                                elseif(in_array($convertmarks, range(0, 32.00))){ 
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 0;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 0;                          
                                                    }
                                                  } 
                                                  else
                                                  {
                                                    $gradepoint = 0;
                                                  }
                                                }
                                                else
                                                {
                                                  if(!empty($optional_SubjectId))
                                                  {
                                                    if($MarkedSubject == $optional_SubjectId)
                                                    {
                                                       $optionalMinus = 0;
                                                       $gradepoint = 0; // Grade POint                           
                                                    }
                                                    else
                                                    {                          
                                                      $gradepoint = 0;                          
                                                    }
                                                  } 
                                                  else
                                                  {                          
                                                    $gradepoint = 0;                          
                                                  }
                                                }
                                                $TotalGradePoint_arraysum[$vab['courseCode']]=$gradepoint;

                                                if(!empty($optional_SubjectId))
                                                {
                                                   if($vab['courseId'] == $optional_SubjectId)
                                                   {
                                                     unset($TotalGradePoint_arraysum[$vab['courseCode']]);    
                                                   }  
                                                }
                                            }

                         
                                            $MarkedSubject=0;
                                          } 
                            //echo "<pre>"; print_r($TotalGradePoint_arraysum);
                            $FinalGradePoint = array_sum($TotalGradePoint_arraysum);

                                if(!empty($optionalMinus) && $optionalMinus > 0)
                                {
                                   $FinalGradePoint = $FinalGradePoint + $optionalMinus;
                                }                       
                                if(!empty($optionalCode)){ $CountSubject = $CountSubject - 1; }

                                         $FinalGradePoint = $FinalGradePoint / $CountSubject;
                                         $PublishGradePoint=substr($FinalGradePoint, 0, 4);
                                       
                                            // echo "<pre>";
                                            // print_r($TotalGradePoint_arraysum);  
                                        ?>
                                            <td> 
                                                <?php
                                                    if(!empty($Array_TotalMarks))
                                                    {
                                                       echo  $TotalMarks= array_sum($Array_TotalMarks);
                                                    }
                                                ?>
                                            </td>
                                            <td> 
                                                <?php 
                                                    if (in_array(0, $TotalGradePoint_arraysum)) {
                                                          echo 0;                           
                                                    }
                                                    else{
                                                      echo $PublishGradePoint;  
                                                    }
                                                      
                                                  ?>
                                            </td>
                                            <td> 
                                            <?php 
                                                  if (in_array(0, $TotalGradePoint_arraysum)) {
                                                      echo "F";                           
                                                  }
                                                  else{
                                                      if (in_array($PublishGradePoint, range(0, 1))) {
                                                           //if ($convertmark <0) {
                                                          echo "F";

                                                       } elseif ($PublishGradePoint>=5) {
                                                          echo "A+";
                                                           //    echo $a;
                                                       } 
                                                       elseif(4<= $PublishGradePoint &&  $PublishGradePoint<= 5) {    
                                                          echo "A";
                                                           //    echo $a;
                                                       } elseif(3.5<= $PublishGradePoint &&  $PublishGradePoint<= 3.99) {  
                                                          echo "A-";
                                                           //    echo $a;
                                                       } elseif(3<= $PublishGradePoint &&  $PublishGradePoint<= 3.49) {  
                                                          echo "B";
                                                           //    echo $a;
                                                       } elseif(2<= $PublishGradePoint &&  $PublishGradePoint<= 2.99) {  
                                                          echo "C";
                                                           //    echo $a;
                                                       } elseif(1<= $PublishGradePoint &&  $PublishGradePoint<= 1.99) { 
                                                          echo "D";
                                                           //    echo $a;
                                                       }
                                                      elseif (5< $PublishGradePoint) {
                                                          echo "F";
                                                          //    echo $a;
                                                      }
                                                       else {
                                                         echo "F";
                                                       }  
                                                  }
                                                  unset($TotalGradePoint_arraysum); // Unset Grade Point

                                                  
                                              ?> 
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
        <?php
    }
    ?>
    <button style='margin: 10px 45%;' onclick="javascript:printDiv('printDIV')" type="button" class="btn btn-danger"> 
        <i class="ace-icon fa fa-print"></i>
        PRINT </button>
</div> <!-- /.row --> 











