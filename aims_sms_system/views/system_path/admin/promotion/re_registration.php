 
<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Student Re-Registration 

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
            <form  action="<?php echo admin_Url(); ?>/promotestudent/studentReregistration" method="post" class="form-horizontal" role="form">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">  
                        <!-- PAGE CONTENT BEGINS -->
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Student ID  &nbsp; <?php echo form_error('studentid', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" id="form-field-1" name="studentid" placeholder="Student ID" class="large" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="submit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Search Student Information
                            </button>

                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>








