<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
      Exam Routine Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Add Exam Routine Information
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
   
</div> <!-- /.row --> 

<div class="col-xs-12">
    <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/examroutine/insertroutine" method="post">


        <div class="row">

            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                        <b> Subject List According To Your Enrollment Information</b>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                <?php echo $enrolment_info[0]['session'];?>
                                <input type="hidden" value="<?php echo $enrolment_info[0]['sessionId']; ?>" name="sessionId">
                            </li>

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                <?php echo $enrolment_info[0]['programName'];?>
                                <input type="hidden" value="<?php echo $enrolment_info[0]['programId'];?>" name="programId">
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                <?php echo $enrolment_info[0]['mediumName'];?>
                                <input type="hidden" value=" <?php echo $enrolment_info[0]['mediumId'];?>" name="mediumId">
                            </li>
                        </ul>
                    </div>
                </div>   
                <div class="col-xs-12 col-sm-6">
                    <div>
                        <ul class="list-unstyled spaced">

                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                <?php echo $enrolment_info[0]['shiftName'];?>
                                <input type="hidden" value="<?php echo $enrolment_info[0]['shiftId'];?>" name="shiftId">
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                <?php echo $enrolment_info[0]['groupName'];?>
                                <input type="hidden" value="<?php echo $enrolment_info[0]['groupId'];?>" name="groupId">
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                                <?php echo $enrolment_info[0]['sectionName'];?>
                                <input type="hidden" value="<?php echo $enrolment_info[0]['sectionId'];?>" name="sectionId">
                            </li>
                        </ul>
                    </div>
                </div>   
            </div><!-- /.col -->


        </div><!-- /.row -->
           <div style="background: #eee;  border-radius: 2px;
             color: firebrick;
             font-size: 16px;
             padding: 8px;
             text-align: center;"> <?php if(!empty($examname)){ echo " <b>Exam Name : </b> ". getExamTypeName($examname) ;} ?></div>
              
    <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                <tr>                                
                    <th>Sl No.</th>
                    
                      <th>
                       Select 
                       </th>
                    <th>Subject Name</th>
                    <th>Exam Date</th>
                    <th>Exam Time</th>
                    <th>Room Number</th>



                </tr>
            </thead>
<?php
 $sl=1;

// echo '<pre>';
// print_r($allcourseofferlist);

foreach ($allcourseofferlist as $value) {
  
    ?>
                <tbody id="datainfo2">
                    <tr>
                        
                        <td><?php echo $sl; ?></td>
                        <td>
                            <input type="checkbox" name="serial[]" value="<?php echo $sl; ?>">
                            

                        </td>
                        
                             <td>
                                     <?php
                                     if (!empty($value['courseId'])) {
                                         echo getCourseName($value['courseId']);
                                     }
                                     ?>
                                     <input type="hidden" name="courseId[]" value ="<?php if (!empty($value['courseId'])) { echo $value['courseId'];
                                     }
                                     ?>">

                        </td>
                        
                        <td>

         <input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="date[]">
                        

                        </td>

   

                        <td>

                            <input id="form-field-1" class="form-control" type="text" placeholder="Exam Time" value="" name=examtime[]">
                  
                        </td>
                        
                          <td>

                           <input id="form-field-1" class="form-control" type="text" placeholder="Room Number" value="" name="room[]">
                
                        </td>

                    </tr>

                </tbody>
<?php 
    $sl++;
    }
?>
        </table>

        <div class="col-xs-12">
            <div class="clearfix form-actions">
                <div class="col-md-12">
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="programOfferId" value="<?php echo $enrolment_info[0]['programOfferId'];?>">
                     <input type="hidden" name="semester_id" value="<?php echo $semester_id;?>"> <!--<?php// echo $examname; ?>-->
                    <button class="btn btn-success" name="btnSubmit" type="submit">
                        Save Exam Routine Information
                    </button>

                </div>
            </div>
        </div>
    </form>
</div>






