 <!-- ASIDE NAV AND CONTENT -->
    <div class="line">
        <div class="box margin-bottom">
            <div class="margin">
                <!-- CONTENT -->
                <article class="s-12 m-7 l-11">
                    <h3 class="titlehd"> 
                          Exam Routine of <strong><?php echo getProgramName($programinfo['programId']);   ?></strong>
                            
                    </h3>
                    <!-- CONTENT -->
                    <section class="s-12 m-7 l-12">

                   

                        <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                        <!-- Table goes in the document BODY -->
                    <?php
                       if (!empty($examroutine)) {
                    ?>
                        <table class="imagetable">
                           
                             <tr>                                
                                    <th>Sl No.</th>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Subject</th>
                                    <th>Room</th>
                                    <th>Time Slot</th>
                                </tr>
                          <?php 
           $sl=1;
            foreach($examroutine as $value){
               
              ?>
                               <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php if (!empty($value['date'])) { echo $value['date'];
                                                    }
                                                    ?> </td>
                                        <td> <?php
                                            $timestamp = strtotime($value['date']);
                                            $day = date('l', $timestamp);
                                            
                                            echo $day;
                                       ?> </td>
                                        <td> <?php
                                        if(!empty($value['courseId'])){  echo getCourseName($value['courseId']);   }
                                       ?>
                                        </td>
                                        
                                           <td>
                                                <?php
                                        if(!empty($value['room'])){  echo $value['room'];   }
                                       ?> 
                                        </td>
                                     
                                    
                                        <td>    <?php
                                        if(!empty($value['examtime'])){  echo $value['examtime'];   }
                                       ?></td>
                                        

                                      
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
               
             
                </div>
            
        </div>
    </div>
