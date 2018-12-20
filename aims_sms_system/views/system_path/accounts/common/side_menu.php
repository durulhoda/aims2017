
<div class="main-container main-container-fixed" id="main-container">


    <div id="sidebar" class="sidebar responsive sidebar-fixed">

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <a href="#" target="_blank" class="btn btn-danger btn-block">Accounts System</a>

        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="<?php if(!empty($dashboard)){ echo $dashboard; } ?>">  <!-- call active class  -->
                <a href="<?php echo acc_Url(); ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>
                     
            <li class="<?php if(!empty($librarayinfo)){ echo $librarayinfo; } ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon glyphicon glyphicon-book"></i>
                    <span class="menu-text"> Library </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($bookself)){ echo $bookself; } ?>">
                        <a href="<?php echo acc_Url();?>/libraryinfo/bookselfinfo">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Book Self Info
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($bookcat)){ echo $bookcat; } ?>">
                        <a href="<?php echo acc_Url();?>/bookcategory">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Book Category Info
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($bookrecord)){ echo $bookrecord; } ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Books Record
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if(!empty($bookrecinfo)){ echo $bookrecinfo; } ?>">
                                <a href="<?php echo acc_Url()?>/book">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Insert Books Info
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($allbookrecinfo)){ echo $allbookrecinfo; } ?>">
                                <a href="<?php echo acc_Url();?>/book/booklist">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    All Books Info
                                </a>

                                <b class="arrow"></b>
                            </li>	

                        </ul>
                    </li>

                    <li class="<?php if(!empty($borrowbook)) {echo $borrowbook;}?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Borrow Books
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if(!empty($borrowbookrec)){echo $borrowbookrec;}?>">
                                <a href="<?php echo acc_Url();?>/bookborrow">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Record Borrowed Books
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($borrowedbook)){echo $borrowedbook;}?>">
                                <a href="<?php echo acc_Url();?>/bookborrow/bookborrowlist">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    All Borrowed Books
                                </a>

                                <b class="arrow"></b>
                            </li>	

                        </ul>
                    </li>

                    <li class="<?php if(!empty($bookrequirement)) {echo $bookrequirement;}?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Books Requirement
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if(!empty($bookrequirementinfo)) {echo $bookrequirementinfo;}?>">
                                <a href="<?php echo acc_Url();?>/bookrequirement">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Required Books Info
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($allbookrequirement)) {echo $allbookrequirement;}?>">
                                <a href="<?php echo acc_Url();?>/bookrequirement/bookrequirementlist">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    All Required Books
                                </a>

                                <b class="arrow"></b>
                            </li>	

                        </ul>
                    </li>
                    <li class="<?php if(!empty($booklost)) {echo $booklost;}?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Books Lost
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if(!empty($booklostinfo)) {echo $booklostinfo;}?>">
                                <a href="<?php echo acc_Url();?>/booklost">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Lost Books Info
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($allbooklost)) {echo $allbooklost;}?>">
                                <a href="<?php echo acc_Url();?>/booklost/booklostlist">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    All Lost Books
                                </a>

                                <b class="arrow"></b>
                            </li>	

                        </ul>
                    </li>
                </ul>
            </li>

            <li class="<?php if(!empty($inventory)){echo $inventory;} ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-info-circle"></i>
                    <span class="menu-text"> Inventory </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($invencat)){echo $invencat;} ?>">
                        <a href="<?php echo acc_Url();?>/inventory">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Inventory Category
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if(!empty($inventadd)){echo $inventadd;} ?>">
                        <a href="<?php echo acc_Url();?>/inventory/addinventdata">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Setup Inventory
                        </a>

                        <b class="arrow"></b>
                    </li>

             

                    <li class="<?php if (!empty($requireinvent)) { echo $requireinvent;} ?>">
                        <a href="<?php echo acc_Url(); ?>/inventory/requirement">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Require Inventory 
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                     <li class="<?php if (!empty($itemstock)) { echo $itemstock;} ?>">
                        <a href="<?php echo acc_Url(); ?>/inventorystock/inventorystocklist">
                            <i class="menu-icon fa fa-caret-right"></i>
                           Item Stock 
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                     <li class="<?php if (!empty($itemloss)) { echo $itemloss;} ?>">
                        <a href="<?php echo acc_Url(); ?>/inventoryloss/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Item Loss
                        </a>

                        <b class="arrow"></b>
                    </li>
               

                </ul>
            </li>
            <li class="<?php if(!empty($transport)){echo $transport;}?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-bus"></i>
                    <span class="menu-text"> Transport </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($transportcat)){echo $transportcat;}?>">
                        <a href="<?php echo acc_Url();?>/transport/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Category
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($transportname)){echo $transportname;}?>">
                        <a href="<?php echo acc_Url();?>/transport/transportNamelist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Name
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($transportroot)){echo $transportroot;}?>">
                        <a href="<?php echo acc_Url();?>/transportroot/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Root
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if (!empty($transportfees)) {
                            echo $transportfees;
                        } ?>">
                        <a href="<?php echo acc_Url(); ?>/transportfees/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Fees
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                      <li class="<?php if (!empty($transportfuel)) {
                            echo $transportfuel;
                        } ?>">
                        <a href="<?php echo acc_Url(); ?>/transportfuel/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Fuel
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                      <li class="<?php if (!empty($transportrepair)) {
                            echo $transportrepair;
                        } ?>">
                        <a href="<?php echo acc_Url(); ?>/transportrepair/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Repair
                        </a>

                        <b class="arrow"></b>
                    </li>

                

                </ul>
            </li>
            <li class="<?php if(!empty($hostel)){ echo $hostel;} ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon glyphicon glyphicon-home"></i>
                    <span class="menu-text"> Hostel </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($hostelcategory)){ echo $hostelcategory; }?>">
                        <a href="<?php echo acc_Url();?>/hostel/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Category
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hsotelname)){echo $hostelname;}?>">
                        <a href="<?php echo acc_Url();?>/hostel/hostelNamelist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Name
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hostelroom)){ echo $hostelroom;}?>">
                        <a href="<?php echo acc_Url();?>/hostelroom/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Room
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hostelbed)) { echo $hostelbed;}?>">
                        <a href="<?php echo acc_Url();?>/hostelbed/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Bed
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hostelrent)){echo $hostelrent;}?>">
                        <a href="<?php echo acc_Url();?>/hostelrent/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Bed Rent
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                       <li class="<?php if(!empty($hostelbedassign)){echo $hostelbedassign;}?>">
                        <a href="<?php echo acc_Url();?>/hostelbedassign/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Assign Bed
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