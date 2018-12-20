<style type="text/css">
 table.tabulation thead tr th{text-align: center;vertical-align: middle;}
  table.tabulation tbody tr td{text-align: center;vertical-align: middle;}
  .scroll_class{overflow-x: scroll;}
</style>
<div class="page-header">
  <h1>
    Tabulation Sheet
    <small class="red">
    <i class="ace-icon fa fa-angle-double-right"></i>
    Tabulation Sheet
    </small>
    <button class="btn btn-success " onclick="printDiv('printableArea')">
      Print
      <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
    </button> 
  </h1>
</div>
<div class="row">
  <div class="col-xs-12">
    <div id="printableArea">
    <style tyle="text/css">
        @media print
       {
          table.tabulation thead tr th{text-align: center;vertical-align: middle;}
          table.tabulation tbody tr td{text-align: center;vertical-align: middle;}
          .scroll_class{overflow-x: unset;}
       }
    </style>
      <div style="margin: 10px auto 0px;  width: 100%; border: 0px solid #cccccc; ">
            <div style=" border: 1px solid #d9d9d9;">
               <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                  <tbody>
                  <tr style=" font-family: cambria;">
                    <th colspan="7" style="text-align: center;">
                      <?php $logo = base_url().$institute_info->logo;?>
                        <p style="margin-left:5px;">
                        <img src="<?php echo $logo; ?>" style="margin-top:3px;" height="80" />  
                        <div style="font-size: 20px; font-size: 35px; color: royalblue;">    
                          <?php echo ($institute_info->institute_name) ? $institute_info->institute_name : "";?>          
                        </div>                                           
                        <div style="line-height: 3px; font-size: 18px; color: #444;"> 
                          <?php echo ($institute_info->address) ? $institute_info->address : ""; ?>                
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
               </tbody></table>
            </div>
         </div>
         <!--    end header    -->
         <?php if ($course_offer_list) : ?>
          <div class="scroll_class">
            <table class="table table-bordered tabulation">
              <thead>
                <tr>
                  <th rowspan="2" colspan="1">#</th>
                  <th rowspan="2" colspan="1">Student Id</th>
                  <th rowspan="2" colspan="1">Student Name</th>
                  <th rowspan="2" colspan="1">Roll No</th>
                  <?php 
                    foreach ($course_offer_list as $key => $val) : 
                      if ($val['mark_cat_id']) {
                        $cat_len = count(explode(',', substr($val['mark_cat_id'], 1, -1)));
                      } else {
                        $cat_len = 0;
                      }
                  ?>
                  <th rowspan="1" colspan="<?php echo $cat_len+1; ?>"><?php echo $val['courseName'].'&nbsp;(<b style="color:#d2581e;">'.$val['marks'].'</b>)'; ?></th>
                  <?php endforeach; ?>
                  <th rowspan="1" colspan="6">Total Result</th>
                </tr>
                <tr>
                <?php foreach ($course_offer_list as $key => $val) : ?>
                <?php if ($val['mark_cat_id']) : 
                  $mark_cat = explode(',', substr($val['mark_cat_id'], 1, -1));
                  $cat_len = count($mark_cat);
                  for ($i = 0; $i< $cat_len; $i++) :
                ?>
                    <th><?php echo isset($course_cate_name[$mark_cat[$i]]) ? strtoupper(substr($course_cate_name[$mark_cat[$i]], 0, 3))."." : ""; ?></th>
                <?php endfor; ?>
                <th style="color:green;">Total</th>
                <?php else : ?>
                  <th>No Distributed</th>
                <?php endif; ?>
                <?php endforeach; ?>
                <th>Marks</th>
                <th>Obtain Marks</th>
                <th>GPA</th>
                <th>Grade</th>
                <th>Fail Subject</th>
                <th>Position</th>
                </tr>
              </thead>
              <tbody>
                <?php if($student_list) : ?>
                  <?php foreach ($student_list as $sk => $val) : 
                    $total_marks = isset($student_mark_info['mst_arr'][$val->studentId]['total_common_marks']) ? $student_mark_info['mst_arr'][$val->studentId]['total_common_marks'] : 'Nill';
                    $total_obtain_marks = isset($student_mark_info['mst_arr'][$val->studentId]['total_obtain_common_marks']) ? $student_mark_info['mst_arr'][$val->studentId]['total_obtain_common_marks'] : 'Nill';
                    $gpa_point = isset($student_mark_info['mst_arr'][$val->studentId]['gpa_point']) ? $student_mark_info['mst_arr'][$val->studentId]['gpa_point'] : 'Nill';
                    $gpa_letter = isset($student_mark_info['mst_arr'][$val->studentId]['gpa_letter']) ? $student_mark_info['mst_arr'][$val->studentId]['gpa_letter'] : 'Nill';
                     $tot_fail_subj = isset($student_mark_info['mst_arr'][$val->studentId]['tot_fail_subj']) ? $student_mark_info['mst_arr'][$val->studentId]['tot_fail_subj'] : 'Nill';
                     $position = isset($student_mark_info['mst_arr'][$val->studentId]['position']) ? $student_mark_info['mst_arr'][$val->studentId]['position'] : 'Nill';
                  ?>
                  <tr>
                    <td><?php echo $sk+1; ?></td>
                    <td><?php echo $val->studentId; ?></td>
                    <td style="display: block;width: 150px;text-align: left;"><?php echo $val->firstName; ?></td>
                    <td><?php echo isset($student_roll[$val->studentId]) ? $student_roll[$val->studentId] : ''; ?></td>

                    <?php foreach ($course_offer_list as $key => $row) : ?>
                      <?php if ($row['mark_cat_id']) : 
                          $mark_cat = explode(',', substr($row['mark_cat_id'], 1, -1));
                          $cat_len = count($mark_cat);
                          $sub_tot_mark = isset($student_mark_info['dtl_arr'][$val->studentId][$row['courseId']]['sub_total_mark']) ? $student_mark_info['dtl_arr'][$val->studentId][$row['courseId']]['sub_total_mark'] : 0;

                          $sub_gpa_letter = isset($student_mark_info['dtl_arr'][$val->studentId][$row['courseId']]['sub_gpa_letter']) ? $student_mark_info['dtl_arr'][$val->studentId][$row['courseId']]['sub_gpa_letter'] : "F";
                          $sub_gpa_letter = ($sub_gpa_letter == "F") ? "red" : "green";

                          for ($i = 0; $i< $cat_len; $i++) :
                            $c_mark = isset($student_mark_info['dtl_arr'][$val->studentId][$row['courseId']]['c_mark'][$mark_cat[$i]]) ? $student_mark_info['dtl_arr'][$val->studentId][$row['courseId']]['c_mark'][$mark_cat[$i]] : "Nill";
                      ?>
                        <td><?php echo $c_mark; ?></td>
                      <?php endfor; ?>
                      <td><b style="color:<?php echo $sub_gpa_letter; ?>"><?php echo round($sub_tot_mark); ?></b></td>
                    <?php else : ?>
                      <td>ND</td>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <td><b><?php echo round($total_marks); ?></b></td>
                    <td><b><?php echo round($total_obtain_marks); ?></b></td>
                    <td><b><?php echo $gpa_point; ?></b></td>
                    <td><b><?php echo $gpa_letter; ?></b></td>
                    <td><b><?php echo $tot_fail_subj; ?></b></td>
                    <td><b><?php echo $position; ?></b></td>
                  </tr>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
             </table>
          </div>
       <?php endif; ?>
    </div>
  </div>
</div>