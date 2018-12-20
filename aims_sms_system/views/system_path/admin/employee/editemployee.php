
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
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                            Edit Employee Information
                        </h3>

                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer red"></i>
                                <a href="#modal-wizard" role="button" class="red" data-toggle="modal"> Update Image </a>
                            
                        </div>
                    </div>
            <div id="modal-wizard" class="modal">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <form action="<?php echo admin_Url();?>/employee/update_emp_image/<?php echo $editData['employeeId']; ?>" method="post" enctype="multipart/form-data">
                            <div id="modal-wizard-container">
                                <div class="modal-header">
                                    <div class="alert alert-block alert-success center">
                                       <i class="ace-icon fa fa-image green"></i>
                                       
                                       Update Profile Picture
                                   </div>
                                </div>

                                <div class="modal-body step-content">
                                    <div class="step-pane active">
                                        <div class="center">
                                               <input name="photo" value="<?php echo set_value("photo"); ?>" type="file" id="id-input-file-2" />
                                             <span class="middle pink">>> </span><br>
                                             <span class="middle red">Maintain Image size with 200*200- Format (png/jpg/gif)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer wizard-actions">
                               
                                <button name="btnSubmit" class="btn btn-success btn-sm btn-next" data-last="Finish">
                                    Update Profile Images
                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                    
                                </button>

                                <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cancel
                                </button>
                            </div>
                          </form>    
                     </div>
                 </div>
             </div><!-- Modals CONTENT ENDS -->
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/employee/updateEmp_data/<?php echo $editData['employeeId']; ?>" method="post" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">First Name &nbsp; <?php echo form_error('data[firstName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" type="text" name="data[firstName]" value="<?php echo $editData['firstName'] ?>" class="form-control" id="form-field-1" placeholder="First Name" />
                        </div>                        
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Middle Name &nbsp; <?php echo form_error('data[middleName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[middleName]" value="<?php echo $editData['middleName']; ?>" class="form-control" id="form-field-1" placeholder="Middle Name" />
                        </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Last Name &nbsp; <?php echo form_error('data[lastName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input required="1" type="text" name="data[lastName]" value="<?php echo $editData['lastName']; ?>" class="form-control" id="form-field-1" placeholder="Last Name" />
                        </div>
                       
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Father Name &nbsp; <?php echo form_error('data[fatherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[fatherName]" value="<?php echo $editData['fatherName'] ?>" class="form-control" id="form-field-1" placeholder="Father Name" />
                        </div>
                        
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Mother Name &nbsp; <?php echo form_error('data[motherName]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[motherName]" value="<?php echo $editData['motherName']; ?>" class="form-control" id="form-field-1" placeholder="Mother Name" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Gender &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                            <div class="radio form-control">
                            

                               <?php
                                    foreach(getSex() as $key =>$value)
                                    {
                                ?>
                                <label class="col-xs-5 col-sm-5">
                                    <input name="data[gender]" <?php  echo ($editData["gender"] == $key) ? "checked" : ""; ?> value="<?php echo $key; ?>"  type="radio" class="ace" />
                                    <span class="lbl"> <?php echo $value; ?> </span>
                                </label>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    
                        
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Mobile Number &nbsp; <?php echo form_error('data[phone]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[phone]" value="<?php echo $editData['phone']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Phone Number" />
                         </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Date of Birth &nbsp; <?php echo form_error('data[dateOfBirth]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[dateOfBirth]" value="<?php echo $editData['dateOfBirth']; ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Date of Birth" />
                          
                        </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Birth Registration Number &nbsp; <?php echo form_error('data[embreg]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[embreg]" value="<?php echo $editData['embreg']; ?>" class="form-control" id="form-field-1" placeholder="Birth Registration Number" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Nationality &nbsp; <?php echo form_error('data[gender]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[nationality]" class="form-control" id="form-field-select-1">
                                <?php foreach (getCountryName() as $key => $value) { ?>
                                                                               <option value="<?php echo $key; ?>" 
                                                                                       <?php echo ($editData['nationality'] == $key) ? "Selected" : ""; ?> >        

                                                                                   <?php echo $value; ?></option>                                                
                                                                           <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">National ID Number &nbsp; <?php echo form_error('data[nationalIdentity]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[nationalIdentity]" value="<?php echo $editData['nationalIdentity']; ?>" class="form-control" id="form-field-1" placeholder="National ID Number" />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Blood Group &nbsp; <?php echo form_error('data[bloodGroup]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[bloodGroup]" class="form-control" id="form-field-select-1">
                                     <?php
                                                                         foreach(getBloodGroup() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["bloodGroup"] == $key) ? "Selected" : ""; ?> >
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
                                                                                <?php echo ($editData["maritialStatus"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                                </select>
                         </div>
                         
                         <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Email Address &nbsp; <?php echo form_error('data[email]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[email]" value="<?php echo $editData['email']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Email Address" />
                         </div>
                         <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Present Address &nbsp; <?php echo form_error('data[address]', '<span class="successMessage">', '</span>'); ?></label>
                            <textarea class="form-control" placeholder="Present Address" name="data[address]" value="<?php echo $editData["address"]; ?>" type="text" id="form-field-1"><?php echo $editData["address"]; ?></textarea>
                         </div>  
                         <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Index No &nbsp; <?php echo form_error('data[indexno]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[indexno]" value="<?php echo $editData['indexno']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Index No" />
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
                                    <tbody id="add_table_body">

                                    <?php
                                        foreach($edu_info as $index => $value)
                                        {
                                            ?>
                                            <tr>
                                            <td>
                                                <select class="program_type form-control" name="existing_data[<?php echo $value['id']?>][program_type]">
                                                <?php
                                                    foreach ($all_degree as $key => $degree)
                                                    {
                                                ?>
                                                    <option value="<?php echo $key; ?>" <?php if($key==$value['program_type']){echo 'selected';}?>><?php echo $degree; ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </td>

                                            <td>
                                                <input class="discipline form-control" type="text" name="existing_data[<?php echo $value['id']?>][discipline]" value="<?php echo $value['discipline']?>" placeholder="Discipline"/>
                                            </td>

                                            <td>
                                                <input class="grade form-control" type="text" name="existing_data[<?php echo $value['id']?>][grade]" value="<?php echo $value['grade']?>" placeholder="Grade"/>
                                            </td>

                                            <td>
                                                <input class="passing_year form-control" type="text" name="existing_data[<?php echo $value['id']?>][passing_year]" value="<?php echo $value['passing_year']?>" placeholder="Passing year"/>
                                            </td>

                                            <td>
                                                <input class="board_or_institution form-control" type="text" name="existing_data[<?php echo $value['id']?>][board_or_institution]" value="<?php echo $value['board_or_institution']?>" placeholder="Board/Institution"/>
                                            </td>

                                            <td style="text-align:center;">
                                                <button class="delete_button_for_existing_field ace-icon glyphicon glyphicon-minus" type="button" style="color: red;"></button>
                                            </td>

                                            </tr>

                                            <?php
                                        }
                                    ?>

                                    </tbody>
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
                            <input name="data[basic_salary]" value="<?php echo $editData['basic_salary']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Basic Salary" />
                        </div>

                        <div class="col-xs-3">
                            <label class="control-label" for="form-field-1">Bank Account No. &nbsp; <?php echo form_error('data[bank_account_no]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[bank_account_no]" value="<?php echo $editData['bank_account_no']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Bank Account No." />
                        </div>

                        <div class="col-xs-3">
                            <label class="control-label" for="form-field-1">Increment Date &nbsp; <?php echo form_error('data[increment_date]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[increment_date]" value="<?php echo $editData['increment_date']; ?>" type="text" class="form-control" id="form-field-1" placeholder="Increment Date" />
                        </div>

                        <div class="col-xs-3">
                            <label class="control-label" for="form-field-1">G.P.F Date &nbsp; <?php echo form_error('data[gpf_no]', '<span class="successMessage">', '</span>'); ?></label>
                            <input name="data[gpf_no]" value="<?php echo $editData['gpf_no']; ?>" type="text" class="form-control" id="form-field-1" placeholder="G.P.F No." />
                        </div>

                    </div>

                </div>

                        
                    <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                     <div class="hr hr-18 dotted hr-double"></div>
                        <div class="col-xs-12 col-sm-4">
                                 <label class="control-label" for="form-field-1">Department &nbsp; <?php echo form_error('data[departmentId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select name="data[departmentId]" class="form-control" id="form-field-select-1">
                                   <?php
                                                                         foreach(getDepartmentInfoArray() as $value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $value['departmentId']; ?>" 
                                                                                <?php echo ($editData["departmentId"] == $value['departmentId']) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value['departmentName']; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                                </select>
                         </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Designation &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                             <select name="data[designation]" class="form-control" id="form-field-select-1">
                                <?php
                                   
                                        foreach(getDesignationArray() as $value)
                                        {
                                           $position= $value['candidate']-CountEmployeeByPosition($value['designation']);
                                        if(($value['candidate']>=$position))
                                             {
                                ?>
                                    <option value="<?php echo $value['designation']; ?>" 
                                        <?php echo ($editData["designation"] == $value['designation']) ? "Selected" : ""; ?> >
                                                <?php echo element($value['designation'],getdesignation(),NULL); ?>
                                    </option> 
                                
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                           
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Employee Type &nbsp; <?php echo form_error('data[employeeType]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[employeeType]" class="form-control" id="form-field-select-1">
                                 <?php
                                                                         foreach(getmployeetypeList() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["employeeType"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
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
                                       foreach (getemployeestatusList() as $key => $value) {
                                    ?>                                                                                                                 
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo ($editData["employmentStatus"] == $key) ? "Selected" : ""; ?> >
                                            <?php echo $value; ?>
                                    </option> 
                                  <?php
                                    }
                                  ?>                                   
                            </select>
                        </div>
                        <div class="has-error col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Joining Date &nbsp; <?php echo form_error('data[joiningdate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[joiningdate]" value="<?php echo $editData['joiningdate']; ?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Joining Date" />
                          
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Retirement Date &nbsp; <?php echo form_error('data[retirementDate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[retirementDate]" value="<?php echo $editData['retirementDate'];?>" class="input-mask-date form-control" id="form-field-mask-1" placeholder="Retirement Date" />
                          
                        </div>
                        <div class="col-xs-12 col-sm-4">
                             <label class="control-label" for="form-field-1">Employee Status &nbsp; <?php echo form_error('data[employeeStatus]', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[employeeStatus]" class="form-control" id="form-field-select-1">
                                <?php
                                                                         foreach(getEmployeeStatus() as $key =>$value)
                                                                         {
                                                                     ?>
                                                                         <option value="<?php echo $key; ?>" 
                                                                                <?php echo ($editData["employeeStatus"] == $key) ? "Selected" : ""; ?> >
                                                                                     <?php echo $value; ?>
                                                                         </option> 
                                                                     
                                                                     <?php
                                                                         }
                                                                     ?>
                            </select>
                        </div>
                     
                      <div class="col-xs-12 col-sm-4">
                            <label class="control-label" for="form-field-1">Employee Position &nbsp; <?php echo form_error('data[positionNumber]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="number" min="1" max="500" name="data[positionNumber]" value="<?php echo $editData['positionNumber'] ?>" class="form-control" id="form-field-mask-1" placeholder="Position Number" />
                          
                        </div>
                     
                    </div>
                   
                    
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Update Employee Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
           </div><!-- /.col-x12 -->  
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

            $(".delete_button_for_existing_field").click(function()
            {
                $(this).closest('tr').remove();
            });
        });

    </script>