<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url()?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add Content</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Add Content Information</h2>
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


                                            ?>
                                        </h3>
                                            <form name="example" class="form-horizontal" action="<?php echo base_url();?>dashboard/savehonorboard" method="post" enctype="multipart/form-data">
                                            	  <fieldset>
							<legend>Add Content Information</legend>
                                                        
                                                          <div class="control-group">
                                                            <label class="control-label">Honor Member Category </label>
                                                            <div class="controls">
                                                                  <select name="category" required="1">
                                                                      <?php foreach (getboardmember() as $key=>$value) { ?>
                                                                        <option value="<?php echo $key; ?>">
                                                                            <?php echo $value; ?></option>
                                                                        <?php } ?>                                                                    
                                                                  </select>
                                                            </div>
							  </div>                      
							<div class="control-group">
							  <label class="control-label" for="typeahead">Member Name </label>
							  <div class="controls">
								<input type="text" placeholder="Write Member Name" required="1" size="150" name="name" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								
							  </div>
							</div>
                                                 
                                                        
                                                        <div class="control-group">
							  <label class="control-label" for="typeahead">Member Designation </label>
							  <div class="controls">
								<input type="text" placeholder="Write Member Designation" required="1" size="150" name="designation" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								
							  </div>
							</div>
                                                        
                                                        <div class="control-group">
							  <label class="control-label" for="typeahead">Time Period </label>
							  <div class="controls">
								<input type="text" placeholder="Write Time Period" required="1" size="150" name="time_period" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="textarea2">About Member</label>
							  <div class="controls">
								<textarea type="text"  style="width:80%;height:200px;visibility:visible;"  placeholder="Write About Member" name="content"></textarea>
							  </div>
							</div>
                                                        
                                                        <div class="control-group">
							  <label class="control-label" for="textarea1">Upload Image</label>
							  <div class="controls">
								<input name = "image" class="button3" type = "file" />
								Image Size: 300*300
							  </div>
							</div>
                                                 
							

                                                        

                                                        
							<div class="form-actions">
                                                          
							  <button type="submit" class="btn btn-primary" name="btn">Save Information</button>
							  
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