
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Applicant Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Search Applicant by Enrollment Information
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
  
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/applicant/applicantlist" enctype="multipart/form-data" method="post">
                
                   <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="datax[sessionId]"   class="form-control">
                                <option value="">Select</option>
                                 <?php foreach (getOfferedSession() as $value) { ?>
                                    <option value="<?php echo $value['sessionId']; ?>" 
                                            <?php echo set_select('datax[sessionId]', $value['sessionId'], FALSE) ?> >
                                        <?php echo $value['session']; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                        <div class="  col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('datax[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId(); " name="datax[programLevel]" data-placeholder="Select" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getprogramid" onchange="return getOfferedprogramId(); " name="datax[programId]" class="form-control">

                                </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getmediumid" onchange="return getOfferedmediumId(); " name="datax[mediumId]" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getshiftid" onchange="return getOfferedshiftId(); " name="datax[shiftId]" class="form-control" >

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getgroupid" onchange="return getOfferedgroupId(); " name="datax[groupId]" class="form-control">

                            </select>
                        </div>
                      
                    </div>
         
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-12">
                                <button class="btn btn-success" name="search" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Search Applicant Information
                                </button>

                            </div>
                        </div>
                    </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 