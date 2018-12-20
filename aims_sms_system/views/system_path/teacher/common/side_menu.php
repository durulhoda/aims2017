
<div class="main-container main-container-fixed" id="main-container">


    <div id="sidebar" class="sidebar responsive sidebar-fixed">

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <a href="#" target="_blank" class="btn btn-danger btn-block">Visit Homepage</a>

        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="<?php if(!empty($dashboard)){ echo $dashboard; } ?>">  <!-- call active class  -->
                <a href="<?php echo teacher_Url(); ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="<?php if(!empty($profile)){ echo $profile; } ?>">  <!-- call active class  -->
                <a href="<?php echo teacher_Url();?>/teacher/profile" >
                    <i class="menu-icon fa fa-dribbble"></i>
                    <span class="menu-text">
                        Profile
                    </span>

                    
                </a>

               

             
            </li>
            
            
            <li class="<?php
            if (!empty($subject)) {
                echo $subject;
            }
            ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Subject
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if (!empty($subjectmark)) {
                echo $subjectmark;
            } ?>">
                        <a href="<?php echo teacher_Url(); ?>/Subjectmarks/index">

                            <span class="menu-text"> Marks Distribute </span>


                        </a>

                        <b class="arrow"></b>


                    </li>

              	
             
              
                </ul>
            </li>
            
            
            <li class="<?php
            if (!empty($result)) {
                echo $result;
            }
            ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Result 
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if (!empty($addresult)) {
                echo $addresult;
            } ?>">
                        <a href="<?php echo teacher_Url(); ?>/studentmarks/index">

                            <span class="menu-text"> Marks Entry </span>


                        </a>

                        <b class="arrow"></b>


                    </li>

                    <li class="<?php
            if (!empty($resultview)) {
                echo $resultview;
            }
            ?>">
                        <a href="<?php echo teacher_Url(); ?>/studentmarks/markslist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Insert Mark List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php
                    if (!empty($resultlist)) {
                        echo $resultlist;
                    }
            ?>">
                        <a href="<?php echo teacher_Url(); ?>/studentmarks/student_position">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Position
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            
                <li class="<?php if (!empty($homework)) {
                    echo $homework;
                } ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Homework 
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if (!empty($homeworkadd)) {
                    echo $homeworkadd;
                } ?>">
                                <a href="<?php echo teacher_Url();?>/homework">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add Homework
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if (!empty($homeworklistdata)) {
                    echo $homeworklistdata;
                } ?>">
                                <a href="<?php echo teacher_Url();?>/homework/homeworklist">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    List Homework
                                </a>

                                <b class="arrow"></b>
                            </li>	
                        </ul>
                    </li>
                    
                    
                       <li class="<?php if (!empty($syllabus)) {
                    echo $syllabus;
                } ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                         Syllabus 
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                        <li class="<?php if( !empty($addsyllabus)){echo $addsyllabus;}?>">
                <a href="<?php echo teacher_Url();?>/syllabus/index">
                    
                    <span class="menu-text"> Add Syllabus </span>

                
                </a>

                <b class="arrow"></b>

               
            </li>

                            <li class="<?php if (!empty($syllabuslist)) {
                    echo $syllabuslist;
                } ?>">
                                <a href="<?php echo teacher_Url();?>/syllabus/syllabussearch">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    List Syllabus
                                </a>

                                <b class="arrow"></b>
                            </li>	
                        </ul>
                    </li>


                    <li class="<?php
                    if (!empty($timetable)) {
                        echo $timetable;
                    }
                    ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Time Table
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if (!empty($classroutine)) {
                        echo $classroutine;
                    } ?>">
                                <a href="<?php echo teacher_Url(); ?>/classroutine/viewclassroutine">

                                    <span class="menu-text"> Class Routine </span>


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
                    
                    <li class="<?php
                    if (!empty($attendance)) {
                        echo $attendance;
                    }
                    ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Attendance
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                              <li class="<?php if (!empty($stuattendance)) {
                    echo $stuattendance;
                } ?>">
                           <a href="<?php echo teacher_Url();?>/studentsattendance/studentattendancesearch">
                            <i class="menu-icon fa fa-caret-right"></i>
                          Student Attendance
                           
                        </a>

                        <b class="arrow"></b>

                    </li>

                            <li class="<?php
                            if (!empty($teacherattendance)) {
                                echo $teacherattendance;
                            }
                            ?>">
                                <a href="<?php echo teacher_Url();?>/employee/employeeattendancesearch">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Teacher Attendance
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>


                                        
                       <li class="<?php if (!empty($hr)) {
                    echo $hr;
                } ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                           HR/Payroll
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                        <li class="#">
                <a href="<?php echo teacher_Url();?>">
                    
                    <span class="menu-text"> Performance </span>

                
                </a>

                <b class="arrow"></b>

               
            </li>

                            <li class="">
                                <a href="<?php echo teacher_Url();?>#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Leave Application
                                </a>

                                <b class="arrow"></b>
                            </li>
                              <li class="">
                                <a href="<?php echo teacher_Url();?>#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Salary Statement
                                </a>

                                <b class="arrow"></b>
                            </li>
                              <li class="">
                                <a href="<?php echo teacher_Url();?>#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Training
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    
                       <li class="<?php  if (!empty($studentcmt)) {   echo $studentcmt; }?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Student Activities 
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if (!empty($addstudentcmt)) { echo $addstudentcmt;  } ?>">
                        <a href="<?php echo teacher_Url(); ?>/Studentcomment/index">

                            <span class="menu-text"> Add Student Comment </span>


                        </a>

                        <b class="arrow"></b>


                    </li>
                      <li class="<?php if (!empty($stucmtt)) { echo $stucmtt;  } ?>">
                        <a href="<?php echo teacher_Url(); ?>/Studentcomment/studentallComment">

                            <span class="menu-text">Approved Comment </span>

                        </a>
                        <b class="arrow"></b>
                    </li>              	                          
                </ul>
            </li>
            

         


        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>


    </div>