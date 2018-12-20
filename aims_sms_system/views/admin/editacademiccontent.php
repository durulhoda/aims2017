<div id="content" class="span10">
			<!-- content starts -->
                        <div>
                            <ul class="breadcrumb">
                                <li>
                                    <a href="<?php echo base_url(); ?>dashboard">Home</a> <span class="divider">/</span>
                                </li>
                                <li>
                                    <a href="#">Edit Academic Content Information</a>
                                </li>
                            </ul>
                        </div>

                        <div class="row-fluid sortable">
                            <div class="box span12">
                                <div class="box-header well" data-original-title>
                                    <h2><i class="icon-edit"></i>Academic Content Information</h2>
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
                                    <form name="edit_news_form" class="form-horizontal" action="<?php echo base_url(); ?>dashboard/updateacademiccontent/<?php echo $editdata->id; ?>" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                            <legend>Edit Academic Content Information</legend>

                                            <div class="control-group">
                                                <label class="control-label">Academic Content Category </label>
                                                <div class="controls">
                                                    <select name="category" required="1">
                                                        <?php foreach (getAcademicMessageInfo() as $key => $value) { ?>
                                                            <option value="<?php echo $key; ?>" <?php echo ($editdata->category == $key) ? "selected" : ""; ?>>
                                                            <?php echo $value; ?></option>
                                                        <?php } ?>                                                                    
                                                    </select>
                                                </div>
                                            </div>  
                                            <div class="control-group">
                                                <label class="control-label" for="typeahead">Content Title </label>
                                                <div class="controls">
                                                    <input type="text" name="title" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if (!empty($editdata->title)) {
                                                            echo $editdata->title;
                                                        } ?>">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="textarea2">Content Details</label>
                                                <div class="controls">
                                                    <textarea  name="content" style="width:80%;height:200px;visibility:visible;">
                                                        <?php if (!empty($editdata->content)) {
                                                            echo $editdata->content;
                                                        } ?>
                                                    </textarea>
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="textarea1">Upload Image</label>
                                                <div class="controls">
                                                    <input name = "file" class="button3" type = "file" value="<?php
                                                           if (!empty($editdata->file)) {
                                                               echo $editdata->file;
                                                           }
                                                           ?>" />
                                                           <?php
                                                           if (!empty($editdata->file)) {
                                                               echo $editdata->file;
                                                           } else {
                                                               echo "No File attached here";
                                                           }
                                                           ?>
                                                </div>
                                            </div>
                                             <div class="control-group">
                                                <label class="control-label">Event Date</label>
                                                <div class="controls">
                                                      <input name="eventdate" class="button3" type="text" value="<?php if (!empty($editdata->title)) {
                                                            echo $editdata->eventdate;
                                                        } ?>"/>
                                                </div>
                                            </div> 
                                            <div class="control-group">
                                                <label class="control-label">Publication Status</label>
                                                <div class="controls">
                                                    <select name="publication_status" required="1">
                                                        <option value="1" <?php echo ($editdata->publication_status == 1) ? "selected" : ""; ?>>Publish</option>
                                                        <option value="2" <?php echo ($editdata->publication_status == 2) ? "selected" : ""; ?>>Un-Publish</option>

                                                    </select>
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
