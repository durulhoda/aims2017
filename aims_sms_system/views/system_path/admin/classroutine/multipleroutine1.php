<!-- /Content Section  -->    
<style type="text/css">
.break_time{
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: red;
    padding: 10px;
    
}
li.select2-search.select2-search--inline{
          margin-left: 10px;
    }
</style>                
<div class="page-header">
   <h1>
      Class Rotine
      <small class="red">
      <i class="ace-icon fa fa-angle-double-right"></i>
      Generate Class Routine
      </small>
   </h1>
</div>
<!-- /.page-header -->
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
      <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/classroutine/searchlist" method="post">
         <div class="col-xs-12 col-sm-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
               <select id="getsessionid" onchange="return getOfferedSessionId();" data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                  <option value="">Select</option>
                  <?php foreach (getOfferedSession() as $value) { ?>
                  <option value="<?php echo $value['sessionId']; ?>" 
                     <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                     <?php echo $value['session']; ?>
                  </option>
                  <?php } ?>
               </select>
            </div>
            <div class=" col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
               <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">
               </select>
            </div>
            <div class="col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
               <select id="getprogramid" onchange="return getOfferedprogramId();" name="data[programId]" required="1" class="form-control">
               </select>
            </div>
            <div class=" col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
               <select id="getmediumid" onchange="return getOfferedmediumId();" name="data[mediumId]" required="1" class="form-control">
               </select>
            </div>
            <div class=" col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
               <select id="getshiftid" onchange="return getOfferedshiftId();" name="data[shiftId]" required="1" class="form-control" >
               </select>
            </div>
            <div class="col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
               <select id="getgroupid" onchange="return getOfferedgroupId();" name="data[groupId]" required="1" class="form-control">
               </select>
            </div>
            <div class="col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
               <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
               </select>
            </div>
            <div class="col-xs-10 col-sm-4">
               <label class="control-label" for="form-field-1">Day  &nbsp; <?php echo form_error('data[dayName]', '<span class="red">', '</span>'); ?></label>
               <select data-placeholder="Select" name="data[dayName]"  required="1" class="form-control">
                  <option value="">Select</option>
                  <?php foreach (getDay() as $value) { ?>
                  <option value="<?php echo $value ?>" 
                     <?php echo set_select('data[dayName]', $value, FALSE) ?> >
                     <?php echo $value ?>
                  </option>
                  <?php } ?>
               </select>
            </div>
         </div>
         <div class="col-xs-12">
            <div class="clearfix form-actions">
               <div class="col-md-12">
                  <button class="btn btn-success" name="search" type="submit">
                  <i class="ace-icon fa fa-search bigger-120"></i>
                  Search Class Routine Information
                  </button>
               </div>
            </div>
         </div>
      </form>
   </div>

   <!-- /.col-x12 -->
   <div class="col-xs-12">
      <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/classroutine/class_routine_add" method="post">
         <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
               <div class="row">
                  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                     <b> Subject Offer List According To Your Enrollment Information</b>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-6">
                  <div>
                     <ul class="list-unstyled spaced">
                        <li>
                           <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                           <?php
                              if (!empty($sessionId)) {
                                  echo "<b>" . getSessionName($sessionId) . "</b>";
                              }
                              ?>
                           <input type="hidden" value="<?php echo $sessionId; ?>" name="sessionId">
                        </li>
                        <li>
                           <i class="ace-icon fa fa-caret-right blue"></i>Class:
                           <?php
                              if (!empty($programId)) {
                                  echo "<b>" . getProgramName($programId) . "</b>";
                              }
                              ?>
                           <input type="hidden" value="<?php echo $programId; ?>" name="programId">
                        </li>
                        <li>
                           <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                           <?php
                              if (!empty($mediumId)) {
                                  echo "<b>" . getmediumName($mediumId) . "</b>";
                              }
                              ?>
                           <input type="hidden" value="<?php echo $mediumId; ?>" name="mediumId">
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-6">
                  <div>
                     <ul class="list-unstyled spaced">
                        <li>
                           <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                           <?php
                              if (!empty($groupId)) {
                                  echo "<b>" . getGroupName($groupId) . "</b>";
                              }
                              ?>
                           <input type="hidden" value="<?php echo $groupId; ?>" name="groupId">
                        </li>
                        <li>
                           <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                           <?php
                              if (!empty($sectionId)) {
                                  echo "<b>" . getsectionName($sectionId) . "</b>";
                              }
                              ?>
                           <input type="hidden" value="<?php echo $sectionId; ?>" name="sectionId">
                        </li>
                        <li>
                           <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                           <?php
                              if (!empty($shiftId)) {
                                  echo "<b>" . getshiftName($shiftId) . "</b>";
                              }
                              ?>
                           <input type="hidden" value="<?php echo $shiftId; ?>" name="shiftId">
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->

        <?php if(isset($check)) : ?>
        <div style="background: #eee;  border-radius: 2px;
             color: firebrick;
             font-size: 16px;
             padding: 8px;
             text-align: center;">Re Genetate Class Routine For - <?php echo $dayName; ?>   
        </div>
      <?php else : ?>
        <div style="background: #eee;  border-radius: 2px;
             color: #355f39;
             font-size: 16px;
             padding: 8px;
             text-align: center;"> Genetate Class Routine For - <?php echo $dayName; ?>  
        </div>
      <?php endif; ?>
        <table id="simple-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>                                
                    <th>Sl No.</th>
                    <th>Select</th>
                    <th>Period Name/Time</th>
                    <th style="width: 600px;">Subject Name</th>
                </tr>
            </thead>
                 <tbody id="datainfo2">
                 <?php
                    foreach ($periodlist as $key => $value) {
                ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>

                        <td><input type="checkbox" name="serial[]" value="<?php echo $key+1; ?>" <?php echo ($value['is_break_time']) ? "checked disabled": "";?>>
                          <?php if ($value['is_break_time']) : ?>
                            <input type="hidden" name="serial[]" value="<?php echo $key+1; ?>">
                          <?php endif; ?>
                        </td>

                        
                        <td>
                            <?php echo $value['periodName']."/".$value['periodTime']; ?>
                            <input type="hidden" name="periodId[]" value="<?php echo $value['periodId'];?>">
                        </td>
                       <?php if (!$value['is_break_time']) : ?>
                        <td>
                            <select multiple id="e<?php echo $key+1; ?>" name="courseId[<?php echo $key; ?>][]"  class="form-control" style="max-width: 600px;width: 582px;">
                                <option value="">Select</option>
                                <?php foreach ($courselist as $value) { ?>
                                    <option value="<?php echo $value['courseId']; ?>" 
                                            <?php echo set_select('data[courseId]', $value['courseId'], FALSE) ?> >
                                            <?php echo $value['courseName']; ?></option>                                                
                                <?php } ?>
                            </select>
                        </td>
                      <?php else : ?>
                        <td class="break_time">Tiffin Time&nbsp;(<?php echo $value['periodTime']; ?>)
                        <input type="hidden" name="courseId[][]" value="0">
                        </td>
                      <?php endif; ?>
                    </tr>
                    <?php } ?>
                 </tbody>
        </table>
        <div class="col-xs-12">
            <div class="clearfix form-actions">
                <div class="col-md-12">
                    <input type="hidden" name="programOfferId" value="<?php echo $programOfferId['programOfferId']; ?>">
                     <input type="hidden" name="dayName" value="<?php echo $dayName; ?>">
                      <input type="hidden" name="shiftId" value="<?php echo $shiftId; ?>">
                    <button class="btn btn-success" name="btnSubmit" type="submit">
                        Save Routine Information
                    </button>

                </div>
            </div>
        </div>

      </form>
   </div>
</div>
<!-- /.row -->

<script type="text/javascript">
      var count = $('#simple-table tbody tr').length;
      for($i=1;$i<=count;$i++) {
        $("#e"+$i).select2();
      }
      
    </script>