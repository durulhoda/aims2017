<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">

            <!-- /Content Section  -->                    
            <div class="page-header">
                <h1>
                    Teacher Information
                    <small class="red">
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Teacher Profile
                    </small>
                </h1>
            </div><!-- /.page-header -->


            <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
                ?>
                <div class="alert alert-block alert-success">
                    <i class="ace-icon fa fa-check green"></i>
                    <?php
                    echo $message;
                    $this->session->unset_userdata('message');
                    ?>
                </div>
                <?php
            }
            $errormessage = $this->session->userdata('errormessage');
            if (isset($errormessage)) {
                ?>
                <div class="alert alert-block alert-danger">
                    <i class="ace-icon fa fa-times red"></i>
                    <?php
                    echo $errormessage;
                    $this->session->unset_userdata('errormessage');
                    ?>
                </div>
                <?php
            }
            ?>

      <div class="col-xs-12">
          

            <div>
                <div id="user-profile-1" class="user-profile row">
                    <div class="col-xs-12 col-sm-3 center"><br>
                        <div>
                          
                    <!-- Start /#Model -->         
                <div class="col-xs-12 col-sm-12 col-md-12">
               
                  <span class="profile-picture">
                                <div >
                                    <ul class="ace-thumbnails">
                                        <li>
                                            <a href="#modal-wizard" data-toggle="modal" class="btn btn-successs">
                                                <img width="150" height="160" src="<?php echo base_url() . "uploads/Employee/" . $editData['photo'] ?>" />
                                                <div class="text">
                                                    
                                                </div>
                                            </a>

                                            <div class="tools tools-bottom">


                                                <a href="#">
                                                    <i class="ace-icon fa fa-pencil"></i>
                                                    Update Profile Photo
                                                </a>
                                            </div>
                                        </li>


                                    </ul>
                                </div><!-- /#pictures --> 

                            </span>
            </a>
          <div class="space-4"></div>

                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                <div class="inline position-relative">
                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                        <i class="ace-icon fa fa-circle light-green"></i>
                                        &nbsp;
       
                                        <span class="white"><?php echo $editData["firstName"] . " " . $editData["lastName"]; ?></span>
                                    </a>


                                </div>
                            </div>
           
            <div class="space-12"></div>
        </div>

                            
                            
                          <!-- /#Model -->   
                          <div id="modal-wizard" class="modal">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <form action="<?php echo teacher_Url();?>/teacher/update_photo" method="post" enctype="multipart/form-data">
                            <div id="modal-wizard-container">
                                <div class="modal-header">
                                    <div class="alert alert-block alert-success center">
                                       <i class="ace-icon fa fa-image green"></i>
                                       
                                       Update Profile Picture
                                   </div>
                                </div>

                                <div class="modal-body step-content">
                                    <div class="step-pane active">
                                        <div class="center">
                                            <input type="hidden" name="employeeId" value="<?php echo $editData["employeeId"]; ?>">
                                               <input name="photo" value="<?php echo set_value("photo"); ?>" type="file" id="id-input-file-2" />
                                             <span class="middle pink">>> </span><br>
                                             <span class="middle red">Maintain Image size with- Format (png/jpg/gif)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer wizard-actions">
                               
                                <button name="btnSubmit" class="btn btn-success btn-sm btn-next" data-last="Finish">
                                    Update Image
                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                    
                                </button>

                                <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cancel
                                </button>
                            </div>
                          </form>    
                     </div>
                 </div>
             </div><!-- Modals CONTENT ENDS -->
             
       
                 
                        </div>

                        <div class="space-6"></div>




                    </div>

                    <div class="col-xs-12 col-sm-9">


                        <div class="space-12"></div>

                        <div class="profile-user-info profile-user-info-striped">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> ID </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="username"><?php echo $editData["employeeId"]; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Location </div>

                                <div class="profile-info-value">
                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                    <?php echo $editData["address"]; ?>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Phone</div>

                                <div class="profile-info-value">
                                    <span class="editable" id="login"><?php echo $editData["phone"]; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Email </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="age">
                                        <?php echo $editData["email"]; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Joined </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="signup"><?php echo $editData["joiningdate"]; ?></span>
                                </div>
                            </div>



                            <div class="profile-info-row">
                                <div class="profile-info-name"> Employee Type : </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="about">
                                        <?php
                                        if (!empty($editData['employeeType'])) {
                                            echo " " . element($editData['employeeType'], getmployeetypeList(), Null) . "";
                                        }
                                        ?>   </span>
                                </div>
                            </div>
                        </div>




                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-header">
                                Personal Information
                            </div>
                            <div>
                                <table  class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                
                                            <th>Father Name </th>
                                            <th>Mother Name </th>
                                            <th>Marital Status</th>   
                                            <th>Nationality</th>
                                            <th >Blood Group</th>   
                                            <th>National ID</th>
                                            <th >Birth Registration</th> 

                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>  <?php echo $editData["fatherName"]; ?></td> 
                                            <td>  <?php echo $editData["motherName"]; ?></td> 
                                            <td>  <?php
                                                if (!empty($editData['maritialStatus'])) {
                                                    echo " " . element($editData['maritialStatus'], getMeritialStatus(), Null) . "";
                                                }
                                                ?> </td>  
                                            <td>    <?php echo $editData["nationality"]; ?></td> 
                                            <td>
                                                <?php
                                                if (!empty($editData['bloodGroup'])) {
                                                    echo " " . element($editData['bloodGroup'], getBloodGroup(), Null) . "";
                                                }
                                                ?> 
                                            </td> 
                                            <td> <?php echo $editData["nationalIdentity"]; ?> </td> 
                                            <td> <?php echo $editData["embreg"]; ?> </td> 

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div><!-- /.span -->
                    </div><!-- /.row -->


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-header">
                                Previous Education Details
                            </div>
                            <div>
                                <table  class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                
                                            <th>Program </th>
                                            <th>Discipline </th>
                                            <th>Grade </th>   
                                            <th>Passing Year</th>
                                            <th >Board/Institution</th>   

                                        </tr>
                                    </thead>


                                    <?php
                                    if (!empty($editData['degree'])) {
                                        ?>
                                        <tr > 
                                            <td>
                                                <?php
//            print_r($editData["programone"]); exit; 
                                                $editDatas = explode(",", trim($editData["degree"]));
                                                ?>
                                                <?php
                                                if (!empty($editDatas[1])) {
                                                    echo element($editDatas[1], getEducationProgramType(), null);
                                                }
                                                ?>                               
                                            </td>
                                            <td> 
                                                <?php echo $editDatas[2]; ?>
                                            </td>
                                            <td>
                                                <?php echo $editDatas[3]; ?>
                                            </td> 
                                            <td>
                                                <?php echo $editDatas[4]; ?>
                                            </td>
                                            <td>
                                                <?php echo $editDatas[5]; ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    if (!empty($editData['degree2'])) {
                                        ?>
                                        <tr > 
                                            <td>
                                                <?php
//            print_r($editData["programone"]); exit; 
                                                $editDatas = explode(",", trim($editData["degree2"]));
                                                ?>
                                                <?php
                                                if (!empty($editDatas[1])) {
                                                    echo element($editDatas[1], getEducationProgramType(), null);
                                                }
                                                ?>                               
                                            </td>
                                            <td> 
                                                <?php echo $editDatas[2]; ?>
                                            </td>
                                            <td>
                                                <?php echo $editDatas[3]; ?>
                                            </td> 
                                            <td>
                                                <?php echo $editDatas[4]; ?>
                                            </td>
                                            <td>
                                                <?php echo $editDatas[5]; ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    if (!empty($editData['degree3'])) {
                                        ?>
                                        <tr > 
                                            <td>
                                                <?php
//            print_r($editData["programone"]); exit; 
                                                $editDatas = explode(",", trim($editData["degree3"]));
                                                ?>
                                                <?php
                                                if (!empty($editDatas[1])) {
                                                    echo element($editDatas[1], getEducationProgramType(), null);
                                                }
                                                ?>                               
                                            </td>
                                            <td> 
    <?php echo $editDatas[2]; ?>
                                            </td>
                                            <td>
    <?php echo $editDatas[3]; ?>
                                            </td> 
                                            <td>
    <?php echo $editDatas[4]; ?>
                                            </td>
                                            <td>
    <?php echo $editDatas[5]; ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    if (!empty($editData['degree4'])) {
                                        ?>

                                        <tr > 
                                            <td>
                                                <?php
//            print_r($editData["programone"]); exit; 
                                                $editDatas = explode(",", trim($editData["degree4"]));
                                                ?>
                                                <?php
                                                if (!empty($editDatas[1])) {
                                                    echo element($editDatas[1], getEducationProgramType(), null);
                                                }
                                                ?>                             
                                            </td>
                                            <td> 
                                                <?php echo $editDatas[2]; ?>
                                            </td>
                                            <td>
                                                <?php echo $editDatas[3]; ?>
                                            </td> 
                                            <td>
                                                <?php echo $editDatas[4]; ?>
                                            </td>
                                            <td>
    <?php echo $editDatas[5]; ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    if (!empty($editData['degree5'])) {
                                        ?>    
                                        <tr > 
                                            <td>
                                                <?php
//            print_r($editData["programone"]); exit; 
                                                $editDatas = explode(",", trim($editData["degree5"]));
                                                ?>
                                                <?php
                                                if (!empty($editDatas[1])) {
                                                    echo element($editDatas[1], getEducationProgramType(), null);
                                                }
                                                ?>                              
                                            </td>
                                            <td> 
                                                <?php echo $editDatas[2]; ?>
                                            </td>
                                            <td>
                                                <?php echo $editDatas[3]; ?>
                                            </td> 
                                            <td>
                                                <?php echo $editDatas[4]; ?>
                                            </td>
                                            <td>
                                        <?php echo $editDatas[5]; ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    if (!empty($editData['degree6'])) {
                                        ?>
                                        <tr > 
                                            <td>
                                                <?php
//            print_r($editData["programone"]); exit; 
                                                $editDatas = explode(",", trim($editData["degree6"]));
                                                ?>
                                                <?php
                                                if (!empty($editDatas[1])) {
                                                    echo element($editDatas[1], getEducationProgramType(), null);
                                                }
                                                ?>                               
                                            </td>
                                            <td> 
    <?php echo $editDatas[2]; ?>
                                            </td>
                                            <td>
    <?php echo $editDatas[3]; ?>
                                            </td> 
                                            <td>
    <?php echo $editDatas[4]; ?>
                                            </td>
                                            <td>
                                        <?php echo $editDatas[5]; ?>
                                            </td>
                                        </tr>
    <?php
}
?>

                                </table>
                            </div>

                        </div><!-- /.span -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-header">
                                Employment Information
                            </div>
                            <div>
                                <table  class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                
                                            <th>Department </th>
                                            <th>Designation </th>
                                            <th>Employee Type </th>   
                                            <th>Employment Status</th>
                                            <th>Index No</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td> <?php
                                                if (!empty($editData['departmentId'])) {
                                                    echo getDepartmentName($editData['departmentId']);
                                                }
                                                ?> 
                                            </td>  
                                            <td>      <?php
                                                if (!empty($editData['designation'])) {
                                                    echo " " . element($editData['designation'], getdesignation(), Null) . "";
                                                }
                                                ?></td> 
                                            <td> <?php
                                                if (!empty($editData['employeeType'])) {
                                                    echo " " . element($editData['employeeType'], getmployeetypeList(), Null) . "";
                                                }
                                                ?>  </td> 
                                            <td>  <?php
                                                if (!empty($editData['employmentStatus'])) {
                                                    echo " " . element($editData['employmentStatus'], getemployeestatusList(), Null) . "";
                                                }
                                                ?> </td> 
                                             <td> 
                                                <?php if (!empty($editData['indexno'])) {
                                                    echo ($editData['indexno']);
                                                } ?> 
                                             </td>   


                                        </tr>
                                      

                                    </tbody>
                                </table>
                            </div>

                        </div><!-- /.span -->
                    </div><!-- /.row -->


                    <p>
<?php
$username = $this->session->userdata('emp_userName');
?>
                        <a href="<?php echo teacher_Url(); ?>/teacher/editteacher"> <button class="btn btn-primary">Edit Your Information</button>  </a>
                    </p>     



                </div>
            </div>
           </div>
                   </div>
            </div>
           </div>
