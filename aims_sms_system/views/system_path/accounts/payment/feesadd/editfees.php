<div class="page-content">
    <div style="margin-top: 20px; padding: 3.5px;">   
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
        <form class="form-horizontal" role="form" action="<?php echo acc_Url(); ?>/feesadd/updatefees/<?php echo $editData["feeId"]; ?>" enctype="multipart/form-data" method="post">

            <div class="col-xs-12 col-sm-12">  
                <!-- PAGE CONTENT BEGINS -->
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[sessionId]" required="1" class="form-control" id="form-field-select-1">

                        <?php foreach (getOfferedSession() as $valuex) { ?>
                            <option value="<?php echo $valuex['sessionId']; ?>" 
                                    <?php echo ($editData["sessionId"] == $valuex['sessionId']) ? "selected" : ""; ?>>
                                <?php echo $valuex['session']; ?></option>                                                
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[programId]" required="1" class="form-control" >
                        <?php
                        foreach (ProgramInfoArray() as $value) {
                            ?>
                            <option  value="<?php echo $value['programId'] ?>" 
                                     <?php echo ($editData["programId"] == $value['programId']) ? "selected" : ""; ?>>
                                         <?php echo $value['programName'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[mediumId]" required="1" class="form-control" id="form-field-select-1">
                        <option value=""></option> 
                        <?php foreach (getMediumList() as $value) { ?>
                            <option value="<?php echo $value['mediumId']; ?>" 
                                    <?php echo ($editData["mediumId"] == $value['mediumId']) ? "selected" : ""; ?>>
                                        <?php echo $value['mediumName']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[groupId]" required="1" class="form-control" id="form-field-select-1">
                        <option value=""></option> 
                        <?php foreach (getGroupInfoArray() as $value) { ?>
                            <option value="<?php echo $value['groupId']; ?>" 
                                    <?php echo ($editData["groupId"] == $value['groupId']) ? "selected" : ""; ?>>
                                <?php echo $value['groupName']; ?></option>                                                
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[shiftId]" required="1" class="form-control" id="form-field-select-1">
                        <option value=""></option> 
                        <?php foreach (getShiftList() as $value) { ?>
                            <option value="<?php echo $value['shiftId']; ?>" 
                                    <?php echo ($editData["shiftId"] == $value['shiftId']) ? "selected" : ""; ?>>
                                <?php echo $value['shiftName']; ?></option>                                                
                        <?php } ?>
                    </select>
                </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Payment Head  &nbsp; <?php echo form_error('data[headId]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="headId" onchange="return getHeadList();" data-placeholder="Select" name="data[headId]"  required="1" class="form-control">

                        <?php foreach (getHeadList() as $value) { ?>
                            <option value="<?php echo $value['headId']; ?>" 
                                    <?php echo set_select('data[headId]', $value['headId'], FALSE) ?> >
                                <?php echo $value['headName']; ?></option>                                                
                        <?php } ?>
                    </select>

                </div>
                
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Quota  &nbsp; <?php echo form_error('data[quata_id]', '<span class="successMessage">', '</span>'); ?></label>

                    <select data-placeholder="Select" name="data[quata_id]"  required="1" class="form-control">

                        <?php foreach (getQuatalist() as $value) { ?>
                            <option value="<?php echo $value['quata_id']; ?>" 
                                    <?php echo set_select('data[quata_id]', $value['quata_id'], FALSE) ?> >
                                <?php echo $value['quata']; ?></option>                                                
                        <?php } ?>
                    </select>

                </div>
                   <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Due Date   </label>
                        <div class="input-group input-group-sm">
                            <input id="id-date-picker-1" class="form-control date-picker" type="text" value="<?php echo $editData['DueDate'];?>" data-date-format="dd-mm-yyyy" name="data[DueDate]" placeholder="Enter Due Time">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                <div class=" col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Amount  &nbsp; </label>

                    <input type="text" name="data[amount]" value="<?php echo $editData["amount"]; ?>" class="form-control">
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