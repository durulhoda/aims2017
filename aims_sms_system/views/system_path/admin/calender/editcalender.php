<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Academic Calender
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Edit Academic Calender
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
        <form  action="<?php echo admin_Url(); ?>/academiccalender/updateevent/<?php echo $editData['calendarId']?>" method="post" class="form-horizontal" role="form">

            <div class="form-group">

                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Event Start Date :  &nbsp; </label>

                <div class="input-group col-sm-3">
                    <input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" placeholder="Select Start Date" value="<?php echo $editData['startdate']?>" name="data[startdate]">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>

            </div>

            <div class="form-group">

                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Event End Date :  &nbsp; </label>

                <div class="input-group col-sm-3">
                    <input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" placeholder="Select End Date" value="<?php echo $editData['enddate']?>" name="data[enddate]">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>

            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Even Title : &nbsp; </label>


                <input type="text" name="data[title]" value="<?php echo $editData['title']?>"  id="form-field-1" placeholder="Enter Title" class="col-xs-8 col-sm-3" />

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Even Description : &nbsp; </label>

                <textarea id="form-field-8" class="form-control" name="data[description]"  placeholder="Write Description" style="width: 446px; height: 98px;"><?php echo $editData['description']?></textarea>

            </div>






            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-info" name="submit" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>


                </div>
            </div>
        </form>
    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 















