<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
      
Borrowed Book's Information
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
                                                                <form  action="<?php echo acc_Url(); ?>/bookborrow/insertborrowedbook" method="post" class="form-horizontal" role="form">
                                                                
									<div class="form-group">
                                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Name : &nbsp; </label>
                                                                            <select name="data[bookId]" class="col-xs-9 col-sm-3" class="form-control">
                                                                                <option value="" >Select</option>
                                                                                <?php foreach (getBookArray() as $value) { ?>
                                                                                    <option value="<?php echo $value['bookId'] ?>">
                                                                                        <?php echo $value['bookName'] ?></option>
                                                                                <?php } ?>
                                                                            </select> 						
									</div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student Id : &nbsp; </label>

                                                                        <input type="text" name="data[studentId]"  id="form-field-1" placeholder="Student Id" class="col-xs-8 col-sm-5" />

                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Issue Date : &nbsp; </label>

                                                                        <input type="text" name="data[borrowedDate]"  id="form-field-1" placeholder="Date(dd/mm/Year)" class="col-xs-8 col-sm-5" />

                                                                    </div>

                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Return Date : &nbsp; </label>

                                                                        <input type="text" name="data[returnDate]"  id="form-field-1" placeholder="Date(dd/mm/Year)" class="col-xs-8 col-sm-5" />

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
    

    
    
    
    
    
