<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
           Merging Subject Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Subject Merge Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/courseoffer/save_merge_info" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid"  onchange="return getOfferedSessionId(); " data-placeholder="Select" name="data[sessionId]"  required="" class="form-control">
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
                        <select id="getprogramLevelid"  onchange="return getOfferedprogramLevelId(); " name="data[programLevel]" data-placeholder="Select" required="" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getprogramid"  onchange="return getOfferedprogramId(); " name="data[programId]" required="" class="form-control">
                                
                            </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid"  onchange="return getOfferedmediumId(); " name="data[mediumId]" required="" class="form-control">
                            
                        </select>
                    </div>
                    
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid"  onchange="return getOfferedshiftId(); " name="data[shiftId]" required="" class="form-control" >
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupidd" name="data[groupIdd]" required="" class="form-control">
                            <option value="0">Select</option>
                            <option value="1">General</option>
                            <option value="2">Science</option>
                            <option value="3">Business Studies</option>
                            <option value="4">Humanities</option>
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid"  name="data[sectionId]" required="" class="form-control">
                        </select>
                    </div>
                </div>

                <div id="first_merge_list" class="col-xs-12 col-sm-12">

                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">New Subject Name <!--&nbsp; <?php// echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?>--></label>
                        <input type="text" id="getnewsubName" name="data[getnewsubName]" required="" class="form-control">
                       
                    </div>

                     <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Merge First Subject <!--  &nbsp; <?php// echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?>--></label>
                        <select id="getfirstSubject" name="data[getfirstSubject]" required="" class="form-control">
                            <!--<option value="">Select</option>-->
                        </select>
                    </div>
                     <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Merge Second Subject <!-- &nbsp; <?php// echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?>--></label>
                        <select id="getsecondSubject" name="data[getsecondSubject]" required="" class="form-control">
                            <!--<option value="">Select</option>-->
                        </select>
                    </div>
                               
                </div> 

               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                Save Merge Subject Information
                            </button>

                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 

   <script>
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
    </script>

    <script>
        $(document).ready(function(){
            $('#getgroupidd').change(function(){
            var session_val = $('#getsessionid').val();//4
            var classlvl_val = $('#getprogramLevelid').val();//4
            var class_student_val = $('#getprogramid').val();//5
            var medium_val = $("#getmediumid").val(); //1
            var group_val = $('#getgroupidd').val(); //2
            var shift_val = $('#getshiftid').val(); //1
            var section_val = $('#getsectionid').val();//1
           
            $.ajax({
                 type: "POST",
                 url: "<?php echo base_url('systemaccess/courseoffer/getsubjectNames'); ?>",
                 dataType: "html",
                 data: {session_val:session_val,classlvl_val:classlvl_val,class_student_val:class_student_val,medium_val,group_val:group_val,shift_val:shift_val,section_val:section_val},
                 success:function(response){
                    if(response){
                       $('#getfirstSubject').empty().append(response);
                       $('#getsecondSubject').empty().append(response);
                    }else{
                        alert('No Subjects Offered');
                    }
                 }
            });
        });
    });
    </script>

    <?php
    if(!empty($merge_subjects))
    {
     ?>
     <div class="row">
        <div class="col-xs-12">
            <table id="simple-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>                                
                        <th>Sl No.</th>
                        <th>Class Information</th>
                        <th>Merge Name</th>
                        <th >Merge Subject Codes</th>
                        <th>Merge Subject Names</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sl=1;
                    foreach($merge_subjects as $val)
                    {
                        ?>
                        <tr>
                            <td> <?php echo $sl++; ?></td>
                            <td> <?php echo get_class_info($val['programOfferId']) ?></td>
                            <td> <?php echo $val['merge_course_name'] ?></td>
                            <td> <?php echo $val['merging_course_codes'] ?></td>
                            <td> <?php echo $val['merging_course_names'] ?></td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">

<!--                                    <a href="--><?php //echo admin_Url();?><!--/course/editdcourse/--><?php //echo $val['courseId']; ?><!--"  class="btn btn-xs btn-info">-->
<!--                                        <i class="ace-icon fa fa-pencil bigger-120"></i>-->
<!--                                    </a>-->

                                    <a href="<?php echo admin_Url();?>/courseoffer/delete_merge_course/<?php echo $val['id']; ?>" class="del_msg btn btn-xs btn-danger">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </a>


                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                            <li>
                                                <a href="<?php echo admin_Url();?>/course/editdcourse/<?php echo $val['courseId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo admin_Url();?>/course/deletecourse/<?php echo $val['courseId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div><!-- /.span -->
    </div><!-- /.row -->
    <?php
}
?>

</div><!-- /.col-x12 -->
</div> <!-- /.row -->



<script>
    $(".del_msg").click(function(){
        if(confirm("Are you sure you want to delete this?")){
            return true;
        }
        else{
            return false;
        }
    });
</script>
    