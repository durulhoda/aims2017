<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>dashboard">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Add Images</a>
            </li>
        </ul>
    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i> Upload Form</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <h3 style="color:green">
                    <?php
                    $msg = $this->session->userdata('message');
                    if (isset($msg)) {
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
                <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/doupload" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Upload Images </legend>


                        <div class="control-group">
                            <label class="control-label" for="textarea2">Photo Category</label>                                                        
                            <div class="controls">
                                <select name="category">
                                    <option value="0">Select Category</option>
                                    <option value="1">Insert Slider Image</option>
                                    <option value="2">National Events Image</option>
                                    <option value="3">Academic Gallery Image</option>
                                    <option value="4">Others</option>
                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="typeahead">Image Title </label>
                            <div class="controls">
                                <input type="text" placeholder="Your Image Title" size="150" name="title" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="textarea2">Upload Image</label>                                                        
                            <div class="controls">
                                <input type="file" name="image">
                                <br/> >> Maintain Image Size (650 X 500) & Below 500kb
                                
                            </div>
                        </div>

                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="btn">Add image</button>
                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div>
</div>