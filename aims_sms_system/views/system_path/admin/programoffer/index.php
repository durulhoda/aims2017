<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Class Offer Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add New Class Offer
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/program/insertOfferProgram" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramLevel" onchange="return getClassId(); "  name="data[programLevel]" required="1" class="form-control" >
                             <?php
                                   $data_info=getclasslevelfrominstitute();
                                   $getData = explode(",", trim($data_info["programLevel"]));    
                           foreach ($getData as $value)
                                    {
                                ?>
                                    <option value="<?php echo $value; ?>" >
                                         <?php 
                                             echo element($value,getProgramLevel_institute(), null)  ;
                                         ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getCLAssid" name="data[programId]" required="1" class="form-control" >
                                
                            </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[mediumId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getMediumList() as $values) { ?>
                                <option value="<?php echo $values['mediumId']; ?>" 
                                        <?php echo set_select('data[mediumId]', $values['mediumId'], FALSE) ?>>
                                            <?php echo $values['mediumName']; ?>
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
                                        <?php echo set_select('data[shiftId]', $value['shiftId'], FALSE) ?> >
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
                                        <?php echo set_select('data[groupId]', $value['groupId'], FALSE) ?> >
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
                                        <?php echo set_select('data[sectionId]', $value['sectionId'], FALSE) ?> >
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
                                        <?php echo set_select('data[sessionId]', $value['session'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php   }    ?>
                        </select>
                    </div>
                   <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Form Master  &nbsp; <?php echo form_error('data[employeeId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[employeeId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                            <?php foreach (getTeacherInfoArray() as $value) { ?>
                                <option value="<?php echo $value['employeeId']; ?>" 
                                        <?php echo set_select('data[employeeId]', $value['employeeId'], FALSE) ?> >
                                    <?php echo $value['firstName'] . " " . $value['lastName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                   
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Total Seat  &nbsp; <?php echo form_error('data[applicantSeat]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="text" name="data[applicantSeat]" required="1" value="<?php echo set_value("data[applicantSeat]"); ?>" class="form-control" id="form-field-1" placeholder="Total Seat" />
                    </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <input type="hidden" name="data[classStatus]" value="1">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Add New Class Offer
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        