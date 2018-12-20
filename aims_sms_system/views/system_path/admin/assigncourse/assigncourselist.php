<style>
    tr td:last-child{
        width:1%;
        white-space:nowrap;
    }
    .modal-backdrop {
        background-color: gray;
    }
</style>

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
</div>

<?php
if (!empty($courselist)) {
?>
<div class="col-xs-12 col-sm-12">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-large">
            <h3 class="widget-title grey lighter">
                <i class="ace-icon fa fa-exchange green"></i>
                Assign Subject Information
            </h3>

            <div class="widget-toolbar hidden-480">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Again </a>
            </div>
        </div>
        <div id="modal-table" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            Search Again By Enrollment Info
                        </div>
                    </div>

                    <div class="modal-body no-padding">

                        <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/assigncourse/searchcourseassignlist" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <!-- PAGE CONTENT BEGINS -->
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach (getOfferedSession() as $value) { ?>
                                                <option value="<?php echo $value['sessionId']; ?>"
                                                    <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                                    <?php echo $value['session']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">


                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control" >

                                        </select>
                                    </div>

                                </div>

                                <div class="col-xs-12">
                                    <div class="clearfix form-actions">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" name="search" type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i> Search Student Information
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS -->
        <br>

        <div class="page-header">
            <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
            <span class="btn btn-purple no-border">
                <i class="ace-icon fa fa-print bigger-130"></i>
                <span class="bigger-110">Print</span>
            </span>
            </button>
        </div><!-- /.page-header -->

        <div id="printableArea">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="row">
                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                            <b> Subject Offer List According To Your Enrollment Information</b>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <ul class="list-unstyled spaced">
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Session:
                                    <?php echo $enrollment_info[0]['session'];?>
                                    <input type="hidden" value="<?php echo $enrollment_info[0]['sessionId']; ?>" name="sessionId">
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                    <?php echo $enrollment_info[0]['programName'];?>
                                    <input type="hidden" value="<?php echo $enrollment_info[0]['programId'];?>" name="programId">
                                </li>
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Medium:
                                    <?php echo $enrollment_info[0]['mediumName'];?>
                                    <input type="hidden" value=" <?php echo $enrollment_info[0]['mediumId'];?>" name="mediumId">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <ul class="list-unstyled spaced">
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Shift:
                                    <?php echo $enrollment_info[0]['shiftName'];?>
                                    <input type="hidden" value="<?php echo $enrollment_info[0]['shiftId'];?>" name="shiftId">
                                </li>
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Group:
                                    <?php echo $enrollment_info[0]['groupName'];?>
                                    <input type="hidden" value="<?php echo $enrollment_info[0]['groupId'];?>" name="groupId">
                                </li>
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Section:
                                    <?php echo $enrollment_info[0]['sectionName'];?>
                                    <input type="hidden" value="<?php echo $enrollment_info[0]['sectionId'];?>" name="sectionId">
                                </li>

                            </ul>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="col-xs-12">
                <?php

                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-12">
                        <div>
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Student</th>
                                    <th>Roll No</th>
                                    <th>Common</th>
                                    <th>Group Main</th>
                                    <th>Optional</th>
                                    <th>Extra</th>
                                    <th>Action</th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $sl=1;
                                foreach($courselist as $value)
                                {
                                    // var_dump($value['studentId']);
                                    $roll_n = isset($roll_no[$value['studentId']]) ? $roll_no[$value['studentId']] : "";
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>

                                        <td>
                                            <?php if(!empty($value['studentId'])){
                                                echo "<span style='font-size:15px;'>"."<strong>".$value['studentId']."</strong>"."</span>"."<br><b>"."<span style='font-size:15px;'>"."<strong>".$value['firstName']."</strong>"."</span>"." ".$value['lastName']."</b>";
                                            }?>
                                        </td>
                                        <td id="roll_container_<?php echo $value['assignId']; ?>"><?php echo $roll_n; ?></td>
                                        <td>
                                            <?php
                                            if ($value['courseId']) {
                                            $editDatas = explode(",", trim($value['courseId'],","));
                                            $status = explode(",", trim($value['courseStatus'],","));
                                            $countcourse=count($editDatas);
                                            ?>
                                            <span style="width: 30%" id="commonsubname" name="commonsubname"><small id="common_container_<?php echo $value['assignId']; ?>"> <?php
                                                    for($x=0; $x<$countcourse;$x++)
                                                    {
                                                        if ($status[$x] == 1){
                                                            echo "<span style='font-size:15px;'>".(int)getCourseCode($editDatas[$x])."  "."</span>";
                                                        }
                                                    }
                                                    }
                                                    ?>
                                            </small></span>
                                        </td>
                                        <td>
                                            <?php
                                            if ($value['courseId']) {
                                            $editDatas = explode(",", trim($value['courseId'],","));
                                            $status = explode(",", trim($value['courseStatus'],","));
                                            $countcourse=count($editDatas);
                                            ?>
                                            <span style="width: 30%" id="grpmainsubname" name="grpmainsubname"><small id="group_container_<?php echo $value['assignId']; ?>"> <?php
                                                    for($x=0; $x<$countcourse;$x++)
                                                    {
                                                        if ($status[$x] == 3) {
                                                            echo "<span style='font-size:15px;'>".(int)getCourseCode($editDatas[$x])." "."</span>";
                                                        }
                                                    }
                                                    }
                                                    ?>
                                            </small></span>
                                        </td>
                                        <td>
                                            <?php
                                            if ($value['courseId']) {
                                            $editDatas = explode(",", trim($value['courseId'],","));
                                            $o_status = explode(",", trim($value['courseStatus'],","));
                                            $countcourse=count($editDatas);
                                            ?>
                                            <span style="width: 30%" id="optsubname" name="optsubname"><small id="optional_container_<?php echo $value['assignId']; ?>"> <?php
                                                    for($x=0; $x<$countcourse;$x++)
                                                    {
                                                        if ($o_status[$x] == 2) {
                                                            echo "<span style='font-size:15px;'>".(int)getCourseCode($editDatas[$x])." "."</span>";
                                                        }
                                                    }
                                                    }
                                                    ?>
                                            </small></span>
                                        </td>
                                        <td>
                                            <?php
                                            if ($value['courseId']) {
                                            $editDatas = explode(",", trim($value['courseId'],","));
                                            $status = explode(",", trim($value['courseStatus'],","));
                                            $countcourse=count($editDatas);
                                            ?>
                                            <span style="width: 30%" id="extrasubname" name="extrasubname"><small id="extra_container_<?php echo $value['assignId']; ?>"> <?php
                                                    for($x=0; $x<$countcourse;$x++)
                                                    {
                                                        if ($status[$x] == 4){
                                                            echo "<span style='font-size:15px;'>".(int)getCourseCode($editDatas[$x])."  "."</span>";
                                                        }
                                                    }
                                                    }
                                                    ?>
                                            </small></span>
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">
                                                <?php if ($value['assignId']) : ?>

                                                    <a href="<?php echo admin_Url();?>/assigncourse/editassigncourse/<?php echo $value['assignId']; ?>" class="btn btn-xs btn-info" target="_blank">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>
                                                <?php else : ?>
                                                    <a href="<?php echo admin_Url()."/promotestudent/insertPromotionconfirm1?studentId=".$value['studentId']."&sessionId=".$enrollment_info[0]['sessionId']."&programLevel=".$enrollment_info[0]['programLevel']."&programId=".$enrollment_info[0]['programId']."&mediumId=".$enrollment_info[0]['mediumId']."&groupId=".$enrollment_info[0]['groupId']."&shiftId=".$enrollment_info[0]['shiftId']."&sectionId=".$enrollment_info[0]['sectionId']."&roll_no=$roll_n" ?>" class="btn btn-xs btn-info" target="_blank">
                                                        <i class="fa fa-plus bigger-120" aria-hidden="true"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>

                                            <div class="hidden-sm hidden-xs btn-group">
                                                <?php if ($value['assignId']) : ?>
                                                    <a class="m_item" data-id="<?php echo $value['assignId']; ?>" data-toggle="modal" data-target="#update_course" href="#">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>

                                                <?php else : ?>
                                                    <a href="<?php echo admin_Url()."/promotestudent/insertPromotionconfirm1?studentId=".$value['studentId']."&sessionId=".$enrollment_info[0]['sessionId']."&programLevel=".$enrollment_info[0]['programLevel']."&programId=".$enrollment_info[0]['programId']."&mediumId=".$enrollment_info[0]['mediumId']."&groupId=".$enrollment_info[0]['groupId']."&shiftId=".$enrollment_info[0]['shiftId']."&sectionId=".$enrollment_info[0]['sectionId']."&roll_no=$roll_n" ?>" class="btn btn-xs btn-info" target="_blank">
                                                        <i class="fa fa-plus bigger-120" aria-hidden="true"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/assigncourse/editassigncourse/<?php echo $value['assignId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.span -->
                    <?php }?>
                </div><!-- /.row -->

            </div><!-- /.col-x12 -->
        </div> <!-- /.row -->
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="update_course" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Student Subject Assign</h4>
            </div>
            <div class="modal-body">


                <div class="row">
                    <form id="data_edit_form" action="#" method="post">



                        <div class="col-sm-12">
                            <div class="widget-box">
                                <div class="widget-header widget-header-flat">
                                    <h4 class="widget-title smaller">
                                        <i class="ace-icon fa fa-user"></i>&nbsp;
                                        Student Short Profile
                                    </h4>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">


                                        <div class="row">
                                            <div class="col-xs-4">
                                                <blockquote class="pull-left">

                                                    <small>
                                                        Student Id:
                                                        <cite title="Student Id" class="red bolder" id="student_id_container"></cite>
                                                        <input id="input_student_id_container" type="hidden" checked='checked' name="studentId" id="studentId" value=''>
                                                    </small>
                                                    <small>
                                                        Student Name:
                                                        <cite class="lighter red" id="student_name_container"></cite>
                                                    </small>

                                                </blockquote>


                                            </div>
                                            <div class="col-xs-4">
                                                <blockquote class="pull-left">
                                                    <small>
                                                        Class:
                                                        <cite  class="lighter red" id="student_class_container"></cite>
                                                    </small>
                                                    <small>
                                                        Medium:
                                                        <cite  class="lighter red" id="student_medium_container"></cite>
                                                    </small>

                                                </blockquote>
                                            </div>
                                            <div class="col-xs-4">
                                                <blockquote class="pull-left">

                                                    <small>
                                                        Session:
                                                        <cite  class="lighter red" id="student_session_container"></cite>
                                                        <input id="input_student_session_container" type='hidden' name='programOfferId' value=''>
                                                    </small>
                                                    <small>
                                                        Shift:
                                                        <cite  class="lighter red" id="student_shift_container"></cite>
                                                    </small>

                                                    <small>
                                                        Group:
                                                        <cite  class="lighter red" id="student_group_container"></cite>
                                                    </small>

                                                    <small>
                                                        Section:
                                                        <cite  class="lighter red" id="student_section_container"></cite>
                                                    </small>

                                                    <small>
                                                        Roll No:
                                                        <cite class="lighter red">
                                                            <input id="input_student_roll_container" type="text" name="roll_no" value="1" class="form-control">
                                                        </cite>
                                                    </small>


                                                </blockquote>


                                            </div>

                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="smaller">
                                            <i class="ace-icon fa fa-external-link"></i>
                                            Subject List By Category
                                        </h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main row ">


                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <table class="table table-striped table-responsive table-bordered table-hover" id="tbl1">
                                                        <thead>
                                                        <tr>
                                                            <th>Sl no</th>
                                                            <th>Subject Category</th>
                                                            <th>Subject Name</th>
                                                            <th>Assign Teacher</th>
                                                            <th>Mark</th>
                                                            <th>Select</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody id="table_body_container"></tbody>

                                                    </table>
                                                </div>
                                            </div><!-- /.row -->
                                        </div>

                                    </div>

                                    <div class="modal-footer" style="text-align: center;">
                                        <button id="update_button" type="submit" class="btn btn-success" name="save">
                                            <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                                            Update
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>
</div>
<!-- Modal -->


<!--Modal alert-->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="header_mod">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p id="message_mod">This is a small modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Modal alert-->








<script>

    // $("#update_course").modal("show");
    // $("#update_course").modal("hide");

    $(document).ready(function(){
        $(".m_item").click(function(){
            event.preventDefault();
            var assign_id = $(this).attr('data-id');
            $("#update_button").removeAttr('assign_id');
            $("#update_button").attr('assign_id',assign_id);

            $("#update_course").modal("hide");
            $('#student_id_container').html('');
            $('#input_student_id_container').val('');
            $('#student_name_container').html('');
            $('#student_class_container').html('');
            $('#student_medium_container').html('');
            $('#student_group_container').html('');
            $('#student_section_container').html('');
            $('#student_shift_container').html('');
            $('#student_session_container').html('');
            $('#input_student_session_container').val('');
            $('#input_student_roll_container').val('');
            $('#table_body_container').html('');

            $.ajax({
                type: "POST",
                url: "<?php echo admin_Url();?>/assigncourse/get_student_course_information",
                data: {id  : assign_id},
                dataType : "html",
                success: function(data){
                    var result = JSON.parse(data);

                    $('#student_id_container').html(result.exiting_data.studentId);
                    $('#input_student_id_container').val(result.exiting_data.studentId);
                    $('#student_name_container').html(result.exiting_data.firstName);
                    $('#student_class_container').html(result.exiting_data.programName);
                    $('#student_medium_container').html(result.exiting_data.mediumName);
                    $('#student_group_container').html(result.exiting_data.groupName);
                    $('#student_section_container').html(result.exiting_data.sectionName);
                    $('#student_shift_container').html(result.exiting_data.shiftName);
                    $('#student_session_container').html(result.exiting_data.session);
                    $('#input_student_session_container').val(result.exiting_data.programOfferId);
                    $('#input_student_roll_container').val(result.roll_no[result.exiting_data.studentId]);


                    result.assign_course_list.forEach(function(item,i) {
                        //alert(i+1);

                        var body_html;
                        var select_html;
                        body_html = '<tr>' +
                            '<td>'+(i+1)+'</td>' +
                            '<td>';
                        select_html = '' +
                            '<select id="course_category_'+i+'" class="course_category_class" name="courseStatus['+(i+1)+']">' +
                            '<option value="">Select</option>';
                        if(result.course_status[item.courseId]==1){
                            select_html=select_html+'<option value="1" selected>Common</option>'
                        }
                        else
                        {
                            select_html=select_html+'<option value="1">Common</option>'
                        }

                        if(result.course_status[item.courseId]==2){
                            select_html=select_html+'<option value="2" selected>Optional</option>'
                        }
                        else
                        {
                            select_html=select_html+'<option value="2">Optional</option>'
                        }

                        if(result.course_status[item.courseId]==3){
                            select_html=select_html+'<option value="3" selected>Group Main</option>'
                        }
                        else
                        {
                            select_html=select_html+'<option value="3">Group Main</option>'
                        }

                        if(result.course_status[item.courseId]==4){
                            select_html=select_html+'<option value="4" selected>Extra</option></select>'
                        }
                        else
                        {
                            select_html=select_html+'<option value="4">Extra</option>'
                        }
                        select_html = select_html+ '</select>';
                        body_html = body_html + select_html;
                        body_html = body_html +
                            '</td>' +

                            '<td>' + item.courseName +
                            '<input type="hidden" id="course_id" name="courseId['+(i+1)+']" value="'+item.courseId+'">' +
                            '<input type="hidden" id="course_code" name="course_code['+(i+1)+']" value="'+item.courseCode+'">' +
                            '</td>' +

                            '<td>' + item.firstName+' '+ item.lastName +
                            '<input type="hidden" id="employee_id" name="employeeId['+(i+1)+']" value="'+item.employeeId+'">' +
                            '</td>' +

                            '<td>' + item.marks + '</td>' +

                            '<td style="background: #ccc; text-align: center">'
                        if(typeof(result.course_status[item.courseId])!='undefined')
                        {
                            body_html+='<input type="checkbox" class="serial_id" checked="checked" name="serial['+(i+1)+']" id="serial_'+i+'" value="'+(i+1)+'">'
                        }
                        else
                        {
                            body_html+='<input type="checkbox" class="serial_id" name="" id="serial_'+i+'" value="'+(i+1)+'">'
                        }

                            '</td>' +
                            '</tr>';
                        $('#table_body_container').append(body_html);


                        $(".serial_id").click(function()
                        {
                            var id = $(this).val();
                            if ($(this).prop('checked'))
                            {
                                $(this).attr('name','serial['+id+']');
                                //$(this).attr('checked','checked');
                            }
                            else
                            {
                                $(this).removeAttr('name');
                                //$(this).removeAttr('checked');
                            }

                        });


                    });

                    $("#update_course").modal("show");

                },
                error: function(data) {
                    alert('error');
                }
            });

        });

        // data_edit_form//

        $("#update_button").click(function(){
            event.preventDefault();
            var cci;
            var check = true;
            jQuery.each( $(".serial_id"), function( i, val ) {
                if ($("#serial_"+i).prop('checked'))
                {
                    cci = $("#course_category_"+i).val();
                    if(cci=='')
                    {
                        check = false;
                    }
                }
            });
            if(check)
            {
                var assign_id = $(this).attr('assign_id');
                var json_str = $('form#data_edit_form').serializeJSON();

                $.ajax({
                    type: "POST",
                    async: false,
                    url: "<?php echo admin_Url();?>/assigncourse/update_student_course_information_and_roll",
                    data: {json_str  : json_str},
                    // dataType: "json",
                    success: function(data)
                    {
                        goal = JSON.parse(data);
                        if(goal.status=='success')
                        {
                            $("#roll_container_"+assign_id).html('');
                            $("#common_container_"+assign_id).html('');
                            $("#optional_container_"+assign_id).html('');
                            $("#group_container_"+assign_id).html('');
                            $("#extra_container_"+assign_id).html('');
                            $("#roll_container_"+assign_id).html(goal.roll_no);
                            if(typeof goal.common !== 'undefined') {
                                goal.common.forEach(function (item, i) {
                                    $("#common_container_"+assign_id).append('<span style="font-size:15px;">' + item + '  ' + '</span>');
                                });
                            }
                            if(typeof goal.option !== 'undefined') {
                                goal.option.forEach(function (item, i) {
                                    $("#optional_container_"+assign_id).append('<span style="font-size:15px;">' + item + '  ' + '</span>');
                                });
                            }
                            if(typeof goal.group !== 'undefined') {
                                goal.group.forEach(function (item, i) {
                                    $("#group_container_"+assign_id).append('<span style="font-size:15px;">' + item + '  ' + '</span>');
                                });
                            }
                            if(typeof goal.extra !== 'undefined') {
                                goal.extra.forEach(function (item, i) {
                                    $("#extra_container_"+assign_id).append('<span style="font-size:15px;">' + item + '  ' + '</span>');
                                });
                            }
                            $("#update_course").modal("hide");
                            $("#header_mod").html("");
                            $("#header_mod").html("Success");
                            $("#message_mod").html("");
                            $("#message_mod").html("Successfully Updated");
                            $("#myModal").modal("show");
                            setTimeout(function()
                            {
                                $("#myModal").modal("hide");
                            }, 1000);
                        }
                        if(goal.status=='failed')
                        {
                            $("#update_course").modal("hide");
                            $("#header_mod").html("");
                            $("#header_mod").html("Database Error");
                            $("#message_mod").html("");
                            $("#message_mod").html("Please contact to administrator");
                            $("#myModal").modal("show");
                        }
                        if(goal.status=='post_error')
                        {
                            $("#update_course").modal("hide");
                            $("#header_mod").html("");
                            $("#header_mod").html("Post Error");
                            $("#message_mod").html("");
                            $("#message_mod").html("Please refresh the page and try again");
                            $("#myModal").modal("show");
                        }
                        //$("#update_course").modal("hide");
                    },
                    error: function(data) {
                        $("#update_course").modal("hide");
                        $("#header_mod").html("");
                        $("#header_mod").html("Error Occured");
                        $("#message_mod").html("");
                        $("#message_mod").html("Please contact to administrator");
                        $("#myModal").modal("show");
                        return;
                    }
                });
            }
            else
            {
                $("#update_course").modal("hide");
                $("#header_mod").html("");
                $("#header_mod").html("Validation Error");
                $("#message_mod").html("");
                $("#message_mod").html("Subject Category Missing");
                $("#myModal").modal("show");

            }

        });



    });

</script>
    
    