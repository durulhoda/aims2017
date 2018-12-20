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
                All Employee Information List
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
                    <td>Employee Name</td>
                    <td>Working Days</td>
                    <td>Presence</td>
                    <td>Absence</td>
                    <td>Educational Qualification</td>
                    <td>Birth Date</td>
                    <td>Joining Date</td>
                    <td>Basic Salary</td>
                    <td>Increment Date</td>
                    <td>L.PR Date</td>
                    <td>Bank Account No.</td>
                    <td>G.P.F No.</td>
                    <td>Present Address</td>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($employees as $employee)
                {
            ?>
                    <tr>
                        <td><?php echo $employee['firstName'].' '.$employee['lastName'];?></td>
                        <td><?php echo $working_days;?></td>
                        <td><?php echo $employee['presence'];?></td>
                        <td><?php echo $working_days-$employee['presence'];?></td>
                        <td><?php echo $employee['qualification_name'];?></td>
                        <td><?php echo $employee['dateOfBirth'];?></td>
                        <td><?php echo $employee['joiningdate'];?></td>
                        <td><?php echo $employee['basic_salary'];?></td>
                        <td><?php echo $employee['increment_date'];?></td>
                        <td><?php echo $employee['retirementDate'];?></td>
                        <td><?php echo $employee['bank_account_no'];?></td>
                        <td><?php echo $employee['gpf_no'];?></td>
                        <td><?php echo $employee['address'];?></td>
                    </tr>
            <?php
                }
            ?>
            </tbody>
        </table>

    </div>

