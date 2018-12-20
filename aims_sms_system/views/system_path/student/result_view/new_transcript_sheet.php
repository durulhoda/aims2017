<?php
?>
<style>
    .center_border{
        border: 1px solid #D8D8D8;
        padding: 4px;
        text-align: center;
    }
    .gradeView tr td{
        padding: 0px; border: 1px solid #cccccc; text-align: center
    }
    .detailsTable tr th{
        border: 1px solid #cccccc; padding: 4px; text-align: center
    }
</style>
<div class="page-header">

    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
    <span class="btn btn-purple no-border">
      <i class="ace-icon fa fa-print bigger-130"></i>
      <span class="bigger-110">Print Transcript</span>
    </span>
    </button>
</div><!-- /.page-header -->
<div id="printableArea" >
    <div style="margin: 10px auto;  width: 850px; border: 0px solid #cccccc; " >
        <div style=" border: 1px solid #d9d9d9;">
            <div >
                <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                    <tr style=" font-family: cambria;">
                        <td style="text-align: center;">
                            <p style="margin-left:5px;">
                                <?php
                                $ins_info = getInstituteInfo();
                                ?>
                                <img style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">
                                <br>
                            <div style="font-size: 20px; font-size: 35px; color: royalblue;">
                                <?php
                                $ins_name=getInstituteInfo();
                                echo $ins_name['instituteName'] ;
                                ?>
                            </div>
                            <div style="line-height: 3px; font-size: 18px; color: #444;">
                                <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?>
                            </div>
                            </p>
                        </td>
                    </tr>
                    <tr> <td style="text-align: center; "> <h3 style="font-family: Algerian;">ACADEMIC TRANSCRIPT</h3> </td> </tr>
                </table>
                <div style='margin-top: 10px;float:left; border:0px solid red; width:160px; margin-left: 9px;'>
                    <?php
                    if ($studentlist['photo']) {
                        ?>
                        <img  src="<?php if (file_exists($studentlist['photo'])) { echo base_url() . $studentlist['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="152" height="auto" align="middle">
                        <?php
                    }
                    ?>
                </div>
                <div style='margin: 10px 10px 20px; font-family: cambria; height: 170px; width:98%; border:0px solid red;'>
                    <table style="width:50%; float: left;border:0px solid red; line-height: 13px;">
                        <tr>
                            <td style="text-align: left; ">    <span style="font-size: 14px;"><strong>  Student ID <strong> </span>
                            </td>
                            <td>
              <span style="font-size: 14px;">
                <strong>  : </strong><strong><?php echo ($studentlist['studentId']); ?> </strong>
              </span>
                            </td>
                        </tr>
                        <tr style="line-height: 30px;">
                            <td style="text-align: left; margin-top: 2px; ">
                                <span style="font-size: 14px;"><strong> Name </strong> </span>
                            </td>
                            <td>
              <span style="font-size: 14px;  margin-top: 2px;">
                <strong>  : </strong> <strong><?php if(!empty($studentlist['firstName'])){ echo $studentlist['firstName'];} ?> </strong>
              </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 14px;">Class </span>
                            </td>
                            <td>
                                <?php if(!empty($programinfo['programId'])){ ?>
                                    <p>
                                        <strong>  : </strong>  <?php echo getProgramName($programinfo['programId']);  ?>
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 14px;"> Group </span></td>
                            <td>
                                <?php if (!empty($programinfo['groupId'])) { ?>
                                    <p>
                                        <strong>  : </strong>  <?php echo getGroupName($programinfo['groupId']); ?>
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 14px;"> Shift </span>
                            </td>
                            <td>
                                <?php if (!empty($programinfo['shiftId'])) { ?>
                                    <p>
                                        <strong>  : </strong> <?php echo getshiftName($programinfo['shiftId']); ?>
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 14px;">Section </span>
                            </td>
                            <td>
                                <?php if (!empty($programinfo['sectionId'])) { ?>
                                    <p>
                                        <strong>  : </strong> <?php echo getsectionName($programinfo['sectionId']); ?>
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 14px;">Exam Name </span>
                            </td>
                            <td>
                                <?php if (!empty($semesterId)) { ?>
                                    <p>
                                        <strong>  : </strong>   <?php echo getSemesterName($semesterId); ?>
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 14px;"> Session </span>
                            </td>
                            <td>
                                <?php if (!empty($programinfo['sessionId'])) { ?>
                                    <p>
                                        <strong>  : </strong> <?php echo getSessionName($programinfo['sessionId']); ?>
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <table style="width:28%; float: right; border: 2px solid #cccccc; margin-right: 8px; border-collapse: collapse; " class="gradeView">
                        <tr >
                            <td style=" border: 1px solid #cccccc; text-align: center">Grade Letter</td>
                            <td style=" border: 1px solid #cccccc; text-align: center">Exam Marks</td>
                            <td style=" border: 1px solid #cccccc; text-align: center">Grade Point</td>
                        </tr>
                        <tr><td>A+</td><td>80-100</td><td>5.00</td></tr>
                        <tr><td>A</td><td>70-79</td><td>4.00</td></tr>
                        <tr><td>A-</td><td>60-69</td><td>3.50</td></tr>
                        <tr><td>B</td><td>50-59</td><td>3.00</td></tr>
                        <tr><td>C</td><td>40-49</td><td>2.00</td></tr>
                        <tr><td>D</td><td>33-39 </td><td >1.00</td></tr>
                        <tr><td>F</td><td>0-32</td><td>0.00</td></tr>
                    </table>
                </div>
                <hr>
                <table class="detailsTable" style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;">
                    <tr>
                        <th>Sl No.</th>
                        <th>Subject</th>
                        <th>Code</th>
                        <th>Full Mark</th>
                        <th>Ob Marks</th>
                        <th>Total Mark</th>
                        <th>GP</th>
                        <th>L.G.</th>
                    </tr>

                    <?php
                    $count=0;
                    foreach($markslist as $key=>$mark)
                    {
                        foreach ($mark as $index=>$mk)
                        {
                    ?>
                            <?php if($index==0){?>
                            <tr>
                                <td colspan="8"
                                    style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">
                                    <?php if($subject_category[$key]){echo $subject_category[$key];}else{echo 'Unknown';}?>
                                </td>
                            </tr>
                            <?php }?>

                            <tr style="border: 1px solid #D8D8D8; ">
                                <td style="text-align:left" class="center_border"><?php echo ++$count;?></td>
                                <td style="text-align: left" class="center_border"><?php echo $mk['course_name'];?></td>
                                <td style="text-align: center" class="center_border"><?php echo $mk['course_code'];?></td>
                                <td style="text-align: center" class="center_border"><?php echo round($mk['full_mark']);?></td>
                                <td style="text-align: center" class="center_border"><?php echo $mk['cal_mark'];?></td>
                                <td style="text-align: center" class="center_border"><?php echo round($mk['total_mark']);?></td>
                                <td style="text-align: center" class="center_border"><?php echo $mk['gpa_point'];?></td>
                                <td style="text-align: center" class="center_border"><?php echo $mk['gpa_letter'];?></td>
                            </tr>

                    <?php
                        }
                    }
                    ?>

                    <tr>
                        <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                            Total Marks :
                        </td>
                        <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                            Obtain Marks :
                        </td>
                        <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                            GPA :
                        </td>
                        <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                            Letter Grade :
                        </td>
                    </tr>
                    <tr>

                        <td colspan="8" style="padding:10px 0px 5px;text-align: center; font-size: 20px; font-weight: bold;">
                            <hr>
                            Result Comments :
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding:10px 0px 10px 10px;text-align: left; font-size: 12px; font-weight: bold;"> .............................................<br>Class Teacher </td>
                        <td colspan="4" style="padding:10px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;">.............................................<br> Exam Controller </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Right Side/Main Content End -->