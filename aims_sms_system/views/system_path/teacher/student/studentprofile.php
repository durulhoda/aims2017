    <div class="row">
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
        
        <?php
                if (!empty($editData)) {
            ?>
        
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                            Student Profile
                        </h3>
                    </div>
                    <div class="space-4"></div>
                <div class="row">
                        <div class="col-xs-12 col-sm-3 center">
                                <div>
                                    <span class="profile-picture">
                                        <?php
                                                if ($editData['photo']) {
                                            ?>
                                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php if (file_exists($editData['photo'])) { echo base_url() . $editData['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>"  width="180" height="200"/>
                                        <?php 
                                        
                                            } 
                                          ?>
                                        
                                    </span>
                                </div>
                        </div>    
                        <div class="col-sm-9 widget-container-col">
                            <div class="widget-box">
                                <div class="widget-header widget-header-small">
                                    <h5 class="widget-title smaller">Student Profile</h5>

                                    <div class="widget-toolbar no-border">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <li class="active">
                                                <a data-toggle="tab" href="#p_info">Personal Information</a>
                                            </li>

                                            <li>
                                                <a data-toggle="tab" href="#g_info">Guardian Information</a>
                                            </li>

                                            <li>
                                                <a data-toggle="tab" href="#c_info">Contact Information</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main padding-6">
                                        <div class="tab-content">
                                            <div id="p_info" class="tab-pane in active">
                                                <div class="profile-user-info profile-user-info-striped">
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> ID </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="username">
                                                                    <?php
                                                                        if (!empty($editData['studentId'])) {
                                                                            echo $editData['studentId'];
                                                                        }
                                                                      ?>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Name </div>

                                                            <div class="profile-info-value">                                                               
                                                                <span class="editable" id="country"><?php if (!empty($editData['firstName'])) { echo $editData['firstName'] . " " . $editData['middleName'] . " " . $editData['lastName']; } ?></span>
                                                              
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Date of Birth </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="age"><?php if(!empty($editData["dateOfBirth"])){ echo $editData["dateOfBirth"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Birth Registration No. </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="signup"><?php if(!empty($editData["sbreg"])){ echo $editData["sbreg"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Gender </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="login"><?php if(!empty($editData["gender"])){ echo element($editData["gender"],getGendar(),Null); } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Nationality </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="login"><?php if(!empty($editData["nationality"])){ echo element($editData["nationality"],getCountryName(),Null); } ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Religion </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="login"><?php if(!empty($editData["religion"])){ echo element($editData["religion"],getReligion(),Null); } ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Blood Group </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="login"><?php if(!empty($editData["bloodGroup"])){ echo element($editData["bloodGroup"],getBloodGroup(),Null); } ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> National ID </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="login"><?php if(!empty($editData["snId"])){ echo $editData["snId"]; } ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div id="g_info" class="tab-pane">
                                                <div class="profile-user-info profile-user-info-striped">
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Father Name </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="username"><?php if(!empty($editData["fatherName"])){ echo $editData["fatherName"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Phone Number </div>

                                                            <div class="profile-info-value">                                         
                                                                <span class="editable" id="country"><?php if(!empty($editData["fatherPhone"])){ echo $editData["fatherPhone"]; } ?></span>
                                                      
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Profession </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="age"><?php if(!empty($editData["fatherProfession"])){ echo element($editData["fatherProfession"],getProfession(),Null); } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> National ID </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="signup"><?php if(!empty($editData["fnid"])){ echo $editData["fnid"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Mother Name </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="username"><?php if(!empty($editData["motherName"])){ echo $editData["motherName"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Phone Number </div>

                                                            <div class="profile-info-value">                                         
                                                                <span class="editable" id="country"><?php if(!empty($editData["motherPhone"])){ echo $editData["motherPhone"]; } ?></span>
                                                      
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Profession </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="age"><?php if(!empty($editData["motherProfession"])){ echo element($editData["motherProfession"],getProfession(),Null); } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> National ID </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="signup"><?php if(!empty($editData["mnid"])){ echo $editData["mnid"]; } ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Legal Guardian Name </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="username"><?php if(!empty($editData["legalGardianName"])){ echo $editData["legalGardianName"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Phone Number </div>

                                                            <div class="profile-info-value">                                         
                                                                <span class="editable" id="country"><?php if(!empty($editData["legalGardianPhone"])){ echo $editData["legalGardianPhone"]; } ?></span>
                                                      
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Profession </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="age"><?php if(!empty($editData["legalGardianProfession"])){ echo element($editData["legalGardianProfession"],getProfession(),Null); } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> National ID </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="signup"><?php if(!empty($editData["lgnid"])){ echo $editData["lgnid"]; } ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div id="c_info" class="tab-pane">
                                                <div class="profile-user-info profile-user-info-striped">
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Phone Number </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="username"><?php if(!empty($editData["phone"])){ echo $editData["phone"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Email </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="country"><?php if(!empty($editData["email"])){ echo $editData["email"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Present Address </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="age"><?php if(!empty($editData["presentAddress"])){ echo $editData["presentAddress"]; } ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Permanent Address </div>

                                                            <div class="profile-info-value">
                                                                <span class="editable" id="signup"><?php if(!empty($editData["permanentAddress"])){ echo $editData["permanentAddress"]; } ?></span>
                                                            </div>
                                                        </div>

                                                       
                                                    </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                     <div class="space-10"></div>
                    <div class="row">
                        <div class="alert alert-block alert-success center">
                              <?php
                                    $ins_name=  getInstituteName();
                                    if(!empty($ins_name))
                                        {
                                            echo "<strong class=\"green\">".$ins_name."</strong>";
                                            echo "<br><small class=\"green\">Student Profile</small>";
                                        }
                                ?>
                               
                            </div>
                        <div class="col-xs-12 col-sm-2 center">
                                <div>
                                    <span class="profile-picture">
                                        <?php
                                                if ($editData['photo']) {
                                            ?>
                                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php if (file_exists($editData['photo'])) { echo base_url() . $editData['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>"  width="120" height="140"/>
                                        <?php 
                                        
                                            } 
                                          ?>
                                        
                                    </span>
                                    <div class="space-4"></div>
                                    <div class="width-80 label label-danger label-xlg arrowed-in arrowed-in-right">
					<div class="inline position-relative">
                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                            <span class="white">Alex M. Doe</span>
                                        </a>	
                                      </div>
                                    </div>        
                                </div>
                        </div>    
                        <div class="col-xs-12 col-sm-10">
                            
                            <div class="col-sm-6">
                                <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> ID </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="username">
                                                    <?php
                                                    if (!empty($editData['studentId'])) {
                                                        echo $editData['studentId'];
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>                                        
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Date of Birth </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="age"><?php if (!empty($editData["dateOfBirth"])) {
                                                    echo $editData["dateOfBirth"];
                                                } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Birth Registration No. </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="signup"><?php if (!empty($editData["sbreg"])) {
                                                    echo $editData["sbreg"];
                                                } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Gender </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="login"><?php if (!empty($editData["gender"])) {
                                                    echo element($editData["gender"], getGendar(), Null);
                                                } ?></span>
                                            </div>
                                        </div>
                                    <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Nationality </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="login"><?php
                                                    if (!empty($editData["nationality"])) {
                                                        echo element($editData["nationality"], getCountryName(), Null);
                                                    }
                                                    ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Religion </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="login"><?php
                                                    if (!empty($editData["religion"])) {
                                                        echo element($editData["religion"], getReligion(), Null);
                                                    }
                                                    ?></span>
                                            </div>
                                        </div>
                                       
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="profile-user-info profile-user-info-striped">
                                                                                
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Blood Group </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="login"><?php if (!empty($editData["bloodGroup"])) {
                                                    echo element($editData["bloodGroup"], getBloodGroup(), Null);
                                                } ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> National ID </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="login"><?php if (!empty($editData["snId"])) {
                                                    echo $editData["snId"];
                                                } ?></span>
                                            </div>
                                        </div>
                                    <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Phone Number </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="username"><?php if (!empty($editData["phone"])) {
                                        echo $editData["phone"];
                                    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Email </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="country"><?php if (!empty($editData["email"])) {
                                        echo $editData["email"];
                                    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Present Address </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="age"><?php if (!empty($editData["presentAddress"])) {
                                        echo $editData["presentAddress"];
                                    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Permanent Address </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="signup"><?php if (!empty($editData["permanentAddress"])) {
                                        echo $editData["permanentAddress"];
                                    } ?></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>  
                    </div>   
                     <div class="space-10"></div>
                    <div class="row">
                            
                        <div class="col-xs-12 col-sm-12">
                            
                            <div class="col-sm-4">
                                <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Father Name </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="username"><?php if (!empty($editData["fatherName"])) {
        echo $editData["fatherName"];
    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Phone Number </div>

                                            <div class="profile-info-value">                                         
                                                <span class="editable" id="country"><?php if (!empty($editData["fatherPhone"])) {
        echo $editData["fatherPhone"];
    } ?></span>

                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Profession </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="age"><?php if (!empty($editData["fatherProfession"])) {
        echo element($editData["fatherProfession"], getProfession(), Null);
    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> National ID </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="signup"><?php if (!empty($editData["fnid"])) {
        echo $editData["fnid"];
    } ?></span>
                                            </div>
                                        </div>
                                </div>
                            </div>  
                                <div class="col-sm-4">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Mother Name </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="username"><?php if (!empty($editData["motherName"])) {
        echo $editData["motherName"];
    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Phone Number </div>

                                            <div class="profile-info-value">                                         
                                                <span class="editable" id="country"><?php if (!empty($editData["motherPhone"])) {
        echo $editData["motherPhone"];
    } ?></span>

                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Profession </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="age"><?php if (!empty($editData["motherProfession"])) {
        echo element($editData["motherProfession"], getProfession(), Null);
    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> National ID </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="signup"><?php if (!empty($editData["mnid"])) {
        echo $editData["mnid"];
    } ?></span>
                                            </div>
                                        </div>
                                      </div>  
                                </div>
                                <div class="col-sm-4">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Legal Guardian Name </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="username"><?php if (!empty($editData["legalGardianName"])) {
        echo $editData["legalGardianName"];
    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Phone Number </div>

                                            <div class="profile-info-value">                                         
                                                <span class="editable" id="country"><?php if (!empty($editData["legalGardianPhone"])) {
        echo $editData["legalGardianPhone"];
    } ?></span>

                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> Profession </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="age"><?php if (!empty($editData["legalGardianProfession"])) {
        echo element($editData["legalGardianProfession"], getProfession(), Null);
    } ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-nameless"> National ID </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="signup"><?php if (!empty($editData["lgnid"])) {
        echo $editData["lgnid"];
    } ?></span>
                                            </div>
                                        </div>
                                    </div>
                               </div>     
                        </div>  
                    </div>      
                        
                            
                        </div>

                        
                    </div>
            </div>    
           
            
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
    </div> <!-- /.row --> 
    
    
    
    
    
    
    
    
    
