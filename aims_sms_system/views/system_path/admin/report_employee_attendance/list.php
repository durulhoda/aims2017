<style>
    html
    {
        background-color:#ffffff;
    }
    .footer-content
    {
        border-top: none !important;
    }
</style>
<!-- /Content Section  -->
<div class="page-header">
    <div class="row">
        <span>
            <h1>
                All Employee Attendance List
            </h1>
        </span>
        <br>
        <button class="btn btn-white btn-info " onclick="printDiv('printableArea')">
            <i class="ace-icon fa fa-print bigger-120 blue"></i>
            Print
        </button>
    </div>
</div>

<!-- /.page-header -->

<div class="row">
    <?php
    $message = $this->session->userdata('message');
    if (isset($message)) {
        ?>
        <div class="alert alert-block alert-success">
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
        <div class="alert alert-block alert-danger">
            <i class="ace-icon fa fa-times red"></i>
            <?php
            echo $errormessage;
            $this->session->unset_userdata('errormessage');
            ?>
        </div>
    <?php
    }
    ?>

    <div id="printableArea">


        <table class="table table-bordered table-responsive" style="width: 100%;">
            <thead>
            <tr>
                <td rowspan="2" style="min-width: 85px;vertical-align:middle;">Date</td>
                <?php
                    foreach($employees as $emp)
                    {
                ?>
                        <td colspan="3"><?php echo $emp['firstName'].' '.$emp['lastName'].'<br>'.$emp['designation_name'];?></td>
                <?php
                    }
                ?>
            </tr>
            <tr>
                <?php
                    foreach($employees as $emp)
                    {
                ?>
                        <td style="text-align: center;">In</td>
                        <td style="text-align: center;">Out</td>
                        <td style="text-align: center;">Hour</td>
                <?php
                    }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($dates as $date)
                {
            ?>
                    <tr
                        <?php
                            if(isset($calendar[$date]))
                            {
                                if($calendar[$date]==1)
                                {
                                    echo 'style="background-color:#fa3c3c;"';
                                }
                                elseif($calendar[$date]==4)
                                {
                                    echo 'style="background-color:yellow;"';
                                }
                                else
                                {}
                            }
                        ?>>
                        <td style="text-align: center;"><?php echo $date;?></td>
                        <?php
                        foreach($employees as $emp)
                        {
                        ?>
                            <td style="text-align: center;"><?php echo $attendance[$date][$emp['employeeId']]['in_time'];?></td>
                            <td style="text-align: center;"><?php echo $attendance[$date][$emp['employeeId']]['out_time'];?></td>
                            <td style="text-align: center;"><?php echo $attendance[$date][$emp['employeeId']]['hour'];?></td>
                        <?php
                        }
                        ?>
                    </tr>
            <?php
                }
            ?>
            </tbody>
        </table>

    </div>

