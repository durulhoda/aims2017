<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
          Mark Distribution
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Edit Mark Category 
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
                                <form  action="<?php echo admin_Url(); ?>/courseoffer/updatemarkcatagory/<?php echo $editData['mark_cat_id'];?>" method="post" class="form-horizontal" role="form">
                                                                
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Add Category &nbsp; </label>
                                        <input type="text" name="data[category_title]" value="<?php echo $editData['category_title'];?>"  id="form-field-1" placeholder="Enter Category" class="col-xs-8 col-sm-5" />
                                        
                                    </div>
                                    
                                    <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-info" name="submit" type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Update
                                            </button>

                                            
                                        </div>
                                    </div>
                            </form>
            
                        </div><!-- /.col-x12 -->  
           		
		                
    </div> <!-- /.row --> 
    

    
    
    
    
    
