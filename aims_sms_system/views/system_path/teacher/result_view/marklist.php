<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Student Result Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Generate Tabulation Sheet
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
        
        <?php
                if (!empty($studentlist)) {
            ?>
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                   
                <!-- PAGE CONTENT ENDS -->
                <div class="row">
                    
                        <div class="col-sm-8 col-sm-offset-2">
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
                Student List
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
              
                     <form  action="<?php echo admin_Url(); ?>/student/generateId"  method="post"> 
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                Sl No.
                            </th>
                            <th class="hidden-480">Subject</th>
                            <th class="hidden-480">Semester</th>
                            <th class="hidden-480">Exam Type</th>
                            <th class="hidden-480">Total Mark</th>
                            
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
                         
                            <td><?php
                                            if (!empty($value['courseId'])) {
                                                echo getCourseName($value['courseId']);
                                            }
                                            ?>
                                            <input type="hidden" name="data[courseId]" value ="<?php if (!empty($value['courseId'])) {
                                        echo $value['courseId'];
                                    } ?>" 
                            </td>

                            <td>  
                                <?php
                                            if (!empty($value['semester'])) {
                                                echo getSemesterName($value['semester']);
                                            }
                                            ?>
                                            <input type="hidden" name="data[semester]" value ="<?php if (!empty($value['semester'])) {
                                        echo $value['semester'];
                                    } ?>"      />  
                            </td>
                           
                            <td>
                              <?php
                                            if (!empty($value['exam_type'])) {
                                                echo getExamTypeName($value['exam_type']);
                                            }
                                            ?>
                                            <input type="hidden" name="data[exam_type]" value ="<?php if (!empty($value['exam_type'])) {
                                        echo $value['exam_type'];
                                    } ?>" /> 
                            </td>
                            
                             <td class="hidden-480">
                                
                                <?php
                                            if (!empty($value['marks'])) {
                                                echo $value['marks'];
                                            }
                                            ?>
                                            <input type="hidden" name="data[marks]" value ="<?php if (!empty($value['marks'])) {
                                                echo $value['marks'];
                                            } ?>"   />
                            </td>

                       
                            <td class="hidden-480">
                                        <?php
                                                if ($value['photo']) {
                                            ?>
                                            <img  src="<?php if (file_exists($value['photo'])) { echo base_url() . $value['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
                                        <?php 
                                        
                                            } 
                                          ?>
                            </td>

                        
                        </tr>
                           <?php
                                  }
                            ?>
                      
                     </tbody>   
                </table> <br>
                    
                     <button class="btn btn-primary" type="submit" name="generateid">Generate Student Id Card </button>
                   </form>
                </div>
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 
    
    
    
    
    
    
    
    
    
