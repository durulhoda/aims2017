<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Confirm Applicant Registration
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Must Be confirm Selected Applicant
            </small>
        </h1>
    </div><!-- /.page-header -->
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-quote-left smaller-80"></i>
                    Student Short Profile
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote class="pull-left">
                                <span class="green">
                                    <i class="ace-icon fa fa-user"></i>&nbsp;
                                    <?php if(!empty($studentlist['firstName'])){ echo $studentlist['firstName'];} ?></span>
                                <small>  
                                    Applicant Id: 
                                    <cite title="Applicant Gender" class="red bolder"> <?php echo ($studentlist['applicationId']); ?> </cite>                                    
                                </small>
                                <small>  
                                    Registration Date:
                                    <cite title="Registration Date" class="lighter red"> <?php echo date('d F Y', strtotime(date($studentlist['admissionDate'], strtotime($studentlist['admissionDate'])))); ?> </cite>                                    
                                </small>
                                <?php if(!empty($studentlist['gender'])){ ?>
                                    <small>  
                                        Gender:
                                        <cite title="Applicant Gender" class="lighter red"> <?php echo element($studentlist['gender'],getGendar(),Null); ?> </cite>                                    
                                    </small>
                                <?php } ?>
                                
                                <?php if(!empty($studentlist['dateOfBirth'])){ ?>
                                    <small>    
                                        Birth Date:
                                        <cite title="Applicant Birth Date" class="lighter red"> <?php echo date('d F Y', strtotime(date($studentlist['dateOfBirth'], strtotime($studentlist['dateOfBirth'])))); ?> </cite>                                    
                                    </small>
                                <?php } ?>    
                               
                            </blockquote>
                            <blockquote class="pull-right">
                                <?php
                                     if ($studentlist['photo']) {
                                  ?>
                                     <img  src="<?php if (file_exists($studentlist['photo'])) { echo base_url() . $studentlist['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="100">
                                 <?php 
                                        } 
                                 ?>
                                
                            </blockquote>
                            
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote class="pull-left">
                                 <span class='lighter red'><i class="ace-icon fa fa-male"></i> Father Information </span>
                                <p>
                                   <span class="bolder blue"><?php if(!empty($studentlist['fatherName'])){ echo $studentlist['fatherName'];} ?></span>
                                </p>
                                <?php if(!empty($studentlist['fatherPhone'])){ ?>
                                    <small>        
                                        <span class="red"> Contact: </span>
                                        <cite title="Applicant Father Phone"> <?php echo $studentlist['fatherPhone']; ?> </cite>                                    
                                    </small>
                                <?php } ?> 
                                <?php if(!empty($studentlist['fatherProfession'])){ ?>
                                    <small>            
                                       <span class="red"> Profession: </span>
                                        <cite title="Applicant Father Profession"> <?php echo element($studentlist['fatherProfession'],  getProfession(), Null); ?> </cite>                                    
                                    </small>
                                <?php } ?> 
                               
                            </blockquote>
                            <blockquote class="pull-right">    
                               <span class='lighter red'><i class="ace-icon fa fa-female"></i> Mother Information </span>
                                <p>
                                   <span class="bolder blue"><?php if(!empty($studentlist['motherName'])){ echo $studentlist['motherName'];} ?></span>
                                </p>
                                <?php if(!empty($studentlist['motherPhone'])){ ?>
                                    <small>        
                                        <span class="red"> Contact: </span>
                                        <cite title="Applicant Mother Phone"> <?php echo $studentlist['motherPhone']; ?> </cite>                                    
                                    </small>
                                <?php } ?> 
                                <?php if(!empty($studentlist['motherProfession'])){ ?>
                                    <small>            
                                       <span class="red"> Profession: </span>
                                        <cite title="Applicant Mother Profession"> <?php echo element($studentlist['motherProfession'],  getProfession(), Null); ?> </cite>                                    
                                    </small>
                                <?php } ?> 
                               
                            </blockquote>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">       

        <div class="row">
            <div class="col-xs-12">
                <form action="<?php echo admin_Url(); ?>/applicant/registrationConfirm" method="post">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                                Enrollment Information
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main row ">
                                <?php 
                                    if(!empty($studentlist['programLevel'])){ 
                                ?>
                                    <pre class="prettyprint linenums col-sm-5"><strong> Class Level:</strong> <?php echo element($studentlist['programLevel'], getProgramLevel(), Null); ?> </pre>
                                <?php 
                                     } 
                                    if(!empty($studentlist['programId'])){
                                ?>     
                                    <pre class="prettyprint linenums col-sm-5"><strong> Class:</strong> <?php echo getProgramName($studentlist['programId']); ?> </pre>
                                <?php 
                                     } 
                                     if(!empty($studentlist['mediumId'])){
                                ?>    
                                    <pre class="prettyprint linenums col-sm-5"><strong> Medium:</strong> <?php echo getmediumName($studentlist['mediumId']); ?> </pre>
                                <?php 
                                     } 
                                     if(!empty($studentlist['groupId'])){
                                ?>    
                                    <pre class="prettyprint linenums col-sm-5"><strong> Group:</strong> <?php echo getGroupName($studentlist['groupId']); ?> </pre>
                                <?php 
                                     } 
                                     if(!empty($studentlist['shiftId'])){
                                ?>    
                                    <pre class="prettyprint linenums col-sm-5"><strong> Shift:</strong> <?php echo getshiftName($studentlist['shiftId']); ?> </pre>
                                <?php 
                                     } 
                                     if(!empty($studentlist['sessionId'])){
                                ?>    
                                    <pre class="prettyprint linenums col-sm-5"><strong> Session:</strong> <?php echo getSessionName($studentlist['sessionId']); ?> </pre>
                                <?php 
                                     } 

                                ?>    
                                    <pre class="prettyprint linenums col-sm-5 red"><i class="ace-icon fa fa-angle-double-right"></i> Please Select Section </pre>
                                    <span class="col-sm-5 red"> 
                                        <strong class="col-sm-4"> Section: </strong>
                                        <select class="col-sm-8" data-placeholder="Select" name="data[sectionId]"  required="1" >
                                            <option value="">Select</option>
                                            <?php foreach (getSectionList() as $value) { ?>
                                                <option value="<?php echo $value['sectionId']; ?>" >
                                                    <?php echo $value['sectionName']; ?></option>                                                
                                            <?php } ?>
                                        </select>                 
                                    </span>


                            </div>

                        </div>
                        
                        <input type="hidden" value="<?php echo $studentlist['programLevel']; ?>" name="data[programLevel]">
                        <input type="hidden" value="<?php echo $studentlist['programId']; ?>" name="data[programId]">
                        <input type="hidden" value="<?php echo $studentlist['mediumId']; ?>" name="data[mediumId]">
                        <input type="hidden" value="<?php echo $studentlist['groupId']; ?>" name="data[groupId]">
                        <input type="hidden" value="<?php echo $studentlist['shiftId']; ?>" name="data[shiftId]">
                        <input type="hidden" value="<?php echo $studentlist['sessionId']; ?>" name="data[sessionId]">
                        <input type="hidden" value="<?php echo $studentlist['applicationId']; ?>" name="data[applicationId]">
                    </div>
                    <button type="submit" class="btn btn-danger" name="confirmReg">
                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Confirm Registration
                    </button>
                </form> 
                
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->

