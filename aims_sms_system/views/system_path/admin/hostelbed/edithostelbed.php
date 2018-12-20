<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Hostel
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Edit Hostel Bed Information
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
            <form  action="<?php echo admin_Url(); ?>/hostelbed/updatehostelBed/<?php echo $editData['bedId'];?>" method="post" class="form-horizontal" role="form">

       
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hostel Category : &nbsp; <?php echo form_error('data[categoryId]'); ?></label>

                    <select name="data[hostelId]" class="col-xs-9 col-sm-3" class="form-control">
                       <option value="">Select</option>
                                       <option value="" selected="selected">Select</option>
                                                <?php foreach (getHostelNameList() as $value) { ?>
                                                    <option value="<?php echo $value['hostelId']; ?>" 
                                                            <?php echo ($editData["hostelId"] == $value['hostelId']) ? "selected" : "" ?> >
                                                        <?php echo $value['hostelName']; ?></option>                                                
                                                <?php } ?>
                    </select>  

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hostel Name :&nbsp; <?php echo form_error('data[transportId]'); ?></label>

                    <select name="data[hostelRoom]" class="col-xs-9 col-sm-3" class="form-control">
                              <option value="">Select</option>
                                        <?php foreach (getHostelRoomList() as $values) { ?>
                                            <option value="<?php echo $values['hostelRoom']; ?>" 
                                                      <?php echo ($editData["hostelRoom"] == $values['hostelRoom']) ? "selected" : "" ?> >
                                                        <?php echo $values['hostelRoom']; ?>
                                            </option>
                                        <?php } ?>
                    </select>  

                </div>
        
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bed Number : &nbsp; </label>

                    <input type="text" name="data[bedNo]" value="<?php echo $editData['bedNo']; ?>""></td>

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








    

    
    
    
    
    
