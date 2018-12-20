<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            View Exam Routine
           
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <?php
                    if (!empty($examroutinelist)) {                       
                        foreach(getOfferedSession() as $value){
                    ?>
            <div class="timeline-container">
                <div class="timeline-label">
                    <span class="label label-success arrowed-in-right label-lg">
                        <b>
                            <?php
                                if(!empty($value['sessionId'])) { echo "Session ".($value['session']);}
                            ?>    
                        </b>
                    </span>
                </div>
            
                
                  <?php
                        $s = 1;
                        foreach ($examroutinelist as $programInfo) {
                            if($value['sessionId']==$programInfo['sessionId']){
                                if($s%2==0){ $pink_red="label-pink";} else{ $pink_red="label-purple";}
                    ?>

                    <div class="timeline-items">
                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <span class="label <?php echo $pink_red; ?> label-sm">
                                    <?php
                                         if(!empty($programInfo['programId']))
                                         { echo getProgramName($programInfo['programId']);} 
                                    ?>
                                </span>
                            </div>

                            <div class="widget-box transparent">
                                <div class="widget-header">
                                    <h5 class="widget-title smaller">
                                        <span class="grey sidebar">
                                   
                                            <?php
                                                if(!empty($programInfo['groupId'])){ echo "<b>Group :</b> ".  getGroupName($programInfo['groupId']) ;}
                                            ?>
                                        </span>
                                        <span class="grey ">
                                            <?php
                                                if(!empty($programInfo['examname'])){ echo " <b>Exam :</b> ". getExamTypeName($programInfo['examname']) ;}      
                                            ?>
                                        </span>
                                        
                                    </h5>


                                    <span class="widget-toolbar">
                                        <a href="<?php echo teacher_Url();?>/examroutine/showexamroutine/<?php echo $programInfo['programOfferId'] ; ?>">
                                            <i class="ace-icon fa fa-refresh green bigger-130"></i>
                                        </a>
                                       
                               
                                        &nbsp;
                                        <!---<a href="#">
                                            <i class="ace-icon fa fa-times red bigger-125"></i>
                                        </a> -->
                                    </span>
                                </div>


                            </div>
                        </div>
                        <span id="routineview"></span>


                    </div><!-- /.timeline-items -->
            
                 <?php
                            $s++;
                            }
                    }
             ?>
            </div><!-- /.timeline-container -->
            
            <!-- 2nd Session routine start--------------->
            
             <!-- 2nd Session routine end--------------->
                     
                    <?php
                   
                        }
                    }
             ?>
             
        </div>
    </div> 
         </div>
    </div> 
         </div>
