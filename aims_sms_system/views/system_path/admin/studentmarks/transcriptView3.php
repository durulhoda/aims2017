<style>
    .center_border{
        border: 2px solid #D8D8D8;
        padding: 4px;
        text-align: center;
        vertical-align: middle;
    }
    .red{color: red;font-weight: bold;}
    .black{color: red;font-weight: bold;}
    .color_green{color:green !important;font-weight: bold;}
    .color_blue{color:blue !important;font-weight: bold;}
    .color_red{color:red !important;font-weight: bold;}
    .color_royalblue{color:royalblue !important;font-weight: bold;}
    .green{color:green;font-weight: bold;}
    .gradeView tr td{
        padding: 0px; border: 1px solid #cccccc; text-align: center
    }
    .detailsTable tr th{
        border: 2px solid #cccccc; padding: 4px; text-align: center
    }

</style>

<!--<?php// echo "<pre>"; print_r($records['record']) ;?>-->
<div class="page-header">
    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
        <span class="btn btn-purple no-border">
          <i class="ace-icon fa fa-print bigger-130"></i>
          <span class="bigger-110">Print</span>
        </span>
    </button>
</div><!--page-header-->


<div id="printableArea">
<style tyle="text/css">
    @media print
    {
        .center_border{
            border:2px solid #D8D8D8;
            padding: 2px;
            text-align: center;
            vertical-align: middle;
        }
        .red{color: red;font-weight: bold;}
        .black{color: red;font-weight: bold;}
        .green{color:green;font-weight: bold;}
        .color_green{color:green !important;font-weight: bold;}
        .color_blue{color:blue !important;font-weight: bold;}
        .color_red{color:red !important;font-weight: bold;}
        .color_royalblue{color:royalblue !important;font-weight: bold;}
        .gradeView tr td{
            padding: 0px; border: 2px solid #cccccc; text-align: center
        }
        .detailsTable tr th{
            border: 2px solid #cccccc; padding: 2px; text-align: center
        }
    }
</style>
<div style="margin: 10px auto;width: 850px; border: 3px; solid #cccccc; border:3px solid #d9d9d9; ">
<table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
    <tbody>
    <tr style=" font-family: cambria;">
        <td style="text-align: center;">
            <?php $logo = base_url().$institute_info->logo;?>
                <img src="<?php echo $logo; ?>" style="margin-top:3px;" height="80" />
            <div class="color_royalblue" style="font-size: 35px;">
                <?php echo ($institute_info->institute_name) ? $institute_info->institute_name : "";?>
            </div>
            <div style="line-height: 3px; font-size: 18px; color: #444;">
                <?php echo ($institute_info->address) ? $institute_info->address : ""; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; ">
            <h3 class="color_red" style="font-family: Algerian;">ACADEMIC TRANSCRIPT</h3>
            <strong> <h3 class="color_green" style="font-family: century gothic;"><?php echo getSemesterName($semester_id)."' ".$program_info->session_name; ?></h3><strong>
        </td>
    </tr>
    </tbody>
</table>
<div style="margin-top: 10px;float:left; border:0px solid red; width:160px; margin-left: 9px;">
    <img src="<?php echo ($student_info->photo) ? base_url().$student_info->photo :  base_url().'/uploads/default/default.png' ?>" width="152" height="auto" align="middle">
