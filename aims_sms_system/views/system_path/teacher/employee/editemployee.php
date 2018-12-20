<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Edit Employee Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                must be fill up all red box field
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/employee/updateEmp_data/<?php echo $editData['employeeId']; ?>" method="post" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">First Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" type="text" name="data[firstName]" value="<?php echo $editData['firstName'] ?>" class="form-control" id="form-field-1" placeholder="First Name" />
                        </div>                        
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Middle Name &nbsp; <?php echo form_error('data[middleName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[middleName]" value="<?php echo $editData['middleName']; ?>" class="form-control" id="form-field-1" placeholder="Middle Name" />
                        </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Last Name &nbsp; <?php echo form_error('data[lastName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" type="text" name="data[lastName]" value="<?php echo $editData['lastName']; ?>" class="form-control" id="form-field-1" placeholder="Last Name" />
                        </div>
                       
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Father Name &nbsp; <?php echo form_error('data[fatherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[fatherName]" value="<?php echo $editData['fatherName'] ?>" class="form-control" id="form-field-1" placeholder="Father Name" />
                        </div>
                        
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Mother Name &nbsp; <?php echo form_error('data[motherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[motherName]" value="<?php echo $editData['motherName']; ?>" class="form-control" id="form-field-1" placeholder="Mother Name" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Gender &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                            <div class="radio form-control">
                            

                               <?php
                                    foreach(getGendar() as $key =>$value)
                                    {
                                ?>
                                <label class="col-xs-5 col-sm-5">
                                    <input name="data[gender]" <?php  echo ($editData["gender"] == $key) ? "checked" : ""; ?> value="<?php echo $key; ?>"  type="radio" class="ace" />
                                    <span class="lbl"> <?php echo $value; ?> </span>
                                </label>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    
                        
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Mobile Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[phone]" value="<?php echo $editData['phone']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                         </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[dateOfBirth]" value="<?php echo $editData['dateOfBirth']; ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Date of Birth" />
                          
                        </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[embreg]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[embreg]" value="<?php echo $editData['embreg']; ?>" class="form-control" id="form-field-1" placeholder="Birth Registration Number" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Nationality &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[nationality]" class="form-control" id="form-field-select-1">
                                <?php foreach (getCountryName() as $key => $value) { ?>
                                                                               <option value="<?php echo $key; ?>" 
                                                                                       <?php echo ($editData['nationality'] == $key) ? "Selected" : ""; ?> >        

                                                                                   <?php echo $value; ?></option>                                                
                                                                           <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Blood Group &nbsp; <?php echo form_error('data[bloodGroup]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[bloodGroup]" class="form-control" id="form-field-select-1">
                                     <?php
                                                                         foreach(getBloodGroup() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["bloodGroup"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Marital Status &nbsp; <?php echo form_error('data[maritialStatus]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[maritialStatus]" class="form-control" id="form-field-select-1">
                                   <?php
                                                                         foreach(getMeritialStatus() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["maritialStatus"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                                </select>
                         </div>
                         
                         <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Email Address &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[email]" value="<?php echo $editData['email']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Email Address" />
                         </div>
                         <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[address]', '<span class="successMessage">', '</span>'); ?></label>
                            <textarea class="form-control" placeholder="Present Address" name="data[address]" value="<?php echo $editData["address"]; ?>" type="text" id="form-field-1"><?php echo $editData["address"]; ?></textarea>
                         </div>  
                      
                       
                    </div> <!-- /.col-sub-4 --> 
                    
                    
<!--                    <div class="col-xs-12 col-sm-12">  
                     PAGE CONTENT BEGINS 
                        <div class="hr hr-18 dotted hr-double"></div>
                        <div class="form-group">
                            <?php echo form_error('data[degree]', '<div style="color: rgb(255, 0, 0);">', '</div>'); ?>
                            <label for="form-field-first" class="col-sm-2 control-label no-padding-right">Education Information</label>

                            <div class="col-sm-10">
                                <input  disabled="disabled" class="col-xs-12 col-sm-2" type="text" value="Program Type"/>
                                <input  disabled="disabled"  class="col-xs-2" type="text" value="Discipline"/>
                                <input  disabled="disabled"  class="col-xs-2" type="text" value="Grade"/>
                                <input  disabled="disabled"  class="col-xs-2" type="text" value="Passing Year"/>
                                <input  disabled="disabled"  class="col-xs-3" type="text" value="Board/Institution"/>
                                <button class="add_field_button ace-icon glyphicon glyphicon-plus" style="float: right;"></button> 
                            </div>

                        </div>
                        
                        <div class="space-4"></div>

                        <div class="input_fields_wrap">
                            <div class="form-group">
                                <label for="form-field-comment" class="col-sm-2 control-label no-padding-right">
                                    &nbsp;
                                </label>

                                <div class="col-sm-10">

                                    <select id="form-field-website" name="data[degree][]" class="col-xs-12 col-sm-2">
                                        <option value="">Select</option>
                                        
                                        <?php foreach (getEducationProgramType() as $key => $value) { ?>
                                            <option <?php echo set_select('data[degree][]', $key); ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php   } ?>
                                    </select>                                                

                                    <input name="data[degree][]" type="text" placeholder="Discipline" class="input-medium  col-xs-2 col-sm-2">
                                    <input name="data[degree][]" type="text" placeholder="Grade" class="input-medium  col-xs-2 col-sm-2">
                                    <input name="data[degree][]" type="text" placeholder="Passing Year" class="input-medium  col-xs-2 col-sm-2">
                                    <input name="data[degree][]" type="text" placeholder="Board/Institution" class="input-medium  col-xs-3 col-sm-3">

                                </div>
                            </div>

                            <div class="space-4"></div>
                        </div>
                     
                    </div>-->
                        
                    <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                     <div class="hr hr-18 dotted hr-double"></div>
                        <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Department &nbsp; <?php echo form_error('data[departmentId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[departmentId]" class="form-control" id="form-field-select-1">
                                   <?php
                                                                         foreach(getDepartmentName() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["departmentId"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                                </select>
                         </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Designation &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                             <select name="data[designation]" class="form-control" id="form-field-select-1">
                                <?php
                                   
                                        foreach(getDesignationArray() as $value)
                                        {
                                           $position= $value['candidate']-CountEmployeeByPosition($value['designation']);
                                        if(($value['candidate']>=$position))
                                             {
                                ?>
                                    <option value="<?php echo $value['designation']; ?>" 
                                        <?php echo ($editData["designation"] == $value['designation']) ? "Selected" : ""; ?> >
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
                                 <?php
                                                                         foreach(getmployeetypeList() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["employeeType"] == $key) ? "Selected" : ""; ?> >
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
                                <?php
                                                                         foreach(getEmployeeStatus() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["employmentStatus"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                            </select>
                        </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Joining Date &nbsp; <?php echo form_error('data[joiningdate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[joiningdate]" value="<?php echo $editData['joiningdate']; ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Joining Date" />
                          
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Retirement Date &nbsp; <?php echo form_error('data[retirementDate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[retirementDate]" value="<?php echo $editData['retirementDate'];?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Retirement Date" />
                          
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Employee Status &nbsp; <?php echo form_error('data[employeeStatus]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[employeeStatus]" class="form-control" id="form-field-select-1">
                                <?php
                                                                         foreach(getEmployeeStatus() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["employeeStatus"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                            </select>
                        </div>
                    </div>
                   
                    
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Employee Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 