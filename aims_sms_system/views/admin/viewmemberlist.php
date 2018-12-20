<div id="content" class="span12">
      <!-- content starts -->
      

      <div>
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
          </li>
          <li>
            <a href="#">View Member/Employee</a>
          </li>
        </ul>
      </div>

            <a class="btn btn-success" href="<?php echo base_url();?>dashboard/managementlist" title="Edit">
               Board Member Information
            </a>
            <a class="btn btn-warning" href="<?php echo base_url();?>dashboard/Thirdstaff_list" title="Edit">
                3rd Class Employee Information
            </a>
            <a class="btn btn-info" href="<?php echo base_url();?>dashboard/Fourthstaff_list" title="Edit">
                4th Class Employee Information
            </a>
      
      <div class="row-fluid sortable">
          <div class="box span12">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-user"></i>Member/Employee List</h2>
                    <div class="box-icon">
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
                     <?php 
                                        
                         if(!empty($listdata)){
                                   
                     // $s=1;
                        foreach ($listdata as $aproduct)
                        {
                                if($aproduct['bm_cat']==$bm_cat)
                                {
                      ?>
                    <div class="box-content span5">
                        <ul class="dashboard-list">
                            <li>
                                <table class="table">
                                    <thead>
                                      <tr>
                                          <th>
                                                <img class="dashboard-avatar" alt="<?php echo $aproduct['bm_name'];?>" src="<?php echo base_url()."/".$aproduct['bm_image'];?>">
                                           </th>
                                          <th>
                                              <strong>Name :</strong> <a href="#"><?php echo $aproduct['bm_name'];?> </a><br>
                                              <strong>Designation :</strong> <?php echo $aproduct['bm_post'];?><br>
                                              <strong>Phone :</strong> <span class="label label-success"><?php echo $aproduct['bm_phone'];?></span>
                                          </th>
                                          <th>
                                              <a class="btn btn-info" href="<?php echo base_url();?>dashboard/editmanagement/<?php echo $aproduct['bmId']; ?>" title="Edit">
                                                <i class="icon-edit icon-white"></i>  

                                              </a>
                                              <a class="btn btn-danger" href="<?php echo base_url();?>dashboard/deletemanagement/<?php echo $aproduct['bmId']; ?>" title="Delete" onclick="return check_delete();">
                                                <i class="icon-trash icon-white"></i> 

                                              </a>
                                          </th>
                                          
                                      </tr>
                                    </thead>   
                                </table> 
                                
                                
                            </li>
                            
                        </ul>
                        
                    </div>
                    <?php
                                 }
                            }
                         }
                       ?>
                    
                </div>
            </div>
        

      </div>
</div>