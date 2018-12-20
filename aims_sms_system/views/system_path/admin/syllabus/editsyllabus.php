<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            
         Add Syllabus Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Syllabus Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url() ?>/syllabus/updatesyllabus/<?php echo $editData['syllabusId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        
                          <select name="datax[sessionId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo ($programinfo["sessionId"] == $value['sessionId']) ? "selected" : ""; ?>>
                                    <?php echo $value['session']; ?></option>                                                
                            <?php   }    ?>
                        </select>
                    </div>

                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                       
                         <select name="datax[programId]" required="1" class="form-control" >
                                   <?php
                                          foreach (ProgramInfoArray() as $value) {
                                    ?>
                                      <option  value="<?php echo $value['programId'] ?>" 
                                        <?php echo ($programinfo["programId"] == $value['programId']) ? "selected" : ""; ?>>
                                                <?php echo $value['programName'] ?>
                                      </option>
                                    <?php } ?>
                            </select>
                      
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                          <select name="datax[mediumId]" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach (getOfferedMedium() as $value) { ?>
                                            <option value="<?php echo $value['mediumId']; ?>" 
                                                    <?php echo ($programinfo["mediumId"] == $value['mediumId']) ? "selected" : "" ?> >
                                                    <?php echo getmediumName($value['mediumId']); ?></option>                                                      
                                            <?php } ?>
                                    </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="datax[shiftId]" class="form-control">
                                        <option value="" selected="selected">Select</option>
                                        <?php foreach (getOfferedShift() as $value) { ?>
                                            <option value="<?php echo $value['shiftId']; ?>" 
                                                    <?php echo ($programinfo["shiftId"] == $value['shiftId']) ? "selected" : "" ?> >
                                                    <?php echo getshiftName($value['shiftId']); ?></option>                                              
                                            <?php } ?>
                                    </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                         <select name="datax[groupId]" class="form-control">
                                        <option value="" selected="selected">Select</option>
                                        <?php foreach (getOfferedGroup() as $value) { ?>
                                            <option value="<?php echo $value['groupId']; ?>" 
                                                    <?php echo ($programinfo["groupId"] == $value['groupId']) ? "selected" : "" ?> >
                                                    <?php echo getGroupName($value['groupId']); ?></option>                                                    
                                            <?php } ?>
                                    </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('datax[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                         <select name="datax[sectionId]" class="form-control">
                                                
                                                <?php foreach (getOfferedSection() as  $value) { ?>
                                                    <option value="<?php echo $value['sectionId']; ?>" 
                                                            <?php echo ($programinfo["sectionId"] == $value['sectionId']) ? "selected" : "" ?> >
                                                            <?php echo getsectionName($value['sectionId']); ?></option>                                                
                                                    <?php } ?>
                                            </select>
                    </div>
                   <div class="col-xs-10 col-sm-4">
                        <h4  for="form-field-1">Subject Name
                            
                                        <?php foreach (getCourseList() as $value) { 
                                                  
                                                  if($editData["courseId"] == $value['courseId']){ echo $value['courseName']; } 

                                                } 
                                         ?>
                        </h4>
                    </div>
                             
                </div> 
                   <br><br>
                <div class="col-xs-12 ">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Syllabus Details :</h4>


                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div>


                                    <textarea style="height:200px" class="form-control" name="data[syllabus]" value="<?php echo set_value('data[syllabus]') ?>"> <?php echo $editData["syllabus"]; ?> </textarea>
                                </div>

                            </div>
                        </div>
                    </div>     
                </div> 
                
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="save" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Update Syllabus Information
                            </button>
                            

                        </div>
                    </div>
                </div>        
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    

