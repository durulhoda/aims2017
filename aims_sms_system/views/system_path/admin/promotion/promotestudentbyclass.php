
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Confirm Student Re-Registration
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Verify Student Promotion Information
            </small>
        </h1>
    </div><!-- /.page-header -->
<div class="row">
    
     <div class="row">
                    
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b> Current Enrollment Information</b>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                            <?php 
                                                      if(!empty($sessionId)) {echo "<b>".getSessionName($sessionId)."</b>"; }                                               

                                              ?>
                                        </li>

                                   

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                                <?php
                                                    if(!empty($programId))   {  echo "<b>" . getProgramName($programId) . "</b>";}
                                                ?>
                                        </li>

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                             <?php
                                                      if(!empty($shiftId))  {echo "<b>" . getshiftName($shiftId) . "</b>";}
                                                ?>
                                        </li>
                                    </ul>
                                </div>
                             </div>   
                             <div class="col-xs-12 col-sm-6">
                                <div>
                                    <ul class="list-unstyled spaced">
                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                            <?php
                                                    if(!empty($mediumId))   { echo "<b>" . getmediumName($mediumId) . "</b>";}
                                                ?>
                                        </li>

                                     

                                        <li>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                            <?php
                                            if (!empty($groupId)) {
                                                echo "<b>" . getGroupName($groupId) . "</b>";
                                            }
                                            ?>
                                        </li>

                                    </ul>
                                </div>
                             </div>   
                        </div><!-- /.col -->


                    </div><!-- /.row -->
            <form action="<?php echo admin_Url(); ?>/promotestudent/reregistrationConfarm" method="post">
         
    <div class="col-sm-7">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-quote-left smaller-80"></i>
                    Student List
                </h4>
            </div>
          
            <div class="widget-body">
                <div class="widget-main">
                   <table id="simple-table" class="table table-striped table-bordered table-hover">
                                
                                                                   <script language="JavaScript">
            function toggle(source) {
              checkboxes = document.getElementsByName('checkAll[]');
              for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
              }
            }
                                          
            </script>
            
            
                                <thead>
                                    <tr>
                                        <th class="center">
                                            Sl No.
                                        </th>
                                      
                                        <th><input type="checkbox"  name="checkall" onClick="toggle(this)" /><br> Select</th>

                                        <th>Student Id</th>
                                        <th>Student Name</th>
                                        <th>Gender</th>
                                        <th> Religion </th>
                                        <th>Image</th>
                                        
                                        <th style="width: 90px;">Roll No</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sl = 1;
                                    foreach ($studentlist as $value) {
                                        ?>

                                        <tr>
                                            <td class="center">
                                                <?php echo $sl; ?>
                                            </td>
                                            <td>
                                                
                                                 <input type="hidden" name="studentId[]" value="<?php if (!empty($value['studentId'])) { echo $value['studentId'];} ?>">
                           
                                                 <input type="checkbox" name="checkAll[]" value="<?php echo $sl;?>">
                                                 
                                                
                                            </td>
                                            <td>
                                                <a target="_blank" href="<?php echo admin_Url(); ?>/applicant/viewappliantInfo/<?php echo $value['applicationId']; ?>" >
                                                    <?php
                                                    if (!empty($value['studentId'])) {
                                                        echo $value['studentId'];
                                                    }
                                                    ?>
                           
                                                </a>
                                            </td>

                                            <td><?php if (!empty($value['firstName'])) {
                                                echo "<b>" . $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'] . "</b>";
                                            } ?></td>
                                            <td><?php if (!empty($value['gender'])) {
                                                echo element($value['gender'], getGendar(), Null);
                                            } ?></td>
                                            
                                            <td><?php if (!empty($value['religion'])) {
                                                echo element($value['religion'], getReligion(), Null);
                                            } ?></td>


                                            <td>
                                                <?php
                                                if ($value['photo']) {
                                                    ?>
                                                    <img  src="<?php if (file_exists($value['photo'])) {
                                            echo base_url() . $value['photo'];
                                        } else {
                                            echo base_url() . "uploads/default/default.png";
                                        } ?>" width="60" height="60">
            <?php
        }
        ?>
                                            </td>

                                            <td>
                                                <input type="text" name="roll_no[]" class="form-control">
                                                <!-- <div class="hidden-sm hidden-xs action-buttons">
                                                    <a class="blue" target="_blank" href="<?php echo admin_Url(); ?>/applicant/viewappliantInfo/<?php echo $value['applicationId']; ?>" title="View">
                                                        <i class="ace-icon fa fa-search bigger-130"></i>
                                                    </a>
                                                  

                                                </div> -->

                                                <!-- <div class="hidden-md hidden-lg">
                                                    <div class="inline pos-rel">
                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                    <span class="blue">
                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                           

                                                        </ul>
                                                    </div>
                                                </div> -->
                                            </td>
                                        </tr>
        <?php
       $sl++;  
    }
    
    ?>

                                </tbody>   
                            </table>   

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-5">       

        <div class="row">
            <div class="col-xs-12">
               
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                                New Enrollment Information
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main row ">
                              
                                       <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]'); ?></label>
                                                    <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                                        <option value="">Select</option>
                                                        <?php foreach (getOfferedSession() as $value) { ?>
                                                            <option value="<?php echo $value['sessionId']; ?>" >
                                                                <?php echo $value['session']; ?></option>                                                
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]'); ?></label>
                                                    <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId(); " name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]'); ?></label>
                                                    <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]'); ?></label>
                                                    <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]'); ?></label>
                                                    <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                                                    </select>
                                                </div>
                                                <div class=" col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]'); ?></label>
                                                    <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                                                    </select>
                                                </div>
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]'); ?></label>
                                                    <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                                                    </select>
                                                </div>                                                
                                                <div class="col-xs-10 col-sm-4">
                                                    <label class="control-label red" for="form-field-1">Result Status  &nbsp; <?php echo form_error('data[promotionStatus]'); ?></label>
                                                    <select name="data[promotionStatus]" required class="redtxt">
                                                        <option value="" selected>Select</option>
                                                        <option value="1">Promoted</option>
                                                        <option value="2">Non-Promoted</option>

                                                    </select>
                                                </div>
                                                    

                                            </div> 

                            </div>

                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-danger" name="regConfirm">
                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Confirm Re-Registration
                    </button>
             
                
            </div>
        </div>
    </div>   </form> 
</div><!-- PAGE CONTENT ENDS -->



