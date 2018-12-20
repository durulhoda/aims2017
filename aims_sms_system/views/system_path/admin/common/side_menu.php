<div class="main-container main-container-fixed" id="main-container">


    <div id="sidebar" class="sidebar responsive sidebar-fixed">

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-danger btn-block">Visit Homepage</a>

        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="<?php if(!empty($dashboard)){ echo $dashboard; } ?>">  <!-- call active class  -->
                <a href="<?php echo admin_Url(); ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="<?php if(!empty($setting)){ echo $setting." open"; } ?>">  <!-- call active class  -->
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-dribbble"></i>
                    <span class="menu-text">
                        Settings
                    </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($institute)){ echo $institute; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/institute">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Institute Info
                        </a>

                        <b class="arrow"></b>
                    </li>
       
                      <li class="<?php if(!empty($subsetting)){ echo $subsetting." open"; } ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>

									Subject Info
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
                                                                    <li class="<?php if (!empty($subject)) {
                                                                                                    echo $subject;
                                                                                                } ?>">  <!-- call active class  -->
                                                                        <a href="<?php echo admin_Url(); ?>/course">
                                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                                            Add Subject
                                                                        </a>

                                                                        <b class="arrow"></b>
                                                                    </li>

                                                                    <li class="<?php if (!empty($subjectlist)) {
                                                                                        echo $subjectlist;
                                                                                    } ?>">  <!-- call active class  -->
                                                                        <a href="<?php echo admin_Url(); ?>/course/searchSubjectByLv">
                                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                                            Subject List
                                                                        </a>

                                                                        <b class="arrow"></b>
                                                                    </li>
                                             
								</ul>
							</li>
                    
                    
                    
                    <li class="<?php if(!empty($class)){ echo $class; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/program">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Class List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($medium)){ echo $medium; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/medium">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Medium List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($group)){ echo $group; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/group">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Group List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($section)){ echo $section; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/section">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Section List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($sessionname)){ echo $sessionname; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/sessionsetup">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Session List
                        </a>

                        <b class="arrow"></b>
                    </li>                    
                    <li class="<?php if(!empty($shift)){ echo $shift; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/shift">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Shift List
                        </a>

                        <b class="arrow"></b>
                    </li>                    
<!--                <li class="<?php if(!empty($programlevel)){ echo $programlevel; } ?>">   call active class  
                        <a href="<?php echo admin_Url(); ?>/programlevel">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Class Level List
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Curriculum Setting
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="top-menu.html">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add New Curriculum
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="two-menu-1.html">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    View Curriculum List
                                </a>

                                <b class="arrow"></b>
                            </li>	
                        </ul>
                    </li> -->
                    <li class="<?php if(!empty($examterm)){ echo $examterm; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/semester">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Exam List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <!--<li class="<?php //if(!empty($examtype)){ echo $examtype; } ?>">-->  <!-- call active class  -->
                        <!--<a href="<?php //echo admin_Url(); ?>/examtype">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Exam Type List
                        </a>

                        <b class="arrow"></b>
                    </li>-->
                    
                    <li class="<?php if(!empty($period)){ echo $period; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/period">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Time Period List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($emp_dprt)){ echo $emp_dprt; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/department">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Employee Department
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if(!empty($emp_dsg)){ echo $emp_dsg; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/designation">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Employee Position
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($quata)){ echo $quata; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/quata">
                            <i class="menu-icon fa fa-caret-right"></i>
                            New Quata
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                      <li class="<?php if(!empty($admid)){ echo $admid; } ?>">  <!-- call active class  -->
                        <a href="<?php echo admin_Url(); ?>/admidcontroller">
                            <i class="menu-icon fa fa-caret-right"></i>
                          Admission Test Info
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                </ul>
            </li>

            <li class="<?php if(!empty($cloffer)){ echo $cloffer." open"; } ?>">  <!-- call active class  -->
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-share-alt"></i>
                    <span class="menu-text"> Class Offer </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($classoffer)){ echo $classoffer; } ?>">
                        <a href="<?php echo admin_Url(); ?>/program/programoffer">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Offer New Class
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($classofferlist)){ echo $classofferlist; } ?>">
                        <a href="<?php echo admin_Url(); ?>/program/SearchProgramOffer">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Offered Class List
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="<?php if(!empty($subffer)){ echo $subffer." open"; } ?>">  <!-- call active class  -->
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-share-alt"></i>
                    <span class="menu-text"> Subject Offer </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    
                             <li class="<?php if(!empty($markcatagory)){ echo $markcatagory; } ?>">
                        <a href="<?php echo admin_Url(); ?>/courseoffer/markcatagory">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Mark Category
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if(!empty($subjectoffer)){ echo $subjectoffer; } ?>">
                        <a href="<?php echo admin_Url(); ?>/courseoffer">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Offer New Subject
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($subjectofferlist)){ echo $subjectofferlist; } ?>">
                        <a href="<?php echo admin_Url(); ?>/courseoffer/courseOfferlist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Offered Subject List
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                   
                    <li class="<?php if(!empty($subjectofferlist)){ echo $subjectofferlist; } ?>">
                        <a href="<?php echo admin_Url(); ?>/courseoffer/merge_subjects">
                            <i class="menu-icon fa fa-caret-right"></i>
                           Merging Subjects
                        </a>

                        <b class="arrow"></b>
                    </li>
               
                    
                </ul>
            </li>

            <li class="<?php if(!empty($result_home)){ echo $result_home." open"; } ?>">  <!-- call active class  -->
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-share-alt"></i>
                    <span class="menu-text"> Summary Result </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">

                    <li class="<?php if(!empty($add_per)){ echo $add_per; } ?>">
                        <a href="<?php echo admin_Url();?>/setsummarypercentage">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Set Percentage
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($result)){ echo $result; } ?>">
                        <a href="<?php echo admin_Url();?>/setsummarypercentage/percentagelist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Percentage List
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($generate)){ echo $generate; } ?>">
                        <a href="<?php echo admin_Url();?>/generatesummaryresult">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Generate Summary Result
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($generate)){ echo $generate; } ?>">
                        <a href="<?php echo admin_Url();?>/generatesummaryresult/result_view">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Result
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="<?php if( !empty($syllabus)){echo $syllabus;}?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-folder-open"></i>
                    <span class="menu-text"> Subject Syllabus </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if( !empty($addsyllabus)){ echo $addsyllabus; }?>">
                        <a href="<?php echo admin_Url();?>/syllabus">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Syllabus
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($syllabuslist)) {echo $syllabuslist;}?>">
                        <a href="<?php echo admin_Url();?>/syllabus/syllabussearch">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Syllabus List
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="<?php if (!empty($homeworklistdata)){echo $homeworklistdata;}?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-text"> Homework </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($addhomework)){ echo $addhomework; } ?>">
                        <a href="<?php echo admin_Url();?>/homework">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Homework
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($homework)){ echo $homework; } ?>">
                        <a href="<?php echo admin_Url();?>/homework/homeworklist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Homework List
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="<?php if(!empty($finanace)){ echo $finanace; } ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-dollar"></i>
                    <span class="menu-text"> Finance </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo admin_Url(); ?>/financehead" >
                            <i class="menu-icon fa fa-caret-right"></i>
                             Add Payment Category
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>                        
                    </li>
                    
                    <li class="<?php if(!empty($add_transaction)){ echo $add_transaction; } ?>">
                        <a href="" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transaction Record
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?php echo admin_Url(); ?>/financehead/finance">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    New Transaction
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="<?php echo admin_Url(); ?>/financehead/financehistory">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Previous Transaction
                                </a>

                                <b class="arrow"></b>
                            </li>	
                        </ul>
                    </li>
                    <li class="<?php if(!empty($finance_summery)){ echo $finance_summery; } ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Account Summery
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if(!empty($fin_report)){ echo $fin_report; } ?>">
                                <a href="<?php echo admin_Url(); ?>/financeReport/getFinancereport">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Transaction Report
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="<?php if(!empty($journal)){ echo $journal; } ?>">
                                <a href="<?php echo admin_Url(); ?>/financeReport">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Journal Report
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty ($profitloss)){ echo $profitloss; }?>">
                                <a href="<?php echo admin_Url(); ?>/financeReport/financeStatement">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Profit & Loss Report
                                </a>

                                <b class="arrow"></b>
                            </li>	
                            <li class="<?php if(!empty ($balancesheet)) { echo $balancesheet; }?>">
                                <a href="<?php echo admin_Url(); ?>/financeReport/financeSheet">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Balance Sheet
                                </a>

                                <b class="arrow"></b>
                            </li>	
                        </ul>
                    </li>

                </ul>
            </li>					

            <li class="<?php if(!empty($librarayinfo)){ echo $librarayinfo; } ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon glyphicon glyphicon-book"></i>
                    <span class="menu-text">Library </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($bookself)){ echo $bookself; } ?>">
                        <a href="<?php echo admin_Url();?>/libraryinfo/bookselfinfo">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Book Self Info
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if(!empty($bookcat)){ echo $bookcat; } ?>">
                        <a href="<?php echo admin_Url();?>/bookcategory">
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
                                <a href="<?php echo admin_Url()?>/book">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Insert Books Info
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($allbookrecinfo)){ echo $allbookrecinfo; } ?>">
                                <a href="<?php echo admin_Url();?>/book/booklist">
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
                                <a href="<?php echo admin_Url();?>/bookborrow">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Record Borrowed Books
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($borrowedbook)){echo $borrowedbook;}?>">
                                <a href="<?php echo admin_Url();?>/bookborrow/bookborrowlist">
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
                                <a href="<?php echo admin_Url();?>/bookrequirement">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Required Books Info
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($allbookrequirement)) {echo $allbookrequirement;}?>">
                                <a href="<?php echo admin_Url();?>/bookrequirement/bookrequirementlist">
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
                                <a href="<?php echo admin_Url();?>/booklost">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Lost Books Info
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if(!empty($allbooklost)) {echo $allbooklost;}?>">
                                <a href="<?php echo admin_Url();?>/booklost/booklostlist">
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
                        <a href="<?php echo admin_Url();?>/inventory">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Inventory Category
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if(!empty($inventadd)){echo $inventadd;} ?>">
                        <a href="<?php echo admin_Url();?>/inventory/addinventdata">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Setup Inventory
                        </a>

                        <b class="arrow"></b>
                    </li>

             

                    <li class="<?php if (!empty($requireinvent)) { echo $requireinvent;} ?>">
                        <a href="<?php echo admin_Url(); ?>/inventory/requirement">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Require Inventory 
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                     <li class="<?php if (!empty($itemstock)) { echo $itemstock;} ?>">
                        <a href="<?php echo admin_Url(); ?>/inventorystock/inventorystocklist">
                            <i class="menu-icon fa fa-caret-right"></i>
                           Item Stock 
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                     <li class="<?php if (!empty($itemloss)) { echo $itemloss;} ?>">
                        <a href="<?php echo admin_Url(); ?>/inventoryloss/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Item Loss
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if (!empty($inventoryreport)) {
                             echo $inventoryreport;
                         } ?>">
                        <a href="" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Inventoy Report
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php if (!empty($inventoryreqreport)) {
                             echo $inventoryreqreport;
                         } ?>">
                                <a href="<?php echo admin_Url(); ?>/inventory/requirementreport">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                   Required Report
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php if (!empty($inventorystockreport)) {
                             echo $inventorystockreport;
                         } ?>">
                                <a href="<?php echo admin_Url(); ?>/inventory/stockreport">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Stock Report
                                </a>

                                <b class="arrow"></b>
                            </li>
                            
                               <li class="<?php if (!empty($inventorylossreport)) {
                             echo $inventorylossreport;
                         } ?>">
                                <a href="<?php echo admin_Url(); ?>/inventory/lossreport">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                     Loss Report
                                </a>

                                <b class="arrow"></b>
                            </li>
                            
                        </ul>
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
                        <a href="<?php echo admin_Url();?>/transport/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Category
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($transportname)){echo $transportname;}?>">
                        <a href="<?php echo admin_Url();?>/transport/transportNamelist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Name
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($transportroot)){echo $transportroot;}?>">
                        <a href="<?php echo admin_Url();?>/transportroot/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Root
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if (!empty($transportfees)) {
                            echo $transportfees;
                        } ?>">
                        <a href="<?php echo admin_Url(); ?>/transportfees/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Fees
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                      <li class="<?php if (!empty($transportfuel)) {
                            echo $transportfuel;
                        } ?>">
                        <a href="<?php echo admin_Url(); ?>/transportfuel/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transport Fuel
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                      <li class="<?php if (!empty($transportrepair)) {
                            echo $transportrepair;
                        } ?>">
                        <a href="<?php echo admin_Url(); ?>/transportrepair/index">
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
                        <a href="<?php echo admin_Url();?>/hostel/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Category
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hsotelname)){echo $hostelname;}?>">
                        <a href="<?php echo admin_Url();?>/hostel/hostelNamelist">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Name
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hostelroom)){ echo $hostelroom;}?>">
                        <a href="<?php echo admin_Url();?>/hostelroom/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Room
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hostelbed)) { echo $hostelbed;}?>">
                        <a href="<?php echo admin_Url();?>/hostelbed/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Bed
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php if(!empty($hostelrent)){echo $hostelrent;}?>">
                        <a href="<?php echo admin_Url();?>/hostelrent/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel Bed Rent
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                       <li class="<?php if(!empty($hostelbedassign)){echo $hostelbedassign;}?>">
                        <a href="<?php echo admin_Url();?>/hostelbedassign/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Assign Bed
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
               
                </ul>
            </li>
            <li class="<?php if(!empty($governing)){ echo $governing;} ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-gears"></i>
                    <span class="menu-text"> Others </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if(!empty($home)){echo $home;}?>">
                        <a href="<?php echo admin_Url()?>/GoverningBody/index">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Governing Body 
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                           <li class="<?php if(!empty($homee)){echo $homee;}?>">
                        <a href="<?php echo admin_Url()?>/GoverningBody/governsearch">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Search Governing Info 
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                    <li class="<?php if(!empty($cmtstu)){echo $cmtstu;}?>">
                        <a href="<?php echo admin_Url()?>/student/viewcomment">
                            <i class="menu-icon fa fa-caret-right"></i>
                             Comments Of Students
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Co-Curriculum Activities
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