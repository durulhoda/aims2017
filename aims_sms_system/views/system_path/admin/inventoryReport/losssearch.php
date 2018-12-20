<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
           Inventory
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                View Report
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
            <form class="form-horizontal"  action="<?php echo admin_Url(); ?>/inventory/loss_reportview" method="post" role="form">
                <div class="col-xs-12 col-sm-12">  
                   
                    <div class=" col-xs-6 col-sm-3">
                         <label class="control-label" for="form-field-1">Item Category :  &nbsp; <?php echo form_error('data[financeHead]', '<span class="successMessage">', '</span>'); ?></label>
                         <select data-placeholder="Select" name="data[categoryId]"  class="form-control">
                           <option value="">Select</option>
                                        <?php foreach (getinventorycategoryList() as $values) { ?>
                                            <option value="<?php echo $values['categoryId']; ?>" 
                                                    <?php echo set_select('data[categoryId]', $values['categoryId'], FALSE) ?>>
                                                        <?php echo $values['categoryName']; ?>
                                            </option>
                                        <?php } ?>

                         </select>
                    </div>  
                    <div class="col-xs-6 col-sm-3">
                        <label class="control-label" for="form-field-1">From Date &nbsp; <?php echo form_error('data[from_date]', '<span class="successMessage">', '</span>'); ?></label>
                        <input class="form-control date-picker" id="id-date-picker-1" placeholder="dd/mm/yyyy" name="data[from_date]" value="<?php echo set_value("data[from_date]"); ?>" type="text" id="form-field-mask-1" />
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <label class="control-label" for="form-field-1">To Date &nbsp; <?php echo form_error('data[to_date]', '<span class="successMessage">', '</span>'); ?></label>
                        <input class="form-control date-picker" id="id-date-picker-1" placeholder="dd/mm/yyyy" name="data[to_date]" value="<?php echo set_value("data[to_date]"); ?>" type="text" id="form-field-mask-1" />
                        
                    </div>
                </div>
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" type="submit" name="btnSubmit"> View Report  </button>
                        </div>
                    </div>
                </div>
            </form>   
    
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
    
    
    
    
    
    