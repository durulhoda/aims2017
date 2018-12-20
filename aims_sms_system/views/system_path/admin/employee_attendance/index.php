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
                            Employee Attendance Information
                        </h3>

                    </div>
            </div>  
           
            <?php
                if (!empty($employeelist)) {
            ?>
            
               
                <div class="table-header">
                    Employee List
              
                </div>
            
      <!-- div.dataTables_borderWrap -->
                <div>
                    <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/employee/insert_attendance" method="post">
                    
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        
                        <thead>
                            <tr>
                                <th class="hidden-480">SL</th>
                                <th>Select</th>
                                <th class="hidden-480">Employee Info</th>
                                <th class="hidden-480">Attendance</th>
                                <th class="hidden-480">Reason(If Absent)</th>
                              

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $sl=1;
                                    foreach ($employeelist as $value) {

                              ?>

                            <tr>      
                                <td class="hidden-480"> <?php   echo $sl;   ?></td>
                                <td>
                                    <input type="checkbox" name="serial[]" checked="yes" value="<?php echo $sl++; ?>">
                                    <input type="hidden" name="employeeId[]" value="<?php echo $value['employeeId']; ?>">
                                </td>
                              
                                <td>                                       
                                     <?php
                                            if (!empty($value['employeeId'])) {
                                                echo "ID: " . $value['employeeId'] . "<br><b>" . $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] . "</b>";
                                            }
                                            ?>          
                                </td>
                                <td>
                                            <select name="attendance_status[]">
                                                <?php foreach (getattendanceStatus() as $key => $vals) { ?>
                                                    <option value="<?php echo $key; ?>" 
                                                            <?php echo set_select('attendance_status', $key, FALSE) ?> >
                                                        <?php echo $vals; ?></option>                                                
                                                <?php } ?>
                                            </select>
                                                 
                                </td>
                                <td>
                                            <select name="attendance_reason[]">
                                                <option value="0">Select Absent Reason</option>
                                                <?php foreach (getAbsentReason() as $key => $vals) { ?>
                                                    <option value="<?php echo $key; ?>" 
                                                            <?php echo set_select('attendance_reason', $key, FALSE) ?> >
                                                        <?php echo $vals; ?></option>                                                
                                                <?php } ?>
                                            </select>
                                                 
                                </td>

                                
                            </tr>
                               <?php
                                      }
                                ?>

                         </tbody>   
                      </table>
                      <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <input class="form-control date-picker" placeholder="Select Date" id="id-date-picker-1" required="" name="attendance_date" type="text" data-date-format="dd-mm-yyyy" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                        <button class="btn btn-danger" type="submit" name="btnSubmit" onclick="return checkSelect();">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Insert Attendance
                            </button>
                        </form>
                    </div>
            
               
                    
                 <?php
                    }
                ?>
       
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 