<div class="row">

    <?php
    if (!empty($applicantlist)) {
    ?>

    <div class="page-header">

        <a href="<?php echo base_url('systemaccess/applicant/searchapplicant'); ?>" class="btn btn-grey">

            <i class="ace-icon fa fa-arrow-left"></i>

            Go Back

        </a>

        <button class="btn btn-success " onclick="printDiv('printableArea')">

            Print

            <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>

        </button>

    </div>

    <!-- 1st view of printable area -->
    <div>
        <!-- div.dataTables_borderWrap -->
        <div style="margin: 10px auto;  width: 900px; border: 0px solid #cccccc; " >
            <div style=" border: 4px solid #d9d9d9;">
                <div>
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
                                    $ins_name = getInstituteInfo();
                                    echo $ins_name['instituteName'];
                                    ?>
                                </div>
                                <div style="line-height: 3px; font-size: 18px; color: #444;">
                                    <?php echo $ins_info['town'].", ".$ins_info['city'].", ".$ins_info['district_name'];?>
                                </div>
                                <div class="center">
                                    <h2>Applicant List</h2>
                                </div>
                                </p>

                            </td>

                        </tr>
                        <tr> <td style="text-align: center; "> <h3><small class="pull-right">

                                        Date: <?php echo date("m/d/Y"); ?>

                                    </small></h3> </td>
                        </tr>


                    </table>
                    <div class="col-xs-12 col-sm-0 col-sm-offset-3">

                    </div>
                    <center>
                        <div>

                            <i class="ace-icon fa fa-caret-right blue"></i>Class Level:

                            <?php
                            foreach (getProgramLevel() as $key => $value) {

                                if ($programLevel == $key) {

                                    echo "<b>" . $value . "</b>";
                                }
                            }
                            ?>&nbsp;


                            <i class="ace-icon fa fa-caret-right blue"></i>Class:

                            <?php
                            echo "<b>" . getProgramName($programId) . "</b>";
                            ?>&nbsp;

                            <i class="ace-icon fa fa-caret-right blue"></i>Medium:

                            <?php
                            echo "<b>" . getmediumName($mediumId) . "</b>";
                            ?>&nbsp;


                            <i class="ace-icon fa fa-caret-right blue"></i>Group:

                            <?php
                            echo "<b>" . getGroupName($groupId) . "</b>";
                            ?>&nbsp;


                            <i class="ace-icon fa fa-caret-right blue"></i>Shift:

                            <?php
                            echo "<b>" . getshiftName($shiftId) . "</b>";
                            ?>&nbsp;

                            <i class="ace-icon fa fa-caret-right blue"></i>Session:

                            <?php
                            echo "<b>" . getSessionName($sessionId) . "</b>";
                            ?>

                            </li>



                            </ul>

                        </div>

                </div>
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            Sl No.
                        </th>

                        <th>Applicant ID</th>
                        <th>Applicant Name</th>
                        <th>Gender</th>
                        <th>Father Info</th>
                        <th>Mother Info</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $sl = 1;
                    foreach ($applicantlist as $value) {
                        ?>



                        <tr>
                            <td class="center" >
                                <?php echo $sl++; ?>
                            </td>


                            <td>

                                <a href="#">

                                    <?php
                                    if (!empty($value['applicationId'])) {

                                        echo $value['applicationId'];
                                    }
                                    ?>



                                </a>

                            </td>



                            <td><?php
                                if (!empty($value['firstName'])) {
                                    echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'];
                                }
                                ?></td>

                            <td><?php
                                if (!empty($value['gender'])) {
                                    echo element($value['gender'], getGendar(), Null);
                                }
                                ?></td>



                            <td class="hidden-480">
                                <?php echo $value['fatherName'] . "<br><span class=\"label label-sm label-warning\">" . $value['fatherPhone'] . "</span>"; ?>

                            </td>

                            <td class="hidden-480">
                                <?php echo $value['motherName'] . "<br><span class=\"label label-sm label-warning\">" . $value['motherPhone'] . "</span>"; ?>

                            </td>

                            <td class="hidden-480">

                                <?php
                                if ($value['photo']) {
                                    ?>

                                    <img  src="<?php
                                    if (file_exists($value['photo'])) {
                                        echo base_url() . $value['photo'];
                                    } else {
                                        echo base_url() . "uploads/default/default.png";
                                    }
                                    ?>" width="60" height="60">

                                    <?php
                                }
                                ?>

                            </td>





                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!---2nd view of Printable Area Start from Here----->

<div id="printableArea" hidden="">
    <!-- div.dataTables_borderWrap -->
    <div class="row">
        <div class="col-sm-12">

            <div class="center">
                <?php
                $ins_info = getInstituteInfo();
                ?>
                <img style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">
                <h3>
                    <p class="user"> &nbsp; <?php
                        $ins_name = getInstituteInfo();
                        echo $ins_name['instituteName'];
                        ?></p>
                </h3>
                <div class="time">
                    &nbsp;
                    <span class="editable" id="country"> <?php echo $ins_info['town'].", ".$ins_info['city'].", ".$ins_info['district_name'];?></span><br>
                    <h4> Applicant List </h4>
                </div>
            </div>
            <div style="text-align: right" class="col-sm-12">Date: <?php echo date("m/d/Y"); ?></div>


            <center>
                <div id="id-message-infobar" style="font-size: 12px;">
                        <span class="blue bigger-130">
                        <i class="ace-icon fa fa-caret-right blue"></i>Session : <?php
                            if (!empty($sessionId)) {
                                echo "<b>" . getSessionName($sessionId) . "</b>";
                            }
                            ?>&nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i>Class Level:

                            <?php
                            foreach (getProgramLevel() as $key => $value) {

                                if ($programLevel == $key) {

                                    echo "<b>" . $value . "</b>";
                                }
                            }
                            ?>
                            <i class="ace-icon fa fa-caret-right blue"></i>Class : <?php
                            if (!empty($programId)) {
                                echo "<b>" . getProgramName($programId) . "</b>";
                            }
                            ?>
                            <i class="ace-icon fa fa-caret-right blue"></i>Medium : <?php
                            if (!empty($mediumId)) {
                                echo "<b>" . getmediumName($mediumId) . "</b>";
                            }
                            ?> &nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i>Group : <?php
                            if (!empty($groupId)) {
                                echo "<b>" . getGroupName($groupId) . "</b>";
                            }
                            ?> &nbsp;
                        <i class="ace-icon fa fa-caret-right blue"></i>Shift : <?php
                            if (!empty($shiftId)) {
                                echo "<b>" . getshiftName($shiftId) . "</b>";
                            }
                            ?>&nbsp;
                        </span>
                </div>
            </center>

        </div>
        <!-- /.col -->
    </div>
    <table id="simple-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                Sl No.
            </th>

            <th>Applicant ID</th>
            <th>Applicant Name</th>
            <th>Gender</th>
            <th>Father Info</th>
            <th>Mother Info</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $sl = 1;
        foreach ($applicantlist as $value) {
            ?>



            <tr>
                <td class="center" >
                    <?php echo $sl++; ?>
                </td>


                <td>

                    <a href="#">

                        <?php
                        if (!empty($value['applicationId'])) {

                            echo $value['applicationId'];
                        }
                        ?>



                    </a>

                </td>



                <td><?php
                    if (!empty($value['firstName'])) {
                        echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'];
                    }
                    ?></td>

                <td><?php
                    if (!empty($value['gender'])) {
                        echo element($value['gender'], getGendar(), Null);
                    }
                    ?></td>



                <td class="hidden-480">
                    <?php echo $value['fatherName'] . "<br>" . $value['fatherPhone']; ?>

                </td>

                <td class="hidden-480">
                    <?php echo $value['motherName'] . "<br>" . $value['motherPhone']; ?>

                </td>

                <td class="hidden-480">

                    <?php
                    if ($value['photo']) {
                        ?>

                        <img  src="<?php
                        if (file_exists($value['photo'])) {
                            echo base_url() . $value['photo'];
                        } else {
                            echo base_url() . "uploads/default/default.png";
                        }
                        ?>" width="60" height="60">

                        <?php
                    }
                    ?>

                </td>





            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<?php
}
?>

</div> <!-- /.row --> 