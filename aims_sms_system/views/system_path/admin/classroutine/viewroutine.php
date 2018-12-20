<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            View Class Routine           
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
              <?php
                    if (!empty($class_routine_info)) {                       
              ?>
                 <?php
                $programInfo = getofferProgramInfoById($programOfferId);
                ?>
                 <strong><h3 class="red">
                     Class Routine  </strong></br>
                    

                                       <h4 class="green"><i class="ace-icon fa fa-caret-right blue"></i>Class: <?php echo getProgramName($programInfo['programId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Medium: <?php echo getmediumName($programInfo['mediumId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;

                                        <i class="ace-icon fa fa-caret-right blue"></i>Shift: <?php echo getshiftName($programInfo['shiftId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Group: <?php echo getGroupName($programInfo['groupId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Section: <?php echo getsectionName($programInfo['sectionId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Session: <?php echo getSessionName($programInfo['sessionId']) . "</b>";
                                        ?>
                
                    &nbsp;&nbsp;&nbsp;
                        <?php
                    
                       //   echo "<pre>" ;   print_r($classroutineinfo);
                        foreach (getPeriodInfoArray() as $key => $value) {
                            if ($key == 0) {
                                echo "";
                            }
                        }
                        ?>
                  
             </h4>
                <hr>
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                        <?php foreach (getDay() as $key => $value) {
                                $tab_id="#home".$key;
                                if($tab_id=="#homeSaturday"){ $activ="active";}else{ $activ="";}
                            ?>
                            <li class="<?php echo $activ; ?>">
                                <a data-toggle="tab" href="<?php echo $tab_id; ?>">
                                    <?php 
                                        if (!empty($value)) {
                                            echo $value;
                                        } 
                                    ?>
                                </a>
                            </li>
                        <?php } ?>        
                    </ul>
                    <div class="tab-content">
                        <?php 
                            if ($periodlist) :
                            foreach (getDay() as $key1 => $val1) : 
                            $tabb_id="home".$key1;
                            if($tabb_id=="homeSaturday"){ $active="active";}else{ $active="";}
                        ?>
                            <div id="<?php echo $tabb_id; ?>" class="tab-pane in <?php echo $active; ?>">
                                <div>
                                    <h4 class="red" style="text-align:center;"><?php echo $val1; ?></h4>
                                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                        <?php foreach ($periodlist as $val) : ?>
                                                <th class="center" style="width: 140px;"><?php echo $val['periodName']; ?><br><?php echo $val['periodTime'];?></th>
                                        <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php foreach ($periodlist as $val) : ?>
                                                <td style="vertical-align: middle;text-align: center;"><?php echo isset($class_routine_info[$key1][$val['periodId']]['course_employee_name']) ? $class_routine_info[$key1][$val['periodId']]['course_employee_name'] : "Nill"; ?></td>
                                            <?php endforeach; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                        </div>
                 
             <?php
                   }
             ?>
             
        </div>
    </div> 