
<section>
    <!-- CAROUSEL -->  
    <div class="line">

        <div class="line">
            <article class="s-12 m-7 l-8">
                <div id="owl-demo" class="owl-carousel_home2 owl-theme  margin-bottom">
                    <?php
                    if (!empty($sliderphoto)) {
                        foreach ($sliderphoto as $value) {
                            ?>   
                            <div class="item slider"><img src="<?php echo base_url() . "/" . $value->image; ?>" > </div>
                            <?php
                        }
                    }
                    ?>

                </div>

            </article>
            <article class="s-12 m-7 l-4">
                <div class="floater">

                    <div class="head_read2">
                        &nbsp;&nbsp;Upcoming Events
                    </div>


                    <div class="aside-nav">

         <?php
                        if (!empty($getupnoticedata)) {
                            foreach ($getupnoticedata as $value) {
                                ?>
                       
                            <div style="background: #eee; padding: 4px; margin-top:5px; border-radius: 4px;"> 
                                <a  href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>">
                                             Event Name:      <span class="dte">     <?php $limit = character_limiter($value['title'], 40);
                                        echo $limit; ?></span> </a>
                               </div>
                            <div style="float: left; padding: 6px;">
                                
                          
                          <a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>">       
                                        <img width="146px" height="42" src="<?php
                                if (file_exists($value['file'])) {
                                    echo base_url() . $value['file'];
                                } else {
                                    echo base_url() . "demo_1/img/upcoming.jpg";
                                }
                                        ?>" ></a>
                            </div>
                      
                           <div style="float: left; width:46%; height:125px; margin-top:8px;">
                         
                     
                               
                               <div style="background: #eee; padding: 4px; border-radius: 4px;  margin-top: 6px;">
                                   <font size="3px">Event Date: </font>  <a  href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>">  
                                       <span class="dte"><?php echo $value['eventdate']; ?></span></a>
                               </div>
                            
                          <br>
                          </div>
                        <img class="ber" src="<?php echo base_url();?>/demo_1/img/ber.PNG">
                      <br>
                        
                         <!--   <div style="float: left;">
                           <img src="<?php echo base_url();?>demo_1/img/upcoming.png" alt="Smiley face" width="200px" height="42" >
                          </div>
                           <div style="float: left; width:41%; height:132px; margin-top:42px;">
                         <div style="background: #eee; padding: 4px; border-radius: 4px;"> sdf</div>
                               <div style="background: #eee; padding: 4px; margin-top:4px; border-radius: 4px;"> sdf</div>
                          
                          </div>-->
                    
                    
                        
                           
                          <?php
                                }
                            }
                            ?>
                      
                        
                        <!--  <?php
                        if (!empty($getupnoticedata)) {
                            foreach ($getupnoticedata as $value) {
                                ?>
                                <p> <span class="dte">&nbsp; <?php echo $value['dateAdd']; ?></span>
                              
                                <div width="42" height="42" align="middle">
                                    <a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>">       
                                        <img class="upimg" src="<?php
                                if (file_exists($value['file'])) {
                                    echo base_url() . $value['file'];
                                } else {
                                    echo base_url() . "demo_1/img/upcoming.png";
                                }
                                        ?>" ></a>

                                               <a  href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>">
                                             Event Name:      <span class="dte">     <?php $limit = character_limiter($value['title'], 50);
                                        echo $limit; ?></span> </a>
                                    <hr>


                                    <?php
                                }
                            }
                            ?>-->     
                        </div>

                    </div>
            </article>

        </div>








        <div class="boxnoticeheader">
            <div class="line">
                <div class="s-12 l-666 dlink">
                    &nbsp;&nbsp;Update Notice 
                </div>

                <div class="s-12 l-667" style="font-size:13px;">
                    <marquee scrolldelay="100" scrollamount="5" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 4, 0);">
                        <?php
                        if (!empty($getdata)) {
                            foreach ($getdata as $value) {
                                ?>
                                &nbsp;&nbsp;<span><?php echo $value['dateAdd']; ?></span> &nbsp;<a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>"><font color="#fff">
                                    <?php $limit = word_limiter($value['title'], 1000);
                                    echo $limit; ?></font></a>  <!--<img src="<?php echo base_url(); ?>demo_1/img/aims.png" class="noticeimg">-->
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
                            }
                        }
                        ?>
                    </marquee>
                </div>
            </div>
        </div>




    </div>
    <!-- HOME PAGE BLOCK -->



    <!-- ASIDE NAV AND CONTENT -->
    <div class="line">
        <div class="box margin-bottom">
            <div class="margin">
                <!-- CONTENT -->
                <article class="s-12 m-7 l-6">
                    <?php
                    if (!empty($rowdata)) {
                        ?> 
                        <h3 class="titlehd"><?php if (!empty($rowdata))
                        echo $rowdata['title']; ?></h3>
                        <p>
                            <img class="pimage"  src="<?php
                        if (file_exists($rowdata['image'])) {
                            echo base_url() . $rowdata['image'];
                        } else {
                            echo base_url() . "demo_1/img/Principle.jpg";
                        }
                        ?>" >

                            <?php
                            if (!empty($rowdata)) {

                                $string = $rowdata['content'];
                                $string = character_limiter($string, 760);
                                echo $string;
                            }
                            ?>

                        </p>

                        <strong>
                            <a class="more" href="<?php echo base_url(); ?>home/principle_massege"><font color="green">More....</font></a></strong>
                        <?php
                    }
                    ?>
                </article>

                <article class="s-12 m-7 l-p1"> &nbsp;
                    <!--     
                   <hr class="myhr">
                   <div style="border-left: 1px solid rgb(0, 0, 0); height: 322px; float: left; padding: 3px; margin-top: 45px;"></div>&nbsp;&nbsp;&nbsp;
                   <div style="border-left:1px solid #000;height:362px; float: left; padding: 3px; margin-top: 3px;"></div>
                   <div style="border-left: 1px solid rgb(0, 0, 0); height: 322px; float: left; padding: 3px; margin-top: 22px;"></div>
                   
                    -->
                </article>



                <article class="s-12 m-7 l-p5">
                    <?php
                    if (!empty($president)) {
                        ?> 
                        <h3 class="titlehd"><?php if (!empty($president))
                        echo $president['title']; ?></h3>
                        <p>
                            <img class="pimage"  src="<?php
                        if (file_exists($president['image'])) {
                            echo base_url() . $president['image'];
                        } else {
                            echo base_url() . "demo_1/img/Principle.jpg";
                        }
                        ?>" >

                            <?php
                            if (!empty($president)) {

                                $string = $president['content'];
                                $string = character_limiter($string, 660);
                                echo $string;
                            }
                            ?>

                        </p>
                        <strong><a class="more" href="<?php echo base_url(); ?>home/presi_massege"><font color="green">More....
                               </font></a></strong>
                    <?php } ?>
                </article>



                <!-- ASIDE NAV 
                <div class="s-12 m-5 l-4">
                    <h3> <br> </h3>

                    <div class="aside-nav">

                        <img class="pimage"  src="<?php
                    if (file_exists($rowdata['image'])) {
                        echo base_url() . $rowdata['image'];
                    } else {
                        echo base_url() . "demo_1/img/Principle.jpg";
                    }
                    ?>" >
                    </div>-->
            </div>
        </div>
    </div>
