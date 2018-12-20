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
                    Student Attendence List
                </h3>

            </div>
        </div>
        <div class="widget-box transparent ">
            <div class="widget-header widget-header-large">
                <div class="widget-toolbar pull-left">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                    <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Search Attendance By Individual Student </a>

                </div>
                <div class="widget-toolbar pull-left">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                    <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Attendance By Class Information </a>

                </div>
                
                <div class="widget-toolbar pull-left">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer green"></i>
                    <a href="#modal-table-institute" role="button" class="green" data-toggle="modal"> Search Attendance By Institute </a>

                </div>
                
                <div class="widget-toolbar pull-left">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                    <a href="#modal-table-status" role="button" class="blue" data-toggle="modal"> Search By Attendance Status</a>

                </div>

                <div class="widget-toolbar hidden-480">
                    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
                        <span class="btn btn-purple no-border">
                            <i class="ace-icon fa fa-print bigger-130"></i>
                            <span class="bigger-110">Print Attendance List</span>
                        </span>
                    </button>

                </div>        
            </div>

        </div>

        <div id="modal-table_student" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            Search Attendance By Individual Student
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-body no-padding">
                            <div class="col-xs-12">
                                <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentsattendance/searchattendanceinfo" enctype="multipart/form-data" method="post">

                                    <div class="col-xs-12 col-sm-12">  
                                        <!-- PAGE CONTENT BEGINS -->

                                        <div class="  col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Student ID : &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                            <input type="text" class="form-control" id="form-field-1" name="data[studentId]"  value="<?php echo set_value("data[studentId]"); ?>" placeholder="Student ID" />
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
                                                    <i class="ace-icon fa fa-check bigger-110"></i> Search Student Attendance Information
                                                </button>

                                            </div>
                                        </div>
                                    </div>        
                                </form>


                            </div><!-- /.col-x12 -->

                        </div>    
                    </div>       
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS, SEARCH BY STUDENT ID -->
        
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
                    <div class="row">
                        <div class="modal-body no-padding">

                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentsattendance/searchattendancebyclass" method="post">
                                <div class="col-xs-12 col-sm-12">  
                                    <!-- PAGE CONTENT BEGINS -->
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getsessionid" onchange="return getOfferedSessionId();" data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach (getOfferedSession() as $value) { ?>
                                                <option value="<?php echo $value['sessionId']; ?>" >
                                                    <?php echo $value['session']; ?></option>                                                
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
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
                                    <div class="col-sm-4">
                                        <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>

                                        <div class="input-group input-group-sm">
                                            <input class="form-control date-picker" name="data[fromDate]" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar bigger-110"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>

                                        <div class="input-group input-group-sm">
                                            <input class="form-control date-picker" name="data[toDate]"  id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
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
                                                <i class="ace-icon fa fa-search bigger-120"></i>
                                                Search Student Attendance
                                            </button>

                                        </div>
                                    </div>
                                </div>        
                            </form>

                        </div>    
                    </div>       
                </div><!-- /.modal-content -->



            </div><!-- /.modal-dialog -->

        </div><!-- PAGE CONTENT ENDS, SEARCH BY CLASS  -->
        
        <div id="modal-table-institute" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            Search Attendance By Individual Student
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-body no-padding">
                            <div class="col-xs-12">
                                <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentsattendance/searchattendancebyinstitute" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->                                       
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>

                        <div class="input-group input-group-sm">
                            <input class="form-control date-picker" name="data[fromDate]" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>

                        <div class="input-group input-group-sm">
                            <input class="form-control date-picker" name="data[toDate]"  id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
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
                                <i class="ace-icon fa fa-search bigger-120"></i>
                                Search Student Attendance by Institiute
                            </button>

                        </div>
                    </div>
                </div>        
            </form> 

                            </div><!-- /.col-x12 -->

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS, SEARCH BY INSTITUTE -->
        
        <div id="modal-table-status" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            Search Attendance By Individual Student
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-body no-padding">
                            <div class="col-xs-12">
                                <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentsattendance/searchbyattendancestatus" method="post">
                                    <div class="col-xs-12 col-sm-12">
                                        <!-- PAGE CONTENT BEGINS -->
                                        <div class="  col-xs-10 col-sm-4">
                                            <label class="control-label" for="form-field-1">Attendance Status :  &nbsp; <?php echo form_error('data[attendanceStatus]', '<span class="successMessage">', '</span>'); ?></label>
                                            <select name="data[attendanceStatus]" class="form-control" id="form-field-select-1">
                                                <?php foreach (getattendanceStatus() as $key => $value) { ?>
                                                    <option value="<?php echo $key; ?>"<?php echo set_select('attendanceStatus', $key, FALSE) ?> >
                                                        <?php echo $value; ?></option>                                                
                                                <?php } ?>
                                            </select>
                                        </div>                                             
                                        <div class="col-sm-4">
                                            <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>

                                            <div class="input-group input-group-sm">
                                                <input class="form-control date-picker" name="data[fromDate]" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>

                                            <div class="input-group input-group-sm">
                                                <input class="form-control date-picker" name="data[toDate]"  id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
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
                                                    <i class="ace-icon fa fa-search bigger-120"></i>
                                                    Search Student By Attendance Status
                                                </button>

                                            </div>
                                        </div>
                                    </div>        
                                </form>  
                            </div><!-- /.col-x12 -->

                        </div>    
                    </div>       
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS, SEARCH BY STATUS -->

        <div>
            <?php
            if (!empty($attendancelist)) {
                ?>
                <!--- Printable Hidden area and this will work when print--->
                <div id="printableArea" hidden="hidden">
                    <div style="margin: 10px auto;  width: 850px; border: 0px solid #cccccc; " >
                        <div style=" border: 1px solid #d9d9d9;">

                            <!-- div.dataTables_borderWrap -->
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
                                    <tr> <td style="text-align: center; "> <h3 style="font-family: Algerian;">Search Attendance By Institute</h3> </td> </tr>

                                </table>
                                <div class="table-header">
                                    Attendance History Information
                                </div>
                                <table id="simple-table" class="table table-striped table-bordered table-hover">

                                    <thead>
                                        <tr>
                                            <th class="center">
                                                Sl No.
                                            </th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sl = 1;
                                        foreach ($attendancelist as $value) {
                                            ?>

                                            <tr>
                                                <td class="center">
                                                    <?php echo $sl++; ?>
                                                </td>

                                                <td>
                                                    <a href="#">
                                                        <?php
                                                        if (!empty($value['studentId'])) {
                                                            echo ($value['studentId']);
                                                        }
                                                        ?>                                
                                                    </a>

                                                </td>

                                                <td>
                                                    <?php
                                                    if (!empty($value['firstName'])) {
                                                        echo ($value['firstName']);
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <a href="#">
                                                        <?php
                                                        if (!empty($value['attendanceDate'])) {
                                                            echo ($value['attendanceDate']);
                                                        }
                                                        ?>                                
                                                    </a>

                                                </td>

                                                <td>
                                                    <?php
                                                    $empatdc = getattendanceStatus($value['attendanceStatus']);

                                                    if (!empty($empatdc)) {

                                                        $status = $value['attendanceStatus'];
                                                    } else {
                                                        $status = 0;
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($status == 1) {
                                                        ?>
                                                        <a class="green" href="#" title="Present">
                                                            <i class="ace-icon fa fa-check bigger-130"></i>
                                                            Present
                                                        </a>
                                                        <?php
                                                    } elseif ($status == 2) {
                                                        ?>
                                                        <a class="red" href="#" title="Absent">
                                                            <i class="ace-icon fa fa-times bigger-130"></i>
                                                            Absent
                                                        </a>
                                                        <?php
                                                    } else {
                                                        echo "";
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
                        <?php
                    }
                    ?>
                </div><!-- /.col-x12 -->
            </div> <!-- /.row --> 
        </div>

        <div>
            <?php
            if (!empty($attendancelist)) {
                ?>
                <div>
                    <div style="margin: 10px auto;  width: 850px; border: 0px solid #cccccc; " >
                        <div style=" border: 1px solid #d9d9d9;">

                            <!-- div.dataTables_borderWrap -->
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
                                    <tr> <td style="text-align: center; "> <h3 style="font-family: Algerian;">Search Attendance By Institute</h3> </td> </tr>

                                </table>
                                <div class="table-header">
                                    Attendance History Information
                                </div>
                                <table id="simple-table" class="table table-striped table-bordered table-hover">

                                    <thead>
                                        <tr>
                                            <th class="center">
                                                Sl No.
                                            </th>

                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sl = 1;
                                        foreach ($attendancelist as $value) {
                                            ?>

                                            <tr>
                                                <td class="center">
                                                    <?php echo $sl++; ?>
                                                </td>

                                                <td>
                                                    <a href="#">
                                                        <?php
                                                        if (!empty($value['studentId'])) {
                                                            echo ($value['studentId']);
                                                        }
                                                        ?>                                
                                                    </a>

                                                </td>

                                                <td>
                                                    <?php
                                                    if (!empty($value['firstName'])) {
                                                        echo ($value['firstName']);
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <a href="#">
                                                        <?php
                                                        if (!empty($value['attendanceDate'])) {
                                                            echo ($value['attendanceDate']);
                                                        }
                                                        ?>                                
                                                    </a>

                                                </td>

                                                <td>
                                                    <?php
                                                    $empatdc = getattendanceStatus($value['attendanceStatus']);

                                                    if (!empty($empatdc)) {

                                                        $status = $value['attendanceStatus'];
                                                    } else {
                                                        $status = 0;
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($status == 1) {
                                                        ?>
                                                        <a class="green" href="#" title="Present">
                                                            <i class="ace-icon fa fa-check bigger-130"></i>
                                                            Present
                                                        </a>
                                                        <?php
                                                    } elseif ($status == 2) {
                                                        ?>
                                                        <a class="red" href="#" title="Absent">
                                                            <i class="ace-icon fa fa-times bigger-130"></i>
                                                            Absent
                                                        </a>
                                                        <?php
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <div class="hidden-sm hidden-xs btn-group">

                                                        <a href="<?php echo admin_Url(); ?>/studentsattendance/delete_attendance/<?php echo $value['attendanceId']; ?>" class="btn btn-xs btn-danger">
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
                                                                    <a href="<?php echo admin_Url(); ?>/studentsattendance/delete_attendance/<?php echo $value['attendanceId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                        <span class="red">
                                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
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
                        </div>

                        <?php
                    }
                    ?>
                </div><!-- /.col-x12 -->
            </div> <!-- /.row --> 
        </div>

        <div/>



