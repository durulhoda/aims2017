<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">	
            <div class="row">
                <div class="col-xs-12">

                    <!-- PAGE CONTENT BEGINS -->
                    <div class="hidden">
                        <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                            <span class="sr-only">Toggle sidebar</span>

                            <i class="ace-icon fa fa-dashboard white bigger-125"></i>
                        </button>

                        <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
                            <ul class="nav nav-list">
                                <li class="<?php if(!empty($registration)){ echo $registration; } ?> hover">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Applicant Registration </span>
                                    </a>
                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/applicant/RegistrationForm">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Apply For Registration
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/applicant/searchapplicant">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Applicant List
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>

                                <li class="<?php if(!empty($student)){ echo $student; } ?> hover">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Student Information </span>
                                    </a>
                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/student">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Student List
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="#">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Assign Subject
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/student/getstudentidcard">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Student ID Card
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/promotestudent">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Student Re-Registration
                                            </a>

                                            <b class="arrow"></b>
                                        </li>



                                    </ul>
                                </li>
                                <li class="<?php if(!empty($employee)){ echo $employee." open"; } ?> hover">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Employee Information </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/employee">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Employee Registration
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/employee/searchemployee">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Employee List
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="#">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Employee Performance
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="#">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Update Employee Status
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                         <li class="hover">
                                             <a href="<?php echo admin_Url();?>/employee/getemployeeid">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                 Employee ID Card
                                            </a>

                                            <b class="arrow"></b>
                                        </li>



                                    </ul>
                                </li>

                                <li class="<?php if (!empty($classroutine)) {
                                        echo $classroutine . " open";
                                    } ?> hover">

                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Routine Table </span>
                                    </a>
                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/classroutine">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Generate Class Routine
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/classroutine/viewclassroutine">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                View Class Routine 
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="#">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Generate Exam Routine
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="#">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                View Exam Routine 
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/classroutine/acad_calender">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Create Academic Calender
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="#">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Academic Event Schedule
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                    </ul>

                                </li>

                                <li class="<?php if(!empty($Attendance)){ echo $Attendance." open"; } ?> hover">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Attendance </span>
                                    </a>
                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/studentsattendance">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Insert Student Attendance
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/studentsattendance/studentattendancesearch">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Student Attendance List
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/employee/searchAllemployee">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Add Employee Attendance
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/employee/employeeattendancesearch">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Employee Attendance List
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>

                                <li class="<?php if(!empty($result)){ echo $result." open"; } ?> hover">
                                    <a class="dropdown-toggle" href="">
                                        <span class="menu-text"> Student Result </span>
                                    </a>
                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/studentmarks">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Insert Marks
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/studentmarks/markslist">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Marks List
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                     <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/studentmarks/Classposition">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                View Student Position
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url(); ?>/publishresult">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Published Result
                                            </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/result_view">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Generate Tabulation Sheet
                                            </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="#">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Generate Certificate
                                            </a>
                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>

                                <li class="<?php if(!empty($stupayment)){ echo $stupayment." open"; } ?> hover">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Student Payment </span>
                                    </a>
                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        
                                         <li class="hover">
                                            <a href="<?php echo admin_Url();?>/feesadd">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Add Fees
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/paymentadd">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Add Payment
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/paymentadd/paymentlist">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Payment History
                                            </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/payments">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Due History
                                            </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/payments/studentdiscount">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Fees Discount
                                            </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a href="<?php echo admin_Url();?>/payments/studentfine">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Student Fine
                                            </a>
                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>
                                <li class="<?php if(!empty($sendsms)){ echo $sendsms." open"; } ?> hover">
                                    <a class="alert alert-block alert-danger" href="<?php echo admin_Url();?>/sendsms">
                                        <span class="menu-text purple"><b> Send SMS </b></span>
                                    </a>																						
                                </li>
                            </ul><!-- /.nav-list -->
                        </div><!-- .sidebar -->
                    </div>			

                </div><!-- /.col -->

            </div>