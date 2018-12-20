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
                    <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/employee/employee_attendance" method="post">

                        <div class="col-xs-12 col-sm-12">
                            <!-- PAGE CONTENT BEGINS -->

                            <div class="  col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Employee ID : &nbsp; <?php echo form_error('employeeId', '<span class="successMessage">', '</span>'); ?></label>
                                <input type="text" class="form-control" id="form-field-1" name="employeeId"  value="<?php echo set_value("employeeId"); ?>" placeholder="Employee ID" />
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('fromDate', '<span class="successMessage">', '</span>'); ?></label>

                                <div class="input-group input-group-sm">
                                    <input class="form-control date-picker" id="id-date-picker-1" name="fromDate" type="text" data-date-format="dd-mm-yyyy" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('toDate', '<span class="successMessage">', '</span>'); ?></label>

                                <div class="input-group input-group-sm">
                                    <input class="form-control date-picker" id="id-date-picker-1" name="toDate" type="text" data-date-format="dd-mm-yyyy" />
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
        if (!empty($records)) {
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
                                <div style="font-size: 20px; font-size: 35px; color: royalblue;">
                                    <?php
                                    $ins_name = getInstituteInfo();
                                    echo $ins_name['instituteName'];
                                    ?>
                                </div>
                                <div style="line-height: 3px; font-size: 18px; color: #444;">
                                    <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?>
                                </div>

                                </p>

                            </td>

                        </tr>
                        <tr> <td style="text-align: center; "> <h3 style="font-family: Algerian;">Search Employee Attendance</h3> </td> </tr>
                        <?php if(isset($formDate) && isset($toDate)) : ?>
                            <tr><td style="text-align: center; ">Date From: <?php echo $formDate; ?> To:<?php echo $toDate; ?></td></tr>
                        <?php endif; ?>

                    </table>

                    <div class="table-header">
                        Attendance History Information
                    </div>
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Employee Name</th>
                            <th>Employee ID</th>
                            <th>Date</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        foreach ($records as $key =>$value) {
                            ?>

                            <tr>
                                <td class="center"><?php echo $key+1; ?></td>
                                <td><b>
                                        <?php
                                        if(isset($emp_name[trim($value->emp_id," ")]))
                                        {
                                            echo $emp_name[trim($value->emp_id," ")];

                                        }
                                        else
                                        {
                                            echo $value->emp_id;
                                        }
                                        ?></b>
                                </td>
                                <td><b><?php echo $value->emp_id; ?></b></td>
                                <td><?php echo $value->a_date; ?></td>
                                <td><?php echo $value->in_time;?></td>
                                <td><?php echo $value->out_time;?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <?php
        }
        ?>
    </div><!-- PAGE CONTENT ENDS -->







