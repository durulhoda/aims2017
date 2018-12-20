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
        
        <?php
                if (!empty($applicantlist)) {
            ?>
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                            All Applicant Information
                        </h3>

                        

                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-print"></i>
                                <a href="<?php echo base_url('systemaccess/applicant/printAppliacnrList/'.$enrollData['programOfferId']); ?>" role="button" class="green" > Print Applicant List </a>
                                
                            
                        </div>
                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                                <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Again </a>
                            
                        </div>
                    </div>
                <div id="modal-table" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Search Again Applicant List By Enrollment Information
                                    </div>
                                </div>
                                
                                    <div class="modal-body no-padding">
                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/applicant/applicantlist" enctype="multipart/form-data" method="post">

                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="datax[sessionId]"  required="1" class="form-control">
                                                        <option value="">Select</option>
                                                        <?php foreach (getOfferedSession() as $value) { ?>
                                                            <option value="<?php echo $value['sessionId']; ?>" >
                                                                <?php echo $value['session']; ?></option>                                                
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="  col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('datax[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId(); " name="datax[programLevel]" data-placeholder="Select" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getprogramid" onchange="return getOfferedprogramId(); " name="datax[programId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getmediumid" onchange="return getOfferedmediumId(); " name="datax[mediumId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getgroupid" onchange="return getOfferedgroupId(); " name="datax[groupId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getshiftid" onchange="return getOfferedshiftId(); " name="datax[shiftId]" required="1" class="form-control" >

                                                    </select>
                                                </div>

                                            </div>   
                                            
                                            
                                            
                                            <div class="modal-footer no-margin-top">
                                                <div class="space"></div>
                                                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                                                    <i class="ace-icon fa fa-times"></i>
                                                    Close
                                                </button>
                                                <button class="btn btn-success pull-right" name="search" type="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i> Search Applicant Information
                                                </button>
                                            </div>
                                        </form> 
                                    </div>

                                    
                                    
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                <div class="row">
                    
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b> Enrollment Information</b>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                            <?php 
                                                       echo "<b>".getSessionName($sessionId)."</b>";                                                

                                              ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Class Level: 
                                                <?php
                                                foreach (getProgramLevel() as $key =>$value) {
                                                    if ($programLevel == $key) {
                                                        echo "<b>" . $value . "</b>";
                                                    }
                                                }
                                                ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                                <?php
                                                      echo "<b>" . getProgramName($programId) . "</b>";
                                                ?>
                                        </li>

                                    </ul>
                                </div>
                             </div>   
                             <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                            <?php
                                                      echo "<b>" . getmediumName($mediumId) . "</b>";
                                                ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                            <?php
                                                      echo "<b>" . getGroupName($groupId) . "</b>";
                                                ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                             <?php
                                                      echo "<b>" . getshiftName($shiftId) . "</b>";
                                                ?>
                                        </li>

                                    </ul>
                                </div>
                             </div>   
                        </div><!-- /.col -->


                    </div><!-- /.row -->
            </div>    
            <div class="table-header">
                Applicant List
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                Sl No.
                            </th>

                            <th class="hidden-480">Applicant Id</th>
                            <th class="hidden-480">Applicant Name</th>
                            <th class="hidden-480">Gender</th>
                            <th class="hidden-480">Parents Contact</th>
                            <th class="hidden-480">Image</th>

                            <th>
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Action
                            </th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $sl=1;
                                foreach ($applicantlist as $value) {
                                        
                          ?>
                      
                        <tr>
                            <td class="center">
                                <?php echo $sl++; ?>
                            </td>

                            <td>
                                <a href="#">
                                        <?php
                                            if (!empty($value['applicationId'])) {
                                                echo $value['applicationId'];
                                            }
                                          ?>
                                    
                                </a>
                            </td>

                            <td><?php if (!empty($value['firstName'])) { echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName']; } ?></td>
                            <td><?php if (!empty($value['gender'])) { echo element($value['gender'],getGendar(),Null); } ?></td>

                            <td class="hidden-480">
                                
                                <?php echo "Father Name : " . $value['fatherName'] . "<br>Father Mobile : <span class=\"label label-sm label-warning\">".$value['fatherPhone']."</span>" ; ?>
                            </td>
                            <td class="hidden-480">
                                        <?php
                                                if ($value['photo']) {
                                            ?>
                                            <img  src="<?php if (file_exists($value['photo'])) { echo base_url() . $value['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
                                        <?php 
                                        
                                            } 
                                          ?>
                            </td>

                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="blue" href="#" title="View">
                                        <i class="ace-icon fa fa-search bigger-130"></i>
                                    </a>
                                    <?php
                                           $registrationStatus = getStudentByApplicationId($value['applicationId']);
                                            if (empty($registrationStatus)) {                                               
                                    ?> 
                                    <a class="green" target="_blank" href="<?php echo admin_Url(); ?>/applicant/Edit_RegistrationForm/<?php echo $value['applicationId']; ?>" title="Edit">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                    <?php
                                            }
                                         
                                    ?>
                                    <a class="red" id="dlele" onclick="return checkDelete('Applicant ?');" href="<?php echo admin_Url();?>/applicant/DeleteApplicant/<?php echo $value['applicationId']?>" title="Delete">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                    <?php
                                           $registrationStatus = getStudentByApplicationId($value['applicationId']);
                                            if (empty($registrationStatus)) {                                               
                                    ?>                                    
                                    <a class="pink" href="<?php echo admin_Url(); ?>/applicant/apply_registration/<?php echo $value['applicationId']; ?>" title="Registration">
                                        <i class="ace-icon fa fa-sign-in bigger-130"></i>
                                    </a>
                                    <?php
                                            }
                                            else{ echo "<span class=\"label label-sm label-success\">Registered</span>"; }
                                    ?>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php
                                                    $registrationStatus = getStudentByApplicationId($value['applicationId']);
                                                     if (empty($registrationStatus)) {                                               
                                             ?>
                                            <li>
                                                <a href="<?php echo admin_Url(); ?>/applicant/apply_registration/<?php echo $value['applicationId']; ?>" class="tooltip-error" data-rel="tooltip" title="Registration">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-sign-in bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>
                                             <?php
                                                    }
                                                    else{ echo "<span class=\"label label-sm label-success\">Registered</span>"; }
                                                    ?>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                           <?php
                                  }
                            ?>
                       
                     </tbody>   
                  </table>   
                </div>
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 