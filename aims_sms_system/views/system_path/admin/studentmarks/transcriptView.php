
<?php 
function get_divided_mark($mark){
  $sub_mark='';
  $dived_marks=explode(',', $mark);
  if(isset($dived_marks[0])){
    $sub_mark .=''.$dived_marks[0];
  }
  if(isset($dived_marks[1])){
    $sub_mark .=' S: '.$dived_marks[1];                    
  }
  if(isset($dived_marks[2])){
    $sub_mark .=' O: '.$dived_marks[2];                    
  }
  if(isset($dived_marks[3])){
    $sub_mark .=' P: '.$dived_marks[3];                    
  }
  return $sub_mark;
} 

function get_lg($marks){ 
 if($marks >= 80 && $marks <= 100){
  return 'A+';
}
elseif($marks >= 70 && $marks <=79.99){
  return 'A';
} 

elseif($marks >= 60 && $marks <=69.99){
  return 'A-';
}
elseif($marks >= 50 && $marks <=59.99){
  return 'B';
} 
elseif($marks >= 40 && $marks <=49.99){
  return 'C';
}
elseif($marks >= 33 && $marks <=39.99){
  return 'D';
}
else 
  return 'F';
} 

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
function get_grade($gpa){
  if($gpa == 5 ){
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

function indivul_pass($mark1,$mark2){
  $dived_marks1=explode(',', $mark1);
  $dived_marks2=explode(',', $mark2);
  $markRetun=array();
  if(isset($dived_marks1[1]) && isset($dived_marks2[1])){
    $subjective=$dived_marks1[1]+$dived_marks2[1];    
    $markRetun['S']=0;
    $markRetun['status']=0;
    if($subjective >= 23 ){
    $markRetun['status']=1;
    $markRetun['S']=1;
    }
  }

  if(isset($dived_marks1[2]) && isset($dived_marks2[2])){
    $objctive=($dived_marks1[2]+$dived_marks2[2])/2;
      $markRetun['0']=0;
       $markRetun['status']=0;
    if($objctive >= 10 ){
      $markRetun['0']=1;
       $markRetun['status']=1;
    }
  }
  return $markRetun;
}
?>
<style>
.center_border{
  border: 1px solid #D8D8D8; 
  padding: 4px; 
  text-align: center;
}
.gradeView tr td{
  padding: 0px; border: 1px solid #cccccc; text-align: center
}
.detailsTable tr th{
  border: 1px solid #cccccc; padding: 4px; text-align: center
}
</style>
<div class="page-header">

  

  <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
    <span class="btn btn-purple no-border">
      <i class="ace-icon fa fa-print bigger-130"></i>
      <span class="bigger-110">Prints Transcript</span>
    </span>
  </button>



</div><!-- /.page-header -->
<div id="printableArea" > 
  <div style="margin: 10px auto;  width: 850px; border: 0px solid #cccccc; " > 
    <div style=" border: 1px solid #d9d9d9;">      
      <div >   
        <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
          <tr style=" font-family: cambria;"> 
            <td style="text-align: center;">
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
            </td>
          </tr>
          <tr> <td style="text-align: center; "> <h3 style="font-family: Algerian;">ACADEMIC TRANSCRIPT</h3> </td> </tr>
        </table>         
        <div style='margin-top: 10px;float:left; border:0px solid red; width:160px; margin-left: 9px;'>
         <?php
         if ($studentlist['photo']) {
          ?>
          <img  src="<?php if (file_exists($studentlist['photo'])) { echo base_url() . $studentlist['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="152" height="auto" align="middle">
          <?php 
        } 
        ?> 
      </div>
      <div style='margin: 10px 10px 20px; font-family: cambria; height: 170px; width:98%; border:0px solid red;'>
        <table style="width:50%; float: left;border:0px solid red; line-height: 13px;">
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
              <span style="font-size: 14px;"><strong> Name </strong> </span>
            </td>
            <td>   
              <span style="font-size: 14px;  margin-top: 2px;">
                <strong>  : </strong> <strong><?php if(!empty($studentlist['firstName'])){ echo $studentlist['firstName'];} ?> </strong>
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
          <td style="text-align: left; "><span style="font-size: 14px;"> Group </span></td>
          <td> 
            <?php if (!empty($programinfo['groupId'])) { ?>
            <p>
              <strong>  : </strong>  <?php echo getGroupName($programinfo['groupId']); ?>
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
    <table style="width:28%; float: right; border: 2px solid #cccccc; margin-right: 8px; border-collapse: collapse; " class="gradeView">
      <tr >
        <td style=" border: 1px solid #cccccc; text-align: center">Grade Letter</td>
        <td style=" border: 1px solid #cccccc; text-align: center">Exam Marks</td>
        <td style=" border: 1px solid #cccccc; text-align: center">Grade Point</td>
      </tr>
      <tr><td>A+</td><td>80-100</td><td>5</td></tr>
      <tr><td>A</td><td>70-79</td><td>4</td></tr>
      <tr><td>A-</td><td>60-69</td><td>3.50</td></tr>
      <tr><td>B</td><td>50-59</td><td>3</td></tr> 
      <tr><td>C</td><td>40-49</td><td>2</td></tr>
      <tr><td>D</td><td>33-39 </td><td >1</td></tr>
      <tr><td>F</td><td>0-32</td><td>0</td></tr>
    </table>
  </div>
  <hr>
  <table class="detailsTable" style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;">
    <tr>
      <th>Sl No.</th>
      <th>Subject</th>
      <th>Code</th>
      <th>Full Mark</th>
      <th>Ob Marks</th>
      <th>Total Mark</th>
      <th>GP</th>
      <th>L.G.</th>
    </tr>
    <?php
    $i = 1;
    $gp=0;
    $tmark=0;
    $subject=0;
    $margeID='';
    $value=$markslist;
    $courseID=0;
    $ObtainMark=0;
    $count=count($markslist);
    $result_int=array();
    $margeCourse = array();
    for($i=0;$i<$count;$i++) { 
      if($markslist[$i]['status']==1){  
      unset($result_int['status']); 
        $tmark +=$value[$i]['totalMark'];
        $rowSpan=1;
        if($value[$i]['marge']!=0){
          $rowSpan=2;
          $courseID=$value[$i]['marge'];
          $marge_status=1;
        }
        ?>  
        <tr style="border: 1px solid #D8D8D8; " >
          <td style="text-align: left" class="center_border"><?php echo $i+1; ?></td>
           <?php 
           
           if($courseID!=$value[$i]['courseId']){
             if($value[$i]['marge']!=0){ 
           //   echo $value[$i]['marge']." --> Course: ".$courseID." != ".$value[$i]['courseId']. "<br>";
              $arr = explode(' ',trim($value[$i]['courseName']));
              //echo "<pre>"; print_r($arr); echo "<pre>"; print_r($value[$i]['courseName']);
              ?>
            <td style="text-align: left" rowspan="2" class="center_border"><?php echo $arr[0]; ?></td>
          <?php } else { ?>
            <td style="text-align: left" class="center_border"><?php echo $value[$i]['courseName'] ?></td>
          <?php } 
           }
        ?>
          <td style="text-align: left" class="center_border"><?php echo $value[$i]['courseCode'];?></td>
          <td style="text-align: left"  class="center_border"><?php echo $value[$i]['totalMark'];?></td>  
          <td style="text-align: left" class="center_border"><?php echo get_divided_mark($value[$i]['divide_mark']);
          if($value[$i]['marge']!=0){
             $subjectMark1=array_filter(explode(',', trim($value[$i]['divide_mark'])));
            $subjectMark2=array_filter(explode(',', trim($value[$i+1]['divide_mark'])));
           
              $fields=array(
              //---Previous Code---> 'course_offerId'=>$value[$i]['courseId']
                'divide_mark'=>'mark_divide.divide_mark, mark_divide.mark_percent' 
            );
              $where1=array(
              //---Previous Code---> 'course_offerId'=>$value[$i]['courseId']
                'courseId'=>$value[$i]['courseId'],
                'programOfferId'=>$value[$i]['programOfferId']
              );
              $where2=array(
              //---Previous Code---> 'course_offerId'=>$value[$i]['courseId']
                'courseId'=>$value[$i+1]['courseId'],
                'programOfferId'=>$value[$i+1]['programOfferId']
              );
              $join=array(
              'mark_divide'=>'mark_divide.course_offerId=courseoffer.offerId'
              );
          //---Previous Code---
            //  $data1=$this->StudentmarksModleAdmin->get_data('mark_divide',$where1);
          //---New Code---
            $data1=$this->StudentmarksModleAdmin->get_data('courseoffer',$where1,$fields,$join);
            $data2=$this->StudentmarksModleAdmin->get_data('courseoffer',$where2,$fields,$join);
           
        //---Previous Code---
        //  $individulMark=array_filter(explode(',', trim(isset($data1[0]['divide_mark']))));
            $individulMark1=array_filter(explode(',', trim(($data1[0]['divide_mark']))));
            $individulMark2=array_filter(explode(',', trim(($data2[0]['divide_mark']))));
    
               $pass_mark1=array();
               $pass_mark2=array();
               //-----For First Subject
               for($k=1;$k<=count($individulMark1);$k++){ 
                 $pass_mark1[$k]= round(($individulMark1[$k])*33/100);
               }
               //-----For Second Subject
               for($k=1;$k<=count($individulMark2);$k++){ 
                 $pass_mark2[$k]= round(($individulMark2[$k])*33/100);
               }
            //echo "<pre>"; print_r($pass_mark2);
              
            $result_int['status']=1;
          //-----For First Subject
            if(($value[$i]['programLevel'] == 4))
            {
                for($m=1;$m<=count($pass_mark1);$m++){
                  if(isset($subjectMark1[$m]) && isset($subjectMark2[$m])){                          
                    $aver_mark1=($subjectMark2[$m]+$subjectMark1[$m]);    
                     
                    if($aver_mark1<($pass_mark1[$m]+$pass_mark2[$m])){
                       $result_int['status']=0;
                      break;
                    }
                  }
                  else{
                     $result_int['status']=0;
                      break;
                    
                  }           
                } 
            }
            else
            {
              if(array_sum($subjectMark1) < array_sum($pass_mark1))
              {
                $result_int['status']=0;
                      break;
              }
            } 
              
            
            $margeCourse[]=$value[$i]['courseId'];
            $margeCourse[]=$value[$i+1]['courseId']; 
          }
          else
          {
            //Checking For Other Subject IF Class Category is 4-Secondary
            if((!in_array($value[$i]['courseId'], $margeCourse)))
            {
              $subjectMark1=array_filter(explode(',', trim($value[$i]['divide_mark'])));
              $fields=array(
                //---Previous Code---> 'course_offerId'=>$value[$i]['courseId']
                  'divide_mark'=>'mark_divide.divide_mark, mark_divide.mark_percent' 
              );
              $where1=array(
                //---Previous Code---> 'course_offerId'=>$value[$i]['courseId']
                  'courseId'=>$value[$i]['courseId'],
                  'programOfferId'=>$value[$i]['programOfferId']
                );
              $join=array(
                'mark_divide'=>'mark_divide.course_offerId=courseoffer.offerId'
                );
            //---Previous Code---
              //  $data1=$this->StudentmarksModleAdmin->get_data('mark_divide',$where1);
            //---New Code---
              $data1=$this->StudentmarksModleAdmin->get_data('courseoffer',$where1,$fields,$join);

          //---Previous Code---
          //  $individulMark=array_filter(explode(',', trim(isset($data1[0]['divide_mark']))));
              $individulMark1=array_filter(explode(',', trim(($data1[0]['divide_mark']))));
             
                 $pass_mark1=array();
                 //-----For First Subject
                 for($k=1;$k<=count($individulMark1);$k++){ 
                   $pass_mark1[$k]= round(($individulMark1[$k])*33/100);
                 }
            //   echo "<pre>"; print_r($pass_mark1);
              $result_int['status']=1;
            //-----For First Subject
              if(($value[$i]['programLevel'] == 4))
              {
                  for($m=1;$m<=count($pass_mark1);$m++){
                    if(isset($subjectMark1[$m])){  
                      if($subjectMark1[$m]<$pass_mark1[$m]){
                        $result_int['status']=0;
                        break;
                      }
                    }
                    else{
                     
                      $result_int['status']=0;
                        break;
                      
                    }           
                  } 
                 // echo " >> ". array_sum($subjectMark1)." < ".array_sum($pass_mark1);
              }
              else
              {
                if(array_sum($subjectMark1) < array_sum($pass_mark1))
                {
                  $result_int['status']=0;
                        break;
                }
              }             

                unset($pass_mark1);
            //    unset($result_int);
            }
          }
           
          ?>
            
          </td>
          <td style="text-align: left" class="center_border"> <?php echo $total_marks= array_sum(explode(',', $value[$i]['divide_mark']));
          $ObtainMark += $total_marks;
          ?></td>
          <?php 
          if($courseID!=$value[$i]['courseId']):
            ?>
            <?php if($value[$i]['marge']!=0):
            $total_marks=floor($total_marks+array_sum(explode(',', $value[$i+1]['divide_mark'])))/2;
          endif;
          ?>
          <td style="text-align: left" rowspan="<?php echo $rowSpan;?>" class="center_border"><?php 
         if(isset($result_int['status']) && $result_int['status']==0){
          $total_marks=0;
         }       

         // Percent Mark By 100...
         $percent_marks = round((100 / $value[$i]['totalMark']) * $total_marks);  
       
          echo get_gp($percent_marks);

          $GetAll_GP[] = get_gp($percent_marks);

          $gp += get_gp($percent_marks);
          $subject ++;  


          ?>
            

          </td>
          <td style="text-align: left" rowspan="<?php echo $rowSpan;?>" class="center_border"><?php echo get_lg($percent_marks);?></td>
        <?php endif ?>
      </tr>
      <?php
    }
    else{ ?>
    <tr>
      <td colspan="8" style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">Optional Subject (GP above 2)</td>
    </tr>
    <tr style="border: 1px solid #D8D8D8; " >
      <td style="text-align:left" class="center_border"><?php echo $i+1; ?></td>
      <td style="text-align: left" class="center_border"><?php echo $value[$i]['courseName'];?></td>
      <td style="text-align: left"  class="center_border"><?php echo $value[$i]['courseCode'];?></td>
      <td style="text-align: left"   class="center_border">
        <?php 

        echo $value[$i]['totalMark'];
        $tmark += $value[$i]['totalMark'];

        ?></td>  
      <td style="text-align: left"  class="center_border"><?php echo get_divided_mark($value[$i]['divide_mark']);?></td>
      <td style="text-align: left"   class="center_border"> 
        <?php 
            echo $total_marks= array_sum(explode(',', $value[$i]['divide_mark']));
            $ObtainMark +=$total_marks;
        ?></td>
      <td style="text-align: left" class="center_border">
        <?php 

        // Percent Mark By 100...
         $percent_marks = (100 / $value[$i]['totalMark']) * $total_marks;  
          echo get_gp($percent_marks);

      $added= (get_gp($percent_marks)>2)?get_gp($percent_marks)-2:0;
      $gp += $added;         
      ?></td>
      <td style="text-align: left" class="center_border"><?php echo get_lg($percent_marks);?></td>
    </tr>
    <?php }

  }   
  ?>     
  <?php 
  $gpa=$gp/$subject;
  $grd=get_grade($gpa);
  ?>
  <tr>
    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;"> 
      Total Marks :  <?php echo $tmark ?>
    </td>
    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;"> 
      Obtain Marks :  <?php echo $ObtainMark;?>
    </td>
    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;"> 
     GPA : 
     <?php 
        if(in_array(0, $GetAll_GP))
        {
          echo "0.0";
        }
        else{
          if($gpa > 5){
            echo "5.00";
          }else{
             echo round($gpa,2);
           }
        }
      ?>
   </td>
   <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
    Letter Grade : 
    <?php 
       if(in_array(0, $GetAll_GP))
       {
         echo $grd="F";
       }
       else{
        if($gpa > 5){
          echo "A+";
        }else{
          echo $grd;
            }
          }
     ?>

  </td>
</tr>
<tr>

  <td colspan="8" style="padding:10px 0px 5px;text-align: center; font-size: 20px; font-weight: bold;"> 
    <hr>
    Result Comments :  <?php 
    echo ($grd == 'A+') ? "Excellent Result" : ""; ?>
    <?php echo ($grd == 'A') ? "Very Good Result" : ""; ?>
    <?php echo ($grd == 'A-') ? "Keep Trying Better" : ""; ?>
    <?php echo ($grd == 'B') ? "Try Hard Work" : ""; ?>
    <?php echo ($grd == 'C') ? "Result Not Good" : ""; ?>
    <?php echo ($grd == 'D') ? "Below Average Result" : ""; ?>
    <?php echo ($grd == 'F') ? "Fail" : ""; ?>
  </td>
</tr>
<tr>
  <td colspan="4" style="padding:10px 0px 10px 10px;text-align: left; font-size: 12px; font-weight: bold;"> .............................................<br>Class Teacher </td>
  <td colspan="4" style="padding:10px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;">.............................................<br> Exam Controller </td>
</tr>  
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Right Side/Main Content End --> 