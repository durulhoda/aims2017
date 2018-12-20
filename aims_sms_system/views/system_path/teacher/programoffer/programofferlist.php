<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Class Offer Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                All Class Offer Information
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
            
            <div id="modal-form" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="green bigger">Search Again Class Offer Information</h4>
                        </div>
                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/program/programOfferList" method="post">
                                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">  
                                    <!-- PAGE CONTENT BEGINS -->
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getsessionid" onchange="return getOfferedSessionId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach (getOfferedSession() as $value) { ?>
                                                <option value="<?php echo $value['sessionId']; ?>" >
                                                    <?php echo $value['session']; ?></option>                                                
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Class Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId(); " name="data[programLevel]" data-placeholder="Select" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class=" col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">

                                        </select>
                                    </div>

                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Form Master  &nbsp; <?php echo form_error('data[employeeId]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select id="getemployeeid" name="data[employeeId]" required="1" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-sm-4">
                                        <label class="control-label" for="form-field-1">Class Status  &nbsp; <?php echo form_error('data[classStatus]', '<span class="successMessage">', '</span>'); ?></label>
                                        <select name="data[classStatus]" required="1" class="form-control" id="form-field-select-1">
                                            <option value="1"> Active</option> 
                                            <option value="2"> Inactive</option> 
                                        </select>
                                    </div>                    
                                </div>        
                                
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>

                            <button class="btn btn-success btn-sm">
                                <i class="ace-icon fa fa-check"></i>
                                Search Class Offer Information
                            </button>
                        </div>
                        
                         </form>
                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->
            
                <h4 class="pink">
                    <i class="ace-icon fa fa-hand-o-right red"></i>
                    <a href="#modal-form" role="button" class="red" data-toggle="modal"> Search Again Class Offer Information </a>
                </h4>
            <div class="hr hr-18 dotted hr-double"></div>
             <?php
                if(!empty($offeprogramlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                    <tr>                                
                                        <th>Sl No.</th>
                                        <th>Class Level</th>
                                        <th>Class</th>   
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
                                        <td> <?php echo $sl++; ?></td>
                                        <td> 
                                         <?php
                                            foreach(getProgramLevel() as $key =>$value)
                                            {
                                                if($val['programLevel']==$key)
                                                {
                                                    echo $value;
                                                }                                       
                                            }   
                                         ?>
                                        </td>
                                        <td> <?php echo $val['programName'] ?></td>
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
    
    