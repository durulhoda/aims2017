<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box  margin-bottom">
        <div class="margin">
            <!-- ASIDE NAV 1 -->

          

            <aside class="s-12 l-3">
                <h3 class="titlehd">More Information</h3>
                <div class="aside-nav">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>home/OurMission"> Mission Statement</a></li>
                        <li><a href="<?php echo base_url(); ?>home/LandInfo">Land Information </a></li>
                        <li><a href="<?php echo base_url(); ?>home/BuildingInfo">Building Information </a></li>
                        <li><a href="<?php echo base_url(); ?>home/RoomInfo"> Room Information</a></li>
                        <li><a href="<?php echo base_url(); ?>home/career">Career</a></li>
                        <li><a href="<?php echo base_url(); ?>home/PostInfo">Post Information</a></li>
                    </ul>
                </div>
            </aside>

            <!-- CONTENT -->
            <section class="s-12 l-6">

                <h3 class="titlehd">
                    Institute Exam Routine
                </h3>
                
                    <!--########-->
                    <p style="color:red; padding: 10px;">
                <?php
                $message = $this->session->userdata('message');

                if (isset($message)) {
                    echo "<span id='messagesuc'>" . $message . "</span>";
                }
                $this->session->unset_userdata('message');
                ?>
                </p>
                <!--########-->
                
                <?php
                        if (!empty($examroutinelist)) {
                            ?> 
<br>
<form action="<?php echo base_url(); ?>home/searchexamroutinedata_new" method="post">

    <div class="examsearch">
        <label class="control-label" for="form-field-1">Session&nbsp;&nbsp;<?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
        <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
            <option value="">Select</option>
            <?php foreach (getOfferedSession() as $value) { ?>
                <option value="<?php echo $value['sessionId']; ?>"
                    <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                    <?php echo $value['session']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="examsearch">
        <label class="control-label" for="form-field-1">Class&nbsp;&nbsp;<?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
        <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">
            <option value="">Select</option>
        </select>
    </div>

    <br><br>

    <div class="examsearch">
        <label class="control-label" for="form-field-1">Medium<?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
        <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">
            <option value="">Select</option>
        </select>
    </div>

    <div class="examsearch">
        <label class="control-label" for="form-field-1">Shift&nbsp;&nbsp;&nbsp;<?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
        <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >
            <option value="">Select</option>
        </select>
    </div>

    <br><br>

    <div class="examsearch">
        <label class="control-label" for="form-field-1">Group<?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
        <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">
            <option value="">Select</option>
        </select>
    </div>
    
    <div class="examsearch">
        <label class="control-label" for="form-field-1">Section&nbsp;&nbsp;<?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
        <select id="getsectionid" name="data[sectionId]" required="1" class="form-control">
            <option value="">Select</option>
        </select>
    </div>

    
    
    
<br><br>

    <div class="examsearch">
        <label class="control-label" for="form-field-1">Exam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
        <select name="data[semesterId]" required="1" class="form-control" id="form-field-select-1">
            <option value="">Select</option>
            <?php foreach (getSemesterInfoArray() as $velues) { ?>
                <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('semesterId', $velues['semesterId'], FALSE) ?>><?php echo $velues['semester'] ?></option>
            <?php } ?>
        </select>
    </div>


    <br><br>

                <div class="btnsrc">

                                        
                    <input class="btn btn-default redsbtn" type="submit" name="data['search']" value=" View Routine List">
                    </div>
                </form>
<?php } ?>
            </section>

            <!-- ASIDE NAV 2 -->

            <?php
            if (!empty($getnoticedata)) {
                ?>
                <aside class="s-12 l-3">
                    <h3 class="titlehd">Notice Board</h3>
                    <div class="aside-nav">
                        <ul>
                            <?php
                            foreach ($getnoticedata as $value) {
                                ?>
                                <span class="dte">&nbsp; <?php echo $value['dateAdd']; ?></span>
                                <li>
                                    <a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>"><?php
                        $limit = character_limiter($value['title'], 20);
                        echo $limit;
                                ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </aside>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    function getOfferedSession_classId() {
        var id = $("#getsessionid").val();
        //alert(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getsession_programlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //  $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //  alert(msg);
                $('#getprogramid').empty().append(msg);
            }
        });

    }

    function getOfferedprogramId() {
        var id = $("#getprogramid").val();
        var session = $('#getsessionid').val();
        // alert(id);
        // Get Offered Medium List By Class
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffermediumlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //
                // alert(msg);                          // $('.add_list').empty();
                $('#getmediumid').empty().append(msg);
            }
        });

        // Get Offered Group List By Class
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffergrouplist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getgroupid').empty().append(msg);

            }
        });

        // Get Offered Shift List By Class
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffershiftlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getshiftid').empty().append(msg);

            }
        });

        // Get Offered Section List By Class
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffersectionlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getsectionid').empty().append(msg);

            }
        });

    }


</script>