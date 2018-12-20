 <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
         <div class="box  margin-bottom">
            <div class="margin">
               <!-- ASIDE NAV 1 -->
               <aside class="s-12 l-3">
                  <h3 class="titlehd">More Information</h3>
                  <div class="aside-nav">
                     <ul>
                        <li><a href="<?php echo base_url(); ?>home/OurMission"> Mission Statement</a></li>
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
                <h3 class="titlehd"><?php if(!empty($getdata->title))	{ echo $getdata->title; }?>  
                      <h5 class="aside-nav">Date: <?php if (!empty($getdata->dateAdd)){ echo $getdata->dateAdd; }?></h5></h3>
                
                  <p>
                       <?php if (!empty($getdata->content)) {
                          echo $getdata->content;
                      } ?>
                  </p>
                <b> Attached File </b>
                <a target="_blank" href=" <?php echo base_url();?><?php echo $getdata->file;  ?>  ">Download</a>  
        <!--
   <iframe src="<?php echo base_url() . $url; ?>"  width="70%"></iframe>-->
   
   
       
              
               </section>
               <!-- ASIDE NAV 2 -->
               <?php
                if(!empty($getnoticedata))
                {
            ?>
            <aside class="s-12 l-3">
                <h3 class="titlehd">Notice Board</h3>
                <div class="aside-nav">
                    <ul>
                    <?php
                    foreach ($getnoticedata as $value) {
                        ?>
                            <span class="dte">&nbsp; <?php echo $value['dateAdd']; ?></span>
                            <li>
                                <a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>"><?php $limit = character_limiter($value['title'], 20);
                        echo $limit;
                        ?></a></li>
                            
                                <?php } ?>
                    </ul>
                </div>
                
            </aside>
            <?php
                }
            ?>
            </div>
         </div>
      </div>