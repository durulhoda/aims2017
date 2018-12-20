<!-- /Content Section  -->
<div class="page-header">
    <h1>
        AIMS Admin Panel
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Overview
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="alert alert-block alert-success">

            <i class="ace-icon fa fa-check green"></i>

            Hello
            <strong class="red">
                Admin
            </strong>, Welcome to
            <strong class="green">
                AIMS
                <small>(v1.3.4)</small>
            </strong>
            Admin Panel
        </div>

        <div class="row">
            <div class="space-6"></div>

            <div class="col-md-offset-2 col-sm-7 infobox-container">
                <div class="infobox infobox-green">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-users"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            $total_students=countTotalStudents();
                            if(!empty($total_students))
                            {
                                echo $total_students;
                            }
                            ?>
                        </span>
                        <div class="infobox-content">Total Students</div>
                    </div>


                </div>

                <div class="infobox infobox-blue">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-user"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            $total_students=countBoysStudents();
                            if(!empty($total_students))
                            {
                                echo $total_students;
                            }
                            ?>
                        </span>
                        <div class="infobox-content">Boys Student</div>
                    </div>
                </div>

                <div class="infobox infobox-pink">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-user"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            $total_students=countGirlsStudents();
                            if(!empty($total_students))
                            {
                                echo $total_students;
                            }
                            ?>
                        </span>
                        <div class="infobox-content">Girls Students</div>
                    </div>
                    kkk

                </div>

                <div class="infobox infobox-green">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-user"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            $total_employee=countTotalEmployee_BYType(1);
                            if(!empty($total_employee))
                            {
                                echo $total_employee;
                            }
                            ?>
                        </span>
                        <div class="infobox-content">Total Teacher</div>
                    </div>
                </div>

                <div class="infobox infobox-blue">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-user"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            $total_stuf=countMaleEmployee_BYType(1);
                            if(!empty($total_stuf))
                            {
                                echo $total_stuf;
                            }
                            ?>
                        </span>
                        <div class="infobox-content">Male Teacher</div>
                    </div>
                </div>


                <div class="infobox infobox-pink">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-user"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            $total_stuf=countTFemaleEmployee_BYType(1);
                            if(!empty($total_stuf))
                            {
                                echo $total_stuf;
                            }
                            ?>
                        </span>
                        <div class="infobox-content">Female Teacher</div>
                    </div>
                    kkk

                </div>

                <div class="space-6"></div>

                <div class="infobox infobox-large infobox-dark">

                    <!-- <a href="<?php //echo admin_Url(); ?>/applicant/RegistrationForm" class="btn btn-danger btn-block">Registration Form</a> -->
                </div>


            </div>
        </div> <!-- /.row -->

    </div><!-- /.col-x12 -->
</div> 