</div>
<div style="margin: 8px 8px 16px; font-family: cambria; height: 170px; width:98%; border:0px solid red;">
    <table style="margin-left:5px;width:50%; float: left;border:0px solid red; line-height: 22px;">
        <tbody>
        <tr>
            <td style="text-align: left; "> 
                            <span class="color_green" style="font-size: 20px; font-family: Segoe UI Semibold;">
                                    Student ID
                            </span>
            </td>
            <td>
                            <span class="color_green" style="font-size: 20px;font-family: Segoe UI Semibold;">
                                    : <?php echo ($student_info->studentId) ? $student_info->studentId : ""; ?>
                            </span>
            </td>
        </tr>
        <tr style="line-height: 20px;">
            <td style="text-align: left; margin-top: 20px; ">
                <span class="color_blue" style="font-size: 21px; font-family: Segoe UI Semibold;"> Name </span>
            </td>
            <td>
                            <span class="color_blue" style="font-size: 21px; font-family: Segoe UI Semibold;  margin-top: 8px;">
                                : <?php echo ($student_info->firstName) ? $student_info->firstName : ""; ?>
                            </span>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; ">
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold; color:green;">Roll No. </span>
            </td>
            <td>
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;  margin-top: 20px;">
                    : <?php echo $roll_no['roll_no']; ?>
                </span>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; ">
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;">Class </span>
            </td>
            <td>
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;;  margin-top: 20px;">
                    : <?php echo ($program_info->program_name) ? $program_info->program_name : ""; ?>
                </span>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; "><span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;"> Shift </span>
            </td>
            <td>
               <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;  margin-top: 20px;">
                    : <?php echo ($program_info->shift_name) ? $program_info->shift_name : ""; ?>
               </span>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; ">
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;"> Group </span>
            </td>
            <td>
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;  margin-top: 20px;">
                    : <?php echo ($program_info->group_name) ? $program_info->group_name : ""; ?>
                </span>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; ">
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;">Section </span>
            </td>
            <td>
                <span class="color_green" style="font-size: 18px; font-family: Segoe UI Semibold;  margin-top: 20px;">
                    : <?php echo ($program_info->section_name) ? $program_info->section_name : ""; ?>
                </span>
            </td>
        </tr>

        </tbody>
    </table>
    <table style="width:28%; float: right; border: 3px solid #cccccc; margin-right: 8px; border-collapse: collapse; " class="gradeView">
        <tbody>
        <tr>
            <td style=" border: 1px solid #cccccc; text-align: center">Grade Letter</td>
            <td style=" border: 1px solid #cccccc; text-align: center">Exam Marks</td>
            <td style=" border: 1px solid #cccccc; text-align: center">Grade Point</td>
        </tr>
        <tr><td>A+</td><td>80-100</td><td>5</td></tr>
        <tr><td>A</td><td>70-79</td><td>4</td></tr>
        <tr><td>A-</td><td>60-69</td><td>3.50</td></tr>
        <tr><td>B</td><td>50-59</td><td>3</td></tr>
        <tr><td>C</td><td>40-49</td><td>2</td></tr>
        <tr><td>D</td><td>33-39 </td><td>1</td></tr>
        <tr><td>F</td><td>0-32</td><td>0</td></tr>
        </tbody>
    </table>
</div>

<?php
//echo '<pre>';
//print_r($records);
?>


<!--        <hr>-->
<table class="detailsTable" style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;" id="tblprint">
    <thead>
    <tr style="background-color: lightgrey !important;">
        <th>Sl No.</th>
        <th>Subject Name</th>
        <th>Code</th>
        <th>Full Marks</th>
        <th>Marks Obtained</th>
        <th>Mark</th>
        <th>L.G.</th>
        <th>GP</th>
    </tr>
    </thead>
    <?php if ($records['record']) :

    //            echo '<pre>';
    //            print_r($records['record']);

    ?>


    <tbody>
    <?php
    $merge = [];
    $m_count = [];
    $i = 1;
    foreach ($records['record'] as $key => $val) :
        if ($val['course_status'] == 1 || $val['course_status'] == 3) :
            $color = ($val['gpa_point'] == 0) ? "red" : "green";
            if ($val['merge_id']) {
                $merge[$val['merge_id']] = isset($merge[$val['merge_id']]) ? 1 : 2;
            }
//                            echo $i;
//                            echo '<pre>';
//                            print_r($merge);
            // if ($key == 3) {
