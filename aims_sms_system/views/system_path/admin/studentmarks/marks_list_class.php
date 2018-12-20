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

                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentmarks/searchresultsByClass" method="post">
                                <div class="col-xs-12 col-sm-12">  
                                    <!-- PAGE CONTENT BEGINS -->
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getsessionid" onchange="return getOfferedSession_classId();" data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
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
                                        <select id="getprogramid" onchange="return getOfferedprogramId_Subjectid();" name="data[programId]" required="1" class="form-control">

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
                                        <select id="getgroupid" onchange="return getOfferedgroupId();" name="data[groupId]" required="1" class="form-control">

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
                                    <!--<div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Exam Type  &nbsp; <?php// echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select name="data[examtypeId]" class="form-control" id="form-field-select-1">
                                            <option value="">Select </option>
                                            <?php// foreach (getExamList() as $velues) { ?>
                                                <option value="<?php// echo $velues['examtypeId']; ?>" <?php// echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE) ?>><?php// echo $velues['examtypeName'] ?></option>
                                            <?php// } ?>

                                        </select>
                                    </div>-->
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getSubjectid"  data-placeholder="Select" name="data[courseId]"  class="form-control">

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
                                echo "<b>" . getSemesterName($semesterId) . "</b>";
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
                                echo "<b>" . getSessionName($sessionId) . "</b>";
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
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Exam</th>
                            <!--<th class="hidden-480">Exam Type</th>-->
                            <th>Total Mark</th>
                            <th></th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sl = 1;
                        foreach ($markslist as $value) {
                            ?>

                            <tr>
                                <td class="center">
                                    <?php echo $sl++; ?>
                                </td>
                                <td>
                                    <a target="_blank"  href="<?php echo admin_Url() . "/student/viewstudentInfo/" . $value['studentId']; ?>">

                                        <?php
                                        if (!empty($value['studentId'])) {
                                            echo $value['studentId'];
                                        }
                                        ?>                                
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($value['studentId'])) {
                                        echo ($value['firstName'] . " " . $value['lastName']);
                                    }
                                    ?>                                

                                </td>
                                <td>

                                    <?php
                                    if (!empty($value['courseId'])) {
                                        echo getCourseName($value['courseId']);
                                    }
                                    ?>                                

                                </td>
                                <td>
                                    <?php
                                    if (!empty($value['semesterId'])) {
                                        echo ($value['semester']);
                                    }
                                    ?>                                

                                </td>
                                <!--<td  class="hidden-480">
                                    <?php
                                    //if (!empty($value['examtypeId'])) {
                                       // $nam = getExamTypeName($value['examtypeId']);
                                        //if (!empty($nam)) {
                                           // echo $nam;
                                       // }
                                   // }
                                    ?>                             

                                </td>-->

                                <td>

                                    <?php
                                    $data['programOfferId'] = $value['programOfferId'];
                                    $data['courseId'] = $value['courseId'];
                                     //echo "<pre>"; print_r($data['programOfferId']);
                                    $marks_devide = getMarkDevidevalue($data);
                                    
                                    //print_r($marks_devide);

                                    $marks = 0;
                                    $print_category_mark = "";
                                    $print_optional_category_mark = "";
                                    $ex_pld = explode(",", trim($marks_devide['mark_cat_id']));
                                    $ex_pld_assng_dvd = explode(",", trim($marks_devide['dis_divide_mark']));
                                    $ex_pld_dvd = explode(",", trim($value['divide_mark'])); // this mark is from student marks table
                                    $ex_pld_percnt = explode(",", trim($marks_devide['mark_percent']));
                                    $individual_total = 0;
                                    for ($ck_val = 1; $ck_val < count($ex_pld) - 1; $ck_val++) {
                                        //echo $ex_pld_assng_dvd[$ck_val]."++".$ex_pld_percnt[$ck_val];
                                        $mrk_string = getMarkTitle($ex_pld[$ck_val]);
                                        $category_mark = substr($mrk_string, 0, 1) . " - " . $ex_pld_dvd[$ck_val];

                                        // echo "<pre>";   print_r($t);
                                        if (!empty($ex_pld_percnt[$ck_val])) {
                                            $percent_marks = (($ex_pld_percnt[$ck_val] * $ex_pld_dvd[$ck_val]) / 100);
                                            
                                          
                                        }
                                        $individual_total += $percent_marks;
                                    }
                                    if(!empty($individual_total)){
                                        echo floor($individual_total);
                                    } else {
                                        echo 'Absent';
                                    }
                                    
                                    
                                    ?>

                                    <?php
                                    // if (!empty($value['marks'])) {
                                    //    echo $value['marks'];
                                    //  }
                                    ?>
                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" target="_blank" href="<?php echo admin_Url(); ?>/studentmarks/edit_studentmarks/<?php echo $value['studentId'] . "/" . $value['markId']; ?>" title="Edit">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                        <a class="red" id="dlele" onclick="return checkDelete('Student Marks ?');" href="<?php echo admin_Url(); ?>/Studentmarks/deleteStudentmarks/<?php echo $value['studentId'] ?>/<?php echo $value['markId'] ?>" title="Delete">
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
                                                    <a target="_blank" href="<?php echo admin_Url(); ?>/studentmarks/edit_studentmarks/<?php echo $value['studentId'] . "/" . $value['markId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a  target="_blank" onclick="return checkDelete('Student Marks ?');" href="<?php echo admin_Url(); ?>/studentmarks/deleteStudentmarks/<?php echo $value['studentId'] ?>/<?php echo $value['markId'] ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                        <span class="black">
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
        </form>   
        <?php
    }
    ?>
</div><!-- /.col-x12 -->

</div> <!-- /.row --> 

