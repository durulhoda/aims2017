<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
           Finance
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                All Transaction Information
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
            <div class="tabbable">      
                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                   
                    <li class="active">
                        <a data-toggle="tab" href="#tab1">Report By Transaction Head and Date </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab2">Student Payment Information Report </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div id="tab1" class="tab-pane active">
                        <form class="form-horizontal"  action="<?php echo admin_Url(); ?>/financeReport/searchreport" method="post" role="form">
                           <div class="clearfix">

                            <span class="col-sm-4">
                                <label class="control-label" for="form-field-1">From Date &nbsp; <?php echo form_error('data[from_date]', '<span class="successMessage">', '</span>'); ?></label>
                                <span class="input-group input-group-sm">
                                    <input class="form-control date-picker" id="id-date-picker-1" placeholder="dd/mm/yyyy" name="data[from_date]" value="<?php echo set_value("data[from_date]"); ?>" type="text" id="form-field-mask-1" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </span>
                            </span>
                               <span class="col-sm-4">
                                <label class="control-label" for="form-field-1">To Date &nbsp; <?php echo form_error('data[to_date]', '<span class="successMessage">', '</span>'); ?></label>
                                <span class="input-group input-group-sm">
                                    <input class="form-control date-picker" id="id-date-picker-1" placeholder="dd/mm/yyyy" name="data[to_date]" value="<?php echo set_value("data[to_date]"); ?>" type="text" id="form-field-mask-1" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </span>
                            </span>

                             <span class="col-sm-4">
                                 <label class="control-label" for="form-field-1">Transaction Category <span style="color: red;">*</span>  &nbsp; <?php echo form_error('data[financeCategory]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select  data-placeholder="Select" name="data[financeCategory]"  class="form-control" required>
                                     <option value="">Select</option>
                                     <option value="1">Income</option>
                                     <option value="2">Expenses</option>
                                     <option value="3">Liabilities</option>
                                 </select>
                             </span>

                               <span class="col-sm-4">
                                 <label class="control-label" for="form-field-1">Transaction Head  &nbsp; <?php echo form_error('data[financeHead]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select data-placeholder="Select" name="data[financeHead]"  class="form-control">
                                     <option value="">Select</option>
                                      <?php foreach (getIncomeHeadCategoryList() as $values) { ?>
                                         <option value="<?php echo $values['id']; ?>" 
                                                 <?php echo set_select('data[financeHead]', $values['id'], FALSE) ?>>
                                                     <?php echo $values['headcategory']; ?>
                                         </option>
                                     <?php } ?>

                                 </select>
                            </span> 
                           </div>     
                            <br>
                            <div class="clearfix form-actions">
                                <div class="col-md-12">
                                    <button class="btn btn-success" name="search" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Search Transaction Information
                                    </button>

                                </div>
                            </div>
                        
                        </form>

                    </div>
                    
                    <div id="tab2" class="tab-pane">
                        <form class="form-horizontal"  action="<?php echo admin_Url(); ?>/financeReport/class_paymentreport" method="post" role="form">
                           <div class="clearfix"> 

                               
                                <span class="col-sm-4">
                                    <label class="control-label" for="form-field-1">From Date &nbsp; <?php echo form_error('data[from_date]', '<span class="successMessage">', '</span>'); ?></label>
                                    <span class="input-group input-group-sm">
                                        <input class="form-control date-picker" id="id-date-picker-1"   placeholder="dd/mm/yyyy" name="data[from_date]" value="<?php echo set_value("data[from_date]"); ?>" type="text" id="form-field-mask-1" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </span>
                                </span>
                                <span class="col-sm-4">
                                    <label class="control-label" for="form-field-1">To Date &nbsp; <?php echo form_error('data[to_date]', '<span class="successMessage">', '</span>'); ?></label>
                                    <span class="input-group input-group-sm">
                                        <input class="form-control date-picker" id="id-date-picker-1"   placeholder="dd/mm/yyyy" name="data[to_date]" value="<?php echo set_value("data[to_date]"); ?>" type="text" id="form-field-mask-1" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </span>
                                </span>

                               <span class="col-sm-4">
                                 <label class="control-label" for="form-field-1">Payment Head  &nbsp; <?php echo form_error('data[headId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[headId]" class="form-control">
                                    <option value="">All</option>
                                    <?php foreach (getHeadList() as $value) { ?>
                                        <option value="<?php echo $value['headId']; ?>"
                                            <?php echo set_select('data[headId]', $value['headId'], FALSE) ?> >
                                            <?php echo $value['headName']; ?></option>
                                    <?php } ?>
                                </select>
                              </span>

                               <span class="col-xs-10 col-sm-4">
                                   <label class="control-label" for="form-field-1">Information Type <span style="color: red;">*</span> &nbsp; <?php echo form_error('data[info_type]', '<span class="successMessage">', '</span>'); ?></label>
                                   <select name="data[info_type]" required class="form-control">
                                       <option value="1">Collection</option> 
                                       <option value="2">Dues</option> 
                                   </select>
                               </span>
                           </div>     
                            <br>
                            <div class="clearfix form-actions">
                                <div class="col-md-12">
                                    <button class="btn btn-success" name="search" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Search Payment Information  </button>

                                </div>
                            </div>
                        
                        </form>

                    </div>

                </div>
            </div>
    
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
    
    
    
    
    
    