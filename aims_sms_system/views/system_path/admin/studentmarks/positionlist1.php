                
<div class="page-header">
    <h1>
        Student Position
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            All Student Position
        </small>
    </h1>
    
</div><!-- /.page-header -->

<?php
if (empty($markslist)) {
    ?>
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/studentmarks/search_position" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>

                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
                           
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid"  data-placeholder="Select" name="data[semesterId]"  class="form-control">
                            <option value="">Select</option>
                             <?php foreach(getSemesterInfoArray() as $velues){?>
                                         <option value="<?php echo $velues['semesterId'];?>" 
                                             <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE)?>><?php echo $velues['semester']?></option>
                                         <?php }?>
                        </select>
                    </div>
                            
                </div>  
                <div class="col-xs-10 col-sm-4">
                    <label class="control-label" for="form-field-1">Exam Type  &nbsp; <?php echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[examtypeId]" class="form-control" id="form-field-select-1">
                       <option value="">Select </option>
                            <?php foreach(getExamList() as $velues){?>
                             <option value="<?php echo $velues['examtypeId'];?>" <?php echo set_select('data[examtypeId]', $velues['examtypeId'], FALSE)?>><?php echo $velues['examtypeName']?></option>
                             <?php }?>

                    </select>
                </div>
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="search" type="submit">
                                <i class="ace-icon fa fa-search bigger-120"></i>
                               Search Student
                            </button>
                            <button class="btn btn-purple" name="print" type="submit">
                                <i class="ace-icon fa fa-print bigger-120"></i>
                               Print Marks Entry List
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
             
        </div>
</div> <!-- /.row --> 

<?php
        }
        if (!empty($records)) {
    ?>
<button class="btn btn-success" onclick="printDiv('printableArea')">
                    Print A Copy
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>
    <div id="printableArea">
    <style tyle="text/css">
        @media print
       {
          .none{display: none;}
       }
    </style>
         <div class="widget-box ">
            <div class="widget-header widget-header-large">

                <div class="center"> 
                    <img alt="<?php
                    if (!empty($data_info['instituteName'])) {
                        echo $data_info['instituteName'];
                    }
                    ?>" id="avatar3" src="<?php
                         if (file_exists($data_info['logo'])) {
                             echo base_url() . $data_info['logo'];
                         } else {
                             echo base_url() . "all_upload/default/aims.png";
                         }
                         ?>" width="50"/>
                    <h3><p class="user" > &nbsp; <?php
                        if (!empty($data_info['instituteName'])) {
                            echo "" . $data_info['instituteName'];
                        }
                         ?> </p>
                    </h3>
                    <div class="time">
                        &nbsp;
                        <span class="editable" id="country"><?php
                            echo ($institute_info->address) ? $institute_info->address : "";
                            ?></span>,
                 
                        <span class="editable" id="country">
                            <?php
                            if (!empty($data_info['district'])) {
                                foreach (getDistrictName() as $key => $value) {
                                    if ($key == $data_info['district']) {
                                        echo $value;
                                    }
                                }
                            }
                            ?>
                        </span><br>
                        <h4> Student Position List </h4>
                    </div>

                </div>
                <br>
                <center>
                        <div id="id-message-infobar" style="background: #e5e5e5 none repeat scroll 0 0; margin-left: -18px; padding: 3px;">
                            <span class="blue bigger-130"><?php if(!empty($programId)){ echo "Session : ".getSessionName($sessionId)." - Class : ".getProgramName($programId)." - Group : ".getGroupName($groupId)." - Shift : ".getShiftName($shiftId)." - Section : ".getSectionName($sectionId)." - Semester :  ".getSemesterName($semesterId); } ?> </span>
                        </div>
                    </center> 
                 
            </div>
        <table id="simple-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Class Position</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>Total Mark</th>
                    <th>Obtain Mark</th>
                    <th>GPA</th>
                    <th>Grade Letter</th>
                    <th class="none">Print</th>
                </tr>
            </thead>
            <tbody>
            <?php //echo '<pre>';print_r($records);exit; ?>
            <?php 
              if ($records):
              foreach ($records as $val) : 
                $stuent_id = $val['student_id'];
            ?>
              <tr>
                <td><?php echo $val['position']; ?></td>
                <td><?php echo $val['student_id']; ?></td>
                <td><?php echo $val['student_name']; ?></td>
                <td><?php echo $val['total_marks']; ?></td>
                <td><?php echo $val['total_obtain_marks']; ?></td>
                <td><?php echo $val['gpa_point']; ?></td>
                <td><?php echo $val['gpa_letter']; ?></td>
                <td class="none"><a target="_blank" href="<?php echo site_url()."systemaccess/studentmarks/transcriptView2?stuent_id=$stuent_id&program_offer_id=$program_offer_id&semester_id=$semester_id" ?>">Print</td>
              </tr>
            <?php endforeach; endif;?>
            </tbody> 
        </table>
      </div>        
    </div>    


    <?php
}
?>


<!-- Right Side/Main Content End --> 
