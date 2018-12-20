<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                   
    <div class="page-header">
        <h1>
            Inventory
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Edit Inventory Information
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
            <form  action="<?php echo acc_Url(); ?>/inventory/updateinventory/<?php echo $editData['inventoryId'];?>" method="post" class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Item Category : &nbsp; <?php echo form_error('data[selfId]'); ?></label>

                           
                       <?php echo form_error('data[categoryId]', '<div class="successMessage">', '</div>'); ?>
                                            <select required="1" name="data[categoryId]" class="col-xs-9 col-sm-3" class="form-control">
                                                <option value="" selected="selected">Select</option>
                                                <?php foreach (getinventorycategoryList() as $value) { ?>
                                                    <option value="<?php echo $value['categoryId']; ?>" 
                                                            <?php echo ($editData["categoryId"] == $value['categoryId']) ? "selected" : "" ?> >
                                                        <?php echo $value['categoryName']; ?></option>                                                
                                                <?php } ?>
                                            </select>

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Item Name : &nbsp; </label>
                    
                    <input required="1" type="text" name="data[inventoryName]" id="form-field-1" placeholder="Enter Item Price" class="col-xs-9 col-sm-3" value="<?php echo $editData['inventoryName']; ?>"></td>

                </div>
                
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Item Price : &nbsp; </label>


                    <input required="1" type="text" name="data[price]" value="<?php echo $editData['price']; ?>" id="form-field-1" placeholder="Enter Item Price" class="col-xs-9 col-sm-3" />

                </div>
                
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Piece of Item : &nbsp; </label>


                    <input type="text" name="data[itemPiece]" value="<?php echo $editData['itemPiece']; ?>"  id="form-field-1" placeholder="Enter Price of Item" class="col-xs-9 col-sm-3" />

                </div>
                
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Item Purchaser Id : &nbsp; </label>


                    <input type="text" name="data[boughtBy]" value="<?php echo $editData['boughtBy']; ?>" id="form-field-1" placeholder="Enter Item Purchaser Id " class="col-xs-9 col-sm-3" />

                </div>
 
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="save" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>


                    </div>
         
            </form>

          

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 







