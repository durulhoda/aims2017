<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Homework Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                All Homework Information
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
            
            <div id="modal-forms" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"> &times;</button>
                            <h4 class="green bigger">Search Again Homework Information</h4>
                        </div>
                        <div class="modal-body">
                        
         
                            <form class="form-horizontal" role="form" action="<?php echo student_Url() ?>/homework/searchhomeworklist" method="post">
               <div class="row"> 
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    
               
                    
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
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
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                   <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid"  data-placeholder="Select" name="data[courseId]"  class="form-control">
                            <option value="">Select</option>
                             <?php foreach (getCourseList() as $value) { ?>
                                <option value="<?php echo $value['courseId']; ?>" 
                                        <?php echo set_select('data[courseId]', $value['courseId'], FALSE) ?> >
                                    <?php echo $value['courseName']; ?></option>                                                
                            <?php   }    ?>
                        </select>
                    </div>
                             
                </div> 
                   
          
                
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="save" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Search Homework Information
                            </button>
                            

                        </div>
                    </div>
                </div> 
                   </div>
            </form>
             
       
                         </div>      
                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->
            
                <h4 class="pink">
                    <i class="ace-icon fa fa-hand-o-right red"></i>
                    <a href="#modal-forms" role="button" class="red" data-toggle="modal"> Search Again Homework Information </a>
                </h4>
            <div class="hr hr-18 dotted hr-double"></div>
              <?php
                if(!empty($homeworklist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                            <table id="" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                    <tr>                                
                                        <th>Sl No.</th>
                                        <th>Add Date</th>
                                        <th>About Homework</th>
                                        <th>View Details</th>   
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sl=1;
                                        foreach($homeworklist as $value)
                                        {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>                                        
                                        <td> 
                                           <?php
                                            if (!empty($value['date'])) {
                                                echo ($value['date']);
                                            }
                                            ?></td>
                                        <td>
                                                    <?php
                                                    $string = $value['homework'];
                                                    $string = character_limiter($string, 50);
                                                    echo $string; ?>
                                                    </td>
                                                    
                                      
                                        <td> 
                                            <a href="<?php echo student_Url() . "/homework/viewhomework/" . $value['hwId']; ?>">VIEW More</a>
                                        </td>
                                        
                                            
                                      
                                    </tr>
                                     <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                 
                </div><!-- /.span -->
                    <?php
               }
           ?>
            </div><!-- /.row -->
         
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
       </div>
         
        </div>
    </div>
    
    
    
    
    
    
    