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
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-barcode red"></i>
                    Transfer Certificate
                </h3>

            </div>
        </div>
        <div class="widget-box transparent ">
            <div class="widget-header widget-header-large">
                <div class="widget-toolbar pull-left">
                    <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                    <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Generate Again By Individual Student </a>

                </div>


                <div class="pull-right">


                    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
                        <span class="btn btn-purple no-border">
                            <i class="ace-icon fa fa-print bigger-130"></i>
                            <span class="bigger-110">Print Transfer Certificate</span>
                        </span>
                    </button>
                    <!-- /.page-header -->



                </div>

            </div>
        </div>


        <div id="modal-table_student" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            Search Again By Individual Student
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-body no-padding">

                            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/Certificate/genrtStudentcertificate" method="post">
                                <div class="col-xs-12 col-sm-12">  
                                    <!-- PAGE CONTENT BEGINS -->
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">StudentId &nbsp; <?php echo form_error('data[studentId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <input type="text" name="data[studentId]" required="1" value="<?php echo set_value("data[studentId]"); ?>" class="form-control" id="form-field-1" placeholder="Student Id" />
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select name="data[sessionId]" required="1" class="form-control" id="form-field-select-1">
                                            <option value="">Select</option> 
                                            <?php foreach (getOfferedSession() as $value) { ?>
                                                <option value="<?php echo $value['sessionId']; ?>" 
                                                        <?php echo set_select('data[sessionId]', $value['session'], FALSE) ?> >
                                                    <?php echo $value['session']; ?></option>                                                
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Exam &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select name="data[semesterId]" class="form-control" id="form-field-select-1">
                                            <option value="">Select</option>
                                            <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                                <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE) ?>>
                                                    <?php echo $velues['semester'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                                                   <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label" for="form-field-1">Cause of leaving &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                                    <select name="data[causetransfer]" required="1" class="form-control" id="form-field-select-1">
                                                        <option value=""></option> 
                                                    
                                                             <?php
                                                            foreach (getcauseOfleaving() as $value) {
                                                                ?>
                                                                <option value="<?php echo $value; ?>" 
                                                                        <?php echo set_select("data[causetransfer]", $value, FALSE); ?> >
                                                                        <?php echo $value; ?>
                                                                </option> 

                                                                <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>

                                </div> 


                                <div class="col-xs-12">
                                    <div class="clearfix form-actions">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" name="search" type="submit">
                                                <i class="ace-icon fa fa-search bigger-120"></i>
                                                Generate Transfer Certificate
                                            </button>

                                        </div>
                                    </div>
                                </div>        
                            </form>

                        </div>    
                    </div>       
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- PAGE CONTENT ENDS -->

        <div id="printableArea" >          
            <div style="width:100%; margin-left: auto; margin-right: auto; padding: 36px;  border: 2px dashed;">
                <div style="border: 0px solid #e1e1d2; padding: 10px; border-radius:2px;">
                    <div style="text-align: center;">
                        <?php
                        $ins_info = getInstituteInfo();
                        ?>
                        <h2 style="color: #000; font-family: Algerian; text-transform: uppercase;"> <?php
                        $ins_name = getInstituteInfo();
                        echo $ins_name['instituteName'];
                        ?></h2>
                        <h4 style="color: #000 !important; text-transform: uppercase;"> <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?> </h4>

                    </div>
                    <div style="width: 100%;">
                        <div style="float: left; width: 30%; height: auto; margin-left: 20px; padding: 4px;">
                            <p>Serial No.  
                            
<?php
$input = $studentId;
echo mb_strimwidth("$input", 5, 10, ".");
// outputs Hello W...
?>

                            </p>
                    
                        </div>
                        <?php
                        $ins_info = getInstituteInfo();
                        ?>

                        <div style="float: left; width: 30%; height: auto; margin-left: 20px; padding: 4px;">
                            <center> <img  src="<?php echo base_Url() . $ins_info['logo'] ?>" height="90" left="2px;" align="middle"></center>

                        </div>


                        <div style="float: right; width: 30%; height: auto; text-align: right;">
                            <p>    <?php echo "Date:" . date("d/m/Y") . "<br>";?> &nbsp; &nbsp; &nbsp; &nbsp;</p>
                      


                        </div>
                    </div>  


                    <br> <br> <br><br> <br> <br><br> 
                    <div style="width: 100%; text-align: center; ">
                      <span style="font-size: 18px;">  <b>Transfer Certificate </b></span>
                    </div>

                    <div style="width: 100%; text-align: center; margin-top: 18px; border: 2px solid lightblue; font-size: 16px;">
                      
                 
                        
                        <br>
                        <P style="text-align: justify;  margin: -6px 15px 15px;">This is to consenting that <span style="font-size: 18px; font-weight: 600;"><?php echo "<b>" . ($studentinfo['firstName'] . " " . $studentinfo['lastName'])."," ." "."ID-$studentId". "</b>"; ?> </span>
                            Son/daughter of <span style="font-size: 18px; font-weight: 600;"><?php echo "<b>" . ( " " . $studentinfo['fatherName']) . "</b>"; ?></span><span style="font-size: 20px;"> & </span><span style="font-size: 18px; font-weight: 600;"> <?php echo "<b>" . ( " " . $studentinfo['motherName']) . "</b>"; ?></span>
                        
                        
                        of    Village –<span style="font-size: 18px; font-weight: 600;">  <?php echo "<b>" . $studentinfo['presentAddress'] . "</b>"; ?></span>
                        He/She had been studying in this school. His/Her date of birth is <span style="font-size: 18px; font-weight: 600;"> <?php echo "<b>" . $studentinfo['dateOfBirth'] . "</b>"; ?></span> (as per description of admission book).
                        He/She has been reading in  <span style="font-size: 18px; font-weight: 600;"><?php
                            echo "<b>" . getProgramName($programoffer_info['programId']) . "</b>";
                        ?></span>, Session-<span style="font-size: 18px; font-weight: 600;"><?php
                            echo "<b>" . getSessionName($programoffer_info['sessionId']) . "</b>";
                        ?></span>, Group-<span style="font-size: 18px; font-weight: 600;"><?php
                            echo "<b>" . getGroupName($programoffer_info['groupId']) . "</b>";
                        ?></span>
                        
                       of this school and he was passed the  <span style="font-size: 18px; font-weight: 600;">
                            <?php
                        if (!empty($semesterId)) {
                            echo "<b>" . getSemesterName($semesterId) . "</b>";
                        }
                        ?>
                       </span>. All the dues from him was received with understanding up to 
                        the dated month of
                        -<span style="font-size: 18px; font-weight: 600;"><?php echo $certificatedatebydate['entryDate']; ?>.</span></P>
                       
                        
                       <p style="text-align: left;"> 
                         &nbsp;&nbsp; His/Her moral character :<b>Good</b><br>
                         &nbsp;&nbsp; Behavior            :<b>Good</b><br>
                         &nbsp;&nbsp; Progress            :<b>Satisfactory </b>
                         <br>
                         &nbsp;&nbsp; Cause of leaving the school: <b><?php echo $causetransfer; ?></b>
                         <br> <br>
                        &nbsp;&nbsp;  I wish all his Success in life. <br> <br>
                        </p>
                      
                        
                      

                    </div>


                    <br> <br> <br>
                   <div style="  float: right;font-size: 15px;margin-top: -25px; padding: 3px; text-align: left; width: 37%;">
                       <p>
                           <img src="<?php echo base_url();?>images/Photo/headmaster.jpg" width="100px" margin-left="10px">
                     <br>   Head Master Signature
                        <?php
                        $ins_name = getInstituteInfo();
                        echo $ins_name['instituteName'];
                        ?><br>
                        <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?> <br>
                        </p>
                    </div>
                    <br><br><br>
                </div>
                
 
            </div>
        </div>
    </div>
</div>

                                 