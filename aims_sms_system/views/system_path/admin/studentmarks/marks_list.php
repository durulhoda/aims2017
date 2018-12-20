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
                            <i class="ace-icon fa fa-barcode red"></i>
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
                         <?php
                            if (!empty($markslist)) {
                        ?> 
                        <div class="pull-right">
                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentmarks/transcriptView" method="post">
                                <input type="hidden" name="data[semesterId]" value ="<?php if (!empty($semesterId)) { echo $semesterId; } ?>"      />            
                                <input type="hidden" name="data[studentId]" value ="<?php if (!empty($studentId)) { echo $studentId; } ?>"      />            
                                <input type="hidden" name="data[programOfferId]" value ="<?php if (!empty($programOfferId['programOfferId'])) { echo $programOfferId['programOfferId']; } ?>"      />            
                                
                               <!-- <button class="btn btn-danger" name="generate" type="submit">
                                    <i class="ace-icon fa fa-search bigger-70"></i>
                                    Transcript Generate(Old)
                                </button>-->
                            </form>    
                        </div>
                        <div class="pull-right" style="padding-right: 5px;">
                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentmarks/transcriptView1" method="post">
                                <input type="hidden" name="data[semesterId]" value ="<?php if (!empty($semesterId)) { echo $semesterId; } ?>"      />            
                                <input type="hidden" name="data[studentId]" value ="<?php if (!empty($studentId)) { echo $studentId; } ?>"      />            
                                <input type="hidden" name="data[programOfferId]" value ="<?php if (!empty($programOfferId['programOfferId'])) { echo $programOfferId['programOfferId']; } ?>"      />            
                                
                                <button class="btn btn-danger" name="generate" type="submit">
                                    <i class="ace-icon fa fa-search bigger-70"></i>
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
                                        Search Marks By Individual Student
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">

                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentmarks/searchresultsByStudent" method="post">
                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">StudentId &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <input type="text" name="data[studentId]" required="1" value="<?php echo set_value("data[studentId]"); ?>" class="form-control" id="form-field-1" placeholder="Student Id" />
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Exam &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[semesterId]" class="form-control" id="form-field-select-1">
                                                        <option value="">Select</option>
                                                        <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                                            <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE) ?>>
                                                                <?php echo $velues['semester'] ?></option>
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

                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/studentmarks/searchresultsByClass" method="post">
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
                                                    <label class="control-label" for="form-field-1">Exam &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
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
                                                            <?php// foreach(getExamList() as $velues){?>
                                                             <option value="<?php// echo $velues['examtypeId'];?>" <?php// echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE)?>><?php// echo $velues['examtypeName']?></option>
                                                             <?php// }?>

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
                    
                        <div class="col-sm-7">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b><?php
                                            if (!empty($semesterId)) {
                                                echo "<b>".getSemesterName($semesterId)."</b>";
                                            }
                                            ?> - Student Subject Marks Information</b>
                                </div>
                            <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                            <?php 
                                                       echo "<b>".getSessionName($programOfferId['sessionId'])."</b>";                                                

                                              ?>
                                        </li>

                                      

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                                <?php
                                                      echo "<b>" . getProgramName($programOfferId['programId']) . "</b>";
                                                ?>
                                        </li>
                                        
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                            <?php
                                                      echo "<b>" . getmediumName($programOfferId['mediumId']) . "</b>";
                                                ?>
                                        </li>

                                    </ul>
                                </div>
                             </div>   
                             <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                             <?php
                                                      echo "<b>" . getshiftName($programOfferId['shiftId']) . "</b>";
                                                ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                            <?php
                                                      echo "<b>" . getGroupName($programOfferId['groupId']) . "</b>";
                                                ?>
                                        </li>

                                        

                                    </ul>
                                </div>
                             </div>   
                        </div><!-- /.col -->
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right">
                                    <b>Student Information</b>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-8">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>
                                            <?php 
                                                       echo "<b>".($studentinfo['firstName'] . " " . $studentinfo['lastName'])."</b>(".$studentId.")";                                                

                                              ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Father: 
                                            <?php 
                                                       echo "<b>".($studentinfo['fatherName'])."</b>";                                                

                                              ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Father Contact: 
                                            <?php 
                                                       echo "<b>".($studentinfo['fatherPhone'])."</b>";                                                

                                              ?>
                                        </li>

                                    </ul>
                                </div>
                             </div> 
                            <div class="col-xs-12 col-sm-4">
                                <div>
                                        <?php
                                        if (!empty($studentId)) {
                                            ?>          
                                            <img  src="<?php
                                            if (file_exists($studentinfo['photo'])) {
                                                echo base_url() . $studentinfo['photo'];
                                            } else {
                                                echo base_url() . "uploads/default/default.png";
                                            }
                                            ?>" width="70" height="90">

                                            <?php
                                        }
                                        ?>
                                </div>
                             </div> 
                              
                        </div><!-- /.col -->

                    </div><!-- /.row -->
            <div class="table-header">
                Marks List
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <form id="frm1" action="<?php echo admin_Url() ?>/studentmarks/savemarks" method="post">
                <div>
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">
                                    Sl No.
                                </th>

                                <th class="hidden-480">Subject</th>
                                <!--<th class="hidden-480">Exam Type</th>-->
                                <th class="hidden-480">Total Mark</th>
                                <th class="hidden-480"></th>
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
                                    <a href="#">
                                            <?php
                                            if (!empty($value['courseId'])) {
                                                echo getCourseName($value['courseId']);
                                            }
                                            ?>                                
                                    </a>
                                    <input type="hidden" name="data[courseId]" value ="<?php if (!empty($value['courseId'])) { echo $value['courseId']; } ?>"      />
                                </td>

                                <!--<td>
                                            <?php
                                            //if (!empty($value['examtypeId'])) {
                                               // echo getExamTypeName($value['examtypeId']);
                                           // }
                                            ?>
                                    <input type="hidden" name="data[examtypeId]" value ="<?php// if (!empty($value['examtypeId'])) { echo $value['examtypeId']; } ?>" /> 
                                </td>-->

                                <td class="hidden-480">
                                     <?php
                              
                                     $data['programOfferId']=$value['programOfferId'];
                                      $data['courseId']=$value['courseId'];
                                    // echo "<pre>"; print_r($data['programOfferId']);
                                         $marks_devide = getMarkDevidevalue($data);

                                         $marks = 0;
                                         $print_category_mark="";
                                         $print_optional_category_mark="";
                                         $ex_pld = explode(",", trim($marks_devide['mark_cat_id']));
                                         $ex_pld_assng_dvd = explode(",", trim($marks_devide['dis_divide_mark']));
                                         $ex_pld_dvd = explode(",", trim($value['divide_mark'])); // this mark is from student marks table
                                         $ex_pld_percnt = explode(",", trim($marks_devide['mark_percent']));
                                         $individual_total =0;
                                         for ($ck_val = 1; $ck_val < count($ex_pld) - 1; $ck_val++) {
                                             //echo $ex_pld_assng_dvd[$ck_val]."++".$ex_pld_percnt[$ck_val];
                                             $mrk_string = getMarkTitle($ex_pld[$ck_val]);                                            
                                            $category_mark= substr($mrk_string, 0, 1)." - ".$ex_pld_dvd[$ck_val];
                                          
                                           // echo "<pre>";   print_r($t);
                                             if (!empty($ex_pld_percnt[$ck_val])) {
                                               $percent_marks = (($ex_pld_percnt[$ck_val] * $ex_pld_dvd[$ck_val]) / 100);
                                            
                                             }
                                             $individual_total+=$percent_marks;
                                         }
                                         echo floor($individual_total);
                                    ?>
                                    
                                   <?php
                                           // if (!empty($value['marks'])) {
                                            //    echo $value['marks'];
                                          //  }
                                            ?>
                                            <input type="hidden" name="data[marks]" value ="<?php if (!empty($value['marks'])) {  echo $value['marks'];  } ?>"   />        
                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="blue" href="#" title="View">
                                            <i class="ace-icon fa fa-search bigger-130"></i>
                                        </a>

                                        <a class="green" target="_blank" href="<?php echo admin_Url(); ?>/studentmarks/edit_studentmarks/<?php echo $value['studentId']."/".$value['markId']; ?>" title="Edit">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                        <a class="red" id="dlele" onclick="return checkDelete('Student Mark ?');" href="<?php echo admin_Url();?>/studentmarks/deleteStudentmarks/<?php echo $value['studentId']."/".$value['markId']; ?>" title="Delete">
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
                                                    <a href="<?php echo admin_Url(); ?>/studentmarks/edit_studentmarks/<?php echo $value['studentId']."/".$value['markId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo admin_Url();?>/studentmarks/deleteStudentmarks/<?php echo $value['studentId']."/".$value['markId']; ?>" onclick="return checkDelete('Student Mark ?');"  class="tooltip-error" data-rel="tooltip" title="Delete">
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
            </form>   
             <?php
                }
            ?>
        </div><!-- /.col-x12 -->
        
   