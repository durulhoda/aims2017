<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                  
<div class="page-header">
    <h1> 
      Book's Lost Information
      <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Book Lost Information
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

          
           			<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                                                <form  action="<?php echo acc_Url(); ?>/booklost/updatebooklost/<?php echo $editData['lostId'] ?>" method="post" class="form-horizontal" role="form">
                                                                
									<div class="form-group">
                                                                            <label class="col-sm-3 control-label" for="form-field-1"> Book Name : &nbsp; </label>
                                                                            <select name="data[bookId]">
                                        <option value="" >Select</option>
                                        <?php foreach (getBookArray() as $value) { ?>
                                            <option value="<?php echo $value['bookId'] ?>"
                                                    <?php echo ($editData["bookId"] == $value['bookId']) ? "selected" : "" ?> >                                                
                                                <?php echo $value['bookName'] ?></option>
                                        <?php } ?>
                                    </select> 
									</div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="form-field-1"> Book Writer : &nbsp; </label>

                                                                        <input type="text" name="data[bookauthor]" value="<?php echo $editData['bookauthor']; ?>" id="form-field-1" placeholder="Writer Name" class="col-xs-8 col-sm-5" />

                                                                    </div> 
                                                             
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="form-field-1"> Missing Cause : &nbsp; </label>

                                                                        <input type="text" name="data[lostCause]" value="<?php echo $editData['lostCause']; ?>" id="form-field-1" class="col-xs-8 col-sm-5" />

                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="form-field-1"> Missed By : &nbsp; </label>
                                                                        <input type="text" id="Name" placeholder="Enter Student or Employee Id who missed book" class="Name" value="<?php echo $editData['lostBy']; ?>" name="data[lostBy]" /> if book missed by Employee or Student <br />

                                                                    </div>
                                                               
         
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" name="submit" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Update Book Lost Information
											</button>

											
										</div>
									</div>
                                                        </form>
                                              
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    

    
    
    
    
    



