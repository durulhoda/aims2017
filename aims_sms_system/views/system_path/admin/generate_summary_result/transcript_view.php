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

<!-- table here -->

    <table class="detailsTable" style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;" id="tblprint">
        <thead>
            <tr style="background-color: lightgrey !important;">
                <th>Sl No.</th>
                <th colspan="2">Subject Name</th>
                <th>Code</th>
                <th>Full Marks</th>
                <?php
                    foreach($percentages as $semester_id=>$value)
                    {
                ?>
                        <th><?php echo $value['semester'].' - '.$value['percentage_value'].'%';?></th>
                <?php
                    }
                ?>

                <th>Marks Obtained</th>
            </tr>
        </thead>
        <tbody>

        //for single subject
        <tr style="border: 1px solid #D8D8D8; ">
            <td style="text-align: center" class="center_border">3</td>
            <td colspan="2" style="text-align: center" class="center_border">Math</td>
            <td style="text-align: center" class="center_border">105</td>
            <td style="text-align: center" class="center_border">100</td>
            <td style="text-align: center" class="center_border">25</td>
            <td style="text-align: center" class="center_border">63</td>
            <td style="text-align: center" class="center_border">88</td>
        </tr>
        //for single subject

        <?php
        foreach($student_marks as $course)
        {?>

            <tr style="border: 1px solid #D8D8D8; ">
                <td style="text-align: center" class="center_border">3</td>
                <td colspan="2" style="text-align: center" class="center_border">Math</td>
                <td style="text-align: center" class="center_border">105</td>
                <td style="text-align: center" class="center_border">100</td>
                <td style="text-align: center" class="center_border">25</td>
                <td style="text-align: center" class="center_border">63</td>
                <td style="text-align: center" class="center_border">88</td>
            </tr>

        <?php}
        ?>




        //for merging subject
            <tr style="border: 1px solid #D8D8D8; ">
                <td rowspan="2" style="text-align: center" class="center_border">1</td>  //rowspan=mergecount
                <td rowspan="2" style="text-align: center" class="center_border">Bangla</td> //rowspan=mergecount
                <td style="text-align: center" class="center_border">Bangla 1st Paper</td>
                <td style="text-align: center" class="center_border">101</td>
                <td style="text-align: center" class="center_border">100</td>
                <td style="text-align: center" class="center_border">20</td>
                <td style="text-align: center" class="center_border">50</td>
                <td rowspan="2" style="text-align: center" class="center_border">69</td> //rowspan=mergecount
            </tr>
            <tr style="border: 1px solid #D8D8D8; ">
                <td style="text-align: center" class="center_border">Bangla 2nd Paper</td>
                <td style="text-align: center" class="center_border">102</td>
                <td style="text-align: center" class="center_border">100</td>
                <td style="text-align: center" class="center_border">23</td>
                <td style="text-align: center" class="center_border">45</td>
            </tr>
        //for merging subject



        </tbody>
    </table>


<!-- table here -->


<div class="row">
    <div class="col-md-7">
        <table class="table table-bordered" style=" font-family: cambria;border-collapse: collapse;margin-left:1px;" id="">
            <thead>
            <tr style="background-color: lightgrey !important;">
                <th>Description</th>
                <th>Total Marks</th>
                <th>Total Obtained Marks</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>All Subjects</td>
                <td><b><?php echo $master['total_marks']; ?></b></td>
                <td><b><?php echo $master['obtained_marks']; ?></b></td>
            </tr>
            <tr>
                <td colspan="3">Semester Included : <b><?php echo $master['number_of_semester']; ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-4">
        <table class="table table-bordered" style="font-family: cambria;border-collapse: collapse;float:right;" id="">
            <tbody>
            <tr>
                <td colspan="6" style="padding:10px 10px 5px;text-align: left; font-size: 14px; font-weight: bold;"><span class="color_green" style="">Student Position</span> : <?php echo $master['position']; ?></td>
            </tr>
            <tr>
                <td colspan="6" style="padding:10px 10px 5px;text-align: left; font-size: 14px; font-weight: bold;"><span class="color_green" style="">Status</span> : <?php echo $master['result_status']; ?></td>
            </tr>
            <tr>
                <td colspan="6" style="padding:10px 10px 5px;text-align: left; font-size: 14px; font-weight: bold;"><span class="color_green" style="">Failed Subject</span> : <?php echo $master['number_of_failed_subject']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>



<table style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;">
    <?php if ($master) : ?>
        <tbody>
        <tr>
            <td colspan="4" style="padding:10px 0px 10px 10px;text-align: left; font-size: 12px; font-weight: bold;"><img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/ct.png"; ?>"> <br>.............................................<br>Class Teacher </td>
            <td colspan="4" style="padding:10px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;"><img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/au.png"; ?>"> <br>.............................................<br> Authorized Signature </td>
        </tr>
        </tbody>
    <?php endif;  ?>
    <?php
    ?>
</table>
<h6 style="font-family:Segoe UI Semibold; text-align:center;"> Result generated by:&nbsp;&nbsp;<style= class="color_red" style=" font-family: century gothic;"> aims &nbsp;<style= class="color_blue" style=" font-family: century gothic;">||&nbsp;<style= class="color_green" style= "font-family:Segoe UI Semibold;"> Powerd by:&nbsp;&nbsp;<style=  class="color_green" style=  " font-family: Segoe UI Semibold;">www.adventure-soft.com<style=" font-family: Segoe UI Semibold;"></h6>
</div>
</div>