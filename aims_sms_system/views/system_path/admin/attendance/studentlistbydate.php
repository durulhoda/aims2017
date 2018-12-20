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
                            Insert Student Attendance
                        </h3>

                        

                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-print"></i>
                                <a href="#" onclick="printDiv('printableArea')" role="button" class="green" > Print Marks Entry Form</a>
                                
                            
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
                                        Search Again By Enrollment Information
                                    </div>
                                </div>
                                
                                    <div class="modal-body no-padding">
                                        
                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentmarks/searchstudentlist" method="post">
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
                                    
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                <div class="row">
                    
                        <div class="col-sm-7 col-md-offset-2">
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
                Attendance Entry Form
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <form id="frm1" action="<?php echo admin_Url() ?>/studentsattendance/insertattendance" method="post">
            <div>
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                Sl No.
                            </th>
                            <th>Select</th>
                            <th>Student Id</th>
                            <th>Student Name</th>
                       
                            <th>Status</th>
                           
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $sl=1;
                                foreach ($studentlist as $value) {
                                        
                          ?>
                      
                        <tr>
                            <td class="center">
                                <?php echo $sl; ?>
                            </td>
                            <td>
                                <input type="checkbox" checked="yes" name="serial[]" value="<?php echo $sl++; ?>">
                                  
                                </td>
                            <td>
                                <a href="#">
                                        <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'];
                                            }
                                          ?>                                    
                                </a>
                                 <input type="hidden" name="studentId[]" value="<?php echo $value['studentId']; ?>">
                            </td>

                            <td><?php if (!empty($value['firstName'])) { echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName']; } ?></td>
                          
                        
                            
                            
                            <td>
                                 <select name="attendanceStatus[]" class="form-control" id="form-field-select-1">
                                    <?php foreach (getattendanceStatus() as  $key =>$value) { ?>
                                                    <option value="<?php echo $key; ?>" 
                                                            <?php echo set_select('attendanceStatus', $key, FALSE) ?> >
                                                            <?php echo $value; ?></option>                                                
                                                    <?php } ?>
                                </select>


                            </td>
                            
                        </tr>
                           <?php
                                  }
                            ?>
                       
                     </tbody>   
                  </table>  
                      <div class="col-sm-4">
                          <div class="input-group input-group-sm">
                              <input class="form-control date-picker" placeholder="Select Date" id="id-date-picker-1" name="attendanceDate" required="" type="text" data-date-format="dd-mm-yyyy" />
                              <span class="input-group-addon">
                                  <i class="fa fa-calendar bigger-110"></i>
                              </span>
                          </div>
                      </div>
                      <button class="btn btn-danger" type="submit" name="btnSubmit" onclick="return checkSelect();">
                          <i class="ace-icon fa fa-check bigger-110"></i>
                          Insert Attendance
                      </button>
                      <input  type="hidden" name="programOfferId" value="<?php echo $programOfferId['programOfferId']; ?>">
                            
                </div>
            </form>   
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 
    
      


    <script type="text/javascript" >
    function checkSelect()
    {
        var chk = confirm("Please Confirm To Select Student ...");
        if (chk)
        {
            return true;
        }
        else {
            return false;
        }
    }
</script>
    
    
    
    
    

    
    
    
    
    
