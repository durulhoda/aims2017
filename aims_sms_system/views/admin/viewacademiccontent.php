<div id="content" class="span12">
      <!-- content starts -->
      

      <div>
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo base_url()?>dashboard">Home</a> <span class="divider">/</span>
          </li>
          <li>
            <a href="#">View Content Information</a>
          </li>
        </ul>
      </div>
      
      <div class="row-fluid sortable">
        <div class="box span12">
          <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Content Information List</h2>
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
                    $msg = $this->session->userdata('message');
                    if (isset($msg)) {
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                <tr>
                   <th>Content Category</th>
                   <th>Title</th>
                   <th>Message</th>
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
                    <span class="label label-success">
                            <?php 
                                    foreach (getAcademicMessageInfo() as $key => $value) 
                                    {
                                        if($key==$aproduct->category)
                                        {
                                            echo $value;
                                        }
                                    }
                                ?>
                      </span>

                </td>
                <td>
                	<?php if(!empty($aproduct->title)){ 
                		$string_tt = $aproduct->title;
		                     $string_ttl  = character_limiter($string_tt , 80);
		                          echo $string_ttl ;
               			 }
               		?>
               	</td>
                <td>
                    <?php 
                     $string = $aproduct->content;
                     $string = character_limiter($string, 50);
                          echo $string; ?>
                </td>
                <td>
                    <?php 
                     echo $aproduct->file;
//                     require(base_url().DocxConvertion); 
//                     $docObj = new DocxConvertion($aproduct->file); 
//                        //$docObj = new Doc2Txt("test.doc"); 
//
//                        $txt = $docObj->convertToText(); 
//                        echo $txt; 
                     ?>
                </td>
                                 
                
                <td class="center">
                                                
                  <a class="btn btn-info" href="<?php echo base_url();?>dashboard/editacademiccontent/<?php echo $aproduct->id; ?>" title="Edit">
                    <i class="icon-edit icon-white"></i>  
                                                                
                  </a>
                  <a class="btn btn-danger" href="<?php echo base_url();?>dashboard/deleteacademiccontent/<?php echo $aproduct->id;?>" title="Delete" onclick="return check_delete();">
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