<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Discount Setup
            
              <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Discount
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
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/discount_setup/update/<?php echo $editData['id']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Discount Name : &nbsp; </label>

                    <input type="text" value="<?php echo $editData['name']; ?>" name="data[name]"  id="form-field-1" placeholder="Discount Name" class="col-xs-8 col-sm-5" />
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Discount Type : &nbsp; </label>

                    <select class="col-sm-3" name="data[type]">
                        <option value="1" <?php echo ($editData['type'] == 1) ? "selected" : ""; ?>>Percent</option>
                        <option value="2" <?php echo ($editData['type'] == 2) ? "selected" : ""; ?>>Amount</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Amount : &nbsp; </label>

                    <input type="text" name="data[amount]" value="<?php echo $editData['amount']; ?>"  id="form-field-1" placeholder="amount" class="col-xs-8 col-sm-5" />
                </div>
                    
                  
                </div> 
                   
               
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Category
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            