<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                   
<div class="page-header">
    <h1> 
        Book's Information
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
            <form  action="<?php echo acc_Url(); ?>/book/insertbook" method="post" class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Name : &nbsp; </label>

                    <input type="text" name="data[bookName]"  id="form-field-1" placeholder="Book Name" class="col-xs-8 col-sm-5" />

                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Writer : &nbsp; </label>

                    <input type="text" name="data[bookauthor]"  id="form-field-1" placeholder="Writer Name" class="col-xs-8 col-sm-5" />

                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Category : &nbsp; </label>
                    <?php echo form_error('data[bookCategory]', '<div style="color: rgb(255, 0, 0);" class="successMessage">', '</div>'); ?>
                    <select class="col-sm-3" name="data[bookCategory]">
                        <option value="" selected>Select</option>
                        <?php foreach (getBookCategoryArray() as $value) { ?>
                            <option value="<?php echo $value['bookCategoryName'] ?>"><?php echo $value['bookCategoryName'] ?></option>
                        <?php } ?>
                    </select> 

                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Buying Date : &nbsp; </label>

                    <input type="text" name="data[bookbuydate]"  id="form-field-1" placeholder="Buying Date" class="col-xs-8 col-sm-5" />

                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Book Price : &nbsp; </label>

                    <input type="text" name="data[bookprice]"  id="form-field-1" placeholder="Book Price" class="col-xs-8 col-sm-5" />

                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1"> Total Book Piece : &nbsp; </label>

                    <input type="text" name="data[bookPiece]"  id="form-field-1" placeholder="Book Piece" class="col-xs-8 col-sm-5" />

                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-field-1">Book Status : &nbsp; </label>

                    <?php echo form_error('data[bookavailable]', '<div style="color: rgb(255, 0, 0);" class="successMessage">', '</div>'); ?>
                    <input type="radio" id="Name" class="Name" value='1' name="data[bookavailable]" /> Available <br />
                    <input type="radio" id="Name" class="Name" value='0' name="data[bookavailable]" /> Unavailable<br />

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







