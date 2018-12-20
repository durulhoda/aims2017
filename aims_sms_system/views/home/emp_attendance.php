 <!-- ASIDE NAV AND CONTENT -->
    <div class="line">
        <div class="box margin-bottom">
            <div class="margin">
                <!-- CONTENT -->
                <article class="s-12 m-7 l-8">
                    <h3 class="titlehd"> 
                        Teacher Attendance List
                    </h3>
                    <!-- CONTENT -->
                    <section class="s-12 m-7 l-12">

                   

                        <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                        <!-- Table goes in the document BODY -->
                        <table class="imagetable">
                           
                            <tr>
                                <form action="<?php echo base_url(); ?>home/searchattendance" method="post">
                                     <th>Date From</th>
                                     <th>
                                        <input type="text" name="fromDate" placeholder="DD-MM-YYYY" id="startdate"/>  
                                     </th>
                                     <th>Date To</th>
                                     <th>
                                        <input type="text" name="toDate" placeholder="DD-MM-YYYY" id="enddate"/>                                    
                                     </th>
                                     <th>
                                        <input class="savebtn" name="search" value="Search Attendance" type="submit"/>
                                     </th>
                                </form>                                 
                            </tr>
                        </table>    
                    <?php
                       if (!empty($getdata)) {
                    ?>
                        <table class="imagetable">
                            
                            <tr>
                                 <th style="background:#A5AD61;" colspan="5">
                                     <?php
                                        if(!empty($today))
                                        {
                                           echo "Attendance Of ".date('d/m/Y'); 
                                        } 
                                        elseif(!empty($fromDate) && !empty($toDate) )
                                        {
                                           echo "Attendance From ".$fromDate." To ".$toDate; 
                                        }
                                        else
                                        {
                                            echo "Attendance List";
                                        }
                                      ?>
                                  </th>                                 
                            </tr>
                            <tr>
                                 <th width="2%">SL No.</th>
                                 <th>Teacher</th>
                                 <th>Date</th>
                                 <th>Attendance Status</th>
                                 <th>Absent Reason</th>
                            </tr>
                          <?php 
                                   $s=1;
                                    foreach($getdata as $value){
                               
                              ?>
                 
                                <tr>
                                    <td width="2%"><?php  echo $s++; ?></td>
                           
                                    <td>
                                       <?php
                                        if (!empty($value['firstName'])) 
                                           echo "<b>".($value['firstName'] . " " . $value['lastName'])."</b>";
                                      ?>
                                        
                                        
                                    </td>
                                  
                                    <td>
                                            <?php
                                        if (!empty($value['attendance_date'])) {
                                            echo $value['attendance_date'];
                                        }
                                        //                            if(!empty($programInfo['shiftId'])) {echo "<br><b>Shift :</b> ".getshiftName($programInfo['shiftId']). " Shift ";}
                                        ?>
                                        </td>
                             
                                <td>
                                    <?php 
                                        if($value['attendance_status']==1)
                                        {                                        
                                       ?>
                                            <a class="green" href="#" title="Present">
                                                    Present
                                            </a>
                                        <?php
                                            }
                                            elseif($value['attendance_status']==2)
                                            {
                                         ?>
                                        <a style="color:red" href="#" title="Absent">                                                   
                                                    Absent
                                                </a>
                                          <?php
                                            }
                                            else{
                                               echo ""; 
                                            }
 
                                           ?>
                                  </td>
                                  <td>          
                                        <?php
                                            if (!empty($value['attendance_reason'])) {
                                                echo element($value['attendance_reason'],getAbsentReason(),Null);
                                            }
                                        ?> 
                                  </td>
                       </tr>
            
                               
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
