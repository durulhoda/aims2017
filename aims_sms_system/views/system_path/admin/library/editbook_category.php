<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Book Category Information
            
              <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Book Category Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/bookcategory/updatebookcategory/<?php echo $editData['bookcategoryId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Category Name : &nbsp; </label>


                        <input type="text" name="data[bookCategoryName]" value="<?php if(!empty($editData['bookCategoryName'])){ echo $editData['bookCategoryName']; } ?>"  id="form-field-1" placeholder="Book Category" class="col-xs-8 col-sm-5" />

                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Self Name : &nbsp; </label>

                        <?php echo form_error('data[selfId]', '<div style="color: rgb(255, 0, 0);" class="successMessage">', '</div>'); ?>
                        <select name="data[selfId]">
                            <option value="" selected>Select</option>
                            <?php foreach (getSelfInfoArray() as $value) { ?>
                                <option <?php echo ($editData['selfId'] == $value['selfId'] ? "selected" : "") ?> value="<?php echo $value['selfId'] ?>">
                                    <?php echo $value['selfName'] ?></option>
                            <?php } ?>
                        </select>  


                    </div>

                  
                </div> 
                   
               
                <div class="col-xs-12">
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
    
            