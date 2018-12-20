<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
          Seat Plan Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Student Seat Plan Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/courseoffer/searchseatplan" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid"  onchange="return getOfferedSessionId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                            <option value="">Select</option>

                             <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php   }    ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramLevelid"  onchange="return getOfferedprogramLevelId(); " name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getprogramid"  onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">
                                
                            </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid"  onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid"  onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupidd" name="data[groupIdd]" required="1" class="form-control">
                            <option value="0">Select</option>
                            <option value="1">General</option>
                            <option value="2">Science</option>
                            <option value="3">Business Studies</option>
                            <option value="4">Humanitis</option>
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid"  name="data[sectionId]" required="1" class="form-control">
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsemestertype"  name="data[semestertype]" required="1" class="form-control">
                            <option value="0">Select</option>
                            <?php foreach($semestertype as $semestertype){?>
                            <option value="<?php echo $semestertype['semesterId'];?>"><?php echo $semestertype['semester'];?></option>
                            <?php }?>

                        </select>
                    </div>
                    
                </div>

                

               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                Search Student Seat Plan
                            </button>

                        </div>
                    </div>
                </div>

                
            </form>
             
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 

   <!--<script>
        $(document).ready(function(){
             $('#first_merge_list').hide(); 
            var session = $('#getsessionid').val();
            var class_level = $('#getprogramLevelid').val();
            var class_student = $('#getprogramid').val();
            var medium = $('#getmediumid').val();
            var group = $('#getgroupidd').val();
            var shift = $('#getshiftid').val();
            var section = $('#getsectionid').val();
            $('#getgroupidd').on('change',function(){
                 if(($('#getgroupidd').val()!="0")){ 
                    //console.log('empty'); 
                    $('#first_merge_list').show(); 
                 }
            });
        });
    </script>-->

  <!--  <script>
        $(document).ready(function(){
            $('#getgroupidd').change(function(){
            var session = $('#getsessionid').val();
            var class_student = $('#getprogramid').val();
            var medium = $("#getmediumid").val();
            var group = $('#getgroupidd').val();
            
          //  var shift = $('#getshiftid').val();
           // var section = $('#getsectionid').val();
            $.ajax({
                 type: "POST",
                 url: "<?php// echo base_url('systemaccess/userquery/getsubjectNames'); ?>",
                 dataType: "JSON",
                 data: {session:session,class_student:class_student,group:group},
                 success:function(response){
                    alert(response);
                 }
            });
        });
    });
    </script>-->
    