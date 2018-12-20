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
                 <?php
            if(!empty($rowdata))
            {
        ?> 
     <h3 class="titlehd">
          <?php 
                if(!empty($rowdata))
                {
                    echo $rowdata['title']; 
                }    
                
            ?>
      </h3>
       <?php if(!empty($rowdata['image'])){ ?>
        <img  src="<?php if(file_exists($rowdata['image'])){ echo base_url().$rowdata['image'];}else{ echo base_url()."home2/images/about.png"; }?>" >
      
            <?php 
                 }
                if(!empty($rowdata))
                {
                    echo $rowdata['content']; 
                }  
            
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