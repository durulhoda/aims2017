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
                    Institute Class Routine
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
                
          
<br>
<form action="<?php echo base_url(); ?>home/searchclassroutinedata" method="post">
                    <div class="examsearch">
                        <label class="control-label" for="form-field-1">Class Name  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                        <select id="getsessionid" onchange="return getProgramName(); " data-placeholder="Select" name="data[programId]"  required="1" class="form-control">
                            <option value="">Select</option>
                            <?php foreach (getOfferedProgram() as $value) { ?>
                                <option value="<?php echo $value['programId']; ?>" 
                                        <?php echo set_select('data[programId]', $value['programId'], FALSE) ?> >
                                    <?php echo $value['programName']; ?></option>                                                
                            <?php } ?>
                        </select>
                    </div>
                
                    
                    <div class="examsearch">
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
    
    
<br><br>

                <div class="btnsrc">

                                        
                    <input class="btn btn-default redsbtn" type="submit" name="data['search']" value=" View Routine List">
                    </div>
                </form>

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