//                          print_r($merge[$val['merge_id']]);
            // }
            ?>
            <tr style="border: 1px solid #D8D8D8; ">
            <td style="text-align: center" class="center_border"><?php echo $i++; ?></td>
            <?php if ($val['merge_id']) : ?>
            <?php if ($merge[$val['merge_id']] == 2): ?>
                <td style="text-align: left" rowspan="<?php echo $val['merge_count']; ?>" class="center_border"><?php echo $val['merge_course_name']; ?></td>
            <?php endif; ?>
        <?php else : ?>
            <td style="text-align: left" rowspan="1" class="center_border"><?php echo $val['course_name'] ; ?></td>
        <?php endif; ?>
            <td class="center_border"><?php echo $val['course_code']; ?></td>
            <td class="center_border"><?php echo round($val['full_mark']); ?></td>
            <td style="text-align: left" class="center_border"><?php echo $val['cal_mark']; ?></td>
            <td class="center_border <?php echo $color; ?>"><?php echo round($val['total_mark']); ?></td>
            <?php if ($val['merge_id']) : ?>
            <?php if ($merge[$val['merge_id']] == 2): ?>
                <td rowspan="<?php echo $val['merge_count']; ?>" class="center_border"><?php echo $val['gpa_letter'];?></td>
                <td rowspan="<?php echo $val['merge_count']; ?>" class="center_border"><?php echo $val['gpa_point'];?></td>
            <?php endif; ?>
        <?php else : ?>
            <td rowspan="1" class="center_border"><?php echo $val['gpa_letter'];?></td>
            <td rowspan="1" class="center_border"><?php echo $val['gpa_point'];?></td>
            </tr>
        <?php endif; ?>
        <?php endif; endforeach; ?>

    <?php
    foreach ($records['record'] as $key => $val) :
        if ($val['course_status'] == 2) :
            $color = ($val['gpa_point'] == 0) ? "red" : "green";
            ?>
            <tr>
                <td colspan="8" style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">Additional Subject:</td>
            </tr>
            <tr style="border: 1px solid #D8D8D8; ">
                <td style="text-align: center" class="center_border"><?php echo $i; ?></td>
                <td style="text-align: left" rowspan="1" class="center_border"><?php echo $val['course_name'] ; ?></td>
                <td class="center_border"><?php echo $val['course_code']; ?></td>
                <td class="center_border"><?php echo round($val['full_mark']); ?></td>
                <td style="text-align: left" class="center_border"><?php echo $val['cal_mark']; ?></td>
                <td class="center_border <?php echo $color; ?>"><?php echo round($val['total_mark']); ?></td>
                <td rowspan="1" class="center_border"><?php echo $val['gpa_letter'];?></td>
                <td rowspan="1" class="center_border"><?php echo $val['gpa_point'];?></td>
            </tr>
        <?php endif; endforeach; ?>

    <?php
    $ex_sub = [];
    $i;
    foreach ($records['record'] as $key => $val) :
        if ($val['course_status'] == 4) :
            $color = ($val['gpa_point'] == 0) ? "red" : "green";
            $ex_sub[0] = isset($ex_sub[0]) ? 1 : 2;
            $i++;
            ?>
            <?php if ($ex_sub[0] == 2) : ?>
            <tr>
                <td colspan="8" style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">Continuous Assessment:</td>
            </tr>
        <?php $i--;endif; ?>
            <tr style="border: 1px solid #D8D8D8; ">
                <td style="text-align: center" class="center_border"><?php echo $i; ?></td>
                <td style="text-align: left" rowspan="1" class="center_border"><?php echo $val['course_name'] ; ?></td>
                <td class="center_border"><?php echo $val['course_code']; ?></td>
                <td class="center_border"><?php echo round($val['full_mark']); ?></td>
                <td style="text-align: left" class="center_border"><?php echo $val['cal_mark']; ?></td>
                <td class="center_border <?php echo $color; ?>"><?php echo round($val['total_mark']); ?></td>
                <td rowspan="1" class="center_border"><?php echo $val['gpa_letter'];?></td>
                <td rowspan="1" class="center_border"><?php echo $val['gpa_point'];?></td>
            </tr>
        <?php endif; endforeach; ?>

    </tbody>
</table>


