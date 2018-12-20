<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Registration Form
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
        
       
<?php if($large_photo_exists && $thumb_photo_exists) :?>
	<?php echo $large_photo_exists."&nbsp;".$thumb_photo_exists; ?>
        <input type="text" name="photo" value="<?php echo $large_photo_exists."&nbsp;".$thumb_photo_exists; ?>">
	<p><a href="<?php echo admin_Url(); ?>/applicant/RegistrationForm">Add another</a></p>

<?php elseif($large_photo_exists && $thumb_photo_exists == NULL) :?>

<h2>Generate Your Profile Photo</h2>
<div align="center">
    <img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
        <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
            <img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="position: relative;" alt="Thumbnail Preview" />
        </div>
        <br style="clear:both;"/>
        
        <form name="thumbnail" action="<?php echo admin_Url(); ?>/applicant/RegistrationForm" method="post">
                <input type="hidden" name="x1" value="" id="x1" />
                <input type="hidden" name="y1" value="" id="y1" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="file_name" value="<?php echo $img['file_name'] ;?>" />
                
        
        
        
                
                 <div class="col-xs-12 col-sm-12">  
                <h3 class="lighter block green">Enrollment Information</h3>                                                                
                <div class="hr hr-24"></div>

                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSessionId();" data-placeholder="Select" name="datax[sessionId]"   class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('datax[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('datax[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="datax[programLevel]" data-placeholder="Select"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" onchange="return getOfferedprogramId();" name="datax[programId]"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId();" name="datax[mediumId]"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId();" name="datax[groupId]"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId();" name="datax[shiftId]"  class="form-control" >

                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Transaction Number &nbsp; <?php echo form_error('data[transactionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[transactionId]" value="<?php echo set_value("data[transactionId]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Transaction Number" />
                    </div>  

                </div>

            </div> 
            
            <br>
             <div class="col-xs-12 col-sm-12">  
            <h3 class="lighter block green">Applicant Personal Information</h3>

            <div class="hr hr-24"></div>
            <div class="col-xs-12 col-sm-12">  
                <div class="col-xs-12 col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Applicant Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="text" name="data[firstName]" value="<?php echo set_value("data[firstName]"); ?>" class="form-control" id="form-field-1" placeholder="Applicant Name" />
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                        <input class="input-mask-date form-control" placeholder="Date of Birth" name="data[dateOfBirth]" value="<?php echo set_value("data[dateOfBirth]"); ?>" type="text" id="form-field-mask-1" />
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[sbreg]', '<span class="successMessage">', '</span>'); ?></label>
                        <input class="form-control" placeholder="Birth Registration Number" name="data[sbreg]" value="<?php echo set_value("data[sbreg]"); ?>" type="text" id="form-field-2" />
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Gender &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                        <div class="radio">
                            <?php
                            foreach (getGendar() as $key => $value) {
                                ?>
                                <label class="col-xs-5 col-sm-5">
                                    <input name="data[gender]" value="<?php echo $key; ?>" <?php echo set_radio("data[gender]", $key, FALSE); ?> type="radio" class="ace" />
                                    <span class="lbl"> <?php echo $value; ?> </span>
                                </label>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Quota &nbsp; <?php echo form_error('data[quata_id]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[quata_id]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getQuatalist() as $value) {
                                ?>
                                <option value="<?php echo $value['quata_id']; ?>" 
                                        <?php echo set_select("data[quata_id]", $value['quata_id'], FALSE); ?> >
                                            <?php echo $value['quata']; ?>
                                </option> 

                                <?php
                            }
                            ?>

                        </select>
                    </div>
                </div> <!-- /.col-sub-4 -->  
                <div class="col-xs-12 col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Nationality &nbsp; <?php echo form_error('data[nationality]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[nationality]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getCountryName() as $key => $value) {
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
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Blood Group &nbsp; <?php echo form_error('data[bloodGroup]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[bloodGroup]" class="form-control" id="form-field-select-1">
                            <option value="">Select Blood Group </option>
                            <?php
                            foreach (getBloodGroup() as $key => $value) {
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

                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Religion &nbsp; <?php echo form_error('data[religion]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[religion]" class="form-control" id="form-field-select-1">
                            <option value="">Select Religion </option>
                            <?php
                            foreach (getReligion() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[religion]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">National ID &nbsp; <?php echo form_error('data[snId]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="text" class="form-control" id="form-field-1" name="data[snId]"  value="<?php echo set_value("data[snId]"); ?>" placeholder="National ID" />
                    </div>

                </div> <!-- /.col-sub-4 --> 
            </div></div>
            <div class="col-xs-12 col-sm-12">  
                <h3 class="lighter block green">Applicant Contact Information</h3>                                                                
                <div class="hr hr-24"></div>

                <div class="col-xs-12 col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Phone Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[phone]" value="<?php echo set_value("data[phone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                    </div>
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[presentAddress]', '<span class="successMessage">', '</span>'); ?></label>
                        <textarea class="form-control" placeholder="Present Address" name="data[presentAddress]" value="<?php echo set_value("data[presentAddress]"); ?>" type="text" id="form-field-1"></textarea>
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
                        <textarea class="form-control" placeholder="Permanent Address" name="data[permanentAddress]" value="<?php echo set_value("data[permanentAddress]"); ?>" type="text" id="form-field-1"></textarea>
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
                        <input name="data[fatherName]" value="<?php echo set_value("data[fatherName]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Father Name" />
                    </div>
                    <div class="form-group has-error col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Father Mobile &nbsp; <?php echo form_error('data[fatherPhone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[fatherPhone]" value="<?php echo set_value("data[fatherPhone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Father Mobile Number" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Father Profession &nbsp; <?php echo form_error('data[fatherProfession]', '<span class="successMessage">', '</span>'); ?></label>
                        <select  name="data[fatherProfession]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getProfession() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[fatherProfession]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Father National ID &nbsp; <?php echo form_error('data[fnid]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[fnid]" value="<?php echo set_value("data[fnid]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Father National ID" />
                    </div>	


                </div> <!-- /.col-sub-4 -->  
                <div class="col-xs-12 col-sm-4">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group has-error col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother Name &nbsp; <?php echo form_error('data[motherName]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[motherName]" value="<?php echo set_value("data[motherName]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother Name" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother Mobile &nbsp; <?php echo form_error('data[motherPhone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[motherPhone]" value="<?php echo set_value("data[motherPhone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother Mobile Number" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother Profession &nbsp; <?php echo form_error('data[motherProfession]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[motherProfession]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getProfession() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[motherProfession]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>       
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother National ID &nbsp; <?php echo form_error('data[mnid]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[mnid]" value="<?php echo set_value("data[mnid]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother National ID" />
                    </div>

                </div> 
                <div class="col-xs-12 col-sm-4">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian Name &nbsp; <?php echo form_error('data[legalGardianName]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[legalGardianName]" value="<?php echo set_value("data[legalGardianName]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian Name" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian Mobile &nbsp; <?php echo form_error('data[legalGardianPhone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[legalGardianPhone]" value="<?php echo set_value("data[legalGardianPhone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian Mobile Number" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian Profession &nbsp; <?php echo form_error('data[legalGardianProfession]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[legalGardianProfession]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getProfession() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[legalGardianProfession]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>   
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian National ID &nbsp; <?php echo form_error('data[lgnid]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[lgnid]" value="<?php echo set_value("data[lgnid]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian National ID" />
                    </div>

                </div> 
            </div>   
        

            <div class="col-xs-12 col-sm-12">  
                <h3 class="lighter block green">Previous Academic Information</h3>                                                                
                <div class="hr hr-24"></div>
                <table id="" class="table table-striped table-bordered table-hover">

                    <thead>
                    <td></td>
                    <td valign="top">Roll</td>
                    <td valign="top">Thana/Registration No</td>
                    <td valign="top">Post/Board</td>
                    <td valign="top">GPA</td>
                    <td valign="top">Passing Year</td>
                    </thead>
                    <tbody>

                        <tr>
                            <td>P.S.C.</td>
                    <input  type="hidden" placeholder="Roll" value="1" name="category[]">
                    <td>
                        <input type="text" placeholder="Roll" name="roll[]">
                    </td>
                    <td>
                        <input type="text" placeholder="Thana" name="thana_registration[]">
                    </td>
                    <td>


                        <select name="board[]" class="form-control" id="form-field-select-1">

                            <?php
                            foreach (getBoardInfo() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[board]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>       

                        </select>
                    </td>
                    <td>
                        <input id="psc_gpa" type="text" placeholder="GPA" name="gpa[]">
                    </td>
                    <td>
                        <select id="jsc_passing_year" name="passing_year[]">
                            <option value="">Select</option>
                            <option value="1990">1990</option>                                           
                            <option value="1991">1991</option>                                              
                            <option value="1992">1992</option>                                              
                            <option value="1993">1993</option>                                       
                            <option value="1994">1994</option>                                             
                            <option value="1995">1995</option>                                            
                            <option value="1996">1996</option>                                             
                            <option value="1997">1997</option>                                              
                            <option value="1998">1998</option>                                        
                            <option value="1999">1999</option>                                           
                            <option value="2000">2000</option>                                          
                            <option value="2001">2001</option>                                             
                            <option value="2002">2002</option>                                           
                            <option value="2003">2003</option>                                              
                            <option value="2004">2004</option>                                              
                            <option value="2005">2005</option>                                              
                            <option value="2006">2006</option>                                               
                            <option value="2007">2007</option>                                            
                            <option value="2008">2008</option>                                             
                            <option value="2009">2009</option>                                              
                            <option value="2010">2010</option>                                              
                            <option value="2011">2011</option>                                            
                            <option value="2012">2012</option>                                                
                            <option value="2013">2013</option>                                              
                            <option value="2014">2014</option>                                              
                            <option value="2015">2015</option>                                               
                            <option value="2016">2016</option>                                              
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td>J.S.C.</td>
                    <input value="2"  type="hidden" placeholder="PSC Roll" name="category[]">
                    <td>
                        <input type="text" placeholder="Roll" name="roll[]">
                    </td>
                    <td>
                        <input type="text" placeholder="Registration No" name="thana_registration[]">
                    </td>
                    <td>
                        <select name="board[]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getBoardInfo() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[board]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>       
                        </select>
                    </td>
                    <td>
                        <input id="jsc_gpa" type="text" placeholder="GPA" name="gpa[]">
                    </td>
                    <td>
                        <select id="jsc_passing_year" name="passing_year[]">
                            <option value="">Select</option>
                            <option value="1990">1990</option>                                           
                            <option value="1991">1991</option>                                              
                            <option value="1992">1992</option>                                              
                            <option value="1993">1993</option>                                       
                            <option value="1994">1994</option>                                             
                            <option value="1995">1995</option>                                            
                            <option value="1996">1996</option>                                             
                            <option value="1997">1997</option>                                              
                            <option value="1998">1998</option>                                        
                            <option value="1999">1999</option>                                           
                            <option value="2000">2000</option>                                          
                            <option value="2001">2001</option>                                             
                            <option value="2002">2002</option>                                           
                            <option value="2003">2003</option>                                              
                            <option value="2004">2004</option>                                              
                            <option value="2005">2005</option>                                              
                            <option value="2006">2006</option>                                               
                            <option value="2007">2007</option>                                            
                            <option value="2008">2008</option>                                             
                            <option value="2009">2009</option>                                              
                            <option value="2010">2010</option>                                              
                            <option value="2011">2011</option>                                            
                            <option value="2012">2012</option>                                                
                            <option value="2013">2013</option>                                              
                            <option value="2014">2014</option>                                              
                            <option value="2015">2015</option>                                               
                            <option value="2016">2016</option>                                              
                        </select>
                    </td>
                    </tr>

                    <tr>
                        <td>S.S.C</td>
                    <input value="3"  type="hidden" placeholder="PSC Roll" name="category[]">
                    <td>
                        <input type="text" placeholder="Roll" name="roll[]">
                    </td>
                    <td>
                        <input type="text" placeholder="Registration No"  name="thana_registration[]">
                    </td>
                    <td>
                        <select name="board[]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getBoardInfo() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[board]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>       
                        </select>
                    </td>
                    <td>
                        <input type="text" placeholder="GPA" name="gpa[]">
                    </td>
                    <td>
                        <select id="jsc_passing_year" name="passing_year[]">
                            <option value="">Select</option>
                            <option value="1990">1990</option>                                           
                            <option value="1991">1991</option>                                              
                            <option value="1992">1992</option>                                              
                            <option value="1993">1993</option>                                       
                            <option value="1994">1994</option>                                             
                            <option value="1995">1995</option>                                            
                            <option value="1996">1996</option>                                             
                            <option value="1997">1997</option>                                              
                            <option value="1998">1998</option>                                        
                            <option value="1999">1999</option>                                           
                            <option value="2000">2000</option>                                          
                            <option value="2001">2001</option>                                             
                            <option value="2002">2002</option>                                           
                            <option value="2003">2003</option>                                              
                            <option value="2004">2004</option>                                              
                            <option value="2005">2005</option>                                              
                            <option value="2006">2006</option>                                               
                            <option value="2007">2007</option>                                            
                            <option value="2008">2008</option>                                             
                            <option value="2009">2009</option>                                              
                            <option value="2010">2010</option>                                              
                            <option value="2011">2011</option>                                            
                            <option value="2012">2012</option>                                                
                            <option value="2013">2013</option>                                              
                            <option value="2014">2014</option>                                              
                            <option value="2015">2015</option>                                               
                            <option value="2016">2016</option>                                              
                        </select>
                    </td>
                    </tr>

                    <tr>
                        </tbody>
                </table>
                </td>
                </tr>
                </table>
            </div>

      

<input type="submit" name="upload_thumbnail" class="btn-primary" value="Save Student Data" id="save_thumb" />
        
              
        
        
        </form>
</div>

<hr />
<?php 	else : ?>

<h2>Upload Image</h2>
<form name="photo" enctype="multipart/form-data" action="<?php echo admin_Url(); ?>/applicant/RegistrationForm" method="post">
Select Image <input type="file" name="image" size="30"/> <input type="submit" name="upload" class="btn-primary" value="Upload" />



 <div class="col-xs-12 col-sm-12">  
                <h3 class="lighter block green">Enrollment Information</h3>                                                                
                <div class="hr hr-24"></div>

                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSessionId();" data-placeholder="Select" name="datax[sessionId]"   class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('datax[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('datax[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="datax[programLevel]" data-placeholder="Select"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" onchange="return getOfferedprogramId();" name="datax[programId]"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId();" name="datax[mediumId]"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId();" name="datax[groupId]"  class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId();" name="datax[shiftId]"  class="form-control" >

                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Transaction Number &nbsp; <?php echo form_error('data[transactionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[transactionId]" value="<?php echo set_value("data[transactionId]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Transaction Number" />
                    </div>  

                </div>

            </div> 
            
            <br>
             <div class="col-xs-12 col-sm-12">  
            <h3 class="lighter block green">Applicant Personal Information</h3>

            <div class="hr hr-24"></div>
            <div class="col-xs-12 col-sm-12">  
                <div class="col-xs-12 col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Applicant Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="text" name="data[firstName]" value="<?php echo set_value("data[firstName]"); ?>" class="form-control" id="form-field-1" placeholder="Applicant Name" />
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                        <input class="input-mask-date form-control" placeholder="Date of Birth" name="data[dateOfBirth]" value="<?php echo set_value("data[dateOfBirth]"); ?>" type="text" id="form-field-mask-1" />
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[sbreg]', '<span class="successMessage">', '</span>'); ?></label>
                        <input class="form-control" placeholder="Birth Registration Number" name="data[sbreg]" value="<?php echo set_value("data[sbreg]"); ?>" type="text" id="form-field-2" />
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Gender &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                        <div class="radio">
                            <?php
                            foreach (getGendar() as $key => $value) {
                                ?>
                                <label class="col-xs-5 col-sm-5">
                                    <input name="data[gender]" value="<?php echo $key; ?>" <?php echo set_radio("data[gender]", $key, FALSE); ?> type="radio" class="ace" />
                                    <span class="lbl"> <?php echo $value; ?> </span>
                                </label>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group has-error col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Quota &nbsp; <?php echo form_error('data[quata_id]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[quata_id]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getQuatalist() as $value) {
                                ?>
                                <option value="<?php echo $value['quata_id']; ?>" 
                                        <?php echo set_select("data[quata_id]", $value['quata_id'], FALSE); ?> >
                                            <?php echo $value['quata']; ?>
                                </option> 

                                <?php
                            }
                            ?>

                        </select>
                    </div>
                </div> <!-- /.col-sub-4 -->  
                <div class="col-xs-12 col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Nationality &nbsp; <?php echo form_error('data[nationality]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[nationality]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getCountryName() as $key => $value) {
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
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Blood Group &nbsp; <?php echo form_error('data[bloodGroup]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[bloodGroup]" class="form-control" id="form-field-select-1">
                            <option value="">Select Blood Group </option>
                            <?php
                            foreach (getBloodGroup() as $key => $value) {
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

                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Religion &nbsp; <?php echo form_error('data[religion]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[religion]" class="form-control" id="form-field-select-1">
                            <option value="">Select Religion </option>
                            <?php
                            foreach (getReligion() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[religion]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">National ID &nbsp; <?php echo form_error('data[snId]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="text" class="form-control" id="form-field-1" name="data[snId]"  value="<?php echo set_value("data[snId]"); ?>" placeholder="National ID" />
                    </div>

                </div> <!-- /.col-sub-4 --> 
            </div></div>
            <div class="col-xs-12 col-sm-12">  
                <h3 class="lighter block green">Applicant Contact Information</h3>                                                                
                <div class="hr hr-24"></div>

                <div class="col-xs-12 col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Phone Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[phone]" value="<?php echo set_value("data[phone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                    </div>
                    <div class="form-group col-xs-8 col-sm-8">
                        <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[presentAddress]', '<span class="successMessage">', '</span>'); ?></label>
                        <textarea class="form-control" placeholder="Present Address" name="data[presentAddress]" value="<?php echo set_value("data[presentAddress]"); ?>" type="text" id="form-field-1"></textarea>
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
                        <textarea class="form-control" placeholder="Permanent Address" name="data[permanentAddress]" value="<?php echo set_value("data[permanentAddress]"); ?>" type="text" id="form-field-1"></textarea>
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
                        <input name="data[fatherName]" value="<?php echo set_value("data[fatherName]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Father Name" />
                    </div>
                    <div class="form-group has-error col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Father Mobile &nbsp; <?php echo form_error('data[fatherPhone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[fatherPhone]" value="<?php echo set_value("data[fatherPhone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Father Mobile Number" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Father Profession &nbsp; <?php echo form_error('data[fatherProfession]', '<span class="successMessage">', '</span>'); ?></label>
                        <select  name="data[fatherProfession]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getProfession() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[fatherProfession]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Father National ID &nbsp; <?php echo form_error('data[fnid]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[fnid]" value="<?php echo set_value("data[fnid]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Father National ID" />
                    </div>	


                </div> <!-- /.col-sub-4 -->  
                <div class="col-xs-12 col-sm-4">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group has-error col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother Name &nbsp; <?php echo form_error('data[motherName]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[motherName]" value="<?php echo set_value("data[motherName]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother Name" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother Mobile &nbsp; <?php echo form_error('data[motherPhone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[motherPhone]" value="<?php echo set_value("data[motherPhone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother Mobile Number" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother Profession &nbsp; <?php echo form_error('data[motherProfession]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[motherProfession]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getProfession() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[motherProfession]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>       
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Mother National ID &nbsp; <?php echo form_error('data[mnid]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[mnid]" value="<?php echo set_value("data[mnid]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Mother National ID" />
                    </div>

                </div> 
                <div class="col-xs-12 col-sm-4">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian Name &nbsp; <?php echo form_error('data[legalGardianName]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[legalGardianName]" value="<?php echo set_value("data[legalGardianName]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian Name" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian Mobile &nbsp; <?php echo form_error('data[legalGardianPhone]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[legalGardianPhone]" value="<?php echo set_value("data[legalGardianPhone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian Mobile Number" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian Profession &nbsp; <?php echo form_error('data[legalGardianProfession]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[legalGardianProfession]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getProfession() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[legalGardianProfession]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>
                        </select>
                    </div>   
                    <div class="form-group col-xs-12 col-sm-12">
                        <label class="control-label" for="form-field-1">Legal Guardian National ID &nbsp; <?php echo form_error('data[lgnid]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[lgnid]" value="<?php echo set_value("data[lgnid]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Legal Guardian National ID" />
                    </div>

                </div> 
            </div>   
        

            <div class="col-xs-12 col-sm-12">  
                <h3 class="lighter block green">Previous Academic Information</h3>                                                                
                <div class="hr hr-24"></div>
                <table id="" class="table table-striped table-bordered table-hover">

                    <thead>
                    <td></td>
                    <td valign="top">Roll</td>
                    <td valign="top">Thana/Registration No</td>
                    <td valign="top">Post/Board</td>
                    <td valign="top">GPA</td>
                    <td valign="top">Passing Year</td>
                    </thead>
                    <tbody>

                        <tr>
                            <td>P.S.C.</td>
                    <input  type="hidden" placeholder="Roll" value="1" name="category[]">
                    <td>
                        <input type="text" placeholder="Roll" name="roll[]">
                    </td>
                    <td>
                        <input type="text" placeholder="Thana" name="thana_registration[]">
                    </td>
                    <td>


                        <select name="board[]" class="form-control" id="form-field-select-1">

                            <?php
                            foreach (getBoardInfo() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[board]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>       

                        </select>
                    </td>
                    <td>
                        <input id="psc_gpa" type="text" placeholder="GPA" name="gpa[]">
                    </td>
                    <td>
                        <select id="jsc_passing_year" name="passing_year[]">
                            <option value="">Select</option>
                            <option value="1990">1990</option>                                           
                            <option value="1991">1991</option>                                              
                            <option value="1992">1992</option>                                              
                            <option value="1993">1993</option>                                       
                            <option value="1994">1994</option>                                             
                            <option value="1995">1995</option>                                            
                            <option value="1996">1996</option>                                             
                            <option value="1997">1997</option>                                              
                            <option value="1998">1998</option>                                        
                            <option value="1999">1999</option>                                           
                            <option value="2000">2000</option>                                          
                            <option value="2001">2001</option>                                             
                            <option value="2002">2002</option>                                           
                            <option value="2003">2003</option>                                              
                            <option value="2004">2004</option>                                              
                            <option value="2005">2005</option>                                              
                            <option value="2006">2006</option>                                               
                            <option value="2007">2007</option>                                            
                            <option value="2008">2008</option>                                             
                            <option value="2009">2009</option>                                              
                            <option value="2010">2010</option>                                              
                            <option value="2011">2011</option>                                            
                            <option value="2012">2012</option>                                                
                            <option value="2013">2013</option>                                              
                            <option value="2014">2014</option>                                              
                            <option value="2015">2015</option>                                               
                            <option value="2016">2016</option>                                              
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td>J.S.C.</td>
                    <input value="2"  type="hidden" placeholder="PSC Roll" name="category[]">
                    <td>
                        <input type="text" placeholder="Roll" name="roll[]">
                    </td>
                    <td>
                        <input type="text" placeholder="Registration No" name="thana_registration[]">
                    </td>
                    <td>
                        <select name="board[]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getBoardInfo() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[board]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>       
                        </select>
                    </td>
                    <td>
                        <input id="jsc_gpa" type="text" placeholder="GPA" name="gpa[]">
                    </td>
                    <td>
                        <select id="jsc_passing_year" name="passing_year[]">
                            <option value="">Select</option>
                            <option value="1990">1990</option>                                           
                            <option value="1991">1991</option>                                              
                            <option value="1992">1992</option>                                              
                            <option value="1993">1993</option>                                       
                            <option value="1994">1994</option>                                             
                            <option value="1995">1995</option>                                            
                            <option value="1996">1996</option>                                             
                            <option value="1997">1997</option>                                              
                            <option value="1998">1998</option>                                        
                            <option value="1999">1999</option>                                           
                            <option value="2000">2000</option>                                          
                            <option value="2001">2001</option>                                             
                            <option value="2002">2002</option>                                           
                            <option value="2003">2003</option>                                              
                            <option value="2004">2004</option>                                              
                            <option value="2005">2005</option>                                              
                            <option value="2006">2006</option>                                               
                            <option value="2007">2007</option>                                            
                            <option value="2008">2008</option>                                             
                            <option value="2009">2009</option>                                              
                            <option value="2010">2010</option>                                              
                            <option value="2011">2011</option>                                            
                            <option value="2012">2012</option>                                                
                            <option value="2013">2013</option>                                              
                            <option value="2014">2014</option>                                              
                            <option value="2015">2015</option>                                               
                            <option value="2016">2016</option>                                              
                        </select>
                    </td>
                    </tr>

                    <tr>
                        <td>S.S.C</td>
                    <input value="3"  type="hidden" placeholder="PSC Roll" name="category[]">
                    <td>
                        <input type="text" placeholder="Roll" name="roll[]">
                    </td>
                    <td>
                        <input type="text" placeholder="Registration No"  name="thana_registration[]">
                    </td>
                    <td>
                        <select name="board[]" class="form-control" id="form-field-select-1">
                            <?php
                            foreach (getBoardInfo() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[board]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>       
                        </select>
                    </td>
                    <td>
                        <input type="text" placeholder="GPA" name="gpa[]">
                    </td>
                    <td>
                        <select id="jsc_passing_year" name="passing_year[]">
                            <option value="">Select</option>
                            <option value="1990">1990</option>                                           
                            <option value="1991">1991</option>                                              
                            <option value="1992">1992</option>                                              
                            <option value="1993">1993</option>                                       
                            <option value="1994">1994</option>                                             
                            <option value="1995">1995</option>                                            
                            <option value="1996">1996</option>                                             
                            <option value="1997">1997</option>                                              
                            <option value="1998">1998</option>                                        
                            <option value="1999">1999</option>                                           
                            <option value="2000">2000</option>                                          
                            <option value="2001">2001</option>                                             
                            <option value="2002">2002</option>                                           
                            <option value="2003">2003</option>                                              
                            <option value="2004">2004</option>                                              
                            <option value="2005">2005</option>                                              
                            <option value="2006">2006</option>                                               
                            <option value="2007">2007</option>                                            
                            <option value="2008">2008</option>                                             
                            <option value="2009">2009</option>                                              
                            <option value="2010">2010</option>                                              
                            <option value="2011">2011</option>                                            
                            <option value="2012">2012</option>                                                
                            <option value="2013">2013</option>                                              
                            <option value="2014">2014</option>                                              
                            <option value="2015">2015</option>                                               
                            <option value="2016">2016</option>                                              
                        </select>
                    </td>
                    </tr>

                    <tr>
                        </tbody>
                </table>
                </td>
                </tr>
                </table>
            </div>

      


        
</form>
<?php 	endif ?>
            
            

        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/applicant/insertapplicant" enctype="multipart/form-data" method="post">
       
           
        </form>

    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 


    
    