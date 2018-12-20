<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            All Position Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add New Position
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/designation/insertDesignation" method="post">
                <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                    
                    <div class="has-error col-xs-12 col-sm-4">
                        <label class="control-label" for="form-field-1">Employee Type &nbsp; <?php echo form_error('data[employeeType]', '<span class="successMessage">', '</span>'); ?></label>

                        <select id="getemployeeid" onchange="return getemployeetype();" name="data[employeetypeId]" class="form-control" id="form-field-select-1">
                            <option value="">Select</option>>
                            <?php
                            foreach (getmployeetypeList() as $key => $value) {
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
                    
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">New Position &nbsp; <?php echo form_error('data[designation]', '<span class="successMessage">', '</span>'); ?></label>
                             <select name="data[designation]" class="form-control" id="form-field-select-1">
                                <?php
                                    foreach(getdesignation() as $key=>$value)
                                    {                                    
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[designation]", $key, FALSE); ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                  
                                    }
                                ?>
                            </select>    
                    </div>
                    <div class="has-error col-xs-10 col-sm-4">   
                            <label class="control-label" for="form-field-1">Number of Position &nbsp; <?php echo form_error('data[candidate]', '<span class="successMessage">', '</span>'); ?></label>
                            <input type="text" name="data[candidate]" required="1" value="<?php echo set_value("data[candidate]"); ?>" class="form-control" id="form-field-1" placeholder="Total Seat" />
                    </div>
                </div> 
                   
               
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Add New Position
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
            <?php
                if(!empty($listdata))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>Sl No.</th>
                                <th>Employee Type</th>
                                <th>Position Name</th>
                                <th>Number of Position</th>
                                <th>Position Available</th>
                                <th>Position Fill up</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $sl=1;
                                foreach($listdata as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                  <td > <?php echo element($val['employeetypeId'],getmployeetypeList(),NULL); ?></td>
                                <td > <?php echo element($val['designation'],getdesignation(),NULL); ?></td>
                                <td class="hidden-480"> <?php echo $val['candidate'] ?></td>
                                <td class="hidden-480"> <?php echo $val['candidate']-CountEmployeeByPosition($val['designation']); ?></td>
                                <td class="hidden-480"> <?php echo CountEmployeeByPosition($val['designation']); ?></td>
                                
                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        <a href="<?php echo admin_Url();?>/designation/editddesignation/<?php echo $val['dsgId']; ?>" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo admin_Url();?>/designation/deletedesignation/<?php echo $val['dsgId']; ?>" class="btn btn-xs btn-danger">
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
                                                    <a href="<?php echo admin_Url();?>/designation/editddesignation/<?php echo $val['dsgId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo admin_Url();?>/designation/deletedesignation/<?php echo $val['dsgId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
                </div><!-- /.span -->
            </div><!-- /.row -->
             <?php
               }
           ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
    