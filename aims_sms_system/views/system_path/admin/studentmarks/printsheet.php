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
                    Print
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>           
        </div>
        <div class="col-xs-12 col-sm-12" id="printableArea">
             <div class="row">
                        
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="row">
                                <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                            <tr style=" font-family: cambria;">
                                <td style="text-align: center;">
                                    <p style="margin-left:5px;">
                                        <?php
                                        $ins_info = getInstituteInfo();
                                        ?>

                                        
                                    <div style="font-size: 20px; font-size: 27px; color: royalblue;">
                                      <img src="<?php echo base_Url() . $ins_info['logo'] ?>" height="50">
                                        <?php
                                        $ins_name = getInstituteInfo();
                                        echo $ins_name['instituteName'];
                                        ?>
                                    </div>
                                    <div style="line-height: 3px; font-size: 22px; color: #444;">
                                        <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?>
                                    </div>
                                    <div class="center">
                                        <h4>Student Mark Entry Form</h4>
                                    </div>
                                    </p>

                                </td>

                            </tr>

                            
                        </table>
                               
                            </div>
                        </div>    
                      
                            <div class="col-xs-12 col-sm-12">                             
                                <div class="row">
                                        <div class="col-xs-12 label label-lg label-success arrowed-in arrowed-right">
                                            <ul class="list-unstyled">
                                            <li>
&nbsp;&nbsp;
                                                <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                                <?php 
                                                      echo "<b>".getSessionName($sessionId)."</b>";                                                
                                                  ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                                    <?php
                                                          echo "<b>" . getProgramName($programId) . "</b>";
                                                    ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                                    <?php
                                                    echo "<b>" . getmediumName($mediumId) . "</b>";
                                                    ?> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                                 <?php
                                                          echo "<b>" . getshiftName($shiftId) . "</b>";
                                                    ?> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                                <?php
                                                          echo "<b>" . getGroupName($groupId) . "</b>";
                                                    ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                                                <?php
                                                          echo "<b>" . getsectionName($sectionId) . "</b>";
                                                    ?> 
                                            </li>
                                        </ul>
                                        </div>
                                        
                                </div>
                            </div>
                            

                            <div class="col-xs-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-xs-12 label label-lg label-purple arrowed-in arrowed-right">
                                                <ul class="list-unstyled">
                                                <li>
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Subject: 
                                                    <?php 
                                                           echo "<b>".getCourseName($courseId)."</b>";                                                
                                                      ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <i class="ace-icon fa fa-caret-right blue"></i>Teacher: 
                                                        <?php
                                                            $name=getTeacher($employeeId);
                                                             echo "<b>".$name['firstName'] . " " . $name['lastName']."</b>";    
                                                        ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Exam: 
                                                        <?php 
                                                         echo "<b>". getSemesterName($semesterId)."</b>";
                                                         ?>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                        
                            </div>   <!-- /.col -->

                    
                    </div><!-- /.row -->
            

            <!-- div.dataTables_borderWrap -->
            <div>
            <table id="simple-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="hidden-480 center">
                        Sl No.
                    </th>

                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>Roll No</th>
                    <?php
                    if (!empty($dividemark)) {

                        $mark_val = explode(",", trim($dividemark['divide_mark'], ","));

                        $mark_ttl = explode(",", trim($dividemark['mark_cat_id'], ","));
                        $count_markval = count($mark_val);

                        for ($mrk = 0; $mrk < $count_markval; $mrk++) {
                            $mark_val[$mrk];
                            $mrkttl = getMarkTitle($mark_ttl[$mrk]);
                            ?>
                            <th><?php echo $mrkttl . "-" . $mark_val[$mrk]; ?></th>
                            <?php
                        }
                        ?>
                        


                        <?php
                    }
                    ?>
                    <!--<th>Total Marks</th>-->
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
                                        <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'];
                                            }
                                          ?> 
                            </td>

                            <td><?php if (!empty($value['firstName'])) { echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName']; } ?></td>
                            <td><?php echo isset($student_roll[$value['studentId']]) ? $student_roll[$value['studentId']] : ''; ?></td>
                          
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
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


    
    
    
    
    
    

    
    
    
    
    
