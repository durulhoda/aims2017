<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
           Edit Registration Form
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                must be fill up all red box field
            </small>
        </h1>
    </div><!-- /.page-header -->

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
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/applicant/updateapplicant/<?php echo $editData["applicationId"]; ?>" enctype="multipart/form-data" method="post">
                <h3 class="lighter block green">Applicant Personal Information</h3>

                <div class="hr hr-24"></div>
                <div class="col-xs-12 col-sm-12">  
                    <div class="col-xs-12 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Applicant Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[firstName]" value="<?php echo $editData["firstName"]; ?>" class="form-control" id="form-field-1" placeholder="Applicant Name" />
                        </div>
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="input-mask-date form-control" placeholder="Date of Birth" name="data[dateOfBirth]" value="<?php if(!empty($editData["dateOfBirth"])){ echo $editData["dateOfBirth"]; } ?>" type="text" id="form-field-mask-1" />
                        </div>
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[sbreg]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="form-control" placeholder="Birth Registration Number" name="data[sbreg]" value="<?php echo $editData["sbreg"]; ?>" type="text" id="form-field-2" />
                        </div>
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Gender &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                            <div class="radio">
                                <?php
                                    foreach(getGendar() as $key =>$value)
                                    {
                                ?>
                                <label class="col-xs-5 col-sm-5">
                                    <input name="data[gender]" <?php  echo ($editData["gender"] == $key) ? "checked" : ""; ?> value="<?php echo $key; ?>" <?php echo set_radio("data[gender]", $key, FALSE); ?> type="radio" class="ace" />
                                    <span class="lbl"> <?php echo $value; ?> </span>
                                </label>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>

                    </div> <!-- /.col-sub-4 -->  
                    <div class="col-xs-12 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Nationality &nbsp; <?php echo form_error('data[nationality]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[nationality]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getCountryName() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                           <?php echo ($editData["nationality"] == $key) ? "Selected" : ""; ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>	
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Blood Group &nbsp; <?php echo form_error('data[bloodGroup]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[bloodGroup]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getBloodGroup() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo ($editData["bloodGroup"] == $key) ? "Selected" : ""; ?>  >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Religion &nbsp; <?php echo form_error('data[religion]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[religion]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getReligion() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                             <?php echo ($editData["religion"] == $key) ? "Selected" : ""; ?>  >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">National ID &nbsp; <?php echo form_error('data[snId]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" class="form-control" id="form-field-1" name="data[snId]"  value="<?php echo $editData["snId"]; ?>" placeholder="National ID" />
                        </div>

                    </div> <!-- /.col-sub-4 --> 
                </div>
                <div class="col-xs-12 col-sm-12">  
                    <h3 class="lighter block green">Applicant Contact Information</h3>                                                                
                    <div class="hr hr-24"></div>

                    <div class="col-xs-12 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Phone Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[phone]" value="<?php echo $editData["phone"];?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                        </div>
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[presentAddress]', '<span class="successMessage">', '</span>'); ?></label>
                            <textarea class="form-control" placeholder="Present Address" name="data[presentAddress]" value="<?php echo $editData["presentAddress"]; ?>" type="text" id="form-field-1"><?php echo $editData["presentAddress"]; ?></textarea>
                        </div>
                        

                    </div> <!-- /.col-sub-4 -->  
                    <div class="col-xs-12 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Email &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="form-control" placeholder="Email" name="data[email]" value="<?php echo set_value("data[email]"); ?>" type="text" id="form-field-1" />
                        </div>
                        
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Permanent Address &nbsp; <?php echo form_error('data[permanentAddress]', '<span class="successMessage">', '</span>'); ?></label>
                            <textarea class="form-control" placeholder="Permanent Address" name="data[permanentAddress]" value="<?php echo $editData["permanentAddress"]; ?>" type="text" id="form-field-1"><?php echo $editData["permanentAddress"]; ?></textarea>
                        </div>		

                    </div> 
                </div>     
                <div class="col-xs-12 col-sm-12">  
                    <h3 class="lighter block green">Applicant Guardian Information</h3>                                                                
                    <div class="hr hr-24"></div>

                    <div class="col-xs-12 col-sm-4">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group has-error col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Father Name &nbsp; <?php echo form_error('data[fatherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[fatherName]" value="<?php echo $editData["fatherName"]; ?>" type="text" class="form-control" id="form-field-1" placeholder="Father Name" />
                        </div>
                        <div class="form-group has-error col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Father Mobile &nbsp; <?php echo form_error('data[fatherPhone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[fatherPhone]" value="<?php echo $editData["fatherPhone"];?>" type="text" class="form-control" id="form-field-1" placeholder="Father Mobile Number" />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Father Profession &nbsp; <?php echo form_error('data[fatherProfession]', '<span class="successMessage">', '</span>'); ?></label>
                            <select  name="data[fatherProfession]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getProfession() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo ($editData["fatherProfession"] == $key) ? "Selected" : ""; ?>  >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Father National ID &nbsp; <?php echo form_error('data[fnid]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[fnid]" value="<?php echo $editData["fnid"]; ?>" type="text" class="form-control" id="form-field-1" placeholder="Father National ID" />
                        </div>	


                    </div> <!-- /.col-sub-4 -->  
                    <div class="col-xs-12 col-sm-4">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group has-error col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Mother Name &nbsp; <?php echo form_error('data[motherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[motherName]" value="<?php echo $editData["motherName"]; ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother Name" />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Mother Mobile &nbsp; <?php echo form_error('data[motherPhone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[motherPhone]" value="<?php echo $editData["motherPhone"];?>" type="text" class="form-control" id="form-field-1" placeholder="Mother Mobile Number" />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Mother Profession &nbsp; <?php echo form_error('data[motherProfession]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[motherProfession]" class="form-control" id="form-field-select-1">
                                 <?php
                                    foreach(getProfession() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                             <?php echo ($editData["motherProfession"] == $key) ? "Selected" : ""; ?>  >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>       
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Mother National ID &nbsp; <?php echo form_error('data[mnid]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[mnid]" value="<?php echo $editData["mnid"]; ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother National ID" />
                        </div>

                    </div> 
                    <div class="col-xs-12 col-sm-4">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Legal Guardian Name &nbsp; <?php echo form_error('data[legalGardianName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[legalGardianName]" value="<?php echo $editData["legalGardianName"]; ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian Name" />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Legal Guardian Mobile &nbsp; <?php echo form_error('data[legalGardianPhone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[legalGardianPhone]" value="<?php echo $editData["legalGardianPhone"]; ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian Mobile Number" />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Legal Guardian Profession &nbsp; <?php echo form_error('data[legalGardianProfession]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[legalGardianProfession]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getProfession() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                              <?php echo ($editData["legalGardianProfession"] == $key) ? "Selected" : ""; ?>  >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>   
                        <div class="form-group col-xs-12 col-sm-12">
                            <label class="control-label" for="form-field-1">Legal Guardian National ID &nbsp; <?php echo form_error('data[lgnid]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[lgnid]" value="<?php echo $editData["lgnid"]; ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian National ID" />
                        </div>

                    </div> 
                </div>   
                <div class="col-xs-12 col-sm-12">  
                    <h3 class="lighter block green">Enrollment Information</h3>                                                                
                    <div class="hr hr-24"></div>
                    
                    <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="datax[sessionId]"  required="1" class="form-control">
                                
                                  <?php foreach (getOfferedSession() as $value) { ?>
                                    <option value="<?php echo $value['sessionId']; ?>" 
                                            <?php echo ($editData["sessionId"] == $value['sessionId']) ? "selected" : ""; ?>>
                                        <?php echo $value['session']; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                        <div class=" has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('datax[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="datax[programLevel]" data-placeholder="Select" required="1" class="form-control">
                                
                                 <?php foreach (getProgramLevel() as $key=>$value) { ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo ($editData["programLevel"] == $key) ? "selected" : ""; ?>>
                                        <?php echo $value; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                        <div class="has-error col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="datax[programId]" required="1" class="form-control">
                                     <?php foreach (getOfferedProgram() as $value) { ?>
                                    <option value="<?php echo $value['programId']; ?>" 
                                             <?php echo ($editData["programId"] == $value['programId']) ? "selected" : ""; ?>>
                                        <?php echo $value['programName']; ?></option>                                                
                                <?php   }    ?>
                                </select>
                        </div>
                        <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getmediumid" onchange="return getOfferedMedium(); " name="datax[mediumId]" required="1" class="form-control">
                                     <?php foreach (getOfferedMedium() as $value) { ?>
                                    <option value="<?php echo $value['mediumId']; ?>" 
                                           <?php echo ($editData["mediumId"] == $value['mediumId']) ? "selected" : ""; ?>>
                                        <?php echo $value['mediumName']; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                        <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getgroupid" onchange="return getOfferedgroupId(); " name="datax[groupId]" required="1" class="form-control">
                                <?php foreach (getOfferedGroup() as $value) { ?>
                                    <option value="<?php echo $value['groupId']; ?>" 
                                           <?php echo ($editData["groupId"] == $value['groupId']) ? "selected" : ""; ?>>
                                        <?php echo $value['groupName']; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                        <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getshiftid" onchange="return getOfferedShift();" name="datax[shiftId]" required="1" class="form-control" >
                                     <?php foreach (getOfferedShift() as $value) { ?>
                                    <option value="<?php echo $value['shiftId']; ?>" 
                                           <?php echo ($editData["shiftId"] == $value['shiftId']) ? "selected" : ""; ?>>
                                        <?php echo $value['shiftName']; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                        <div class="col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Transaction Number &nbsp; <?php echo form_error('data[transactionId]', '<span class="successMessage">', '</span>'); ?></label>
                                <input name="data[transactionId]" value="<?php echo $editData['transactionId']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Transaction Number" />
                            </div>  

                    </div>
                    
                </div>   
                <div class="col-xs-12 col-sm-12">  
                    <h3 class="lighter block green">Applicant Image</h3>                                                                
                    <div class="hr hr-24"></div>

                    <div class="col-md-offset-3 col-xs-5 col-sm-5 ">
                        <input name="photo" value="<?php echo $editData['photo']; ?>" type="file" id="id-input-file-2" />
                    </div>

                </div>
           


                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Applicant Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 