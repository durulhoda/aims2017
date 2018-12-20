<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box  margin-bottom">
        <div class="margin">
            <section class="s-12 l-12">

                <?php
                $redmessage = $this->session->userdata('redmessage');
                if (isset($redmessage)) {
                    echo "<span id='messagefail' class='redmessage'>" . $redmessage . "</span>";
                }

                $this->session->unset_userdata('redmessage');
                ?>
                <?php
                $message = $this->session->userdata('message');

                if (isset($message)) {
                    echo "<span id='messagesuc'>" . $message . "</span>";
                }
                $this->session->unset_userdata('message');
                ?>

                <h3 class="titlehd">Apply For Admission

                </h3>

                <form id="abcd" onclick="hello()" action="<?php echo base_url() ?>home/insertapplicant" method="post" enctype="multipart/form-data">
                    <br>
                    <fieldset>
                        <legend class="lgnd"> <span>Apply For</span></legend>

                        <table style='width:80%; margin: 10px 10%;' >
                            <tr>
                                <td style="text-align: right; padding-right: 45px ">
                                        Session :
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo form_error('datax[sessionId]', '<div class="red">', '</div>'); ?>
                                        <select id="getsessionid" onchange="return getOfferedSessionId();" name="datax[sessionId]" style="width:200px">
                                            <option value="">Select</option>
                                            <?php foreach (getOfferedSession() as $value) { ?>
                                                <option value="<?php echo $value['sessionId']; ?>"
                                                        <?php echo set_select('datax[sessionId]', $value['sessionId'], FALSE) ?> >
                                                    <?php echo getSessionName($value['sessionId']); ?></option>
                                            <?php } ?>
                                        </select>  <cell class="red"> * </cell>
                                    </td> 

                                    <td style="text-align: right; padding-right: 45px ">
                                        Class Level :
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo form_error('datax[programLevel]', '<div class="red">', '</div>'); ?>
                                        <select id="getprogramLevelid" onchange="return getOfferedprogramLevelId();" name="datax[programLevel]" style="width:200px">
                                        <option value="" selected>Select</option>
                                            <?php
                                            foreach (getOfferedProgramLevel() as $value) {
                                                ?>
                                                <option  value="<?php echo $value['programLevel'] ?>"
                                                         <?php echo set_select('datax[programLevel]', $value['programLevel'], FALSE); ?>>
                                                    <?php echo getProgramName($value['programLevel']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>  <cell class="red"> * </cell>
                                    </td> 
                            </tr>

                            <tr>
                                <td style="text-align: right; padding-right: 45px ">Class :
                                </td>
                                <td style="text-align: left;">
                                    <?php echo form_error('datax[programId]', '<div class="red">', '</div>'); ?>
                                    <select id="getprogramid" name="datax[programId]" onchange="return getOfferedprogramId();" style="width:200px">
                                            <option value="" selected>Select</option>
                                            <?php
                                            foreach (getOfferedProgram() as $value) {
                                                ?>
                                                <option  value="<?php echo $value['programId'] ?>"
                                                         <?php echo set_select('datax[programId]', $value['programId'], FALSE); ?>>
                                                    <?php echo getProgramName($value['programId']); ?>
                                                </option>
                                            <?php } ?>
                                    </select>
                                    <cell class="red"> * </cell>
                                </td>

                                <td style="text-align: right; padding-right: 45px ">Medium  :
                                </td>
                                <td style="text-align: left;">
                                    <?php echo form_error('datax[mediumId]', '<div class="red">', '</div>'); ?>
                                    <select id="getmediumid" onchange="return getOfferedmediumId();" name="datax[mediumId]" style="width:200px">
                                        <option value="">Select</option>
                                        <?php foreach (getOfferedMedium() as $value) { ?>
                                            <option value="<?php echo $value['mediumId']; ?>"
                                                    <?php echo set_select('datax[mediumId]', $value['mediumId'], FALSE) ?> >
                                                <?php echo getmediumName($value['mediumId']); ?></option>
                                        <?php } ?>
                                    </select>  <cell class="red"> * </cell>
                                </td>
                                
                            </tr>

                            <tr>
                            	<td style="text-align: right; padding-right: 45px "> Shift :
                                </td>
                                <td style="text-align: left;">
                                    <?php echo form_error('datax[shiftId]', '<div class="red">', '</div>'); ?>
                                    <select id="getshiftid" onchange="return getOfferedshiftId();" name="datax[shiftId]" style="width:200px">
                                        <option value="" selected="selected">Select</option>
                                        <?php foreach (getOfferedShift() as $value) { ?>
                                            <option value="<?php echo $value['shiftId']; ?>"
                                                    <?php echo set_select('datax[shiftId]', $value['shiftId'], FALSE) ?> >
                                                <?php echo getshiftName($value['shiftId']); ?></option>
                                        <?php } ?>
                                    </select> <cell class="red"> * </cell>
                                </td>
                                <td style="text-align: right; padding-right: 45px ">
                                Group :
                                </td>
                                <td style="text-align: left;">
                                <?php echo form_error('datax[groupId]', '<div class="red">', '</div>'); ?>
                                <select id="getgroupid" onchange="return getOfferedgroupId();" name="datax[groupId]" style="width:200px">
                                    <option value="" selected="selected">Select</option>
                                    <?php foreach (getOfferedGroup() as $value) { ?>
                                        <option value="<?php echo $value['groupId']; ?>"
                                                <?php echo set_select('datax[groupId]', $value['groupId'], FALSE) ?> >
                                            <?php echo getGroupName($value['groupId']); ?></option>
                                    <?php } ?>
                                </select> <cell class="red"> * </cell>
                                </td>

                                
                            </tr>

                           <!--  <tr>
                                
                                <!-- <td style="text-align: right; padding-right: 15px ">
                                    Transaction Id :
                                </td>
                                <td style="text-align: left;">
                                    <?php// echo form_error('data[transactionId]', '<div class="red">', '</div>'); ?>
                                    <input style="width:200px" type="text" name="data[transactionId]" placeholder="Bank Transaction Id" maxlength="20" value="<?php// echo set_value("data[transactionId]"); ?>">
                                </td>-->
                          <!--   </tr> --> 
                        </table>



                    </fieldset>
                    <fieldset>
                        <legend class="lgnd">
                            <span>Personal Information</span></legend>
                        <table style='width:80%; margin: 20px 10%'>
                            <tr >
                                <td style="text-align: right; padding-right: 15px " > Name:</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[firstName]', '<div class="red">', '</div>'); ?>
                            <input id="redmess" placeholder="Full Name" style="width:250px" type="text" name="data[firstName]" value="<?php echo set_value("data[firstName]"); ?>"> <cell class="red"> * </cell>
                            </td>


                              <!--          <td style="text-align: right; padding-right: 15px "> Last Name:</td>
                                        <td style="text-align: left;">
                            <?php echo form_error('data[lastName]', '<div class="red">', '</div>'); ?>
                                            <input type="text" name="data[lastName]" value="<?php echo set_value("data[lastName]"); ?>" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;"> Middle Name:</td>
                                        <td style="text-align: left;">
                            <?php echo form_error('data[middleName]', '<div class="red">', '</div>'); ?>
                                            <input type="text" name="data[middleName]" value="<?php echo set_value("data[middleName]"); ?> ">
                                        </td>
                                        <td style="text-align: left;"> Nick Name:</td>
                                        <td style="text-align: left;">
                            <?php echo form_error('data[nickName]', '<div class="red">', '</div>'); ?>
                                            <input type="text" name="data[nickName]" value="<?php echo set_value("data[nickName]"); ?> ">
                                        </td>  -->
                            <td style="text-align: right; padding-right: 15px "> Date of Birth :</td>
                                <td style="text-align: left; padding-right: 15px ">
                                    <?php echo form_error('data[dateOfBirth]', '<div class="red">', '</div>'); ?>
                                    <input style="width:225px" id="redmess" type="text" id="datepicker" name="data[dateOfBirth]" placeholder="DD/MM/YYYY"  value="<?php echo set_value("data[dateOfBirth]"); ?>">
                            <cell class="red"> * </cell>
                            </td>
                            </tr>
                            <tr>
                                

                            <td style="text-align: right; padding-right: 15px ">Birth Registration No :</td>
                            <td style="text-align: left;">
                                <?php echo form_error('data[sbreg]', '<div class="red">', '</div>'); ?>
                                <input style="width:250px" type="text" name="data[sbreg]" placeholder="Birth Registration Number"  value="<?php echo set_value("data[sbreg]"); ?>">

                            </td>
                            <td style="text-align: right; padding-right: 15px ">Gender :</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[gender]', '<div class="red">', '</div>'); ?>
                                    <input type="radio" name="data[gender]" value="1" <?php echo set_radio("data[gender]", "1", FALSE); ?>/> Boy
                                    <input type="radio" name="data[gender]" value="2"  <?php echo set_radio("data[gender]", "2", FALSE); ?>/> Girl
                            <cell class="red"> * </cell>
                            </td>
                            </tr>
                            <tr>
                                

                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Nationality :</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[nationality]', '<div class="red">', '</div>'); ?>
                                    <select name="data[nationality]" style="width:250px">
                                        <option value="Bangladeshi"> Bangladeshi </option>

                                    </select>
                                    <!--        <?php // echo form_error('data[nationality]', '<div class="red">', '</div>');       ?>
                                            <input id="redmess" type="text" name="data[nationality]" value="Bangladeshi"> -->

                                </td>
                                <td style="text-align: right; padding-right: 15px "> Religion  : </td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[religion]', '<div class="red">', '</div>'); ?>
                                    <select name="data[religion]" style="width:250px">
                                        <option value="">Select Religion</option>
                                        <?php foreach (getReligion() as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php echo set_select("data[religion]", $key, FALSE); ?> ><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Blood Group :</td>

                                <td style="text-align: left;">
                                    <?php echo form_error('data[bloodGroup]', '<div class="red">', '</div>'); ?>
                                    <select name="data[bloodGroup]" style="width:250px">
                                        <option value="">Select Blood Group</option>
                                        <?php foreach (getBloodGroup() as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>"
                                                    <?php echo set_select('data[bloodGroup]', $key, FALSE) ?> >
                                                <?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                
                                <!--<td style="text-align: right; padding-right: 15px ">National ID (if have) :</td>
                                <td style="text-align: left;">
                                    <?php// echo form_error('data[snId]', '<div class="red">', '</div>'); ?>
                                    <input style="width:250px" type="text" name="data[snId]" placeholder="Your National ID (if have)"  value="<?php// echo set_value("data[snId]"); ?>">

                                </td>-->
                            </tr>
                        </table>
                    </fieldset>

                    <fieldset>
                        <legend class="lgnd">
                            <span>Contact Information</span></legend>

                        <table style='width:80%; margin: 20px 10%'>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Mobile :</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[phone]', '<div class="red">', '</div>'); ?>
                                    <input style="width:200px" type="text" placeholder="01XXXXXXXXX" pattern="[0-9]{11}" title="11 digit number(012345678901)" maxlength="11" name="data[phone]" value="<?php echo set_value("data[phone]"); ?>">

                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Permanent Address  :</td>

                                <td style="text-align: left;">
                                    <?php echo form_error('data[permanentAddress]', '<div class="red">', '</div>'); ?>
                                    <textarea rows="5" spellcheck="false" cols="30" input type="text" placeholder="Permanent Address" name="data[permanentAddress]"><?php echo set_value("data[permanentAddress]"); ?></textarea>

                            <cell class="red"> * </cell>
                            </td>

                            <td style="text-align: right; padding-right: 15px ">Present Address  :</td>

                            <td style="text-align: left;">
                                <?php echo form_error('data[presentAddress]', '<div class="red">', '</div>'); ?>
                                <textarea id="redmess" rows="5" cols="30" input type="text" placeholder="Present Address" name="data[presentAddress]"><?php echo set_value("data[presentAddress]"); ?></textarea>

                            <cell class="red"> * </cell>
                            </td>
                            </tr>

                        </table>
                    </fieldset>
                    <fieldset>
                        <legend class="lgnd">

                            <span>Parents/Legal Guardian Information</span></legend>
                        <table style='width:80%; margin: 20px 10%'>
                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Father Name:</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[fatherName]', '<div class="red">', '</div>'); ?>
                                    <input id="redmess" type="text" style="width:250px" name="data[fatherName]" placeholder="Father Name" value="<?php echo set_value("data[fatherName]"); ?>">

                            <cell class="red"> * </cell>
                            </td>


                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Father's Profession : </td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[fatherProfession]', '<div class="red">', '</div>'); ?>
                                    <select name="data[fatherProfession]" style="width:250px">
                                        <option value="">Select Father's Profession</option>
                                        <?php foreach (getProfessionFather() as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php echo set_select('data[fatherProfession]', $key, FALSE); ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>


                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px;">Father's Annual Income</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[fatherMonthlyIncome]', '<div class="red">', '</div>'); ?>
                                    <input type="text" name="data[fatherMonthlyIncome]" style="width:250px" placeholder="Father's Annual Income">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Father's Mobile :</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[fatherPhone]', '<div class="red">', '</div>'); ?>
                            <input type="text" style="width:250px" name="data[fatherPhone]" placeholder="Father's Phone Number" value="<?php echo set_value("data[fatherPhone]"); ?>"><cell class="red"> * </cell>
                            </td>

                            </tr>

                            <tr>
                                <td style="text-align: right; padding-right: 15px ">National ID:</td>
                                <td style="text-align: left;"><input style="width:250px" type="text" name="data[fnid]" placeholder="Father's National ID " value="<?php echo set_value("data[nfid]") ?>"></td>

                            </tr>
                            <tr>
                                <td style="text-align: left;"> &nbsp;</td>
                            </tr>

                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Mother Name:</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[motherName]', '<div class="red">', '</div>'); ?>
                                    <input id="redmess" style="width:250px" type="text" name="data[motherName]"  placeholder="Mother Name" value="<?php echo set_value("data[motherName]"); ?>">

                            <cell class="red"> * </cell>
                            </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Mother's Profession : </td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[motherProfession]', '<div class="red">', '</div>'); ?>
                                    <select name="data[motherProfession]" style="width:250px">
                                        <option value="">Select Mother's Profession</option>
                                        <?php foreach (getProfessionMother() as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php echo set_select('data[motherProfession]', $key, FALSE); ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                            </tr>
                            <!--<tr>
                                <td style="text-align: right; padding-right: 15px;">Mother's Monthly Income</td>
                                <td style="text-align: left;">
                                    <?php// echo form_error('data[motherMonthlyIncome]', '<div class="red">', '</div>'); ?>
                                    <input type="text" name="data[motherMonthlyIncome]" style="width:250px" placeholder="Mother's Monthly Income">
                                </td>
                            </tr>-->
                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Mother's Mobile :</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[motherPhone]', '<div class="red">', '</div>'); ?>
                            <input type="text" style="width:250px" name="data[motherPhone]" placeholder="Mother's Phone Number" value="<?php echo set_value("data[motherPhone]"); ?>">
                            </td>
                            </tr>

                            <tr>
                                <td style="text-align: right; padding-right: 15px ">National ID:</td>
                                <td style="text-align: left;"><input style="width:250px" type="text" name="data[mnid]" placeholder="Mother's National ID " value="<?php echo set_value("data[mnid]") ?>"></td>

                            </tr>
                            <tr>
                                <td style="text-align: left;"> &nbsp;</td>
                                <td style="text-align: left;"> &nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Legal Guardian Name:</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[legalGardianName]', '<div class="red">', '</div>'); ?>
                                    <input style="width:250px" type="text" name="data[legalGardianName]" placeholder="Legal Guardian Name" value="<?php echo set_value("data[legalGardianName]"); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Legal Guardian's Profession : </td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[legalGardianProfession]', '<div class="red">', '</div>'); ?>
                                    <select name="data[legalGardianProfession]" style="width:250px">
                                        <option value="">Select Legal Guardian's Profession</option>
                                        <?php foreach (getProfession() as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php echo set_select('data[legalGardianProfession]', $key, FALSE); ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px "> Legal Guardian's Phone :</td>
                                <td style="text-align: left;">
                                    <?php echo form_error('data[legalGardianPhone]', '<div class="red">', '</div>'); ?>
                                    <input type="text" style="width:250px" name="data[legalGardianPhone]" placeholder="Legal Guardian's Phone Number" value="<?php echo set_value("data[legalGardianPhone]"); ?>">
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align: right; padding-right: 15px ">National ID (if have) :</td>
                                <td style="text-align: left;"><input style="width:250px" type="text" name="data[lgnid]" placeholder="Legal Guardian's National ID" value="<?php echo set_value("data[lgnid]") ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;"> &nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Quota (if have) :</td>
                                <td style="text-align: left;">
                                    <select name="data[quata_id]" >
                                        <?php
                                        foreach (getQuatalist() as $value) {
                                            ?>
                                            <option value="<?php echo $value['quata_id']; ?>"
                                                    <?php echo set_select("data[quata_id]", $value['quata_id'], FALSE); ?> >
                                                        <?php echo $value['quata']; ?>
                                            </option>

                                            <?php
                                        }
                                        ?>

                                    </select>
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                    <fieldset>
                        <legend class="lgnd">
                            <span>Previous Information</span>
                        </legend>
                        <table style='width:80%; margin: 20px 10%'>
                            <tr >
                                <td style="text-align: right; padding-right: 15px ">School Name :</td>
                                <td style="text-align: left;">
                                <?php echo form_error('data[sclname]', '<div class="red">', '</div>'); ?>
                                <input style="width:250px" type="text" name="data[sclname]" placeholder="School Name" value="<?php echo set_value("data[sclname]"); ?>">
                                </td>
                                <td style="text-align: right; padding-right: 15px ">Class :</td>
                                <td style="text-align: left;">
                                <?php echo form_error('data[clsname]', '<div class="red">', '</div>'); ?>
                                <input style="width:250px" type="text" name="data[clsname]" placeholder="Class" value="<?php echo set_value("data[clsname]"); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Result &nbsp;(GPA) :</td>
                                <td style="text-align: left;">
                                <?php echo form_error('data[prvresult]', '<div class="red">', '</div>'); ?>
                                <input style="width:250px" type="text" name="data[prvresult]" placeholder="Result (GPA)" value="<?php echo set_value("data[prvresult]"); ?>">

                                </td>
                                <td style="text-align: right; padding-right: 15px ">Passing Year :</td>
                                <td style="text-align: left;">
                                <?php echo form_error('data[prvpassingyr]', '<div class="red">', '</div>'); ?>
                                <input style="width:250px" type="text" name="data[prvpassingyr]" placeholder="Passing Year" value="<?php echo set_value("data[prvpassingyr]"); ?>">

                                </td>
                            </tr>
                            <tr >
                                <td style="text-align: right; padding-right: 15px ">T.C No. :</td>
                                <td style="text-align: left;">
                                <?php echo form_error('data[tcno]', '<div class="red">', '</div>'); ?>
                                <input style="width:250px" type="text" name="data[tcno]" placeholder="T.C Number" value="<?php echo set_value("data[tcno]"); ?>">
                                </td>
                                <td style="text-align: right; padding-right: 15px ">T.C Issued Date :</td>
                                <td style="text-align: left;">
                                <?php echo form_error('data[tcdate]', '<div class="red">', '</div>'); ?>
                                <input style="width:250px" type="text" name="data[tcdate]" placeholder="T.C Issued Date" value="<?php echo set_value("data[tcdate]"); ?>">
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend class="lgnd">

                            <span>Applicant Photo</span></legend>

                        <table style='width:80%; margin: 20px 1%'>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Student's Photo:</td>
                                <td style="text-align: left;">
                                    <div class="red">
                                        <img src="" id="imagePriview"  title="Image priview" height="100px" width="200px" /><br>
                                        <input type="file" id="imageUpload" name="userfile" value="<?php echo set_value("photo"); ?>">
                                        <span id="imgErr" style="color: red;"></span>

                                    </div>
                                </td>
                            </tr>
                            <!--<tr>    
                                <td style="text-align: right; padding-right: 15px ">Father's Photo:</td>
                                <td style="text-align: left;">
                                    <div class="red">

                                        <img src="" id="imagePriviewFather"  title="Image priview" height="100px" width="200px" /><br>
                                        <input type="file" id="imageUploadFather" name="imageUploadFather" value="<?php// echo set_value("photo"); ?>">
                                        <span id="imgErrFather" style="color: red;"></span>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 15px ">Mother's Photo:</td>
                                <td style="text-align: left;">
                                    <div class="red">

                                        <img src="" id="imagePriviewMother"  title="Image priview" height="100px" width="200px" /><br>
                                        <input type="file" id="imageUploadMother" name="imageUploadMother" value="<?php// echo set_value("photo"); ?>">
                                        <span id="imgErrMother" style="color: red;"></span>
                                    </div>
                                </td>

                            </tr>-->
                        </table>

                    </fieldset>


                    <table style='width:80%; margin: 20px 10%'>
                        <tr>
                            <td>
                                <input type="submit" class="savebtn" name="save" value ="Save">
                            </td>

                        </tr>
                    </table>

                </form>
            </section>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        //alert("hi");
        $("#imageUpload").change(function (e) {
            var file = this.files[0];
            var imagefile = file.type;
            var imagesize = file.size;
            // alert(imagesize);
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                //$('#previewing').attr('src', 'noimage.png');
                $("#imgErr").html("<p>Please Select A valid Image File; Note :Only jpeg, jpg and png Images type allowed</p>").fadeIn(2000).fadeOut(7000);
                return false;
            } else if (imagesize > 1000000) {
                $("#imgErr").html("<p>Please upload a smaller image, max size is 1 MB</p>").fadeIn(2000).fadeOut(7000);
                return false;
            } else
            {
                $("#imgErr").html("<p>Image Successfully uploaded</p>").fadeIn(2000).fadeOut(7000);
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });

        function imageIsLoaded(e) {
            $('#imagePriview').attr('src', e.target.result);
        }
    });
</script>
<script>
    $(document).ready(function () {
        //alert("hi");
        $("#imageUploadFather").change(function (e) {
            var file = this.files[0];
            var imagefile = file.type;
            var imagesize = file.size;
            // alert(imagesize);
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                //$('#previewing').attr('src', 'noimage.png');
                $("#imgErrFather").html("<p>Please Select A valid Image File; Note :Only jpeg, jpg and png Images type allowed</p>").fadeIn(2000).fadeOut(7000);
                return false;
            } else if (imagesize > 1000000) {
                $("#imgErrFather").html("<p>Please upload a smaller image, max size is 1 MB</p>").fadeIn(2000).fadeOut(7000);
                return false;
            } else
            {
                $("#imgErrFather").html("<p>Image Successfully uploaded</p>").fadeIn(2000).fadeOut(7000);
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);


            }
        });

        function imageIsLoaded(e) {
            $('#imagePriviewFather').attr('src', e.target.result);
        }
    });
</script>
<script>
    $(document).ready(function () {
        //alert("hi");
        $("#imageUploadMother").change(function (e) {
            var file = this.files[0];
            var imagefile = file.type;
            var imagesize = file.size;
            // alert(imagesize);
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                //$('#previewing').attr('src', 'noimage.png');
                $("#imgErrMother").html("<p>Please Select A valid Image File; Note :Only jpeg, jpg and png Images type allowed</p>").fadeIn(2000).fadeOut(7000);
                return false;
            } else if (imagesize > 1000000) {
                $("#imgErrMother").html("<p>Please upload a smaller image, max size is 1 MB</p>").fadeIn(2000).fadeOut(7000);
                return false;
            } else
            {
                $("#imgErrMother").html("<p>Image Successfully uploaded</p>").fadeIn(2000).fadeOut(7000);
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });

        function imageIsLoaded(e) {
            $('#imagePriviewMother').attr('src', e.target.result);
        }
    });
</script>
