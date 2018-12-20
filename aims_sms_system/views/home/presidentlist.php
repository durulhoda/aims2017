 <!-- ASIDE NAV AND CONTENT -->
    <div class="line">
        <div class="box margin-bottom">
            <div class="margin">
                <!-- CONTENT -->
                <article class="s-12 m-7 l-8">
                    <h3 class="titlehd"> 
                        Chairman List (Past)
                    </h3>
                    <!-- CONTENT -->
                    <section class="s-12 m-7 l-12">

                   

                        <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                        <!-- Table goes in the document BODY -->
                    <?php
                       if (!empty($getdata)) {
                    ?>
                        <table class="imagetable">
                           
                            <tr>

                                 <th width="2%">SL No.</th>
                                 <th>Chairman Name</th>
                                 <th>Time Period</th>
                                 <th>Image</th>
                                 <th>About Chairman</th>
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
                                        if (!empty($value['name'])) 
                                            echo $value['name'];
                                        
                                        //                            if(!empty($programInfo['shiftId'])) {echo "<br><b>Shift :</b> ".getshiftName($programInfo['shiftId']). " Shift ";}
                                        ?>
                                        
                                        
                                        </td>
                                  
                                          <td>
                                            <?php
                                        if (!empty($value['time_period'])) {
                                            echo $value['time_period'];
                                        }
                                        //                            if(!empty($programInfo['shiftId'])) {echo "<br><b>Shift :</b> ".getshiftName($programInfo['shiftId']). " Shift ";}
                                        ?>
                                        </td>
                             
                        <td>
                                <?php
                                        if ($value['image']) {
                                            ?>
                                            <img  src="<?php if (file_exists($value['image'])) {
                                                echo base_url() . $value['image'];
                                            } else {
                                                echo base_url() . "uploads/default/default.png";
                                            } ?>" width="60" height="60">
                                        <?php } ?>
                                  </td>
                                  <td>          
                            <a href="<?php echo base_url()?>home/honorview/<?php echo $value['honor_id'] ?>" ><font color="red">View Details</font></a> </td>
                       </tr>
 </form>
                               
                                <?php
  
}
?>
                        </table>
                            <?php
                                }
                             ?>



                    </section>
                    
                     </article>
                <!-- ASIDE NAV -->
               
                      <?php
                if(!empty($getnoticedata))
                {
            ?>
            <aside class="s-12 l-4">
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
