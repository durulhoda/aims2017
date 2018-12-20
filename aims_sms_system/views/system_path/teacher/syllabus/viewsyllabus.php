<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Syllabus Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                View Syllabus Details
            </small>
        </h1>
    </div><!-- /.page-header -->
<div class="row">
    <div class="col-sm-5">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-quote-left smaller-80"></i>
                    Enrollment Information
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                  
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote class="pull-left">
                                 <span class='lighter green bolder'><i class="ace-icon fa fa-book"></i> Current Enrollment Information </span>
                               <?php 
                    
                    $programinfo=  getofferProgramInfoById($editData["programOfferId"]);
                ?>
                                    <small>        
                                        <span class="red"> Class: </span>
                                        <cite title="Class"> <?php echo getProgramName($programinfo['programId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Medium: </span>
                                        <cite title="Class level"> <?php echo getmediumName($programinfo['mediumId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Group: </span>
                                        <cite title="Class level"> <?php echo getGroupName($programinfo['groupId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Shift: </span>
                                        <cite title="Class level"> <?php echo getshiftName($programinfo['shiftId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Section: </span>
                                        <cite title="Class level"> <?php echo getsectionName($programinfo['sectionId']); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="red"> Session: </span>
                                        <cite title="Class level"> <?php echo getSessionName($programinfo['sessionId']); ?> </cite>                                    
                                    </small>
                               
                               
                            </blockquote>
                        
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-7">       

        <div class="row">
            <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                                Syllabus Information
                            </h4>
                        </div>

                        <div class="widget-body">
                           
                            <div class="widget-main">
                                 <span class='lighter green bolder'><i class="ace-icon fa fa-book"></i> Subject :  <?php echo getCourseName($editData['courseId']); ?>  </span>
                                

                                <hr> 

                                <?php echo $editData["syllabus"]; ?>
                            </div>

                        </div>
                        
                    </div>
                   
                 
                
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->
</div>
        </div>
    </div>



