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
          <h3 class="titlehd">  Member Information </h3>
                                      
          <?php 
              if(!empty($getdata))
              {
               
              ?>
           
                    <div style="float: left; width: 60%;">
                          <h5>Name: <?php if(!empty($getdata['name'])){ echo $getdata['name']; } ?></h5>
                
                                    <br>
                                          Designation : <?php if(!empty($getdata['designation'])){ echo $getdata['designation']; } ?> 
                                    <br>
                                       Time Period : <?php if(!empty($getdata['time_period'])){ echo $getdata['time_period']; } ?>
                                    <br> <br>
                                    <hr>
                   </div>
                                                         
                    <div style="float: left; width: 40%;">
                           <?php
                                if ($getdata['image']) {
                           ?>
                                    <img  src="<?php if (file_exists($getdata['image'])) {  echo base_url() . $getdata['image']; } else {  echo base_url() . "uploads/default/default.png"; } ?>" >
                           <?php } ?>                    

                                         
                   </div>
                   <hr>
                    
               <br> 
               <div style=" padding-left: 10px; background: #eee none repeat scroll 0 0; float: left; position: relative; width: 100%;">

                        <h4 class="titlehd">More Information</h4>
                         <hr>       
                                <?php if(!empty($getdata['aobut_emp'])){ echo $getdata['aobut_emp']; } ?>
                </div>
              
               <?php 

                    }
                  ?>


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

