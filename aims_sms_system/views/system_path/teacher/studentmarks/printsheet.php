<div class="row">
        <?php
                if (!empty($studentlist)) {
            ?>
        <div class="page-header">
                 <a href="<?php echo base_url('systemaccess/studentmarks'); ?>" class="btn btn-grey">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Go Back
                 </a>
                <button class="btn btn-success " onclick="printDiv('printableArea')">
                    Print A Copy
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>           
        </div>
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
                                    <div class="col-xs-12 col-sm-7">
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
                                    <div class="col-xs-12 col-sm-5">
                                        <ul class="list-unstyled spaced">
                                           

                                            <li>
                                                <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                                 <?php
                                                          echo "<b>" . getshiftName($shiftId) . "</b>";
                                                    ?>
                                            </li>

                                            <li>
                                                <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                                <?php
                                                          echo "<b>" . getGroupName($groupId) . "</b>";
                                                    ?>
                                            </li>

                                        </ul>
                                    </div>
                                 </div>   
                                 <div class="col-xs-12 col-sm-6">
                                    

                                    <div class="col-xs-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right">
                                                <b> Result Information</b>
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
                                <input type="text" name="marks[]" value="<?php echo set_value('marks'); ?>" class="form-control" id="form-field-1">                                
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


    
    
    
    
    
    

    
    
    
    
    
