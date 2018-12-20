
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
  <?php
                             $employeeId=$comment['employeeId'];
                            $studentId= $comment['studentId'];
                            $tt= getstudentNameInfo($studentId);
                            $emp= getEmployeeName_Image($employeeId);
                         
                                                                           ?>
                            <div class="col-sm-12">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title lighter smaller">
                                            <i class="ace-icon fa fa-comment blue"></i>
                                            Comment Details Of <font color="red"><?php if(!empty($tt['firstName'])){ echo $tt['firstName'].$tt['lastName'];}?></font>
                                        </h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <div class="dialogs ace-scroll">
                                                <div class="scroll-track scroll-active" style="display: block; height: 300px;">
                                                    <div class="scroll-bar" style="height: 233px; top: 0px;"></div>
                                                </div>
                                      
                                                
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
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green"><?php if(!empty($value['date'])) {echo $value['date'];}?></span>
                                                            </div>
                                                            <div class="name">
                                                                <a href="#"><?php if(!empty($emp['firstName'])) {echo $emp['firstName']. $emp['lastName'];}?></a>
                                                            </div>
                                                            <div class="text"><?php if(!empty($comment['comment'])) {echo $comment['comment'];}?></div>
                                                            <div class="tools">
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                                </div>        
                                                
                                                                        

                                            </div>
                                        </div> </div>
                                </div></div></div>
                    </div><!-- PAGE CONTENT ENDS -->





