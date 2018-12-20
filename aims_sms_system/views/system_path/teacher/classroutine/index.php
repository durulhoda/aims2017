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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/classroutine/saveclassroutine" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
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
                        <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="red">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="red">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="red">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="red">', '</span>'); ?></label>
                        <select id="getsectionid" onchange="return getOfferedsectionId(); " name="data[sectionId]" required="1" class="form-control" >
                            
                        </select>
                    </div>

                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid"  data-placeholder="Select" name="data[courseId]"  class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedCourseInfoArray() as $value) { ?>
                                <option value="<?php echo $value['courseId']; ?>" 
                                        <?php echo set_select('data[courseId]', $value['courseId'], FALSE) ?> >
                                    <?php echo $value['courseName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>

                      <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Day  &nbsp; <?php echo form_error('data[dayName]', '<span class="red">', '</span>'); ?></label>
                    
                          <select data-placeholder="Select" name="data[dayName]"  required="1" class="form-control">
                            <option value="">Select</option>
                             <?php foreach (getDay() as $value) { ?>
                                <option value="<?php echo $value ?>" 
                                        <?php echo set_select('data[dayName]', $value, FALSE) ?> >
                                    <?php echo $value ?></option>                                                
                            <?php   }    ?>
                        </select>


                    </div>

                      <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Period  &nbsp; <?php echo form_error('data[periodId]', '<span class="red">', '</span>'); ?></label>
                       
                         <select  data-placeholder="Select" name="data[periodId]"  required="1" class="form-control">
                            <option value="">Select</option>
                             <?php foreach (getlistPeriod() as $value) { ?>
                                <option value="<?php echo $value['periodId']; ?>" 
                                        <?php echo set_select('data[periodId]', $value['periodId'], FALSE) ?> >
                                    <?php echo $value['periodName']; ?></option>                                                
                            <?php   }    ?>
                        </select>
                    </div>
                     
                                       
               
                            
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Insert Class Routine Information
                            </button>
                           

                        </div>
                    </div>
                </div>        
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    


