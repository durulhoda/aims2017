<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Homework Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                All Homework Information
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
       <!-- PAGE CONTENT ENDS -->
          
             <?php
                if (!empty($homeworklist)) {
                    ?>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                <tr> 
                                    <th>Sl.No</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                        <th>Teacher</th>
                                        <th>Homework</th>
                                       
                                    </tr>
                            </thead>

                                <tbody>
                                    <?php
                                        $sl=1;
                                        foreach($homeworklist as $value)
                                        {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>                                        
                                        <td> 
                                           <?php
                                            if (!empty($value['date'])) {
                                                echo ($value['date']);
                                            }
                                            ?></td>
                                            <td>
                                    <?php echo getCourseName($value['courseId']); ?> 
                                        </td>
                                        <td>

                                             <?php echo $Teacher["firstName"] . " " . $Teacher["lastName"]; ?>
                               
                                      
                                        <td> 
                                              <?php
                                                    $string = $value['homework'];
                                                    $string = character_limiter($string, 30);
                                                    echo $string; ?> &nbsp;
                                                    <a href="<?php echo student_Url() . "/homework/viewhomework/" . $value['hwId']; ?>">VIEW More</a>
                                        </td>
                                        
                                            
                                      
                                    </tr>
                                     <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                 
                </div><!-- /.span -->
                    <?php
               }
           ?>

            </div><!-- /.row -->
         
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
            </div><!-- /.row -->
         
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
    
    
    
    
    


