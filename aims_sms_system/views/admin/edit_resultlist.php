<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>dashboard">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Edit Result Summery</a>
            </li>
        </ul>
    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i> Result Summery Form</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <h3 style="color:green">
                    <?php
                    $msg = $this->session->userdata('message');
                    if (isset($msg)) {
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
                <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/updateresult/<?php echo $editdata['rs_Id'];?>" method="post">
                    <fieldset>
                        <legend>Add Result Summery</legend>

                        <div class="control-group" >
                            <label class="control-label">Select Exam Type </label>
                            <div class="controls">
                                <select name="data[exam_type]">                                                                  
                                    <option value="1" <?php echo ($editdata['exam_type'] == 1) ? "selected" : ""; ?>>PSC</option>
                                    <option value="2" <?php echo ($editdata['exam_type'] == 2) ? "selected" : ""; ?>>JSC</option>
                                    <option value="3" <?php echo ($editdata['exam_type'] == 3) ? "selected" : ""; ?>>SSC</option>
                                    <option value="4" <?php echo ($editdata['exam_type'] == 4) ? "selected" : ""; ?>>HSC</option>
                                    <option value="5" <?php echo ($editdata['exam_type'] == 5) ? "selected" : ""; ?>>HSC(BM)</option>
                                    <option value="6" <?php echo ($editdata['exam_type'] == 6) ? "selected" : ""; ?>>BA</option>
                                    <option value="7" <?php echo ($editdata['exam_type'] == 7) ? "selected" : ""; ?>>SSC</option>
                                    <option value="8" <?php echo ($editdata['exam_type'] == 8) ? "selected" : ""; ?>>BBS</option>
                                    <option value="9" <?php echo ($editdata['exam_type'] == 9) ? "selected" : ""; ?>>BSS</option>
                                    <option value="10" <?php echo ($editdata['exam_type'] == 10) ? "selected" : ""; ?>>MA</option>

                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group" >
                            <label class="control-label">Select Group </label>
                            <div class="controls">
                                <select name="data[group]">                                                                  
                                    <?php foreach (getGroupInfoArray() as $value) { ?>
                                        <option value="<?php echo $value['groupId']; ?>" 
                                               <?php echo ($editdata["group"] == $value['groupId']) ? "selected" : ""; ?>>
                                            <?php echo $value['groupName']; ?></option>                                                
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Exam Year </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Year" required="1" size="150" name="data[exam_year]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['exam_year'])) { echo $editdata['exam_year'];} ?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of A+  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of A+" required="1" size="150" name="data[grade_Ap]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['grade_Ap'])) { echo $editdata['grade_Ap'];} ?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of A  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of A" required="1" size="150" name="data[grade_A]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['grade_A'])) { echo $editdata['grade_A'];} ?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of A-  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of A-" required="1" size="150" name="data[grade_Am]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['grade_Am'])) { echo $editdata['grade_Am'];} ?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of B  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of B" required="1" size="150" name="data[grade_B]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['grade_B'])) { echo $editdata['grade_B'];} ?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of C </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of C" required="1" size="150" name="data[grade_C]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['grade_C'])) { echo $editdata['grade_C'];} ?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of D  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of D" required="1" size="150" name="data[grade_D]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['grade_D'])) { echo $editdata['grade_D'];} ?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of F </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of F" required="1" size="150" name="data[grade_F]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php if(!empty($editdata['grade_F'])) { echo $editdata['grade_F'];} ?>">

                            </div>
                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary" name="btn">Upadte Result Information</button>

                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div>
</div>