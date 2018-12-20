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
          <h3 class="titlehd">  Available Job Offer Information</h3>
           <h4> <?php if(!empty($getdata->postName))	{ echo $getdata->postName; }?></h4>
            <h5> Date: <?php if(!empty($getdata->date_add))	{ echo $getdata->date_add;} ?></h5>
            
                        <hr>
                        <br>
                        <?php if(!empty($getdata->requirement)) {echo $getdata->requirement; } ?>
                        <br>
                        <br>
                      <h5>Attached File</h5>
                      
                        <?php
            if(!empty($getdata->file)){
          ?>
            <a class="dlink" href="<?php echo base_url(); ?>welcome/getRequirements/<?php echo $getdata->file; ?>"> 
                Download Requirements
            </a>  
         
            <?php  } ?>

               
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