<div style="">
<table class="table table-bordered" style=" font-family: cambria; margin: 10px 10px; width: 60%; border-collapse: collapse;float: left;" id="">
    <thead>
    <tr style="background-color: lightgrey !important;">
        <th>Description</th>
        <th>Total Marks</th>
        <th>Total Obtained Marks</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Common Marks</td>
            <td><b><?php echo $records['total']['total_marks_common_full']; ?></b></td>
            <td><b><?php echo $records['total']['total_marks_common_final']; ?></b></td>
        </tr>
        <tr>
            <td>Grand Total Marks (Com+Add+Con)</td>
            <td><b><?php echo $records['total']['grand_total_marks_full']; ?></b></td>
            <td><b><?php echo $records['total']['grand_total_marks']; ?></b></td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered" style="margin-right:16px; font-family: cambria; width: 25%; border-collapse: collapse;float:right;" id="">
    <tbody>
    <trstyle="background-color: lightgrey !important;">
        <td style="text-align: left; ">
                <span class="color_green" style="font-size: 16px; font-family: Segoe UI Semibold;">GPA</td>
        <td style="text-align: left; ">
                <span class="color_green" style="font-size: 16px; font-family: Segoe UI Semibold;"><?php echo $records['total']['gpa_point']; ?></td>
    </tr>
    <tr>
        <td style="text-align: left; ">
                <span class="color_green" style="font-size: 16px; font-family: Segoe UI Semibold;">Letter Grade</td>
        <td style="text-align: left; ">
                <span class="color_green" style="font-size: 16px; font-family: Segoe UI Semibold;"><?php echo $records['total']['gpa_letter']; ?></td>
    </tr>
    <tr>
        <td style="text-align: left; ">
                <span class="color_green" style="font-size: 14px; font-family: Segoe UI Semibold;">Percentage Marks</td>
        <td style="text-align: left; ">
                <span class="color_green" style="font-size: 14px; font-family: Segoe UI Semibold;"><?php echo round(($records['total']['total_marks_common_final'] * 100)/$records['total']['total_marks_common_full'])."%"; ?></td>
    </tr>
    <tr>
        <td style="text-align: left; ">
                <span class="color_green" style="font-size: 14px; font-family: Segoe UI Semibold;">Failed Subject</td>
        <td style="text-align: left; ">
                <span class="color_red" style="font-size: 14px; font-family: Segoe UI Semibold;"><?php echo $records['total']['tot_fail_subj']; ?></td>
    </tr>
    </tbody>
</table>
</div>
<table style=" font-family: cambria;margin: 10px 10px; border-collapse: collapse;">
    <tr>
        <td colspan="6" style="padding:10px 10px 5px;text-align: right; font-size: 14px; font-weight: bold;"><span class="color_green" style="">Student Position</span> : <?php echo $records['total']['position']; ?></td>
        <td colspan="6" style="padding:10px 10px 5px;text-align: left; font-size: 14px; font-weight: bold;"></td>
<!--        <td colspan="6" style="padding:10px 10px 5px;text-align: left; font-size: 14px; font-weight: bold;"> Highest Obtain Marks :  --><?php //echo round($records['highest']['total_obtain_marks']); ?><!-- </td>-->
    </tr>
</table>



<table style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;">
    <?php if ($records['total']) : ?>
        <tbody>
        <tr>
            <td colspan="12"  class="color_blue" style="padding:5px 0px 5px;text-align: left; font-size: 18px; font-family: Vivaldi;">
                <!--                    <hr>-->
                &nbsp;&nbsp;Remarks: <?php echo $records['total']['result_comment']; ?>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding:10px 0px 10px 10px;text-align: left; font-size: 12px; font-weight: bold;"><img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/ct.png"; ?>"> <br>.............................................<br>Class Teacher </td>
           <!-- <td colspan="4" style="padding:10px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;"><img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/ec.png"; ?>"><br> <span style="margin-right:8px;">.............................................</span><br> <span style="margin-right:22px;">Exam Controller</span> </td>-->
            <td colspan="4" style="padding:10px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;"><img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/au.png"; ?>"> <br>.............................................<br> Authorized Signature </td>
        </tr>
        </tbody>
    <?php endif; endif; ?>
    <?php
    //echo '<pre>';
    //print_r($records['total']);
    ?>
</table>
<h6 style="font-family:Segoe UI Semibold; text-align:center;"> Result generated by:&nbsp;&nbsp;<style= class="color_red" style=" font-family: century gothic;"> aims &nbsp;<style= class="color_blue" style=" font-family: century gothic;">||&nbsp;<style= class="color_green" style= "font-family:Segoe UI Semibold;"> Powerd by:&nbsp;&nbsp;<style=  class="color_green" style=  " font-family: Segoe UI Semibold;">www.adventure-soft.com<style=" font-family: Segoe UI Semibold;"></h6>
</div>
<!--<h6 style="font-family:Segoe UI Semibold; text-align:center;"> Result generated by:<style= class="color_green" style=" font-family: century gothic;"> aims <style=" font-family: Segoe UI Semibold;"> - <img style="display: inline-block; position:relative;top: 2px;" src="<?php echo base_url(); ?>demo_1/img/finallogo.jpg">(01612302124) (www.adventure-soft.com) <style=" font-family: Segoe UI Semibold;"></h6>
</div>-->
</div>