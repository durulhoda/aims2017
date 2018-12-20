 
<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
Book's Requirement Information
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
                                                                <form  action="<?php echo admin_Url(); ?>/bookrequirement/insertbookrequirement" method="post" class="form-horizontal" role="form">
                                                                
									<div class="form-group">
                                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Name : &nbsp; </label>
                                                                             <input type="text" required="1" id="Name" class="Name" name="data[bookName]" /> <br />
                               						
									</div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Writer : &nbsp; </label>
                                                                        <input type="text" required="1" id="Name" class="Name" name="data[bookauthor]" /> <br />

                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Piece : &nbsp; </label>

                                                                        <input type="text" required="1" id="Name" class="Name" name="data[bookPiece]" /> <br />

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
                                              
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    

    
    
    
    
    
