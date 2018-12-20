<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
<!-- /.row --> 

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
                            Student Attendence List
                        </h3>

                    </div>
            </div>
            <div class="widget-box transparent ">
                    <div class="widget-header widget-header-large">
                        <div class="widget-toolbar pull-left">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                            <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Search Attendance By Individual Student </a>

                        </div>
                        <div class="widget-toolbar pull-left">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                            <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Attendance By Class Information </a>

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
                                        Search Attendance By Individual Student
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">
                                    <div class="col-xs-12">
                                        <form class="form-horizontal" role="form" action="<?php echo teacher_Url();?>/studentsattendance/searchattendanceinfo" enctype="multipart/form-data" method="post">
                                                    
                                                       <div class="col-xs-12 col-sm-12">  
                                                        <!-- PAGE CONTENT BEGINS -->
                                                        
                                                            <div class="  col-xs-10 col-sm-4">
                                                                <label class="control-label" for="form-field-1">Student ID : &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                                               <input type="text" class="form-control" id="form-field-1" name="data[studentId]"  value="<?php echo set_value("data[studentId]"); ?>" placeholder="Student ID" />
                                                            </div>
                                                            <div class="col-sm-4">
                                                                 <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>
                                                                
                                                                 <div class="input-group input-group-sm">
                                                                     <input class="form-control date-picker" id="id-date-picker-1" name="data[fromDate]" type="text" data-date-format="dd-mm-yyyy" />
                                                                     <span class="input-group-addon">
                                                                         <i class="fa fa-calendar bigger-110"></i>
                                                                     </span>
                                                                 </div>
                                                             </div>
                                                              <div class="col-sm-4">
                                                                 <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>
                                                                
                                                                 <div class="input-group input-group-sm">
                                                                     <input class="form-control date-picker" id="id-date-picker-1" name="data[toDate]" type="text" data-date-format="dd-mm-yyyy" />
                                                                     <span class="input-group-addon">
                                                                         <i class="fa fa-calendar bigger-110"></i>
                                                                     </span>
                                                                 </div>
                                                             </div>                
                                                                          
                                                                                
                                                        </div>                      
                                                      
                                                        <div class="col-xs-12">
                                                            <div class="clearfix form-actions">
                                                                <div class="col-md-12">
                                                                    <button class="btn btn-success" name="search" type="submit">
                                                                        <i class="ace-icon fa fa-check bigger-110"></i> Search Student Attendance Information
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>        
                                                </form>
                                              
                                        
                                            </div><!-- /.col-x12 -->

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

                                        <form class="form-horizontal" role="form" action="<?php echo teacher_Url(); ?>/studentsattendance/searchattendancebyclass" method="post">
                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                                        <option value="">Select</option>
                                                        <?php foreach (getOfferedSession() as $value) { ?>
                                                            <option value="<?php echo $value['sessionId']; ?>" >
                                                                <?php echo $value['session']; ?></option>                                                
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId(); " name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                                                    </select>
                                                </div>                                                
                                                <div class="col-sm-4">
                                                     <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>
                                                    
                                                     <div class="input-group input-group-sm">
                                                         <input class="form-control date-picker" name="data[fromDate]" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
                                                         <span class="input-group-addon">
                                                             <i class="fa fa-calendar bigger-110"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                                  <div class="col-sm-4">
                                                     <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>
                                                    
                                                     <div class="input-group input-group-sm">
                                                         <input class="form-control date-picker" name="data[toDate]"  id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
                                                         <span class="input-group-addon">
                                                             <i class="fa fa-calendar bigger-110"></i>
                                                         </span>
                                                     </div>
                                                 </div>      

                                            </div> 


                                            <div class="col-xs-12">
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-success" name="search" type="submit">
                                                            <i class="ace-icon fa fa-search bigger-120"></i>
                                                            Search Student Attendance
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

                    <?php
                if (!empty($attendancelist)) {
            ?>   
                    <div class="row">
                    
                      <div class="col-sm-7 col-md-offset-2">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b> Enrollment Information</b>
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
                Marks Entry Form
            </div>
        <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">
                                    Sl No.
                                </th>

                                <th class="hidden-480">Student ID</th>
                                <th class="hidden-480">Student Name</th>
                                   <th class="hidden-480">Date</th>
                                <th class="hidden-480">Status</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $sl=1;
                                    foreach ($attendancelist as $value) {

                              ?>

                            <tr>
                                <td class="center">
                                    <?php echo $sl++; ?>
                                </td>

                                <td>
                                    <a href="#">
                                            <?php
                                            if (!empty($value['studentId'])) {
                                                echo ($value['studentId']);
                                            }
                                            ?>                                
                                    </a>
                                  
                                </td>

                                <td>
                                            <?php
                                            if (!empty($value['firstName'])) {
                                                echo ($value['firstName']);
                                            }
                                            ?>
                                </td>

                                 <td>
                                    <a href="#">
                                            <?php
                                            if (!empty($value['attendanceDate'])) {
                                                echo ($value['attendanceDate']);
                                            }
                                            ?>                                
                                    </a>
                                    
                                </td>

                                <td>
                                      
                                      <?php
                               $empatdc= getattendanceStatus($value['attendanceStatus']);
                               
                                 if(!empty($empatdc)){
                                               
                                               $status= $value['attendanceStatus'];
                                           }
                                           else{
                                               $status=0;
                                           }
                                ?>
                                  <?php 
                                        if($status==1)
                                        {                                        
                                       ?>
                                            <a class="green" href="#" title="Present">
                                                    <i class="ace-icon fa fa-check bigger-130"></i>
                                                    Present
                                                </a>
                                        <?php
                                            }
                                            elseif($status==2)
                                            {
                                         ?>
                                        <a class="red" href="#" title="Absent">
                                                    <i class="ace-icon fa fa-times bigger-130"></i>
                                                    Absent
                                                </a>
                                          <?php
                                            }
                                            else{
                                               echo ""; 
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
        </div><!-- /.col-x12 -->
        
    </div> <!-- /.row --> 
    </div>
        </div>
    
