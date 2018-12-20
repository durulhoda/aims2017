<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">

            <!-- /Content Section  -->                    
            <div class="page-header">
                <h1>
                    Student Information
                    <small class="red">
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Student Profile
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
                                                        <img width="150" height="160" src="<?php echo base_url()  . $editData['photo'] ?>" />
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

                                    <div class="width-100 label label-info label-xlg arrowed-in arrowed-in-right">
                                        <div class="inline position-relative">
                                            <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
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
                                            <form action="<?php echo student_Url(); ?>/student/updatestudent_photo" method="post" enctype="multipart/form-data">
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
                                                                <input type="hidden" name="applicationId" value="<?php echo $editData["applicationId"]; ?>">
                                                                <input name="photo" value="<?php echo set_value("photo"); ?>" type="file" id="id-input-file-2" />
                                                                <span class="middle pink">>> </span><br>
                                                                <span class="middle red">Maintain Image size with-200*200 Format (png/jpg/gif)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer wizard-actions">

                                                    <button name="btnSubmit" class="btn btn-success btn-sm btn-next" data-last="Finish">
                                                        Update Photo
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
                                        <span class="editable" id="username"><?php echo $editData["studentId"]; ?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Admission Date </div>

                                    <div class="profile-info-value">
                                        <span class="editable" id="signup"><?php echo $editData["admissionDate"]; ?></span>
                                    </div>
                                </div>                                
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Phone</div>

                                    <div class="profile-info-value">
                                        <span class="editable" id="login"><?php echo $editData["phone"]; ?></span>
                                    </div>
                                </div>
                                
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Gender </div>

                                    <div class="profile-info-value">
                                        <span class="editable" id="signup"><?php echo element($editData["gender"], getSex(), NULL); ?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Religion </div>

                                    <div class="profile-info-value">
                                        <span class="editable" id="signup"><?php echo element($editData["religion"], getReligion(), NULL); ?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Blood Group </div>

                                    <div class="profile-info-value">
                                        <span class="editable" id="signup"><?php echo element($editData["bloodGroup"], getBloodGroup(), NULL); ?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Birth Date </div>

                                    <div class="profile-info-value">
                                        <span class="editable" id="signup"><?php if(!empty($editData["dateOfBirth"])){ echo $editData["dateOfBirth"];} ?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Birth Registration Number </div>

                                    <div class="profile-info-value">
                                        <span class="editable" id="signup"><?php if(!empty($editData["sbreg"])){ echo ($editData["sbreg"]);} ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-header">
                                    Guardians Information
                                </div>
                                <div>
                                    <table  class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>                                
                                                <th>Father Contact </th>
                                                <th>Mother Contact </th>
                                                <th>Legal Guardian</th>   
                                              
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr>
                                                <td>  <?php
                                                    if (!empty($editData["fatherName"])) {
                                                        echo $editData["fatherName"] . "<br>" . $editData["fatherPhone"];
                                                        echo element($editData["fatherProfession"], getProfession(), NULL);
                                                    }
                                                    ?>
                                                </td> 
                                                <td>  <?php if (!empty($editData["motherName"])) {
                                                        echo $editData["motherName"] . "<br>" . $editData["motherPhone"];
                                                        echo element($editData["motherProfession"], getProfession(), NULL);
                                                    } ?></td> 

                                                <td>  <?php
                                                    if (!empty($editData["legalGardianName"])) {
                                                        echo $editData["legalGardianName"] . "<br>" . $editData["legalGardianPhone"]."<br>";
                                                        echo element($editData["legalGardianProfession"], getProfession(), NULL);
                                                        
                                                    }
                                                    ?>
                                                </td> 

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div><!-- /.span -->
                        </div><!-- /.row -->

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-header">
                                    Current Academic Information
                                </div>
                                <div>
                                    <table  class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>                                
                                                <th>Class </th>
                                                <th>Medium</th>
                                                <th>Shift</th>   
                                                <th>Group</th>
                                                <th>Section</th>
                                                <th>Session</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr>
                                                <td> <?php
                                                        if (!empty($editData['programId'])) {
                                                            echo getProgramName($editData['programId']);
                                                        }
                                                      ?> 
                                                </td>  
                                                <td> <?php
                                                        if (!empty($editData['mediumId'])) {
                                                            echo getmediumName($editData['mediumId']);
                                                        }
                                                      ?> 
                                                </td>
                                                <td> <?php
                                                        if (!empty($editData['shiftId'])) {
                                                            echo getshiftName($editData['shiftId']);
                                                        }
                                                      ?> 
                                                </td>
                                                <td> <?php
                                                        if (!empty($editData['groupId'])) {
                                                            echo getGroupName($editData['groupId']);
                                                        }
                                                      ?> 
                                                </td>
                                                <td> <?php
                                                        if (!empty($editData['sectionId'])) {
                                                            echo getsectionName($editData['sectionId']);
                                                        }
                                                      ?> 
                                                </td>
                                                <td> <?php
                                                        if (!empty($editData['sessionId'])) {
                                                            echo getSessionName($editData['sessionId']);
                                                        }
                                                      ?> 
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
                            <a href="<?php echo student_Url(); ?>/student/editstudent/<?php echo $editData['studentId']; ?>"> <button class="btn btn-primary">Edit Your Information</button>  </a>
                        </p>     



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
