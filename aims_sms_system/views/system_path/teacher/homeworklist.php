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
                            Homework Information
                        </h3>

                        

                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-print"></i>
                                <a href="#" onclick="printDiv('printableArea')" role="button" class="green" > Print Homework Information</a>
                                
                            
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
                                                      <div class="col-xs-10 col-sm-4">
                                                              <label class="control-label" for="form-field-1">Teacher Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                                                              <select name="data[employeeId]" class="form-control">
                                                                  <option value="">Select</option>
                                                                  <?php foreach (getTeacherInfoArray() as $value) { ?>
                                                                      <option value="<?php echo $value['employeeId']; ?>" 
                                                                              <?php echo set_select('data[employeeId]', $value['employeeId'], FALSE) ?> >
                                                                          <?php echo $value['firstName'] . " " . $value['lastName']; ?></option>                                                
                                                                  <?php } ?>
                                                              </select>
                                                          </div>

                                                  </div> 


                                            <div class="col-xs-12">
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-success" name="search" type="submit">
                                                            <i class="ace-icon fa fa-search bigger-120"></i>
                                                           Search Homework Information
                                                        </button>
                                                        <button class="btn btn-purple" name="print" type="submit">
                                                            <i class="ace-icon fa fa-print bigger-120"></i>
                                                           Print Homework Information
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
                    
                        <div class="col-sm-7">
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
                        <div class="col-sm-4 ">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right">
                                    <b> Subject Information</b>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Subject: 
                                            <?php 
                                                     echo "<b>".getCourseName($courseId)."</b>";                                                

                                              ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Teacher Name: 
                                                <?php
                                                    $name=getTeacher($employeeId);
                                                     echo "<b>".$name['firstName'] . " " . $name['lastName']."</b>";    
                                                ?>
                                        </li>
                                    </ul>
                                </div>
                             </div>   
                             
                        </div><!-- /.col -->

                    </div><!-- /.row -->
            </div>    
          

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
          
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 
    
    <hr>
    <div class="col-sm-12">
        <?php
                        

                        foreach ($homeworklist as $value) {
                            ?>
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">
                    Subject : 
                                   
                    <small> <?php
                                    if (!empty($value['courseId'])) {
                                        echo getCourseName($value['courseId']);
                                    }
                                    ?> </small>
                </h4>
                
              <div class="widget-toolbar">
                        Date: <?php
                    if (!empty($value['date'])) {
                        echo $value['date'];
                    }
                            ?>
                    </div>
            </div>
            
           

            <div class="widget-body">
                <div class="widget-main">
                    <p class="muted">
                       <?php
                                $string = $value['homework'];
                                $string = character_limiter($string, 100);
                                echo $string;
                                ?>
                    </p>

                   

                    <p>
                        
                      <!--  <a href="<?php echo admin_Url() . "/homework/viewhomework/" . $value['hwId']; ?>" class="btn btn-info btn-sm tooltip-info" data-rel="tooltip" >More</a>
                 -->   </p>
                      <?php
                          
                        }
                        ?>
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    <!-- +++++++++++++++++++++ PRINT COPY CODE +++++++++++++++++++++++++++++++++++ -->
    
    <!-- Print Marks Entry List........ -->
    
    
        <div class="row  hidden">
        <?php
                if (!empty($studentlist)) {
            ?>
        
        <div class="col-xs-12 col-sm-12" id="printableArea">
             <div class="row">
                        
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="row">
                                <div class="table-header center arrowed-in arrowed-right">
                                   <?php
                                            $ins_name=  getInstituteName();
                                           
                                        ?>
                                    <b> <?php echo $ins_name; ?></b>
                                    <small class="brown">
                                            <i class="ace-icon fa fa-angle-double-right"></i>
                                            Marks Entry Form
                                    </small>
                                    <small class="pull-right">
                                            Date: <?php echo date("m/d/Y"); ?>
                                    </small>
                                   
                                </div>
                               
                            </div>
                             <hr>
                        </div>    
                      
                            <div class="col-xs-12 col-sm-12">                                

                                <div class="col-xs-12 col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                            <b> Enrollment Information</b>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
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
                                    <div class="col-xs-12 col-sm-6">
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
                                 <div class="col-xs-12 col-sm-6">
                                    

                                    <div class="col-xs-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right">
                                                <b> Subject Information</b>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="list-unstyled spaced">
                                                <li>
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Subject: 
                                                    <?php 
                                                               echo "<b>".getCourseName($courseId)."</b>";                                                

                                                      ?>
                                                </li>

                                                <li>
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Teacher Name: 
                                                        <?php
                                                            $name=getTeacher($employeeId);
                                                             echo "<b>".$name['firstName'] . " " . $name['lastName']."</b>";    
                                                        ?>
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Semester: 

                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Exam Type: 

                                                </li>
                                            </ul>
                                        </div>
                                     </div>   
                                 </div>   
                            </div><!-- /.col -->
                    
                    </div><!-- /.row -->
            

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                Sl No.
                            </th>

                            <th class="hidden-480">Student Id</th>
                            <th class="hidden-480">Student Name</th>
                            <th class="hidden-480">Marks</th>
                           
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
                                <a href="#">
                                        <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'];
                                            }
                                          ?>                                    
                                </a>
                            </td>

                            <td><?php if (!empty($value['firstName'])) { echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName']; } ?></td>
                          
                            <td class="hidden-480">
                                <input type="text" name="marks[]" placeholder="Insert Subject Obtain Mark" value="<?php echo set_value('marks'); ?>" class="form-control" id="form-field-1">                                
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


    
    
    
    
    
    

    
    
    
    
    
