<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url()?>super_admin/admin_registration">Add News</a>
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
                                            <form class="form-horizontal" action="<?php echo base_url();?>super_admin/save_admin_registration" method="post" enctype="multipart/form-data">
						  <fieldset>
							<legend>Add registration</legend>
                                                         <div class="control-group">
                                                              <label class="control-label" for="date01">Department Name</label>
                                                          <div class="controls">
                                                              <select name="category_id"> 
                                                                  
                                                                  <option>Select Category....</option>
                                                                  <option value="foundationday">Foundation Day Admin </option>
                                                                  <?php
                                                                   foreach($all_category as $v_category)
                                                                   {
                                                                  ?>
                                                                  <option value="<?php echo $v_category->category_id;?>"><?php echo $v_category->category_name;?></option>
                                                                  <?php
                                                                    }
                                                                ?>
                                                              </select>
							  </div>
                                                              </div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Admin Name </label>
							  <div class="controls">
								<input type="text" name="admin_name" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Admin Password</label>
							  <div class="controls">
                                                              <input type="password" name="admin_password" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div>
							</div>
                                                        <div class="control-group">
							  <label class="control-label" for="typeahead">Email Address </label>
							  <div class="controls">
                                                              <input type="email" name="admin_email_address" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div>
							</div>
                                                        <div class="control-group">
							 
							 
							</div>

							
                                                       
                                                       
							<div class="form-actions">
							  <!--<input type="radio" name="publication" value="publish"> Publish<br/>
                                                          <input type="radio" name="publication" value="unpublish"> Unpublish<br/><br/>-->
							  <button type="submit" class="btn btn-primary" name="btn">save</button>
							</div>
						  </fieldset>
						</form>   

					</div>
                                    <?php if(!empty($all_news)){  ?>
                                        
                                    <div class="box-content">
                                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Sl. No.</th>
								  <th>Admin Department </th>  
								  <th>Email Address</th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                                                      <?php
                                                      
                                                       $access_level = $this->session->userdata('access_level');
                                                      $x=1;
                                                      foreach($all_news as $v_news)
                                                      {
                                                          if($access_level !=10101035 && $v_news->category_id == 10101035){
                                                              $x;
                                                          }
                                                          else{
                                                      ?>
							<tr>
								
								
                                                            <td class="center"><?php echo $x++; ?></td>
                                                            <td class="center"> 
                                                                <?php
                                                                if($v_news->category_id == 101010200){
                                                                    echo "Super Admin";
                                                                }
                                                                
                                                                elseif($v_news->category_id == 10101035){
                                                                     echo "Super Admin";
                                                                }
                                                                elseif($v_news->category_id == "foundationday"){
                                                                     echo "Foundation Day Admin";
                                                                }
                                                                else{
                                                                    foreach (getDeptCategoryName($v_news->category_id) as $dada) {
                                                                        echo $dada['category_name'];
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                                      
								<td class="center"> 
                                                                <?php
                                                                    echo $v_news->admin_email_address;
                                                                ?>
                                                            </td>
								<td class="center">
                                                                    <a class="btn btn-danger" href="<?php echo base_url();?>super_admin/delete_admin/<?php echo $v_news->admin_id;?>" title="Delete" onclick="return check_delete();">
										<i class="icon-trash icon-white"></i> 
										
									</a>
                                                                    
									
								</td>
							</tr>
                                                        <?php
                                                      }
                                                      }
                                                     
                                                      ?>
							
						  </tbody>
					  </table>       
                                    </div>
                                    
                                    <?php   } ?>
				</div><!--/span-->

			</div>
</div>