<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Class Routine
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Class Routine Information
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
             <?php
              //  if(!empty($classroutinelist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-header">
                     
                    
                    </div>
                    <div>
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                               <tr>                                
                                    <th>#</th>
                                    <th>Day</th>
                                    <th>Period Name</th>
                                    <th>Period Time</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($classroutinelist as $key => $val) : ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>                                       
                                        <td><?php echo $val->dayName; ?></td>
                                        <td><?php echo $val->periodName; ?></td>
                                        <td><?php echo $val->periodTime; ?></td>
                                        <?php if (!$val->is_break_time): ?>
                                            <td><?php echo $val->courseName; ?></td>
                                        <?php else : ?>
                                            <td style="color:red;">Break Time</td>
                                        <?php endif; ?>
                                        <td>
                                            <div class="btn-group">
                                            <?php if (!$val->is_break_time): ?>
                                                 <a href="<?php echo admin_Url();?>/classroutine/editclassroutine/<?php echo $val->routineId; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>
                                            <?php endif; ?>
                                                <a href="<?php echo admin_Url();?>/classroutine/deleteclassroutine/<?php echo $val->routineId; ?>" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                   <?php endforeach; ?>
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
    
            
        