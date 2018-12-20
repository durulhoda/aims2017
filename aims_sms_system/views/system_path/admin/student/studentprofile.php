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
    if (!empty($editData)) { ?>
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
                                    <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php
                                    if (file_exists($editData['photo'])) {
                                        echo base_url() . $editData['photo'];
                                    } else {
                                        echo base_url() . "uploads/default/default.png";
                                    }
                                    ?>"  width="180" height="200"/>
                                         <?php
                                     }
                                     ?>

                            </span>
                        </div>

                        <div>

                            <div class="col-sm-12 widget-container-col">
                                <div class="widget-box">
                                    <div class="widget-header widget-header-small">
                                        <h5 class="widget-title smaller">ID:</h5><font color="red">   <?php
                                        if (!empty($editData['studentId'])) {
                                            echo $editData['studentId'];
                                        }
                                        ?></font>

                                    </div>
                                    <div class="widget-header widget-header-small">
                                        <h5 class="widget-title smaller">Name:</h5><font color="red"> <?php
                                        if (!empty($editData['firstName'])) {
                                            echo $editData['firstName'];
                                        }
                                        ?></font>

                                    </div>

                                    <div class="widget-header widget-header-small">
                                        <h5 class="widget-title smaller">Gender:</h5><font color="red"> <?php
                                        if (!empty($editData["gender"])) {
                                            echo element($editData["gender"], getGendar(), Null);
                                        }
                                        ?></font>

                                    </div>

                                </div>
                            </div> 
                        </div> 

                    </div> <!-- end column -->
                    <div class="col-sm-9 widget-container-col">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h5 class="widget-title smaller">Current Enrollment Information of <font color="#d15b47"><?php echo $editData['firstName'] ?></font></h5>

                            </div>
                            <div>

                                <div class="row">

                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="row">
                                            <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                                <b> Current Enrollment Information</b>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <div>
                                                <ul class="list-unstyled spaced">
                                                    <li>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                                        <?php
                                                        echo "<b>" . getSessionName($editData['sessionId']) . "</b>";
                                                        ?>
                                                    </li>

                                                    <li>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                                        <?php
                                                        echo "<b>" . getProgramName($editData['programId']) . "</b>";
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                                        <?php
                                                        echo "<b>" . getmediumName($editData['mediumId']) . "</b>";
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>   
                                        <div class="col-xs-12 col-sm-6">
                                            <div>
                                                <ul class="list-unstyled spaced">


                                                    <li>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                                        <?php
                                                        echo "<b>" . getGroupName($editData['groupId']) . "</b>";
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                                                        <?php
                                                        echo "<b>" . getsectionName($editData['sectionId']) . "</b>";
                                                        ?>
                                                    </li>

                                                    <li>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                                        <?php
                                                        echo "<b>" . getshiftName($editData['shiftId']) . "</b>";
                                                        ?>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>   
                                    </div><!-- /.col -->


                                </div><!-- /.row -->
                            </div>
                        </div>
                    </div>  <!-- end column -->

                    <div class="col-sm-9 widget-container-col">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h5 class="widget-title smaller">Student Details</h5>

                                <div class="widget-toolbar no-border">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active">
                                            <a data-toggle="tab" href="#p_info">Personal Information</a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#g_info">Academic Information</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#pai_info">Previous Academic Information</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#c_info">Financial Information</a>
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
                                                        <span class="editable" id="country"><?php
                                                            if (!empty($editData['firstName'])) {
                                                                echo $editData['firstName'] . " " . $editData['middleName'] . " " . $editData['lastName'];
                                                            }
                                                            ?></span>

                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Date of Birth </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="age"><?php
                                                            if (!empty($editData["dateOfBirth"])) {
                                                                echo $editData["dateOfBirth"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Birth Registration No. </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="signup"><?php
                                                            if (!empty($editData["sbreg"])) {
                                                                echo $editData["sbreg"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Gender </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login"><?php
                                                            if (!empty($editData["gender"])) {
                                                                echo element($editData["gender"], getGendar(), Null);
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Quota </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">
                                                            <?php echo ((int)$editData["quata_id"] == 2) ? "    
General" : "Freedom Fighter Family"; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Nationality </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login"><?php
                                                            if (!empty($editData["nationality"])) {
                                                                echo element($editData["nationality"], getCountryName(), Null);
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Religion </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login"><?php
                                                            if (!empty($editData["religion"])) {
                                                                echo element($editData["religion"], getReligion(), Null);
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Blood Group </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login"><?php
                                                            if (!empty($editData["bloodGroup"])) {
                                                                echo element($editData["bloodGroup"], getBloodGroup(), Null);
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> National ID </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login"><?php
                                                            if (!empty($editData["snId"])) {
                                                                echo $editData["snId"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <h5 class="alert alert-block alert-success">Guardian Information</h5>
                                            <div class="profile-user-info profile-user-info-striped">
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Father Name </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="username"><?php
                                                            if (!empty($editData["fatherName"])) {
                                                                echo $editData["fatherName"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Phone Number </div>

                                                    <div class="profile-info-value">                                         
                                                        <span class="editable" id="country"><?php
                                                            if (!empty($editData["fatherPhone"])) {
                                                                echo $editData["fatherPhone"];
                                                            }
                                                            ?></span>

                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Profession </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="age"><?php
                                                            if (!empty($editData["fatherProfession"])) {
                                                                echo element($editData["fatherProfession"], getProfession(), Null);
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> National ID </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="signup"><?php
                                                            if (!empty($editData["fnid"])) {
                                                                echo $editData["fnid"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Mother Name </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="username"><?php
                                                            if (!empty($editData["motherName"])) {
                                                                echo $editData["motherName"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Phone Number </div>

                                                    <div class="profile-info-value">                                         
                                                        <span class="editable" id="country"><?php
                                                            if (!empty($editData["motherPhone"])) {
                                                                echo $editData["motherPhone"];
                                                            }
                                                            ?></span>

                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Profession </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="age"><?php
                                                            if (!empty($editData["motherProfession"])) {
                                                                echo element($editData["motherProfession"], getProfession(), Null);
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> National ID </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="signup"><?php
                                                            if (!empty($editData["mnid"])) {
                                                                echo $editData["mnid"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Legal Guardian Name </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="username"><?php
                                                            if (!empty($editData["legalGardianName"])) {
                                                                echo $editData["legalGardianName"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Phone Number </div>

                                                    <div class="profile-info-value">                                         
                                                        <span class="editable" id="country"><?php
                                                            if (!empty($editData["legalGardianPhone"])) {
                                                                echo $editData["legalGardianPhone"];
                                                            }
                                                            ?></span>

                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Profession </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="age"><?php
                                                            if (!empty($editData["legalGardianProfession"])) {
                                                                echo element($editData["legalGardianProfession"], getProfession(), Null);
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> National ID </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="signup"><?php
                                                            if (!empty($editData["lgnid"])) {
                                                                echo $editData["lgnid"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="alert alert-block alert-success">Contact Information</h5>
                                            <div class="profile-user-info profile-user-info-striped">

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Phone Number </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="username"><?php
                                                            if (!empty($editData["phone"])) {
                                                                echo $editData["phone"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Email </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="country"><?php
                                                            if (!empty($editData["email"])) {
                                                                echo $editData["email"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Present Address </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="age"><?php
                                                            if (!empty($editData["presentAddress"])) {
                                                                echo $editData["presentAddress"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Permanent Address </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="signup"><?php
                                                            if (!empty($editData["permanentAddress"])) {
                                                                echo $editData["permanentAddress"];
                                                            }
                                                            ?></span>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div><!-- end p_info -->
                                        <div id="g_info" class="tab-pane">
                                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/Student/searchresults" enctype="multipart/form-data" method="post" target="_blank">

                                                <div class="profile-user-info profile-user-info-striped">


                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name">Semester</div>

                                                        <select name="data[semesterId]" required="1" class="form-control" >
                                                            <option value="">Select</option>
                                                            <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                                                <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('semesterId', $velues['semesterId'], FALSE) ?>><?php echo $velues['semester'] ?></option>
                                                            <?php } ?>
                                                        </select>   
                                                    </div>

                                                    <br>



                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name">Class</div>
                                                        <?php $studentId = $editData['studentId']; ?>

                                                        <select  data-placeholder="Select" name="data[programOfferId]"  required="1" class="form-control">
                                                            <option value="">Select</option>
                                                            <?php foreach (getStudent_all_Class($studentId) as $value) { ?>
                                                                <option value="<?php echo $value['programOfferId']; ?>" 
                                                                        <?php echo set_select('data[programOfferId]', $value['programOfferId'], FALSE) ?> >
                                                                    <?php echo getProgramName($value['programId']); ?></option>                                                
                                                            <?php } ?>
                                                        </select>
                                                    </div> 

                                                </div>  
                                                <div class="col-xs-12">
                                                    <div class="clearfix form-actions">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-success" type="submit" name="search">
                                                                <i class="ace-icon fa fa-check bigger-110"></i> Show Result
                                                            </button>
                                                            <input type="hidden" name="data[studentId]" value="<?php
                                                            if (!empty($editData['studentId'])) {
                                                                echo $editData['studentId'];
                                                            }
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div> <br><br><br><br><br>
                                            </form>    
                                        </div> <!-- end g_info -->

                                        <div id="pai_info" class="tab-pane in">
                                            <div class="profile-user-info profile-user-info-striped">


                                                <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                Examination
                                                            </th>

                                                            <th class="center">Roll</th>
                                                            <th class="center">Registration</th>
                                                            <th class="center">Board</th>
                                                            <th class="center">GPA</th>
                                                            <th class="center">Passing Year</th>


                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    if (!empty($prevaccInfo)) {
                                                        ?>

                                                        <tbody>
                                                            <?php
                                                            $sl = 1;
                                                            foreach ($prevaccInfo as $value) {
                                                                ?>

                                                                <tr>
                                                                    <td class="center">

                                                                        <?php
                                                                        if (!empty($value['category'])) {
                                                                            echo element($value['category'], getprevcatInfo(), Null);
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td class="center">
                                                                        <?php
                                                                        if ($value['roll']) {
                                                                            echo $value['roll'];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="center">
                                                                        <?php
                                                                        if ($value['thana_registration']) {
                                                                            echo $value['thana_registration'];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="center">

                                                                        <?php
                                                                        if (!empty($value['board'])) {
                                                                            echo element($value['board'], getBoardInfo(), Null);
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="center">
                                                                        <?php
                                                                        if ($value['gpa']) {
                                                                            echo $value['gpa'];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="center">
                                                                        <?php
                                                                        if ($value['passing_year']) {
                                                                            echo $value['passing_year'];
                                                                        }
                                                                        ?>
                                                                    </td>


                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    <?php } ?>                </table>




                                            </div>
                                        </div>  <!-- end pai_info -->
                                        <div id="c_info" class="tab-pane">
                                            <div class="profile-user-info profile-user-info-striped">
                                                <div class="profile-info-row">

                                                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr> 
                                                                <th>Summery</th>

                                                                <th>Amount</th>

                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr>



                                                                <td >Payable Amount :</td> 


                                                                <td>
                                                                    <?php
                                                                    if (!empty($fineamount)) {
                                                                        echo $totalpayable = $totalfees + $fineamount;
                                                                    } else {
                                                                        echo $totalpayable = $totalfees;
                                                                    }
                                                                    ?>        
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td >Paid Amount :</td> 
                                                                <td><?php echo $totalamount; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Due :</td>
                                                                <td><font color="red"><?php echo $totalpayable - $totalamount; ?></font></td>





                                                            </tr>


                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <form action="<?php echo admin_Url(); ?>/paymentadd/searchpaymentlist" method="post">
                                                <div style="float:right; padding: 10px;">
                                                    <button class="btn btn-sm btn-yellow">View Details</button><br>
                                                    <input type="hidden" name="data[studentId]" value="<?php
                                                    if (!empty($editData['studentId'])) {
                                                        echo $editData['studentId'];
                                                    }
                                                    ?>">
                                                </div>
                                            </form><br>
                                        </div><br><!-- end c_info -->

                                    </div>
                                </div>
                            </div> <!-- end widget-body -->
                        </div>
                    </div> <!-- end column -->

                    <div class="space-10"></div>
                    <div class="row hidden" >
                        <div class="alert alert-block alert-success center">
                            <?php
                            $ins_name = getInstituteName();
                            if (!empty($ins_name)) {
                                echo "<strong class=\"green\">" . $ins_name . "</strong>";
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
                                        <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php
                                        if (file_exists($editData['photo'])) {
                                            echo base_url() . $editData['photo'];
                                        } else {
                                            echo base_url() . "uploads/default/default.png";
                                        }
                                        ?>"  width="120" height="140"/>
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
                                            <span class="editable" id="age"><?php
                                                if (!empty($editData["dateOfBirth"])) {
                                                    echo $editData["dateOfBirth"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Birth Registration No. </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="signup"><?php
                                                if (!empty($editData["sbreg"])) {
                                                    echo $editData["sbreg"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Gender </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="login"><?php
                                                if (!empty($editData["gender"])) {
                                                    echo element($editData["gender"], getGendar(), Null);
                                                }
                                                ?></span>
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
                                            <span class="editable" id="login"><?php
                                                if (!empty($editData["bloodGroup"])) {
                                                    echo element($editData["bloodGroup"], getBloodGroup(), Null);
                                                }
                                                ?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> National ID </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="login"><?php
                                                if (!empty($editData["snId"])) {
                                                    echo $editData["snId"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Phone Number </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="username"><?php
                                                if (!empty($editData["phone"])) {
                                                    echo $editData["phone"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Email </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="country"><?php
                                                if (!empty($editData["email"])) {
                                                    echo $editData["email"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Present Address </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="age"><?php
                                                if (!empty($editData["presentAddress"])) {
                                                    echo $editData["presentAddress"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Permanent Address </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="signup"><?php
                                                if (!empty($editData["permanentAddress"])) {
                                                    echo $editData["permanentAddress"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>   
                    <div class="space-10"></div>
                    <div class="row hidden">

                        <div class="col-xs-12 col-sm-12">

                            <div class="col-sm-4">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Father Name </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="username"><?php
                                                if (!empty($editData["fatherName"])) {
                                                    echo $editData["fatherName"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Phone Number </div>

                                        <div class="profile-info-value">                                         
                                            <span class="editable" id="country"><?php
                                                if (!empty($editData["fatherPhone"])) {
                                                    echo $editData["fatherPhone"];
                                                }
                                                ?></span>

                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Profession </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="age"><?php
                                                if (!empty($editData["fatherProfession"])) {
                                                    echo element($editData["fatherProfession"], getProfession(), Null);
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> National ID </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="signup"><?php
                                                if (!empty($editData["fnid"])) {
                                                    echo $editData["fnid"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-sm-4">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Mother Name </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="username"><?php
                                                if (!empty($editData["motherName"])) {
                                                    echo $editData["motherName"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Phone Number </div>

                                        <div class="profile-info-value">                                         
                                            <span class="editable" id="country"><?php
                                                if (!empty($editData["motherPhone"])) {
                                                    echo $editData["motherPhone"];
                                                }
                                                ?></span>

                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Profession </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="age"><?php
                                                if (!empty($editData["motherProfession"])) {
                                                    echo element($editData["motherProfession"], getProfession(), Null);
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> National ID </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="signup"><?php
                                                if (!empty($editData["mnid"])) {
                                                    echo $editData["mnid"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-4">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Legal Guardian Name </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="username"><?php
                                                if (!empty($editData["legalGardianName"])) {
                                                    echo $editData["legalGardianName"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Phone Number </div>

                                        <div class="profile-info-value">                                         
                                            <span class="editable" id="country"><?php
                                                if (!empty($editData["legalGardianPhone"])) {
                                                    echo $editData["legalGardianPhone"];
                                                }
                                                ?></span>

                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> Profession </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="age"><?php
                                                if (!empty($editData["legalGardianProfession"])) {
                                                    echo element($editData["legalGardianProfession"], getProfession(), Null);
                                                }
                                                ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-nameless"> National ID </div>

                                        <div class="profile-info-value">
                                            <span class="editable" id="signup"><?php
                                                if (!empty($editData["lgnid"])) {
                                                    echo $editData["lgnid"];
                                                }
                                                ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                        </div>  
                    </div>  


                </div> <!-- end row -->
            </div>
        </div> 
     <?php } ?>
</div>