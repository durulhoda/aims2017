<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            All Position Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add New Position
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/designation/updatedesignation/<?php echo $editData['dsgId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    
                                           <div class="has-error col-xs-12 col-sm-4">
                        <label class="control-label" for="form-field-1">Employee Type &nbsp; <?php echo form_error('data[employeeType]', '<span class="successMessage">', '</span>'); ?></label>

                        <select id="getemployeeid" onchange="return getemployeetype();" name="data[employeetypeId]" class="form-control" id="form-field-select-1">
                            <option value="">Select</option>>
                            <?php
                            foreach (getmployeetypeList() as $key => $value) {
                                ?>
                       
                                
                                 <option value="<?php echo $key; ?>" 
                                            <?php echo ($editData["employeetypeId"] == $key) ? "Selected" : ""; ?> >
                                                <?php echo $value; ?>
                                    </option> 

                                <?php
                            }
                            ?>
                        </select>

                    </div>
                    
                    
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">New Position &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                             <select name="data[designation]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getdesignation() as $key=>$value)
                                    {                                    
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo ($editData["designation"] == $key) ? "Selected" : ""; ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                  
                                    }
                                ?>
                            </select>        
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Number of Position &nbsp; <?php echo form_error('data[candidate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[candidate]" required="1" value="<?php if(!empty($editData['candidate'])){ echo $editData['candidate']; } ?>" class="form-control" id="form-field-1" placeholder="Total Seat" />
                    </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Position Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        