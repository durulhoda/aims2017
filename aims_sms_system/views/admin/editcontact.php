<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>dashboard">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Edit Contact</a>
            </li>
        </ul>
    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i> Contact Form</h2>
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
                <form name="edit_news_form" class="form-horizontal" action="<?php echo base_url(); ?>dashboard/updatecontact/<?php echo $editdata['co_id'];?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Edit Contact</legend>

                        <div class="control-group">
                            <label class="control-label" for="textarea1">Contact Address</label>
                            <div class="controls">
                                <textarea name="data[contactInfo]" style="width:80%;height:200px;visibility:visible;" class="contactInfo" >
                                    <?php if(!empty($editdata['contactInfo'])) { echo $editdata['contactInfo'];}?>
                                </textarea>
                            </div>
                        </div>
                                                    
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="btn">Update Contact Information</button>
                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->
        <script>
                                        KindEditor.ready(function(K) {
                                                var editor1 = K.create('textarea[class="contactInfo"]', {
                                                        cssPath : '<?php echo base_url(); ?>adminasstes/editor/js/plugins/code/prettify.css',
                                                        uploadJson : '<?php echo base_url(); ?>adminasstes/editor/php/upload_json.php',
                                                        fileManagerJson : '<?php echo base_url(); ?>adminasstes/editor/php/file_manager_json.php',
                                                        allowFileManager : true,
                                                        afterCreate : function() {
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
