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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/examroutine/searchlist" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                       <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getsessionid" onchange="return getOfferedSessionId();" data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                        <option value="">Select</option>
                        <?php foreach (getOfferedSession() as $value) { ?>
                            <option value="<?php echo $value['sessionId']; ?>" 
                                    <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                <?php echo $value['session']; ?></option>                                                
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">

                    </select>
                </div> 
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getprogramid" onchange="return getOfferedprogramId();" name="data[programId]" required="1" class="form-control">

                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getmediumid" onchange="return getOfferedmediumId();" name="data[mediumId]" required="1" class="form-control">
                        
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getshiftid" onchange="return getOfferedshiftId();" name="data[shiftId]" required="1" class="form-control" >

                    </select>
                </div>
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getgroupidd" name="data[groupIdd]" required="1" class="form-control">
                            <option value="">Select</option>
                            <?php if ($group_list) :
                            foreach( $group_list as $row) :
                             ?>
                            <option value="<?php echo $row->groupId; ?>"><?php echo $row->groupName; ?></option>
                            <?php endforeach;endif; ?>

                    </select>
                </div>
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                    </select>
                </div>

                <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[semestertype]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsemestertype"  name="data[semestertype]" required="1" class="form-control">
                            <option value="0">Select</option>
                            <?php foreach($semestertype as $semestertype){?>
                            <option value="<?php echo $semestertype['semesterId'];?>"><?php echo $semestertype['semester'];?></option>
                            <?php }?>

                        </select>
                    </div>

                      <!-- <div class="col-xs-10 col-sm-4">
                        
                                            <label class="control-label" for="form-field-1">Exam Name  &nbsp; <?php echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[examname]" class="form-control" id="form-field-select-1">
                                                       <option value="">Select </option>
                                                            <?php foreach(getExamList() as $velues){?>
                                                             <option value="<?php echo $velues['examtypeId'];?>" <?php echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE)?>><?php echo $velues['examtypeName']?></option>
                                                             <?php }?>

                                                    </select>


                    </div> -->
                    
                
                     
                                       
               
                            
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Search Exam Routine Data
                            </button>
                           

                        </div>
                    </div>
                </div>        
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    





