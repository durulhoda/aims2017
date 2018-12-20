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

                <h3 class="titlehd">
                     <?php
                    foreach (getMemberType() as $keyy => $val) {
                        if($keyy==$bm_cat)
                       {
                            echo "Institute ".$val;
                        } 

                      } 
                    ?>
          </h3>

                <!-- CSS goes in the document HEAD or added to your external stylesheet -->
                     <?php
                        
                        if(!empty($getdata))
                        {
                     ?>
                       
                <!-- Table goes in the document BODY -->
                <table class="imagetable">
         
                    <tr>
                        
                        <th width="2%">SL No.</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Designation</th>
                          <th>Phone Number</th>
                        <th>Details</th>
                    </tr>
                      <?php 
                      
                            $s=1;
                             foreach($getdata as $value)
                             {
                                if($value['bm_cat']==$bm_cat)
                                {
                   
              ?>
                    <tr>
                        <td width="2%"><?php    
                
                    echo $s++;  
              ?></td>
                        <td><?php
                               if ($value['bm_image']) {
                          ?>
                              <img  src="<?php if(file_exists($value['bm_image'])){ echo base_url().$value['bm_image'];}else{ echo base_url()."uploads/default/default.png"; }?>" width="60" height="60">
                          <?php } ?>
                        </td>
                        <td> <?php if(!empty($value['bm_name'])){ echo $value['bm_name']; } ?></td>
                        <td><?php if(!empty($value['bm_post'])){ echo $value['bm_post']; } ?></td>
                         <td><?php if(!empty($value['bm_phone'])){ echo $value['bm_phone']; } ?></td>
                        <td><a  class="btn btn-default" href="<?php echo base_url()?>home/ViewBoardMember/<?php echo $value['bmId'] ?>" > <font color="red">More Info</font></a></td>
                    </tr>
                     <?php
                                }
                      
                        } 
            
            ?>
                </table>
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
