<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Edit Board of Management Member Information</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Form Elements</h2>
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
						<form name="edit_news_form" class="form-horizontal" action="<?php echo base_url();?>dashboard/updatememberinfo/<?php echo $editdata['bmId'];?>" method="post" enctype="multipart/form-data">
						  <fieldset>
							<legend>Edit Board of Management Member Information</legend>

							<div class="control-group">
                                                            <label class="control-label" for="typeahead">Member Category</label>
                                                            <div class="controls">
                                                                <select name="data[bm_cat]" required="1">
                                                                    <option value="">Select Member Category</option>
                                                                    <?php
                                                                        foreach(getMemberType() as $keyy=>$val)
                                                                        {
                                                                    ?>
                                                                        <option value="<?php echo $keyy; ?>"  <?php echo ($editdata['bm_cat'] ==$keyy) ? "selected" : ""; ?>><?php echo $val; ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Member Name</label>
                                                            <div class="controls">
                                                                <input type="text" name="data[bm_name]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $editdata['bm_name']; ?>">
                                                            </div>
							</div>
                                                        
							<div class="control-group">
							  <label class="control-label" for="typeahead">Member Designation</label>
                                                            <div class="controls">
                                                                <input type="text" name="data[bm_post]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $editdata['bm_post']; ?>">
                                                                <select  name="data[bm_post_value]">
                                                                    <option value="" selected>Select Value</option>
                                                                    <option value="1" <?php echo ($editdata['bm_post_value'] == 1) ? "selected" : ""; ?>>1</option>
                                                                    <option value="2" <?php echo ($editdata['bm_post_value'] == 2) ? "selected" : ""; ?>>2</option>
                                                                    <option value="3" <?php echo ($editdata['bm_post_value'] == 3) ? "selected" : ""; ?>>3</option>
                                                                    <option value="4" <?php echo ($editdata['bm_post_value'] == 4) ? "selected" : ""; ?>>4</option>
                                                                    <option value="5" <?php echo ($editdata['bm_post_value'] == 5) ? "selected" : ""; ?>>5</option>
                                                                    <option value="6" <?php echo ($editdata['bm_post_value']== 6) ? "selected" : ""; ?>>6</option>
                                                                    <option value="7" <?php echo ($editdata['bm_post_value'] == 7) ? "selected" : ""; ?>>7</option>
                                                                    <option value="8" <?php echo ($editdata['bm_post_value'] == 8) ? "selected" : ""; ?>>8</option>
                                                                    <option value="9" <?php echo ($editdata['bm_post_value']== 9) ? "selected" : ""; ?>>9</option>
                                                                    <option value="10" <?php echo ($editdata['bm_post_value'] == 10) ? "selected" : ""; ?>>10</option>
                                                                    <option value="11" <?php echo ($editdata['bm_post_value']== 11) ? "selected" : ""; ?>>11</option>
                                                                    <option value="12" <?php echo ($editdata['bm_post_value']== 12) ? "selected" : ""; ?>>12</option>
                                                                    <option value="13" <?php echo ($editdata['bm_post_value'] == 13) ? "selected" : ""; ?>>13</option>
                                                                    <option value="14" <?php echo ($editdata['bm_post_value'] == 14) ? "selected" : ""; ?>>14</option>
                                                                    <option value="15" <?php echo ($editdata['bm_post_value'] == 15) ? "selected" : ""; ?>>15</option>
                                                                    <option value="16" <?php echo ($editdata['bm_post_value'] == 16) ? "selected" : ""; ?>>16</option>
                                                                    <option value="17" <?php echo ($editdata['bm_post_value'] == 17) ? "selected" : ""; ?>>17</option>
                                                                    <option value="18" <?php echo ($editdata['bm_post_value']==18) ? "selected" : ""; ?>>18</option>
                                                                    <option value="19" <?php echo ($editdata['bm_post_value']== 19) ? "selected" : ""; ?>>19</option>
                                                                    <option value="20" <?php echo ($editdata['bm_post_value']== 20) ? "selected" : ""; ?>>20</option>


                                                                </select>
                                                            </div>
							</div>
                                                        
                                                        <div class="control-group">
							  <label class="control-label" for="typeahead">Member Phone</label>
                                                            <div class="controls">
                                                                <input type="number" name="data[bm_phone]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $editdata['bm_phone']; ?>">
                                                            </div>
							</div>
                                                        
                                                        <div class="control-group">
                                                           <label class="control-label" for="textarea1">Member Details</label>
                                                           <div class="controls">
                                                               <textarea class="cleditor" name="data[bm_desc]" id="textarea1" rows="2">
                                                                                      <?php
                                                                                         echo $editdata['bm_desc'];
                                                                                      ?>
                                                               </textarea>
                                                           </div>
                                                         </div>
							  
                                                        <div class="control-group">
							  <label class="control-label">Upload Image</label>
							  <div class="controls">
								<input name = "image" class="button3" type = "file" value="<?php
						                                if(!empty($editdata['bm_image'])){ echo $editdata['bm_image'];}
						                                ?>" />
								<?php
						                                if(!empty($editdata['bm_image'])){ echo $editdata['bm_image'];}
						                                else{ echo "No Image attacjed here";}
						                                ?>
                                                                <br>
                                                                >> Size Maximum 600kb(210 x 240)
							  </div>
							</div>
							<div class="form-actions">
							 	<button type="submit" class="btn btn-primary" name="btn">Update Member Info</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div>
</div>
