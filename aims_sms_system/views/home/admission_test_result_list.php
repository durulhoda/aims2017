<!-- ASIDE NAV AND CONTENT -->
<style type="text/css">
    .has-error{
            float: left;
    margin-left: 12px;
        margin-bottom: 10px;
    margin-top: 5px;
    }
</style>
<div class="line">
    <div class="box  margin-bottom">
        <div class="margin">
            <section class="s-12 l-12">

                <?php
                $redmessage = $this->session->userdata('redmessage');
                if (isset($redmessage)) {
                    echo "<span id='messagefail' class='redmessage'>" . $redmessage . "</span>";
                }

                $this->session->unset_userdata('redmessage');
                ?>
                <?php
                $message = $this->session->userdata('message');

                if (isset($message)) {
                    echo "<span id='messagesuc'>" . $message . "</span>";
                }
                $this->session->unset_userdata('message');
                ?>

                <h3 class="titlehd">Admission Test Result List</h3>


                <form class="form-horizontal" role="form" action="<?php echo base_url();?>home/admisssion_result_list" method="post">
                <fieldset>
                    <legend class="lgnd"> <span>Search</span></legend>
                   <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                 
                   <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('datax[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" style="width: 100px;" onchange="return getOfferedSessionId();" data-placeholder="Select" name="datax[sessionId]"  required="1" class="form-control">
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
                        <select id="getprogramLevelid" style="width: 200px;" onchange="return getOfferedprogramLevelId();" name="datax[programLevel]" data-placeholder="Select" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('datax[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" style="width: 150px;" onchange="return getOfferedprogramId();" name="datax[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('datax[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" style="width: 150px;"  onchange="return getOfferedmediumId();" name="datax[mediumId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('datax[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" style="width: 150px;"  onchange="return getOfferedgroupId();" name="datax[groupId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class="has-error col-xs-6 col-sm-2">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('datax[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" style="width: 150px;"  onchange="return getOfferedshiftId();" name="datax[shiftId]" required="1" class="form-control" >

                        </select>
                    </div>
                    <!-- <div class="has-error col-xs-6 col-sm-2">
                        <label class="control-label" style="width: 150px;"  for="form-field-1">Status  &nbsp; <?php echo form_error('datax[status]', '<span class="successMessage">', '</span>'); ?></label>
                        <select class="form-control" name="datax[status]">
                                <option value="7">All</option>
                                <option value="1">Allow</option>
                                <option value="2">Waiting</option>
                                <option value="3">Not Allow</option>
                                <option value="4"> Allow && Waiting</option>
                                <option value="5"> Allow && Not Allow</option>
                                <option value="6"> Waiting && Not Allow</option>
                        </select>
                    </div> -->
                 
                    </div>
                <div class="clearfix form-actions has-error" style="padding: 8px;text-align: center;">
                    <div class="col-md-12">
                        <button class="btn btn-success btn-sm" name="search" type="submit" style="cursor: pointer;">
                            <i class="ace-icon fa fa-search bigger-120"></i>
                           Search
                        </button>
                        <button><a href="<?php echo site_url('home/admisssion_result_list'); ?>" class="btn btn-info btn-sm"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a></button>
                    </div> 
         </div>
         </fieldset>
            </form>
                    <?php if (isset($records)) : ?>
                    <style type="text/css">
                    #simple-table tr{

                    } 
                    #simple-table tr th{
                        border: 1px solid #ddd;
                    } 
                    #simple-table tr td{
                        border: 1px solid #ddd;
                    } 
                    .c_print{
                            position: absolute;
                            z-index: 9999;
                            top: 205px;
                            right: 40px;
                    }
                </style>
                    <fieldset id="printableArea">
                    <style tyle="text/css">
                    @media print
                    {
                        .c_print,.non{display: none;}
                        #simple-table tr{

                    } 
                    #simple-table tr th{
                        border: 1px solid #ddd;
                    } 
                    #simple-table tr td{
                        border: 1px solid #ddd;
                    } 
                    }
                </style>
                        <legend><span class="non">Result</span></legend>
                        <div class="col-md-12">
                        <table style="width:100%; margin-bottom: 5px">
                            <tbody>
                                <tr style=" font-family: cambria;"> 
                                    <td style="text-align: center;" colspan="6">
                                        <?php $logo = base_url().$institute_info->logo;?>
                                            <p style="margin-left:5px;">
                                            <img src="<?php echo $logo; ?>" style="margin-top:3px;width: 100px" height="80" />  
                                            <div style="font-size: 20px; font-size: 35px;margin-bottom: 19px; color: royalblue;">    
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
                    </fieldset>
                <?php endif; ?>
                
            </section>
        </div>
    </div>
</div>