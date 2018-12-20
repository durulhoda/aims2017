<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Governing Body
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Search Governing Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/GoverningBody/governsearch" method="post" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->                      
                
                  
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Employee Type &nbsp; <?php echo form_error('data[memberTypeId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[memberTypeId]" class="form-control" id="form-field-select-1">
                                    <option value="">Select</option>
                                <?php
                                    foreach(getmployeetypeList() as $key =>$value)
                                    {
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
                             <label class="control-label" for="form-field-1">Designation &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[designation]" class="form-control" id="form-field-select-1">
                                      <option value="">Select</option>
                                <?php
                                    foreach(getDesignationArray() as $value)
                                    {
                                       $position= $value['candidate']-CountEmployeeByPosition($value['designation']);
                                       if($value['candidate']>=$position){
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
                    <label class="control-label" for="form-field-1">Member Status &nbsp; <?php echo form_error('data[employmentStatus]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[employmentStatus]" class="form-control" id="form-field-select-1">
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
            
                    </div>
                    
                    
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-110"></i> Search Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 