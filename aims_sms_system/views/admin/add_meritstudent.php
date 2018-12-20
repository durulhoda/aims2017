<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>dashboard">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Add Merit Student</a>
            </li>
        </ul>
    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i> Merit Student Form</h2>
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
                <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/saveMeritStudent" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Add Merit Student Information</legend>

                        <div class="control-group" >
                            <label class="control-label">Select Exam Type </label>
                            <div class="controls">
                                <select name="data[exam_type]">  
                                    <option value="0">Select Category</option>
                                    <option value="1">PSC</option>
                                    <option value="2">JSC</option>
                                    <option value="3">SSC</option>
                                    <option value="4">HSC</option>
                                </select>
                            </div>
                        </div>
                                                   
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Exam Year </label>
                            <div class="controls">
                                <input type="text" placeholder="Exam Year" required="1" size="150" name="data[year]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Student Name </label>
                            <div class="controls">
                                <input type="text" placeholder="Student Name" required="1" size="150" name="data[stuName]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Grade  </label>
                            <div class="controls">
                                <input type="text" placeholder="Obtain Grade" required="1" size="150" name="data[grade]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="textarea2">Upload Image</label>                                                        
                            <div class="controls">
                                <input type="file" name="image">
                                <br/> >> Maintain Image Size (250 X 250)
                                
                            </div>
                        </div>
                        
                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary" name="btn">Save Student Information</button>

                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div>
</div>