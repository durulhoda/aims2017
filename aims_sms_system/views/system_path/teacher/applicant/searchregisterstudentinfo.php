
<!-- Right Side/Main Content Start -->
<div id="rightside">       

    <!-- Alternative Content Box End -->

    <div class="contentcontainer lar left">
        <div class="headings altheading">

            <h2>Student Registration</h2>
            <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
                echo "<span id='messagesuc'>" . $message . "</span>";
                $this->session->unset_userdata('message');
            }
            ?>

        </div>

        <div class="contentbox">       

            <div id="tabs">
                <div id="tabs-1" style="margin-top: 40px;">


                    <form action="<?php echo base_url('admin') ?>/studentregistration/searchregisterstudentinfo" method="post">
                       <table style='width:60%; margin: 0px 20%'>
                           <tr>  
                                 <td style="text-align: right; padding-right: 15px "> Applicant Id :</td>
                                <td>
                                    <?php echo form_error('applicationId', '<div style="color: rgb(255, 0, 0);" class="successMessage">', '</div>'); ?>
                                    <input type="text" id="Name" placeholder="Applicant Id" class="Name" name="applicationId" value="<?php echo set_value('applicationId');?>" /> <br />

                                </td>
                               
                            </tr>
                       
                            <tr>
                                <td></td>
                                <td >
                                    <input type="submit" name="search" class="btn"  value="Search">
                                </td>

                            </tr>


                        </table>
                    </form>


                    <?php
                    if (!empty($studentlist)) {
                        echo "<table width='100%' style=\" border: 1px solid #cccccc;\">"
                        ?>
                        <tr> 
                            <th style=" border: 1px solid #cccccc; text-align: center;">Sl. No</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Application ID</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Applicant Name</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Campas</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Medium</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Class</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Group </th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Section</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Shift</th>
                            <th style=" border: 1px solid #cccccc; text-align: center;">Session</th>
                        </tr>
                            <?php
                            $i = 1;
                           // foreach ($studentlist as $value) {
                                ?>
                            <form id="frm1" name="frm1" action="<?php echo admin_Url() ?>/studentregistration/insertregistrationconfirm" method="post">
                               
                                    <tr style="border: 1px solid #D8D8D8; background: #BBDEE6;" >
                                        <td style=" text-align: center"><?php echo $i; ?></td>
                                        <td style=" text-align: center">
                                    <?php
                                    if (!empty($applicationId)) {                                       
                                            ?>  
                                                   <span style="color:red;">
                                                    <?php
                                                    echo $applicationId;
                                                    ?>
                                                    </span>
                                            <?php
                                                }
                                                ?>
                                             <input type="hidden" name="data[applicationId]" value="<?php echo $applicationId; ?>">
                                             
                                        </td>
                                        <td style=" text-align: center">
                                            <?php
                                                if (!empty($studentlist)) {
                                                       echo $studentlist['firstName'] . " " . $studentlist['lastName'];
                                                   
                                                }
                                                ?>
                                        </td>

                                        <td style=" text-align: center">
                                            <?php if (!empty($programofferinfo['campusId'])) {
                                                echo getCampusNames($programofferinfo['campusId']);
                                            } ?>
                                            <input type="hidden" name="data[campusId]" value="<?php echo $programofferinfo['campusId']; ?>">
                                        </td>
                                        <td style=" text-align: center">
                                                <?php if (!empty($programofferinfo['mediumId'])) {
                                                    echo getmediumName($programofferinfo['mediumId']);
                                                } ?>
                                            <input type="hidden" name="data[mediumId]" value="<?php echo $programofferinfo['mediumId']; ?>">
                                        </td>
                                        <td style=" text-align: center">
                                            <?php if (!empty($programofferinfo['programId'])) {
                                                echo getProgramname_accId($programofferinfo['programId']);
                                            } ?>
                                            <input type="hidden" name="data[programId]" value="<?php echo $programofferinfo['programId']; ?>">
                                        </td>
                                        <td style=" text-align: center">
            <?php if (!empty($programofferinfo['groupId'])) {
                echo getGroupName($programofferinfo['groupId']);
            } ?>
                                            <input type="hidden" name="data[groupId]" value="<?php echo $programofferinfo['groupId']; ?>">
                                        </td>
                                        <td style=" text-align: center">
                                          
                                            <select name="data[sectionId]" required class="redtxt">
                                                <option value="" selected>Select</option>
                                                <?php foreach (getSectionArrayofferedprogram($programofferinfo) as $value) { ?>
                                                    <option value="<?php echo $value['sectionId'] ?>"
                                                            <?php echo set_select('sectionId', $value['sectionId'], FALSE); ?>>
                                                        <?php echo getsectionName($value['sectionId']); ?></option>
                                                    <?php } ?>
                                            </select>
                                                                                        
                                        </td>
                                        <td style=" text-align: center">
                                                <?php if (!empty($programofferinfo['shiftId'])) {
                                                    echo getshiftName($programofferinfo['shiftId']);
                                                                                                       
                                                } ?>
                                            
                                            <input type="hidden" name="data[shiftId]" value="<?php echo $programofferinfo['shiftId']; ?>">
                                        </td>
                                        <td style=" text-align: center">
                                            <?php echo $programofferinfo['sessionId'] ?> 
                                            <input type="hidden" name="data[sessionId]" value="<?php echo $programofferinfo['sessionId']; ?>">
                                        </td>

                                        

                                    </tr>
            <?php
            

  //  }
    ?>



                            </table>
                            <table>
                                <tr>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>

                                    <td style="text-align: right" >
                                        <input type="submit"  class="btn" name="regConfirm" value="Registration Confirm & Next Subject Assign">
                                    </td>

                                </tr>

                            </table>

                        </form>
    <?php
}
 
?>  

                </div>   
            </div>
        </div>
    </div>



