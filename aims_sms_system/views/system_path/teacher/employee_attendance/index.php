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
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="hidden-480">Image</th>
                                <th class="hidden-480">Employee Info</th>
                                <th class="hidden-480">Contact</th>
                                <th class="hidden-480">Department/Designation</th>
                                <th class="hidden-480">Emp. Type/Job Status</th>
                                <th class="hidden-480">Attendance</th>
                                


                                <th>
                                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                    Attendance Status
                                </th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $sl=1;
                                    foreach ($employeelist as $value) {

                              ?>

                            <tr>       
                                <td class="hidden-480">
                                            <?php
                                                    if ($value['photo']) {
                                                ?>
                                                <img  src="<?php if (file_exists($value['photo'])) { echo base_url() . $value['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
                                            <?php 

                                                } 
                                              ?>
                                </td>
                                <td>                                       
                                     <?php
                                            if (!empty($value['employeeId'])) {
                                                echo "ID: " . $value['employeeId'] . "<br><span class=\"label label-sm label-warning\">Name: " . $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] . "</span>";
                                            }
                                            ?>          
                                </td>
                                <td><?php 
                                        if (!empty($value['phone'])) { echo "<b>Phone: ".($value['phone'])."</b><br>"; }
                                        if (!empty($value['email'])) { echo "Email: ".($value['email']); }
                                    ?>
                                </td>

                                <td><?php 
                                        if (!empty($value['departmentId'])) { echo "<b>Department: ".element($value['departmentId'],getDepartmentInfoArray(),Null)."</b><br>"; }
                                        if (!empty($value['designation'])) { echo "Designation: ".element($value['designation'],getDesignationArray(),Null); }
                                    ?>
                                </td>
                                <td><?php 
                                        if (!empty($value['employeeType'])) { echo "<b>Emp. Type: ".element($value['employeeType'],getmployeetypeList(),Null)."</b><br>"; }
                                        if (!empty($value['employmentStatus'])) { echo "Job Status: ".element($value['employmentStatus'],getemployeestatusList(),Null); }
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="attendanceinsert/<?php echo $value['employeeId']."/Present" ?>">
                                        Present
                                     </a>
                                    <a class="btn btn-danger" href="attendanceinsert/<?php echo $value['employeeId']."/Absent" ?>">
                                                Absent
                                            </a>
                                </td>


                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="blue" href="#" title="View">
                                            <i class="ace-icon fa fa-search bigger-130"></i>
                                        </a>
                                        <?php 
                                           $today=date("Y-m-d");
                                           
                                           $todayattendance = gettodayattendance($today, $value['employeeId']);
                                           
                                           if(!empty($todayattendance)){
                                               
                                               $status= $todayattendance['attendaceStatus'];
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
                                                </a>
                                        <?php
                                            }
                                            elseif($status==2)
                                            {
                                         ?>
                                        <a class="red" href="#" title="Absent">
                                                    <i class="ace-icon fa fa-times bigger-130"></i>
                                                </a>
                                          <?php
                                            }
                                            else{
                                               echo ""; 
                                            }
 
                                           ?>
                                                
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
                                                 <?php 
                                                    if($status==1)
                                                    {                                        
                                                   ?>
                                                <li>
                                                    <a class="green" href="#" title="Present">
                                                        <i class="ace-icon fa fa-check bigger-130"></i>
                                                    </a>
                                                </li>
                                                <?php
                                                    }
                                                    elseif($status==2)
                                                    {
                                                 ?>
                                                
                                                <li>
                                                    <a class="red" href="#" title="Absent">
                                                        <i class="ace-icon fa fa-times bigger-130"></i>
                                                    </a>
                                                </li>
                                                <?php
                                                    }
                                                    else{
                                                       echo ""; 
                                                    }

                                                   ?>
                                                
                                                  
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
            
               
                    
                 <?php
                    }
                ?>
       
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 