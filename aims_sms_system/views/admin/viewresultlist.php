<div id="content" class="span12">
      <!-- content starts -->
      
      <div>
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
          </li>
          <li>
            <a href="#">View Result Summery</a>
          </li>
        </ul>
      </div>
      
      <div class="row-fluid sortable">
        <div class="box span12">
          <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Result Summery List</h2>
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
                    <th>Group</th>
                    <th>Exam Year</th>
                    <th>Grade A+</th>
                    <th>Grade A+</th>
                    <th>Grade A-</th>
                    <th>Grade B</th>
                    <th>Grade C</th>
                    <th>Grade D</th>
                    <th>Grade F</th>
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
                                        echo ($aproduct['exam_type'] == 5) ? "HSC(BM)" : "";
                                        echo ($aproduct['exam_type'] == 6) ? "BA": ""; 
                                        echo ($aproduct['exam_type'] == 7) ? "BA(Hon)": ""; 
                                        echo ($aproduct['exam_type'] == 8) ? "BBS": ""; 
                                        echo ($aproduct['exam_type'] == 9) ? "BSS" : "";
                                        echo ($aproduct['exam_type'] == 10) ? "MA": ""; 
            
                                        ?></td>
                    <td><?php echo getGroupName($aproduct['group']);?></td>
                    <td><?php echo $aproduct['exam_year'];?></td>
                    <td><?php echo $aproduct['grade_Ap'];?></td>
                    <td><?php echo $aproduct['grade_A'];?></td>
                    <td><?php echo $aproduct['grade_Am'];?></td>
                    <td><?php echo $aproduct['grade_B'];?></td>
                    <td><?php echo $aproduct['grade_C'];?></td>
                    <td><?php echo $aproduct['grade_D'];?></td>
                    <td><?php echo $aproduct['grade_F'];?></td>
                                 
                
                <td class="center">
                                                           
                  <a class="btn btn-info" href="<?php echo base_url();?>dashboard/editresult/<?php echo $aproduct['rs_Id']; ?>" title="Edit">
                    <i class="icon-edit icon-white"></i>  
                                                                
                  </a>
                  <a class="btn btn-danger" href="<?php echo base_url();?>dashboard/deleteresult/<?php echo $aproduct['rs_Id']; ?>" title="Delete" onclick="return check_delete();">
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