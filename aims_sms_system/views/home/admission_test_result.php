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

                <h3 class="titlehd">Admission Test Result</h3>

                <form action="<?php echo base_url() ?>home/admissionTestResult" method="post">
                    <fieldset>
                        <legend class="lgnd"> <span>Search</span></legend>
                        <div class="form-group" style="text-align: center;font-size: 18px;">
                          <label for="app">Applicat Id:</label>
                          <input type="text" class="form-control" name="application_id" placeholder="Enter application id" style="    width: 202px;height: 28px;" required="">
                        </div>
                        <div class="form-group" style="text-align: center;font-size: 18px;    margin-top: 23px;">
                        <button class="btn btn-success btn-sm" name="search" type="submit">
                            <i class="ace-icon fa fa-search bigger-120"></i>
                           Search
                        </button>
                        </div>

                    </fieldset>
                </form>
                    <?php if (isset($record)) : ?>
                    <style type="text/css">
                    .c_print{
                            position: absolute;
                            z-index: 9999;
                            top: 205px;
                            right: 40px;
                    }
                </style>
                    <fieldset id="printableArea">
                    <style tyle="text/css">
                    @media print
                    {
                        .c_print,.non{display: none;}
                    }
                </style>
                        <legend><span class="non">Result</span></legend>
                        <table style="width:100%; margin-bottom: 5px">
                            <tbody>
                                <tr style=" font-family: cambria;"> 
                                    <td style="text-align: center;" colspan="7">
                                    <?php $logo = base_url().$institute_info->logo;?>
                                                <p style="margin-left:5px;margin-bottom: 15px; ">
                                            <img src="<?php echo $logo; ?>" style="margin-top:3px; width: 100px;" height="80">  
                                            </p><div style="font-size: 20px;    margin-bottom: 19px; font-size: 35px; color: royalblue;">    
                                                <?php echo ($institute_info->institute_name) ? $institute_info->institute_name : "";?>        
                                            </div>                                           
                                            <div style="line-height: 3px; font-size: 18px; color: #444;    margin-bottom: 3px;"> 
                                                <?php echo ($institute_info->address) ? $institute_info->address : ""; ?>                  
                                            </div>
                                            <p></p>
                                            <span><button aria-expanded="false" data-toggle="tab" onclick="printDiv('printableArea')" class="btn-new-mail no-border c_print">
                                                <span class="btn btn-purple no-border">
                                                  <i class="ace-icon fa fa-print bigger-130"></i>
                                                  <span class="bigger-110">Print</span>
                                                </span>
                                            </button></span>
                                        </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; " colspan="7">
                                        <h3 style="font-family: Algerian;color:red;">ADMISSION TEST RESULT</h3> 
                                    </td> 
                                </tr>
                                <!-- <tr>
                                    <td colspan="7"><hr></td>
                                </tr> -->
                                <tr>
                                    <td colspan="1" width="165px;">
                                    <?php $student_photo = base_url().$record->photo;?>
                                        <!-- <img src="<?php echo ($student_photo) ? $student_photo : ""; ?>" style="margin-top:3px; width: 100px;" height="80"> -->
                                        <img src="http://localhost/tanay/uploads/Students/21.jpg" style="margin-top: -139px; width: 140px;" height="80">
                                    </td>
                                    <td colspan="3">
                                        <table style="width:100%; float: right; border: 2px solid #cccccc; border-collapse: collapse; margin-top: 0px;" class="gradeView">
                                            <tbody>
                                                <tr>
                                                    <td>Applicant ID:</td>
                                                    <th style="border: 1px solid #ddd;"><?php echo $record->applicant_id; ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Applicant Name:</td>
                                                    <th style="border: 1px solid #ddd;"><?php echo $record->applicant_name; ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Date Of Birth:</td>
                                                    <th style="border: 1px solid #ddd;"><?php echo $record->dateOfBirth; ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <th style="border: 1px solid #ddd;"><?php echo $record->gender; ?></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <style type="text/css">
                                            .total_mark tr th,td{border: 1px solid #ddd;text-align: center;}
                                        </style>
                                        <table style="width:100%; float: right; border: 2px solid #cccccc; border-collapse: collapse; margin-top: 5px;" class="gradeView total_mark">
                                            <tbody>
                                                <tr>
                                                    <th colspan="5" style="text-align: center;">Exam Marks (Total- <?php echo $record->total; ?>)</th>
                                                </tr>
                                                <tr>
                                                    <th>Bangla</th>
                                                    <th>English</th>
                                                    <th>Mathmatics</th>
                                                    <th>General Knowledge</th>
                                                    <th style="color: green;">Total Obtained</th>
                                                </tr>
                                                <tr>
                                                    <td><?php echo round($record->bangla_mark); ?></td>
                                                    <td><?php echo round($record->english_mark); ?></td>
                                                    <td><?php echo round($record->math_mark); ?></td>
                                                    <td><?php echo round($record->general_mark); ?></td>
                                                    <td><?php echo round($record->bangla_mark+$record->english_mark+$record->math_mark+$record->general_mark); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td colspan="2">
                                        <table style="width:100%; float: right; border: 2px solid #cccccc;margin-top: -50px; border-collapse: collapse; " class="gradeView">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" style=" border: 1px solid #cccccc; text-align: center">Class Information</th>
                                            </tr>
                                            <tr>
                                                <td>Class:</td>
                                                <td><?php echo isset($record->programId) ? getProgramName($record->programId) : ""; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Medium:</td>
                                                <td><?php echo isset($record->mediumId) ? getmediumName($record->mediumId) : ""; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Group:</td>
                                                <td><?php echo isset($record->groupId) ? getGroupName($record->groupId) : ""; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Shift:</td>
                                                <td><?php echo isset($record->shiftId) ? getshiftName($record->shiftId) : ""; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Session:</td>
                                                <td><?php echo isset($record->sessionId) ? getSessionName($record->sessionId) : ""; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="border: 0px;text-align: left;">Admission Result:&nbsp;<strong><?php
                                            if ($record->status == 1) {
                                                echo '<span style="color:green">Allow</span>';
                                            } elseif ($record->status == 2) {
                                                echo '<span style="color:#e4e413;">Waiting</span>';
                                            } elseif ($record->status == 3) {
                                                echo '<span style="color:red">Not Allow</span>';
                                            } else {
                                                echo '<span style="color:red">No Assing</span>';
                                            }
                                         ?></strong></td>
                                    <td colspan="3" style="border: 0px; text-align: right;padding-right: 35px;""><span><img style="width: 140px;height: 45px;margin-right: 5px;border-bottom: 2px solid #ddd;padding-bottom: 5px;" src="http://localhost/tanay/images/ec.png"></span>Exam Controller</td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                <?php endif; ?>
                
            </section>
        </div>
    </div>
</div>