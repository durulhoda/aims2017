<div class="page-header">
   <h1>
      Student Result List
      <small class="red">
      <i class="ace-icon fa fa-angle-double-right"></i>
      All Student Result List
      </small>
   </h1>
</div>
<!-- /.page-header -->
<button class="btn btn-success" onclick="printDiv('printableArea')">
Print A Copy
<i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
</button>
<a href="<?php echo site_url('systemaccess/studentmarks/student_list'); ?>" class="btn btn-info">Back</a>
<div id="printableArea">
   <style tyle="text/css">
      @media print
      {
      .none{display: none;}
      }
   </style>
   <div class="widget-box ">
      <div class="widget-header widget-header-large">
         <div class="center">
            <img alt="<?php echo $institute_info->institute_name; ?>" id="avatar3" src="<?php echo ($institute_info->logo) ? base_url().$institute_info->logo : base_url()."all_upload/default/aims.png"; ?>" width="50">
            <h3>
               <p class="user"> &nbsp; <?php echo $institute_info->institute_name; ?></p>
            </h3>
            <div class="time">
               &nbsp;
               <span class="editable" id="country"> <?php echo $institute_info->address; ?></span><br>
               <h4> Student Result List </h4>
            </div>
         </div>
         <br>
         <center>
            <div id="id-message-infobar" style="background: #e5e5e5 none repeat scroll 0 0; margin-left: -18px; padding: 3px;">
               <span class="blue bigger-130"><?php if(!empty($programId)){ echo "Session : ".getSessionName($sessionId)." - Class : ".getProgramName($programId)." - Group : ".getGroupName($groupId)." - Shift : ".getShiftName($shiftId)." - Section : ".getSectionName($sectionId)." - Semester :  ".getSemesterName($semesterId); } ?></span>
            </div>
         </center>
      </div>
      <table id="simple-table" class="table table-striped table-bordered table-hover">
         <thead>
            <tr>
               <th>#</th>
               <th>Student Id</th>
               <th>Student Name</th>
               <th>Total Mark</th>
               <th>Obtain Mark</th>
               <th>GPA</th>
               <th>Grade Letter</th>
               <th>Class Position</th>
               <th class="none">Print</th>
            </tr>
         </thead>
         <tbody>
         	<?php 
         		if ($students) : 
         		foreach ($students as $key => $val) :
         	?>
            <tr>
               <td><?php echo $key+1; ?></td>
               <td><?php echo $val->student_id; ?></td>
               <td><?php echo $val->student_name; ?></td>
               <td><?php echo isset($records[$val->student_id]['total_marks']) ? $records[$val->student_id]['total_marks'] : ""; ?></td>
               <td><?php echo isset($records[$val->student_id]['total_obtain_marks']) ? $records[$val->student_id]['total_obtain_marks'] : ""; ?></td>
               <td><?php echo isset($records[$val->student_id]['gpa_point']) ? $records[$val->student_id]['gpa_point'] : ""; ?></td>
               <td><?php echo isset($records[$val->student_id]['gpa_letter']) ? $records[$val->student_id]['gpa_letter'] : ""; ?></td>
               <td><?php echo isset($records[$val->student_id]['position']) ? $records[$val->student_id]['position'] : ""; ?></td>
               <?php if (isset($records[$val->student_id]['total_marks'])) : ?>
               <td class="none"><a target="_blank" href="<?php echo site_url()."/systemaccess/studentmarks/transcriptView2?stuent_id=$val->student_id&program_offer_id=$po_id&semester_id=$semesterId" ?>">Print</a></td>
           <?php else : ?>
           	<td class="none">No Result</td>
           <?php endif;?>
            </tr>
        <?php endforeach; endif;  ?>
         </tbody>
      </table>
   </div>
</div>