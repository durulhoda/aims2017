<!-- /.row -->

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
<div class="col-xs-12 col-sm-12">
<div class="widget-box transparent">
    <div class="widget-header widget-header-large">
        <h3 class="widget-title grey lighter">
            <i class="ace-icon fa fa-exchange green"></i>
            Search All Student Attendence
        </h3>
    </div>
</div>


<div class="row">
    <div class="modal-body no-padding">
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/report_student_attendance/search_attendance" enctype="multipart/form-data" method="post">

                <div class="col-xs-12 col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('from_date', '<span class="successMessage">', '</span>'); ?></label>

                        <div class="input-group input-group-sm">
                            <input autocomplete="off" class="form-control date-picker" id="id-date-picker-1" name="from_date" type="text" data-date-format="yyyy-mm-dd" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('to_date', '<span class="successMessage">', '</span>'); ?></label>

                        <div class="input-group input-group-sm">
                            <input autocomplete="off" class="form-control date-picker" id="id-date-picker-1" name="to_date" type="text" data-date-format="yyyy-mm-dd" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                        </div>
                    </div>


                </div>

                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Search All Student Attendance Information
                            </button>

                        </div>
                    </div>
                </div>
            </form>


        </div><!-- /.col-x12 -->
    </div>
</div>

</div><!-- PAGE CONTENT ENDS -->
</div>







