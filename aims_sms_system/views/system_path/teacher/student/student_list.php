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
                            All Student Information
                        </h3>

                        

                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-print"></i>
                                <a href="<?php echo base_url('systemaccess/student/printStudentList/'.$programOfferId); ?>" role="button" class="green" > Print Student List </a>
                                
                            
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
                                        
                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/student/searchstudentinfo" enctype="multipart/form-data" method="post">
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
                Student List
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

                            <th class="hidden-480">Student Id</th>
                            <th class="hidden-480">Student Name</th>
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
                                foreach ($studentlist as $value) {
                                        
                          ?>
                      
                        <tr>
                            <td class="center">
                                <?php echo $sl++; ?>
                            </td>

                            <td>
                                <a target="_blank" href="<?php echo admin_Url() ."/student/viewstudentInfo/" .$value['studentId'];?>">
                                        <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'];
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

                                    <a class="green" href="<?php echo admin_Url();?>/student/editstudent/<?php echo $value['studentId']?>" title="Edit">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" href="<?php echo admin_Url();?>/student/deleteStudentData/<?php echo $value['studentId']; ?>" title="Delete">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                   
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
                                                <a href="<?php echo admin_Url();?>/student/editstudent/<?php echo $value['studentId']?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo admin_Url();?>/student/deleteStudentData/<?php echo $value['studentId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
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
    
    
    
    
    
    
    
    
    
