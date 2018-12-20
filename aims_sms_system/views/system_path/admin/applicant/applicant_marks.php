<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Admission Test Information 
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Admission Test Marks 
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/applicant/applicant_marks" method="post">
                
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
            <div class="col-md-6 col-md-offset-3">
                <div class="clearfix form-actions">
                    <div class="col-md-12">
                        <button class="btn btn-success" name="search" type="submit">
                            <i class="ace-icon fa fa-search bigger-120"></i>
                           Applicant Mark Search
                        </button>
                        <a href="<?php echo site_url('systemaccess/applicant/applicant_marks'); ?>" class="btn btn-info"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                    </div>
                </div>
            </div>  
         </div>
            </form>
            
              <?php
            if (!empty($applicantlist)) {
                ?>
                <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/applicant/applicant_marks_add" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="success">
                                    <th colspan="1">&nbsp;</th>
                                    <th>Session:&nbsp;<?php echo "<b>".getSessionName($sessionId)."</b>"; ?></th>
                                    <th>Class Level:&nbsp;<?php
                                                foreach (getProgramLevel() as $key =>$value) {
                                                    if ($programLevel == $key) {
                                                        echo "<b>" . $value . "</b>";
                                                    }
                                                }
                                                ?></th>
                                    <th>Class:&nbsp;<?php echo "<b>" . getProgramName($programId) . "</b>"; ?></th>
                                    <th>Medium:&nbsp;<?php echo "<b>" . getmediumName($mediumId) . "</b>"; ?></th>
                                    <th>Group:&nbsp;<?php echo "<b>" . getGroupName($groupId) . "</b>"; ?></th>
                                    <th>Shift:&nbsp;<?php echo "<b>" . getshiftName($shiftId) . "</b>"; ?></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>                                
                                <th>#</th>
                               <!-- <th>All&nbsp;<input type="checkbox" name="check_all"></th> -->
                                <th>Applicant Id</th>
                                <th>Student Name</th>
                                <th>Bangla<spna class="bangla_d"><?php echo isset($exam_info->bangla) ? "(".$exam_info->bangla.")" : ""; ?></spna></th>
                                <th>English<spna class="english_d"><?php echo isset($exam_info->english) ? "(".$exam_info->english.")" : ""; ?></spna></th>
                                <th>Mathmatics<spna class="math_d"><?php echo isset($exam_info->math) ? "(".$exam_info->math.")" : ""; ?></spna></th>
                                <th>General Knowledge<spna class="gen_d"><?php echo isset($exam_info->gk) ? "(".$exam_info->gk.")" : ""; ?><input type="hidden" name="program_offer_id" value="<?php echo $program_offer_id; ?>"  /></spna></th>
                                <th>Sub Total Marks</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                foreach ($applicantlist as $key => $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $key+1; ?></td>
                                        <!-- <td><input type="checkbox" name="checkbox[]" value="<?php echo $key+1; ?>"></td> -->
                                        <td><?php echo $value['applicationId']; ?>
                                            <input type="hidden" name="applicant_id[]" value="<?php echo $value['applicationId']; ?>">
                                        </td>
                                        <td> <?php echo $value['firstName']; ?>
                                            <input type="hidden" name="edit_id[]" value="<?php echo isset($edit_info[$value['applicationId']]) ? round($edit_info[$value['applicationId']]['id']) : 0; ?>">
                                        </td>
                                        <td> 
                                            <input type="text" style="width: 100px;" name="bangla[]" class="bangla" value="<?php echo isset($edit_info[$value['applicationId']]) ? round($edit_info[$value['applicationId']]['bangla']) : ''; ?>" />
                                        </td>
                                        <td> 
                                            <input type="text" style="width: 100px;" name="english[]" class="english" value="<?php echo isset($edit_info[$value['applicationId']]) ? round($edit_info[$value['applicationId']]['english']) : ''; ?>" />
                                        </td>
                                        <td>
                                            <input type="text" style="width: 100px;" name="math[]" class="math" value="<?php echo isset($edit_info[$value['applicationId']]) ? round($edit_info[$value['applicationId']]['math']) : ''; ?>" />
                                        </td>
                                          <td>
                                            <input type="text" style="width: 100px;" name="general_knowledge[]" class="general_knowledge" value="<?php echo isset($edit_info[$value['applicationId']]) ? round($edit_info[$value['applicationId']]['gen']) : ''; ?>" />
                                        </td>
                                          <td>
                                             <input type="text" style="width: 100px;" readonly="" name="sub_total[]" class="sub_total" value="<?php echo isset($edit_info[$value['applicationId']]) ? round($edit_info[$value['applicationId']]['total']) : ''; ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div><!-- /.span -->
                </div><!-- /.row -->
                <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="clearfix form-actions">
                    <div class="col-md-12">
                        <button class="btn btn-success" name="search" type="submit">
                            <i class="ace-icon fa fa-save bigger-120"></i>
                           Save
                        </button>
                        <a href="<?php echo site_url('systemaccess/applicant/applicant_marks'); ?>" class="btn btn-info"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                    </div>
                </div>
            </div>  
         </div>
                </form>
                <?php
            }
            ?>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 

    
 <script type="text/javascript">

 function check($this, value = 0, $type) {
    if ($type == 1) {
        var value_d = parseFloat($('.bangla_d').text().slice(1, -1));
        var chname= ".bangla";
    } else if($type == 2) {
        var value_d = parseFloat($('.english_d').text().slice(1, -1));
        var chname= ".english";
    }else if($type == 3) {
        var value_d = parseFloat($('.math_d').text().slice(1, -1));
        var chname= ".math";
    }else if($type == 4) {
        var value_d = parseFloat($('.gen_d').text().slice(1, -1));
        var chname= ".general_knowledge";
    }
    if (isNaN(value_d)) {
        var value_d = 0;
    }
    if (value > value_d) {
        $this.find(chname).val(value_d);
       var value = value_d;
    }
    if (!value) {
        var value = 0;
    }
    return value;
 }

 $(document).on('keyup','.bangla, .english, .math, .general_knowledge', function(){
    
    var english_d = 25;
    var math_d = 25;
    var gen_d = 25;
    $this = $(this).closest('tr');
    var bangla = parseFloat($this.find('.bangla').val());
    var bangla = check($this,bangla, 1);
    
    var english = parseFloat($this.find('.english').val());
    var english = check($this,english, 2);

    var math = parseFloat($this.find('.math').val());
    var math = check($this,math, 3);

    var gen_kno = parseFloat($this.find('.general_knowledge').val());
    var gen_kno = check($this,gen_kno, 4);

    calculate(bangla, english, math, gen_kno, $this);
 });

 function calculate(bangla = 0, english = 0, math = 0, gen_kno = 0, $this) {
    var sub_total = (bangla + english + math + gen_kno);
    console.log("bangla:"+bangla+" english:"+english+" math:"+math+" gen_kno:"+gen_kno+" dd:"+sub_total);
    $this.find(".sub_total").val(sub_total);
 }
</script>

