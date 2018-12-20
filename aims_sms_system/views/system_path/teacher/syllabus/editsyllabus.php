<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            
         Add Syllabus Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Syllabus Information
            </small>
        </h1>
    </div><!-- /.page-header -->

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
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo teacher_Url() ?>/syllabus/updatesyllabus/<?php echo $editData['syllabusId']; ?>" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    
                     <div class="col-xs-10 col-sm-4">
                        <br>
                            <h5><b>Session :<?php  echo getsessionName($programinfo["sessionId"]);  ?> </b> </h5> 
                        
                            <h5><b>Class :<?php  echo getprogramName($programinfo["programId"]);  ?> </b> </h5> 
                       
                            <h5><b>Medium :<?php  echo getmediumName($programinfo["mediumId"]);  ?> </b> </h5> 
                        <br>                        
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <br>
                            <h5><b>Group :<?php  echo getGroupName($programinfo["groupId"]);  ?> </b> </h5> 
                      
                            <h5><b>Shift :<?php  echo getshiftName($programinfo["shiftId"]);  ?> </b> </h5> 
                        
                            <h5><b>Section :<?php  echo getsectionName($programinfo["sectionId"]);  ?> </b> </h5> 
                        <br>                        
                    </div>
                    <div class="col-xs-10 col-sm-4 text-danger">
                        <br>
                            <h5><b>Subject :<?php  echo getCourseName($editData["courseId"]);  ?> </b> </h5> 
                        <br>
                    </div>
                             
                </div> 
                   <br><br>
                <div class="col-xs-12 ">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Syllabus Details :</h4>


                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div>


                                    <textarea style="height:300px" class="form-control" name="data[syllabus]" value="<?php echo set_value('data[syllabus]') ?>"> <?php echo $editData["syllabus"]; ?> </textarea>
                                </div>

                            </div>
                        </div>
                    </div>     
                </div> 
                
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="save" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Update Syllabus Information
                            </button>
                            

                        </div>
                    </div>
                </div>        
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    </div>
        </div>
    </div>
    

