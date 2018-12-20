<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Edit Class Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Update Class
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/program/updateprogram/<?php echo $editData['programId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                     <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Class ID &nbsp; <?php echo form_error('data[classId]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[classId]" required="1" value="<?php if(!empty($editData['classId'])){ echo $editData['classId']; } ?>" class="form-control" id="form-field-1" placeholder="Class ID" />
                                
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Class Name &nbsp; <?php echo form_error('data[programName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[programName]" required="1" value="<?php if(!empty($editData['programName'])){ echo $editData['programName']; } ?>" class="form-control" id="form-field-1" placeholder="Class Name" />
                                
                    </div>
                    
                    <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[programLevel]" required="1" class="form-control" id="form-field-select-1">
                            
                                <?php
                                  $data_info=getclasslevelfrominstitute();
                                   $getData = explode(",", trim($data_info["programLevel"]));    
                           foreach ($getData as $value)
                                    {
                                ?>
                                    <option value="<?php echo $value; ?>" <?php echo ($editData["programLevel"] == $value) ? "selected" : "" ?> >
                                     
                                        <?php echo element($value,getProgramLevel_institute(), null); ?>
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
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Class Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        