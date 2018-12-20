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
                <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/insert_MeritStudent" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Add Merit Student Information</legend>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Student Name </label>
                            <div class="controls">
                                <input type="text" placeholder="Student Name" required="1" size="150" name="data[stuName]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Passed Year </label>
                            <div class="controls">
                                <input type="text" placeholder="Passed Year" required="1" size="150" name="data[year]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Current Position  </label>
                            <div class="controls">
                                <input type="text" placeholder="Current Position" required="1" size="150" name="data[position]" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">

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

                            <button type="submit" class="btn btn-primary" name="btn">Save Information</button>

                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div>
</div>