<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Confirm Student Re-Registration
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Verify Student Promotion Information
            </small>
        </h1>
    </div><!-- /.page-header -->
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-quote-left smaller-80"></i>
                    Student Short Profile
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote class="pull-left">
                                <span class="green">
                                    <i class="ace-icon fa fa-user"></i>&nbsp;
                                    <?php  if (!empty($studentlist['firstName'])) { echo $studentlist['firstName'];} ?>
                                </span>
                                <small>  
                                    Student Id: 
                                    <cite title="Student Id" class="red bolder">  <?php  if (!empty($studentlist['studentId'])) { echo $studentlist['studentId'];} ?> </cite>                                    
                                </small>
                                <small>  
                                    Gender:
                                    <cite title="Student Gender" class="lighter red"> <?php  if (!empty($studentlist['gender'])) { echo element($studentlist['gender'],  getGendar(),Null);} ?> </cite>                                    
                                </small>
                                <small>    
                                    Birth Date:
                                    <cite title="Student Birth Date" class="lighter red"> <?php  if (!empty($studentlist['dateOfBirth'])) { echo $studentlist['dateOfBirth'];} ?> </cite>                                    
                                </small>    
                                  
                               
                            </blockquote>
                            <blockquote class="pull-right">
                              <?php
                                     if ($studentlist['photo']) {
                                  ?>
                                     <img  src="<?php if (file_exists($studentlist['photo'])) { echo base_url() . $studentlist['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60">
                                 <?php 
                                        } 
                                 ?>
                                
                            </blockquote>
                            
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote class="pull-left">
                                 <span class='lighter green bolder'><i class="ace-icon fa fa-book"></i> Current Enrollment Information </span>
                              
                                
                                   <small>        
                                        <span class="red"> Class Level: </span>
                                        <cite title="Class level"> <?php echo element($studentlist['programLevel'], getProgramLevel(), Null); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Class: </span>
                                        <cite title="Class"> <?php echo getProgramName($studentlist['programId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Medium: </span>
                                        <cite title="Class level"> <?php echo getmediumName($studentlist['mediumId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Group: </span>
                                        <cite title="Class level"> <?php echo getGroupName($studentlist['groupId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Shift: </span>
                                        <cite title="Class level"> <?php echo getshiftName($studentlist['shiftId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Section: </span>
                                        <cite title="Class level"> <?php echo getsectionName($studentlist['sectionId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Session: </span>
                                        <cite title="Class level"> <?php echo getSessionName($studentlist['sessionId']); ?> </cite>                                    
                                    </small>
                               
                               
                            </blockquote>
                        
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">       

        <div class="row">
            <div class="col-xs-12">
                <form action="<?php echo admin_Url(); ?>/promotestudent/insertPromotionconfirm" method="post">
                    <input type="hidden" name="data[studentId]" value="<?php echo $studentlist['studentId']; ?>">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                                New Enrollment Information
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main row ">
                              
                                       <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]'); ?></label>
                                                    <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                                        <option value="">Select</option>
                                                        <?php foreach (getOfferedSession() as $value) { ?>
                                                            <option value="<?php echo $value['sessionId']; ?>" >
                                                                <?php echo $value['session']; ?></option>                                                
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]'); ?></label>
                                                    <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId(); " name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]'); ?></label>
                                                    <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]'); ?></label>
                                                    <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]'); ?></label>
                                                    <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]'); ?></label>
                                                    <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]'); ?></label>
                                                    <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                                                    </select>
                                                </div>                                                
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Result Status  &nbsp; <?php echo form_error('data[promotionStatus]'); ?></label>
                                                    <select name="data[promotionStatus]" required class="redtxt">
                                                        <option value="" selected>Select</option>
                                                        <option value="1">Promoted</option>
                                                        <option value="2">Non-Promoted</option>

                                                    </select>
                                                </div>
                                                    

                                            </div> 

                            </div>

                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-danger" name="regConfirm">
                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Confirm Re-Registration
                    </button>
                </form> 
                
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->