</div>    

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box  margin-bottom">
        <div class="margin">
            <!-- ASIDE NAV 1 -->
            <aside class="s-12 l-3">
                <h3 class="titlehd">More Information</h3>
                <div class="aside-nav">
                    <ul>
                        <li class="aside-nav ext"><a href="<?php echo base_url(); ?>home/OurMission"> Mission Statement</a></li>
                        <li><a href="<?php echo base_url(); ?>home/LandInfo">Land Information </a></li>
                        <li><a href="<?php echo base_url(); ?>home/BuildingInfo">Building Information </a></li>
                        <li><a href="<?php echo base_url(); ?>home/RoomInfo"> Room Information</a></li>
                        <li><a href="<?php echo base_url(); ?>home/career">Career</a></li>
                        <li><a href="<?php echo base_url(); ?>home/PostInfo">Post Information</a></li>


                    </ul>
                </div>
            </aside>





            <!-- CONTENT -->
            <section class="s-12 l-6">

                <?php
                if (!empty($historydata)) {
                    ?> 
                    <h3 class="titlehd">About Institute</h3>
                    <p>
                        <?php
                        if (!empty($historydata)) {

                            $string = $historydata['content'];
                            $string = character_limiter($string, 660);
                            echo $string;
                        }
                        ?>
                    </p>
                    <?php
                    ?>
                    <strong><a class="more" href="<?php echo base_url(); ?>home/SchoolHistory"><font color="green">More....</font></a></strong>
                    <?php
                }
                ?>

            </section>
            <!-- ASIDE NAV 2 -->
            <aside class="s-12 l-3">
                <h3 class="titlehd">Notice Board</h3>
                <div class="aside-nav">
                    <ul>
                        <?php
                        if (!empty($getdata)) {
                            foreach ($getdata as $value) {
                                ?>
                                <span class="dte">&nbsp; <?php echo $value['dateAdd']; ?></span>
                                <li>
                                    <a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>">
                                        <?php $limit = character_limiter($value['title'], 20);
                                        echo $limit; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>

<div class="line">
    <div class="margin">
        <div class="s-12 m-6 l-4 margin-bottom">
            <div class="box">
                <h3 class="titlehd">Our Mission</h3>
                <p>
                    <?php
                    if (!empty($missionrowdata)) {
                        foreach ($missionrowdata as $value) {

                            $string = $value['content'];
                            $string = character_limiter($string, 160);
                            echo $string;
                        }
                        ?>
                    </p>
                    <a class="more" href="<?php echo base_url(); ?>home/OurMission"><font color="green">More....</font></a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="s-12 m-6 l-4 margin-bottom">
            <div class="box">
                <h3 class="titlehd">Building Information</h3>
                <p>
                    <?php
                    if (!empty($hrowdata)) {
                        ?>
                        <?php
                        foreach ($hrowdata as $value) {

                            $string = $value['content'];
                            $string = character_limiter($string, 160);
                            echo $string;
                        }
                        ?>



                    </p>
                    <a class="more" href="<?php echo base_url(); ?>home/BuildingInfo"><font color="green">More....</font></a>
                    <?php
                }
                ?>

            </div>

        </div>
        <div class="s-12 m-12 l-4 margin-bottom">
            <div class="box">
                <h3 class="titlehd">Rules & Regulation</h3>
                <p>

                    <?php
                    if (!empty($rulesrowdata)) {
                        foreach ($rulesrowdata as $value) {

                            $string = $value['content'];
                            $string = character_limiter($string, 160);
                            echo $string;
                        }
                        ?>     
                    </p>
                    <a class="more" href="<?php echo base_url(); ?>home/RulesRegulation"><font color="green">More....</font></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box margin-bottom">
        <div class="margin">
            <!-- CONTENT -->
            <article class="s-12 m-7 l-8">
                <h3 class="titlehd">Video Link </h3>

                <iframe width="100%" height="240" src="https://www.youtube.com/embed/idXrZ1wlygw" frameborder="0" allowfullscreen></iframe>
            </article>
            <!-- ASIDE NAV -->
            <div class="s-12 m-5 l-4">
                <h3 class="titlehd">Important Links</h3>
                <div class="aside-nav">
                    <ul>
                        <li><a href="http://www.moedu.gov.bd/" target="_blank">Ministry of Education</a></li>
                        <li><a href="http://www.dshe.gov.bd/" target="_blank">Secondary & Higher Education</a></li>
                        <li><a href="http://www.educationboardresults.gov.bd/regular/index.php" target="_blank">Education Board Result </a></li>

                        <li>
                            <a>All Education Board</a><img style=" float: right; margin-top: -37px; width: 10%; " src="<?php echo base_url() ?>/demo_1/img/ar.png">
                            <ul>
                                <li><a href="http://www.educationboard.gov.bd/" target="_blank">Education Board</a></li>
                                <li><a href="http://dhakaeducationboard.gov.bd/" target="_blank">Dhaka Education Board</a></li>
                                <li><a href="http://www.jessoreboard.gov.bd/" target="_blank">Jesore Education Board</a></li>
                                <li><a href="http://www.barisalboard.gov.bd/" target="_blank">Barisal Education Board</a></li>
                                <li><a href="http://www.bise-ctg.gov.bd/" target="_blank">Chittagong Education Board</a></li>
                                <li><a href="http://www.comillaboard.gov.bd/" target="_blank">Comilla Education Board</a></li>
                                <li><a href="http://dinajpureducationboard.gov.bd/" target="_blank">Dinajpur Education Board</a></li>
                                <li><a href="http://www.rajshahieducationboard.gov.bd/" target="_blank">Rajshahi Education Board</a></li>
                                <li><a href="http://www.educationboard.gov.bd/sylhet/" target="_blank">Sylhet Education Board</a></li>
                                <li><a href="http://www.bmeb.gov.bd/" target="_blank">Madrasah Education Board</a></li>
                                <li><a href="http://www.bteb.gov.bd/" target="_blank">Technical Education Board</a></li>
                            </ul>
                        </li>
                        <li><a href="http://www.ebook-bd.com/" target="_blank">E-Book BD</a></li>
                        <li><a href="http://www.kotharpata.com/" target="_blank"> কথার পাতা </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- GALLERY CAROUSEL -->
<div class="line">
    <?php
    if (!empty($maritphotodata)) {
        ?>

        <h3 class="titlehd">Institute Meritorious Student</h2>
            <div id="owl-demo2" class="mowl-carousel margin-bottom">
                <?php
                foreach ($maritphotodata as $value) {
                    ?>
                    <div class="item">     



                        <img class="mimg" src="<?php echo base_url() . $value['image'] ?>"  width="20%" /> 
                    <!--<p class="margin-bottom">Name / �20</p>-->
                        <form class="customform s-12" action="">
                            <div class="margin-bottom">
                                <button type="submit"><?php echo $value['stuName'] ?>
                                </button>

                            </div>
                        </form>

                    </div>



                    <?php
                }
                ?>



            </div>


    </div>
    <?php
}
?>

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box  margin-bottom">
        <div class="margin">
            <!-- ASIDE NAV 1 -->
            <aside class="s-12 l-3">
                <h3 class="head_sky">University</h3>
                <div class="aside-nav">
                    <ul>



                        <li>
                            <a>Public University</a><img style=" float: right; margin-top: -37px; width: 10%; " src="<?php echo base_url() ?>/demo_1/img/ar.png">
                            <ul>
                                <li><a>Bangladesh Open University</a></li>
                                <li><a>National University</a></li>
                                <li><a href="http://www.du.ac.bd" target="_blank">Dhaka University</a></li>
                                <li><a href="http://www.juniv.edu/" target="_blank">Jahangirnagar University</a></li>
                                <li><a href="http://www.jnu.ac.bd" target="_blank">Jagannath University</a></li>
                                <li><a href="http://www.ru.ac.bd/" target="_blank">Rajshahi University</a></li>
                                <li><a href="http://www.sau.edu.bd/" target="_blank">S A U</a></li>
                                <li><a href="http://www.cou.ac.bd/" target="_blank">Comilla University </a></li>
                                <li><a href="http://www.ku.ac.bd/" target="_blank">Khulna University</a></li>
                                <li><a href="http://www.barisaluniv.edu.bd/" target="_blank">Barisal University</a></li>
                                <li><a href="http://www.iu.ac.bd/" target="_blank">Islamic University</a></li>
                                <li><a href="http://www.jkkniu.edu.bd/" target="_blank">JKKNI University</a></li>
                                <li><a href="http://www.brur.ac.bd/" target="_blank">BRUR</a></li>
                            </ul>
                        </li>

                        <li>
                            <a>Private University</a><img style=" float: right; margin-top: -37px; width: 10%; " src="<?php echo base_url() ?>/demo_1/img/ar.png">
                            <ul>
                                <li><a href="http://www.northshouth.edu/" target="_blank">NSU </a></li>
                                <li><a href="http://www.bracu.ac.bd/" target="_blank">BU</a></li>
                                <li><a href="http://www.aiub.edu/" target="_blank">AIUB</a></li>
                                <li><a href="http://www.diu.edu.bd/" target="_blank">DIU</a></li>
                                <li><a href="http://www.iub.edu.bd/" target="_blank">IUB</a></li>
                                <li><a href="http://www.aust.edu/" target="_blank">AUST</a></li>
                                <li><a href="http://www.uiu.edu.bd/" target="_blank">UIU</a></li>
                                <li><a href="http://www.ewubd.edu/" target="_blank">EWU</a></li>
                                <li><a href="http://www.biu.ac.bd/" target="_blank">BIU</a></li>
                                <li><a href="http://www.buft.edu.bd" target="_blank">BUFT</a></li>                        
                            </ul>
                        </li>


                        <li>
                            <a>Engineering University</a><img style=" float: right; margin-top: -37px; width: 10%; " src="<?php echo base_url() ?>/demo_1/img/ar.png">
                            <ul>
                                <li><a href="http://www.buet.ac.bd/" target="_blank">BUET</a></li>
                                <li><a href="http://www.sust.edu" target="_blank">SUST</a></li> 
                                <li><a href="http://www.cuet.ac.bd/" target="_blank">CUET</a></li>
                                <li><a href="http://www.kuet.ac.bd/" target="_blank">KUET</a></li>
                                <li><a href="http://www.duet.ac.bd/" target="_blank">DUET</a></li>
                                <li><a href="http://www.ruet.ac.bd/" target="_blank">RUET</a></li>
                                <li><a href="http://www.nstu.edu.bd/" target="_blank">NSTU</a></li>
                                <li><a href="http://www.jstu.edu.bd/" target="_blank">JSTU</a></li>
                                <li><a href="http://www.bsmrstu.edu.bd/" target="_blank">BSMRSTU</a></li>
                                <li><a href="http://www.pust.ac.bd/" target="_blank">PUST</a></li>
                                <li><a href="http://www.pstu.ac.bd/" target="_blank">PSTU</a></li>
                                <li><a href="http://www.mbstu.ac.bd/" target="_blank">MBSTU</a></li>
                                <li><a href="http://www.hstu.ac.bd/" target="_blank">HSTU</a></li>
                            </ul>
                        </li>
                    </ul>




                </div>
                <h3 class="head_sky">Social Address</h3>
                <div class="fb-page" data-href="https://www.facebook.com/Adventuresoft/" data-width="260" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/Adventuresoft/"><a href="https://www.facebook.com/Adventuresoft/">Adventure-soft</a></blockquote></div></div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

            </aside>





            <!-- CONTENT -->
            <section class="s-12 l-6">
                <h3 class="titlehd">Photo Gallery</h3>

          <!--     <?php
                if (!empty($getphotodata)) {
                    foreach ($getphotodata as $value) {
                        ?>


                        <div class="margin">

                            <div class="s-12 m-6 l-4">

                                <img class="mimg" src="<?php echo base_url() . $value['image'] ?>"   />



                                          <!--<p class="margin-bottom">Name / �20</p>-->
                               <!--  <form class="customform s-12" action="">
                                    <div class="margin-bottom">
                                        <button type="submit"><?php echo $value['title'] ?></button>
                                    </div>
                                </form>
                            </div>

                        
                        <?php
                    }
                    ?>
                  <!--            
                <span style=" background: aliceblue none repeat scroll 0 0; border-radius: 8px; margin-left: 67%; padding: 5px;">
                        <a class="more" href="<?php echo base_url(); ?>home/"><font color="green">More Gallery Images</font></a>
                    </span>
                    <?php
                }
                ?>

                
                </div>-->
                
       <?php
                if (!empty($getphotodata)) {
                    ?>
               	
             <div class="portfolio-container">
             
              <?php               
                    foreach ($getphotodata as $value) {
                        ?>
                        <div class="portfolio dt-sc-one-fourth column with-space all-sort graphic-sort photography-sort outdoors-sort">
                      
<div style="height: 185px;">
                            <!-- **portfolio-thumb - Starts** -->
                            <div class="portfolio-thumb">
                                <img src="<?php echo base_url() . $value['image'] ?>" alt="image"/>
                                <div class="image-overlay">
                                    <a class="zoom" href="<?php echo base_url() . $value['image'] ?>" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a>
                                    <a class="link" href="portfolio-detail.html"><span class="fa fa-link"></span></a>
                                </div>
                            </div> <!-- **portfolio-thumb - Ends** -->
                            <!-- **portfolio-detail - Starts** -->
                            <div class="portfolio-detail">
                             
                              
                                    <h5><a href="portfolio-detail.html"><?php echo $value['title'] ?></a></h5>
                                    
                                
                            </div>
                             </div>
                            <!-- **portfolio-detail - Ends** -->
                      
                        </div>
         
                              <?php
                }
                ?>
                    
                     </div>
                <span style=" background: aliceblue none repeat scroll 0 0; border-radius: 8px; margin-left: 67%; padding: 5px;">
                        <a class="more" href="<?php echo base_url(); ?>home/"><font color="green">More Gallery Images....</font></a>
                    </span>
                         <?php
                    }
                    ?>
                
                
            </section>

            <!-- ASIDE NAV 2 -->
            <aside class="s-12 l-3">
                <h3 class="head_sky">Useful Link</h3>
                <div class="aside-nav">
                    <ul>
                        <li><a href="http://esif.dhakaeducationboard.gov.bd/" target="_blank">eSIF </a></li>
                        <li><a href="http://erp.dhakaeducationboard.gov.bd/index.php/auth/login" target="_blank">eFF</a></li>
                        <li><a href="http://dhakaeducationboard.gov.bd/index.php/etif" target="_blank">eTIF</a></li>
                        <li><a href="http://www.banbeis.gov.bd/webnew/" target="_blank">BANBEIS </a></li>
                        <li><a href="http://www.dshe.gov.bd/mpo.php" target="_blank">MPO Notice </a></li>


                    </ul>
                    <h3 class="head_sky">Download Link</h3>
                    <ul>
                        <li><a>Download Link1 </a></li>
                        <li><a>Download Link2</a></li>
                        <li><a>Download Link3</a></li>



                    </ul>
                </div>
            </aside>
        </div>

    </div>


</div>


</section>

