<div class="main-content">
    <div class="main-content-inner">
<div class="page-header">

    <h1>
        Student Marks Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Subject Marks List
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">





<!--<div class="main-content">-->
<!--    <div class="main-content-inner">-->
<!--        <div class="page-content">-->
<!--            <div class="row">-->


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
    <?php if (!isset($markslist)) : ?>
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentmarks/insert_mark_list" method="post">
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
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getSubjectid"  data-placeholder="Select" name="data[courseId]"  class="form-control">

                        </select>
                    </div>

                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Exam &nbsp; <?php echo form_error('semesterId', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[semesterId]" required="1" class="form-control" id="form-field-select-1">
                            <option value="">Select</option>
                            <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('semesterId', $velues['semesterId'], FALSE) ?>><?php echo $velues['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="col-md-4 col-md-offset-4">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                                Search Student
                            </button>
                            <a href="<?php echo site_url() ?>systemaccess/studentmarks/insert_mark_list" class="btn btn-info"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>

                        </div>
                    </div>
                </div>
            </form>

        </div><!-- /.col-x12 -->
    <?php endif; ?>
    <?php if (isset($markslist) && $markslist) : ?>
    <div class="col-xs-12 col-sm-12">
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-large">
                    <h3 class="widget-title grey lighter">
                        <i class="ace-icon fa fa-exchange green"></i>
                        Insert Student Marks
                    </h3>



                    <div class="widget-toolbar hidden-480">
                        <i class="ace-icon fa fa-print"></i>
                        <a href="#" onclick="printDiv('printableArea')" role="button" class="green" > Print Marks Entry Form</a>


                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->
        </div>
        <div class="row">

            <div class="col-sm-7">
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
                                echo "<b>" . getSessionName($sessionId) . "</b>";
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                <?php
                                echo "<b>" . getProgramName($programId) . "</b>";
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Medium:
                                <?php
                                echo "<b>" . getmediumName($mediumId) . "</b>";
                                ?>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div>
                        <ul class="list-unstyled spaced">


                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Group:
                                <?php
                                echo "<b>" . getGroupName($groupId) . "</b>";
                                ?>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Section:
                                <?php
                                echo "<b>" . getsectionName($sectionId) . "</b>";
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Shift:
                                <?php
                                echo "<b>" . getshiftName($shiftId) . "</b>";
                                ?>
                            </li>

                        </ul>
                    </div>
                </div>
            </div><!-- /.col -->
            <div class="col-sm-4 ">
                <div class="row">
                    <div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right">
                        <b> Subject Information</b>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12">
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Subject:
                                <?php
                                echo "<b>" . getCourseName($courseId) . "</b>";
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Teacher Name:
                                <?php
                                $name = getTeacher($programOfferId['employeeId']);
                                echo "<b>" . $name['firstName'] . " " . $name['lastName'] . "</b>";
                                ?>
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Exam:
                                <?php
                                echo "<b>" . getSemesterName($semesterId) . "</b>";
                                ?>
                                &nbsp;
                                <!--<i class="ace-icon fa fa-caret-right blue"></i>Exam Type:
                                    <?php
                                //echo "<b>" . getExamTypeName($examtypeId) . "</b>";
                                ?>-->
                            </li>


                        </ul>
                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->
        <div class="col-md-12">
            <table id="simple-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <?php if ($dividemark) :
                        $mark_val = explode(",", trim($dividemark['divide_mark'], ","));
                        $mark_ttl = explode(",", trim($dividemark['mark_cat_id'], ","));
                        $count_markval = count($mark_val);
                        for ($mrk = 0; $mrk < $count_markval; $mrk++) :

                            $mark_val[$mrk];
                            $mrkttl = getMarkTitle($mark_ttl[$mrk]);
                            ?>
                            <th><?php echo $mrkttl . "-" . $mark_val[$mrk]; ?></th>
                        <?php endfor; ?>
                    <?php else : ?>
                        <th>Marks</th>
                    <?php endif; ?>
                    <th>Total</th>
                </tr>
                </thead>
                <?php if ($student_marks) :
                    $poid = $programOfferId['programOfferId'];
                    ?>
                    <tbody>
                    <?php foreach ($student_marks as $key => $val) :
                        $sum = 0;
                        ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $val->studentId; ?></td>
                            <td><?php echo $val->student_name;?></td>
                            <?php if ($dividemark) :
                                $mark_val = explode(",", trim($dividemark['divide_mark'], ","));
                                $divide_mark = explode(",", trim($val->divide_mark, ","));
                                $count_markval = count($mark_val);
                                for ($mrk = 0; $mrk < $count_markval; $mrk++) : ?>
                                    <td><?php

                                        if (isset($divide_mark[$mrk]) && $divide_mark[$mrk]) {
                                            echo $divide_mark[$mrk];
                                            $sum += $divide_mark[$mrk];
                                        } else {
                                            echo "0";
                                        }
                                        ?>

                                    </td>
                                <?php endfor; ?>
                            <?php else : ?>
                                <td>No Marks</td>
                            <?php endif; ?>
                            <td><?php echo $sum; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>
        <?php endif; ?>
    </div> <!-- /.row -->

            </div><!-- /.col-x12 -->

        </div> <!-- /.row -->
    </div><!-- /.col-x12 -->

</div> <!-- /.row -->
