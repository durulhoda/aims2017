<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Admission Test Information 
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Add Admid Card Information 
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/admidcontroller/insertadmidinfo" enctype="multipart/form-data" method="post" autocomplete="off">
                
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
                <div class="col-xs-12 col-sm-12">  
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Date   </label>
                        <div class="input-group input-group-sm">
                            <input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="data[ExamDate]" placeholder="Enter Marks">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Time   </label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="data[ExamTime]" placeholder="Enter Marks">
                            <span class="input-group-addon">
                           <i class="fa fa-clock-o bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    </div>
                     <div class="col-xs-12 col-sm-12"> 
                    
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Bangla   </label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" id="v0" onkeyup="calculate()" name="data[bangla]" placeholder="Enter Marks">
                            <span class="input-group-addon">
                                
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">English  </label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="v1" onkeyup="calculate()" name="data[english]" placeholder="Enter Marks">
                            <span class="input-group-addon">
                             
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Mathmatics   </label>
                        <div class="input-group input-group-sm">
                            <input  type="text" class="form-control" id ="v2" onkeyup="calculate()" name="data[math]" placeholder="Enter Marks">
                            <span class="input-group-addon">
                               
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">General Knowledge </label>
                        <div class="input-group input-group-sm">
                            <input  type="text" class="form-control" id ="v3" onkeyup="calculate()" name="data[gk]" placeholder="Enter Marks">
                            <span class="input-group-addon">
                              
                            </span>
                        </div>
                    </div>
                         
                            <div class="col-sm-4">
                        <label class="control-label" for="form-field-1"> Total Marks </label>
                        <div class="input-group input-group-sm">
                           <input type="text" name="data[total]" id="result" onkeyup="calculate()"  readonly>
                        
                        </div>
                    </div>
                      
                    </div>
              
                                  
                 
          
         <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-11">
                                <button class="btn btn-success"  type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Save Information
                                </button>

                            </div>
                        </div>
                    </div>   
         </div>
            </form>
            
              <?php
            if (!empty($listdata)) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                <th>Sl no.</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Exam Date</th>
                                <th>Exam Time</th>
                                <th>Bangla</th>
                                <th>English</th>
                                <th>Mathmatics</th>
                                <th>General Knowledge </th>
                                <th>Total Marks</th>
                                <th>Action</th>

                                    
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($listdata as $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php echo getProgramName($value['programId']); ?></td>
                                        <td> <?php echo getSessionName($value['sessionId']); ?></td>
                                        <td> 
                                            <?php if (!empty($value['ExamDate'])) {echo $value['ExamDate'];}?>
                                        </td>
                                        <td> 
                                            <?php if (!empty($value['ExamTime'])) {echo $value['ExamTime'];}?>
                                        </td>
                                        <td>
                                          <?php if (!empty($value['bangla'])) {echo $value['bangla']; } ?>
                                        </td>
                                          <td>
                                          <?php if (!empty($value['english'])) {echo $value['english']; } ?>
                                        </td>
                                          <td>
                                          <?php if (!empty($value['math'])) {echo $value['math']; } ?>
                                        </td>
                                          <td>
                                          <?php if (!empty($value['gk'])) {echo $value['gk']; } ?>
                                        </td>
                                           <td>
                                       <font color="red">   <?php if (!empty($value['total'])) {echo $value['total']; } ?></font>
                                        </td>



                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo admin_Url(); ?>/admidcontroller/editinfo/<?php echo $value['id']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url(); ?>/admidcontroller/deleteinfo/<?php echo $value['id']; ?>" class="btn btn-xs btn-danger">
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
                                                            <a href="#<?php echo admin_Url(); ?>/admidcontroller/editinfo/<?php echo $value['id']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url(); ?>/admidcontroller/deleteinfo/<?php echo $value['id']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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

    
 <script type="text/javascript">

function calculate(){
var result = document.getElementById('result');
var el, i = 0, total = 0; 
while(el = document.getElementById('v'+(i++)) ) {
el.value = el.value.replace(/\\D/,"");
total = total + Number(el.value);
}
result.value = total;
if(document.getElementById('v0').value =="" && document.getElementById('v1').value =="" && document.getElementById('v2').value =="" ){
 result.value ="";
}
}
</script>

