<!-- ASIDE NAV AND CONTENT -->
<div class="line" style="height: auto">
    <div class="box margin-bottom">
        <div class="margin">
            <!-- ####################################################################################################### -->
            <div class="wrapper col3">
                <div id="container_box">

                    <?php
                    $programInfo=getofferProgramInfoById($programOfferId);
                    ?>
                    <h2>
                        <h3 class="titlehd">
                            Class Routine Information of <?php echo getProgramName($programInfo['programId']). "(". getsectionName($programInfo['sectionId']).")";   ?>
                        </h3>
                        &nbsp;&nbsp;&nbsp;
                        <span class="text-right">
            <?php

            foreach (getPeriodInfoArray() as $key => $value) {
                if($key ==0){
                    echo "Break Time: ".getPeriodTime($programInfo['shiftId'],$key);
                }
            }
            ?>
        </span>

                        <br>

                        <hr>


                        <div style="margin: 10px auto; border:0px solid black;width: 100%; height: 100%; text-align: center">

                            <div style="margin: 0px; border:1px solid #D8D8D8; width: 15%; float: left;clear: right; height: 99.5% ">

                                <section style="background: #EAEAEA; padding-top: 10px; border-bottom: 1px solid black; width: 100%;height: 52px ">
                                    Day/Time-Period
                                </section>


                                <?php foreach (getDay() as $key => $value) { ?>

                                    <section style="background: #EAEAEA; padding-top: 20px; border-bottom: 1px solid black; width: 100%; height: 125px ">
                                        <?php if(!empty($value)){echo $value;}  ?>
                                    </section>
                                <?php }   ?>
                            </div>


                            <div style="margin: 0px; border:0px solid black; width: 84%; float: right;height: 100% ">
                                <div style="margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 53px ">
                                    <?php

                                    foreach (getPeriodInfoArray() as $key => $value) {
                                        if($key !=0){
                                            ?>

                                            <section style="background: #EAEAEA; padding: 5px 0px 0px; border-right:1px solid #A2B6C8; width: 10.98%;float: left; clear:right;  height: 92%">
                                                <?php  echo $value. "</br>". getPeriodTime($programInfo['shiftId'],$key);  ?>

                                            </section>
                                        <?php } }  ?>
                                </div>

                                <div style="background: #fff; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 125px; ">
                                    <?php
                                    foreach($classroutine as $value)
                                    {
                                        if($value['dayName'] =="Saturday" )
                                        {


                                            ?>

                                            <section style="  padding-top: 7px; border-right:1px solid #D8D8D8; width: 10.98%;float: left; clear:right;  height: 91% ">
                                                <?php
                                                foreach (getPeriodInfoArray() as $key => $vass) {
                                                    if(($value['periodId']==$key) && ($key !=0)){

                                                        if(!empty($value['courseId']))
                                                        {
                                                            echo getCourseName($value['courseId']). "</br>";
                                                            $id = getAssignTeacher($value['courseId']);
                                                            //    echo $id;
                                                            if(!empty($id)){
                                                                $techerinfo=getTeacher($id);
                                                                ?>
                                                                <a style="color: blue;" href="#"><?php  echo $techerinfo['firstName']." ".$techerinfo['lastName'];  ?> </a>
                                                                <?php
                                                            }

                                                            else{
                                                                ?>
                                                                <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                <?php
                                                            }
                                                        }
                                                    }


                                                }
                                                ?>

                                            </section>


                                            <?php

                                        }
                                    }
                                    ?>
                                </div>

                                <div style="background: #EAEAEA; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 125px ">
                                    <?php
                                    foreach($classroutine as $value)
                                    {
                                        if($value['dayName'] =="Sunday" )
                                        {


                                            ?>

                                            <section style="padding-top: 7px; border-right:1px solid #D8E7ED; width: 10.98%;float: left; clear:right;  height: 87% ">
                                                <?php
                                                foreach (getPeriodInfoArray() as $key => $vass) {
                                                    if(($value['periodId']==$key) && ($key !=0)){

                                                        if(!empty($value['courseId']))
                                                        {
                                                            echo getCourseName($value['courseId']). "</br>";
                                                            $id = getAssignTeacher($value['courseId']);

                                                            if(!empty($id)){
                                                                $techerinfo=getTeacher($id);
                                                                ?>
                                                                <a style="color: blue;" href="#"><?php  echo $techerinfo['firstName']." ".$techerinfo['lastName'];  ?> </a>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                <?php
                                                            }
                                                        }
                                                    }


                                                }
                                                ?>
                                            </section>


                                            <?php

                                        }
                                    }
                                    ?>
                                </div>
                                <div style="background: #fff; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 125px ">
                                    <?php
                                    foreach($classroutine as $value)
                                    {
                                        if($value['dayName'] =="Monday" )
                                        {


                                            ?>

                                            <section style="padding-top: 7px; border-right:1px solid #D8E7ED; width: 10.98%;float: left; clear:right;  height: 87% ">
                                                <?php
                                                foreach (getPeriodInfoArray() as $key => $vass) {
                                                    if(($value['periodId']==$key) && ($key !=0)){

                                                        if(!empty($value['courseId']))
                                                        {
                                                            echo getCourseName($value['courseId']). "</br>";
                                                            $id = getAssignTeacher($value['courseId']);
                                                            //    echo $id;
                                                            if(!empty($id)){
                                                                $techerinfo=getTeacher($id);
                                                                ?>
                                                                <a style="color: blue;" href="#"><?php  echo $techerinfo['firstName']." ".$techerinfo['lastName'];  ?> </a>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                <?php
                                                            }
                                                        }
                                                    }


                                                }
                                                ?>
                                            </section>


                                            <?php

                                        }
                                    }
                                    ?>
                                </div>
                                <div style="background: #EAEAEA; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 125px ">
                                    <?php
                                    foreach($classroutine as $value)
                                    {
                                        if($value['dayName'] =="Tuesday" )
                                        {


                                            ?>

                                            <section style="padding-top: 7px; border-right:1px solid #D8E7ED; width: 10.98%;float: left; clear:right;  height: 87% ">
                                                <?php
                                                foreach (getPeriodInfoArray() as $key => $vass) {
                                                    if(($value['periodId']==$key) && ($key !=0)){

                                                        if(!empty($value['courseId']))
                                                        {
                                                            echo getCourseName($value['courseId']). "</br>";
                                                            $id = getAssignTeacher($value['courseId']);
                                                            //    echo $id;
                                                            if(!empty($id)){
                                                                $techerinfo=getTeacher($id);
                                                                ?>
                                                                <a style="color: blue;" href="#"><?php  echo $techerinfo['firstName']." ".$techerinfo['lastName'];  ?> </a>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                <?php
                                                            }
                                                        }
                                                    }


                                                }
                                                ?>
                                            </section>


                                            <?php

                                        }
                                    }
                                    ?>
                                </div>
                                <div style="background: #fff;margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 125px ">
                                    <?php
                                    foreach($classroutine as $value)
                                    {
                                        if($value['dayName'] =="Wednessday" )
                                        {


                                            ?>

                                            <section style="padding-top: 7px; border-right:1px solid #D8E7ED; width: 10.98%;float: left; clear:right;  height: 87% ">
                                                <?php
                                                foreach (getPeriodInfoArray() as $key => $vass) {
                                                    if(($value['periodId']==$key) && ($key !=0)){

                                                        if(!empty($value['courseId']))
                                                        {
                                                            echo getCourseName($value['courseId']). "</br>";
                                                            $id = getAssignTeacher($value['courseId']);
                                                            //    echo $id;
                                                            if(!empty($id)){
                                                                $techerinfo=getTeacher($id);
                                                                ?>
                                                                <a style="color: blue;" href="#"><?php  echo $techerinfo['firstName']." ".$techerinfo['lastName'];  ?> </a>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                <?php
                                                            }
                                                        }
                                                    }


                                                }
                                                ?>
                                            </section>


                                            <?php

                                        }
                                    }
                                    ?>
                                </div>
                                <div style="background: #EAEAEA; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 125px ">
                                    <?php
                                    foreach($classroutine as $value)
                                    {
                                        if($value['dayName'] =="Thursday" )
                                        {


                                            ?>

                                            <section style="padding-top: 7px; border-right:1px solid #D8E7ED; width: 10.98%;float: left; clear:right;  height: 87% ">
                                                <?php
                                                foreach (getPeriodInfoArray() as $key => $vass) {
                                                    if(($value['periodId']==$key) && ($key !=0)){

                                                        if(!empty($value['courseId']))
                                                        {
                                                            echo getCourseName($value['courseId']). "</br>";
                                                            $id = getAssignTeacher($value['courseId']);
                                                            //    echo $id;
                                                            if(!empty($id)){
                                                                $techerinfo=getTeacher($id);
                                                                ?>
                                                                <a style="color: blue;" href="#"><?php  echo $techerinfo['firstName']." ".$techerinfo['lastName'];  ?> </a>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <a style="color: red;" href="#"> <?php echo "Teacher Not initialized"; ?> </a>
                                                                <?php
                                                            }
                                                        }
                                                    }


                                                }
                                                ?>
                                            </section>


                                            <?php

                                        }
                                    }
                                    ?>
                                </div>

                            </div>


                        </div>
                    
           
           