<!-- /Content Section  -->
<div class="page-header">

    <h1>
        Student Attendance
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Student Attendance List
        </small>

    </h1>

</div><!-- /.page-header -->



<div class="row">

    <?php

    $message = $this->session->userdata('message');

    if (isset($message))
    {

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

        <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentsattendance/studentAttendace" method="post">



            <div class="col-xs-12 col-sm-12">

                <!-- PAGE CONTENT BEGINS -->

                <div class=" col-xs-10 col-sm-4">

                    <label class="control-label" for="form-field-1">Session <span style="color: red;">*</span> &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">

                        <option value="">Select</option>

                        <?php foreach (getOfferedSession() as $value) { ?>

                            <option value="<?php echo $value['sessionId']; ?>"

                                <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >

                                <?php echo $value['session']; ?></option>

                        <?php   }    ?>

                    </select>

                </div>



                <div class=" col-xs-10 col-sm-4">

                    <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" class="form-control">



                    </select>

                </div>

                <div class=" col-xs-10 col-sm-4">

                    <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" class="form-control">



                    </select>

                </div>

                <div class=" col-xs-10 col-sm-4">

                    <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" class="form-control" >



                    </select>

                </div>

                <div class=" col-xs-10 col-sm-4">

                    <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" class="form-control">



                    </select>

                </div>



                <div class="col-xs-10 col-sm-4">

                    <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="getsectionid" name="data[sectionId]" class="form-control">



                    </select>

                </div>

                <div class="col-xs-6 col-sm-3">

                    <label class="control-label" for="form-field-1">Student Id  &nbsp; <?php echo form_error('studentId', '<span class="successMessage">', '</span>'); ?></label>

                    <input type="text" name="data[studentId]" class="form-control">

                </div>



                <div class="col-xs-6 col-sm-3">

                    <label class="control-label" for="form-field-1">From Date  &nbsp; <?php echo form_error('fromDate', '<span class="successMessage">', '</span>'); ?></label>

                    <div class="input-group input-group-sm">

                        <input class="form-control date-picker" name="data[fromDate]" type="text">

                        <span class="input-group-addon">

                                    <i class="fa fa-calendar bigger-110"></i>

                                </span>

                    </div>

                </div>



                <div class="col-xs-6 col-sm-3">

                    <label class="control-label" for="form-field-1">To Date  &nbsp; <?php echo form_error('toDate', '<span class="successMessage">', '</span>'); ?></label>

                    <div class="input-group input-group-sm">

                        <input class="form-control date-picker" name="data[toDate]" type="text">

                        <span class="input-group-addon">

                                    <i class="fa fa-calendar bigger-110"></i>

                                </span>

                    </div>

                </div>

                <div class="col-xs-6 col-sm-3">

                    <label class="control-label" for="form-field-1">Attendance Status  &nbsp; <?php echo form_error('status', '<span class="successMessage">', '</span>'); ?></label>

                    <select name="data[status]" class="form-control">

                        <option value="">--Select--</option>

                        <option value="1">Present</option>

                        <option value="2">Absent</option>

                    </select>

                </div>



            </div>



            <div class="col-xs-12">

                <div class="clearfix form-actions">

                    <div class="col-md-6 col-md-offset-5">

                        <button class="btn btn-success btn-sm" name="search" type="submit">

                            <!--                                    <i class="ace-icon fa fa-check bigger-110"></i>--> Search Here

                        </button>

                        <!--                                <input type="submit" class="btn btn-success btn-sm" value="Search By Class"-->
                        <!---->
                        <!--                                name="searchByClass">-->

                    </div>

                </div>

            </div>

        </form>



    </div><!-- /.col-x12 -->

</div> <!-- /.row -->

<div id="printableArea">

    <style tyle="text/css">

        @media print

        {

            .none{display: none;}

        }

    </style>

    <div class="col-md-12">

        <div class="widget-box ">

            <!-- <?php// if ($records) : ?> -->

            <div class="widget-header widget-header-large">

                <button class="btn btn-success none" onclick="printDiv('printableArea')">

                    Print Copy

                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>

                </button>

                <div class="center">

                    <img alt="<?php echo $institute_info->institute_name; ?>" id="avatar3" src="<?php echo ($institute_info->logo) ? base_url().$institute_info->logo : base_url()."all_upload/default/aims.png"; ?>" width="50">

                    <h3>

                        <p class="user"> &nbsp; <?php echo $institute_info->institute_name; ?></p>

                    </h3>

                    <div class="time">

                        &nbsp;

                        <span class="editable" id="country"> <?php echo $institute_info->address; ?></span><br>

                        <h4> Student Attendance List (

                            <?php if (isset($fromDate) || isset($toDate)): ?>

                                <?php echo isset($fromDate) ? $fromDate : ""; ?>

                                <?php echo isset($toDate) ? "-".$toDate : ""; ?>

                            <?php endif; ?>

                            )</h4>

                    </div>

                </div>

                <br>

                <center>

                    <div id="id-message-infobar" style="background: #e5e5e5 none repeat scroll 0 0; margin-left: -18px; padding: 3px;">

                        <span class="blue bigger-130"><?php if(!empty($programId)){ echo "Session : ".getSessionName($sessionId)." - Class : ".getProgramName($programId)." - Group : ".getGroupName($groupId)." - Shift : ".getShiftName($shiftId)." - Section : ".getSectionName($sectionId);} ?></span>

                    </div>

                </center>

            </div>

            <!--  <?php// endif; ?> -->

            <table class="table table-bordered">

                <thead>

                <tr>

                    <td>#</td>

                    <td>Student Id</td>

                    <td>Student Name</td>

                    <td>Date</td>

                    <td>In Time</td>

                    <td>Out Time</td>

                    <td>Status</td>

                    <!--<td>Type</td>-->

                </tr>

                </thead>

                <tbody>

                <?php if (isset($records)) : ?>

                    <?php foreach ($records as $key => $val) : ?>

                        <tr>

                            <td><?php echo $key+1; ?></td>

                            <td><?php echo $val['studentId']; ?></td>

                            <td><?php echo $val['firstName']; ?></td>

                            <td><?php echo $val['attendanceDate']; ?></td>

                            <td><?php if(isset($val['in_time'])){echo date('H:i:s', $val['in_time']);}?></td>

                            <td><?php if(isset($val['out_time'])){echo date('H:i:s', $val['out_time']);}?></td>

                            <td><?php echo ($val['attendanceStatus'] == 1) ? "Present" : "Absent"; ?></td>

                            <!--<td><?php //echo $val['attendance_type'];?></td>-->

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                <?php if (isset($results)) : ?>

                    <?php

                    foreach ($results as $key => $val) : ?>

                        <tr>

                            <td><?php echo $key+1; ?></td>

                            <td><?php echo $val->studentId; ?></td>

                            <td><?php echo 'Tanay' ?></td>

                            <td><?php echo $val->attendanceDate; ?></td>

                            <td><?php echo '9.00'; ?></td>

                            <td><?php echo '4.00'; ?></td>

                            <td><?php echo ($val->attendanceStatus == 1) ? "Present" : "Absent"; ?></td>

                            <!--<td><?php //echo "Manual"; ?></td>-->

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>