<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Transport
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Edit Transport Repair Information
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
            <form  action="<?php echo admin_Url(); ?>/transportfuel/updateTransportRepair/<?php echo $editData['transportrepairId'];?>" method="post" class="form-horizontal" role="form">

                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transport Name :&nbsp; <?php echo form_error('data[transportId]'); ?></label>

                    <select name="data[transportId]" class="col-xs-9 col-sm-3" class="form-control">
                            <option value="" selected="selected">Select</option>
                                                <?php foreach (getTransportNameList() as $value) { ?>
                                                    <option value="<?php echo $value['transportId']; ?>" 
                                                            <?php echo ($editData["transportId"] == $value['transportId']) ? "selected" : "" ?> >
                                                        <?php echo $value['transportName']; ?></option>                                                
                                                <?php } ?>
                    </select>  

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Transport Repair Cost : &nbsp; </label>


                    <input type="text" name="data[repairCost]" value="<?php echo $editData['repairCost']; ?>"  id="form-field-1" placeholder="Enter Transport Fees" class="col-xs-8 col-sm-3" />

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of Repair : &nbsp; </label>



                    <input class="col-xs-8 col-sm-3 date-picker" id="id-date-picker-1" name="data[date]" value="<?php echo $editData['date']; ?>" placeholder="Select Date" type="text" data-date-format="dd-mm-yyyy" />
                                                                   

                </div>
           
                
              
 
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                          Update Information
                        </button>


                    </div>
                </div>
            </form>
      
          </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 








    

    
    
    
    
    
