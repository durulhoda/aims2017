<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width" initial-scale="1.0" />
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
        <title>
            <?php
            $ins_info = getInstituteInfo();
            if (!empty($ins_info)) {
                echo $ins_info['instituteName'];
            }
            ?>

        </title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>demo_1/img/aims.png" type="image/x-icon"/>
        <script type="text/javascript" src="demo_1/js/jssor.slider.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>demo_1/css/components.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>demo_1/css/responsee.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>demo_1/css/media.css">
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url(); ?>demo_1/css/slider.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>demo_1/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>demo_1/owl-carousel/owl.theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>demo_1/css/prettyPhoto.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>demo_1/css/font-awesome.min.css">

        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/jsDatePick.jquery.min.1.3.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>demo_1/css/jsDatePick_ltr.min.css" />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/jquery-ui.min.js"></script>    
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/modernizr.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/responsee.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/date-time.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/jquery.meanmenu.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/js/jquery.prettyPhoto.js"></script>
        <!--[if lt IE 9]>
                <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
          <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <script type="text/javascript">
            window.onload = function () {
                new JsDatePick({
                    useMode: 2,
                    target: "inputField",
                    dateFormat: "%d-%m-%Y"
                });
                new JsDatePick({
                    useMode: 2,
                    target: "inputField_to",
                    dateFormat: "%d-%m-%Y"
                });
            };
        </script>  
    </head>
    <body class="size-1140">
        <!-- HEADER -->

        <header>
            <div class="line">
                <div class="boxtopheader">
                    <div class="line">
                        <div class="s-12 l-6">
                            &nbsp;&nbsp; <span style="font-size: 13px;">
                                <script language = "JavaScript">
                                    var now = new Date();
                                    var dayNames = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                                    var monNames = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                    document.write("Today's- " + dayNames[now.getDay()] + " " + monNames[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear());
                                </script>
                            </span>
                        </div>
                        <div class="s-12 l-6">
                            <!-- <span style="margin-left: 80%; padding: 2px; border-radius: 3px;">
                                <a class="more dlink" target="_blank" href="<?php echo base_url(); ?>systemaccess">
                                    <font color="green">&nbsp;System Login&nbsp;</font>
                                    
                              
                                </a>-->
                            <div id="flip">&nbsp;System Login&nbsp;</div>


                            </span>

  <!--   <a href=""> <span class="right"><img src="<?php echo base_url(); ?>demo_1/img/arrow_right.png" width="94px;"></span></a>
                            --> </div>

                        <div class="s-12 l-12">

                            <div id="panel" class="panf">

                                <div class="s-12 l-12">

                                    <div class="s-12 l-4">

                                        <div style="width: 57%; margin-left: auto; margin-right: auto;">
                                            <a target="_blank" href="<?php echo base_url(); ?>systemaccess"><img src="<?php echo base_url(); ?>demo_1/img/aims.png"></a>  

                                            <p class="fl_left" style="padding-left:60px; color: red;">
                                                Powered by:&nbsp;
                                                <a href="http://adventure-soft.com/">
                                                    <img src="<?php echo base_url(); ?>demo_1/img/finallogo.jpg">
                                                </a>
                                            </p>

                                        </div>

                                    </div>


                                    <div class="s-12 l-4">
                                        <div style="float: left; width: 75%;">

                                            <form method="post" action="<?php echo base_url(); ?>e_teacher/login">
                                                <fieldset>
                                                    <legend>Teachers Login Form</legend>
                                                    <table class="ltable">
                                                        <tr class="ltr">
                                                            <td class="ltr">Username:</td>
                                                            <td class="ltr"> <input width="20%" id="teacherid" class="validate[required]" type="text" name="username">
                                                            </td>
                                                        </tr>

                                                        <tr class="ltr">
                                                            <td class="ltr">
                                                                Password:</td>
                                                            <td class="ltr"> <input id="password" class="validate[required]" type="password" name="password">
                                                            </td>
                                                        </tr>

                                                        <td class="prf">
                                                            <input id="Teacherlogin" type="submit" value="Login" name="Teacherlogin">
                                                        </td>
                                                        </tr>
                                                    </table>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="s-12 l-4">

                                        <!--Teachers Panel-->
                                        <div style="float: left; width: 75%;"><div class="topbox">

                                                <form method="post" action="<?php echo base_url(); ?>e_student/login">
                                                    <fieldset>
                                                        <legend>Student Login Form</legend>
                                                        <table class="ltable">
                                                            <tr class="ltr">
                                                                <td class="ltr">
                                                                    Username:</td>
                                                                <td class="ltr"> <input id="studentid" class="validate[required]" type="text" name="username">
                                                                </td>
                                                            </tr>
                                                            <tr class="ltr">
                                                                <td class="ltr">  Password:</td>
                                                                <td class="ltr"> <input id="password" class="validate[required]" type="password" name="password">
                                                                </td>
                                                            </tr>
                                                            <td class="prf">
                                                                <input id="studentlogin" type="submit" value="Login" name="studentlogin">
                                                            </td>
                                                            </tr>
                                                        </table>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="float: left; padding: 3px; background: #eee;">
                                        <a target="_blank" href="<?php echo base_url();?>accounts_admin">Account Login</a>
                                    </div>
                                </div>
                                <div id="flip1" ><p class="clpnael">&nbsp;Close Panel&nbsp;</p></div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="boxheader">
                    <?php
                    $ins_info = getInstituteInfo();
                    ?>
                    <div class="s-6 l-1 logo">

                        <a href="<?php echo base_url(); ?>home"> <img class="httitle" SRC="<?php echo base_Url() . $ins_info['logo'] ?> " width="89px;;"/>  </a>
                    </div>

                    <div class="aside-nav bannerName">
                        <h2>   &nbsp; <?php
                            if (!empty($ins_info)) {
                                echo $ins_info['instituteName'];
                            }
                            ?>
                        </h2>
                        &nbsp; &nbsp &nbsp;
                        <span style="color: rgb(125, 35, 24); font-size: 20px; font-weight: 600; text-shadow: 1px 1px #fff;">  <?php echo $ins_info['town'] . ", "?> <?php echo $ins_info['city']."," ?>
                            <?php
                            if (!empty($ins_info['district'])) {
                                foreach (getDistrictName() as $key => $value) {
                                    if ($key == $ins_info['district']) {
                                        echo $value;
                                    }
                                }
                            }
                            ?> </span>
                        
                        <!--<p class="admission" style="box-shadow: red;">
                            <a href="<?php// echo base_url(); ?>home/OnlineAdmission"> <img src="<?php// echo base_url(); ?>demo_1/img/admission.jpg"></a>
                        </p>-->
                        <p class="admission" style="width: 165px;text-align: right;">
                            <a href="<?php echo base_url(); ?>home/OnlineAdmission"><strong style="color: red; background-color: black;">&nbsp;&nbsp;Online Admission&nbsp;&nbsp;</strong></a>
                        </p>
                        <p class="admission" style="width: 117px;text-align: right;">
                            <a href="<?php echo base_url(); ?>home/result_view"><strong style="color: red; background-color: black;">&nbsp;&nbsp;View Result&nbsp;&nbsp;</strong></a>
                        </p>
                    </div>



                </div>

            </div>
            <!-- TOP NAV -->  
            <div class="line">
                <nav ><!-- class="margin-bottom" -->
                    <p class="nav-text">Menu</p>
                    <div class="top-nav s-12 l-12">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>home/index">Home</a></li>
                            <li>
                                <a>About</a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/OurMission">Mission Statement</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/BoardMember">Board of Management</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/FacultyMember">Faculty Member</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/ThirdgradeStaff">3rd Grade Staff</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/FourthgradeStaff">4th Grade Staff</a></li>


                                </ul>
                            </li>
                            <li>
                                <a>Academics</a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/searchclassroutine">Class Routine</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/searchexamroutine">Exam Routine</a></li>                               
                                    <li><a href="<?php echo base_url(); ?>home/AcademicCurriculum">Academic Curriculum</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/teacherattendance">Teacher Attendance</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/HowtoApply">Admission Information</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/CoCurriculum">Co-Curriculum </a></li>
                                </ul>
                            </li>

                            <li>
                                <a>Result</a>
                                <ul>

                                    <li><a href="<?php echo base_url() ?>home/ResultList/1">PSC</a></li>
                                    <li><a href="<?php echo base_url() ?>home/ResultList/2">JSC</a></li>
                                    <li><a href="<?php echo base_url() ?>home/ResultList/3">SSC</a></li>
                                    <li><a href="<?php echo base_url() ?>home/ResultList/4">HSC</a></li>
                                    <li><a href="<?php echo base_url() ?>home/admisssion_result_list">Admission Result</a></li>

                                </ul>
                            </li>

                            <li>
                                <a>Facilities</a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/Digiclass">Digi-Class</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/Library">Library</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/Science_Labs">Science Labs</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/IT_Labs">IT Labs</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/Transport">Transport </a></li>
                                    <li><a href="<?php echo base_url(); ?>home/Cafeteria">Cafeteria </a></li>
                                </ul>

                            </li>

                            <li>
                                <a>Events & News</a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/NoticeBoard">Notice Board</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/functions">Functions</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/awarnessprograms">Awareness Programs</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/Meritious_Student">Achievements</a></li>

                                </ul>
                            </li>

                            <li>
                                <a>Photos</a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/ImageGallery/2">National Events</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/ImageGallery/3">Academic Gallery</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/ImageGallery/4">Others</a></li>

                                </ul>
                            </li>
                            <li><a href="<?php echo base_url(); ?>home/Meritious_Student">Meritorious Student</a></l>
                            <li>
                                <a>Honor Board</a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/donormember">Donor Member</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/phonorlist">Previous Headmaster</a></li>
                                    <li><a href="<?php echo base_url(); ?>home/prehonorlist">Previous Chairman </a></li>


                                </ul>
                            </li>

                            <li><a href="<?php echo base_url(); ?>home/Contact">Contact</a></li>
                        </ul>
                    </div>
                    <!-- <div class="hide-s hide-m l-2">
                        <i class="icon-facebook_circle icon2x right padding"></i>
                     </div>-->
                </nav>
            </div>
        </header>


        <?php
        echo $main_content;
        ?>
        <!-- FOOTER -->
        <footer class="boxfooter">
            <div class="line">
                <div class="s-12 l-6">
                    <p style="font-size: 13px;">Copyright © All Right Reserved by AIMS</p>
                </div>
                <div class="s-12 l-6">
                    <a class="right" href="http://adventure-soft.com/" target="_blank" > Design & Developed By -<font color="green">&nbsp;<img style="float: right;" src="<?php echo base_url(); ?>demo_1/img/finallogo.jpg"></font> </a>
                </div>
            </div>
        </footer>
        <script type="text/javascript" src="<?php echo base_url(); ?>demo_1/owl-carousel/owl.carousel.js"></script>  
        <script type="text/javascript">
                                    jQuery(document).ready(function ($) {
                                        $("#owl-demo").owlCarousel({
                                            navigation: true,
                                            slideSpeed: 300,
                                            paginationSpeed: 400,
                                            autoPlay: true,
                                            singleItem: true
                                        });
                                        $("#owl-demo2").owlCarousel({
                                            items: 4,
                                            lazyLoad: true,
                                            autoPlay: true,
                                            navigation: true,
                                            pagination: false
                                        });
                                    });

                                    var today = new Date();
                                    document.getElementById('time').innerHTML = today;


        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
                                    $(document).ready(function () {
                                        $("#flip").click(function () {
                                            $("#panel").slideToggle("slow");
                                        });
                                    });
        </script>
        <script>
            $(document).ready(function () {
                $("#flip1").click(function () {
                    $("#panel").slideToggle("slow");
                });
            });
        </script>

    </body>
</html>

<!-- **jQuery** -->  

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery-migrate.min.js"></script>


<script src="<?php echo base_url(); ?>demo_1/gl/js/pace.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.tabs.min.js"></script>
<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.tipTip.minified.js"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery-easing-1.3.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.carouFredSel-6.2.1-packed.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.inview.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.bxslider.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.nav.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.donutchart.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.jcarousel.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.isotope.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.prettyPhoto.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/masonry.pkgd.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.smartresize.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/responsive-nav.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.meanmenu.min.js" type="text/javascript"></script>

<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.gmap.min.js"></script>

<!-- **Sticky Nav** -->
<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.sticky.js" type="text/javascript"></script>

<!-- **To Top** -->
<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.ui.totop.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>demo_1/gl/js/twitter/jquery.tweet.min.js"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/jquery.viewport.js" type="text/javascript"></script> 

<script type="text/javascript" src="<?php echo base_url(); ?>demo_1/gl/js/jquery.validate.min.js"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/retina.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>demo_1/gl/js/custom.js" type="text/javascript"></script>     
<link href="<?php echo base_url(); ?>demo_1/date/date.css" rel="stylesheet" type="text/css"/>  
<script src="<?php echo base_url(); ?>demo_1/date/date.js"></script>  
<script src="<?php echo base_url(); ?>demo_1/date/dateui.js"></script> 
<script src="<?php echo base_url(); ?>all_tools/js/jQuery-2.2.0.min.js"></script>
<script type="text/javascript">
      $(function () {
          $("#startdate").datepicker({dateFormat: "dd-mm-yy"}).val();
          $("#enddate").datepicker({dateFormat: "dd-mm-yy"}).val();
      });

</script>

<script type="text/javascript">

    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    
    function checkDelete(b_name)
            {
                var chk=confirm("Are You Sure to Delete This  "+b_name);
                if(chk)
                    {
                        return true;
                    }
                else{
                    return false;
                }
            }
            function checkConfirm(b_name)
            {
                var chk=confirm("Please Confirm  "+b_name);
                if(chk)
                    {
                        return true;
                    }
                else{
                    return false;
                }
            }
</script>