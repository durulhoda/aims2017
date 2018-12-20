<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Inventory
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Add Category
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
                                                               
                                                                <form  action="<?php echo teacher_Url(); ?>/teacher/updatepassword" method="post" class="form-horizontal" role="form">
                                                           <div class="col-xs-10 col-sm-2"></div>
									<div class="form-group">
                                                                            <label class="control-label" for="form-field-1"> Current Password : &nbsp; </label>

										<input required="1" type="password" placeholder="Current Password ..." name="currentpassword" class="validate[required]"  /> </label>
          
									</div>
                                                                 <div class="col-xs-10 col-sm-2"></div>
                                                                	<div class="form-group">
                                                                            <label class="control-label" for="form-field-1"> New Password : &nbsp; </label>

										 <input required="1" type="password" placeholder=" New Password ..." name="newpassword" class="validate[required]"  /> </label>
          
									</div>
                                                                 <div class="col-xs-10 col-sm-2"></div>
                                                               <div class="form-group">
                                                                            <label class="control-label" for="form-field-1"> Retype Password : &nbsp; </label>
                                                                <input required="1" type="password" placeholder="Retype Password ..." name="retypepassword" class="validate[required]"  /> </label>
          
									</div>
                                                                    
                                                           
                                                                    <div class="col-xs-12">
									<div class="clearfix form-actions">
										<div class="col-md-12">
											<button class="btn btn-info" name="submit" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Change Password
											</button>

											
										</div>
									</div>
                                                                        </div>
                                                        </form>
                                                  
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    </div>
    </div>
    </div>
    

    
    
    
    
    





