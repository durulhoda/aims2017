<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>dashboard">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Edit Honor Board Member</a>
            </li>
        </ul>
    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i>Honor Board Member Information</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <h3 style="color:green">
                    <?php
                    $message = $this->session->userdata('message');
                    if (isset($message)) {
                        echo $message;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
                <form  class="form-horizontal" action="<?php echo base_url(); ?>dashboard/updatehonorboard/<?php echo $editdata->honor_id; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Edit Honor Board Member Information</legend>

                        <div class="control-group">
                            <label class="control-label">Honor Board Member Category </label>
                            <div class="controls">
                                <select name="category" required="1">
                                    <?php foreach (getboardmember() as $key => $value) { ?>
                                        <option value="<?php echo $key; ?>" <?php echo ($editdata->category == $key) ? "selected" : ""; ?>>
                                            <?php echo $value; ?></option>
                                    <?php } ?>                                                                    
                                </select>
                            </div>
                        </div>  
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Member Name </label>
                            <div class="controls">
                                <input type="text" name="name" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php
                                    if (!empty($editdata->name)) {
                                        echo $editdata->name;
                                    }
                                    ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Member Designation
                            </label>
                            <div class="controls">
                                <input type="text" name="designation" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php
                                       if (!empty($editdata->designation)) {
                                           echo $editdata->designation;
                                       }
                                    ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Time Period</label>
                            <div class="controls">
                                <input type="text" name="time_period" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php
                                       if (!empty($editdata->time_period)) {
                                           echo $editdata->time_period;
                                       }
                                    ?>">
                            </div>
                        </div>



                        <div class="control-group">
                            <label class="control-label" for="textarea2">About Member
                            </label>
                            <div class="controls">
                                <textarea  name="content" style="width:80%;height:200px;visibility:visible;">
                                    <?php
                                    if (!empty($editdata->aobut_emp)) {
                                        echo $editdata->aobut_emp;
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="textarea1">Upload Image</label>
                            <div class="controls">
                                <input name = "image" class="button3" type = "file" value="<?php
                                    if (!empty($editdata->image)) {
                                        echo $editdata->image;
                                    }
                                    ?>" />
                                       <?php
                                       if (!empty($editdata->image)) {
                                           echo $editdata->image;
                                       } else {
                                           echo "No File attached here";
                                       }
                                       ?>
                            </div>
                        </div>
                

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="btn">Update Content</button>
                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->
        <script>
            KindEditor.ready(function(K) {
                var editor1 = K.create('textarea[name="content"]', {
                    cssPath: '<?php echo base_url(); ?>adminasstes/editor/js/plugins/code/prettify.css',
                    uploadJson: '<?php echo base_url(); ?>adminasstes/editor/php/upload_json.php',
                    fileManagerJson: '<?php echo base_url(); ?>adminasstes/editor/php/file_manager_json.php',
                    allowFileManager: true,
                    afterCreate: function() {
                        var self = this;
                        K.ctrl(document, 13, function() {
                            self.sync();
                            K('form[name=edit_news_form]')[0].submit();
                        });
                        K.ctrl(self.edit.doc, 13, function() {
                            self.sync();
                            K('form[name=edit_news_form]')[0].submit();
                        });
                    }
                });
                prettyPrint();
            });
        </script>

    </div>		


</div>
