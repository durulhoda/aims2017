<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
        SMS
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Select Receiver Type
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
            <form  action="<?php echo admin_Url(); ?>/sendsms/receivertype" method="post" class="form-horizontal" role="form">

                <div align="center">
                    <h3 class="header smaller lighter purple">
                        Select Receiver Type
                    </h3>

                    <p>
                        <input type="submit" class="btn btn-primary" name="receivertype" type="submit" value="Employee">
                        <input type="submit" class="btn btn-primary" name="receivertype" type="submit" value="Student">

                    </p>
                </div>
            </form>


        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 










