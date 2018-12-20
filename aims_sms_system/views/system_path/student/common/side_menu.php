
<div class="main-container main-container-fixed" id="main-container">


    <div id="sidebar" class="sidebar responsive sidebar-fixed">

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <a href="#" target="_blank" class="btn btn-danger btn-block">Visit Homepage</a>

        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="<?php if(!empty($dashboard)){ echo $dashboard; } ?>">  <!-- call active class  -->
                <a href="<?php echo student_Url(); ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="<?php if(!empty($profile)){ echo $profile; } ?>">  <!-- call active class  -->
                <a href="<?php echo student_Url();?>/student/profile" >
                    <i class="menu-icon fa fa-dribbble"></i>
                    <span class="menu-text">
                        Profile
                    </span>

                    
                </a>

               

             
            </li>
            
                 <li class="<?php
                            if (!empty($homeworklistdata)) {
                                echo $homeworklistdata;
                            }
                            ?>">
                                <a href="<?php echo student_Url();?>/homework/searchhomework">
                                   <i class="menu-icon fa fa-list-alt"></i>
                                   Homework 
                                </a>

                                <b class="arrow"></b>
                            </li>
                            
                                 <li class="<?php
                            if (!empty($syllabus)) {
                                echo $syllabus;
                            }
                            ?>">
                                <a href="<?php echo student_Url();?>/syllabus/index">
                                    <i class="menu-icon fa fa-folder-open"></i>
                                   Syllabus 
                                </a>

                                <b class="arrow"></b>
                            </li>

                    <li class="<?php
                    if (!empty($timetable)) {
                        echo $timetable;
                    }
                    ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon ace-icon fa fa-bell-o"></i>
                            Time Table
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if (!empty($classroutine)) {
                        echo $classroutine;
                    } ?>">
                                <a href="<?php echo student_Url(); ?>/classroutine/showclassroutine">

                                    <span class="menu-text"> Class Routine </span>


                                </a>

                                <b class="arrow"></b>


                            </li>

                            <li class="<?php
                    if (!empty($eroutine)) {
                        echo $eroutine;
                    }
                    ?>">
                                <a href="<?php echo student_Url(); ?>/examroutine/showexamroutine">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Examination Routine
                                </a>

                                <b class="arrow"></b>
                            </li>
                                   <li class="<?php
                    if (!empty($timetablelist)) {
                        echo $timetablelist;
                    }
                    ?>">
                                <a href="#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Academic Calendar
                                </a>

                                <b class="arrow"></b>
                            </li>
                            
                            <li class="<?php
                            if (!empty($timetablelist)) {
                                echo $timetablelist;
                            }
                            ?>">
                                <a href="#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Event Schedule
                                </a>

                                <b class="arrow"></b>
                            </li>
                            
                        </ul>
                    </li>
                    
                 
                       <li class="<?php if(!empty($attendance)) { echo $attendance; }?>">
                        <a href="<?php echo student_Url();?>/studentsattendance/index">
                          <i class="menu-icon ace-icon glyphicon glyphicon-check"></i>
                           Attendance List
                            
                        </a>

                        <b class="arrow"></b>

                    </li>

                                        
                       <li class="<?php if(!empty($resultview)) { echo $resultview; }?>">
                        <a href="<?php echo student_Url();?>/result_view/index">
                          <i class="menu-icon ace-icon fa fa-bullhorn"></i>
                           Result 
                            
                        </a>

                        <b class="arrow"></b>

                    </li>

                          <li class="<?php if(!empty($payment)) { echo $payment; }?>">
                        <a href="<?php echo student_Url();?>/payment/index">
                           <i class="menu-icon fa fa-dollar"></i>
                          Payment
                            
                        </a>

                        <b class="arrow"></b>

                    </li>

                <li class="">
                        <a href="#">
                              <i class="menu-icon glyphicon glyphicon-book"></i>
                         
                          Library
                            
                        </a>

                        <b class="arrow"></b>

                    </li>


                  <li class="">
                        <a href="#">
                           <i class="menu-icon fa fa-bus"></i>
                         Transport 
                            
                        </a>

                        <b class="arrow"></b>

                    </li>

                    <li class="">
                          <a href="">
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Hostel </span>
                           
                        </a>
                          <b class="arrow"></b>

                      </li>




                       <li class="<?php if(!empty($stucmt)) { echo $stucmt; }?>">
                           <a href="<?php echo student_Url();?>/student/studentComment">
                            <i class="menu-icon fa fa-caret-right"></i>
                           Student Activities 
                            
                        </a>

                        <b class="arrow"></b>

                    </li>

         


        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>


    </div>