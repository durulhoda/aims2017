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
             
            <div class="table-header">
                Member List
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="hidden-480">Sl No.</th>
                            <th>Member Info</th>
                            <th class="hidden-480">Gender</th>
                            <th>Contact</th>
                            <th class="hidden-480">Designation</th>
                            <th class="hidden-480">Type/Status</th>
                            <th>Image</th>

                            <th>
                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
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
                            <td class="hidden-480"><?php 
                                   echo $sl++;
                                ?>
                            </td>
                            <td>                                       
                                 <?php
                                        if (!empty($value['id'])) {
                                            echo  "<b>".$value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] ;
                                        }
                                        ?>          
                            </td>
                            <td class="hidden-480"><?php 
                                    if (!empty($value['gender'])) { echo element($value['gender'],getSex(),NULL ); }
                                ?>
                            </td>
                            <td><?php 
                                    if (!empty($value['phone'])) { echo "<b>".($value['phone'])."</b><br>"; }
                                    if (!empty($value['email'])) { echo ($value['email']); }
                                ?>
                            </td>

                            <td class="hidden-480"><?php 
                                if (!empty($value['designation'])) { echo "<b>".element($value['designation'],getdesignation(),Null)."</b>"; }    
                                if (!empty($value['departmentId'])) { echo "<br>".(getDepartmentName($value['departmentId'])); }
                                    
                                ?>
                            </td>
                            <td class="hidden-480"><?php 
                                    if (!empty($value['employeeType'])) { echo "<b>Emp. Type: ".element($value['employeeType'],getmployeetypeList(),Null)."</b><br>"; }
                                    if (!empty($value['employmentStatus'])) { echo element($value['employmentStatus'],getemployeestatusList(),Null)." Job"; }
                                ?>
                            </td>
                           
                            <td>
                                        <?php
                                                if ($value['photo']) {
                                                $img="uploads/Employee/".$value['photo'];
                                            ?>
                                            <img  src="<?php if(file_exists($img)){ echo base_url()."uploads/Employee/".$value['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
                                        <?php 
                                        
                                            } 
                                          ?>
                            </td>

                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="blue" target="_blank" href="#<?php echo admin_Url();?>/employee/showEmployeeProfile/<?php echo  $value['id'];?>" title="View">
                                        <i class="ace-icon fa fa-search bigger-130"></i>
                                    </a>

                                    <a class="green" href="#<?php echo admin_Url();?>/employee/editEmployee/<?php echo  $value['id'];?>" title="Edit">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" href="#<?php echo admin_Url();?>/employee/Deleteemployee/<?php echo  $value['id'];?>" title="Delete">
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
                                                <a target="_blank" href="#<?php echo admin_Url();?>/employee/showEmployeeProfile/<?php echo  $value['id'];?>" class="tooltip-info" data-rel="tooltip" title="View">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#<?php echo admin_Url();?>/employee/editEmployee/<?php echo  $value['id'];?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a style="pointer-events: none; cursor: default;" href="#<?php echo admin_Url();?>/employee/Deleteemployee/<?php echo  $value['id'];?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
                            <th >Sl</th>
                            <th >Employee Info</th>
                            <th >Contact</th>
                            <th >Dept/Designation</th>
                            <th class="hidden-480">Emp Type/Job Status</th>
                            <th >Image</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $sl=1;
                                foreach ($employeelist as $value) {
                                        
                          ?>
                      
                        <tr>         
                            <td><?php echo $sl++;?> </td>
                            <td>                                       
                                 <?php
                                        if (!empty($value['employeeId'])) {
                                            echo  "<b>".$value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] . "</b><br>ID: " . $value['employeeId'] ;
                                        }
                                        ?>          
                            </td>
                            <td><?php 
                                    if (!empty($value['phone'])) { echo ($value['phone'])."<br>"; }
                                    if (!empty($value['email'])) { echo ($value['email']); }
                                ?>
                            </td>

                            <td><?php 
                                if (!empty($value['designation'])) { echo element($value['designation'],getDesignationArray(),Null); }
                                if (!empty($value['departmentId'])) { echo getDepartmentName($value['departmentId'])."<br>"; }
                                    
                                ?>
                            </td>
                            <td class="hidden-480"><?php 
                                    if (!empty($value['employeeType'])) { echo element($value['employeeType'],getmployeetypeList(),Null)."<br>"; }
                                    if (!empty($value['employmentStatus'])) { echo element($value['employmentStatus'],getemployeestatusList(),Null); }
                                ?>
                            </td>                           
                            <td>
                                        <?php
                                                if ($value['photo']) {
                                                    $img="uploads/Employee/".$value['photo'];
                                            ?>
                                            <img  src="<?php if (file_exists($img)) { echo base_url().$img; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
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