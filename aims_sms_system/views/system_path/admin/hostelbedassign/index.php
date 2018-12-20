<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Hostel
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Add Hostel Bed Assign Information
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

    <!-- div.table-responsive -->


        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form  action="<?php echo admin_Url(); ?>/hostelbedassign/inserthostelbedassign" method="post" class="form-horizontal" role="form">

                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hostel Name :&nbsp; <?php echo form_error('data[transportId]'); ?></label>

                    <select name="data[hostelId]" class="col-xs-9 col-sm-3" class="form-control">
                            <option value="">Select</option>
                                        <?php foreach (getHostelNameList() as $values) { ?>
                                            <option value="<?php echo $values['hostelId']; ?>" 
                                                    <?php echo set_select('data[hostelId]', $values['hostelId'], FALSE) ?>>
                                                        <?php echo $values['hostelName']; ?>
                                            </option>
                                        <?php } ?>
                    </select>  

                </div>
                
                        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hostel Room : &nbsp; <?php echo form_error('data[categoryId]'); ?></label>

                    <select name="data[hostelRoom]" class="col-xs-9 col-sm-3" class="form-control">
                       <option value="">Select</option>
                                    
                                        <?php foreach (getHostelRoomList() as $values) { ?>
                                            <option value="<?php echo $values['hostelRoom']; ?>" 
                                                    <?php echo set_select('data[hostelRoom]', $values['hostelRoom'], FALSE) ?>>
                                                        <?php echo $values['hostelRoom']; ?>
                                            </option>
                                        <?php } ?>
                    </select>  

                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bed Number: &nbsp; <?php echo form_error('data[bedNo]'); ?></label>

                    <select name="data[bedNo]" class="col-xs-9 col-sm-3" class="form-control">
                        
                        <option value="">Select</option>
                        <?php
                        foreach (getHostelBedList() as $values) {

                            if ($values['bedNo'] != getAssignBed($values['bedNo'])) {
                                ?>
                                <option value="<?php echo $values['bedNo']; ?>" 
                                            <?php echo set_select('data[bedNo]', $values['bedNo'], FALSE) ?>>
                                <?php echo $values['bedNo']; ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>  

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student Id : &nbsp; </label>
                  <input type="text" name="data[studentId]" value="<?php echo set_value("data[studentId]"); ?>">

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

          

      
        <div class="col-xs-12">
          
             <?php
                if(!empty($hostelbedassignlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>SL. No</th>
                                    <th>Hostel Name</th>  
                                    <th>Room</th>  
                                    <th>Bed Number</th>  
                                    <th>Bed Rent</th>  
                                    <th>Student Id</th>  
                                       <th>Action</th> 
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $sl=1;
                                foreach($hostelbedassignlist as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                <td><?php if(!empty($val['hostelId'])){ echo getHostelName($val['hostelId']);}?></td>
                                
                                <td><?php echo $val['hostelRoom'];?></td>
                              
                              <td>  <?php echo $val['bedNo'];?></td>
                                <td><?php echo $val['rent'];?></td>
                              <td>  <?php if(!empty($val['studentId'])){echo $val['studentId'];}?></td>
                           


                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                            
                                         <a href="<?php echo admin_Url();?>/hostelbedassign/edithostelBedAssign/<?php echo $val['bedassignId']; ?>" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo admin_Url();?>/hostelbedassign/deletehostelBedAssign/<?php echo $val['bedassignId']; ?>" class="btn btn-xs btn-danger">
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
                                                    <a href="<?php echo admin_Url();?>/hostelbedassign/edithostelBedAssign/<?php echo $val['bedassignId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo admin_Url();?>/hostelbedassign/deletehostelBedAssign/<?php echo $val['bedassignId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
          </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 








    

    
    
    
    
    
