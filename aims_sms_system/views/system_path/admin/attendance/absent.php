<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Student Absent
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Student Absent List
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentsattendance/studentAbsent" method="post">
                
                   <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                        <div class=" col-xs-10 col-sm-3">
                            <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                <option value="">Select</option>
                                 <?php foreach (getOfferedSession() as $value) { ?>
                                    <option value="<?php echo $value['sessionId']; ?>" 
                                            <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                        <?php echo $value['session']; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                     
                        <div class=" col-xs-10 col-sm-3">
                                <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                </select>
                        </div>
                        <div class=" col-xs-10 col-sm-3">
                            <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-3">
                            <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-3">
                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" class="form-control" >

                            </select>
                        </div>
                
                      <div class="col-xs-10 col-sm-3">
                            <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsectionid" name="data[sectionId]" class="form-control">

                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                            <label class="control-label" for="form-field-1">Student Id  &nbsp; <?php echo form_error('studentId', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="studentId" class="form-control">
                    </div>
                    <div class="col-xs-6 col-sm-3">
                            <label class="control-label" for="form-field-1">Type  &nbsp; </label>
                            <select name="type" class="form-control">
                              <option value="1">Finger</option>
                              <option value="2" selected="">Manual</option>
                            </select>
                    </div>
                      
                    </div>
         
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-4 col-md-offset-4">
                                <button class="btn btn-success btn-sm" name="search" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Search
                                </button>

                            </div>
                        </div>
                    </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    <div id="printableArea">
    <style tyle="text/css">
      @media print
      {
      .none{display: none;}
      }
   </style>
    <div class="col-md-12">
        <div class="widget-box ">
            <?php if ($records) : ?>
            <div class="widget-header widget-header-large">
                <button class="btn btn-success none" onclick="printDiv('printableArea')">
                    Print A Copy
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>
                <div class="center">
                    <img alt="<?php echo $institute_info->institute_name; ?>" id="avatar3" src="<?php echo ($institute_info->logo) ? base_url().$institute_info->logo : base_url()."all_upload/default/aims.png"; ?>" width="50">
                    <h3>
                       <p class="user"> &nbsp; <?php echo $institute_info->institute_name; ?></p>
                    </h3>
                    <div class="time">
                       &nbsp;
                       <span class="editable" id="country"> <?php echo $institute_info->address; ?></span><br>
                       <h4> Student Absent List&nbsp;(<?php echo date('Y-m-d'); ?>) </h4>
                    </div>
                 </div>
                 <br>
         <center>
            <div id="id-message-infobar" style="background: #e5e5e5 none repeat scroll 0 0; margin-left: -18px; padding: 3px;">
               <span class="blue bigger-130"><?php if(!empty($programId)){ echo "Session : ".getSessionName($sessionId)." - Class : ".getProgramName($programId)." - Group : ".getGroupName($groupId)." - Shift : ".getShiftName($shiftId)." - Section : ".getSectionName($sectionId);} ?></span>
            </div>
         </center>
            </div>
        <?php endif; ?>
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentsattendance/sendAbsentMessage" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Student Id</td>
                        <td>Student Name</td>
                        <td>Father Phone</td>
                        <td>Type</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($records) : ?>
                        <?php foreach ($records as $key => $val) : ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $val->student_id; ?></td>
                                <td><?php echo $val->student_name; ?></td>
                                <td><?php echo $val->father_phone; ?></td>
                                <td><?php echo ($val->type == 1) ? "Finger" : "Manual"; ?></td>
                                <td>
                                <input type="hidden" name="father_phone[]" value="<?php echo $val->father_phone; ?>">
                                <input type="hidden" name="student_id[]" value="<?php echo $val->student_id; ?>" checked="">
                                <input type="checkbox" name="serial[]" value="<?php echo $key+1; ?>" checked=""></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="none" style="text-align: center;">
                            <td colspan="6">
                                <button class="btn btn-success btn-sm" onclick="this.form.target = '_blank';return true;" name="sendsms" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> SEND SMS
                            </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            </form>
        </div>
    </div>
    </div>

