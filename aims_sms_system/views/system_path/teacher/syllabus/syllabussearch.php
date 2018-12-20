<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Syllabus Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Search Syllabus Information
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
            <form class="form-horizontal" role="form" action="<?php echo teacher_Url();?>/syllabus/searchsyllabuslist" method="post">
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
                        <select id="getprogramid" onchange="return getOfferedprogramId_Subjectid_byEMP(); " name="data[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getSubjectid" name="data[courseId]" required="1" class="form-control" id="form-field-select-1">
                            
                        </select>
                    </div>
                            
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Search Syllabus Information
                            </button>
                          

                        </div>
                    </div>
                </div>        
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
       </div>
        </div>
    </div>