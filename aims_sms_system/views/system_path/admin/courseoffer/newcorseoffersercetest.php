<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Subject Offer Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            All Subject Offer Information
        </small>
    </h1>
</div><!-- /.page-header -->

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
        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/courseoffer/selectcourseofferlist" method="post">

            <div class="col-xs-12 col-sm-12">  
                <!-- PAGE CONTENT BEGINS -->
                <div class="col-xs-10 col-sm-4">

                    <label class="control-label" id="seerror" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getsessionid" onchange="return getOfferedSessionId();" data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                        <option value="">Select</option>
                        <?php foreach (getOfferedSession() as $value) { ?>
                            <option value="<?php echo $value['sessionId']; ?>" 
                                    <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                <?php echo $value['session']; ?></option>                                                
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">

                    </select>
                </div>
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getprogramid" onchange="return getOfferedprogramId();" name="data[programId]" required="1" class="form-control">

                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getmediumid" onchange="return getOfferedmediumId();" name="data[mediumId]" required="1" class="form-control">

                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getshiftid" onchange="return getOfferedshiftId();" name="data[shiftId]" required="1" class="form-control" >

                    </select>
                </div>
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getgroupid" onchange="return getOfferedgroupId();" name="data[groupId]" required="1" class="form-control">

                    </select>
                </div>
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                    </select>
                </div>


            </div> 


            <div class="col-xs-12">
                <div class="clearfix form-actions">
                    <div class="col-md-12">
                        <button class="btn btn-success" id="btnSearch" name="btnSubmit" type="button">
                            Search Subject Offer Information
                        </button>

                    </div>
                </div>
            </div>        
        </form>

    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 

<div class="col-xs-12">
    <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/courseoffer/insertCourseoffer" method="post">


        <div class="row">

            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                        <b> Subject Offer List According To Your Enrollment Information</b>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                <?php
                                if (!empty($sessionId)) {
                                    echo "<b>" . getSessionName($sessionId) . "</b>";
                                }
                                ?>
                                <input type="hidden" value="<?php echo $sessionId; ?>" name="sessionId">
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                <?php
                                if (!empty($programId)) {
                                    echo "<b>" . getProgramName($programId) . "</b>";
                                }
                                ?>
                                <input type="hidden" value="<?php echo $programId; ?>" name="programId">
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
<?php
if (!empty($mediumId)) {
    echo "<b>" . getmediumName($mediumId) . "</b>";
}
?>
                                <input type="hidden" value="<?php echo $mediumId; ?>" name="mediumId">
                            </li>
                        </ul>
                    </div>
                </div>   
                <div class="col-xs-12 col-sm-6">
                    <div>
                        <ul class="list-unstyled spaced">


                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Group: 
<?php
if (!empty($groupId)) {
    echo "<b>" . getGroupName($groupId) . "</b>";
}
?>
                                <input type="hidden" value="<?php echo $groupId; ?>" name="groupId">
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                                <?php
                                if (!empty($sectionId)) {
                                    echo "<b>" . getsectionName($sectionId) . "</b>";
                                }
                                ?>
                             
                                <input type="hidden" value="<?php echo $sectionId; ?>" name="sectionId">
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
<?php
if (!empty($shiftId)) {
    echo "<b>" . getshiftName($shiftId) . "</b>";
}
?>
                                <input type="hidden" value="<?php echo $shiftId; ?>" name="shiftId">
                            </li>
                                
                    

                        </ul>
                    </div>
                </div>   
            </div><!-- /.col -->


        </div><!-- /.row -->
    <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                <tr>                                
                    <th>Sl No.</th>
                    
                      <th>
                       Select 
                       </th>
                    <th>Subject Name</th>
                    <th>Mark</th>
                    <th>Teacher Name</th>
                    



                </tr>
            </thead>
<?php
 $sl=1;
  $test=   $courseofferlist['programOfferId'];
foreach ($courselist as $value) {
  
    ?>
                <tbody id="datainfo2">
                    <tr>
                        
                        <td><?php echo $sl; ?></td>
                        <td>
                          
                             <?php
                         
                                                    $subOffercheck = checkCourse($value['courseId'],$test);
                                                     if (empty($subOffercheck)) {                                               
                                             ?>
                         
                            <input type="checkbox" name="serial[]" value="<?php echo $sl; ?>">
                            
                        
                             <?php
                                                    }
                                                    else{ echo "<span class=\"label label-sm label-success\">Already Offered</span>"; }
                                                    ?>

                        </td>
                        
                        <td>
                             <?php
                                     if (!empty($value['courseId'])) {
                                         echo getCourseName($value['courseId']);
                                     }
                                     ?>
                                     <input type="hidden" name="courseId[]" value ="<?php
                                     if (!empty($value['courseId'])) {
                                         echo $value['courseId'];
                                     }
                                     ?>" 
                            
                       
                                    

                        </td>
                        
                            <td>
                         
                          
                             <?php
                         
                                                    $subOffercheckk = checkCourse($value['courseId'],$test);
                                                     if (!empty($subOffercheckk)) { 
                                                         echo $subOffercheckk['marks'];
                                             ?>
                         
                           
                            
                        
                             <?php
                                                    }else{ ?>
                             
                               <input type="text" name="marks[]" value="<?php echo set_value("data[marks]"); ?>" class="form-control" id="form-field-1" placeholder="Subject Marks" />

                             <?php
                             
                                                    }?>
                                                          
                             

            
                        </td>
                        
                        <td>
                               <?php
                         
                                                    $subOffercheckkk = checkCourse($value['courseId'],$test);
                                                     if (!empty($subOffercheckkk)) {     
                                                         
                                                          $employeeId=$subOffercheckkk['employeeId']; 
                                                      
                                                       $name=getTeacher($employeeId);
                                                             echo "<b>".$name['firstName'] . " " . $name['lastName']."</b>";  
                                                     
                                             ?>

               
                              <?php
                                                    }
                                                      else{
                                                          ?>
                             <select name="employeeId[]" class="form-control">
                        <option value="">Select</option>
    <?php foreach (getTeacherInfoArray() as $value) { ?>
                                    <option value="<?php echo $value['employeeId']; ?>" 
        <?php echo set_select('data[employeeId]', $value['employeeId'], FALSE) ?> >
        <?php echo $value['firstName'] . " " . $value['lastName']; ?></option>                                                
    <?php } ?>
                            </select>
                                                         
                                                          
                                                 <?php         
                                                      }   
                                                      ?>
                            
                     
                        </td>

   

                    

                    </tr>

                </tbody>
<?php 
    $sl++;
    }
?>
        </table>

        <div class="col-xs-12">
            <div class="clearfix form-actions">
                <div class="col-md-12">
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="programOfferId" value="<?php echo $programOfferId; ?>">
                    <button class="btn btn-success" name="btnSubmit" type="submit">
                        Save Subject Offer Information
                    </button>

                </div>
            </div>
        </div>
    </form>
</div>






