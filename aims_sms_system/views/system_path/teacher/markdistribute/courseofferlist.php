<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">   
<div class="row">
        <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
                ?>
                <div class="alert alert-block alert-success">
                    <i class="ace-icon fa fa-check green"></i>
               <?php
                    echo $message;
                    $this->session->unset_userdata('message');
                    ?>
                </div>
             <?php
                } 
            
                $errormessage = $this->session->userdata('errormessage');
                if (isset($errormessage)) {
                    ?>
                    <div class="alert alert-block alert-danger">
                        <i class="ace-icon fa fa-times red"></i>
                        <?php
                        echo $errormessage;
                        $this->session->unset_userdata('errormessage');
                        ?>
                    </div>
             <?php
                }
            ?>              
        <div class="col-xs-12">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            Subject Offer Information
                        </h3>

                      
                    </div>
          
          </div><!-- PAGE CONTENT ENDS -->  
                <h4 class="pink">
                    <?php echo getProgramName($programId)."&nbsp; Section-".  getsectionName($sectionId)."&nbsp; Group-".getGroupName($groupId)."&nbsp; Session-".getSessionName($sessionId); ?>
                </h4>
            <div class="hr hr-18 dotted hr-double"></div>
              <?php
                if(!empty($courseofferlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                    <tr>                                
                                        <th>Sl No.</th>
                                        <th>Subject Name</th>
                                        <th>Obtain Mark</th>                                         
                                        <th class="hidden-480">Assign Teacher</th>                                          
                                        <th class="hidden-480">Class Status</th>   
                                        <th>Mark Distribution</th> 
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sl=1;
                                        $count_mark=0;
                                        foreach($courseofferlist as $val)
                                        {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>                                        
                                        <td> <?php echo "<b> ".$val['courseName']."</b>"; ?></td>
                                        <td> <?php echo $mark=$val['marks']; ?></td>
                                        
                                        <td class="hidden-480"> <?php echo "<a><span class=\"label label-sm label-success arrowed arrowed-righ\">".$val['firstName']." ".$val['lastName']."</span></a><br>".$val["employeeId"]; ?></td>
                                        <td class="hidden-480"> <?php echo ($val["status"] == 1) ? "<span class=\"label label-sm label-info arrowed arrowed-righ\">Active</span>" : "<span class=\"label label-sm label-danger\">Inactive</span>" ?></td>
                                  
                                          <?php
                         
                                                    $subOffercheck = CourseofferId($val['offerId']);
                                                     if (empty($subOffercheck)) {                                               
                                             ?>
                         
                      <td align="center">
                                              
                          <a class="center" tabindex="-1" target="_blank" href="<?php echo teacher_Url();?>/Subjectmarks/markdistribute/<?php echo $val['offerId']; ?>">
                                                <button class="btn btn-xs btn-danger">
                                                            <i class="ace-icon fa fa-gavel"></i>
                                                           Distribute
                                                           <i class="ace-icon fa fa-gavel"></i>
                                                        </button>
                                                     </a>
                                            </td>
                            
                        
                             <?php
                                                    }
                                                    else
                                                        { 
                                                    
                                                    ?>
                                                <td align="center">
                                              
                                                    <a class="center" tabindex="-1" href="#">
                                                <button class="btn disabled">
                                                            <i class="ace-icon fa fa-gavel"></i>
                                                         Already Distributed
                                                           <i class="ace-icon fa fa-gavel"></i>
                                                        </button>
                                                     </a>
                                            </td>
                                            
                                             <!-- <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                 <a href="<?php echo admin_Url();?>/courseoffer/editcourseoffer/<?php echo $val['offerId']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url();?>/courseoffer/deletecourseoffer/<?php echo $val['offerId']; ?>" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/courseoffer/editcourseoffer/<?php echo $val['offerId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/courseoffer/deletecourseoffer/<?php echo $val['offerId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td> -->
                                            
                                                        <?php
                                                        
                                              
                                                        }
                                                        
                                                        ?>
                                        
                            
                                        
                                    
                                        
                                    </tr>
                                     <?php
                                     
                                            $count_mark=$count_mark+$mark;
                                        }
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo "<b>Total:</b> ".$count_mark;?></td>
                                        <td></td>
                                        <td></td>
                                        <td class="hidden-480"></td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                 
                </div><!-- /.span -->
            </div><!-- /.row -->
             <?php
               }
           ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
    
    
    
    
    
    