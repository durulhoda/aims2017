 
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">

            <!-- /Content Section  -->                    
            <div class="page-header">
                <h1>
                    Activities
                    <small class="red">
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Comment List from Teacher
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">

                <div class="col-sm-2">   &nbsp;
</div>
                <div class="col-sm-8">       

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="col-sm-12">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title lighter smaller">
                                            <i class="ace-icon fa fa-comment blue"></i>
                                            Comment List
                                        </h4>
                                    </div>
                                    <?php if(!empty($commentData)){
                                        
                                    
?>
                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <div class="dialogs ace-scroll">
                                                <div class="scroll-track scroll-active" style="display: block; height: 300px;">
                                                    <div class="scroll-bar" style="height: 233px; top: 0px;"></div>
                                                </div>
                                               <?php
                                                                            foreach ($commentData as $value){
                             $employeeId=$value['employeeId'];
                            $studentId= $value['studentId'];
                            $tt= getstudentNameInfo($studentId);
                            $emp= getEmployeeName_Image($employeeId);
                         
                                                                           ?>
                                                
                                                <div class="scroll-content" style="max-height: 300px;">
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                          
                                                              <td class="hidden-480">
                                                                      <?php
                                                if ($emp['photo']) {
                                                $img="uploads/Employee/".$emp['photo'];
                                            ?>
                                            <img  src="<?php if(file_exists($img)){ echo base_url()."uploads/Employee/".$emp['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
                                        <?php 
                                        
                                            } 
                                          ?>
                                            
                                      
                            </td> 
                                                        
                                                        </div>
                                                        <div class="body">
                                                            <div class="time">
                                                               
                                                                Student Name  :  <span class="green">"<?php if(!empty($tt['firstName'])) {echo $tt['firstName'].$tt['lastName'];}?>"</span>&nbsp;
                                                               <i class="ace-icon fa fa-clock-o"></i> <span class="green"><?php if(!empty($value['date'])) {echo $value['date'];}?></span>
                                                            </div>
                                                            
                                                            <div class="name">
                                                                <a href="#"><?php if(!empty($emp['firstName'])) {echo $emp['firstName']. $emp['lastName'];}?></a>
                                                            </div>
                                                            <div class="text"><?php if(!empty($value['comment'])) {echo $value['comment'];}?></div>
                                                            <div class="tools">
                                                            </div>
                                                        </div>
                                                        <div class="itemdiv dialogdiv">
                                                            <div class="itemdiv dialogdiv">
                                                                <div class="itemdiv dialogdiv">
                                                                    <div class="itemdiv dialogdiv">
                                                                    </div>
                                                                </div>
                                                                <form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>        
                                                
                                                                            <?php } ?>

                                            </div>
                                        </div> </div>
                                    <?php }?>
                                </div></div></div>
                    </div><!-- PAGE CONTENT ENDS -->



