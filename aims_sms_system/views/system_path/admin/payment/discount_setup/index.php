<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
        Discount Setup
        
          <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Discount
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
            <form  action="<?php echo admin_Url(); ?>/discount_setup/insert_discount" method="post" class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Discount Name : &nbsp; </label>

                    <input type="text" name="data[name]"  id="form-field-1" placeholder="Discount Name" class="col-xs-8 col-sm-5" />
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Discount Type : &nbsp; </label>

                    <select class="col-sm-3" name="data[type]">
                        <option value="1">Percent</option>
                        <option value="2">Amount</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Amount : &nbsp; </label>

                    <input type="text" name="data[amount]"  id="form-field-1" placeholder="amount" class="col-xs-8 col-sm-5" />
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
            if (!empty($records)) 
           {
                ?>
                <div class="row">
                    <div class="col-xs-11">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th>#</th>                                   
                                    <th>Discount Name</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($records as $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td> <?php echo $value['name']; ?></td>
                                        <td>
                                        <?php echo ($value['type'] == 1 ) ? 'Percent' : 'Amount'; ?>
                                        </td>
                                        <td>
                                        <?php echo $value['amount']; ?>
                                        </td>



                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo admin_Url(); ?>/discount_setup/edit/<?php echo $value['id']; ?>"  class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url(); ?>/discount_setup/delete/<?php echo $value['id']; ?>" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </a>


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







