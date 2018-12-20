<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Edit   Institute Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            must be fill up all red box field
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
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
        <form action="<?php echo admin_Url(); ?>/institute/update_information" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">                                      

                    <div class="col-xs-12 col-sm-12">  
                        <input name="data[instituteId]" value="<?php echo $data_info['instituteId']; ?>" type="hidden" />




                        <div class="col-xs-12 col-sm-6">    

                            <div class="form-group col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Current Class Level &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>

                                <br>   

                                <!--                                                    <div class="form-group has-error col-xs-12 col-sm-12">
                                                                                     <div class="row">
                                                            <div class="col-sm-12">
                                                                <span class="bigger-110">Edit Class Level &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></span>
                                                           <select name="data[programLevel][]" multiple="" required="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose Class Level..." >
                                                               
                                                                <option  value=""></option> 
                                <?php
                                $data_info = getclasslevelfrominstitute();

                                echo $getData = explode(",", trim($data_info["programLevel"], ","));
                                foreach ($data_info as $value) {
                                    ?>
                                                                   <option>
                                    <?php
                                    echo element($value, getProgramLevel_institute(), null);
                                    ?>
                                                                  
                                                                                                                </option>
                                                               
                                <?php }
                                ?>     
                                                            </select>
                                                    </div>
                                                        </div>
                                                   
                                                    </div>   
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                        <div class="form-group has-error col-xs-12 col-sm-12">
                                                                                     <div class="row">
                                                            <div class="col-sm-12">
                                                                <span class="bigger-110">Edit Class Level &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></span>
                                                           
                                                                <select name="data[programLevel][]" multiple="" required="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose Class Level..." >
                                                                 <option  value=""></option> 
                                                                
                                <?php
                                foreach (getProgramLevel_institute() as $key => $value) {
                                    ?>
                                                                        <option value="<?php echo $key; ?>" 
                                    <?php echo set_select("data[programLevel][]", $key, FALSE); ?> >
                                    <?php echo $value; ?>
                                                                        </option> 
                                                                    
                                    <?php
                                }
                                ?>
                                                                    
                                                                    
                                                            </select>
                                                    </div>
                                                        </div>
                                                   
                                                    </div>   -->


                                <?php
                                $data_info = getclasslevelfrominstitute();
                                $getData = explode(",", trim($data_info["programLevel"], ","));

                                //  echo "<pre>"; print_r($getData);
                                foreach ($getData as $value) {
                                    ?>

                                    <span class="label label-warning arrowed arrowed-right bold">
                                        <?php
                                        echo element($value, getProgramLevel_institute(), null);
                                        ?>

                                    </span>


                                    <?php
                                }
                                ?>
        
                            </div>

                            <div class="form-group has-error col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Class Level Type &nbsp; <?php echo form_error('data[instituteName]', '<span class="successMessage">', '</span>'); ?></label>
                                <br>  
                                <?php
                                foreach (getProgramLevel_institute() as $key => $value) {
                                    ?><input type="checkbox" name="data[programLevel][]" value="<?php echo $key ?>" <?php if(in_array($key,$getData))  echo 'checked="checked"'; ?>>
                                    <?php echo $value; ?>     


                        <?php } ?>

                                    
                                    
                                
                                    
                            </div>




                            <div class="form-group has-error col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Institute Name &nbsp; <?php echo form_error('data[instituteName]', '<span class="successMessage">', '</span>'); ?></label>
                                <input required="1" class="form-control" placeholder="Institute Name" name="data[instituteName]" value="<?php if (!empty($data_info['instituteName'])) {
    echo $data_info['instituteName'];
} ?>" type="text" id="form-field-2" />
                            </div>

                            <div class="form-group has-error  col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Institute EIN &nbsp; <?php echo form_error('data[Ein]', '<span class="successMessage">', '</span>'); ?></label>
                                <input required="1" class="form-control" placeholder="Institute EIN" name="data[Ein]" value="<?php if (!empty($data_info['Ein'])) {
    echo $data_info['Ein'];
} ?>" type="text" id="form-field-2" />
                            </div>
                            <div class="form-group  col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Town/Village &nbsp; <?php echo form_error('data[town]', '<span class="successMessage">', '</span>'); ?></label>
                                <input class="form-control" placeholder="Town/Village" name="data[town]" value="<?php if (!empty($data_info['town'])) {
    echo $data_info['town'];
} ?>" type="text" id="form-field-1" />
                            </div>

                            <div class="form-group  col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">District &nbsp; <?php echo form_error('data[district]', '<span class="successMessage">', '</span>'); ?></label>

                                <select id="getdistrictid" onchange="return getdistrict();" data-placeholder="Select" name="data[district]"  required="1" class="form-control">
                                    <option value="">Select</option> 
                                        <?php
                                        foreach (getDistrictName() as $key => $value) {
                                            ?>
                                        <option value="<?php echo $key; ?>"  <?php echo ($data_info["district"] == $key) ? "selected" : "" ?> > 
                                        <?php echo $value; ?>
                                        </option> 

    <?php
}
?>

                                </select>

                            </div>


                        </div> <!-- /.col-sub-4 -->  
                        <div class="col-xs-12 col-sm-6">    
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="form-group col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Institute Type &nbsp; <?php echo form_error('data[personName]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[instituteType]" class="form-control" >
                                    <option value=""></option> 


                                        <?php
                                        foreach (getinstituteType() as $key => $value) {
                                            ?>
                                        <option value="<?php echo $key; ?>" <?php echo ($data_info["instituteType"] == $key) ? "selected" : "" ?> > 
                                        <?php echo $value; ?>
                                        </option> 

    <?php
}
?>
                                </select> 
                            </div>

                            <div class="form-group col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Contact Person &nbsp; <?php echo form_error('data[personName]', '<span class="successMessage">', '</span>'); ?></label>
                                <input class="form-control" placeholder="Contact Person" name="data[personName]" value="<?php if (!empty($data_info['personName'])) {
    echo $data_info['personName'];
} ?>" type="text" id="form-field-2" />
                            </div>	
                            <div class="form-group col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Phone Number &nbsp; <?php echo form_error('data[personPhone]', '<span class="successMessage">', '</span>'); ?></label>
                                <input class="form-control" placeholder="Phone Number" name="data[personPhone]" value="<?php if (!empty($data_info['personPhone'])) {
    echo $data_info['personPhone'];
} ?>" type="text" id="form-field-2" />
                            </div>	

                            <div class="form-group col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Email &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                                <input class="form-control" placeholder="Email" name="data[email]" value="<?php if (!empty($data_info['email'])) {
                                        echo $data_info['email'];
                                    } ?>" type="text" id="form-field-2" />
                            </div>	
                            <div class="form-group col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">Board Name &nbsp; <?php echo form_error('data[boardId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[boardId]" class="form-control" id="form-field-select-1">
<?php
foreach (getBoardInfo() as $key => $value) {
    ?>
                                        <option value="<?php echo $key; ?>" <?php echo ($data_info["boardId"] == $key) ? "selected" : "" ?> > 
    <?php echo $value; ?>
                                        </option> 

                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group  col-xs-12 col-sm-12">
                                <label class="control-label" for="form-field-1">City/Thana &nbsp; <?php echo form_error('data[city]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getUpozila" onchange="return getUpozila();" value="<?php if (!empty($data_info['city'])) {
                                        echo $data_info['city'];
                                    } ?>" name="data[city]" data-placeholder="Select" required="1" class="form-control">

<?php foreach (getupoList() as $value) { ?>
                                        <option value="<?php echo $value['Upozila']; ?>" 
    <?php echo ($data_info['city'] == $value['Upozila']) ? "Selected" : ""; ?> >        

    <?php echo $value['Upozila']; ?>
                                        </option>                                                

<?php } ?>
                                </select>



                            </div>

                        </div> <!-- /.col-sub-4 --> 
                    </div>
                </div>
            </div> 


            <div class="modal-footer wizard-actions">                             
                <form>
                    <button name="btnInfo" action="<?php echo admin_Url(); ?>/Institute/edit" class="btn btn-success btn-sm btn-next" data-last="Finish">
                        Update Information
                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>

                    <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>
            </div>
        </form>

    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 