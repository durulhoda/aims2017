<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Setup Routine
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Routine Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/examroutine/insertexamroutine" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="datax[sessionId]"  required="1" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>

                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" onchange="return getOfferedprogramId_Subjectid(); " name="datax[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="red">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="datax[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="red">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="datax[groupId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="red">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="datax[shiftId]" required="1" class="form-control" >
                           
                        </select>
                    </div>
                 

                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getSubjectid"  data-placeholder="Select" name="data[courseId]"  class="form-control">

                        </select>
                    </div>

                      <div class="col-xs-10 col-sm-4">
                        
                                            <label class="control-label" for="form-field-1">Exam Name  &nbsp; <?php echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[examname]" class="form-control" id="form-field-select-1">
                                                       <option value="">Select </option>
                                                            <?php foreach(getExamList() as $velues){?>
                                                             <option value="<?php echo $velues['examtypeId'];?>" <?php echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE)?>><?php echo $velues['examtypeName']?></option>
                                                             <?php }?>

                                                    </select>


                    </div>
                    
                       <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Date  &nbsp; <?php echo form_error('data[date]', '<span class="red">', '</span>'); ?></label>
                    
                        <div class="input-group input-group-sm">
                            <input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="data[date]">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>


                    </div>

                      <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Time  &nbsp; <?php echo form_error('data[examtime]', '<span class="red">', '</span>'); ?></label>
                       <input id="form-field-1" class="form-control" type="text" placeholder="Exam Time" value="" name="data[examtime]">
                    </div>
                    
                       <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Room Number &nbsp; <?php echo form_error('data[room]', '<span class="red">', '</span>'); ?></label>
                       
                       <input id="form-field-1" class="form-control" type="text" placeholder="Room Number" value="" name="data[room]">
                    </div>
                     
                                       
               
                            
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Insert Exam Routine Information
                            </button>
                           

                        </div>
                    </div>
                </div>        
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    



