 
<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
Book's Lost Information
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
                                                                <form  action="<?php echo admin_Url(); ?>/booklost/insertbooklost" method="post" class="form-horizontal" role="form">
                                                                
									<div class="form-group">
                                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Name : &nbsp; </label>
                                                                            <select class="col-sm-3" required name="data[bookId]">
                                                                                <option value="" >Select</option>
                                                                                <?php foreach (getBookArray() as $value) { ?>
                                                                                    <option value="<?php echo $value['bookId'] ?>">
                                                                                        <?php echo $value['bookName'] ?></option>
                                                                                <?php } ?>
                                                                            </select> 
                               						
									</div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Writer : &nbsp; </label>
                                                                        <input type="text" required="1" id="Name" class="col-sm-3" name="data[bookauthor]" /> <br />

                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Missing Cause : &nbsp; </label>

                                                                        <textarea type="text" placeholder="Write the cause of lost book" required="1" id="Name"  class="col-sm-3" name="data[lostCause]" > </textarea> <br />

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Missed By : &nbsp; </label>

                                                                        <input type="text" id="Name" placeholder="Enter Student or Employee Id who missed book" class="col-sm-3" name="data[lostBy]" /> if book missed by Employee or Student <br />

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
    

    
    
    
    
    
