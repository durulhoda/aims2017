<div class="main-content">
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
                        <li class="hover<?php
                        if (!empty($dashboard)) {
                            echo $dashboard;
                        }
                        ?>">
                            <a href="<?php echo acc_Url(); ?>">
                                <i class="menu-icon fa fa-tachometer"></i>
                                <span class="menu-text"> Dashboard </span>
                            </a>

                            <b class="arrow"></b>
                        </li>

                
                        
                        
                        
                          <li class="<?php if(!empty($student)){ echo $student." open"; } ?> hover">
                            <a class="dropdown-toggle" href="#">
                               <i class="menu-icon fa fa-list-alt"></i>
                                <span class="menu-text">Student Information</span>

                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>

                            <ul class="submenu">
                                <li class="hover">
                                    <a href="<?php echo acc_Url()?>/student/">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                     Student List 
                                    </a>

                                    <b class="arrow"></b>
                                </li>
                           
                            </ul>
                        </li>
                        
                        
                         <li class="<?php if(!empty($stupayment)){ echo $stupayment." open"; } ?> hover">
                            <a class="dropdown-toggle" href="#">
                               <i class="menu-icon fa fa-dollar"></i>
                                <span class="menu-text">Student Payment</span>

                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>

                            <ul class="submenu">
                                <li class="hover">  <!-- call active class  -->
                                    <a href="<?php echo acc_Url(); ?>/Paymenthead">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Payment Head Setup
                                    </a>

                                    <b class="arrow"></b>
                                </li>
                                <li class="hover">
                                    <a href="<?php echo acc_Url(); ?>/feesadd">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Add Fees
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="<?php echo acc_Url(); ?>/paymentadd">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Add Payment
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="<?php echo acc_Url(); ?>/paymentadd/paymentlist">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Payment History
                                    </a>
                                    <b class="arrow"></b>
                                </li>
                                <li class="hover">
                                    <a href="<?php echo acc_Url(); ?>/payments">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Due History
                                    </a>
                                    <b class="arrow"></b>
                                </li>
                                <li class="hover">
                                    <a href="<?php echo acc_Url(); ?>/payments/studentdiscount">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Fees Discount
                                    </a>
                                    <b class="arrow"></b>
                                </li>
                                <li class="hover">
                                    <a href="<?php echo acc_Url(); ?>/payments/studentfine">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Student Fine
                                    </a>
                                    <b class="arrow"></b>
                                </li>

                            </ul>
                        </li>
                        
                        
                           <li class="<?php if(!empty($finanace)){ echo $finanace." open"; } ?> hover">
                            <a class="dropdown-toggle" href="#">
                             
                               <i class="menu-icon glyphicon glyphicon-book"></i>
                                <span class="menu-text">Finance Information</span>

                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>

                            <ul class="submenu">
                                    <li class="hover">
                                   <a href="<?php echo acc_Url(); ?>/financehead" >
                                        <i class="menu-icon fa fa-caret-right"></i>
                                       Add Payment Category
                                    </a>
                                    <b class="arrow"></b>
                                </li>
                                
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Transaction Record
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>

                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                            <a href="<?php echo acc_Url(); ?>/financehead/finance">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                              New Transaction
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                           <a href="<?php echo acc_Url(); ?>/financehead/financehistory">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Previous Transaction
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>
                                
                                    <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Account Summery
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>

                                    <b class="arrow"></b>

                                    <ul class="submenu">
                                        <li class="hover">
                                           <a href="<?php echo acc_Url(); ?>/financeReport/getFinancereport">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                            Transaction Report
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                           <a href="<?php echo acc_Url(); ?>/financeReport">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Journal Report
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                            <li class="hover">
                                           <a href="<?php echo acc_Url(); ?>/financeReport/financeStatement">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                Profit & Loss Report
                                            </a>

                                            <b class="arrow"></b>
                                        </li>
                                        
                                            <li class="hover">
                                           <a href="<?php echo acc_Url(); ?>/financeReport/financeSheet">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                 Balance Sheet
                                            </a>

                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li> 
                           

                             

                            </ul>
                        </li>

                    
             

                    </ul>
                    </li>
                    </ul><!-- /.nav-list -->
                </div><!-- .sidebar -->
            </div>

            <!--<div class="hidden-sm hidden-xs">
                    <button type="button" class="sidebar-collapse btn btn-white btn-primary" data-target="#sidebar2">
                            <i class="ace-icon fa fa-angle-double-up" data-icon1="ace-icon fa fa-angle-double-up" data-icon2="ace-icon fa fa-angle-double-down"></i>
                            Collapse/Expand Menu
                    </button>
</div>-->

        </div></div>