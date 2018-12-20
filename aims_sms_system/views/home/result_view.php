<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box  margin-bottom">
        <div class="margin">
            <!-- ASIDE NAV 1 -->

            <!-- CONTENT -->
            <div class="row">
                <h3 class="titlehd"> Student Result </h3>
            </div>

            <?php

            $message = $this->session->userdata('message');
            if (isset($message)) {
                ?>
                <div id="printpagebutton2" class="alert alert-block alert-success">
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
                <div id="printpagebutton1" class="alert alert-block alert-danger">
                    <i class="ace-icon fa fa-times red"></i>
                    <?php
                    echo $errormessage;
                    $this->session->unset_userdata('errormessage');
                    ?>
                </div>
            <?php
            }
            ?>


        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>home/search_result" method="post">


            <table style='width:80%; margin: 20px 10%;text-align: center;'>
                <tr>
                    <td style="text-align: right; padding-right: 45px ">
                        Student ID :
                    </td>
                    <td style="text-align: left;">
                        <input style="height:30px;" type="text" class="" name="studentId" value ="" placeholder="Student ID" required=""> <cell class="red"> * </cell>
                    </td>
                </tr>
            </table>


            <table style='width:80%; margin: 10px 10%;' >
                <tr>
                    <td style="text-align: right; padding-right: 45px ">
                        Session :
                    </td>
                    <td style="text-align: left;">
                        <?php echo form_error('datax[sessionId]', '<div class="red">', '</div>'); ?>
                        <select id="getsessionid" onchange="return getOfferedSessionId();" name="sessionId" required="" style="width:200px">
                            <option value="">Select</option>
                            <?php foreach (getOfferedSession() as $value) { ?>
                                <option value="<?php echo $value['sessionId']; ?>"
                                    <?php echo set_select('datax[sessionId]', $value['sessionId'], FALSE) ?> >
                                    <?php echo getSessionName($value['sessionId']); ?></option>
                            <?php } ?>
                        </select>  <cell class="red"> * </cell>
                    </td>

                    <td style="text-align: right; padding-right: 45px ">
                        Exam :
                    </td>
                    <td style="text-align: left;">
                        <?php echo form_error('datax[programLevel]', '<div class="red">', '</div>'); ?>
                        <select id="getsessionid"  data-placeholder="Select" name="semesterId" required="" class="form-control">
                            <option value="">Select</option>
                            <?php foreach(getSemesterInfoArray() as $velues){?>
                                <option value="<?php echo $velues['semesterId'];?>"
                                    <?php echo set_select('data[semesterId]', $velues['semesterId'], FALSE)?>><?php echo $velues['semester']?></option>
                            <?php }?>
                        </select>  <cell class="red"> * </cell>
                    </td>
                </tr>
            </table>

            <table style='width:80%; margin: 20px 10%;text-align: center;'>
                <tr>
                    <td>
                        <input type="submit" class="savebtn" name="Search" value ="Search">
                    </td>

                </tr>
            </table>

        </form>







            <!-- ASIDE NAV 2 -->

        </div>
    </div>
</div>