<!-- /Content Section  -->
<div class="page-header">
    <h1>
        Add Employee Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            must be fill up all red box field
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
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
        <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/employee/insertemployee" method="post" enctype="multipart/form-data">
            <div class="col-xs-12 col-sm-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Employee Type &nbsp; <?php echo form_error('data[employeeType]', '<span class="successMessage">', '</span>'); ?></label>

                    <select id="getemployeeid" onchange="return getemployeetype();" name="data[employeeType]" class="form-control" id="form-field-select-1">
                        <option value="">Select</option>>
                        <?php
                        foreach(getmployeetypeList() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data[employeetypeId]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>

                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Designation &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                    <select id="getdesignation" onchange="return getdesignation(); " name="data[designation]" data-placeholder="Select" required="1" class="form-control">

                    </select>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Department &nbsp; <?php echo form_error('data[departmentId]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[departmentId]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getDepartmentInfoArray() as $value)
                        {
                            ?>
                            <option value="<?php echo $value['departmentId']; ?>"
                                <?php echo set_select("data[departmentId]", $key, FALSE); ?> >
                                <?php echo $value['departmentName']; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Employment Status &nbsp; <?php echo form_error('data[employmentStatus]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[employmentStatus]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getemployeestatusList() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data[employmentStatus]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Joining Date &nbsp; <?php echo form_error('data[joiningdate]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[joiningdate]" value="<?php echo set_value("data[joiningdate]"); ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Joining Date" />

                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Retirement Date &nbsp; <?php echo form_error('data[retirementDate]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[retirementDate]" value="<?php echo set_value("data[retirementDate]"); ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Retirement Date" />

                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Employee Status &nbsp; <?php echo form_error('data[employeeStatus]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[employeeStatus]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getEmployeeStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data[employeeStatus]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class=" has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Employee Position &nbsp; <?php echo form_error('data[positionNumber]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="number" min="1" max="500" name="data[positionNumber]" value="<?php echo set_value("data[positionNumber]"); ?>" class="form-control" id="form-field-mask-1" placeholder="Position Number" required/>

                </div>


            </div>

            <div class="col-xs-12 col-sm-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="hr hr-18 dotted hr-double"></div>
                <div class="has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">First Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                    <input required="1" type="text" name="data[firstName]" value="<?php echo set_value("data[firstName]"); ?>" class="form-control" id="form-field-1" placeholder="First Name" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Middle Name &nbsp; <?php echo form_error('data[middleName]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[middleName]" value="<?php echo set_value("data[middleName]"); ?>" class="form-control" id="form-field-1" placeholder="Middle Name" />
                </div>
                <div class="has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Last Name &nbsp; <?php echo form_error('data[lastName]', '<span class="successMessage">', '</span>'); ?></label>
                    <input required="1" type="text" name="data[lastName]" value="<?php echo set_value("data[lastName]"); ?>" class="form-control" id="form-field-1" placeholder="Last Name" />
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Father Name &nbsp; <?php echo form_error('data[fatherName]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[fatherName]" value="<?php echo set_value("data[fatherName]"); ?>" class="form-control" id="form-field-1" placeholder="Father Name" />
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Mother Name &nbsp; <?php echo form_error('data[motherName]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[motherName]" value="<?php echo set_value("data[motherName]"); ?>" class="form-control" id="form-field-1" placeholder="Mother Name" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Gender &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                    <div class="radio form-control">
                        <?php
                        foreach(getSex() as $key =>$value)
                        {
                            ?>
                            <label class="col-xs-6 col-sm-6">
                                <input name="data[gender]" value="<?php echo $key; ?>" <?php echo set_radio("data[gender]", $key, FALSE); ?> type="radio" class="ace" />
                                <span class="lbl"> <?php echo $value; ?> </span>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Mobile Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                    <input name="data[phone]" value="<?php echo set_value("data[phone]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                </div>
                <div class="has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[dateOfBirth]" value="<?php echo set_value("data[dateOfBirth]"); ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Date of Birth" />

                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[embreg]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[embreg]" value="<?php echo set_value("data[embreg]"); ?>" class="form-control" id="form-field-1" placeholder="Birth Registration Number" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Nationality &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[nationality]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getCountryName() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data[nationality]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">National ID Number &nbsp; <?php echo form_error('data[nationalIdentity]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[nationalIdentity]" value="<?php echo set_value("data[nationalIdentity]"); ?>" class="form-control" id="form-field-1" placeholder="National ID Number" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Blood Group &nbsp; <?php echo form_error('data[bloodGroup]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[bloodGroup]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getBloodGroup() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data[bloodGroup]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Marital Status &nbsp; <?php echo form_error('data[maritialStatus]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[maritialStatus]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getMeritialStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data[maritialStatus]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Email Address &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                    <input name="data[email]" value="<?php echo set_value("data[email]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Email Address" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[address]', '<span class="successMessage">', '</span>'); ?></label>
                    <textarea class="form-control" placeholder="Present Address" name="data[address]" value="<?php echo set_value("data[address]"); ?>" type="text" id="form-field-1"></textarea>
                </div>
                <div class="has-error col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Employee Image &nbsp; <?php echo form_error('photo', '<span class="successMessage">', '</span>'); ?></label>
                    <input name="photo" value="<?php echo set_value("photo"); ?>" type="file" id="id-input-file-2" />
                    <label class="control-label" for="form-field-1">Maintain Image Size: 250*250 </label>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Index No &nbsp; <?php echo form_error('data[indexno]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[indexno]" value="<?php echo set_value("data[indexno]"); ?>" class="form-control" id="form-field-1" placeholder="Index No" />
                </div>

            </div> <!-- /.col-sub-4 -->


            <div class="col-xs-12 col-sm-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="hr hr-18 dotted hr-double"></div>
                <div class="form-group">
                    <?php echo form_error('data[degree]', '<div style="color: rgb(255, 0, 0);">', '</div>'); ?>
<!--                    <label for="form-field-first" class="col-sm-2 control-label no-padding-right">Education Information</label>-->

                    <div class="col-sm-10"></div>

                </div>

                <div class="space-4"></div>


                <div class="input_fields_wrap">
                    <div class="form-group">
                        <label for="form-field-first" class="col-sm-1 control-label no-padding-right"><b>Education Information</b></label>

                        <div class="col-sm-11">

                            <table id="table01" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Program Type</th>
                                    <th>Discipline</th>
                                    <th>Grade</th>
                                    <th>Passing Year</th>
                                    <th>Board/Institution</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody id="add_table_body"></tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:center;"><button class="add_button_for_field ace-icon glyphicon glyphicon-plus" type="button" style="color: green;"></button></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="space-4"></div>
                </div>

            </div>


            <div class="col-xs-12 col-sm-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="hr hr-18 dotted hr-double"></div>
                <h4>Optional :</h4>

                <div class="row">


                    <div class="col-xs-3">
                        <label class="control-label" for="form-field-1">Basic Salary &nbsp; <?php echo form_error('data[basic_salary]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[basic_salary]" value="<?php echo set_value("data[basic_salary]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Basic Salary" />
                    </div>

                    <div class="col-xs-3">
                        <label class="control-label" for="form-field-1">Bank Account No. &nbsp; <?php echo form_error('data[bank_account_no]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[bank_account_no]" value="<?php echo set_value("data[bank_account_no]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Bank Account No." />
                    </div>

                    <div class="col-xs-3">
                        <label class="control-label" for="form-field-1">Increment Date &nbsp; <?php echo form_error('data[increment_date]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[increment_date]" value="<?php echo set_value("data[increment_date]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="Increment Date" />
                    </div>

                    <div class="col-xs-3">
                        <label class="control-label" for="form-field-1">G.P.F Date &nbsp; <?php echo form_error('data[gpf_no]', '<span class="successMessage">', '</span>'); ?></label>
                        <input name="data[gpf_no]" value="<?php echo set_value("data[gpf_no]"); ?>" type="text" class="form-control" id="form-field-1" placeholder="G.P.F No." />
                    </div>

                </div>

            </div>


            <div class="col-xs-12 col-sm-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="hr hr-18 dotted hr-double"></div>

                <h5 class="pink">
                    <i class="ace-icon fa fa-hand-o-right green"></i>
                    Login & Access Information
                </h5>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">HR &nbsp; <?php echo form_error('data_acx[hr]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[hr]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[hr]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">HR (Admin) &nbsp; <?php echo form_error('data_acx[hrAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[hrAdmin]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[hrAdmin]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Academic &nbsp; <?php echo form_error('data_acx[academic]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[academic]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[academic]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Academic Admin &nbsp; <?php echo form_error('data_acx[academicAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[academicAdmin]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[academicAdmin]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Finance &nbsp; <?php echo form_error('data_acx[finance]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[finance]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[finance]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Finance(Admin) &nbsp; <?php echo form_error('data_acx[financeAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[financeAdmin]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[financeAdmin]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Admission & Result &nbsp; <?php echo form_error('data_acx[admissionAndResult]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[admissionAndResult]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[admissionAndResult]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label" for="form-field-1">Admission & Result(Admin)  &nbsp; <?php echo form_error('data_acx[admissionAndResultAdmin]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data_acx[admissionAndResultAdmin]" class="form-control" id="form-field-select-1">
                        <?php
                        foreach(getAccessStatus() as $key =>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php echo set_select("data_acx[admissionAndResultAdmin]", $key, FALSE); ?> >
                                <?php echo $value; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="col-xs-12">
                <div class="clearfix form-actions">
                    <div class="col-md-12">
                        <button class="btn btn-success" name="btnSubmit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i> Save Employee Information
                        </button>

                    </div>
                </div>
            </div>
        </form>

    </div><!-- /.col-x12 -->
</div> <!-- /.row -->



<script type="text/javascript">


    $(document).ready(function(){
        $(".add_button_for_field").click(function()
        {
            var i = $("#table01 > tbody > tr").length;
            //var html = $("#add_table_body").html();
            var new_html = '<tr class="abc_tr">' +
                '<td><select class="program_type form-control" name="items[program_type]['+i+']">' +
                <?php foreach ($all_degree as $key => $value) { ?>
                    '<option value="<?php echo $key; ?>"><?php echo $value; ?></option>' +
                <?php   } ?>
                '</select></td>' +
                '<td><input class="discipline form-control" type="text" name="items[discipline]['+i+']" value="" placeholder="Discipline"/></td>' +
                '<td><input class="grade form-control" type="text" name="items[grade]['+i+']" value="" placeholder="Grade"/></td>' +
                '<td><input class="passing_year form-control" type="text" name="items[passing_year]['+i+']" value="" placeholder="Passing Year"/></td>' +
                '<td><input class="board_or_institution form-control" type="text" name="items[board_or_institution]['+i+']" value="" placeholder="Board or Institution"/></td>' +
                '<td><button class="delete_button_for_field ace-icon glyphicon glyphicon-minus" type="button" style="color: red;"></button></td>' +
                '</tr>';
            //html = html + new_html;
            //$("#add_table_body").html(html);
            $("#add_table_body").append(new_html);

            $(".delete_button_for_field").click(function()
            {
                $(this).closest('tr').remove();
                $("#table01 > tbody > tr.abc_tr").each(function(i,item)
                {
                    $(this).find("select.program_type").attr("name",'items[program_type]['+i+']');
                    $(this).find("input.discipline").attr("name",'items[discipline]['+i+']');
                    $(this).find("input.grade").attr("name",'items[grade]['+i+']');
                    $(this).find("input.passing_year").attr("name",'items[passing_year]['+i+']');
                    $(this).find("input.board_or_institution").attr("name",'items[board_or_institution]['+i+']');
                });
            });
        });

        $(".delete_button_for_field").click(function()
        {
            $(this).closest('tr').remove();
            $("#table01 > tbody > tr.abc_tr").each(function(i,item)
            {
                $(this).find("select.program_type").attr("name",'items[program_type]['+i+']');
                $(this).find("input.discipline").attr("name",'items[discipline]['+i+']');
                $(this).find("input.grade").attr("name",'items[grade]['+i+']');
                $(this).find("input.passing_year").attr("name",'items[passing_year]['+i+']');
                $(this).find("input.board_or_institution").attr("name",'items[board_or_institution]['+i+']');
            });
        });
    });

</script>