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
if (!empty($applicantlist)) {
?>

<div class="row">
<div class="col-sm-12">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-large">
            <h3 class="widget-title grey lighter">
                <i class="ace-icon fa fa-exchange green"></i>
                All Applicant Information
            </h3>



            <div class="widget-toolbar hidden-480">
                <i class="ace-icon fa fa-print"></i>
                <a href="<?php echo base_url('systemaccess/applicant/printAppliacnrList/'.$enrollData['programOfferId']); ?>" role="button" class="green" > Print Applicant List </a>


            </div>
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
                            Search Again Applicant List By Enrollment Information
                        </div>
                    </div>

                    <div class="modal-body no-padding">
                        <!--<form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/applicant/applicantlist" enctype="multipart/form-data" method="post">-->

                        <div class="col-xs-12 col-sm-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="datax[sessionId]"  class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach (getOfferedSession() as $value) { ?>
                                        <option value="<?php echo $value['sessionId']; ?>" >
                                            <?php echo $value['session']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="  col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('datax[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId(); " name="datax[programLevel]" data-placeholder="Select" class="form-control">

                                </select>
                            </div>
                            <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getprogramid" onchange="return getOfferedprogramId(); " name="datax[programId]" class="form-control">

                                </select>
                            </div>
                            <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getmediumid" onchange="return getOfferedmediumId(); " name="datax[mediumId]" class="form-control">

                                </select>
                            </div>
                            <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getshiftid" onchange="return getOfferedshiftId(); " name="datax[shiftId]" class="form-control" >

                                </select>
                            </div>
                            <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getgroupid" onchange="return getOfferedgroupId(); " name="datax[groupId]" class="form-control">

                                </select>
                            </div>

                        </div>



                        <div class="modal-footer no-margin-top">
                            <div class="space"></div>
                            <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Close
                            </button>
                            <button class="btn btn-success pull-right" name="search" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Search Applicant Information
                            </button>
                        </div>
                        <!--</form> -->
                    </div>



                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS -->
        <div class="row">

            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                        <b> Enrollment Information</b>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Session:
                                <?php
                                if(!empty($sessionId)) {echo "<b>".getSessionName($sessionId)."</b>"; }

                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Class Level:
                                <?php
                                foreach (getProgramLevel() as $key =>$value) {
                                    if ($programLevel == $key) {
                                        echo "<b>" . $value . "</b>";
                                    }
                                }
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                <?php
                                if(!empty($programId))   {  echo "<b>" . getProgramName($programId) . "</b>";}
                                ?>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Medium:
                                <?php
                                if(!empty($mediumId))   { echo "<b>" . getmediumName($mediumId) . "</b>";}
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Shift:
                                <?php
                                if(!empty($shiftId))  {echo "<b>" . getshiftName($shiftId) . "</b>";}
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Group:
                                <?php
                                if(!empty($groupId)) {echo "<b>" . getGroupName($groupId) . "</b>";}
                                ?>
                            </li>

                        </ul>
                    </div>
                </div>
            </div><!-- /.col -->


        </div><!-- /.row -->
    </div>

</div> <!-- /.row -->

<form action="<?php echo admin_Url(); ?>/applicant/registrationConfarmlreg" method="post">
<div class="col-sm-7">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">

                    <div class="table-header">
                        Applicant List
                    </div>
                    <table id="simple-table" class="table table-striped table-bordered table-hover">

                        <script language="JavaScript">
                            function toggle(source) {
                                checkboxes = document.getElementsByName('checkAll[]');
                                for(var i=0, n=checkboxes.length;i<n;i++) {
                                    checkboxes[i].checked = source.checked;
                                }
                            }

                        </script>

                        <!--                                --><?php
                        //                                echo '<pre>';
                        //                                print_r($applicantlist);
                        //                                ?>


                        <thead>
                        <tr>
                            <th class="center">
                                Sl No.
                            </th>

                            <th><input type="checkbox"  name="checkall" onClick="toggle(this)" /><br> Select</th>

                            <th>Applicant Id</th>
                            <th>Applicant Name</th>
                            <th>Gender</th>
                            <th>Religion </th>
                            <th>Image</th>

                            <th style="width: 90px">Roll No</th>

                        </tr>
                        </thead>

                        <tbody>
                        <input type="hidden" name="programOfferId" value="<?php if (!empty($applicantlist[0]['programOfferId'])) { echo $applicantlist[0]['programOfferId'];} ?>">
                        <input type="hidden" name="programId" value="<?php if (!empty($applicantlist[0]['programId'])) { echo $applicantlist[0]['programId'];} ?>">
                        <?php
                        $sl = 1;
                        foreach ($applicantlist as $value) {
                            ?>

                            <tr>
                                <td class="center">
                                    <?php echo $sl; ?>
                                </td>
                                <td>

                                    <input type="hidden" id="app_<?php echo $sl;?>" value="<?php if (!empty($value['applicationId'])) { echo $value['applicationId'];} ?>">

                                    <?php
                                    $registrationStatus = getStudentByApplicationId($value['applicationId']);
                                    if (empty($registrationStatus)) {
                                        ?>

                                        <input class="chk" data-id="<?php echo $sl;?>" type="checkbox" name="checkAll[]" value="<?php echo $sl;?>">




                                    <?php
                                    } else {


                                        ?>
                                        <span class="label label-sm label-success">Registered</span>

                                    <?php

                                    }
                                    ?>

                                </td>
                                <td>
                                    <a target="_blank" href="<?php echo admin_Url(); ?>/applicant/viewappliantInfo/<?php echo $value['applicationId']; ?>">
                                        <?php
                                        if (!empty($value['applicationId'])) {
                                            echo $value['applicationId'];
                                        }
                                        ?>

                                    </a>
                                </td>

                                <td><?php if (!empty($value['firstName'])) {
                                        echo "<b>" . $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] . "</b>";
                                    } ?></td>
                                <td><?php if (!empty($value['gender'])) {
                                        echo element($value['gender'], getGendar(), Null);
                                    } ?></td>

                                <td><?php if (!empty($value['religion'])) {
                                        echo element($value['religion'], getReligion(), Null);
                                    } ?></td>


                                <td>
                                    <?php
                                    if ($value['photo']) {
                                        ?>
                                        <img  src="<?php if (file_exists($value['photo'])) {
                                            echo base_url() . $value['photo'];
                                        } else {
                                            echo base_url() . "uploads/default/default.png";
                                        } ?>" width="60" height="60">
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (empty($registrationStatus)) { ?>
                                        <input id="roll_<?php echo $sl;?>" disabled type="text" class="form-control">
                                    <?php
                                    }
                                    else
                                    {
                                        echo $value['roll_no'];
                                    }
                                    ?>
                                </td>

                                <!-- <td>
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <a class="blue" target="_blank" href="<?php echo admin_Url(); ?>/applicant/viewappliantInfo/<?php echo $value['applicationId']; ?>" title="View">
                                                        <i class="ace-icon fa fa-search bigger-130"></i>
                                                    </a>
                                                  

                                                </div>

                                                <div class="hidden-md hidden-lg">
                                                    <div class="inline pos-rel">
                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                    <span class="blue">
                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                           

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td> -->
                            </tr>
                            <?php
                            $sl++;
                        }

                        ?>

                        </tbody>
                    </table>
                </div>
            </div><!-- /.col-x12 -->
            <?php

            }
            ?>

        </div>
    </div>
