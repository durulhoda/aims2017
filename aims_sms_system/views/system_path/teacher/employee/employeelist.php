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
                if (!empty($employeelist)) {
            ?>
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                            Employee Information
                        </h3>

                        <div class="widget-toolbar hidden-480">
                          
                            <button class="btn btn-white btn-info " onclick="printDiv('printableArea')">
                                <i class="ace-icon fa fa-print bigger-120 blue"></i>
                                Print Employee List                                
                            </button>      
                            
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
                                        Search Again Employee List By Employment Information
                                    </div>
                                </div>
                                
                                    <div class="modal-body no-padding">
                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/employee/employeesearch" method="post">

                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-12 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Department &nbsp; <?php echo form_error('data[departmentId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select name="data[departmentId]" class="form-control" id="form-field-select-1">
                                                            <option value="">Select</option>
                                                            <?php
                                                            foreach (getDepartmentInfoArray() as $value) {
                                                                ?>
                                                                <option value="<?php echo $value['departmentId']; ?>" 
                                                                        <?php echo set_select("data[departmentId]", $key, FALSE); ?> >
                                                                        <?php echo $value['departmentName']; ?>
                                                                </option> 

                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Designation &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select name="data[designation]" class="form-control" id="form-field-select-1">
                                                            <option value="">Select</option>
                                                            <?php
                                                            foreach (getDesignationArray() as $value) {
                                                                $position = $value['candidate'] - CountEmployeeByPosition($value['designation']);
                                                                if ($value['candidate'] >= $position) {
                                                                    ?>
                                                                    <option value="<?php echo $value['designation']; ?>" 
                                                                    <?php echo set_select("data[designation]", $value['designation'], FALSE); ?> >
                                                                            <?php echo element($value['designation'],getdesignation(),NULL); ?>
                                                                    </option> 

            <?php
        }
    }
    ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Employee Type &nbsp; <?php echo form_error('data[employeeType]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select name="data[employeeType]" class="form-control" id="form-field-select-1">
                                                            <option value="">Select</option>
    <?php
    foreach (getmployeetypeList() as $key => $value) {
        ?>
                                                                <option value="<?php echo $key; ?>" 
                                                                <?php echo set_select("data[employeeType]", $key, FALSE); ?> >
                                                                <?php echo $value; ?>
                                                                </option> 

                                                                            <?php
                                                                        }
                                                                        ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Employment Status &nbsp; <?php echo form_error('data[employmentStatus]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select name="data[employmentStatus]" class="form-control" id="form-field-select-1">
                                                            <option value="">Select Status</option>
    <?php
    foreach (getemployeestatusList() as $key => $value) {
        ?>
                                                                <option value="<?php echo $key; ?>" 
                                                                <?php echo set_select("data[employmentStatus]", $key, FALSE); ?> >
                                                                <?php echo $value; ?>
                                                                </option> 

                                                                        <?php
                                                                        }
                                                                        ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Employee Status &nbsp; <?php echo form_error('data[employeeStatus]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select name="data[employeeStatus]" class="form-control" id="form-field-select-1">
                                                            <option value="">Select Status</option>
    <?php
    foreach (getEmployeeStatus() as $key => $value) {
        ?>
                                                                <option value="<?php echo $key; ?>" 
                                                                <?php echo set_select("data[employeeStatus]", $key, FALSE); ?> >
                                                                <?php echo $value; ?>
                                                                </option> 

                                                                        <?php
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Employee Id &nbsp; <?php echo form_error('data[employeeId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <input  type="text" name="data[employeeId]" value="<?php echo set_value("data[employeeId]"); ?>" class="form-control" id="form-field-1" placeholder="EmployeeId" />
                                                    </div>  

                                         </div>   
                                            
                                            
                                            
                                            <div class="modal-footer no-margin-top">
                                                <div class="space"></div>
                                                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                                                    <i class="ace-icon fa fa-times"></i>
                                                    Close
                                                </button>
                                                <button class="btn btn-success pull-right" name="search" type="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i> Search Employee Information
                                                </button>
                                            </div>
                                        </form> 
                                    </div>

                                    
                                    
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                
            </div>    
            <div class="table-header">
                Employee List
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="hidden-480">Employee Info</th>
                            <th class="hidden-480">Contact</th>
                            <th class="hidden-480">Department/Designation</th>
                            <th class="hidden-480">Emp. Type/Job Status</th>
                            <th class="hidden-480">Current Status</th>
                            <th class="hidden-480">Image</th>

                            <th>
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Action
                            </th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $sl=1;
                                foreach ($employeelist as $value) {
                                        
                          ?>
                      
                        <tr>                           
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
                                    if (!empty($value['designation'])) { echo "Designation: ".element($value['designation'],getdesignation(),Null); }
                                ?>
                            </td>
                            <td><?php 
                                    if (!empty($value['employeeType'])) { echo "<b>Emp. Type: ".element($value['employeeType'],getmployeetypeList(),Null)."</b><br>"; }
                                    if (!empty($value['employmentStatus'])) { echo "Job Status: ".element($value['employmentStatus'],getemployeestatusList(),Null); }
                                ?>
                            </td>
                            <td><?php 
                                    if (!empty($value['employeeStatus'])) { echo element($value['employeeStatus'],getEmployeeStatus(),Null)."<br>"; }
                                    
                                ?>
                            </td>
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
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="blue" href="#" title="View">
                                        <i class="ace-icon fa fa-search bigger-130"></i>
                                    </a>

                                    <a class="green" href="<?php echo admin_Url();?>/employee/editEmployee/<?php echo  $value['employeeId'];?>" title="Edit">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" href="<?php echo admin_Url();?>/employee/Deleteemployee/<?php echo  $value['employeeId'];?>" title="Delete">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
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

                                            <li>
                                                <a href="<?php echo admin_Url();?>/employee/editEmployee/<?php echo  $value['employeeId'];?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo admin_Url();?>/employee/Deleteemployee/<?php echo  $value['employeeId'];?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
            
            
            <!--------------Print Employee List Information-------------->
            
                <div id="printableArea" class="hidden-md hidden-lg">
                    <div class="row">
                        
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="row">
                                <div class="table-header center arrowed-in arrowed-right">
                                   <?php
                                            $ins_name=  getInstituteName();
                                           
                                        ?>
                                    <b> <?php echo $ins_name; ?></b>
                                    <small class="brown">
                                            <i class="ace-icon fa fa-angle-double-right"></i>
                                            Employee List
                                    </small>
                                    <small class="pull-right">
                                            Date: <?php echo date("m/d/Y"); ?>
                                    </small>
                                   
                                </div>
                               
                            </div>
                         </div>
                    </div>    
                           
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="hidden-480">Employee Info</th>
                            <th class="hidden-480">Contact</th>
                            <th class="hidden-480">Dept/Designation</th>
                            <th class="hidden-480">Emp Type/Job Status</th>
                            <th class="hidden-480">Current Status</th>
                            <th class="hidden-480">Image</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $sl=1;
                                foreach ($employeelist as $value) {
                                        
                          ?>
                      
                        <tr>                           
                            <td>                                       
                                 <?php
                                        if (!empty($value['employeeId'])) {
                                            echo "ID: " . $value['employeeId'] . "<br><span class=\"label label-sm label-warning\">" . $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] . "</span>";
                                        }
                                        ?>          
                            </td>
                            <td><?php 
                                    if (!empty($value['phone'])) { echo ($value['phone'])."<br>"; }
                                    if (!empty($value['email'])) { echo ($value['email']); }
                                ?>
                            </td>

                            <td><?php 
                                    if (!empty($value['departmentId'])) { echo "<span class=\"label label-sm label-warning\">".element($value['departmentId'],getDepartmentInfoArray(),Null)."</span><br>"; }
                                    if (!empty($value['designation'])) { echo element($value['designation'],getDesignationArray(),Null); }
                                ?>
                            </td>
                            <td><?php 
                                    if (!empty($value['employeeType'])) { echo "<span class=\"label label-sm label-warning\">".element($value['employeeType'],getmployeetypeList(),Null)."</span><br>"; }
                                    if (!empty($value['employmentStatus'])) { echo element($value['employmentStatus'],getemployeestatusList(),Null); }
                                ?>
                            </td>
                            <td><?php 
                                    if (!empty($value['employeeStatus'])) { echo element($value['employeeStatus'],getEmployeeStatus(),Null)."<br>"; }
                                    
                                ?>
                            </td>
                            <td class="hidden-480">
                                        <?php
                                                if ($value['photo']) {
                                            ?>
                                            <img  src="<?php if (file_exists($value['photo'])) { echo base_url() . $value['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
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
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 