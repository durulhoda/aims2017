<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Payment
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Edit Fees
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
        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/feesadd/update/<?php echo $editData["feeId"]; ?>" method="post">

            <div class="col-xs-12 col-sm-12">  
                <!-- PAGE CONTENT BEGINS -->
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[sessionId]" required="1" class="form-control" id="getsessionidd" onchange="return getProgrammOfferId(); ">
                        <option value="">Select a session</option>
                        <?php foreach (getOfferedSession() as $valuex) { ?>
                            <option value="<?php echo $valuex['sessionId']; ?>" 
                                    <?php echo ($editData["sessionId"] == $valuex['sessionId']) ? "selected" : ""; ?>>
                                <?php echo $valuex['session']; ?></option>                                                
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-8">
                        <label class="control-label" for="form-field-1">Enrollment Name  &nbsp; <?php echo form_error('data[programOfferId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getProgramOfferId" name="data[programOfferId]"  required="" class="form-control">
                            <option value="">...Select a program offer name...</option>
                            <?php 
                            foreach ($programOfferlist as $key => $val) { 
                                $poName = $val->programName."->".$val->mediumName."->".$val->groupName."->".$val->shiftName."->".$val->sectionName;
                                ?>
                            <option value="<?php echo $val->id; ?>" 
                                    <?php echo ($editData["programOfferId"] == $val->id) ? "selected" : ""; ?>>
                                <?php echo $poName; ?></option>                                                
                        <?php } ?>
                        </select>
                    </div>

                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Payment Head  &nbsp; <?php echo form_error('data[headId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="headId" onchange="return getHeadList();" data-placeholder="Select" name="data[headId]"  required="" class="form-control">
                        <option value="">Select a payment head</option> 
                        <?php foreach (getHeadList() as $value) { ?>
                            <option value="<?php echo $value['headId']; ?>" 
                                    <?php echo set_select('data[headId]', $value['headId'], FALSE) ?> <?php echo ($editData["headId"] == $value['headId']) ? "selected" : ""; ?> >
                                <?php echo $value['headName']; ?></option>                                                
                        <?php } ?>
                    </select>

                </div>
                <div class="col-sm-3">
                        <label class="control-label" for="form-field-1">Due Date   </label>
                        <div class="input-group input-group-sm">
                            <input id="id-date-picker-1" class="form-control date-picker" type="text" value="<?php echo date("d-m-Y", strtotime($editData['DueDate']));;?>" data-date-format="dd-mm-yyyy" name="data[DueDate]" placeholder="Enter Due Time">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class=" col-xs-10 col-sm-3">
                    <label class="control-label" for="form-field-1">Quota  &nbsp; <?php echo form_error('data[quata_id]', '<span class="successMessage">', '</span>'); ?></label>

                    <select data-placeholder="Select" name="data[quata_id]"  required="1" class="form-control">

                        <?php foreach (getQuatalist() as $value) { ?>
                            <option value="<?php echo $value['quata_id']; ?>" 
                                    <?php echo set_select('data[quata_id]', $value['quata_id'], FALSE) ?> <?php echo ($editData["quata_id"] == $value['quata_id']) ? "selected" : ""; ?>>
                                <?php echo $value['quata']; ?></option>                                                
                        <?php } ?>
                    </select>

                </div>
                <div class=" col-xs-10 col-sm-2">
                    <label class="control-label" for="form-field-1">Amount  &nbsp; </label>

                    <input type="text" name="data[amount]" required="" value="<?php echo $editData["amount"]; ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-11">
                            <button class="btn btn-success"  type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Fees
                            </button>

                        </div>
                    </div>
                </div>   
            </div>
        </form>

    </div>
</div>