<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Time Period Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add New Time Period
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" action="<?php echo admin_Url(); ?>/period/updateperiod/<?php echo $editData['periodId'] ?>" method="POST">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Period &nbsp; <?php echo form_error('data[periodName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[periodName]" required="1" value="<?php echo $editData['periodName']; ?>" class="form-control" id="form-field-1" placeholder="Period Name" />
                                
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Time &nbsp; <?php echo form_error('data[periodTime]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[periodTime]" required="1" value="<?php echo $editData['periodTime']; ?>" class="form-control" id="form-field-1" placeholder="Period Time" />
                                
                    </div>
                    
                    <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select required="1" class="form-control" id="form-field-select-1" name="data[shiftId]">
                                <option value="">Select Shift</option> 
                                 
                                    
                                <?php foreach (getShiftList() as  $value) { ?>
                                                   <option value="<?php echo $value['shiftId']; ?>" 
                                                    <?php echo ($editData['shiftId'] == $value['shiftId']) ? "Selected" : ""; ?> >        

                                                <?php echo $value['shiftName']; ?>
                                                   </option>                                                
                                                                          
                                             <?php } ?>
                            </select>
                            
                        </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Period
                            </button>

                        </div>
                    </div>
                </div>        
            </form>