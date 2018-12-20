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
                <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/update_photo/<?php echo $editdata['id']; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>IDS Images Controller </legend>


                        <div class="control-group">
                            <label class="control-label" for="textarea2">Image Category</label>                                                        
                            <div class="controls">
                                <select name="data[img_category]">
                                    <option value="1" <?php echo ($editdata['category'] == 1) ? "selected" : ""; ?>>Insert Slider Image</option>
                                    <option value="2" <?php echo ($editdata['category'] == 2) ? "selected" : ""; ?>>National Events Image</option>
                                    <option value="3" <?php echo ($editdata['category'] == 3) ? "selected" : ""; ?>>Academic Gallery Image</option>
                                    <option value="4" <?php echo ($editdata['category'] == 4) ? "selected" : ""; ?>>Others</option>


                                </select>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Image Title </label>
                            <div class="controls">
                                <input type="text" name="data[title]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $editdata['title'];?>">
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="textarea2">Upload Image</label>                                                        
                            <div class="controls">
                                <input type="file" name="image" value="<?php echo $editdata['image'];?>"> 
                                <br/> >> Maintain Image Size (650 X 500) & Below 500kb
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="textarea2"></label>                                                        
                            <div class="controls">
                                <img src="<?php echo base_url()."/".$editdata['image']; ?>" width="100" height="70"  >
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="btn">Update image</button>
                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div>
</div>