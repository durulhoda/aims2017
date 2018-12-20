<div class="page-content">
    <div style="margin-top: 20px; padding: 3.5px;">   
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Payment
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Fees
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
            <form class="form-horizontal" role="form" action="<?php echo acc_Url();?>/feesadd/insertfeesadd" enctype="multipart/form-data" method="post">
                
                   <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                 
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>" 
                                        <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo $value['session']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>

                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                        </select>
                    </div>
                    <div class=" col-xs-10 col-sm-4">
                        <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                        </select>
                    </div>
                 
                            <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Payment Head  &nbsp; <?php echo form_error('data[headId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select required name="headId" class="form-control">
                                <option value=""></option> 
                                <?php foreach (getHeadList() as $value) { ?>
                                    <option value="<?php echo $value['headId']; ?>"
                                            <?php echo set_select('data[headId]', $value['headId'], FALSE) ?> >
                                        <?php echo $value['headName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
               
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Due Date   </label>
                        <div class="input-group input-group-sm">
                            <input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="DueDate" placeholder="Enter Due Time">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                 
                    
                      <div class=" col-xs-10 col-sm-4">
                          &nbsp;<br>
                          </div>
                    
              
                      
                    </div>
                   <div class=" col-xs-10 col-sm-4">
                          &nbsp;<br>
                          </div>
                                  
                  <div class=" col-xs-10 col-sm-12">
                         <label class="control-label" for="form-field-1">Amount For:  &nbsp; <?php echo form_error('data[quata_id]', '<span class="successMessage">', '</span>'); ?></label>
                    
                        <?php
                        $sl=1;
                        foreach (getQuatalist() as $value) 
                            { ?>
                         <input type="hidden" name="serial[]" value="<?php echo $sl; ?>">
                         <input type="text" name="amount[]" placeholder="<?php echo $value['quata']; ?>">                  
                         <input class="form-control" type="hidden" name="quata_id[]" value="<?php echo $value['quata_id']; ?>" placeholder="<?php echo $value['quata']; ?>">
                                    
                            <?php 
                            $sl++; 
                            }
                           
                            ?> 
                     </div> 
          
         <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-11">
                                <button class="btn btn-success"  type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Save
                                </button>

                            </div>
                        </div>
                    </div>   
         </div>
            </form>
            
              <?php
            if (!empty($feeslist)) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                <th>Sl no.</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Payment Head</th>
                                <th>Quota</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Action</th>

                                    
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($feeslist as $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php echo getProgramName($value['programId']); ?></td>
                                        <td> <?php echo getSessionName($value['sessionId']); ?></td>
                                        <td> 
                                            <?php if (!empty($value['headId'])) {echo getPaymentHeadName($value['headId']);}?>
                                        </td>
                                        <td> 
                                            <?php if (!empty($value['quata_id'])) {echo getQuataName($value['quata_id']);}?>
                                        </td>
                                        <td>
                                          <?php if (!empty($value['amount'])) {echo $value['amount']; } ?>
                                        </td>
                                           <td>
                                       <font color="red">   <?php if (!empty($value['DueDate'])) {echo $value['DueDate']; } ?></font>
                                        </td>



                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo acc_Url(); ?>/feesadd/editfees/<?php echo $value['feeId']; ?>"  class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo acc_Url(); ?>/feesadd/deletefees/<?php echo $value['feeId']; ?>" class="btn btn-xs btn-danger">
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
                                                            <a href="<?php echo acc_Url(); ?>/feesadd/editfees/<?php echo $value['feeId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo acc_Url(); ?>/feesadd/deletefees/<?php echo $value['feeId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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

