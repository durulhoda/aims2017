<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content"> 
            
        <!-- /Content Section  -->                    
        <div class="page-header">
            <h1>
                Edit Student Marks
            
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
                <form class="form-horizontal" role="form" action="<?php echo teacher_Url(); ?>/studentmarks/updateStudentmarks/<?php echo $editData['markId'] ?>" enctype="multipart/form-data" method="post">
            
                    <div class="col-xs-12 col-sm-12">  
                        <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Exam Type &nbsp; <?php echo form_error('data[examtypeId]', '<span class="successMessage">', '</span>'); ?></label>
                        
                            <select name="data[examtypeId]" required="1" class="form-control">
                                <?php foreach (getExamList() as $value) { ?>
                                    <option value="<?php echo $value['examtypeId']; ?>" 
                                            <?php echo ($editData["examtypeId"] == $value['examtypeId']) ? "Selected" : ""; ?> >
                                        <?php echo $value['examtypeName']; ?></option>                                                
                                <?php } ?>
                            </select>
                        </div>
                    
                        <div class="has-error col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Semester  &nbsp; <?php echo form_error('data[semesterId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsessionid" onchange="return getSemesterName();" data-placeholder="Select" name="data[semesterId]"  required="1" class="form-control">
                        
                                <?php foreach (getSemesterInfoArray() as $value) { ?>
                                    <option value="<?php echo $value['semesterId']; ?>" 
                                            <?php echo ($editData["semesterId"] == $value['semesterId']) ? "Selected" : ""; ?> >
                                        <?php echo $value['semester']; ?></option>                                                
                                <?php } ?>
                            </select>
                        </div>
                        <?php
                        if (!empty($dividemark)) {

                            $mark_val = explode(",", trim($dividemark['divide_mark'], ","));

                            $mark_ttl = explode(",", trim($dividemark['mark_cat_id'], ","));
                            $obtain_mark = explode(",", trim($editData['divide_mark'], ","));
                            $count_markval = count($mark_val);

                            for ($mrk = 0; $mrk < $count_markval; $mrk++) {
                                $mark_val[$mrk];
                                $mrkttl = getMarkTitle($mark_ttl[$mrk]);
                                ?>
                                <div class="has-error col-xs-10 col-sm-4">
                                    <label class="control-label" for="form-field-1"><?php if (!empty($mrkttl)) {
                            echo $mrkttl;
                        } ?>  &nbsp; <?php echo form_error('data[marks]', '<span class="successMessage">', '</span>'); ?></label>
                                    <td class="hidden-480">
                                        <input type="text" name="other_marks[]" placeholder="<?php echo $mrkttl . "-" . $mark_val[$mrk]; ?>" value="<?php if (!empty($obtain_mark[$mrk])) {
                            echo $obtain_mark[$mrk];
                        } ?>" class="form-control" id="form-field-1">                                
                                    </td>
                                </div>
                                                        
                                <?php
                            }
                        } else {
                            ?>                                 
                            <div class="has-error col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Marks  &nbsp; <?php echo form_error('data[marks]', '<span class="successMessage">', '</span>'); ?></label>
                                <td class="hidden-480">
                                    <input type="text" name="other_marks[]" placeholder="Obtain Mark" value="<?php echo $editData["marks"]; ?>" class="form-control" id="form-field-1">                                
                                </td>
                            </div>
                            <?php
                        }
                        if (!empty($count_markval)) {
                            $count_mark_input = $count_markval;
                        } else {
                            $count_mark_input = 1;
                        }
                        ?>
                        <input type="hidden" name="count_input" value="<?php echo $count_mark_input; ?>" class="form-control" id="form-field-1"> 
                    </div>   
                
                
                
                
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-12">
                                <button class="btn btn-success" name="btnSubmit" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update Student Marks
                                </button>
                            
                            </div>
                        </div>
                    </div>        
                </form>
            
            </div><!-- /.col-x12 -->
        </div> <!-- /.row --> 
    </div><!-- /.col-x12 -->
</div> <!-- /.row --> 
</div> <!-- /.row --> 