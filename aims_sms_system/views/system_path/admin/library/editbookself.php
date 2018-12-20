<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Book Self Information
            
             <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Book Self Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/libraryinfo/updatebookself/<?php echo $editData['selfId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label " for="form-field-1"> Add Book Self Information &nbsp; <?php echo form_error('data[selfName]', '<span class="successMessage">', '</span>'); ?> </label>


                        <input type="text" name="data[selfName]" value="<?php if(!empty($editData['selfName'])){ echo $editData['selfName']; } ?>"  id="form-field-1" placeholder="Enter Book Name" class="col-xs-8 col-sm-5" />

                    </div>
                  
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Book Name
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            