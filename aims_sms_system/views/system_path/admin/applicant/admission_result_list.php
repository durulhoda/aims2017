<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Admission Test Result 
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Admission Test Result List 
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/applicant/admission_result_list" method="post">
                
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
                    <div class="has-error col-xs-6 col-sm-2">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId();" name="datax[shiftId]" required="1" class="form-control" >

                        </select>
                    </div>
                    <div class="has-error col-xs-6 col-sm-2">
                        <label class="control-label" for="form-field-1">Status  &nbsp; <?php echo form_error('datax[status]', '<span class="successMessage">', '</span>'); ?></label>
                        <select class="form-control" name="datax[status]">
                                <option value="7">All</option>
                                <option value="1">Allow</option>
                                <option value="2">Waiting</option>
                                <option value="3">Not Allow</option>
                                <option value="4"> Allow && Waiting</option>
                                <option value="5"> Allow && Not Allow</option>
                                <option value="6"> Waiting && Not Allow</option>
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
                        <a href="<?php echo site_url('systemaccess/applicant/admission_result_list'); ?>" class="btn btn-info btn-sm"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                    </div>
                </div>
            </div>  
         </div>
            </form>
            <hr>
            	<style type="text/css">
            		.c_print{
            			    position: absolute;
						    z-index: 9999;
						    top: 5px;
						    right: 40px;
            		}
            	</style>
            	<?php if (isset($records)) : ?>
                <div class="row" id="printableArea">
                <style tyle="text/css">
			        @media print
			       	{
			       		.c_print{display: none;}
			       	}
			    </style>
                	<div class="col-md-12">
                		<table style="width:100%; margin-bottom: 5px">
							<tbody>
								<tr style=" font-family: cambria;"> 
									<td style="text-align: center;" colspan="6">
										<?php $logo = base_url().$institute_info->logo;?>
											<p style="margin-left:5px;">
											<img src="<?php echo $logo; ?>" style="margin-top:3px;" height="80" />  
											<div style="font-size: 20px; font-size: 35px; color: royalblue;">    
												<?php echo ($institute_info->institute_name) ? $institute_info->institute_name : "";?>          
											</div>                                           
											<div style="line-height: 3px; font-size: 18px; color: #444;"> 
												<?php echo ($institute_info->address) ? $institute_info->address : ""; ?>                
											</div>
											</p>
											<span><button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border c_print">
												<span class="btn btn-purple no-border">
												  <i class="ace-icon fa fa-print bigger-130"></i>
												  <span class="bigger-110">Print</span>
												</span>
											</button></span>
										</td>
								</tr>
								<tr>
									<td style="text-align: center; " colspan="6">
										<h3 style="font-family: Algerian;color:red;">ADMISSION TEST RESULT</h3> 
									</td> 
								</tr>
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
                                <!-- <th>All&nbsp;<input type="checkbox" name="check_all"></th> -->
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
                                    	<!-- <td><input type="checkbox" name="result_id[]" value="<?php echo $val->id; ?>"></td> -->
                                    	<td><?php echo $val->applicant_id; ?><input type="hidden" name="result_id[]" value="<?php echo $val->id; ?>"></td>
                                    	<td><?php echo $val->applicant_name; ?></td>
                                    	<td><?php echo $val->bangla_mark; ?></td>
                                    	<td><?php echo $val->english_mark; ?></td>
                                    	<td><?php echo $val->math_mark; ?></td>
                                    	<td><?php echo $val->general_mark; ?></td>
                                    	<td><?php echo $val->total_mark; ?></td>
                                        <td><?php
                                            if ($val->status == 1) {
                                                echo "Allow";
                                            } elseif ($val->status == 2) {
                                                echo "Waiting";
                                            } elseif ($val->status == 3) {
                                                echo "Not Allow";
                                            } else {
                                                echo "No Assing";
                                            }
                                         ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                            	<tr>
                            		<td colspan="8" style="text-align: center;font-size: 20px;">No Found!</td>
                            	</tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div><!-- /.span -->
                </div><!-- /.row -->
            <?php endif; ?>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
