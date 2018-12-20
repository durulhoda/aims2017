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
                    
                        <div class="col-sm-10 col-md-offset-1">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b><?php
                                            if (!empty($semesterId)) {
                                                echo "<b>".getSemesterName($semesterId)."</b>";
                                            }
                                            ?> - Student Subject Marks Information</b>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4">
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
                             <div class="col-xs-12 col-sm-4">
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
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Semester: 
                                             <?php
                                                      echo "<b>" . getSemesterName($semesterId) . "</b>";
                                                ?>
                                        </li>

                                    </ul>
                                </div>
                             </div>   
                             <div class="col-xs-12 col-sm-4">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Subject Name:&nbsp;
                                            <?php echo ($student_marks) ? $student_marks[0]->courseName : ""; ?>
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
                                <th class="center">#</th>
                                <th>Student</th>
                                <th>Marks</th>
                                <th>Total Mark</th>
                            </tr>
                        </thead>
                        <?php if ($student_marks) : ?>
                        <tbody>
                        <?php foreach ($student_marks as $key => $row) :
                            $mark_cate = explode(',', substr($row->mark_cat_id, 1, -1));
                            $mark = explode(',', substr($row->divide_mark, 1, -1));
                            $len = count($mark_cate);
                        ?>
                        <tr>
                            <th><?php echo $key+1; ?></th>
                            <th><?php echo $row->student_name."<br>".$row->studentId; ?></th>
                            <th>
                            <?php 
                                $m = "";
                                for($i = 0; $i<$len; $i++) :
                                   if ($mark_cate[$i] == 1) :
                                        $m .= "S:".$mark[$i]." ";
                                    elseif ($mark_cate[$i] == 2) :
                                        $m .= "Ob:".$mark[$i]." ";
                                    elseif ($mark_cate[$i] == 3) :
                                        $m .= "P:".$mark[$i]." ";
                                    elseif ($mark_cate[$i] == 4) :
                                        $m .= "SBA:".$mark[$i]." ";
                                    endif;
                                endfor;
                                echo $m;
                            ?>
                            </th>
                            <th><?php echo $row->marks; ?></th>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>   
                        <?php endif; ?>
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
    
   