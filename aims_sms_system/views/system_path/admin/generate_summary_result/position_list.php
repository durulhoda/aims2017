<div class="page-header">
    <h1>
        Student Position List
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            All Student Position List
        </small>
    </h1>
</div>
<!-- /.page-header -->
<button class="btn btn-success" onclick="printDiv('printableArea')">
    Print
    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
</button>
<a href="<?php echo site_url('systemaccess/studentmarks/student_position_list'); ?>" class="btn btn-info">Back</a>
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
                <img alt="<?php echo $institute_info->institute_name; ?>" id="avatar3" src="<?php echo ($institute_info->logo) ? base_url().$institute_info->logo : base_url()."all_upload/default/aims.png"; ?>" width="80">
                <h3>
                    <p class="user"> &nbsp; <?php echo $institute_info->institute_name; ?></p>
                </h3>
                <div class="time">
                    &nbsp;
                    <span class="editable" id="country"> <?php echo $institute_info->address; ?></span><br>
                    <h4> Student Position List </h4>
                </div>
            </div>
            <br>
            <center>
                <div id="id-message-infobar" style="background: #e5e5e5 none repeat scroll 0 0; margin-left: -18px; padding: 3px;">
                    <span class="blue bigger-130"><?php if(!empty($programId)){ echo "Session : ".getSessionName($sessionId)." - Class : ".getProgramName($programId)." - Shift : ".getShiftName($shiftId)." - Group : ".getGroupName($groupId)." - Section : ".getSectionName($sectionId)." - Semester : ".getSemesterName($semesterId); } ?></span>
                </div>
            </center>
        </div>
        <table id="simple-table" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Student Id</th>
                <th>Student Name</th>
                <th>Roll No</th>
                <th>Full Marks</th>
                <th>Obtain Marks</th>
                <th>No. of Fail</th>
                <th>Status</th>
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
                        <td><?php echo $val['student_id']; ?></td>
                        <td><?php echo isset($studentInfo[$val['student_id']]) ? $studentInfo[$val['student_id']] : ''; ?></td>
                        <td><?php echo isset($student_roll[$val['student_id']]) ? $student_roll[$val['student_id']] : ''; ?></td>
                        <td><?php echo $val['total_marks']; ?></td>
                        <td><?php echo $val['obtained_marks']; ?></td>
                        <td><?php echo $val['number_of_failed_subject']; ?></td>
                        <td><?php echo $val['result_status']; ?></td>
                        <td><?php echo $val['position']; ?></td>
                        <?php if ($val['total_marks']): ?>
                            <td class="none"><a target="_blank" href="<?php echo site_url()."systemaccess/generatesummaryresult/transcript_view?student_id=$val[student_id]&program_offer_id=$val[program_offer_id]" ?>">Print</a></td>
                        <?php else : ?>
                            <td class="none">No Result</td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; endif;  ?>
            </tbody>
        </table>
    </div>
</div>