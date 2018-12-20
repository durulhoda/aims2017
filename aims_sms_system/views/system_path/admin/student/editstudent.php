<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
           Edit Student Form
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
            
              <div id="modal-wizard" class="modal">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <form action="<?php echo admin_Url();?>/student/updatestudent_photo" method="post" enctype="multipart/form-data">
                            <div id="modal-wizard-container">
                                <div class="modal-header">
                                    <div class="alert alert-block alert-success center">
                                       <i class="ace-icon fa fa-image green"></i>
                                       Update Image
                                   </div>
                                </div>

                                <div class="modal-body step-content">
                                    <div class="step-pane active">
                                        <div class="center">
                                            <input type="hidden" name="applicationId" value="<?php echo $editData["applicationId"]; ?>">
                                               <input name="photo" value="<?php echo set_value("photo"); ?>" type="file" id="id-input-file-2" />
                                             <span class="middle pink">>> </span><br>
                                             <span class="middle red">Maintain Image size with- Format (png/jpg/gif)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer wizard-actions">
                                
                                <button name="btnSubmit" class="btn btn-success btn-sm btn-next" data-last="Finish">
                                    Update Image
                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                    
                                </button>

                                <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cancel
                                </button>
                            </div>
                          </form>    
                     </div>
                 </div>
             </div><!-- Modals CONTENT ENDS -->
             
            
                 <div class="widget-header widget-header-large">
                    <h3 class="widget-title grey lighter">
                        <i class="ace-icon fa fa-exchange green"></i>
                       Student Personal Information
                    </h3>
                    <div class="widget-toolbar">
                        
                        
                   <a href="#modal-wizard" data-toggle="modal" class="btn btn-success"> 
                <i class="ace-icon fa fa-pencil align-top bigger-125"></i>
                Update Photo
            </a>
                    
                    </div>
               
                </div>
                
            
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/student/updateStudent/<?php echo $editData['applicationId']?>" enctype="multipart/form-data" method="post">
              
                <div class="hr hr-24"></div>
                <div class="col-xs-12 col-sm-12">  
                    <div class="col-xs-12 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Student Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[firstName]" value="<?php echo $editData["firstName"]; ?>" required class="form-control" id="form-field-1" placeholder="Student Name" />
                        </div>
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[dateOfBirth]" value="<?php echo $editData["dateOfBirth"]; ?>" class="form-control" id="form-field-1" placeholder="Date of Birth" />
                        </div>
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[sbreg]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[sbreg]" value="<?php echo $editData["sbreg"]; ?>" class="form-control" id="form-field-1" placeholder="Birth Registration Number" />
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
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Quota &nbsp; <?php echo form_error('data[quata_id]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[quata_id]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getQuatalist() as $value)
                                    {
                                ?>
                                    <option value="<?php echo $value['quata_id']; ?>" 
                                           <?php echo ($editData["quata_id"] == $value['quata_id']) ? "Selected" : ""; ?> >
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
                    <h3 class="lighter block green">Student Contact Information</h3>                                                                
                    <div class="hr hr-24"></div>

                    <div class="col-xs-12 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Phone Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[phone]" value="<?php echo $editData["phone"];?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                        </div>
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[presentAddress]', '<span class="successMessage">', '</span>'); ?></label>
                            <textarea class="form-control" placeholder="Present Address" name="data[presentAddress]"  type="text" id="form-field-1"><?php echo $editData["presentAddress"]; ?></textarea>
                        </div>
                        

                    </div> <!-- /.col-sub-4 -->  
                    <div class="col-xs-12 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Email &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="form-control" placeholder="Email" name="data[email]" value="<?php echo $editData["email"]; ?>" type="text" id="form-field-1" />
                        </div>
                        
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Permanent Address &nbsp; <?php echo form_error('data[permanentAddress]', '<span class="successMessage">', '</span>'); ?></label>
                            <textarea class="form-control" placeholder="Permanent Address" name="data[permanentAddress]" type="text" id="form-field-1"><?php echo $editData["permanentAddress"]; ?></textarea>
                        </div>      

                    </div> 
                </div>     
                <div class="col-xs-12 col-sm-12">  
                    <h3 class="lighter block green">Student Guardian Information</h3>                                                                
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
                        <?php foreach($prev_info as $key => $val) : ?>

                        <tr>
                            <td><?php
                                if ($val->category == 1) :
                                    echo "P.S.C.";
                                elseif ($val->category == 2):
                                    echo "J.S.C.";
                                elseif ($val->category == 3) :
                                    echo "S.S.C.";
                                endif;
                             ?></td>
                    <input  type="hidden" placeholder="Roll" value="<?php echo $val->category; ?>" name="category[]">
                    <td>
                        <input type="text" value="<?php echo $val->roll; ?>" placeholder="Roll" name="roll[]">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $val->thana_registration; ?>" placeholder="<?php echo ($val->category == 1) ? "Thana" : "Registration No"; ?>" name="thana_registration[]">
                    </td>
                    <td>


                        <select name="board[]" class="form-control" id="form-field-select-1">

                            <?php
                            foreach (getBoardInfo() as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>" <?php echo ($val->board == $key) ? "selected" : ""; ?>
                                        <?php echo set_select("data[board]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                </option> 

                                <?php
                            }
                            ?>       

                        </select>
                    </td>
                    <td>
                        <input id="psc_gpa" type="text" value="<?php echo $val->gpa; ?>" placeholder="GPA" name="gpa[]">
                    </td>
                    <td>
                        <select id="jsc_passing_year" name="passing_year[]">
                            <option value="">Select</option>
                            <?php for ($i=1990; $i <= 2016; $i++) :?>
                                <option value="<?php echo $i; ?>" <?php echo (trim($val->passing_year) == $i) ? "selected" : ""; ?>><?php echo $i; ?></option>    
                            <?php endfor; ?>                                           
                        </select>
                    </td>
                    </tr>
                   
                <?php endforeach; ?>
                    <tr>
                        </tbody>
                </table>
                </td>
                </tr>
                </table>
            </div> <!---End Previous Academic Information --> 
              
                
           


                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Student Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 