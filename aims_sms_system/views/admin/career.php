<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url()?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add Career Requirement</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Add Career Information</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                                            <h3 style="color:green">
                                            <?php
                                                $message=$this->session->userdata('message');
                                                if(isset($message))
                                                {
                                                    echo $message;
                                                    $this->session->unset_userdata('message');
                                                }
                                                $errormessage=$this->session->userdata('errormessage');
                                                if(isset($errormessage))
                                                {
                                                    echo $errormessage;
                                                    $this->session->unset_userdata('errormessage');
                                                }


                                            ?>
                                        </h3>
                                            <form name="example" class="form-horizontal" action="<?php echo base_url();?>dashboard/savejobinfo" method="post" enctype="multipart/form-data">
                                            	  <fieldset>
							<legend>Add Career Requirement</legend>
                                                        
                                                                             
							<div class="control-group">
							  <label class="control-label" for="typeahead">Job Post Name </label>
							  <div class="controls">
								<input type="text" placeholder="Your Content Title" required="1" size="150" name="postName" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="textarea2">Job Requirement</label>
							  <div class="controls">
								<textarea type="text"  style="width:99.8%;height:400px;visibility:hidden;"  placeholder="Your Contact Address" name="content"></textarea>
							  </div>
							</div>
                                                        
                                                        <div class="control-group">
							  <label class="control-label" for="textarea1">Upload Requirement File</label>
							  <div class="controls">
								<input name = "file" class="button3" type = "file" />
								Only Upload pdf,docx,doc file
							  </div>
							</div>
                                                        <div class="control-group">
                                                            <label class="control-label">Publication Status</label>
                                                            <div class="controls">
                                                                  <select name="publication_status" required="1">
                                                                        <option value="1">Publish</option>
                                                                        <option value="2">Un-Publish</option>
                                                                  </select>
                                                            </div>
							  </div>  
							

                                                        

                                                        
							<div class="form-actions">
                                                          
							  <button type="submit" class="btn btn-primary" name="btn">Save Job Information</button>
							  
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
                                <script>
                                        KindEditor.ready(function(K) {
                                                var editor1 = K.create('textarea[name="content"]', {
                                                        cssPath : '<?php echo base_url();?>adminasstes/editor/js/plugins/code/prettify.css',
                                                        uploadJson : '<?php echo base_url();?>adminasstes/editor/php/upload_json.php',
                                                        fileManagerJson : '<?php echo base_url();?>adminasstes/editor/php/file_manager_json.php',
                                                        allowFileManager : true,
                                                        afterCreate : function() {
                                                                var self = this;
                                                                K.ctrl(document, 13, function() {
                                                                        self.sync();
                                                                        K('form[name=example]')[0].submit();
                                                                });
                                                                K.ctrl(self.edit.doc, 13, function() {
                                                                        self.sync();
                                                                        K('form[name=example]')[0].submit();
                                                                });
                                                        }
                                                });
                                                prettyPrint();
                                        });
                                </script>

			</div>
</div>