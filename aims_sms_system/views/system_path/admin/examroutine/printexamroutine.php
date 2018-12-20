    <div class="row">
        <?php
                if (!empty($examroutine)) {
            ?>
        <div class="page-header">
                 <a href="<?php echo base_url('systemaccess/examroutine/viewexamroutine'); ?>" class="btn btn-grey">
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
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="table-header center arrowed-in arrowed-right">
                                    <?php
                                            $ins_name=  getInstituteName();                                           
                                    ?>
                                    <b> <?php echo $ins_name; ?></b>
                                    <small class="brown">
                                            <i class="ace-icon fa fa-angle-double-right"></i>
                                            Exam Routine
                                    </small>
                                    <small class="pull-right">
                                            Date: <?php echo date("m/d/Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </small>
                                   
                                </div>
                               
                            </div>
                               <h3 class="widget-title grey lighter">
                             <center>  <i class="ace-icon fa fa-bullhorn"></i>
                             Exam Routine of <strong><?php echo getProgramName($programinfo['programId']);   ?></strong></center>
                            
                        </h3>
                          <!-- <div class="col-xs-12 col-sm-9 col-sm-offset-2 ">
                                        <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                            <?php 
                                                       echo "<b>".getSessionName($sessionId)."</b>";                                                

                                              ?>
                                        &nbsp;&nbsp;&nbsp;
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
                                        <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                            <?php
                                                      echo "<b>" . getGroupName($groupId) . "</b>";
                                                ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                            <?php
                                                      echo "<b>" . getGroupName($groupId) . "</b>";
                                                ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                         <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                             <?php
                                                      echo "<b>" . getshiftName($shiftId) . "</b>";
                                                ?>
                             </div> --> 
                        </div><!-- /.col -->


                    </div><!-- /.row -->
            
                    
            <!-- div.dataTables_borderWrap -->
            <div>
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th>Sl No.</th>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Subject</th>
                                    <th>Room</th>
                                    <th>Time Slot</th>
                                    
                                   
                                    


                                    
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($examroutine as $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php if (!empty($value['date'])) { echo $value['date'];
                                                    }
                                                    ?> </td>
                                        <td> <?php
                                            $timestamp = strtotime($value['date']);
                                            $day = date('l', $timestamp);
                                            
                                            echo $day;
                                       ?> </td>
                                        <td> <?php
                                        if(!empty($value['courseId'])){  echo getCourseName($value['courseId']);   }
                                       ?> </td>
                                        <td>
                                                <?php
                                        if(!empty($value['room'])){  echo $value['room'];   }
                                       ?> 
                                        </td>
                                        <td>    <?php
                                        if(!empty($value['examtime'])){  echo $value['examtime'];   }
                                       ?></td>
                                        

                                      
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