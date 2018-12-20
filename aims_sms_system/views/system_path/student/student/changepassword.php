<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">

            <!-- /Content Section  -->                    
            <div class="page-header">
                <h1>
                    Update Password
                   
                </h1>
            </div><!-- /.page-header -->


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

            <div class="col-xs-12 col-sm-12">
                <div class="space-12"></div>
                <form action="<?php echo student_Url();?>/student/updatepassword" method="post">
                    <div class="form-group has-error col-xs-4 col-sm-4">
                        <label class="control-label" for="form-field-1">Current Password &nbsp; <?php echo form_error('data[currentpassword]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="password" name="currentpassword" placeholder="Current Password" class="form-control" id="form-field-1" />
                      
                    </div>
                    <div class="form-group has-error col-xs-4 col-sm-4">
                        <label class="control-label" for="form-field-1">New Password &nbsp; <?php echo form_error('data[newpassword]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="password" name="newpassword" placeholder="New Password" class="form-control" id="form-field-1" />
                    </div>    
                    <div class="form-group has-error col-xs-4 col-sm-4">
                        <label class="control-label" for="form-field-1">Retype Password &nbsp; <?php echo form_error('data[retypepassword]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="password" name="retypepassword" placeholder="Retype Password" class="form-control" id="form-field-1" />
                    </div>
                    <div class="col-xs-12">
                      <div class="clearfix form-actions">
                          <div class="col-md-12">
                              <button class="btn btn-success" name="btnSubmit" type="submit">
                                  <i class="ace-icon fa fa-check bigger-110"></i> Update Passowrd
                              </button>

                          </div>
                      </div>
                  </div>        
              </form>
            </div>        

                            

           
      </div>
  </div>
</div>  



