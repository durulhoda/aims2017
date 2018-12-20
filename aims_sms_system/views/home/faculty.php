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
                        if(!empty($employeeType))
                        {
                            if($employeeType==1)
                            {
                                echo "Faculty Member Information";
                            }
                            elseif($employeeType==2)
                            {
                                echo "Third Grade Stuff Information";
                            }
                            elseif($employeeType==3)
                            {
                                echo "Fourth Grade Stuff Information";
                            }
                            elseif($employeeType==4)
                            {
                                echo "Institute Management Member";
                            }
                        }
                      ?>
                </h3>

                <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                <!-- Table goes in the document BODY -->
                 <?php
                       if (!empty($getdata)) {
                    ?>
                <table class="imagetable">
         
                    <tr>
                        
                        <th width="2%">SL No.</th>
                        <th>Images</th>
                        <th>Teacher Name</th>
                        <th>Designation</th>
                          <th>Phone Number</th>
                         
                        <th>Details</th>
                    </tr>
               <?php 
           $s=1;
            foreach($getdata as $value){
              
              ?>
                    <tr>
                        <td width="2%"><?php    
                
                    echo $s++;  
              ?></td>
                        <td>
                            <?php
                               if ($value['photo']) {
                                    $img= "uploads/Employee/".$value['photo'];
                            ?>
                              <img  src="<?php if(file_exists($img)){ echo base_url().$img;}else{ echo base_url()."uploads/default/default.png"; }?>" width="60" height="60">
                          <?php } ?>
                        </td>
                        <td> <?php if(!empty($value['firstName'])){ echo $value['firstName']." ".$value['lastName']; } ?></td>
                        <td><?php if(!empty($value['designation'])){ echo element($value['designation'],getdesignation(),null); } ?></td>
                         <td><?php if(!empty($value['phone'])){ echo $value['phone'];} ?></td>
                         
                        <td><a target="_blank" class="btn btn-default" href="<?php echo base_url()?>home/ViewFacultyMember/<?php echo $value['employeeId'] ?>" > <font color="red">More Info</font></a></td>
                    </tr>
                     <?php
            
                  
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

