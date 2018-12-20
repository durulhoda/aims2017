<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Applicant Registration Slip
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Print This Slip For Confirm Registration
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="page-header">
                    <button class="btn btn-success btn-xlg" onclick="printDiv('printableArea')">
                        Print Slip
                        <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                    </button>           
        </div>    
        <div class="col-xs-8 col-sm-offset-1" id="printableArea">
            <div class="col-xs-12">
                <div class="center alert alert-success">
                    <?php
                            $ins_name=  getInstituteName();
                            
                            if(!empty($ins_name))
                            {
                                echo "<span class=\"bigger-150\">".$ins_name."</span><br>";
                                echo "Student Registration Slip";
                            }
                            else{ echo "<span class=\"bigger-150\">AIMS Institute Management System</span>"; }
                       ?>
                  
                </div>
            </div>
            <div class="hr hr2 hr-double"></div>
            <div class="space"></div> 
            <div id="user-profile-1" class="user-profile">
                <div class="col-xs-3 col-sm-3">
                    <div>
                        <span class="profile-picture">
                            <img id="avatar" class="editable img-responsive" alt="Applicant Information" src="<?php echo base_url()."/".$editData['photo']?>" width="150" height="160" />
                        </span>
                    </div>
                </div>    
                <div class="col-xs-9 col-sm-9">  
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Applicant Name </div>

                            <div class="profile-info-value">
                                <span id="username"><b> <?php echo $editData["firstName"] ; ?> </b></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Applicant Id </div>

                            <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                <span id="country"><b><?php echo $editData["applicationId"]; ?></b></span>
                               
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Birth Date</div>

                            <div class="profile-info-value">
                                <span id="age"> <?php echo $editData["dateOfBirth"]; ?> </span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Gender </div>

                            <div class="profile-info-value">
                                <span id="login"> <?php echo element($editData["gender"], getGendar());// echo $editData["gender"]; ?> </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Father Name </div>

                            <div class="profile-info-value">
                                <span id="signup"> <?php echo $editData["fatherName"]; ?> </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Father Phone </div>

                            <div class="profile-info-value">
                                <span id="login"> <?php echo $editData["fatherPhone"]; ?> </span>
                            </div>
                        </div>

       
                    </div>
                   <div class="space"></div> 
                </div>
                <div class="clearfix">
                 
                    <div class="grid5">
                        <span class="bigger-30 green">Class</span>

                        <br />
                        <span class="bigger-60">
                            <?php if(!empty($enrollData['programId'])){ echo getProgramName($enrollData['programId']);}?>
                        </span>
                    </div>

                    <div class="grid5">
                        <span class="bigger-30 green">Medium</span>

                        <br />
                        <span class="bigger-60">
                            <?php if(!empty($enrollData['mediumId'])){ echo getmediumName($enrollData['mediumId']);}?>
                        </span>
                        
                    </div>
                    <div class="grid5">
                        <span class="bigger-30 green">Group</span>

                        <br />
                        <span class="bigger-60">
                            <?php if(!empty($enrollData['groupId'])){ echo getGroupName($enrollData['groupId']);}?>
                        </span>
                        
                    </div>

                    <div class="grid5">
                        <span class="bigger-30 green">Shift</span>

                        <br />
                        <span class="bigger-60">
                            <?php if(!empty($enrollData['shiftId'])) {echo getshiftName($enrollData['shiftId']);}?>
                        </span>
                        
                    </div>
                    <div class="grid5">
                        <span class="bigger-30 green">Session</span>

                        <br />
                        <span class="bigger-60">
                            <?php if(!empty($enrollData['sessionId'])) {echo getSessionName($enrollData['sessionId']);}?>
                        </span>
                        
                    </div>
                                                    
                </div>
                <div class="hr hr2 hr-double"></div>
              </div>    
           
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
    
    
    
    
    
    
    
    
    