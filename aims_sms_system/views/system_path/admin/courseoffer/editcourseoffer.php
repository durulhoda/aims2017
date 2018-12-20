<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Subject Offer Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Edit Subject Offer
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/courseoffer/updatecourseoffer/<?php echo $editData['offerId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                        <select  name="data[programLevel]" required="1" class="form-control" >
                            <option value=""></option> 
                            <?php
                                foreach (getProgramLevel() as $key => $value) {
                            ?>
                            <option <?php echo ($editData["programLevel"] == $key) ? "selected" : "" ?> value="<?php echo $key; ?>">
                                        <?php echo $value; ?>
                                </option> 

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[programId]" required="1" class="form-control" >
                                   <?php
                                          foreach (ProgramInfoArray() as $value) {
                                    ?>
                                      <option  value="<?php echo $value['programId'] ?>" 
                                        <?php echo ($editData["programId"] == $value['programId']) ? "selected" : ""; ?>>
                                                <?php echo $value['programName'] ?>
                                      </option>
                                    <?php } ?>
                            </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[mediumId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getMediumList() as $value) { ?>
                                <option value="<?php echo $value['mediumId']; ?>" 
                                    <?php echo ($editData["mediumId"] == $value['mediumId']) ? "selected" : ""; ?>>
                                            <?php echo $value['mediumName']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[shiftId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                            <?php foreach (getShiftList() as $value) { ?>
                                <option value="<?php echo $value['shiftId']; ?>" 
                                       <?php echo ($editData["shiftId"] == $value['shiftId']) ? "selected" : ""; ?>>
                                    <?php echo $value['shiftName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[groupId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getGroupInfoArray() as $value) { ?>
                                <option value="<?php echo $value['groupId']; ?>" 
                                       <?php echo ($editData["groupId"] == $value['groupId']) ? "selected" : ""; ?>>
                                    <?php echo $value['groupName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[sectionId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                            <?php foreach (getSectionList() as $value) { ?>
                                <option value="<?php echo $value['sectionId']; ?>" 
                                       <?php echo ($editData["sectionId"] == $value['sectionId']) ? "selected" : ""; ?>>
                                    <?php echo $value['sectionName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[sessionId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getSessionList() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo ($editData["sessionId"] == $value['sessionId']) ? "selected" : ""; ?>>
                                    <?php echo $value['session']; ?></option>                                                
                            <?php   }    ?>
                        </select>
                    </div>
                   <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Teacher  &nbsp; <?php echo form_error('data[employeeId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[employeeId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                            <?php foreach (getTeacherInfoArray() as $valuex) { ?>
                                <option value="<?php echo $valuex['employeeId']; ?>" 
                                       <?php echo ($editData["employeeId"] == $valuex['employeeId']) ? "selected" : ""; ?>>
                                    <?php echo $valuex['firstName'] . " " . $valuex['lastName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div> 
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject Name  &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[courseId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option>                            
                            <?php foreach (getCourseListBYPrglevelId($editData["programLevel"]) as $value) { ?>
                                <option value="<?php echo $value['courseId']; ?>" 
                                        <?php echo ($editData["courseId"] == $value['courseId']) ? "selected" : "" ?> >
                                    <?php echo ($value['courseName']); ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>                   
                    
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject Marks  &nbsp; <?php echo form_error('data[marks]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="text" name="data[marks]" required="1" value="<?php echo $editData['marks']?>" class="form-control" id="form-field-1" placeholder="Subject Marks" />
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Status  &nbsp; <?php echo form_error('data[status]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[status]" required="1" class="form-control" id="form-field-select-1">
                            <option value="1" <?php echo ($editData["status"] == 1) ? "selected" : ""; ?>> Active</option> 
                            <option value="2" <?php echo ($editData["status"] == 2) ? "selected" : ""; ?>> Inactive</option> 
                        </select>
                    </div>    
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                     
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Subject Offer Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        
    
    
    
    
    
    
    
    
    