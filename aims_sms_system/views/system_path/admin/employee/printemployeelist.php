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

                Print A Copy

                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>

            </button>           

        </div>

        <div class="col-xs-12 col-sm-12" id="printableArea">

            <div class="row">



                <div class="col-sm-8 col-sm-offset-2">

                    <div class="row">

                        <div class="table-header center arrowed-in arrowed-right">



    <?php
    $ins_name = getInstituteName();
    ?>

                            <b> <?php echo $ins_name; ?></b>

                            <small class="brown">

                                <i class="ace-icon fa fa-angle-double-right"></i>

                                Applicant List

                            </small>

                            <small class="pull-right">

                                Date: <?php echo date("m/d/Y"); ?>

                            </small>



                        </div>



                    </div>

                    <hr>

                    <div class="col-xs-12 col-sm-5 col-sm-offset-2">

                        <div>

                            <ul class="list-unstyled spaced">

                                <li>

                                    <i class="ace-icon fa fa-caret-right blue"></i>Session: 

    <?php
    echo "<b>" . getSessionName($sessionId) . "</b>";
    ?>

                                </li>



                                <li>

                                    <i class="ace-icon fa fa-caret-right blue"></i>Class Level: 

                                    <?php
                                    foreach (getProgramLevel() as $key => $value) {

                                        if ($programLevel == $key) {

                                            echo "<b>" . $value . "</b>";
                                        }
                                    }
                                    ?>

                                </li>



                                <li>

                                    <i class="ace-icon fa fa-caret-right blue"></i>Class:

                                    <?php
                                    echo "<b>" . getProgramName($programId) . "</b>";
                                    ?>

                                </li>



                            </ul>

                        </div>

                    </div>   

                    <div class="col-xs-12 col-sm-5">

                        <div>

                            <ul class="list-unstyled spaced">

                                <li>

                                    <i class="ace-icon fa fa-caret-right blue"></i>Medium: 

    <?php
    echo "<b>" . getmediumName($mediumId) . "</b>";
    ?>

                                </li>



                                <li>

                                    <i class="ace-icon fa fa-caret-right blue"></i>Group: 

    <?php
    echo "<b>" . getGroupName($groupId) . "</b>";
    ?>

                                </li>



                                <li>

                                    <i class="ace-icon fa fa-caret-right blue"></i>Shift: 

    <?php
    echo "<b>" . getshiftName($shiftId) . "</b>";
    ?>

                                </li>



                            </ul>

                        </div>

                    </div>   

                </div><!-- /.col -->





            </div><!-- /.row -->





            <!-- div.dataTables_borderWrap -->

            <div>

                <table id="simple-table" class="table table-striped table-bordered table-hover">

                    <thead>

                        <tr>



                            <th class="hidden-480">Applicant Id</th>

                            <th class="hidden-480">Applicant Name</th>

                            <th class="hidden-480">Gender</th>

                            <th class="hidden-480">Parents Contact</th>

                            <th class="hidden-480">Image</th>



                        </tr>

                    </thead>



                    <tbody>

    <?php
    foreach ($applicantlist as $value) {
        ?>



                            <tr>



                                <td>

                                    <a href="#">

        <?php
        if (!empty($value['applicationId'])) {

            echo $value['applicationId'];
        }
        ?>



                                    </a>

                                </td>



                                <td><?php if (!empty($value['firstName'])) {
            echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'];
        } ?></td>

                                <td><?php if (!empty($value['gender'])) {
            echo element($value['gender'], getSex(), Null);
        } ?></td>



                                <td class="hidden-480">



                                        <?php echo "Father Name : " . $value['fatherName'] . "<br>Father Mobile : <span class=\"label label-sm label-warning\">" . $value['fatherPhone'] . "</span>"; ?>

                                </td>

                                <td class="hidden-480">

                                        <?php
                                        if ($value['photo']) {
                                            ?>

                                        <img  src="<?php if (file_exists($value['photo'])) {
                                                echo base_url() . $value['photo'];
                                            } else {
                                                echo base_url() . "uploads/default/default.png";
                                            } ?>" width="60" height="60">

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

        </div><!-- /.col-x12 -->

                                <?php
                            }
                            ?>

</div> <!-- /.row --> 