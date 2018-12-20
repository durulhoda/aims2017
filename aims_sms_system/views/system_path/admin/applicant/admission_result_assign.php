<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Admission Test Result Assign
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Admission Test Result Assign 
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/applicant/admission_result_assign" method="post">
                
                   <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                 
                   <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSessionId();" data-placeholder="Select" name="datax[sessionId]"  required="1" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('datax[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('datax[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="datax[programLevel]" data-placeholder="Select" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" onchange="return getOfferedprogramId();" name="datax[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId();" name="datax[mediumId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId();" name="datax[groupId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId();" name="datax[shiftId]" required="1" class="form-control" >

                        </select>
                    </div>
                 
                    </div>
         <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="clearfix form-actions" style="padding: 8px;text-align: center;">
                    <div class="col-md-12">
                        <button class="btn btn-success btn-sm" name="search" type="submit">
                            <i class="ace-icon fa fa-search bigger-120"></i>
                           Search
                        </button>
                        <a href="<?php echo site_url('systemaccess/applicant/admission_result_assign'); ?>" class="btn btn-info btn-sm"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                    </div>
                </div>
            </div>  
         </div>
            </form>
            <hr>
            	<?php if (isset($records)) : ?>
                <div class="row">
                	<div class="col-md-12">
                    <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/applicant/admission_result_assign_status" method="post">
                		<table style="width:100%; margin-bottom: 5px">
							<tbody>
								<tr>
									<th>Session:&nbsp;<?php echo isset($sessionId) ? getSessionName($sessionId) : ""; ?></th>
									<th>Class Level:&nbsp;<?php
												if (isset($programLevel)) :
                                                foreach (getProgramLevel() as $key =>$value) {
                                                    if ($programLevel == $key) {
                                                        echo $value;
                                                    }
                                                }
                                                endif;
                                                ?></th>
									<th>Class:&nbsp;<?php echo isset($programId) ? getProgramName($programId) : ""; ?></th>
									<th>Medium:&nbsp;<?php echo isset($mediumId) ? getmediumName($mediumId) : ""; ?></th>
									<th>Group:&nbsp;<?php echo isset($groupId) ? getGroupName($groupId) : ""; ?></th>
									<th>Shift:&nbsp;<?php echo isset($shiftId) ? getshiftName($shiftId) : ""; ?></th>
								</tr>
							</tbody>
						</table>
                	</div>
                    <div class="col-xs-12">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="info">                                
                                <th>#</th>
                                <th>Applicant Id</th>
                                <th>Applicant Name</th>
                                <th>Bangla</th>
                                <th>English</th>
                                <th>Mathmatics</th>
                                <th>General Knowledge</th>
                                <th>Total</th>
                                <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                	if ($records) :
                                	foreach ($records as $key => $val) :
                                ?>
                                    <tr>
                                    	<td><?php echo $key+1; ?></td>
                                    	<td><?php echo $val->applicant_id; ?><input type="hidden" name="result_id[]" value="<?php echo $val->id; ?>"></td>
                                    	<td><?php echo $val->applicant_name; ?></td>
                                    	<td><?php echo $val->bangla_mark; ?></td>
                                    	<td><?php echo $val->english_mark; ?></td>
                                    	<td><?php echo $val->math_mark; ?></td>
                                    	<td><?php echo $val->general_mark; ?></td>
                                    	<td><?php echo $val->total_mark; ?></td>
                                        <td>
                                            <select class="form-control" name="status[]" required="">
                                                <option value="" <?php echo ($val->status == 0) ? 'selected' : '' ?>>Status</option>
                                                <option value="1" <?php echo ($val->status == 1) ? 'selected' : '' ?>>Allow</option>
                                                <option value="2" <?php echo ($val->status == 2) ? 'selected' : '' ?>>Waiting</option>
                                                <option value="3" <?php echo ($val->status == 3) ? 'selected' : '' ?>>Not Allow</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                	<td colspan="9" style="text-align: center;color: red;">
                                		<button class="btn btn-success btn-sm callow" name="search" type="submit">
                            				<i class="ace-icon fa fa-save bigger-120"></i>
                           						Save
                        				</button>
                                	</td>
                                </tr>
                            <?php else : ?>
                            	<tr>
                            		<td colspan="8" style="text-align: center;font-size: 20px;">No Found!</td>
                            	</tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                        </form>
                    </div><!-- /.span -->
                </div><!-- /.row -->
            <?php endif; ?>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 

    
 <script type="text/javascript">

 	$(document).on('click','input[name="check_all"]', function(){
 		$('input:checkbox').not(this).prop('checked', this.checked);
 	});
</script>

