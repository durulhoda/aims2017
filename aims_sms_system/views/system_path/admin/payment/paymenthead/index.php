<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
        Payment
        
          <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Payment
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
            <form  action="<?php echo admin_Url(); ?>/paymenthead/insertpaymenthead" method="post" class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payment Head Name : &nbsp; </label>


                    <input type="text" name="data[headName]"  id="form-field-1" placeholder="Payment Head Name" class="col-xs-8 col-sm-5" />

                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payment Head Category :  &nbsp; <?php echo form_error('data[selfId]'); ?></label>

                    
                    <select name="data[headCategory]" class="col-xs-6 col-sm-2" class="form-control" id="form-field-select-2">
                        
                                        <option value="">Select</option>
                                       <option value="1" <?php echo set_select('data[headCategory]', 1, FALSE) ?>>
                                            Regular
                                        </option>
                                         
                                       
                                    </select>   


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

            <?php
            if (!empty($paymentheadlist)) 
           {
                ?>
                <div class="row">
                    <div class="col-xs-11">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th>Sl No.</th>                                   
                                    <th>Payment head Name</th>
                                    <th>Payment head Category</th>


                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($paymentheadlist as $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td> <?php echo $value['headName']; ?></td>
                                        <td>
                                        <?php echo ($value['headCategory'] == 1 ) ? 'Regular' : '' ?>
                                        </td>



                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo admin_Url(); ?>/paymenthead/editdpaymenthead/<?php echo $value['headId']; ?>"  class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url(); ?>/paymenthead/deletepaymenthead/<?php echo $value['headId']; ?>" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </a>


                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                                        <li>
                                                            <a href="<?php echo admin_Url(); ?>/paymenthead/editdpaymenthead/<?php echo $value['headId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url(); ?>/paymenthead/deletepaymenthead/<?php echo $value['headId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
        <?php
    }
    ?>

                            </tbody>
                        </table>
                    </div><!-- /.span -->
                </div><!-- /.row -->
    <?php
}
?>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 







