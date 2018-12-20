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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/classroutine/updateclassroutine/<?php echo $editclassroutine['routineId'];?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                          <select name="data[sessionId]" class="form-control">
                                                <option value="">Select</option>
                                                <?php foreach (getOfferedSession() as $value) { ?>
                                                    <option value="<?php echo $value['sessionId']; ?>" 
                                                            <?php echo ($programOfferId["sessionId"] == $value['sessionId']) ? "selected" : "" ?> >
                                                        <?php echo $value['session']; ?></option>                                                
                                                <?php } ?>
                                            </select> 
                                       
                    </div>

                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                      <select name="data[programId]" class="form-control">
                                                 <option value="" selected>Select</option>
                                                <?php
                                                //                                print_r(ProgramInfoArray()); exit;
                                                foreach (getOfferedProgram() as $value) {
                                                    ?>
                                                    <option  value="<?php echo $value['programId'] ?>" 
                                        <?php echo ($programOfferId["programId"] == $value['programId']) ? "selected" : ""; ?>>
                                                <?php echo getProgramName($value['programId']); ?></option>
                                            <?php } ?>
                                            </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="red">', '</span>'); ?></label>
           
                         <select name="data[mediumId]" class="form-control">
                                                <option value="">Select</option>
                                            <?php foreach (getOfferedMedium() as $value) { ?>
                                                    <option value="<?php echo $value['mediumId']; ?>" 
                                                <?php echo ($programOfferId["mediumId"] == $value['mediumId']) ? "selected" : "" ?> >
                                                    <?php echo getmediumName($value['mediumId']); ?></option>                                                      
                                                <?php } ?>
                                            </select> 
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="red">', '</span>'); ?></label>
                           <select name="data[groupId]" class="form-control">
                                                <option value="" selected="selected">Select</option>
                                                <?php foreach (getOfferedGroup() as $value) { ?>
                                                    <option value="<?php echo $value['groupId']; ?>" 
                                                            <?php echo ($programOfferId["groupId"] == $value['groupId']) ? "selected" : "" ?> >
                                                        <?php echo getGroupName($value['groupId']); ?></option>                                                    
                                                <?php } ?>
                                            </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="red">', '</span>'); ?></label>
                      <select name="data[shiftId]" class="form-control">
                                                     <option value="" selected="selected">Select</option>
                                                         <?php foreach (getOfferedShift() as $value) { ?>
                                                          <option value="<?php echo $value['shiftId']; ?>" 
                                                        <?php echo ($programOfferId["shiftId"] == $value['shiftId']) ? "selected" : "" ?> >
                                                 <?php echo getshiftName($value['shiftId']); ?></option>                                              
                                            <?php } ?>
                                            </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="red">', '</span>'); ?></label>
                      <select name="data[sectionId]" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSection() as $value) { ?>
                                <option value="<?php echo $value['sectionId']; ?>" 
                                        <?php echo ($programOfferId["sectionId"] == $value['sectionId']) ? "selected" : "" ?> >
                                    <?php echo getsectionName($value['sectionId']); ?></option>                                              
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[courseId]" class="form-control">
                                        <option value="" selected="selected">Select</option>
                                        <?php 

                                        foreach (getCourseListBYPrglevelId($programOfferId["programLevel"]) as $value) { ?>
                                            <option <?php echo ($editclassroutine['courseId']== $value['courseId'])? "selected":""; ?> 
                                                value="<?php echo $value['courseId'] ?>">
                                                <?php echo getCourseName($value['courseId']); ?></option>
                                                                                           
                                        <?php } ?>
                                    </select>
                    </div>

                      <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Day  &nbsp; <?php echo form_error('data[dayName]', '<span class="red">', '</span>'); ?></label>
                    
                          <select name="data[dayName]" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach (getDay() as $key => $value) { ?>
                                            <option <?php echo ($editclassroutine['dayName']== $key)? "selected":""; ?> 
                                                value="<?php echo $key ?>">
                                                <?php echo $value ?></option>
                                                                                          
                                        <?php } ?>
                                    </select> 

                    </div>

                      <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Period  &nbsp; <?php echo form_error('data[periodId]', '<span class="red">', '</span>'); ?></label>
                       <select name="data[periodId]" class="form-control">
                                        <option value="" selected="selected">Select</option>
                                        <?php foreach ($periodlist as $key => $val) { ?>
                                           <?php if (!$val['is_break_time']) : ?>
                                            <option value="<?php echo $val['periodId']; ?>" 
                                                    <?php echo ($editclassroutine["periodId"] == $val['periodId']) ? "selected" : "" ?> >
                                                <?php echo $val['periodName']."(".$val['periodTime'].")"; ?></option>                                                
                                        <?php endif; } ?>
                                      
                                    </select>
                    </div>
                     
                                       
               
                            
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Update Class Routine Information
                            </button>
                           

                        </div>
                    </div>
                </div>        
            </form>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    


