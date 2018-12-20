<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;">                   
<div class="page-header">
    <h1>
        Transaction Record
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            JOurnal Report
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

    <div class="vspace-6-sm"></div>
    <div class="col-sm-12">
        <div class="tabbable">           
            <div class="tab-content">

                <div id="home4" class="tab-pane active">
                  <form class="form-horizontal" role="form" action="<?php echo acc_Url(); ?>/financeReport/journalreport" enctype="multipart/form-data" method="post">
              <!-- PAGE CONTENT BEGINS -->

                        <span class="col-sm-4">
                            <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>
                            <div class="input-group input-group-sm">
                                <input class="form-control date-picker"  id="id-date-picker-1" name="data[fromDate]" type="text" data-date-format="dd-mm-yyyy" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                        </span>

                        <span class="col-sm-4">
                            <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>

                            <div class="input-group input-group-sm">
                                <input class="form-control date-picker" id="id-date-picker-1" name="data[toDate]" type="text" data-date-format="dd-mm-yyyy" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>

                        </span>


                        <br><br><br>

                        <div class="clearfix form-actions">
                            <div class="col-md-12">
                                <button class="btn btn-success" name="search" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Finance Record Information
                                </button>

                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>




