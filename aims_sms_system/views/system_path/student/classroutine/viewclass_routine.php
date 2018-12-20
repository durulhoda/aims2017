<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">

<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            View Your Class Routine Information        
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
                    if (!empty($classroutineinfo)) {                       
              ?>
                 <?php
                $programInfo = getofferProgramInfoById($programOfferId);
                ?>
                <h4 class="red">
                     Class Routine Information of <?php echo getProgramName($programInfo['programId']) . "(" . getsectionName($programInfo['sectionId']) . ")"; ?>
                
                    &nbsp;&nbsp;&nbsp;
                        <?php
                        foreach (getPeriodInfoArray() as $key => $value) {
                            if ($key == 0) {
                                echo "Break Time: " . getPeriodTime($programInfo['shiftId'], $key);
                            }
                        }
                        ?>
                  
             </h4>
             
                <hr>
                         <div class="tabbable">
                            <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                                
                                <?php foreach (getDay() as $key => $value) {
                                        $tab_id="#home".$key;
                                        if($tab_id=="#home1"){ $activ="active";}else{ $activ="";}
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
                                <div id="home1" class="tab-pane in active">
                                    <div>
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                         <?php
                                                            foreach (getPeriodInfoArray() as $key => $value) {
                                                                if ($key != 0) {
                                                            ?>
                                                        <th class="center">
                                                            <?php echo $value . "</br>" . getPeriodTime($programInfo['shiftId'], $key); ?>
                                                        </th>
                                                        <?php }
                                                                    } ?>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <tr>
                                                        <?php
                                                                foreach ($classroutineinfo as $value) {
                                                                    if ($value['dayName'] == "Saturday") {
                                                            ?>
                                                                <td>
                                                                        <?php
                                                                        foreach (getPeriodInfoArray() as $key => $vass) {
                                                                            if (($value['periodId'] == $key) && ($key != 5)) {

                                                                                if (!empty($value['courseId'])) {
                                                                                    echo getCourseName($value['courseId']) . "</br>";
                                                                                    $id = getAssignTeacher($value['courseId']);
                                                                                    //    echo $id;
                                                                                    if (!empty($id)) {
                                                                                        $techerinfo = getTeacher($id);
                                                                                        ?>
                                                                                        <a style="color: blue;" href="#"><?php echo $techerinfo['firstName'] . " " . $techerinfo['lastName']; ?> </a>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>            
                                                            
                                                                </td>
                                                         <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </tr>    
                                                </tbody>   
                                            </table>   
                                        </div>
                                    
                                </div>

                                <div id="home2" class="tab-pane">
                                    <div>
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                         <?php
                                                            foreach (getPeriodInfoArray() as $key => $value) {
                                                                if ($key != 5) {
                                                            ?>
                                                        <th class="center">
                                                            <?php echo $value . "</br>" . getPeriodTime($programInfo['shiftId'], $key); ?>
                                                        </th>
                                                        <?php }
                                                                    } ?>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <tr>
                                                        <?php
                                                                foreach ($classroutineinfo as $value) {
                                                                    if ($value['dayName'] == "Sunday") {
                                                            ?>
                                                                <td>
                                                                        <?php
                                                                        foreach (getPeriodInfoArray() as $key => $vass) {
                                                                            if (($value['periodId'] == $key) && ($key != 5)) {

                                                                                if (!empty($value['courseId'])) {
                                                                                    echo getCourseName($value['courseId']) . "</br>";
                                                                                    $id = getAssignTeacher($value['courseId']);
                                                                                    //    echo $id;
                                                                                    if (!empty($id)) {
                                                                                        $techerinfo = getTeacher($id);
                                                                                        ?>
                                                                                        <a style="color: blue;" href="#"><?php echo $techerinfo['firstName'] . " " . $techerinfo['lastName']; ?> </a>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>            
                                                            
                                                                </td>
                                                         <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </tr>    
                                                </tbody>   
                                            </table>   
                                        </div>
                                </div>
                                <div id="home3" class="tab-pane">
                                    <div>
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                         <?php
                                                            foreach (getPeriodInfoArray() as $key => $value) {
                                                                if ($key != 5) {
                                                            ?>
                                                        <th class="center">
                                                            <?php echo $value . "</br>" . getPeriodTime($programInfo['shiftId'], $key); ?>
                                                        </th>
                                                        <?php }
                                                                    } ?>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <tr>
                                                        <?php
                                                                foreach ($classroutineinfo as $value) {
                                                                    if ($value['dayName'] == "Monday") {
                                                            ?>
                                                                <td>
                                                                        <?php
                                                                        foreach (getPeriodInfoArray() as $key => $vass) {
                                                                            if (($value['periodId'] == $key) && ($key != 5)) {

                                                                                if (!empty($value['courseId'])) {
                                                                                    echo getCourseName($value['courseId']) . "</br>";
                                                                                    $id = getAssignTeacher($value['courseId']);
                                                                                    //    echo $id;
                                                                                    if (!empty($id)) {
                                                                                        $techerinfo = getTeacher($id);
                                                                                        ?>
                                                                                        <a style="color: blue;" href="#"><?php echo $techerinfo['firstName'] . " " . $techerinfo['lastName']; ?> </a>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>            
                                                            
                                                                </td>
                                                         <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </tr>    
                                                </tbody>   
                                            </table>   
                                        </div>
                                </div>
                                <div id="home4" class="tab-pane">
                                   <div>
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                         <?php
                                                            foreach (getPeriodInfoArray() as $key => $value) {
                                                                if ($key != 5) {
                                                            ?>
                                                        <th class="center">
                                                            <?php echo $value . "</br>" . getPeriodTime($programInfo['shiftId'], $key); ?>
                                                        </th>
                                                        <?php }
                                                                    } ?>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <tr>
                                                        <?php
                                                                foreach ($classroutineinfo as $value) {
                                                                    if ($value['dayName'] == "Tuesday") {
                                                            ?>
                                                                <td>
                                                                        <?php
                                                                        foreach (getPeriodInfoArray() as $key => $vass) {
                                                                            if (($value['periodId'] == $key) && ($key != 5)) {

                                                                                if (!empty($value['courseId'])) {
                                                                                    echo getCourseName($value['courseId']) . "</br>";
                                                                                    $id = getAssignTeacher($value['courseId']);
                                                                                    //    echo $id;
                                                                                    if (!empty($id)) {
                                                                                        $techerinfo = getTeacher($id);
                                                                                        ?>
                                                                                        <a style="color: blue;" href="#"><?php echo $techerinfo['firstName'] . " " . $techerinfo['lastName']; ?> </a>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>            
                                                            
                                                                </td>
                                                         <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </tr>    
                                                </tbody>   
                                            </table>   
                                        </div>
                                </div>
                                <div id="home5" class="tab-pane">
                                    <div>
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                         <?php
                                                            foreach (getPeriodInfoArray() as $key => $value) {
                                                                if ($key != 5) {
                                                            ?>
                                                        <th class="center">
                                                            <?php echo $value . "</br>" . getPeriodTime($programInfo['shiftId'], $key); ?>
                                                        </th>
                                                        <?php }
                                                                    } ?>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <tr>
                                                        <?php
                                                                foreach ($classroutineinfo as $value) {
                                                                    if ($value['dayName'] == "Wednessday") {
                                                            ?>
                                                                <td>
                                                                        <?php
                                                                        foreach (getPeriodInfoArray() as $key => $vass) {
                                                                            if (($value['periodId'] == $key) && ($key != 5)) {

                                                                                if (!empty($value['courseId'])) {
                                                                                    echo getCourseName($value['courseId']) . "</br>";
                                                                                    $id = getAssignTeacher($value['courseId']);
                                                                                    //    echo $id;
                                                                                    if (!empty($id)) {
                                                                                        $techerinfo = getTeacher($id);
                                                                                        ?>
                                                                                        <a style="color: blue;" href="#"><?php echo $techerinfo['firstName'] . " " . $techerinfo['lastName']; ?> </a>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>            
                                                            
                                                                </td>
                                                         <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </tr>    
                                                </tbody>   
                                            </table>   
                                        </div>
                                </div>
                                <div id="home6" class="tab-pane">
                                    <div>
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                         <?php
                                                            foreach (getPeriodInfoArray() as $key => $value) {
                                                                if ($key != 5) {
                                                            ?>
                                                        <th class="center">
                                                            <?php echo $value . "</br>" . getPeriodTime($programInfo['shiftId'], $key); ?>
                                                        </th>
                                                        <?php }
                                                                    } ?>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <tr>
                                                        <?php
                                                                foreach ($classroutineinfo as $value) {
                                                                    if ($value['dayName'] == "Thursday") {
                                                            ?>
                                                                <td>
                                                                        <?php
                                                                        foreach (getPeriodInfoArray() as $key => $vass) {
                                                                            if (($value['periodId'] == $key) && ($key != 5)) {

                                                                                if (!empty($value['courseId'])) {
                                                                                    echo getCourseName($value['courseId']) . "</br>";
                                                                                    $id = getAssignTeacher($value['courseId']);
                                                                                    //    echo $id;
                                                                                    if (!empty($id)) {
                                                                                        $techerinfo = getTeacher($id);
                                                                                        ?>
                                                                                        <a style="color: blue;" href="#"><?php echo $techerinfo['firstName'] . " " . $techerinfo['lastName']; ?> </a>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>            
                                                            
                                                                </td>
                                                         <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </tr>    
                                                </tbody>   
                                            </table>   
                                        </div>
                                </div>
                                <div id="home7" class="tab-pane">
                                    <div>
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                         <?php
                                                            foreach (getPeriodInfoArray() as $key => $value) {
                                                                if ($key != 5) {
                                                            ?>
                                                        <th class="center">
                                                            <?php echo $value . "</br>" . getPeriodTime($programInfo['shiftId'], $key); ?>
                                                        </th>
                                                        <?php }
                                                                    } ?>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <tr>
                                                        <?php
                                                                foreach ($classroutineinfo as $value) {
                                                                    if ($value['dayName'] == "Friday") {
                                                            ?>
                                                                <td>
                                                                        <?php
                                                                        foreach (getPeriodInfoArray() as $key => $vass) {
                                                                            if (($value['periodId'] == $key) && ($key != 5)) {

                                                                                if (!empty($value['courseId'])) {
                                                                                    echo getCourseName($value['courseId']) . "</br>";
                                                                                    $id = getAssignTeacher($value['courseId']);
                                                                                    //    echo $id;
                                                                                    if (!empty($id)) {
                                                                                        $techerinfo = getTeacher($id);
                                                                                        ?>
                                                                                        <a style="color: blue;" href="#"><?php echo $techerinfo['firstName'] . " " . $techerinfo['lastName']; ?> </a>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>            
                                                            
                                                                </td>
                                                         <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </tr>    
                                                </tbody>   
                                            </table>   
                                        </div>
                                </div>
                            </div>
                        </div>
                 
             <?php
                   }
             ?>
             
        </div>
    </div> 
        </div>
    </div> 