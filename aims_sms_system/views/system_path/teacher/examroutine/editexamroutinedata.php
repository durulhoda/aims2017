<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Exam Routine
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Exam Routine Information
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
            
                      <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                             <i class="ace-icon fa fa-bullhorn"></i>
                               Edit Exam Routine Information of <strong><?php echo getProgramName($programinfo['programId']);   ?></strong>
                            
                        </h3>
                       
                    </div>
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/examroutine/updateexamroutine/<?php echo $editexamroutine['routineId'];?>/<?php echo $editexamroutine['programOfferId'];?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                
                    
            <div class="col-xs-10 col-sm-4">
                        
                                            <label class="control-label" for="form-field-1">Exam Name  &nbsp; <?php echo form_error('data[examname]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[examname]" class="form-control">
                                                       <option value="">Select </option>
                                                            <?php foreach(getExamList() as $values){?>
                                                             <option <?php echo ($editexamroutine["examname"] == $values['examtypeId']) ? "selected" : "" ?> 
                                                             value="<?php echo $values['examtypeId'] ?>"> 
                                                             <?php echo getExamTypeName($values['examtypeId']); ?></option>
                                                             <?php }?>

                                                    </select>


                    </div>

                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[courseId]" class="form-control">
                                        <option value="" selected="selected">Select</option>
                                        <?php foreach (getOfferedCourseInfoArray() as $value) { ?>
                                            <option <?php echo ($editexamroutine['courseId']== $value['courseId'])? "selected":""; ?> 
                                                value="<?php echo $value['courseId'] ?>">
                                                <?php echo getCourseName($value['courseId']); ?></option>
                                                                                           
                                        <?php } ?>
                                    </select>
                    </div>
                    
                        <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Room &nbsp; <?php echo form_error('data[room]', '<span class="red">', '</span>'); ?></label>
                 <input id="form-field-1" class="form-control" type="text" name="data[room]" placeholder="Room Number" value="<?php echo ($editexamroutine['room']); ?>">
                    </div>

                      <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Date  &nbsp; <?php echo form_error('data[date]', '<span class="red">', '</span>'); ?></label>

                         <div class="input-group input-group-sm">
                             <input id="id-date-picker-1" class="form-control date-picker" type="text" name="data[date]" data-date-format="dd-mm-yyyy" value="<?php echo ($editexamroutine['date']); ?>">
                             <span class="input-group-addon">
                                 <i class="fa fa-calendar bigger-110"></i>
                             </span>
                         </div>     

                    </div>
                    

                      <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Time  &nbsp; <?php echo form_error('data[examtime]', '<span class="red">', '</span>'); ?></label>
                       <input id="form-field-1" class="form-control" type="text" name="data[examtime]" placeholder="Exam Time" value="<?php echo ($editexamroutine['examtime']); ?>">
                    </div>
                    
                    
                     
                                       
               
                            
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Update Exam Routine Information
                            </button>
                           

                        </div>
                    </div>
                </div>        
            </form>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    


