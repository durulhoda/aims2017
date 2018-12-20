<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Student Result Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Publish Result
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
    <div class="col-xs-12 col-sm-12">

        <div class="widget-box transparent ">
            <div class="widget-header widget-header-large">
                <div class="widget-toolbar pull-left">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                    <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Result Information By Class Information </a>

                </div>
            </div>
        </div>


        <!-- PAGE CONTENT ENDS -->
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
                                        <select id="getmediumid" onchange="return getOfferedmediumId();" name="data[mediumId]" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getgroupid" onchange="return getOfferedgroupId();" name="data[groupId]" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getshiftid" onchange="return getOfferedshiftId();" name="data[shiftId]" required="1" class="form-control" >

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
                                                <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE) ?>>
                                                    <?php echo $velues['semester'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Exam Type  &nbsp; <?php echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select name="data[examtypeId]" class="form-control" id="form-field-select-1">
                                            <option value="">Select </option>
                                            <?php foreach (getExamList() as $velues) { ?>
                                                <option value="<?php echo $velues['examtypeId']; ?>" <?php echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE) ?>>
                                                    <?php echo $velues['examtypeName'] ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getcourseid" name="data[courseId]" class="form-control" id="form-field-select-1">

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

            <div class="col-sm-7 col-md-offset-2">
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

        <form id="frm1" name="frm1"  action="<?php echo admin_Url() ?>/publishresult/publishresults" method="post">       
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>

                            <th class="center">
                                <input type="checkbox" checked="checked" name="checkall" onclick="checkedAll()"/>
                            </th>
                            <th class="center">
                                Sl No.
                            </th>
                            <th class="hidden-480">Student Info</th>                               
                            <th class="hidden-480">Semester</th>
                            <th class="hidden-480">Marks</th>
                            <th class="hidden-480">Result Status</th>

                            <th class="hidden-480">Change Status</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sl = 1;
                      
                        foreach ($markslist as $value) {
                                $dta['studentId'] = $value['studentId'];
                                $dta['semesterId'] = $value['semesterId'];
                                $dta['programOfferId'] = $value['programOfferId'];

                                $reslt_lst = getresultStatus($dta);
                        ?>

                                <tr>
                                    <td class="center">
                                     <?php
                                        if(!empty($reslt_lst))
                                        {
                                            foreach ($reslt_lst as $phpp) {
                                               if ($phpp['result_status'] == 1) {

                                                   echo "";
                                               }
                                               else{
                                                   ?>
                                                   <input type="checkbox" checked="checked" name="studentId[]" value="<?php echo $value['studentId']; ?>">
                                                 <?php
                                               }
                                            }
                                        }
                                        else{
                                     ?>
                                        <input type="checkbox" checked="checked" name="studentId[]" value="<?php echo $value['studentId']; ?>">
                                    
                                        <?php  }  ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $sl++; ?>
                                    </td>

                                    <td>
                                        <a href="#">
                                            <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'] . "<br>";
                                                echo ($value['firstName'] . " " . $value['lastName']);
                                            }
                                            ?>                                
                                        </a>
                                    </td>

                                    <td>
                                        <?php
                                        if (!empty($value['semesterId'])) {
                                            echo getSemesterName($value['semesterId']);
                                        }
                                        ?>                                
                                        <input type="hidden" name="semesterId" value="<?php echo $value['semesterId']; ?>"   />
                                    </td>
                                    <td class="hidden-480">
                                        <?php
                                        if (!empty($value['marks'])) {
                                            echo $value['marks'];
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: left">    

                                        <?php
                                        $dta['studentId'] = $value['studentId'];
                                        $dta['semesterId'] = $value['semesterId'];
                                        $dta['programOfferId'] = $value['programOfferId'];

                                        $reslt_array = getresultStatus($dta);
                                        if (!empty($reslt_array)){

                                            foreach ($reslt_array as $aspppps) {
                                                if (!empty($aspppps)) {
                                                    if ($aspppps['result_status'] == 1) {
                                                        $u_status = "Publish";
                                                        echo "<span class=\"label label-sm label-success\">".$u_status."</span>";
                                                    } else {
                                                        $u_status = "Un-published";
                                                        echo "<span class=\"label label-sm label-danger\">".$u_status."</span>";
                                                    }
                                                } else {
                                                    $u_status = "Un-published";
                                                    echo "<span class=\"label label-sm label-danger\">".$u_status."</span>";
                                                }
                                            }
                                        } else {
                                            $u_status = "Not published";
                                            echo "<span class=\"label label-sm label-warning\">".$u_status."</span>";
                                        }
                                        ?>
                                    </td>
                            <input type="hidden" name="programOfferId" value="<?php echo $programOfferId; ?>"   /> 


                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">

                                    <?php
                                    if (empty($reslt_array)) {
                                        echo "Not Active";
                                        
                                    } else {
                                        if ($u_status=="Publish") {
                                            ?>
                                           
                                            <a class="green" target="_blank" id="dlele" onclick="return checkConfirm('your decesion to un-publish result');" href="<?php echo admin_Url() . "/publishresult/unpublishresultsbystudent/" . $value['programOfferId'] . "/" . $value['studentId'] . "/" . $value['semesterId']; ?>" title="Un-Publish">
                                                <i class="ace-icon fa fa-unlock  bigger-130"></i>
                                            </a>
                                            <?php
                                        } 
                                        else{
                                            ?>
                                             <a class="red" target="_blank" href="<?php echo admin_Url() . "/publishresult/publishresultsbystudent/" . $value['programOfferId'] . "/" . $value['studentId'] . "/" . $value['semesterId']; ?>" title="Publish">
                                                <i class="ace-icon fa fa-lock bigger-130"></i>
                                            </a>
                                            <?php
                                        }
                                      
                                    }
                                    ?>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <?php
                                            if ($u_status=="Publish") {
                                                ?>
                                                
                                                 <li>
                                                    <a target="_blank" onclick="return checkConfirm('your decesion to un-publish result');" href="<?php echo admin_Url() . "/publishresult/unpublishresultsbystudent/" . $value['programOfferId'] . "/" . $value['studentId'] . "/" . $value['semesterId']; ?>" class="tooltip-error" data-rel="tooltip" title="Un-Publish">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-unlock  bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                                <?php
                                            } else {
                                                ?>
                                               <li>
                                                    <a target="_blank" href="<?php echo admin_Url() . "/publishresult/publishresultsbystudent/" . $value['programOfferId'] . "/" . $value['studentId'] . "/" . $value['semesterId']; ?>" class="tooltip-success" data-rel="tooltip" title="Publish">
                                                        <span class="red">
                                                            <i class="ace-icon fa fa-lock  bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
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
            <div class="space-6"></div>
            <div class="clearfix">
                <div class="col-md-12">
                    <button class="btn btn-danger" name="search" type="submit">
                        Publish Result
                    </button>

                </div>
            </div>
        </form>   
        <?php
    }
    ?>

</div> <!-- /.row --> 






