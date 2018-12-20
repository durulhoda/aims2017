<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Book Bookborrow Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Book Bookborrow Information
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
            <form  action="<?php echo admin_Url(); ?>/bookborrow/updateborrowedbook/<?php echo $editData['borrowbookId'] ?>" method="post" class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Name : &nbsp; </label>
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student Id : &nbsp; </label>

                    <input type="text" name="data[studentId]" value="<?php echo $editData['studentId']; ?>"  id="form-field-1" placeholder="Student Id" class="col-xs-8 col-sm-5" />

                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Return Date : &nbsp; </label>

                    <input type="text" name="data[borrowedDate]" value="<?php echo $editData['borrowedDate']; ?>"  id="form-field-1" placeholder="Date(dd/mm/Year)" class="col-xs-8 col-sm-5" />

                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Return Date : &nbsp; </label>

                    <input type="text" name="data[returnDate]" value="<?php echo $editData['returnDate']; ?>" id="form-field-1" placeholder="Date(dd/mm/Year)" class="col-xs-8 col-sm-5" />

                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Return Date : &nbsp; </label>
                    <input type="radio" <?php echo ($editData["bookPiece"] == '1') ? "checked" : ""; ?> value="1" name="data[bookPiece]" /> Not Return
                    <input type="radio" <?php echo ($editData["bookPiece"] == '0') ? "checked" : ""; ?> value="0" name="data[bookPiece]" /> Return

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
    
            