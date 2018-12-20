<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
    Payment
     <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Payment History
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


    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form  action="<?php echo admin_Url(); ?>/paymentadd/searchpaymentlist" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Session :&nbsp;</label>
                    <select class="col-xs-10 col-sm-2" name="data[sessionId]"  required="">
                        <option value="">Select</option>
                        <?php foreach (getOfferedSession() as $value) { ?>
                            <option value="<?php echo $value['sessionId']; ?>" 
                                    <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                <?php echo $value['session']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student ID : </label>


                    <input type="text" id="form-field-1" name="data[studentId]" placeholder="Student ID" class="col-xs-10 col-sm-2" />

                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-search bigger-110"></i>
                            Search
                        </button>


                    </div>
                </div>
            </form>
        </div>
    </div>








