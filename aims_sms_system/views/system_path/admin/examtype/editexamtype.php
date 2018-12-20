<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Edit Exam type  Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Update Exam type 
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/examtype/updateexamtype/<?php echo $editData['examtypeId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Exam type &nbsp; <?php echo form_error('data[examtypeName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[examtypeName]" required="1" value="<?php if(!empty($editData['examtypeName'])){ echo $editData['examtypeName']; } ?>" class="form-control" id="form-field-1" placeholder="Exam type" />
                                
                    </div>
                </div>                    
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Exam type Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        