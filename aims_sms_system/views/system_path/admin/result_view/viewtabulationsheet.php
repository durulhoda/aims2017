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
   height: 50px; 
   text-align: left;
   }
   .color{
   color: red;
   }
</style>
<!-- /Content Section  -->                    
<div class="page-header">
   <h1>
      Result Tabulation Sheet
      <small class="red">
      <i class="ace-icon fa fa-angle-double-right"></i>
      Generate Tabulation Sheet
      </small>
   </h1>
</div>
<!-- /.page-header -->
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
         <div style="margin: 10px auto 0px;  width: 100%; border: 0px solid #cccccc; " >
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
                     <th colspan="7" style="text-align: center; ">
                        <u>
                           <h3 style="font-family: Algerian;">TABULATION SHEET</h3>
                        </u>
                     </th>
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
         <div style="border: 0px solid red; width:100%; height: 500px; overflow-x: scroll;">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th style="" rowspan="2" colspan="1" data-field="name" tabindex="0">
                        <div >Serial</div>
                     </th>
                     <th rowspan="2" colspan="1" data-field="name" tabindex="0">
                        <div style="width: 130px;text-align: center;" >Name & ID</div>
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
                     <!-- <th style="" rowspan="1" colspan="1" tabindex="0"></th> -->
                     <th style="text-align: center;" rowspan="1" colspan="5" tabindex="0">RESULT</th>
                  </tr>
                  <tr style="border:1px solid #ccc;">
                     <?php
                        foreach ($listdata as $vab) {
                          $CourseDevideList = getMarkCategory_ByCourse($vab['courseId'],$vab['programOfferId']);
                          $explode_words = array_filter(explode(",", $CourseDevideList['mark_cat_id']));
                         //echo "<pre>"; print_r($explode_words);
                        
                                foreach ($explode_words as $word_val) {
                            ?>
                     <th style="" class="rotate" rowspan="1" colspan="1" tabindex="0">
                        <?php 
                           $CatagoryTitle=getMarkTitle($word_val);
                           echo substr($CatagoryTitle,0,33);   
                           ?>                                
                     </th>
                     <?php
                        }
                        ?>    
                     <th style="" class="rotate color" rowspan="1" colspan="1" tabindex="0">
                        <div >Total</div>
                     </th>
                     <?php
                        }
                        ?>
                     <!-- <th style="background-color: #F1F1F1;" rowspan="1" colspan="1" tabindex="0"></th> -->
                     <th style="background-color: #90BD59;text-align: center;" class="" rowspan="1" colspan="1" tabindex="0">
                        <div class="th-inner rotate">Total Mark</div>
                     </th>
                     <th style="background-color: #D9D9D9;text-align: center;" class="" rowspan="1" colspan="1" tabindex="0">
                        <div class="th-inner rotate">GP</div>
                     </th>
                     <th style="background-color: #FF8200;text-align: center;" class="" rowspan="1" colspan="1" tabindex="0">
                        <div class="th-inner rotate">Grade</div>
                     </th>
                     <th style="background-color: #EDE400;text-align: center;" class="" rowspan="1" colspan="1" tabindex="0">
                        <div class="th-inner rotate">Fail Subject</div>
                     </th>
                     <th style="background-color: #EDEEDE;text-align: center;" class="" rowspan="1" colspan="1" tabindex="0">
                        <div class="th-inner rotate">Position</div>
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
                     <td>
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
                      $optional_SubjectId = isset($AssignedSubject[$optional_key]);
              
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
                        if($keyReslt == $keyPercnt){
                ?>
                 <td>
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
                          <td>0</td>
                     <?php        
                          }
                        } else {
                        ?>
                     <td>
                        <?php     
                           if (!empty($filter_data)) {
                               echo "<span style=\"color:red; weight:bold;\">" .
                               floor($Total_SubjectMarks) . "</span>";
                           } else {
                               echo "<span style=\"color:red;\">" . 0 . "</span>";
                           }                
                                           
                           ?> 
                     </td>
                     <?php  } 
                     } ?>
                     <?php
                      $total_marks = isset($result_info[$vabs['studentId']]['total_obtain_marks']) ? $result_info[$vabs['studentId']]['total_obtain_marks'] : 0;
                      if ($total_marks == 0): ?>
                      <td>0</td>
                    <?php endif; ?>
                     <!-- <td style=""></td> -->
                     <td><?php echo $total_marks;?></td>

                    <td>
                    <?php
                         if($result_info[$vabs['studentId']]['gpa_point']){
                            if($result_info[$vabs['studentId']]['gpa_point'] >= 5){
                               echo 5;
                             }else{
                                echo $result_info[$vabs['studentId']]['gpa_point'];
                             }
                         }else{
                              echo 0;
                         }
                    ?>
                    </td>

                      <!--<td> Original One
                     <?php
                          //echo isset($result_info[$vabs['studentId']]['gpa_point']) ? $result_info[$vabs['studentId']]['gpa_point'] : 0;
                      ?>
                     </td>-->

                     <td><?php echo isset($result_info[$vabs['studentId']]['gpa_letter']) ? $result_info[$vabs['studentId']]['gpa_letter'] : 0;?></td>
                     <td><?php echo isset($result_info[$vabs['studentId']]['tot_fail_subj']) ? $result_info[$vabs['studentId']]['tot_fail_subj'] : 0;?></td>
                     <td><?php echo isset($result_info[$vabs['studentId']]['position']) ? $result_info[$vabs['studentId']]['position'] : 0;?></td>
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
         <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/result_view/printtabulationsheetformet" enctype="multipart/form-data" method="post">
            <input type="hidden" value="<?php if(!empty($sessionId)){echo $sessionId;} ?>" name="data[sessionId]">
            <input type="hidden" value="<?php if(!empty($programId)){echo $programId;} ?>" name="data[programId]">
            <input type="hidden" value="<?php if(!empty($mediumId)){echo $mediumId;} ?>" name="data[mediumId]">
            <input type="hidden" value="<?php if(!empty($groupId)){echo $groupId;} ?>" name="data[groupId]">
            <input type="hidden" value="<?php if(!empty($sectionId)){echo $sectionId;} ?>" name="data[sectionId]">
            <input type="hidden" value="<?php if(!empty($shiftId)){echo $shiftId;} ?>" name="data[shiftId]">
            <input type="hidden" value="<?php if(!empty($semesterId)){echo $semesterId;} ?>" name="data[semesterId]">
            <div class="widget-toolbar hidden-480">
               <button style='margin: 10px 45%;' class="btn btn-white btn-primary" name="search" type="submit">Print Tabulation Sheet</button> 
            </div>
         </form>
      </div>
   </div>
   <!-- /.col-x12 -->
</div>
<!-- /.row -->