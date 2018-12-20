 <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
         <div class="box  margin-bottom">
            <div class="margin">
               <!-- ASIDE NAV 1 -->
               
               <!-- CONTENT -->
               <section class="s-12 l-9">
                <h3 class="titlehd"> Admission Result </h3>
                  
                  <iframe src="http://docs.google.com/gview?url=<?php echo base_url()."uploads/file/admissionresult_6.doc";?>&embedded=true" style="width:500px; height:500px;" frameborder="0"></iframe>
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