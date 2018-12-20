<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Transaction Record
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Add all transaction record
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

    <!-- div.table-responsive -->

    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal"  action="<?php echo admin_Url(); ?>/financehead/insertfinance" method="post" role="form">
            <div class="col-xs-12 col-sm-12">  
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Transaction Category  &nbsp; <?php echo form_error('data[financecategory]', '<span class="successMessage">', '</span>'); ?></label>
                

                     <select id="transaction_cat" onChange="return changeTextBox();" data-placeholder="Select" name="data[financecategory]"  required="1" class="form-control">
                        <option value="">Select</option>
                        <?php
                        foreach (getfinancecat() as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" 
                                    <?php echo set_select("data[financecategory]", $key, FALSE); ?> >
                                    <?php echo $value; ?>
                            </option> 

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-5">
                    <label class="control-label" for="form-field-1">Transaction Title  &nbsp; <?php echo form_error('data[financeHead]', '<span class="successMessage">', '</span>'); ?></label>
                    <select data-placeholder="Select" name="data[financeHead]"  required="1" class="form-control">
                        <option value="">Select</option>
                        <?php foreach (getIncomeHeadCategoryList() as $values) { ?>
                            <option value="<?php echo $values['id']; ?>" 
                                    <?php echo set_select('data[financeHead]', $values['id'], FALSE) ?>>
                                    <?php echo $values['headcategory']; ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>    
                <div class=" col-xs-10 col-sm-3">
                    <label class="control-label" for="form-field-1">Transaction Method  &nbsp; <?php echo form_error('data[financeMethod]', '<span class="successMessage">', '</span>'); ?></label>
                    <div class="radio">
                        <label class="col-xs-5 col-sm-6">
                            <input name="data[financeMethod]" onclick="document.getElementById('data[voucherNo]').disabled = false;
                            document.getElementById('data[chequeNumber]').disabled = true;
                            document.getElementById('data[bankName]').disabled = true;" checked="yes" value="1" <?php echo set_radio("data[financeMethod]", 1, FALSE); ?> type="radio" class="ace" />
                            <span class="lbl"> Cash </span>
                        </label>
                        <label class="col-xs-5 col-sm-6">
                            <input name="data[financeMethod]" onclick="document.getElementById('data[bankName]').disabled = false;
                            document.getElementById('data[chequeNumber]').disabled = false;
                            document.getElementById('data[voucherNo]').disabled = true;" value="2" <?php echo set_radio("data[financeMethod]", 2, FALSE); ?> type="radio" class="ace" />
                            <span class="lbl"> Check </span>
                        </label>
                    </div>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Voucher Number  &nbsp; <?php echo form_error('data[voucherNo]', '<span class="successMessage">', '</span>'); ?></label>
                    <input  class="form-control" type="text" name="data[voucherNo]"  id="data[voucherNo]" placeholder="Enter Voucher Number" value="<?php echo set_value("data[voucherNo]"); ?>" />
                </div> 
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Bank Name  &nbsp; <?php echo form_error('data[bankName]', '<span class="successMessage">', '</span>'); ?></label>
                    <input  class="form-control" type="text" disabled="disabled" name="data[bankName]"  id="data[bankName]" value="<?php echo set_value("data[bankName]"); ?>" placeholder="Enter Bank Name" />
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Check Number  &nbsp; <?php echo form_error('data[chequeNumber]', '<span class="successMessage">', '</span>'); ?></label>
                    <input  class="form-control" type="text" disabled="disabled" name="data[chequeNumber]" id="data[chequeNumber]" value="<?php echo set_value("data[chequeNumber]"); ?>" placeholder="Enter Check Number" />
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Debit Amount  &nbsp; <?php echo form_error('data[debit]', '<span class="successMessage">', '</span>'); ?></label>
                    <input  class="form-control" id="debit" type="text" name="data[debit]" placeholder="Enter Amount" value="<?php echo set_value("data[debit]"); ?>" />
                </div> 
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Credit Amount  &nbsp; <?php echo form_error('data[credit]', '<span class="successMessage">', '</span>'); ?></label>
                    <input  class="form-control" id="credit" type="text" name="data[credit]"  placeholder="Enter Amount" value="<?php echo set_value("data[credit]"); ?>" />
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Details  &nbsp; <?php echo form_error('data[details]', '<span class="successMessage">', '</span>'); ?></label>
                    <input  class="form-control" id="details" type="text" name="data[details]"  placeholder="Details" value="<?php echo set_value("data[details]"); ?>" />
                </div>
            </div> 


            <div class="col-xs-12">    
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>


                    </div>
                </div>
            </div>     
        </form>
        <script>
            function changeTextBox()
            {
                var comp = document.getElementById('transaction_cat');
                
                if (comp.value == '1') {
                    resetFields_credit();
                    document.getElementById('credit').disabled = false;
                    
                }
                if (comp.value == '2') {
                    resetFields_debit();
                    document.getElementById('debit').disabled = false;
                    
                }
                if (comp.value == '3') {
                    resetFields_credit();
                    document.getElementById('credit').disabled = false;
                    
                }
               
            }

            function resetFields_debit() {
                document.getElementById('credit').disabled = true;               
            }
            function resetFields_credit() {
                document.getElementById('debit').disabled = true;               
            }
           
        </script>    
    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 







