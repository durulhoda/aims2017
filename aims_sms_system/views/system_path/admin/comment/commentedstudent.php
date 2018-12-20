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
        
        <?php
                if (!empty($commentlist)) {
            ?>
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                           All Student Information
                        </h3>

                        
                                      <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/student/printStudentList/<?php echo $programId?>" enctype="multipart/form-data" method="post">
                                          <input type="hidden" value="<?php if(!empty($sessionId)){echo $sessionId;} ?>" name="data[sessionId]">
                    <input type="hidden" value="<?php if(!empty($programId)){echo $programId;} ?>" name="data[programId]">
                    <input type="hidden" value="<?php if(!empty($mediumId)){echo $mediumId;} ?>" name="data[mediumId]">
                    <input type="hidden" value="<?php if(!empty($groupId)){echo $groupId;} ?>" name="data[groupId]">
                    <input type="hidden" value="<?php if(!empty($sectionId)){echo $sectionId;} ?>" name="data[sectionId]">
                       <input type="hidden" value="<?php if(!empty($shiftId)){echo $shiftId;} ?>" name="data[shiftId]">
                                      
                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-print"></i>
                                   <button class="btn btn-white btn-primary" name="search" type="submit">Print Student List</button> 
                            
                        </div>
                    </form>
                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                                <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Again </a>
                            
                        </div>
                    </div>
                <div id="modal-table" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Search Again Student List By Enrollment Information
                                    </div>
                                </div>
                                
                                    <div class="modal-body no-padding">
                                        
                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/student/searchRegisteredStudent" enctype="multipart/form-data" method="post">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">  
                                                    <!-- PAGE CONTENT BEGINS --> 
                                                    <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select id="getsessionid" onchange="return getOfferedSession_classId();" data-placeholder="Select" name="data[sessionId]"  class="form-control">
                                                        <option value="">Select</option>
                                                        <?php foreach (getOfferedSession() as $value) { ?>
                                                            <option value="<?php echo $value['sessionId']; ?>" >
                                                                <?php echo $value['session']; ?></option>                                                
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                        <div class=" col-xs-10 col-sm-4">
                                                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                                            <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                                            </select>
                                                        </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" class="form-control">

                                                        </select>
                                                    </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" class="form-control">

                                                        </select>
                                                    </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" class="form-control" >

                                                        </select>
                                                    </div>
                                                    <div class=" col-xs-10 col-sm-4">
                                                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                        <select id="getsectionid" name="data[sectionId]" class="form-control" >

                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col-xs-12">
                                                    <div class="clearfix form-actions">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-success" name="search" type="submit">
                                                                <i class="ace-icon fa fa-check bigger-110"></i> Search Student Information
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>    
                                         </form>
                                        
                                    </div>
                                    
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                <div class="row">
                    
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b> Enrollment Information</b>
                                </div>
                            </div>
 
                            <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                           <?php 
                                                      if(!empty($sessionId)) {echo "<b>".getSessionName($sessionId)."</b>"; }                                               

                                              ?>
                                             
                                               </li>
                                        
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                                <?php
                                                    if(!empty($programId))   {  echo "<b>" . getProgramName($programId) . "</b>";}
                                                ?>
                                        </li>
                                        <li>
                                                <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                                <?php
                                                    if(!empty($mediumId))   { echo "<b>" . getmediumName($mediumId) . "</b>";}
                                                ?>
                                            </li>
                                    </ul>
                                </div>
                    
                             </div>   
                            </form>
                             <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                       

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                           <?php
                                                       if(!empty($groupId)) {echo "<b>" . getGroupName($groupId) . "</b>";}
                                                ?>
                                        </li>
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                                            <?php
                                                      if(!empty($sectionId)) { echo "<b>" . getsectionName($sectionId) . "</b>";}
                                                ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                              <?php
                                                      if(!empty($shiftId))  {echo "<b>" . getshiftName($shiftId) . "</b>";}
                                                ?>
                                        </li>

                                    </ul>
                                </div>
                             </div>   
                        </div><!-- /.col -->


                    </div><!-- /.row -->
            </div>    
            <div class="table-header">
                Student List
            </div>

       
            
            <div>
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center hidden-480">
                                Sl No.
                            </th>

                            <th >Student Id</th>
                            <th>Student Name</th>
                           
                            <th>Father Info</th>
                            
                            <th class="hidden-480">Image</th>
                            <th class="hidden-480">Teacher Name</th>
                            <th>
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Action
                            </th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $sl=1;
                                foreach ($commentlist as $value) {
                                        
                          ?>
                      
                        <tr>
                            
                            <td class="center hidden-480">
                                <?php echo $sl++; ?>
                                
                                
                            </td>

                            <td>
                                <a target="_blank" href="<?php echo admin_Url() ."/student/viewstudentInfo/" .$value['studentId'];?>/<?php echo $value['programOfferId']?>">
                                        <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'];
                                            }
                                          ?>                                    
                                </a>
                            </td>

                            <td><?php
                            $employeeId=$value['employeeId'];
                           $studentId= $value['studentId'];
                            $tt= getstudentNameInfo($studentId);
                            $emp= getEmployeeName_Image($employeeId);
                         
                            echo $tt['firstName'].$tt['lastName'];
                            ?></td>


                            <td>
                                <?php echo "".$tt['fatherName'] . "<br>".$tt['fatherPhone'] ; ?>
                            </td>
                          
                            <td class="hidden-480">
                                        <?php
                                                if ($tt['photo']) {
                                            ?>
                                            <img  src="<?php if (file_exists($tt['photo'])) { echo base_url() . $tt['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
                                        <?php 
                                        
                                            } 
                                          ?>
                            </td>
                                                        <td class="hidden-480"><?php    echo $emp['firstName'].$emp['lastName']; ?></td>

                            <td>
                                           <div id="modal-table_student" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Comment Details
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">
                                               <div class="col-xs-12 col-sm-12">  
                                           <p style="background: #fff; color: #000;text-align: center; padding: 5px;"> <?php echo $value['comment']; ?></p>
                                            </div> 

                                    </div> 
                                    
                              
                                        
                                
                                    
                                 </div>       
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                        </div>
                                
                                <div class="hidden-sm hidden-xs action-buttons">
                                               <a target="_blank" href="<?php echo admin_Url();?>/student/viewdetailscomment/<?php echo $value['cmtId']; ?>" style="width: 150px; background: #EE452D; color: #fff;text-align: center; padding: 4px;" role="button" data-toggle="modal"> 
                            
                                  View Comment
                                 
                                 </a>
                                    
                                    <?php if ($value['approvestatus']==2){ 
                                        
                                    
?>
                                    <a target="_blank" href="<?php echo admin_Url();?>/student/published_course/<?php echo $value['cmtId']; ?>" title="Unpublish" style="width: 50px; background: #EE452D; color: #fff;text-align: center; padding: 4px;" role="button" data-toggle="modal"> 
                            
                                  <i class="ace-icon fa fa-reply icon-only"></i>
                                 
                                 </a>
                                    <?php } else{ ?>
                                 
                                    <a target="_blank" href="<?php echo admin_Url();?>/student/unpublished_course/<?php echo $value['cmtId']; ?>" title="Publish" style="width: 50px; background: blue; color: #fff;text-align: center; padding: 4px;" role="button" data-toggle="modal"> 
                            
                               <i class="ace-icon glyphicon glyphicon-ok"></i>
                                 
                                 </a>
                                    <?php } ?>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>                                                                                           
                                      <a href="#modal-table_student" style="width: 327px; background: #EE452D; color: #fff;text-align: center; padding: 4px;" role="button" data-toggle="modal">                             
                                  View Comment
                                 
                                 </a>
                                            </li>

                                          
                                           
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                 
                    
                           <?php
                                  }
                            ?>
                       
                     </tbody>   
                  </table>   
                </div>
            
            
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 
    

            
    
    
    
    
    
    
    
    
    
