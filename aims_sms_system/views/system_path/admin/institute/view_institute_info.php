<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Institute Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            View Institute information
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
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div id="modal-wizard" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo admin_Url(); ?>/institute/update_logo" method="post" enctype="multipart/form-data">
                        <div id="modal-wizard-container">
                            <div class="modal-header">
                                <div class="alert alert-block alert-success center">
                                    <i class="ace-icon fa fa-image green"></i>
                                    Update Logo
                                </div>
                            </div>

                            <div class="modal-body step-content">
                                <div class="step-pane active">
                                    <div class="center">
                                        <input name="logo" value="<?php echo $data_info['logo']; ?>" type="file" id="id-input-file-2" />
                                        <span class="middle pink">>> <?php echo $data_info['logo']; ?></span><br>
                                        <span class="middle red">Maintain Logo size(200*200)- Format(png/jpg)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer wizard-actions">
                            <input name="instituteId" value="<?php echo $data_info['instituteId']; ?>" type="hidden" />
                            <input name="institutelogo" value="<?php if (!empty($data_info['logo'])) {
        echo $data_info['logo'];
    } ?>" type="hidden" />
                            <button name="btnLogo" class="btn btn-success btn-sm btn-next" data-last="Finish">
                                Update Logo
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>

                            </button>

                            <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>
                        </div>
                    </form>    
                </div>
            </div>
        </div><!-- Modals CONTENT ENDS -->

        <div id="modal-wizard_info" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Update following information</h4>
                    </div>
                    <form action="<?php echo admin_Url(); ?>/institute/update_information" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">                                      

                                <div class="col-xs-12 col-sm-12">  
                                    <input name="data[instituteId]" value="<?php echo $data_info['instituteId']; ?>" type="hidden" />




                                    <div class="col-xs-12 col-sm-6">    

                                        <div class="form-group col-xs-12 col-sm-12">
                                            <label class="control-label" for="form-field-1">Class Level &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>

                                            <br>    <?php
                                            $data_info = getclasslevelfrominstitute();
                                            $getData = explode(",", trim($data_info["programLevel"], ","));
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



                                        <div class="form-group col-xs-8 col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="bigger-110">Class Level &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></span>

                                                    <select name="data[programLevel][]" multiple="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose Class Level...">
                                                        <option value=""></option> 
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
    echo $data_info['city'];} ?>" name="data[city]" data-placeholder="Select" required="1" class="form-control">


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
                </div>
            </div>
        </div><!-- Modals-wizard_info CONTENT ENDS -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <a href="#modal-wizard" data-toggle="modal" class="btn btn-success"> 
            <i class="ace-icon fa fa-pencil align-top bigger-125"></i>
            Update Logo
        </a>
        <a href="<?php echo admin_Url(); ?>/Institute/edit" data-toggle="modal" class="btn btn-danger"> 
            <i class="ace-icon fa fa-pencil align-top bigger-125"></i>
            Update Information
        </a>

        <div class="space-12"></div>
    </div>

    <div class="col-xs-2 col-sm-2 col-md-2">
        <span class="profile-picture">
            <img class="editable img-responsive" alt="<?php if (!empty($data_info['instituteName'])) {
    echo $data_info['instituteName'];
} ?>" id="avatar2" src="<?php if (file_exists($data_info['logo'])) {
    echo base_url() . $data_info['logo'];
} else {
    echo base_url() . "all_upload/default/aims.png";
} ?>" width="200"/>
        </span>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-8">

        <!-- PAGE CONTENT BEGINS -->
        <div class="profile-user-info profile-user-info-striped">

            <div class="profile-info-row">
                <div class="profile-info-name"> School/College Name </div>

                <div class="profile-info-value">
                    <span><?php if (!empty($data_info['instituteName'])) {
                        echo $data_info['instituteName'];
                    } ?></span>
                </div>
            </div>


            <div class="profile-info-row">
                <div class="profile-info-name"> School/College Type</div>

                <div class="profile-info-value">
                        <?php
                        if (!empty($data_info['instituteType'])) {
                            foreach (getinstituteType() as $key => $value) {
                                if ($key == $data_info['instituteType']) {
                                    echo $value;
                                }
                            }
                        }
                        ?>


                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> School/College Class Level </div>

                <div class="form-group col-xs-12 col-sm-12"> 

                    <div class="profile-info-value">  <?php
                        $data_info = getclasslevelfrominstitute();
                        $getData = explode(",", trim($data_info["programLevel"], ","));
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
                </div>
            </div> 

            <div class="profile-info-row">
                <div class="profile-info-name"> School/College Address </div>

                <div class="profile-info-value">
                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                    <span class="editable" id="country"><?php if (!empty($data_info['town'])) {
                            echo "<b>Town/Village :</b> " . $data_info['town'];
                        } ?></span>
                    <span class="editable" id="city"><?php if (!empty($data_info['city'])) {
                            echo "<b>City :</b> " . $data_info['city'];
                        } ?></span>
                    <span class="editable" id="country">
<?php
if (!empty($data_info['district'])) {
    foreach (getDistrictName() as $key => $value) {
        if ($key == $data_info['district']) {
            echo "<b>District :</b> " . $value;
        }
    }
}
?>
                    </span>

                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> School/College EIN </div>

                <div class="profile-info-value">
                    <span class="editable" id="ein"><?php if (!empty($data_info['Ein'])) {
                            echo $data_info['Ein'];
                        } ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Education Board </div>

                <div class="profile-info-value">
                    <span class="editable" id="ein">
<?php
if (!empty($data_info['boardId'])) {
    foreach (getBoardInfo() as $key => $value) {
        if ($key == $data_info['boardId']) {
            echo $value;
        }
    }
}
?>
                    </span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Contact Person </div>

                <div class="profile-info-value">
                    <span class="editable" id="age"><?php if (!empty($data_info['personName'])) {
    echo $data_info['personName'];
} ?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Phone Number </div>

                <div class="profile-info-value">
                    <span class="editable" id="age"><?php if (!empty($data_info['personPhone'])) {
    echo $data_info['personPhone'];
} ?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Email </div>

                <div class="profile-info-value">
                    <span class="editable" id="age"><?php if (!empty($data_info['email'])) {
    echo $data_info['email'];
} ?></span>
                </div>
            </div>
        </div>

    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 