<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Hostel
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Edit Hostel Name 
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
            <form  action="<?php echo admin_Url(); ?>/hostel/updatehostelName/<?php echo $editData['hostelId'];?>" method="post" class="form-horizontal" role="form">

       
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hostel Category : &nbsp; <?php echo form_error('data[categoryId]'); ?></label>

                    <select name="data[categoryId]" class="col-xs-9 col-sm-3" class="form-control">
                         <option value="">Select</option>
                                       
                                                <?php foreach (getHostelcategoryList() as $value) { ?>
                                                    <option value="<?php echo $value['categoryId']; ?>" 
                                                            <?php echo ($editData["categoryId"] == $value['categoryId']) ? "selected" : "" ?> >
                                                        <?php echo $value['categoryName']; ?></option>                                                
                                                <?php } ?>
                    </select>  

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Hostel Name : &nbsp; </label>


                    <input type="text" name="data[hostelName]"  value="<?php echo $editData['hostelName']; ?>" id="form-field-1" placeholder="Enter Hostel" class="col-xs-8 col-sm-3" />

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








    

    
    
    
    
    
