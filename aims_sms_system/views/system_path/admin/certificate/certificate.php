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
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-barcode red"></i>
                            Generate Certificate
                        </h3>

                    </div>
            </div>
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Generate Certificate By Individual Student
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">

                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/Certificate/genrtStudentcertificate" method="post">
                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">StudentId &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <input type="text" name="data[studentId]" required="1" value="<?php echo set_value("data[studentId]"); ?>" class="form-control" id="form-field-1" placeholder="Student Id" />
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[sessionId]" required="1" class="form-control" id="form-field-select-1">
                                                        <option value="">Select</option> 
                                                         <?php foreach (getOfferedSession() as $value) { ?>
                                                            <option value="<?php echo $value['sessionId']; ?>" 
                                                                    <?php echo set_select('data[sessionId]', $value['session'], FALSE) ?> >
                                                                <?php echo $value['session']; ?></option>                                                
                                                        <?php   }    ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Exam &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[semesterId]" class="form-control" id="form-field-select-1">
                                                        <option value="">Select</option>
                                                        <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                                            <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE) ?>>
                                                                <?php echo $velues['semester'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div> 


                                            <div class="col-xs-12">
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-success" name="search" type="submit">
                                                            
                                
                                                           <i class="ace-icon fa fa-search bigger-120"></i>
                                                            Generate Certificate
                                                        </button>
                                                      
                                                    </div>
                                                </div>
                                            </div>        
                                        </form>

                                    </div>    
                                 </div>       
                            </div><!-- /.modal-content -->
                  <!-- PAGE CONTENT ENDS -->
                
                
            </div>    
         
        </div><!-- /.col-x12 -->
        
   