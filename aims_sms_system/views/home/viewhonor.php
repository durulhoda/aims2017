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
          <h3 class="titlehd">  President of <?php  $ins_info = getInstituteInfo();
                                                    if (!empty($ins_info)) {   echo $ins_info['instituteName'];}  ?> 
    </h3>
                                      
                                           <?php 
           $s=1;
            foreach($getdata as $value){
               
              ?>
          
                            
         
   
          
            
                                    
   <div style="float: left; width: 60%;">
       <br> <br><br>
       Name: <?php if(!empty($value['name'])){ echo $value['name']; } ?>
    
                        <br>
                               Designation : <?php if(!empty($value['designation'])){ echo $value['designation']; } ?> 
                        <br>
                           Time Period : <?php if(!empty($value['time_period'])){ echo $value['time_period']; } ?>
                        <br> <br>
                        <hr>
       </div>
                                             
        <div style="float: left; width: 40%;">
               <?php
                                        if ($value['image']) {
                                            ?>
                                            <img  src="<?php if (file_exists($value['image'])) {
                                                echo base_url() . $value['image'];
                                            } else {
                                                echo base_url() . "uploads/default/default.png";
                                            } ?>" >
                                        <?php } ?>

                              <?php }?>
       </div>
                   <hr>
                    
             <br> <div style=" padding-left: 10px;  margin-top: 7px; background: #eee none repeat scroll 0 0; float: left; position: relative; width: 100%;">

 <h4>About <?php if(!empty($value['name'])){ echo $value['name']; } ?></h4>
                       <hr>       
                              <?php if(!empty($value['aobut_emp'])){ echo $value['aobut_emp']; } ?>
            </div>
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

