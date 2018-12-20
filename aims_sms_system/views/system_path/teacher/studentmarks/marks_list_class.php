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
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                            Search Student Marks
                        </h3>

                    </div>
            </div>
            <div class="widget-box transparent ">
                    <div class="widget-header widget-header-large">
                        <div class="widget-toolbar pull-left">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                            <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Search Marks By Individual Student </a>

                        </div>
                        <div class="widget-toolbar pull-left">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                            <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Marks By Class Information </a>

                        </div>
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
                                        Search Marks By Individual Student
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">

                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentmarks/searchresultsByStudent" method="post">
                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <input type="text" name="data[studentId]" required="1" value="<?php echo set_value("data[studentId]"); ?>" class="form-control" id="form-field-1" placeholder="Student Id" />
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[semesterId]" class="form-control" id="form-field-select-1">
                                                        <option value="">Select</option>
                                                        <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                                            <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE) ?>><?php echo $velues['semester'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[sessionId]" required="1" class="form-control" id="form-field-select-1">
                                                        <option value=""></option> 
                                                         <?php foreach (getOfferedSession() as $value) { ?>
                                                            <option value="<?php echo $value['sessionId']; ?>" 
                                                                    <?php echo set_select('data[sessionId]', $value['session'], FALSE) ?> >
                                                                <?php echo $value['session']; ?></option>                                                
                                                        <?php   }    ?>
                                                    </select>
                                                </div>

                                            </div> 


                                            <div class="col-xs-12">
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-success" name="search" type="submit">
                                                            <i class="ace-icon fa fa-search bigger-120"></i>
                                                            Search Student Marks
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
                    <div id="modal-table" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Search Again By Enrollment Information
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">
                                        
                                        <form class="form-horizontal" role="form" action="<?php echo teacher_Url(); ?>/studentmarks/searchresultsByClass" method="post">
                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getsessionid" onchange="return getOfferedSession_classIdbyteacher(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
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
                                                    <select id="getprogramid" onchange="return getOfferedprogramId_Subjectidbyteacher(); " name="data[programId]" required="1" class="form-control">
                                                        
                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                                                        
                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
                                                        
                                                    </select>
                                                </div>                                                
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[semesterId]" class="form-control" id="form-field-select-1">
                                                        <option value="">Select</option>
                                                        <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                                            <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE) ?>><?php echo $velues['semester'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Exam Type  &nbsp; <?php echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[examtypeId]" class="form-control" id="form-field-select-1">
                                                        <option value="">Select </option>
                                                        <?php foreach (getExamList() as $velues) { ?>
                                                            <option value="<?php echo $velues['examtypeId']; ?>" <?php echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE) ?>><?php echo $velues['examtypeName'] ?></option>
                                                        <?php } ?>
                                                                 
                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getsessionid"  data-placeholder="Select" name="data[courseId]"  class="form-control">
                                                        <option value="">Select</option>
                                                        <?php foreach (getOfferedCourseInfoArray() as $value) { ?>
                                                            <option value="<?php echo $value['courseId']; ?>" 
                                                                    <?php echo set_select('data[courseId]', $value['courseId'], FALSE) ?> >
                                                                <?php echo $value['courseName']; ?></option>                                                
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                          
                                            </div> 
                                                
                                                
                                            <div class="col-xs-12">
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-success" name="search" type="submit">
                                                            <i class="ace-icon fa fa-search bigger-120"></i>
                                                            Search Student Marks
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
                
            </div>    
           <?php
                if (!empty($markslist)) {
            ?>   
                    <div class="row">
                    
                        <div class="col-sm-7 col-md-offset-1">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b><?php
                                            if (!empty($semesterId)) {
                                                echo "<b>".getSemesterName($semesterId)."</b>";
                                            }
                                            ?> - Student Subject Marks Information</b>
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
            <div class="table-header">
                Student Result Marks Information
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <form id="frm1" action="<?php echo admin_Url() ?>/studentmarks/savemarks" method="post">
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">
                                    Sl No.
                                </th>

                                <th>Student</th>
                                <th>Subject</th>
                                <th class="hidden-480">Semester</th>
                                <th class="hidden-480">Exam Type</th>
                                <th>Total Mark</th>
                                <th></th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $sl=1;
                                    foreach ($markslist as $value) {

                              ?>

                            <tr>
                                <td class="center">
                                    <?php echo $sl++; ?>
                                </td>
                                <td>
                                    <a target="_blank"  href="<?php echo admin_Url() ."/student/viewstudentInfo/" .$value['studentId'];?>">
                                
                                            <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId']."<br>";
                                                echo ($value['firstName']. " " . $value['lastName']);
                                            }
                                            ?>                                
                                    </a>
                                </td>
                                <td>
                                           <?php
                                            if (!empty($value['courseId'])) {
                                                echo getCourseName($value['courseId']);
                                            }
                                            ?>                                
                                   
                                </td>
                                <td  class="hidden-480">
                                            <?php
                                            if (!empty($value['semesterId'])) {
                                                echo ($value['semester']);
                                            }
                                            ?>                                
                                   
                                </td>
                                <td  class="hidden-480">
                                           <?php
                                            if (!empty($value['examtypeId'])) {
                                                $nam=getExamTypeName($value['examtypeId']);
                                                if(!empty($nam)){ echo $nam; }
                                            }
                                            ?>                             
                                   
                                </td>

                                <td>
                                   <?php
                                            if (!empty($value['marks'])) {
                                                echo $value['marks'];
                                            }
                                            ?>
                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="blue" href="#" title="View">
                                            <i class="ace-icon fa fa-search bigger-130"></i>
                                        </a>

                                        <a class="green" target="_blank" href="<?php echo teacher_Url(); ?>/studentmarks/edit_studentmarks/<?php echo $value['studentId']."/".$value['markId']; ?>" title="Edit">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
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
                                                    <a href="<?php echo teacher_Url(); ?>/studentmarks/edit_studentmarks/<?php echo $value['studentId']."/".$value['markId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
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
            </form>   
             <?php
                }
            ?>
        </div><!-- /.col-x12 -->
        
    </div> <!-- /.row --> 
            </div><!-- /.col-x12 -->
        
    </div> <!-- /.row --> 
    
   