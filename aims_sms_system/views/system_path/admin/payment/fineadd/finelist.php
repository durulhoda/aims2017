 <!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
Payment
<small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Student Fine
            </small>
  </h1>
</div>  
 <!-- /.page-header -->

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
                                                                <form  action="<?php echo admin_Url(); ?>/payments/searchfine" method="post" class="form-horizontal" role="form">
                                                                
									<div class="form-group">
                                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student ID: &nbsp; </label>
                                                                             <input type="text" required="1" id="Name" class="Name" name="data[studentId]" /> <br />
                               						
									</div>
            
                                                                               
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" name="submit" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Search
											</button>

											
										</div>
									</div>
                                                        </form>
                                              
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    

          
           	<div class="row">
                    
			<div class="col-xs-12">
							
                             <?php
            if (!empty($finelist)) {
                ?>
                <div class="row">
                    <div class="col-xs-11">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th>Sl No.</th>
                                    <th>Student Id</th>
                                    <th>Date</th>
                                    <th>Fine Cause</th>
                                    <th>Amount</th>
                                    
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($finelist as $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php echo $value['studentId']?></td>
                                        <td><?php echo $value['date']?></td>
                                        <td><?php echo $value['finehead']?></td>
                                        <td><?php echo $value['amount'];?></td>
                                        
                                    </tr>
        <?php
    }
    ?>

                            </tbody>
                        </table>
                    </div><!-- /.span -->
                </div><!-- /.row -->
    <?php
}
?>
                                              
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    

    
    
    
    
    
