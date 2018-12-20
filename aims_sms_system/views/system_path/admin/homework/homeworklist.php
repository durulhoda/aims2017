
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
                        
         
                            <form class="form-horizontal" role="form" action="<?php echo admin_Url() ?>/homework/searchhomeworklist" method="post">
               <div class="row"> 
                <div class="col-xs-12 col-sm-12">  
                    
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
                        <select id="getprogramid" onchange="return getOfferedprogramId_Subjectid(); " name="data[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                   <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getSubjectid"  data-placeholder="Select" name="data[courseId]"  class="form-control">
                         
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
                    <a href="#modal-forms" role="button" class="red" data-toggle="modal"> Search Again Class Offer Information </a>
                </h4>
            <div class="hr hr-18 dotted hr-double"></div>
              <?php
                if(!empty($homeworklist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                    <tr>                                
                                        <th>Sl No.</th>
                                        <th>Add Date</th>
                                        <th>About Homework</th>
                                        <th>View Details</th>
                                        <th>Action</th>   
                                          
                                      
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
                                            <a href="<?php echo admin_Url() . "/homework/viewhomework/" . $value['hwId']; ?>">VIEW More</a>
                                        </td>
                                        
                                               <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo admin_Url();?>/homework/edithomework/<?php echo $value['hwId']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url();?>/homework/deletehomework/<?php echo $value['hwId']; ?>" class="delete-button btn btn-xs btn-danger">
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
                                                            <a href="<?php echo admin_Url();?>/homework/edithomework/<?php echo $value['hwId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/homework/deletehomework/<?php echo $value['hwId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
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
                 
                </div><!-- /.span -->
                    <?php
               }
           ?>
            </div><!-- /.row -->
         
        </div><!-- /.col-x12 -->
    </div> <!-- /.row -->


<script>
    $(".delete-button").click(function(){
        if(confirm("Are you sure you want to delete this?")){
            return true;
        }
        else{
            return false;
        }
    });
</script>