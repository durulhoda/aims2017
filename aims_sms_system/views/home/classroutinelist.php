 <!-- ASIDE NAV AND CONTENT -->
    <div class="line">
        <div class="box margin-bottom">
            <div class="margin">
                <!-- CONTENT -->
                <article class="s-12 m-7 l-8">
                    <h3 class="titlehd"> 
                        Institute Class Routine
                    </h3>
                    <!-- CONTENT -->
                    <section class="s-12 m-7 l-12">

                   

                        <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                        <!-- Table goes in the document BODY -->
                    <?php
                       if (!empty($classroutine)) {
                    ?>
                        <table class="imagetable">
                           
                            <tr>

                                <th width="2%">SL No.</th>
                                <th>Class</th>
                                <th>Group</th>
                                <th>Section</th>
                                <th>Session</th>

                                <th>View Routine</th>
                            </tr>
                          <?php 
           $s=1;
            foreach($classroutine as $programInfo){
               
              ?>
                            <form action="<?php echo base_url()?>home/showclassroutine" method="post">  
                                <tr>
                                    <td width="2%"><?php
                                echo $s++;
                                ?></td>
                                    <td>
                                         <?php
                                            if (!empty($programInfo['programId'])) {
                                                echo  getProgramName($programInfo['programId']);
                                            }
                                            //                               if(!empty($programInfo['mediumId'])){ echo "<br><b>Medium :</b> ".getmediumName($programInfo['mediumId']). " Medium " ;}                
                                            ?>
                                    </td>
                                    <td>
                                            <?php
                                        if (!empty($programInfo['groupId'])) {
                                            echo  getGroupName($programInfo['groupId']);
                                        }
                                        //                            if(!empty($programInfo['shiftId'])) {echo "<br><b>Shift :</b> ".getshiftName($programInfo['shiftId']). " Shift ";}
                                        ?>
                                    <td>
                                        <?php if (!empty($programInfo['sectionId'])) {
                                            echo  getsectionName($programInfo['sectionId']) . "<br>";
                                        } ?>
                                    </td>
                                    <td> 
                                        <?php if (!empty($programInfo['sessionId'])) {
                                            echo  getSessionName($programInfo['sessionId']);
                                        } ?>
                                  
                             <input  type="hidden"  name="data[programOfferId]" value="<?php echo $programInfo['programOfferId'] ; ?>"> 
                        <td>   <input  type="submit"  class="btn btn-default red" value=" View Routine" name="showroutine" > </td>
                       </tr>

                                </form>
                                <?php
    $s++;
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
