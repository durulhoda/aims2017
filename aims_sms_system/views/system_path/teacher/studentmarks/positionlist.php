<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Student Position
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            All Student Position
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentmarks/search_position" method="post">
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
                        <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid"  data-placeholder="Select" name="data[semesterId]"  class="form-control">
                            <option value="">Select</option>
                             <?php foreach(getSemesterInfoArray() as $velues){?>
                                         <option value="<?php echo $velues['semesterId'];?>" 
                                             <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE)?>><?php echo $velues['semester']?></option>
                                         <?php }?>
                        </select>
                    </div>
                            
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Search Student
                            </button>
                            <button class="btn btn-purple" name="print" type="submit">
                                <i class="ace-icon fa fa-print bigger-120"></i>
                               Print Marks Entry List
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
             
        </div>
</div> <!-- /.row --> 



<?php
if (!empty($markslist)) {
    ?>
    <div>
        <table id="simple-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">Class Position</th>
                    <th class="hidden-480">Student Id</th>
                    <th class="hidden-480">Student Name</th>
                    <th class="hidden-480">Total Mark</th>
                    <th class="hidden-480b ">Obtain Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sl = 1;
                    foreach ($markslist as $value) {
                        $info = getstudentNameInfo($value['studentId']);
                        if($sl==1){ $first="#87B87F";}
                        elseif($sl==2){ $first="#9585BF";}
                        elseif($sl==3){ $first="#E1797C";}
                        else{
                            $first="";
                        }
                        
                 ?>

                    <tr >
                        <td class="center" <?php if(!empty($first)){  ?>style="background-color:<?php echo $first; ?>" <?php } ?>>
                            <?php echo $sl++; ?>
                        </td>

                        <td>
                            <?php
                            if (!empty($info)) {
                                echo $value['studentId'];
                            }
                            ?>                                
                        </td>

                        <td>
                            <?php
                            if (!empty($info)) {
                                echo $info['firstName'] . " " . $info['lastName'];
                            }
                            ?>
                        </td>

                        <td class="hidden-480">
                            <?php
                            $t_sub_mark = getAssignCourseListByPrg_stuid($programOfferId, $value['studentId']);
                            if (!empty($t_sub_mark)) {
                                $editDatas = explode(",", trim($t_sub_mark['courseId'], ","));
                                $countcourse = count($editDatas);
                                $total_mark = 0;
                                for ($x = 0; $x < $countcourse; $x++) {
                                    $datax['programOfferId'] = $programOfferId;
                                    $datax['courseId'] = $editDatas[$x];
                                    $coursemark = getCourseMarks($datax) . "||";
                                    $total_mark = $coursemark + $total_mark;
                                }
                                echo $total_mark;
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

                    </tr>
                    <?php
                }
                ?>

            </tbody>   
        </table>   

    </div>    


    <?php
}
?>


<!-- Right Side/Main Content End --> 
