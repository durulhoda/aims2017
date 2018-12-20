<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            All Quata Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Update Quata
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/quata/updatequata/<?php echo $editData['quata_id']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->                   
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Quata &nbsp; <?php echo form_error('data[quata]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[quata]" required="1" value="<?php if(!empty($editData['quata'])){ echo $editData['quata']; } ?>" class="form-control" id="form-field-1" placeholder="Quata" />
                    </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Quata
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        