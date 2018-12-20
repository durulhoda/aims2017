    <div class="row">
        <?php
                if (!empty($studentlist)) {
            ?>
        <div class="page-header">
                 <a href="<?php echo base_url('accounts_admin/student'); ?>" class="btn btn-grey">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Go Back
                 </a>
                <button class="btn btn-success " onclick="printDiv('printableArea')">
                    Print A Copy
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>           
        </div>
        <div class="col-xs-12 col-sm-12" id="printableArea">
             <div class="row">                        
                        <div class="col-sm-12">
                            <table id="simple-table" class="table">
                                <thead>
                                    <tr>           
                                        <th colspan="6" class="center">
                                             <h3>   <?php
                                                    $ins_name = getInstituteName();
                                                    echo $ins_name;
                                                ?>
                                             </h3> 
                                             <h4>Student List </h4>
                                        </th>
                                                             
                                    </tr>
                                    <tr>           
                                                               <th>
                                        Session: 
                                           <?php 
                                                      if(!empty($sessionId)) {echo "<b>".getSessionName($sessionId)."</b>"; }                                               

                                              ?>
                                        
                                        </th>
                                        <th>
                                            Class:
                                                <?php
                                                if(!empty($programId)) {echo "<b>".getProgramName($programId) . "</b>";}
                                                ?>
                                        </th>
                                        <th>
                                            Medium: 
                                                <?php
                                               if(!empty($mediumId)) {echo "<b>". getmediumName($mediumId) . "</b>";}
                                                ?>
                                        </th>
                                        <th>
                                            Group: 
                                                <?php
                                                if(!empty($groupId)) {echo "<b>". getGroupName($groupId) . "</b>";}
                                                ?>
                                        </th>
                                        <th>
                                            Section: 
                                                <?php
                                                if(!empty($sectionId)) {echo "<b>". getsectionName($sectionId) . "</b>";}
                                                ?>
                                        </th>
                                        <th>
                                            Shift: 
                                                <?php
                                                if(!empty($shiftId)) {echo "<b>". getshiftName($shiftId) . "</b>";}
                                                ?>
                                        </th>
                                                             
                                    </tr>
                                </thead>
                            </table> 
                            
                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->
            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>           
                            <th >Sl No</th>
                            <th >Student Id</th>
                            <th>Student Name</th>
                            <th>Birth Date/ Gender</th>
                            <th>Father Info</th>
                            <th>Mother Info</th>
                            <th>Image</th>                           
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                             $sl=1;
                                foreach ($studentlist as $value) {
                                        
                          ?>
                      
                        <tr>
                            <td> <?php echo $sl++; ?> </td>
                            <td>
                                <a href="#">
                                      <b> <?php
                                            if (!empty($value['studentId'])) {
                                                echo $value['studentId'];
                                            }
                                          ?>
                                      </b>
                                </a>
                            </td>

                            <td><?php if (!empty($value['firstName'])) { echo "<b>".$value['firstName'] . " " . $value['middleName'] . " " . $value['lastName']."</b>"; } ?></td>
                            <td><?php if (!empty($value['dateOfBirth'])) { echo $value['dateOfBirth']."<br>".element($value['gender'],getGendar(),Null); } ?></td>

                            <td>
                                
                                <?php echo "<b>".$value['fatherName'] . "</b><br>".$value['fatherPhone'] ; ?>
                            </td>
                            <td>                                
                                <?php echo "<b>".$value['motherName'] . "</b><br>".$value['motherPhone'] ; ?>
                            </td>
                            <td class="hidden-480">
                                        <?php
                                                if ($value['photo']) {
                                            ?>
                                            <img  src="<?php if (file_exists($value['photo'])) { echo base_url() . $value['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60" height="60">
                                        <?php 
                                        
                                            } 
                                          ?>
                            </td>

                          
                        </tr>
                           <?php
                                  }
                            ?>
                       
                     </tbody>   
                  </table>   
                </div>
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 