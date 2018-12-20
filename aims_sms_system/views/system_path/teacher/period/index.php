<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Time Period Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add New Time Period
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" action="<?php echo admin_Url(); ?>/period/insertperiod" method="POST">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Period &nbsp; <?php echo form_error('data[periodName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[periodName]" required="1" value="<?php echo set_value("data[periodName]"); ?>" class="form-control" id="form-field-1" placeholder="Period Name" />
                                
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Time &nbsp; <?php echo form_error('data[periodTime]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[periodTime]" required="1" value="<?php echo set_value("data[periodTime]"); ?>" class="form-control" id="form-field-1" placeholder="Period Time" />
                                
                    </div>
                    
                    <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select required="1" class="form-control" id="form-field-select-1" name="data[shiftId]">
                                <option value="">Select Shift</option> 
                                <?php
                                    foreach(getShiftList() as $value)
                                    {
                                ?>
                                    <option value="<?php echo $value['shiftId']; ?>" 
                                            <?php echo set_select("data[shiftId]", $value['shiftId'], FALSE); ?> >
                                                <?php echo $value['shiftName']; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Add New Time Period
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            <div class="row">
                <div class="col-xs-12">
                    <?php 
                    
                if(!empty($periodlist))
                {
                ?>  
                    
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>Sl No.</th>
                                <th>Period Name</th>
                                <th>Time</th>   
                                <th>Shift</th>   
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                    $s = 1;

                     foreach ($periodlist as $value) {
                        
                        ?>
                            <tr>
                                <td>
                                  <?php echo $s; ?>
                                </td>
                                <td>
                                     <?php 
                                     
                                       
                                        echo $value['periodName']; 
                                   
                                    ?> 
                                    
                                </td>
                                <td><?php echo $value['periodTime']; ?></td>
                                <td><?php if(!empty($value['shiftId'])) {echo getshiftName($value['shiftId']);}?></td>

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        

                                        <a href="<?php echo admin_Url() . "/period/editdperiod/" . $value['periodId']; ?>" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a> 

                                        <a onclick="return checkDelete('period ?');" title="" href="<?php echo admin_Url() . "/period/deleteperiod/" . $value['periodId']; ?>" class="btn btn-xs btn-danger">
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
                                                    <a href="<?php echo admin_Url() . "/period/editdperiod/" . $value['periodId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a onclick="return checkDelete('period ?');" title="" href="<?php echo admin_Url() . "/period/deleteperiod/" . $value['periodId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
    $s++;
}
?>
                        </tbody>
                    </table>
                    <?php  }  ?>
                </div><!-- /.span -->
            </div><!-- /.row -->
         
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        