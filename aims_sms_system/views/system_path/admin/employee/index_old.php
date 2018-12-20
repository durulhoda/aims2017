<!-- /Content Section  -->
    <div class="page-header">
        <h1>
            Add Employee Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/employee/insertemployee" method="post" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                     
                     <div class="has-error col-xs-12 col-sm-4">
                         <label class="control-label" for="form-field-1">Employee Type &nbsp; <?php echo form_error('data[employeeType]', '<span class="successMessage">', '</span>'); ?></label>

                               <select id="getemployeeid" onchange="return getemployeetype();" name="data[employeeType]" class="form-control" id="form-field-select-1">
                                   <option value="">Select</option>>
                          <?php
                                    foreach(getmployeetypeList() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[employeetypeId]", $key, FALSE); ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                            
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Designation &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                                   <select id="getdesignation" onchange="return getdesignation(); " name="data[designation]" data-placeholder="Select" required="1" class="form-control">

                                </select>
                         </div>
                    
                        <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Department &nbsp; <?php echo form_error('data[departmentId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[departmentId]" class="form-control" id="form-field-select-1">
                                    <?php
                                        foreach(getDepartmentInfoArray() as $value)
                                        {
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
                             <label class="control-label" for="form-field-1">Employment Status &nbsp; <?php echo form_error('data[employmentStatus]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[employmentStatus]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getemployeestatusList() as $key =>$value)
                                    {
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
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Joining Date &nbsp; <?php echo form_error('data[joiningdate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[joiningdate]" value="<?php echo set_value("data[joiningdate]"); ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Joining Date" />
                          
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Retirement Date &nbsp; <?php echo form_error('data[retirementDate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[retirementDate]" value="<?php echo set_value("data[retirementDate]"); ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Retirement Date" />
                          
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Employee Status &nbsp; <?php echo form_error('data[employeeStatus]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[employeeStatus]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getEmployeeStatus() as $key =>$value)
                                    {
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
                    
                       <div class=" has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Employee Position &nbsp; <?php echo form_error('data[positionNumber]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="number" min="1" max="500" name="data[positionNumber]" value="<?php echo set_value("data[positionNumber]"); ?>" class="form-control" id="form-field-mask-1" placeholder="Position Number" required/>
                          
                        </div>
                      
                    
                    </div>

                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="hr hr-18 dotted hr-double"></div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">First Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" type="text" name="data[firstName]" value="<?php echo set_value("data[firstName]"); ?>" class="form-control" id="form-field-1" placeholder="First Name" />
                        </div>                        
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Middle Name &nbsp; <?php echo form_error('data[middleName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[middleName]" value="<?php echo set_value("data[middleName]"); ?>" class="form-control" id="form-field-1" placeholder="Middle Name" />
                        </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Last Name &nbsp; <?php echo form_error('data[lastName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" type="text" name="data[lastName]" value="<?php echo set_value("data[lastName]"); ?>" class="form-control" id="form-field-1" placeholder="Last Name" />
                        </div>
                       
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Father Name &nbsp; <?php echo form_error('data[fatherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[fatherName]" value="<?php echo set_value("data[fatherName]"); ?>" class="form-control" id="form-field-1" placeholder="Father Name" />
                        </div>
                        
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Mother Name &nbsp; <?php echo form_error('data[motherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[motherName]" value="<?php echo set_value("data[motherName]"); ?>" class="form-control" id="form-field-1" placeholder="Mother Name" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Gender &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                            <div class="radio form-control">
                                <?php
                                    foreach(getSex() as $key =>$value)
                                    {
                                ?>
                                <label class="col-xs-6 col-sm-6">
                                    <input name="data[gender]" value="<?php echo $key; ?>" <?php echo set_radio("data[gender]", $key, FALSE); ?> type="radio" class="ace" />
                                    <span class="lbl"> <?php echo $value; ?> </span>
                                </label>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    
                        
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Mobile Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[phone]" value="<?php echo set_value("data[phone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                         </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[dateOfBirth]" value="<?php echo set_value("data[dateOfBirth]"); ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Date of Birth" />
                          
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[embreg]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[embreg]" value="<?php echo set_value("data[embreg]"); ?>" class="form-control" id="form-field-1" placeholder="Birth Registration Number" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Nationality &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[nationality]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getCountryName() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[nationality]", $key, FALSE); ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">National ID Number &nbsp; <?php echo form_error('data[nationalIdentity]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[nationalIdentity]" value="<?php echo set_value("data[nationalIdentity]"); ?>" class="form-control" id="form-field-1" placeholder="National ID Number" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Blood Group &nbsp; <?php echo form_error('data[bloodGroup]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[bloodGroup]" class="form-control" id="form-field-select-1">
                                    <?php
                                        foreach(getBloodGroup() as $key =>$value)
                                        {
                                    ?>
                                        <option value="<?php echo $key; ?>" 
                                                <?php echo set_select("data[bloodGroup]", $key, FALSE); ?> >
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
                                                <?php echo set_select("data[maritialStatus]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option> 

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         
                         <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Email Address &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[email]" value="<?php echo set_value("data[email]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Email Address" />
                         </div>
                         <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[address]', '<span class="successMessage">', '</span>'); ?></label>
                            <textarea class="form-control" placeholder="Present Address" name="data[address]" value="<?php echo set_value("data[address]"); ?>" type="text" id="form-field-1"></textarea>
                         </div>  
                         <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Employee Image &nbsp; <?php echo form_error('photo', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="photo" value="<?php echo set_value("photo"); ?>" type="file" id="id-input-file-2" />
                            <label class="control-label" for="form-field-1">Maintain Image Size: 250*250 </label>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Index No &nbsp; <?php echo form_error('data[indexno]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[indexno]" value="<?php echo set_value("data[indexno]"); ?>" class="form-control" id="form-field-1" placeholder="Index No" />
                        </div>
                       
                    </div> <!-- /.col-sub-4 --> 
                    
                    
                    <div class="col-xs-12 col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->
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

                    </div>
                        
                    
                    <div class="col-xs-12 col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->
                     <div class="hr hr-18 dotted hr-double"></div>

                        <h5 class="pink">
                            <i class="ace-icon fa fa-hand-o-right green"></i>
                            Login & Access Information
                        </h5>
                        <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">HR &nbsp; <?php echo form_error('data_acx[hr]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[hr]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[hr]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option>

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">HR (Admin) &nbsp; <?php echo form_error('data_acx[hrAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[hrAdmin]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[hrAdmin]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option>

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Academic &nbsp; <?php echo form_error('data_acx[academic]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[academic]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[academic]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option>

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Academic Admin &nbsp; <?php echo form_error('data_acx[academicAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[academicAdmin]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[academicAdmin]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option>

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Finance &nbsp; <?php echo form_error('data_acx[finance]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[finance]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[finance]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option>

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Finance(Admin) &nbsp; <?php echo form_error('data_acx[financeAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[financeAdmin]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[financeAdmin]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option>

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Admission & Result &nbsp; <?php echo form_error('data_acx[admissionAndResult]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[admissionAndResult]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[admissionAndResult]", $key, FALSE); ?> >
                                                    <?php echo $value; ?>
                                        </option>

                                    <?php
                                        }
                                    ?>
                                </select>
                         </div>
                         <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Admission & Result(Admin)  &nbsp; <?php echo form_error('data_acx[admissionAndResultAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data_acx[admissionAndResultAdmin]" class="form-control" id="form-field-select-1">
                                    <?php
                                    foreach(getAccessStatus() as $key =>$value)
                                    {
                                    ?>
                                        <option value="<?php echo $key; ?>"
                                                <?php echo set_select("data_acx[admissionAndResultAdmin]", $key, FALSE); ?> >
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
                                <i class="ace-icon fa fa-check bigger-110"></i> Save Employee Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 