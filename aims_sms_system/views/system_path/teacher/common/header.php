
    <div id="navbar" class="navbar navbar-default navbar-fixed-top">

        <div class="navbar-container" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="<?php echo teacher_Url(); ?>" class="navbar-brand">
                    <small>
                        
                       <?php
                            $ins_name=  getInstituteName();
                       
                            if(!empty($ins_name))
                            {
                                echo $ins_name;
                            }
                       ?>
                    </small>
                </a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">

                    <li class="light-green">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                           <?php
                                 $emp_id=$this->session->userdata('emp_userName');  
                                 $emp_img=getEmployeeName_Image($emp_id);
                            ?>
                            <img class="nav-user-photo" src="<?php echo base_url()."uploads/Employee/".$emp_img['photo'] ?>" alt="Photo" />
                            <span class="user-info">
                                <small>Welcome,</small>
                                <?php echo "<b>".$emp_id."</b>";  ?>
                                
                            </span>


                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            
                            <li>
                                <a href="<?php echo teacher_Url(); ?>/teacher/profile">
                                    <i class="ace-icon fa fa-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo teacher_Url(); ?>/teacher/changepassword">
                                    <i class="ace-icon fa fa-cog"></i>
                                    Change Password
                                </a>
                            </li>


                            <li class="divider"></li>

                            <li>
                                <a href="<?php echo teacher_Url(); ?>/logout">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>