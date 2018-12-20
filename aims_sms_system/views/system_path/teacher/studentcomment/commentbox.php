<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
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
              //  if (!empty($studentlist)) {
            ?>
            <div class="col-xs-12 col-sm-12">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                                        Student Activity 
                            <small class="red">
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                      Write Comment
                            </small>
                       </h3>         
                    </div>    
                </div> 
                <div class="row">
                    <form action="<?php echo teacher_Url()?>/studentcomment/insertcomment" method="post">
                       
                 
                           <div class="col-xs-12 col-sm-12">
   
                <div class="widget-header widget-header-large">
                    <h3 class="widget-title grey lighter">
                        <i class="ace-icon fa fa-exchange green"></i>
                        Student Profile
                    </h3>
                </div>
      
                    <div class="col-xs-12 col-sm-3 center">
                        <div>
                            <span class="profile-picture">
                                <?php
                                if ($editData['photo']) {
                                    ?>
                                    <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php if (file_exists($editData['photo'])) {
                                echo base_url() . $editData['photo'];
                            } else {
                                echo base_url() . "uploads/default/default.png";
                            } ?>"  width="180" height="200"/>
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
                                       <h5 class="widget-title smaller">Name:</h5><font color="red"> <?php if (!empty($editData['firstName'])) { echo $editData['firstName']; }?></font>

                                    </div>
                                    
                                        <div class="widget-header widget-header-small">
                                       <h5 class="widget-title smaller">Gender:</h5><font color="red"> <?php if (!empty($editData["gender"])) {
                                                            echo element($editData["gender"], getGendar(), Null);
                                                        } ?></font>

                                    </div>
           
                                </div>
                            </div> 
                        </div> 
                    </div>  



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
                                                       echo "<b>".getSessionName($editData['sessionId'])."</b>"; 
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
                        
                             <div class="col-xs-6 col-sm-5">
                            <textarea style="width: 788px; height: 150px;" name="data[comment]" class="form-control" id="form-field-8" placeholder="Write Your Comment About <?php echo $editData['firstName'] ?>"></textarea>
                              <div class="space-10"></div>  
                              <input type="hidden" value="<?php echo $editData['studentId']?>" name="data[studentId]">
                               <input type="hidden" value="<?php echo $editData['programOfferId']?>" name="data[programOfferId]">
                              <input type="hidden" value="2" name="data[approvestatus]">
                              <input type="hidden" value="<?php echo $editData["employeeId"]; ?>" name="data[employeeId]">
                              
                              
                              <input class="btn btn-sm btn-success" type="submit" value="Submit Your Comment" />
                        </div>
                    </div>
                        </div> 
                                          
                   
                    </form>   
          

                </div><!-- PAGE CONTENT ENDS -->
            </div><!-- /.col-x12 -->
         
                
         <?php
       //     }
        ?>
        
    
    
</div> <!-- /.row --> 


