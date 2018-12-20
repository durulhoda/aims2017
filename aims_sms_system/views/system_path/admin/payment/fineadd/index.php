<!-- /Content Section  -->                    
<div class="page-header">
   <h1> 
      Payment
      <small class="red">
      <i class="ace-icon fa fa-angle-double-right"></i>
      Student Fine
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
<!-- div.table-responsive -->
<div class="row">
   <div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->
      <form  action="<?php echo admin_Url(); ?>/payments/insertfine" method="post" class="form-horizontal" role="form">
      <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Session: &nbsp; </label>
            <select required="" name="data[sessionId]">
              <option value="">Select a session ...</option>
              <?php foreach (getOfferedSession() as $value) { ?>
                <option value="<?php echo $value['sessionId']; ?>" 
                        <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                    <?php echo $value['session']; ?></option>                                                
            <?php } ?>
            </select>
         </div>
         <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student ID: &nbsp; </label>
            <!-- <input type="text" required="1" id="Name" placeholder="Student Id" class="Name" name="data[studentId]" /> <br /> -->
            <select id="studentSelected" name="data[studentId]" required="" class="form-control" style="max-width: 150px;width: 150px;">
                <option value="">Select</option>
                <?php if ($studentidlist) : ?>
                <?php foreach($studentidlist as $val) : ?>
                    <option value="<?php echo $val->studentId ?>"><?php echo $val->studentId ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
         </div>
         <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fine Cause: &nbsp; </label>
            <select name="data[finehead]" required="">
                <option value="">Select</option>
                <?php foreach ($finecauselist as $key => $value) : ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
         </div>
         <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fine Amount : &nbsp; </label>
            <input type="text" required="1" id="Name" class="Name" placeholder="Enter Amount" name="data[amount]" /> <br />
         </div>
         <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
               <button class="btn btn-info" name="submit" type="submit">
               <i class="ace-icon fa fa-check bigger-110"></i>
               Submit
               </button>
            </div>
         </div>
      </form>
   </div>
   <!-- /.col-x12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Session</th>
                    <th>Class</th>
                    <th>Group</th>
                    <th>Student Id</th>
                    <th>Fine Cause</th>
                    <th>Amount</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($studentfinelist) : ?>
                <?php foreach($studentfinelist as $key => $val) : ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $val->session; ?></td>
                    <td><?php echo $val->programName; ?></td>
                    <td><?php echo $val->groupName; ?></td>
                    <td><?php echo $val->studentId; ?></td>
                    <td><?php echo isset($finecauselist[$val->finehead]) ? $finecauselist[$val->finehead] : ''; ?></td>
                    <td><?php echo $val->amount; ?></td>
                    <td></td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.row --> 
<!-- <div class="row">
   <div class="col-xs-12">
      <form  action="<?php //echo admin_Url(); ?>/payments/searchfine" method="post" class="form-horizontal" role="form">
         <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student ID: &nbsp; </label>
            <input type="text" required="1" id="Name" class="Name" placeholder="Student Id" name="data[studentId]" /> <br />
         </div>
         <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
               <button class="btn btn-info" name="submit" type="submit">
               <i class="ace-icon fa fa-check bigger-110"></i>
               Search
               </button>
            </div>
         </div>
      </form>
   </div>
</div> -->
<!-- /.row -->

<script type="text/javascript">
      $("#studentSelected").select2();

      // $(document).on('keyup', '#studentSelected', function(){
      //   alert(5);
      // });
      // $(document).on('keyup', '#studentSelected', function(){
      //   alert(5);
      // });
      
    </script>