<div id="content" class="span12">
      <!-- content starts -->
      
      <div>
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
          </li>
          <li>
            <a href="#">View Merit Student List</a>
          </li>
        </ul>
      </div>
      
      <div class="row-fluid sortable">
        <div class="box span12">
          <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Merit Student List</h2>
            <div class="box-icon">
              <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
              <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
          </div>
          
                                    <?php 
                                        
                                        if(!empty($listdata)){
                                    
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
                    <th>Sl. No</th>
                    <th>Exam Type</th>
                    <th>Student Name</th>
                    <th>Year</th>
                    <th>Grade</th>
                   
                   <th>Actions</th>
                </tr>
              </thead>   
              <tbody>
                     <?php

                      $s=1;
                        foreach ($listdata as $aproduct)
                        {
                                                          
                      ?>
              <tr >
                
                    <td><?php echo $s++;?></td>
                    <td><?php 
                                        echo ($aproduct['exam_type'] == 1) ? "PSC" : "";
                                        echo ($aproduct['exam_type'] == 2) ? "JSC": ""; 
                                        echo ($aproduct['exam_type'] == 3) ? "SSC": ""; 
                                        echo ($aproduct['exam_type'] == 4) ? "HSC": ""; 
                                   
            
                                        ?></td>
                    <td><?php echo $aproduct['stuName'];?></td>
                    <td><?php echo $aproduct['year'];?></td>
                    <td><?php echo $aproduct['grade'];?></td>
                    
                <td class="center">
                                                           
                  <a class="btn btn-info" href="<?php echo base_url();?>dashboard/editresult/<?php echo $aproduct['studentId']; ?>" title="Edit">
                    <i class="icon-edit icon-white"></i>  
                                                                
                  </a>
                  <a class="btn btn-danger" href="<?php echo base_url();?>dashboard/deleteresult/<?php echo $aproduct['studentId']; ?>" title="Delete" onclick="return check_delete();">
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