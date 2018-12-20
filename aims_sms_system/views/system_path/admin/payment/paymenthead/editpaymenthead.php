<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Payment
            
              <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Payment Head
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/paymenthead/updatepaymenthead/<?php echo $editData['headId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payment Head Category : &nbsp; </label>

                         <select class="col-xs-6 col-sm-2" name="data[headCategory]">
                                        <option value="" selected="selected">Select</option>
                                            <option value="1" 
                                                    <?php echo ($editData['headCategory'] == 1)? "selected" : "";  ?> >
                                                Regular</option>                                                
                                            <option value="2" 
                                                    <?php echo ($editData['headCategory'] == 2)? "selected" : "";  ?> >
                                                Fine/Penalty</option>  
                                    </select> 

                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payment Head Name : &nbsp; </label>


                        <input type="text" id="textfield" class="col-xs-8 col-sm-5" name="data[headName]" value="<?php echo $editData['headName']; ?>"/>
                    </div>
                    
                  
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button  class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Category
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            