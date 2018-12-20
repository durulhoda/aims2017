<div id="content" class="span10">
			<!-- content starts -->
			
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url()?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add Management Information</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Add  Board of Management Member Information</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                                            <h3 style="color:green">
                                            <?php
                                            $msg=$this->session->userdata('message');
                                            if(isset($msg)){
                                                echo $msg;
                                                $this->session->unset_userdata('message');
                                            }
                                            
                                            ?>
                                        </h3>
                       <form class="form-horizontal" action="<?php echo base_url();?>dashboard/savemanagementmember" method="post" enctype="multipart/form-data">
						  <fieldset>
							
                                                        <div class="control-group">
                                                            <label class="control-label" for="typeahead">Member Category</label>
                                                            <div class="controls">
                                                                <select name="data[bm_cat]" required="1">
                                                                    <option value="">Select Member Category</option>
                                                                    <?php
                                                                        foreach(getMemberType() as $keyy=>$val)
                                                                        {
                                                                    ?>
                                                                        <option value="<?php echo $keyy; ?>"><?php echo $val; ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Member Name</label>
							  <div class="controls">
								<input type="text" value="<?php echo set_value("data[bm_name]"); ?>" placeholder="Member Name" size="150" name="data[bm_name]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								
							  </div>
							</div>
                                                        <div class="control-group">
							  <label class="control-label" for="typeahead">Member Designation</label>
							  <div class="controls">
                                                              <input type="text" placeholder="Member Designation" size="150" name="data[bm_post]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								
                                                                  <select name="data[bm_post_value]">
                                                                    <option value="0" selected>Select Post Value</option>
                                                                    <option value="1" >1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="17">17</option>
                                                                    <option value="18">18</option>
                                                                    <option value="19">19</option>
                                                                    <option value="20">20</option>
                                                                      
                                                                  </select>
                                                            </div>
							</div>
                                                        <div class="control-group">
							  <label class="control-label">Member Phone</label>
							  <div class="controls">
								<input type="number" value="<?php echo set_value("data[bm_phone]"); ?>" placeholder="Member Phone Number" size="150" name="data[bm_phone]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Member Details</label>
							  <div class="controls">
								<textarea class="cleditor" value="<?php echo set_value("data[bm_desc]"); ?>" placeholder="Enter Member Details" rows="3" name="data[bm_desc]"></textarea>
							  </div>
							</div>
                                                        <div class="control-group">
							  <label class="control-label" for="textarea1">Upload Image</label>
							  <div class="controls">
								<input name = "bm_image" class="button3" type = "file" />
								>> Size Maximum 600kb(210 x 240)
							  </div>
							</div>

							           
							<div class="form-actions">
                                                          
							  <button type="submit" class="btn btn-primary" name="btn">Save Member Info</button>
							  
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div>
</div>