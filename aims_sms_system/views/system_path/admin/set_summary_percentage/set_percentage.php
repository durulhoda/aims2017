<!-- /Content Section  -->
<div class="page-header">
    <h1>
        Percentage Distribution
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
        <form  action="<?php echo admin_Url(); ?>/setsummarypercentage/insert_percentage" method="post" class="form-horizontal" role="form">
            <input type="hidden" name="programOfferId" value="<?php echo $programOfferId['programOfferId'];?>"/>


            <?php
            foreach($exam_list as $item)
                {
            ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $item['semester'];?> &nbsp;&nbsp; </label>
                    <input type="text" name="semester[<?php echo $item['semester_id'];?>]" required="" placeholder="Enter Percentage" class="integer_type_positive col-xs-8 col-sm-3" />
                </div>
            <?php
                }
            ?>


            <div class="clearfix form-actions">
                <div class="form-group col-xs-4"></div>
                <div class="form-group col-xs-8">
                    <button class="btn btn-info" name="submit" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
            </div>

        </form>

    </div><!-- /.col-x12 -->
</div> <!-- /.row -->



<script type="text/javascript">

    $(document).ready(function () {

        $(document).on("input", ".float_type_positive", function(event)
        {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        });
        $(document).on("input", ".integer_type_positive", function(event)
        {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $(document).on("input", ".float_type_all", function(event)
        {
            this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*)\./g, '$1').replace(/(?!^)-/g, '');
        });
        $(document).on("input", ".integer_type_all", function(event)
        {
            this.value = this.value.replace(/[^0-9-]/g, '').replace(/(?!^)-/g, '');
        });
    });
</script>



