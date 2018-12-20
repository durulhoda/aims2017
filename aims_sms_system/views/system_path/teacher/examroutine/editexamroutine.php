<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content"> 
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
             <?php
              //  if(!empty($examroutine))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-header">
                     
                    
                    </div>
                    <div>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                           <tr>                                
                             <th>Sl No.</th>
                       
                            <th>Class</th>
                            <th>Medium</th>
                            <th>Group</th>
                            <th>Shift</th>
                            <th>Session</th>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Time Slot</th>
                            <th>Room</th>
                            <th>Action</th>
                                       </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sl=1;
                                        foreach($examroutine as $value)
                                        {
                                    ?>
                                    <tr>
                                        <td> 
                              <?php echo $sl++;?>
                                        </td>                                       
                                       
                                        <td><?php if(!empty($programinfo['programId']))
                                                { echo getProgramName($programinfo['programId']);} ?> </td>
                                        <td>
                                           <?php if(!empty($programinfo['mediumId']))
                                                { echo getmediumName($programinfo['mediumId']);} ?>
                                        </td>
                                        <td >
                                         <?php if(!empty($programinfo['groupId']))
                                                { echo getGroupName($programinfo['groupId']);} ?>
                                        </td>
                                        
                                        <td>
                                            <?php if(!empty($programinfo['shiftId']))
                                                { echo getshiftName($programinfo['shiftId']);} ?>
                                            </td>
                                            
                                              <td>
                                                  <?php if(!empty($programinfo['sessionId']))
                                                { echo getSessionName($programinfo['sessionId']);} ?>
                                            </td>
                                            
                                              <td>
                                                  <?php if(!empty($value['date']))
                                                { echo $value['date'];} ?>
                                            </td>
                                            
                                              <td>
                                                  <?php if(!empty($value['courseId']))
                                                { echo getCourseName($value['courseId']);} ?>
                                            </td>
                                            
                                              <td>
                                                  
                                                  <?php if(!empty($value['examtime']))
                                                { echo $value['examtime'];} ?>
                                            </td>
                                            
                                              <td>
                                                  
                                                 <?php if(!empty($value['room']))
                                                { echo $value['room'];} ?>
                                            </td>
                                        </td>
                                       
                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                 <a href="<?php echo admin_Url();?>/examroutine/editexamroutinedata/<?php echo $value['routineId']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url();?>/examroutine/deleteExamroutine/<?php echo $value['routineId']; ?>" class="btn btn-xs btn-danger">
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
                                                            <a href="<?php echo admin_Url();?>/examroutine/editexamroutinedata/<?php echo $value['routineId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/examroutine/deleteExamroutine/<?php echo $value['routineId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
            </div><!-- /.row -->
             <?php
               }
           ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
        </div>
</div>
        </div>
    
            
        