</div>


<div class="col-sm-5">
    <div class="row">
        <div class="col-xs-12">

            <div class="row">
                <div class="col-xs-12">
                    <div class="table-header">
                        Course Information
                    </div>
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">
                                Sl No.
                            </th>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th>Subject Name</th>

                            <th>Subject Mark</th>
                            <th>Assign Teacher</th>
                            <th class="hidden-480">Subject Category</th>

                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        if ($courseassignlist) :
                            $i = 1;
                            foreach ($courseassignlist as $index=>$value) {
                                ?>
                                <tr>
                                    <td class="center">
                                        <?php echo $i++; ?>
                                    </td>
                                    <td class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" data-id="<?php echo $index+1;?>" checked='checked'  name="courseId[]" value="<?php echo $value['courseId'] ?>" class="ace course_chk" />

                                            <span class="lbl"></span>
                                        </label>
                                    </td>

                                    <td>
                                        <a href="#"><?php
                                            if (!empty($value['courseId'])) {
                                                echo getCourseName($value['courseId']);
                                            }
                                            ?></a>
                                    </td>

                                    <td class="hidden-480">
                                        <?php
                                        if (!empty($value['marks'])) {
                                            echo $value['marks'];
                                        }
                                        ?></td>
                                    <td class="hidden-480">
                                        <?php
                                        $techername = getTeacher($value['employeeId']);
                                        echo $techername['firstName'] . " " . $techername['lastName'];
                                        ?>
                                        <input type='hidden' id="em_id_<?php echo $index+1;?>" name='employeeId[]' value='<?php echo $value['employeeId']; ?>'>
                                    </td>
                                    <td class="hidden-480">
                                        <div class="hidden-480">

                                            <select id="cor_src_<?php echo $index+1;?>" name="courseStatus[]" required="1" class="form-control" id="form-field-select-1">

                                                <?php
                                                foreach (getSubjectcategory() as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $key; ?>"
                                                        <?php echo set_select("courseStatus[]", $key, FALSE); ?> >
                                                        <?php echo $value; ?>
                                                    </option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </td>
                                </tr>
                            <?php
                            } else :
                            ?>
                            <tr>
                                <td colspan="6">No Assign Course</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                                  <span class="col-sm-9 red"> 
                                        <strong class="col-sm-3"> Section: </strong>
                                        <select class="col-sm-9" data-placeholder="Select" name="data[sectionId]"  required="1" >
                                            <option value="">Select</option>
                                            <?php foreach (getSectionList() as $value) { ?>
                                                <option value="<?php echo $value['sectionId']; ?>" >
                                                    <?php echo $value['sectionName']; ?></option>
                                            <?php } ?>
                                        </select>                 
                                    </span>
                    <input type="hidden" value="<?php echo $enrollData['programLevel']; ?>" name="data[programLevel]">
                    <input type="hidden" value="<?php echo $enrollData['programId']; ?>" name="data[programId]">
                    <input type="hidden" value="<?php echo $enrollData['mediumId']; ?>" name="data[mediumId]">
                    <input type="hidden" value="<?php echo $enrollData['shiftId']; ?>" name="data[shiftId]">
                    <input type="hidden" value="<?php echo $enrollData['groupId']; ?>" name="data[groupId]">
                    <input type="hidden" value="<?php echo $enrollData['sessionId']; ?>" name="data[sessionId]">

                    <br><br><br>


                    <button class="btn btn-danger"  onclick="return checkConfirm('To Select Assigned Subject?');" name="confirmReg">
                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Submit To Registration & Assign Course
                    </button>


                </div>
            </div>
        </div>
    </div>

</div>
</form>
</div>
</div>


<script type="text/javascript">

    $(document).ready(function(){
        $(".chk").click(function(){
            var id = $(this).attr('data-id');
            if($(this).prop('checked'))
            {
                $('#app_'+id).attr('name','applicationId[]');
                $('#roll_'+id).attr('name','roll_no[]');
                $('#roll_'+id).prop('disabled', false);
            }
            else
            {
                $('#app_'+id).removeAttr('name');
                $('#roll_'+id).removeAttr('name');
                $('#roll_'+id).prop('disabled', true);
            }
        });

        $(".course_chk").click(function(){
            var id = $(this).attr('data-id');
            if($(this).prop('checked'))
            {
                $('#em_id_'+id).attr('name','employeeId[]');
                $('#cor_src_'+id).attr('name','courseStatus[]');
            }
            else
            {
                $('#em_id_'+id).removeAttr('name');
                $('#cor_src_'+id).removeAttr('name');
            }
        });

    });

</script>