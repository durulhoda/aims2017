 <!-- ASIDE NAV AND CONTENT -->
    <div class="line">
        <div class="box margin-bottom">
            <div class="margin">


                <!-- CONTENT -->
                <article class="s-12 m-7 l-11">
                    <h3 class="titlehd">
                          Exam Routine of <strong><?php echo getProgramName($programinfo['programId']);   ?></strong>

                    </h3>

                    <!-- CONTENT -->
                    <section class="s-12 m-7 l-12">



                        <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                        <!-- Table goes in the document BODY -->
                    <?php
                       if (!empty($examroutine)) {

                    ?>
<!--                        <div class="row">-->
<!---->
<!--                            <div class="col-xs-11">-->
                        <button style="margin-top: 2px;" aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail border: 2px;">
                            <span class="btn btn-purple border: 2px;">
                                <i class="ace-icon fa fa-print bigger-130"></i>
                                <span class="bigger-110">Print</span>
                            </span>
                        </button>

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
                            <div>
                                <!-- div.dataTables_borderWrap -->
                                <div style="margin: 2px auto;  width: 900px; border:2px solid #D8D8D8; border: 3px solid #cccccc; " >
                                    <div style=" border: 3px solid #d9d9d9;">
                                        <div>
                                            <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 2px">
                                                <tr style=" font-family: cambria;">
                                                    <td style="text-align: center;">
                                                        <p style="margin-left:2px;">
                                                            <?php
                                                            $ins_info = getInstituteInfo();
                                                            ?>

                                                            <img class="nav-user-photo" style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="30">
                                                            <br>
                                                        <div style="font-size: 20px; font-size: 35px; color: royalblue;">
                                                            <?php
                                                            $ins_name = getInstituteInfo();
                                                            echo $ins_name['instituteName'];
                                                            ?>
                                                        </div>
                                                        <div style="line-height: 3px; font-size: 18px; color: #444;padding:10px;">
                                                            <?php echo $ins_info['town'] . ", " . $ins_info['city'] . ", " . $ins_info['district_name']; ?>
                                                        </div>

                                                        <h4 style="color:red;" align="center" class="text-success">Exam Routine for <?php echo getSemesterNameById($examroutine[0]['semester_id']);?></h4>
                                                        

                                                            <h5 class="green"><i class="ace-icon fa fa-caret-right blue"><strong></i>Class: <?php echo getProgramName($programinfo['programId']) . "</b>";
                                                                ?>
                                                                &nbsp;&nbsp;


                                                                <i class="ace-icon fa fa-caret-right blue"></i>Medium: <?php echo getmediumName($programinfo['mediumId']) . "</b>";
                                                                ?>
                                                                &nbsp;&nbsp;

                                                                <i class="ace-icon fa fa-caret-right blue"></i>Shift: <?php echo getshiftName($programinfo['shiftId']) . "</b>";
                                                                ?>
                                                                &nbsp;&nbsp;


                                                                <i class="ace-icon fa fa-caret-right blue"></i>Group: <?php echo getGroupName($programinfo['groupId']) . "</b>";
                                                                ?>
                                                                &nbsp;&nbsp;

                                                                <i class="ace-icon fa fa-caret-right blue"></i>Section: <?php echo getsectionName($programinfo['sectionId']) . "</b>";
                                                                ?>
                                                                &nbsp;&nbsp;


                                                                <i class="ace-icon fa fa-caret-right blue"></i>Session: <?php echo getSessionName($programinfo['sessionId']) . "</b>";
                                                            ?></strong></h5>




                                                        <table class="detailsTable" style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;" id="tblprint">
    														<thead>
    														<tr style="background-color: lightgrey !important;">
                                                                <th>Sl No.</th>
                                                                <th>Date</th>
                                                                <th>Day</th>
                                                                <th>Subject</th>
                                                                <th>Room</th>
                                                                <th>Time Slot</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php
                                                            $sl = 1;
                                                            foreach ($examroutine as $value) {
                                                                ?>
                                                                <tr>
                                                                    <td style="text-align: center" rowspan="1" class="center_border"> <?php echo $sl++; ?></td>
                                                                    <td style="text-align: left" rowspan="1" class="center_border"><?php if (!empty($value['date'])) { echo $value['date'];
                                                                        }
                                                                        ?> </td>
                                                                    <td style="text-align: left" rowspan="1" class="center_border"><?php
                                                                        $timestamp = strtotime($value['date']);
                                                                        $day = date('l', $timestamp);

                                                                        echo $day;
                                                                        ?>
                                                                    </td>
                                                                    <td style="text-align: left" rowspan="1" class="center_border"><?php
                                                                        if(!empty($value['courseId'])){  echo getCourseName($value['courseId']);   }
                                                                        ?> </td>
                                                                    <td style="text-align: left" rowspan="1" class="center_border"><?php
                                                                        if(!empty($value['room'])){  echo $value['room'];   }
                                                                        ?>
                                                                    </td>
                                                                    <td style="text-align: left" rowspan="1" class="center_border"><?php
                                                                        if(!empty($value['examtime'])){  echo $value['examtime'];   }
                                                                        ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                        </div>
                                    </div><!-- /.span -->
                                </div><!-- /.row -->
                                <?php
                                }
                                ?>
                            </div><!-- /.col-x12 -->
                        </div>
                            </div>
                        </div>