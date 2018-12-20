<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Edit Shift Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Update Shift
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/shift/updateshift/<?php echo $editData['shiftId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Session Name &nbsp; <?php echo form_error('data[shiftName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[shiftName]" required="1" value="<?php if(!empty($editData['shiftName'])){ echo $editData['shiftName']; } ?>" class="form-control" id="form-field-1" placeholder="Shift Name" />
                                
                    </div>

                    <div class="has-error col-xs-3 col-sm-2">   
                            <label class="control-label" for="form-field-1">Start Time &nbsp; <?php echo form_error('data[startTime]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" id="timepicker1" name="data[startTime]" required="1" value="<?php echo date('h:i:a', strtotime($editData['startTime'])); ?>" class="form-control" id="form-field-1" placeholder="Start Time" />
                                
                    </div>
                    <div class="has-error col-xs-3 col-sm-2">   
                            <label class="control-label" for="form-field-1">End Time &nbsp; <?php echo form_error('data[endTime]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[endTime]" id="timepicker2" required="1" value="<?php echo date('h:i:a', strtotime($editData['endTime'])); ?>" class="form-control" id="form-field-1" placeholder="End Time" />
                                
                    </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Shift Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        