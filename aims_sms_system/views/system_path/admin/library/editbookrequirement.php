<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Book Requirement Information
            
             <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Book Requirement Information
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
            <form  action="<?php echo admin_Url(); ?>/bookrequirement/updatebookrequirement/<?php echo $editData['requirementId'] ?>" method="post" class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Name : &nbsp; </label>
                   <input type="text" required="1" id="Name" class="Name" name="data[bookName]" value="<?php echo $editData['bookName']; ?>" /> <br />
                               					
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Writer : &nbsp; </label>

                    <input type="text" required="1" id="Name" class="Name" name="data[bookauthor]" value="<?php echo $editData['bookauthor']; ?>" /> <br />
                               
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1">Book Piece : &nbsp; </label>
                    <input type="text" required="1" id="Name" class="Name" name="data[bookPiece]" value="<?php echo $editData['bookPiece']; ?>" /> <br />
                               
                </div>


      
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Status : &nbsp; </label>
                     <input type="radio" <?php  echo ($editData["requirementStatus"] == '1') ? "checked" : ""; ?> value="1" name="data[requirementStatus]" /> Requirement Pending
                     <input type="radio" <?php echo ($editData["requirementStatus"] == '0') ? "checked" : ""; ?> value="0" name="data[requirementStatus]" /> Requirement Fulfilled
                  
                </div>


                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Update
                        </button>


                    </div>
                </div>
            </form>
            
     
            
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            