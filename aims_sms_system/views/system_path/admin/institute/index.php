<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Institute Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/institute/insertinstitute" method="post" enctype="multipart/form-data">
                <h3 class="lighter block green">Add Institute information</h3>
                 <div class="hr hr-24"></div>
                 
                 <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-10 col-sm-6">   
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">School/College/Institute Type &nbsp; <?php echo form_error('data[instituteName]', '<span class="successMessage">', '</span>'); ?></label>
                          
                            <select name="data[instituteType]" class="form-control" >
                                <option value=""></option> 
                                <?php
                                foreach (getinstituteType() as $key => $value) {
                                    ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[instituteType]", $key, FALSE); ?> >
                                            <?php echo $value; ?>
                                    </option> 

                                    <?php
                                }
                                ?>
                            </select> 
                        </div>                        
                    </div>
                    <div class="col-xs-10 col-sm-6">   
                       <div class="form-group col-xs-8 col-sm-8">
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="bigger-110">Class Level &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></span>
                           
                             <select name="data[programLevel][]" multiple="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose Class Level...">
                                <option value=""></option> 
                                <?php
                                    foreach(getProgramLevel_institute() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[programLevel][]", $key, FALSE); ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                    </div>
                        </div>
                   
                    </div>   
                </div> 
                 
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-10 col-sm-6">   
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Institute Name &nbsp; <?php echo form_error('data[instituteName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" type="text" name="data[instituteName]" value="<?php echo set_value("data[instituteName]"); ?>" class="form-control" id="form-field-1" placeholder="Institute Name" />
                        </div>                        
                    </div>
                    <div class="col-xs-10 col-sm-6">   
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Institute Logo &nbsp; <?php echo form_error('logo', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="logo" value="<?php echo set_value("logo"); ?>" type="file" id="id-input-file-2" />
                            <span class="middle red">Logo size(200*200)- Format(png/jpg)</span>
                        </div>
                    </div>  
                </div> 
                
                <div class="col-xs-12 col-sm-12">  
                       
                    <div class="col-xs-10 col-sm-6">    
                        <div class="form-group has-error col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Institute EIN &nbsp; <?php echo form_error('data[Ein]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" class="form-control" placeholder="Institute EIN" name="data[Ein]" value="<?php echo set_value("data[Ein]"); ?>" type="text" id="form-field-2" />
                        </div>
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Town/Village &nbsp; <?php echo form_error('data[town]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="form-control" placeholder="Town/Village" name="data[town]" value="<?php echo set_value("data[town]"); ?>" type="text" id="form-field-1" />
                        </div>
                        
                             
                           <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">District &nbsp; <?php echo form_error('data[district]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getdistrictid" onchange="return getdistrict(); " data-placeholder="Select" name="data[district]"  required="1" class="form-control">
                                <option value="">Select</option> 
                                <?php
                                    foreach(getDistrictName() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[district]", $key, FALSE); ?> >
                                                <?php echo $value; ?>
                                        
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                              
                            </select>
                        </div>
                        
                        
                            <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Email &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="form-control" placeholder="Email" name="data[email]" value="<?php echo set_value("data[email]"); ?>" type="text" id="form-field-2" />
                        </div>	
                        
                

                    </div> <!-- /.col-sub-4 -->  
                    <div class="col-xs-10 col-sm-6">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Contact Person &nbsp; <?php echo form_error('data[personName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="form-control" placeholder="Contact Person" name="data[personName]" value="<?php echo set_value("data[personName]"); ?>" type="text" id="form-field-2" />
                        </div>	
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Phone Number &nbsp; <?php echo form_error('data[personPhone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input class="form-control" placeholder="Phone Number" name="data[personPhone]" value="<?php echo set_value("data[personPhone]"); ?>" type="text" id="form-field-2" />
                        </div>	

                         <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">City/Thana &nbsp; <?php echo form_error('data[city]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select id="getUpozila" onchange="return getUpozila(); " name="data[city]" data-placeholder="Select" required="1" class="form-control">

                            </select>
                         </div>
                        
                        <div class="form-group col-xs-8 col-sm-8">
                            <label class="control-label" for="form-field-1">Board Name &nbsp; <?php echo form_error('data[boardId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[boardId]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getBoardInfo() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[boardId]", $key, FALSE); ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                    </div> <!-- /.col-sub-4 --> 
                </div>
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Insert Institute Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 