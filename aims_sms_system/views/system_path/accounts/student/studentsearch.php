<div class="page-content">
    <!-- /Content Section  -->  
    <div style="margin-top: 20px; padding: 3.5px;">                   
        <div class="page-header">
        <h1>
            Student Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Search Student by Enrollment Information
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
        
            <div class="widget-box transparent ">
                    <div class="widget-header widget-header-large">
                        <div class="widget-toolbar pull-left">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                            <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Search Student Information By Individual Student </a>

                        </div>
                   
                         <?php
                            if (!empty($markslist)) {
                        ?> 
                        <div class="pull-right">
                            <form class="form-horizontal" role="form" action="<?php echo acc_Url(); ?>/studentmarks/transcriptView" method="post">
                                <input type="hidden" name="data[semesterId]" value ="<?php if (!empty($semesterId)) { echo $semesterId; } ?>"      />            
                                <input type="hidden" name="data[studentId]" value ="<?php if (!empty($studentId)) { echo $studentId; } ?>"      />            
                                <input type="hidden" name="data[programOfferId]" value ="<?php if (!empty($programOfferId['programOfferId'])) { echo $programOfferId['programOfferId']; } ?>"      />            
                                
                                <button class="btn btn-danger" name="generate" type="submit">
                                    <i class="ace-icon fa fa-search bigger-120"></i>
                                    Transcript Generate
                                </button>
                            </form>    
                        </div>
                            <?php   } ?>
                    </div>
            </div>
            
            
                <div id="modal-table_student" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Search Student Information By Individual Student
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">

                                        <form class="form-horizontal" role="form" action="<?php echo acc_Url(); ?>/student/searchindividualStudent" method="post">
                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">StudentId &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <input type="text" name="data[studentId]" value="<?php echo set_value("data[studentId]"); ?>" class="form-control"  placeholder="Student Id" />
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Student Name &nbsp;</label>
                                                  <input type="text" name="data[firstName]" value="<?php echo set_value("data[firstName]"); ?>" class="form-control" placeholder="Student Name" />
                                               
                                                </div>
                                        
                                                
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Student Phone Number  &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                                                   <input type="text" name="data[phone]" value="<?php echo set_value("data[phone]"); ?>" class="form-control" id="form-field-1" placeholder="Student Phone Number" />
                                               
                                                </div>
                                                
                                                 <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Father Phone Number  &nbsp; <?php echo form_error('data[fatherPhone]', '<span class="successMessage">', '</span>'); ?></label>
                                                   <input type="text" name="data[fatherPhone]" value="<?php echo set_value("data[fatherPhone]"); ?>" class="form-control" id="form-field-1" placeholder="Father Phone Number" />
                                               
                                                </div>

                                            </div> 


                                            <div class="col-xs-12">
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-success" name="search" type="submit">
                                                            <i class="ace-icon fa fa-search bigger-120"></i>
                                                            Search Student Information
                                                        </button>
                                                      
                                                    </div>
                                                </div>
                                            </div>        
                                        </form>

                                    </div>    
                                 </div>       
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                    
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo acc_Url();?>/student/searchRegisteredStudent" enctype="multipart/form-data" method="post">
                
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
                                <?php   }    ?>
                            </select>
                        </div>
                     
                        <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" class="form-control" >

                            </select>
                        </div>
                
                      <div class="col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsectionid" name="data[sectionId]" class="form-control">

                        </select>
                    </div>
                      
                    </div>
         
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-12">
                                <button class="btn btn-success" name="search" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Search Student Information
                                </button>

                            </div>
                        </div>
                    </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 

