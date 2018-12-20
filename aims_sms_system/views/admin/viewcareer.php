<div id="content" class="span12">
      <!-- content starts -->
      

      <div>
          <ul class="breadcrumb">
              <li>
                  <a href="<?php echo base_url() ?>dashboard">Home</a> <span class="divider">/</span>
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
          
          <?php 
                                        
               if(!empty($allmessage)){
                                    
            ?>
          <div class="box-content">
             <h3 style="color:green">
                     <?php
                     $message = $this->session->userdata('message');
                     if (isset($message)) {
                         echo $message;
                         $this->session->unset_userdata('message');
                     }
                     $errormessage = $this->session->userdata('errormessage');
                     if (isset($errormessage)) {
                         echo $errormessage;
                         $this->session->unset_userdata('errormessage');
                     }
                     ?>
                 </h3>                             
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                <tr>
                   <th>Job Post</th>
                   <th>Attach File</th>                   
                   <th>Actions</th>
                </tr>
              </thead>   
              <tbody>
                     <?php
                         foreach($allmessage as $aproduct)
                        {
                                                          
                      ?>
              <tr>
                
                <td>
                	<?php if(!empty($aproduct->postName)){ 
                		$string_tt = $aproduct->postName;
		                     $string_ttl  = character_limiter($string_tt , 80);
		                          echo $string_ttl ;
               			 }
               		?>
               	</td>
                <td>
                 
                    <?php 
                      
                        if(!empty($aproduct->file)){
                    ?>
                        <a  href="<?php echo base_url(); ?>dashboard/getRequirements/<?php echo $aproduct->file; ?>"> 
                             Download Requirements
                        </a>   
                    
                     <?php        
                        }
                     ?>
                </td>
                                 
                
                <td class="center">
                                                
                  <a class="btn btn-info" href="<?php echo base_url();?>dashboard/editcareer/<?php echo $aproduct->ca_id; ?>" title="Edit">
                    <i class="icon-edit icon-white"></i>  
                                                                
                  </a>
                  <a class="btn btn-danger" href="<?php echo base_url();?>dashboard/deletecareer/<?php echo $aproduct->ca_id;?>" title="Delete" onclick="return check_delete();">
                    <i class="icon-trash icon-white"></i> 
                    
                  </a>
                </td>
                
              </tr>
                      <?php
                         }
                    ?>                                  
              
              </tbody>
            </table>            
          </div>
                                    
                   <?php  }  ?>
        </div><!--/span-->

      </div>
</div>