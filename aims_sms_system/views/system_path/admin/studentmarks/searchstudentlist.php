<div class="row" id="printableArea">
    <?php

    $message = $this->session->userdata('message');
    if (isset($message)) {
        ?>
        <div id="printpagebutton2" class="alert alert-block alert-success">
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
        <div id="printpagebutton1" class="alert alert-block alert-danger">
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
    if (!empty($studentlist)) {
    ?>
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box transparent">
            <div id="printpagebutton" class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-exchange green"></i>
                    Insert Student Marks
                </h3>



                <div class="widget-toolbar hidden-480">
                    <i class="ace-icon fa fa-print"></i>
                    <a href="#" onclick="another_printDiv('printableArea')" role="button" class="green" > Print Marks Entry Form</a>


                </div>
                <!--<div class="widget-toolbar hidden-480">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                    <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Again </a>

                </div>-->
            </div>
            <div id="modal-table" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header no-padding">
                            <div class="table-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <span class="white">&times;</span>
                                </button>
                                Search Again By Enrollment Information
                            </div>
                        </div>

                        <div class="modal-body no-padding">

                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentmarks/searchstudentlist" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <!-- PAGE CONTENT BEGINS -->
                                        <div class=" col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select id="getsessionid" onchange="return getOfferedSession_classId();" data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                                <option value="">Select</option>
                                                <?php foreach (getOfferedSession() as $value) { ?>
                                                    <option value="<?php echo $value['sessionId']; ?>">
                                                        <?php echo $value['session']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class=" col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select id="getprogramid" onchange="return getOfferedprogramId();" name="data[programId]" required="1" class="form-control">

                                            </select>
                                        </div>
                                        <div class=" col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select id="getmediumid" onchange="return getOfferedmediumId();" name="data[mediumId]" required="1" class="form-control">

                                            </select>
                                        </div>
                                        <div class=" col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select id="getshiftid" onchange="return getOfferedshiftId();" name="data[shiftId]" required="1" class="form-control" >

                                            </select>
                                        </div>
                                        <div class="col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select id="getgroupid" onchange="return getOfferedgroupId();" name="data[groupId]" required="1" class="form-control">

                                            </select>
                                        </div>
                                        <div class="col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                                            </select>
                                        </div>
                                        <div class="col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select id="getsessionid"  data-placeholder="Select" name="data[courseId]"  class="form-control">
                                                <option value="">Select</option>
                                                <?php foreach (getOfferedCourseInfoArray() as $value) { ?>
                                                    <option value="<?php echo $value['courseId']; ?>"
                                                        <?php echo set_select('data[courseId]', $value['courseId'], FALSE) ?> >
                                                        <?php echo $value['courseName']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>


                                    <div class="col-xs-12">
                                        <div class="clearfix form-actions">
                                            <div class="col-md-12">
                                                <button class="btn btn-success" name="search" type="submit">
                                                    <i class="ace-icon fa fa-search bigger-120"></i>
                                                    Search Student
                                                </button>
                                                <button class="btn btn-purple" name="print" type="submit">
                                                    <i class="ace-icon fa fa-print bigger-120"></i>
                                                    Print Marks Entry List
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS -->

















        <!--  NEW COde -->


        <div class="row">

            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="center">
                        <img alt="<?php echo $institute_info->institute_name; ?>" id="avatar3" src="<?php echo ($institute_info->logo) ? base_url().$institute_info->logo : base_url()."all_upload/default/aims.png"; ?>" width="50">
                        <h3>
                            <p class="user"> &nbsp; <?php echo $institute_info->institute_name; ?></p>
                        </h3>
                        <div class="time">
                            &nbsp;
                            <span class="editable" id="country"> <?php echo $institute_info->address; ?></span><br>
                            <h4> Student Mark Entry Form </h4>
                        </div>
                    </div>
                    <!-- <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                            <tr style=" font-family: cambria;">
                                <td style="text-align: center;">
                                    <p style="margin-left:5px;">
                                        <?php
                    $ins_info = getInstituteInfo();
                    ?>


                                    <div style="font-size: 20px; font-size: 27px; color: royalblue;">
                                        <img src="<?php echo base_Url() . $ins_info['logo'] ?>" height="50">
                                        <?php echo $institute_info->institute_name; ?>
                                    </div>
                                    <div style="line-height: 3px; font-size: 22px; color: #444;">
                                    <?php echo $institute_info->address; ?>
                                    </div>
                                    <div class="center">
                                        <h4>Student Mark</h4>
                                    </div>
                                    </p>

                                </td>

                            </tr>


                        </table> -->

                </div>
            </div>

            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <!-- <div class="col-xs-12 label label-lg label-success arrowed-in arrowed-right"> -->
                    <div class="col-xs-12">
                        <ul class="list-unstyled" style="text-align: center;">
                            <li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Session:
                                <?php
                                echo "<b>" . getSessionName($sessionId) . "</b>";
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                <?php
                                echo "<b>" . getProgramName($programId) . "</b>";
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Medium:
                                <?php
                                echo "<b>" . getmediumName($mediumId) . "</b>";
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Shift:
                                <?php
                                echo "<b>" . getshiftName($shiftId) . "</b>";
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Group:
                                <?php
                                echo "<b>" . getGroupName($groupId) . "</b>";
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Section:
                                <?php
                                echo "<b>" . getsectionName($sectionId) . "</b>";
                                ?>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>


            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-unstyled" style="text-align: center;">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Subject:
                                <?php
                                echo "<b>" . getCourseName($courseId) . "</b>";
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Teacher:
                                <?php
                                $name = getTeacher($employeeId);
                                echo "<b>" . $name['firstName'] . " " . $name['lastName'] . "</b>";
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="ace-icon fa fa-caret-right blue"></i>Exam:
                                <?php
                                echo "<b>" . getSemesterName($semesterId) . "</b>";
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>   <!-- /.col -->


        </div>



        <!--  NEW COde -->








        <!-- /.row -->
    </div>

    <!-- div.table-responsive -->

    <!-- div.dataTables_borderWrap -->
    <form id="frm1" action="<?php echo admin_Url() ?>/studentmarks/savemarks" method="post">
        <div class="col-xs-12 col-sm-12">
            <!-- PAGE CONTENT BEGINS -->

            <input type="hidden"  name="semesterId" value="<?php echo $semesterId; ?>">
            <!--<input type="hidden"  name="examtypeId" value="<?php// echo $examtypeId; ?>">-->

            <input type="hidden"  name="courseId" value="<?php echo $courseId; ?>">
            <input type="hidden"  name="programOfferId" value="<?php echo $programOfferId['programOfferId']; ?>">
            <input type="hidden"  name="employeeId" value="<?php echo $employeeId; ?>">
        </div>
        <div>
            <table id="simple-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>
                        <!-- <input type="checkbox" name="checkall" onclick="checkedAll()"/>-->
                        Select
                    </th>
                    <th class="hidden-480 center">
                        Sl No.
                    </th>

                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>Roll No</th>
                    <?php
                    if (!empty($dividemark)) {

                        $mark_val = explode(",", trim($dividemark['divide_mark'], ","));

                        $mark_ttl = explode(",", trim($dividemark['mark_cat_id'], ","));
                        $count_markval = count($mark_val);

                        for ($mrk = 0; $mrk < $count_markval; $mrk++) {
                            $mark_val[$mrk];
                            $mrkttl = getMarkTitle($mark_ttl[$mrk]);
                            ?>
                            <th><?php echo $mrkttl . "-" . $mark_val[$mrk]; ?></th>
                            <?php
                        }
                    } else {
                        ?>
                        <th>Marks</th>


                        <?php
                    }
                    ?>
                    <!--<th>Total Marks</th>-->
                </tr>
                </thead>

                <tbody>
                <?php
                $sl = 1;

                foreach ($studentlist as $value) {
                    if (in_array($courseId, explode(',', trim($value['courseId'])))) {
                        ?>

                        <tr class="main_child">

                            <td>

                                <?php
                                $subOffercheck = tt($courseId, $programOfferId, $semesterId,/* $examtypeId,*/ $value['studentId']);

                                if (empty($subOffercheck)) {
                                    ?>

                                    <input tabindex="-1" type="checkbox" checked="yes" name="chk_serial[]" value="<?php echo $sl; ?>">


                                    <?php
                                } else {
                                    echo "<span class=\"label label-sm label-denger\"><i class=\"ace-icon fa fa-check-square-o\"></i>Already Done</span>";
                                }
                                ?>

                            </td>
                            <td class="hidden-480 center">
                                <?php echo $sl; ?>
                            </td>

                            <td>
                                <?php
                                if (!empty($value['studentId'])) {
                                    echo $value['studentId'];
                                }
                                ?>

                                <input type="hidden" name="studentId[]" value="<?php echo $value['studentId']; ?>">
                            </td>

                            <td><?php
                                if (!empty($value['firstName'])) {
                                    echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'];
                                }
                                ?></td>
                            <td><?php echo isset($student_roll[$value['studentId']]) ? $student_roll[$value['studentId']] : ''; ?></td>


                            <?php
                            if (!empty($dividemark)) {

                                $mark_val = explode(",", trim($dividemark['divide_mark'], ","));

                                $mark_ttl = explode(",", trim($dividemark['mark_cat_id'], ","));
                                $count_markval = count($mark_val);
                                $nb = 0;
                                for ($mrk = 0; $mrk < $count_markval; $mrk++) {
                                    $mark_val[$mrk];
                                    $mrkttl = getMarkTitle($mark_ttl[$mrk]);
                                    ?>

                                    <td >
                                        <input type="number"  name="other_marks[]" min="0" max="<?php echo $mark_val[$mrk]; ?>" value="" class="calField su" id="su<?php echo $mrk; ?>"
                                    </td>

                                    <?php
                                    ++$nb;
                                }
                            } else {
                                ?>
                                <td>
                                    <input type="text" name="other_marks[]" placeholder="Obtain Mark" onblur="findTotal()" value="<?php echo set_value('other_marks'); ?>" class="form-control" id="form-field-1">

                                </td>

                                <?php
                            }
                            ?>

                            <!-- <td >


                                        <input type="text" name="calculation" class="calField calculation su<?php// echo $mrk; ?>" id="su<?php// echo $mrk; ?>" value="0">

                                    </td>-->

                        </tr>
                        <?php
                        $sl++;
                    }
                }
                if (!empty($count_markval)) {
                    $count_mark_input = $count_markval;
                } else {
                    $count_mark_input = 1;
                }
                ?>

                <input type="hidden" name="count_input" value="<?php echo $count_mark_input; ?>" class="form-control" id="form-field-1">
                </tbody>
            </table>
            <div id="printButton1" class="form-group col-xs-12 col-sm-4">
                <label class="control-label" for="form-field-1">&nbsp;</label>
                <div  id="form-field-select-1" >
                    <button class="btn btn-danger" onclick="return checkConfirm('Student Marks, Semester & Exam Information ?');" name="btnSubmit" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i> Insert Marks
                    </button>
                </div>
            </div>
        </div>
    </form>
</div><!-- /.col-x12 -->
<?php
}
?>
</div> <!-- /.row -->


<script type="text/javascript">
    $(document).ready(function () {

        $(document).on("blur", ".calField", function () {
            var obj = $(this);
            var id = $(obj).attr('id');
            var su = Number($(obj).closest(".main_child").find("#" + id).val());
            calculationHere(obj, su);
        });

        function calculationHere(obj, su) {
            var cal = Number($(obj).closest(".main_child").find('.calculation').val());
            //alert(su+"-"+cal);
            var obu = cal + su;
            Number($(obj).closest(".main_child").find('.calculation').val(obu));
        }
    });
</script>












