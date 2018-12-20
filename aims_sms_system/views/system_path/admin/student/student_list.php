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
      if (!empty($studentlist)) {
          ?>
   <div class="col-xs-12 col-sm-12">
      <div class="widget-box transparent">
         <div class="widget-header widget-header-large">
            <h3 class="widget-title grey lighter">
               <i class="ace-icon fa fa-exchange green"></i>
               All Student Information
            </h3>
            <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/student/printStudentList/<?php echo $programId ?>" enctype="multipart/form-data" method="post">
               <input type="hidden" value="<?php
                  if (!empty($sessionId)) {
                      echo $sessionId;
                  }
                  ?>" name="data[sessionId]">
               <input type="hidden" value="<?php
                  if (!empty($programId)) {
                      echo $programId;
                  }
                  ?>" name="data[programId]">
               <input type="hidden" value="<?php
                  if (!empty($mediumId)) {
                      echo $mediumId;
                  }
                  ?>" name="data[mediumId]">
               <input type="hidden" value="<?php
                  if (!empty($shiftId)) {
                      echo $shiftId;
                  }
                  ?>" name="data[shiftId]">
               <input type="hidden" value="<?php
                  if (!empty($groupId)) {
                      echo $groupId;
                  }
                  ?>" name="data[groupId]">
               <input type="hidden" value="<?php
                  if (!empty($sectionId)) {
                      echo $sectionId;
                  }
                  ?>" name="data[sectionId]">
               <!-- <div class="widget-toolbar hidden-480">
                  <i class="ace-icon fa fa-print"></i>
                  <button class="btn btn-white btn-primary" name="search" type="submit">Print Student List</button> 
                  
                  </div> -->
            </form>
            <div class="widget-toolbar hidden-480">
               <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
               <a href="#modal-table" role="button" class="red" data-toggle="modal"> Search Again </a>
            </div>
            <button class="btn btn-success" onclick="printDiv('printableArea')">
            Print
            <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </button>
         </div>
         <div id="modal-table" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header no-padding">
                     <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                        </button>
                        Search Again Student List By Enrollment Information
                     </div>
                  </div>
                  <div class="modal-body no-padding">
                     <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/student/searchRegisteredStudent" enctype="multipart/form-data" method="post">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12">
                              <!-- PAGE CONTENT BEGINS --> 
                              <div class=" col-xs-10 col-sm-4">
                                 <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select id="getsessionid" onchange="return getOfferedSession_classId();" data-placeholder="Select" name="data[sessionId]"  class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach (getOfferedSession() as $value) { ?>
                                    <option value="<?php echo $value['sessionId']; ?>" >
                                       <?php echo $value['session']; ?>
                                    </option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <div class=" col-xs-10 col-sm-4">
                                 <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select id="getprogramid" onchange="return getOfferedprogramId();" name="data[programId]" required="1" class="form-control">
                                 </select>
                              </div>
                              <div class=" col-xs-10 col-sm-4">
                                 <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select id="getmediumid" onchange="return getOfferedmediumId();" name="data[mediumId]" class="form-control">
                                 </select>
                              </div>
                              <div class=" col-xs-10 col-sm-4">
                                 <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select id="getshiftid" onchange="return getOfferedshiftId();" name="data[shiftId]" class="form-control" >
                                 </select>
                              </div>
                              <div class=" col-xs-10 col-sm-4">
                                 <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select id="getgroupid" onchange="return getOfferedgroupId();" name="data[groupId]" class="form-control">
                                 </select>
                              </div>
                              <div class=" col-xs-10 col-sm-4">
                                 <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                 <select id="getsectionid" name="data[sectionId]" class="form-control" >
                                 </select>
                              </div>
                           </div>
                           <div class="col-xs-12">
                              <div class="clearfix form-actions">
                                 <div class="col-md-12">
                                    <button class="btn btn-success" name="search" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Search Student Information
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- PAGE CONTENT ENDS -->
         
      </div>
   </div>
   </form>
   <style type="text/css">
       .show{display: none !important}
   </style>
   <!-- /.col-x12 -->
   <div id="printableArea">
   <style tyle="text/css">
      @media print
      {
      .none{display: none;}
      .show{display: block;}
      }
   </style>
            <div class="row">
               <div class="col-sm-12">
                  <div class="center">
                     <img alt="<?php echo $institute_info->institute_name; ?>" id="avatar3" src="<?php echo ($institute_info->logo) ? base_url().$institute_info->logo : base_url()."all_upload/default/aims.png"; ?>" width="50">
                     <h3>
                        <p class="user"> &nbsp; <?php echo $institute_info->institute_name; ?></p>
                     </h3>
                     <div class="time">
                        &nbsp;
                        <span class="editable" id="country"> <?php echo $institute_info->address; ?></span><br>
                        <h4> Student List </h4>
                     </div>
                  </div>
                  <center>
                     <div id="id-message-infobar" style="font-size: 12px; margin-left: -18px; padding: 3px;">
                        <span class="blue bigger-130">
                        <i class="ace-icon fa fa-caret-right blue"></i>Session : <?php
                           if (!empty($sessionId)) {
                               echo "<b>" . getSessionName($sessionId) . "</b>";
                           }
                           ?>&nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i>Class : <?php
                           if (!empty($programId)) {
                               echo "<b>" . getProgramName($programId) . "</b>";
                           }
                           ?> &nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i>Medium : <?php
                           if (!empty($mediumId)) {
                               echo "<b>" . getmediumName($mediumId) . "</b>";
                           }
                           ?> &nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i>Shift : <?php
                           if (!empty($shiftId)) {
                               echo "<b>" . getshiftName($shiftId) . "</b>";
                           }
                           ?> &nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i>Group : <?php
                           if (!empty($groupId)) {
                               echo "<b>" . getGroupName($groupId) . "</b>";
                           }
                           ?>&nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i> Section : <?php
                           if (!empty($sectionId)) {
                               echo "<b>" . getsectionName($sectionId) . "</b>";
                           }
                           ?></span>
                     </div>
                  </center>

               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         
         <!-- <div class="table-header">
            Student List
            </div> -->
         <!-- div.table-responsive -->
         <!-- div.dataTables_borderWrap -->
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                     <th class="center hidden-480">
                        Sl No.
                     </th>
                     <th >Student Id</th>
                     <th>Student Name</th>
                     <th>Roll No</th>
                     <th class="hidden-480">Birth Date/ Gender</th>
                     <th>Father Info</th>
                     <th class="hidden-480">Mother Info</th>
                     <th class="hidden-480">Image</th>
                     <th class="none">
                        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                        Action
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $sl = 1;
                     foreach ($studentlist as $value) {
                         ?>
                  <tr>
                     <td class="center hidden-480">
                        <?php echo $sl++; ?>
                     </td>
                     <td>
                        <span class="none">
                            <a target="_blank" href="<?php echo admin_Url() . "/student/viewstudentInfo/" . $value['studentId']; ?>/<?php echo $value['programOfferId'] ?>">
                        <?php
                           if (!empty($value['studentId'])) {
                               echo $value['studentId'];
                           }
                           ?>                                    
                        </a>
                        </span>
                        <span style="display: none;" class="show">
                            <?php
                           if (!empty($value['studentId'])) {
                               echo $value['studentId'];
                           }
                           ?> 
                        </span>
                        
                     </td>
                     <td><?php
                        if (!empty($value['firstName'])) {
                            echo "<b>" . $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] . "</b>";
                        }
                        ?></td>
                     <td><?php echo isset($student_roll[$value['studentId']]) ? $student_roll[$value['studentId']] : ""; ?></td>
                     <td class="hidden-480"><?php
                        if (!empty($value['dateOfBirth'])) {
                            echo $value['dateOfBirth'] . "<br>" . element($value['gender'], getGendar(), Null);
                        }
                        ?></td>
                     <td>
                        <?php echo "" . $value['fatherName'] . "<br>" . $value['fatherPhone']; ?>
                     </td>
                     <td class="hidden-480">                                
                        <?php echo "" . $value['motherName'] . "<br>" . $value['motherPhone']; ?>
                     </td>
                     <td class="hidden-480">
                        <?php
                           if ($value['photo']) {
                               ?>
                        <img id="img_<?php echo $value['applicationId'];?>"  src="<?php
                           if (file_exists($value['photo'])) {
                               echo base_url() . $value['photo'];
                           } else {
                               echo base_url() . "uploads/default/default.png";
                           }
                           ?>" width="60" height="60">
                        <?php
                           }
                           ?>
                     </td>
                     <td class="none">
                        <div class="hidden-sm hidden-xs action-buttons">
                           <a class="blue" target="_blank" href="<?php echo admin_Url(); ?>/student/viewstudentInfo/<?php echo $value['studentId'] ?>/<?php echo $value['programOfferId'] ?>" title="View">
                           <i class="ace-icon fa fa-search bigger-100"></i>
                           </a>
                            <a id="up_button_<?php echo $value['applicationId'];?>" data-role="disabled" href="" class="upload_photo" data-toggle="modal" data-target="#up_std_pht" data-id="<?php echo $value['applicationId'];?>" data-src="<?php if($value['photo']){echo base_url().$value['photo'];} else{echo base_url()."uploads/default/default.png"; }?>" title="Upload Photo">
                                <i class="fa fa-upload"></i>
                            </a>
                           <a class="green" href="<?php echo admin_Url(); ?>/student/editstudent/<?php echo $value['studentId'] ?>" title="Edit">
                           <i class="ace-icon fa fa-pencil bigger-100"></i>
                           </a>
                           <a data-role="disabled" style="pointer-events: none; cursor: default;" class="red" onclick="return checkDelete('Student ?');" href="<?php echo admin_Url(); ?>/student/deleteStudentData/<?php echo $value['studentId'] ?>"  title="Delete">
                           <i class="ace-icon fa fa-trash-o bigger-100"></i>
                           </a>
                        </div>
                        <div class="hidden-md hidden-lg">
                           <div class="inline pos-rel">
                              <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                              <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                 <li>
                                    <a href="<?php echo admin_Url(); ?>/student/viewstudentInfo/<?php echo $value['studentId'] ?>" class="tooltip-info" data-rel="tooltip" title="View">
                                    <span class="blue">
                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?php echo admin_Url(); ?>/student/editstudent/<?php echo $value['studentId'] ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                    <span class="green">
                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a style="pointer-events: none; cursor: default;" onclick="return checkDelete('Student ?');" href="<?php echo admin_Url(); ?>/student/deleteStudentData/<?php echo $value['studentId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
            </div>
   <?php
      }
      ?>
</div>
<!-- /.row -->


<style>

</style>

<!-- Modal -->
<div class="modal fade" id="up_std_pht" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Student Photo</h4>
                <h5 class="modal-title">Student ID : <b><span id="id_span"></span></b></h5>
            </div>
            <div class="modal-body">


                <div class="row">
                    <form id="data_edit_form" action="#" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <img class="image"  src="" width="120" height="120">
                            </div>

                            <div class="col-sm-6" style="margin-top: 45px;">
                                <label class="btn btn-sm">
                                    Browse <input type="file" name="image" id="file" hidden>
                                </label>
                            </div>
                            <input type="hidden" name="student_id" id="student_id" value="">
                            <div class="col-sm-1"></div>
                        </div>


                    </form>
                </div>


            </div>

            <div class="modal-footer" style="text-align: center;">
                <button id="update_button" type="submit" class="btn btn-success" name="save">
                    <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                    Save
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

        </div>

    </div>
</div>




<!--Modal alert-->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="header_mod">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p id="message_mod">This is a small modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>








<script>
    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".image").attr("src",e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function(){

        $(".upload_photo").click(function(){
            event.preventDefault();
            var id = $(this).attr('data-id');
            $("#student_id").val(id);
            $("#id_span").html(id);
            var src = $(this).attr('data-src');
            $(".image").attr("src",src);
        });

        $("#file").change(function () {
            filePreview(this);
        });

        $("#update_button").click(function()
        {
            var form = $('#data_edit_form')[0]; // You need to use standard javascript object here
            var formData = new FormData(form);

            $.ajax({
                url: "<?php echo base_url('systemaccess/student/update_photo_using_ajax'); ?>",
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(data) {

                    var response = JSON.parse(data);

                    if(response.status=='failed for size')
                    {
                        $("#up_std_pht").modal("hide");
                        $("#header_mod").html("");
                        $("#header_mod").html("Failed");
                        $("#message_mod").html("");
                        $("#message_mod").html("Image Size Limit Exceeded");
                        $("#myModal").modal("show");
                    }
                    if(response.status=='success')
                    {
                        $("#img_"+response.id).attr("src","<?php echo base_url();?>/"+response.image);
                        $("#up_button_"+response.id).attr("data-src","<?php echo base_url();?>/"+response.image);
                        $("#up_std_pht").modal("hide");
                        $("#header_mod").html("");
                        $("#header_mod").html("Success");
                        $("#message_mod").html("");
                        $("#message_mod").html("Image Uploaded Successfully");
                        $("#myModal").modal("show");
                        setTimeout(function()
                        {
                            $("#myModal").modal("hide");
                        }, 1000);
                    }
                    else
                    {
                        $("#up_std_pht").modal("hide");
                        $("#header_mod").html("");
                        $("#header_mod").html("Failed");
                        $("#message_mod").html("");
                        $("#message_mod").html("Image Upload Failed");
                        $("#myModal").modal("show");
                    }
                }
            });

        });

    });
</script>