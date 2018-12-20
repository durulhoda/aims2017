<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>dashboard">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Add Result Summery</a>
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
                <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/saveresultsummery" method="post">
                    <fieldset>
                        <legend>Add Result Summery</legend>

                        <div class="control-group" >
                            <label class="control-label">Select Exam Type </label>
                            <div class="controls">
                                <select name="data[exam_type]">  
                                    <option value="0">Select Category</option>
                                    <option value="1">PSC</option>
                                    <option value="2">JSC</option>
                                    <option value="3">SSC</option>
                                    <option value="4">HSC</option>
                                    <option value="5">HSC(BM)</option>
                                    <option value="6">BA</option>
                                    <option value="7">BA(Hon)</option>
                                    <option value="8">BBS</option>
                                    <option value="9">BSS</option>
                                    <option value="10">MA</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group" >
                            <label class="control-label">Select Group </label>
                            <div class="controls">
                                <select name="data[group]">  
                                    <?php foreach (getGroupInfoArray() as $value) { ?>
                                       <option value="<?php echo $value['groupId']; ?>" 
                                               <?php echo set_select('data[group]', $value['groupId'], FALSE) ?> >
                                           <?php echo $value['groupName']; ?></option>                                                
                                   <?php } ?>
                                </select>
                            </div>
                        </div>
                                                   
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Exam Year </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Year" required="1" size="150" name="data[exam_year]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of A+  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of A+" required="1" size="150" name="data[grade_Ap]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of A  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of A" required="1" size="150" name="data[grade_A]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of A-  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of A-" required="1" size="150" name="data[grade_Am]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of B  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of B" required="1" size="150" name="data[grade_B]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of C </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of C" required="1" size="150" name="data[grade_C]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of D  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of D" required="1" size="150" name="data[grade_D]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Number of F  </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Number of F" required="1" size="150" name="data[grade_F]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary" name="btn">Save Result Information</button>

                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div>
</div>