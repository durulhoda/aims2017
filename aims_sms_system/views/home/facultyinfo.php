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
          <h3 class="titlehd">Personal Information   </h3>
           <h4><?php if(!empty($getdata['firstName'])){ echo $getdata['firstName']." ".$getdata['lastName']; } ?></h4>
          
            
                        <hr>
                        <br>
                               Designation :  <?php if(!empty($getdata['designation'])){ echo " ".element($getdata['designation'],getdesignation(),Null); } ?>
                        <br>
                           Contact No. : <?php if(!empty($getdata['phone'])){ echo $getdata['phone']; } ?>
                        <br>
                           Address : <?php if(!empty($getdata['address'])){ echo $getdata['address']; } ?>
                        <br>
                           Blood Group : <?php if(!empty($getdata['bloodGroup'])){ echo element($getdata['bloodGroup'],getBloodGroup(),Null); } ?>
                        <br>
                           Joining Date : <?php if(!empty($getdata['joiningdate'])){ echo $getdata['joiningdate']; } ?>
                        <br>
                       
                          <?php
                              if (!empty($getdata['photo'])) {
                                    $img= "uploads/Employee/".$getdata['photo'];
                          ?>
                              <img style="float: right; margin: -70px 57px 15px 15px;" src="<?php if(file_exists($img)){ echo base_url().$img;}else{ echo base_url()."uploads/default/default.png"; }?>" width="100" height="120">
                          <?php } ?>
               
                   
                      
   
                      
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

