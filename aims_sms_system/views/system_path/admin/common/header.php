
    <div id="navbar" class="navbar navbar-default navbar-fixed-top">

        <div class="navbar-container" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="<?php echo admin_Url(); ?>" class="navbar-brand">
                    <small>
                        
                       <?php
                            $ins_name=  getInstituteName();
                        ?>
                        <?php
                            
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

                    <li class="purple">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                            Notifications <span class="badge badge-important">0</span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-exclamation-triangle"></i>
                                8 Notifications
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-pink fa fa-user"></i>
                                                    Student Photo Request
                                                </span>
                                                <span class="pull-right badge badge-info">+12</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                    New Orders
                                                </span>
                                                <span class="pull-right badge badge-success">+8</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                                    Followers
                                                </span>
                                                <span class="pull-right badge badge-info">+11</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown-footer">
                                <a href="#">
                                    See all notifications
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="light-green">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                       <?php
                    $ins_info = getInstituteInfo();
                    ?>
              
                            
                            <img class="nav-user-photo" src="<?php echo base_Url() . $ins_info['logo'] ?> " alt="AIMS" />
                               
                            
                         
                            <span class="user-info">
                                <small>Welcome,</small>
                                AIMS Admin
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="#">
                                    <i class="ace-icon fa fa-cog"></i>
                                    Settings
                                </a>
                            </li>

                            <li>
                                <a href="profile.html">
                                    <i class="ace-icon fa fa-user"></i>
                                    Profile
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="<?php echo admin_Url(); ?>/logout">
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