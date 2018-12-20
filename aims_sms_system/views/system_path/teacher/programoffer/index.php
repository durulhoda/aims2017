<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Class Offer Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add New Class Offer
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/program/insertOfferProgram" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramLevel" onchange="return getClassId(); "  name="data[programLevel]" required="1" class="form-control" >
                            <option value="">Select</option> 
                            <?php
                                foreach (getProgramLevel() as $key => $value) {
                            ?>
                                <option value="<?php echo $key; ?>" 
                                        <?php echo set_select("data[programLevel]", $key, FALSE); ?> >
                                        <?php echo $value; ?>
                                </option> 

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getCLAssid" name="data[programId]" required="1" class="form-control" >
                                
                            </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[mediumId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getMediumList() as $values) { ?>
                                <option value="<?php echo $values['mediumId']; ?>" 
                                        <?php echo set_select('data[mediumId]', $values['mediumId'], FALSE) ?>>
                                            <?php echo $values['mediumName']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[groupId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getGroupInfoArray() as $value) { ?>
                                <option value="<?php echo $value['groupId']; ?>" 
                                        <?php echo set_select('data[groupId]', $value['groupId'], FALSE) ?> >
                                    <?php echo $value['groupName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[shiftId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                            <?php foreach (getShiftList() as $value) { ?>
                                <option value="<?php echo $value['shiftId']; ?>" 
                                        <?php echo set_select('data[shiftId]', $value['shiftId'], FALSE) ?> >
                                    <?php echo $value['shiftName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[sectionId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                            <?php foreach (getSectionList() as $value) { ?>
                                <option value="<?php echo $value['sectionId']; ?>" 
                                        <?php echo set_select('data[sectionId]', $value['sectionId'], FALSE) ?> >
                                    <?php echo $value['sectionName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[sessionId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                             <?php foreach (getSessionList() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('data[sessionId]', $value['session'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php   }    ?>
                        </select>
                    </div>
                   <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Form Master  &nbsp; <?php echo form_error('data[employeeId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select name="data[employeeId]" required="1" class="form-control" id="form-field-select-1">
                            <option value=""></option> 
                            <?php foreach (getTeacherInfoArray() as $value) { ?>
                                <option value="<?php echo $value['employeeId']; ?>" 
                                        <?php echo set_select('data[employeeId]', $value['employeeId'], FALSE) ?> >
                                    <?php echo $value['firstName'] . " " . $value['lastName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                   
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Total Seat  &nbsp; <?php echo form_error('data[applicantSeat]', '<span class="successMessage">', '</span>'); ?></label>
                        <input type="text" name="data[applicantSeat]" required="1" value="<?php echo set_value("data[applicantSeat]"); ?>" class="form-control" id="form-field-1" placeholder="Total Seat" />
                    </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <input type="hidden" name="data[classStatus]" value="1">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Add New Class Offer
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
             <?php
                if(!empty($offeprogramlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-header">
                        Class Offer List
                    </div>
                    <div>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                    <tr>                                
                                        <th>Class Level/Class</th>
                                        <th>Medium/Group</th>
                                        <th>Shift/Section</th>   
                                        <th class="hidden-480">Session</th>
                                        <th >Class Teacher/Seat</th>   
                                        <th>Class Status</th>   
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sl=1;
                                        foreach($offeprogramlist as $val)
                                        {
                                    ?>
                                    <tr>
                                        <td> 
                                         <?php
                                            foreach(getProgramLevel() as $key =>$value)
                                            {
                                                if($val['programLevel']==$key)
                                                {
                                                    echo $value."<br><b>".$val['programName']."</b>";
                                                }                                       
                                            }   
                                         ?>
                                        </td>                                       
                                        <td> <?php echo "<b>Medium:</b> ".$val['mediumName']."<br>"."<b>Group:</b> ".$val['groupName']; ?></td>
                                        <td> <?php echo "<b>Shift:</b> ".$val['shiftName']."<br>"."<b>Section:</b> ".$val['sectionName']; ?></td>
                                        <td class="hidden-480"> <?php echo $val['session']; ?></td>
                                        <td> <?php echo "<b>Class Teacher:</b> <a><span class=\"label label-sm label-success arrowed arrowed-righ\">".$val['firstName']." ".$val['lastName']."</span></a><br>"."<b>Seat:</b> ".$val['applicantSeat']; ?></td>
                                        <td> <?php echo ($val["classStatus"] == 1) ? "<span class=\"label label-sm label-info\">Active</span>" : "<span class=\"label label-sm label-danger\">Inactive</span>" ?></td>
                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                 <a href="<?php echo admin_Url();?>/program/editdprogramOffer/<?php echo $val['programOfferId']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url();?>/program/deleteprogramOffer/<?php echo $val['programOfferId']; ?>" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </a>


                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/program/editdprogramOffer/<?php echo $val['programOfferId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/program/deleteprogramOffer/<?php echo $val['programOfferId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                     <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                 
                </div><!-- /.span -->
            </div><!-- /.row -->
             <?php
               }
           ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        