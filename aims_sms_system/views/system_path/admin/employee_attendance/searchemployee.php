<!-- /.row -->

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
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-exchange green"></i>
                    Employee Attendence List
                </h3>

            </div>

        </div>


        <div class="row">
            <div class="modal-body no-padding">
                <div class="col-xs-12">
                    <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/employee/searchattendance" enctype="multipart/form-data" method="post">

                        <div class="col-xs-12 col-sm-12">
                            <!-- PAGE CONTENT BEGINS -->

                            <div class="  col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Employee ID : &nbsp; <?php echo form_error('data[employeeId]', '<span class="successMessage">', '</span>'); ?></label>
                                <input type="text" class="form-control" id="form-field-1" name="data[employeeId]"  value="<?php echo set_value("data[employeeId]"); ?>" placeholder="Employee ID" />
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>

                                <div class="input-group input-group-sm">
                                    <input class="form-control date-picker" id="id-date-picker-1" name="data[fromDate]" type="text" data-date-format="dd-mm-yyyy" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>

                                <div class="input-group input-group-sm">
                                    <input class="form-control date-picker" id="id-date-picker-1" name="data[toDate]" type="text" data-date-format="dd-mm-yyyy" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>


                        </div>

                        <div class="col-xs-12">
                            <div class="clearfix form-actions">
                                <div class="col-md-12">
                                    <button class="btn btn-success" name="search" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Search Employee Attendance Information
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>


                </div><!-- /.col-x12 -->
                <div class="widget-toolbar hidden-480" hidden="hidden">
                    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
                        <span class="btn btn-purple no-border">
                            <i class="ace-icon fa fa-print bigger-130"></i>
                            <span class="bigger-110">Print Attendance List</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <?php
                if (!empty($empinfo)) {
                ?>
                <div class="row">
                    <div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right">
                        <b>Employee Information</b>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8">

                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Employee Name:
                                <?php
                                echo "<b>" . ($empinfo['firstName'] . " " . $empinfo['middleName'] . " " . $empinfo['lastName']) . "</b>";
                                ?>
                            </li>


                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Designation:
                                <?php
                                echo "<b>" . element($empinfo['designation'], getdesignation(), null) . "</b>";
                                ?>
                            </li>

                        </ul>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        if (!empty($attendancelist)) {
        ?>

        <div id="printableArea">
            <div>
                <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                    <tr style=" font-family: cambria;">
                        <td style="text-align: center;">
                            <p style="margin-left:5px;">
                                <?php
                                $ins_info = getInstituteInfo();
                                ?>

                                <img style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">
                                <br>

                            <div style="font-size: 20px; font-size: 28px; color: royalblue;">
                                <b class="blue"><?php echo $institute_details[0]['instituteName'];?></b>
                            </div>
                            <div style="font-size: 20px; font-size: 18px; ">
                                <h5> <?php echo $institute_details[0]['town'] . ", " . $institute_details[0]['city'].", ".$institute_details[0]['disname'];?>
                                </h5>
                            </div>

                            </p>
                        </td>
                    </tr>
                    <tr> <td style="text-align: center; "> <h3 style="font-family: Algerian;" class="green">Employee Attendance </h3></td></tr>
                    <tr>
                        <td style="text-align: center;font-size: 16px; ">(<?php echo $fromDate." <span style='color:green;'>to</span> ".$toDate;?>)</td> </tr>

                </table>


                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center green">
                            Sl No.
                        </th>
                        <th class="green">ID</th>
                        <th class="green">Employee Name</th>
                        <th class="green">Date</th>
                        <!--<th class="green">Status</th>
                        <th class="green">Attendance Status</th>-->
                        <th class="green">In Time</th>
                        <th class="green">Out Time</th>
                        <th class="green">Hour</th>
                        <!--<th class="hidden-480 green">Absent reason</th>-->
                        <th class="green">Action</th>

                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $sl = 1;
                    foreach ($attendancelist as $value) {
                        //echo "<pre>";print_r($value['attendance_status']);die();
                        ?>

                        <tr>
                            <td class="center">
                                <?php echo $sl++; ?>
                            </td>
                            <td class="center">
                                <?php echo $value['emp_id']; ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($value['firstName'])) {
                                    echo ($value['firstName'] . " " . $value['lastName']);
                                }
                                ?>

                            </td>

                            <td>
                                <?php
                                if (!empty($value['attendance_date'])) {
                                    echo ($value['attendance_date']);
                                }
                                ?>

                            </td>

                            <!--<td>

                                <?php
                                $status = $value['attendance_status'];
                                // $getatdnc = getattendanceStatus($empatdc);
                                //echo "<pre>";print_r($getatdnc);die();
                                //                                        if (!empty($empatdc)) {
                                //
                                //                                            $status = $empatdc;
                                //                                           // echo $status;die();
                                //                                        } else {
                                //                                            $status = 0;
                                //                                        }
                                ?>
                                <?php
                                if ($status == 1) {
                                    ?>
                                    <span class="green" >
                                                <i class="ace-icon fa fa-check bigger-130"></i>
                                                Present
                                            </span>
                                    <?php
                                } elseif ($status == 2) {
                                    ?>
                                    <span class="red">
                                                <i class="ace-icon fa fa-times bigger-130"></i>
                                                Absent
                                            </span>
                                    <?php
                                } else {
                                    echo "";
                                }
                                ?>

                            </td>
                            <td>
                                <?php
                                if($value['attendance_status']>0)
                                {
                                    echo $value['attendance_type'];
                                }
                                else
                                {
                                    echo 'N/A';
                                }
                                ?>-->
                            </td>
                            <td>
                                <?php if(isset($value['in_time'])){echo $value['in_time'];}?>
                            </td>
                            <td>
                                <?php if(isset($value['out_time'])){echo $value['out_time'];}?>
                            </td>
                            <td>
                                <?php if(isset($value['seconds'])){echo gmdate("H:i:s", $value['seconds']);}?>
                            </td>
                            <!--<td class="hidden-480">
                                <?php
                                if(isset($value['attendance_reason']))
                                {
                                    if (!empty($value['attendance_reason'])) {
                                        //echo "<pre>";print_r($value['attendance_reason']);die();
                                        echo element($value['attendance_reason'], getAbsentReason(), Null);
                                    }
                                    else{
                                        echo "<p class='glyphicon glyphicon-remove'></p>";
                                    }
                                }
                                ?>-->
                            </td>
                            <td>

                                <?php
                                if(isset($value['emp_att_id']))
                                {
                                    ?>

                                    <div class="hidden-sm hidden-xs btn-group">

                                        <a href="<?php echo admin_Url(); ?>/employee/delete_attendance/<?php if(isset($value['emp_att_id'])){echo $value['emp_att_id'];}?>" class="btn btn-xs btn-danger">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </a>
                                    </div>



                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-danger dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="<?php echo admin_Url(); ?>/employee/delete_attendance/<?php if(isset($value['emp_att_id'])){echo $value['emp_att_id'];}?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                            <span class="red">
                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                            </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>

                            </td>

                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
<?php
}
?>
</div><!-- PAGE CONTENT ENDS -->







