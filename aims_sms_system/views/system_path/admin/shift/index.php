 <!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            All Shift Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add New Shift
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
            <form class="form-horizontal" role="form"  action="<?php echo admin_Url();?>/shift/insertShift" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="has-error col-xs-6 col-sm-4">   
                            <label class="control-label" for="form-field-1">Shift Name &nbsp; <?php echo form_error('data[shiftName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[shiftName]" required="1" value="<?php echo set_value("data[shiftName]"); ?>" class="form-control" id="form-field-1" placeholder="Shift Name" />
                                
                    </div>
                    <div class="has-error col-xs-3 col-sm-2">   
                            <label class="control-label" for="form-field-1">Start Time &nbsp; <?php echo form_error('data[startTime]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" id="timepicker1" name="data[startTime]" required="1" value="<?php echo set_value("data[startTime]"); ?>" class="form-control" id="form-field-1" placeholder="Start Time" />
                                
                    </div>
                    <div class="has-error col-xs-3 col-sm-2">   
                            <label class="control-label" for="form-field-1">End Time &nbsp; <?php echo form_error('data[endTime]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[endTime]" id="timepicker2" required="1" value="<?php echo set_value("data[endTime]"); ?>" class="form-control" id="form-field-1" placeholder="End Time" />
                                
                    </div>
                    
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Add New Shift
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
         <?php
                if(!empty($listdata))
                {
              ?>    
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>Sl No.</th>
                                <th>Shift</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                             <?php
                                $sl=1;
                                foreach($listdata as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                <td> <?php echo $val['shiftName'] ?></td>
                                <td> <?php echo ($val['startTime'] != 0) ? date('h:i:a', strtotime($val['startTime'])) : ""; ?></td>
                                <td><?php echo ($val['endTime'] != 0) ? date('h:i:a', strtotime($val['endTime'])) : ""; ?></td>
                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        <a href="<?php echo admin_Url();?>/shift/editdshift/<?php echo $val['shiftId']; ?>" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo admin_Url();?>/shift/deleteshift/<?php echo $val['shiftId']; ?>" class="btn btn-xs btn-danger">
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
                                                    <a href="<?php echo admin_Url();?>/shift/editdshift/<?php echo $val['shiftId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo admin_Url();?>/shift/deleteshift/<?php echo $val['shiftId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
                </div><!-- /.span -->
            </div><!-- /.row -->
            <?php
               }
           ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        