<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">    
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
                if (!empty($studentlist)) {
            ?>
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                           Showing Result For <b><font color="#d15b47"><?php echo $studentId.$firstName.$phone.$fatherPhone; ?></font></b>
                        </h3>

                        

                        <div class="widget-toolbar hidden-480">
                            <div class="widget-toolbar pull-left">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                            <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Search Again Student Information By Individual</a>

                        </div>
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
                                        Search Again Student List By Enrollment Information
                                    </div>
                                </div>
                                
                                    <div class="modal-body no-padding">
                                        
                                        <form class="form-horizontal" role="form" action="<?php echo teacher_Url(); ?>/student/searchRegisteredStudent" enctype="multipart/form-data" method="post">
                                            <div class="row">
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
                                                            <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                                            </select>
                                                        </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">

                                                        </select>
                                                    </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                                                        </select>
                                                    </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                                                        </select>
                                                    </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control" >

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
                                                
                                            </div>    
                                         </form>
                                        
                                    </div>
                                    
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                    
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

                                        <form class="form-horizontal" role="form" action="<?php echo teacher_Url(); ?>/student/searchindividualStudent" method="post">
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
                    
                <div class="row">
                    
                    <!--    <div class="col-sm-8 col-sm-offset-2">
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
                                            <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                                <?php
                                                      echo "<b>" . getProgramName($programId) . "</b>";
                                                ?>
                                        </li>
                                        <li>
                                                <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                                <?php
                                                echo "<b>" . getmediumName($mediumId) . "</b>";
                                                ?>
                                            </li>
                                    </ul>
                                </div>
                             </div>   
                             <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                       

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                            <?php
                                                      echo "<b>" . getGroupName($groupId) . "</b>";
                                                ?>
                                        </li>
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                                            <?php
                                                      echo "<b>" . getsectionName($sectionId) . "</b>";
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
                        </div> /.col -->


                    </div><!-- /.row -->
            </div>    
            <div class="table-header">
                Student List
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center hidden-480">
                                Sl No.
                            </th>

                            <th >Student Id</th>
                            <th>Student Name</th>
                            <th class="hidden-480">Birth Date/ Gender</th>
                            <th>Father Info</th>
                          
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
                                foreach ($studentlist as $value) {
                                        
                          ?>
                      
                        <tr>
                            <td class="center hidden-480">
                                <?php echo $sl++; ?>
                            </td>

                            <td>
                                        <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'];
                                            }
                                          ?>                                    
                               
                            </td>

                            <td><?php if (!empty($value['firstName'])) { echo "<b>".$value['firstName'] . " " . $value['middleName'] . " " . $value['lastName']."</b>"; } ?></td>
                            <td class="hidden-480"><?php if (!empty($value['dateOfBirth'])) { echo $value['dateOfBirth']."<br>".element($value['gender'],getGendar(),Null); } ?></td>

                            <td>
                                <?php echo "".$value['fatherName'] . "<br>".$value['fatherPhone'] ; ?>
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
                                      <a class="blue" target="_blank" href="<?php echo teacher_Url();?>/studentcomment/commentbox/<?php echo $value['studentId']?>/<?php echo $value['programOfferId']?>" title=" Add Comment">
                                       Add Student Comment
                                    </a>

                                    
                                   
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a href="<?php echo teacher_Url();?>/student/viewstudentInfo/<?php echo $value['studentId']?>/<?php echo $value['programOfferId']?>" class="tooltip-info" data-rel="tooltip" title=" Add Comment">
                                                    <span class="blue">
                                                         Add Student Comment
                                                    </span>
                                                </a>
                                            </li>

                                       
                                           
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
    
    
    
    
    
    
    
    
    
