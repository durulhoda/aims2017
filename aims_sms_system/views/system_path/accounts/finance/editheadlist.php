<div class="page-content">
    <!-- /Content Section  -->  
    <div style="margin-top: 20px; padding: 3.5px;">                    
<div class="page-header">
    <h1>
        Finance
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Edit Finance Head Category 
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
        <form  action="<?php echo acc_Url(); ?>/financehead/updatefinancehead/<?php echo $editData['id'];?>" method="post" class="form-horizontal" role="form">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Add Category &nbsp; </label>


                <input type="text" name="data[headcategory]" value="<?php echo $editData['headcategory'];?>" id="form-field-1" placeholder="Enter Category" class="col-xs-8 col-sm-3" />

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
        
     
            </div><!-- /.row -->

    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 







