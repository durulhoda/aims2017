<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
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
                    <form class="form-horizontal" role="form" action="<?php echo teacher_Url(); ?>/employee/searchattendance" enctype="multipart/form-data" method="post">

                        <div class="col-xs-12 col-sm-12">  
                            <!-- PAGE CONTENT BEGINS -->

                           <!--  <div class="  col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Employee ID : &nbsp; <?php echo form_error('data[employeeId]', '<span class="successMessage">', '</span>'); ?></label>
                                <input type="text" class="form-control" id="form-field-1" name="data[employeeId]"  value="<?php echo set_value("data[employeeId]"); ?>" placeholder="Employee ID" />
                            </div> -->
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

            </div>    
        </div>  
        <div class="row">
      <div class="col-sm-5">
                    <?php 
            if(!empty($empinfo)){
                
            
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
                                                           
                                                      
                                                       echo "<b>".($empinfo['firstName'] . " " . $empinfo['lastName'])."</b>";

                                              ?>
                                        </li>


                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Designation: 
                                            <?php 
                                                         
                                                       echo "<b>". element($empinfo['designation'], getdesignation(), null)."</b>";

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
            if(!empty($attendancelist)){
                
            
      ?>
         
        
        <div>
            <table id="simple-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            Sl No.
                        </th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Absent reason</th>


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
                                    if (!empty($value['firstName'])) {
                                        echo ($value['firstName']. " " . $value['lastName']);
                                    }
                                    ?>                                
                                </a>

                            </td>

                            <td>
                                <a href="#">
                                    <?php
                                    if (!empty($value['attendance_date'])) {
                                        echo ($value['attendance_date']);
                                    }
                                    ?>                                
                                </a>

                            </td>

                            <td>
                            
                             <?php
                               $empatdc= getattendanceStatus($value['attendance_status']);
                               
                                 if(!empty($empatdc)){
                                               
                                               $status= $value['attendance_status'];
                                           }
                                           else{
                                               $status=0;
                                           }
                                ?>
                                  <?php 
                                        if($status==1)
                                        {                                        
                                       ?>
                                            <a class="green" href="#" title="Present">
                                                    <i class="ace-icon fa fa-check bigger-130"></i>
                                                    Present
                                                </a>
                                        <?php
                                            }
                                            elseif($status==2)
                                            {
                                         ?>
                                        <a class="red" href="#" title="Absent">
                                                    <i class="ace-icon fa fa-times bigger-130"></i>
                                                    Absent
                                                </a>
                                          <?php
                                            }
                                            else{
                                               echo ""; 
                                            }
 
                                           ?>

                            </td>
                            <td>
                                <a href="#">
                                    <?php
                                    if (!empty($value['attendance_reason'])) {
                                        echo element($value['attendance_reason'],getAbsentReason(),Null);
                                    }
                                    ?>                                
                                </a>

                            </td>


                        </tr>
    <?php
}
?>

                </tbody>   
            </table>   

        </div>
        <?php 
            }
        ?>
    </div><!-- PAGE CONTENT ENDS -->
    </div>
</div>
        </div>










