<div class="page-content">
    <!-- /Content Section  -->  
    <div style="margin-top: 20px; padding: 3.5px;">                     
<div class="page-header">
    <h1>
        Finance
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Profit Loss Report
        </small>
    </h1>
</div><!-- /.page-header -->
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


    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="space-6"></div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="widget-box ">
                    <div class="widget-header widget-header-large">

                        <div> 
                            <img class="pull-left" alt="<?php if (!empty($data_info['instituteName'])) {
        echo $data_info['instituteName'];
    } ?>" id="avatar2" src="<?php if (file_exists($data_info['logo'])) {
        echo base_url() . $data_info['logo'];
    } else {
        echo base_url() . "all_upload/default/aims.png";
    } ?>" width="80"/>
                            <h3><p class="user" > &nbsp; <?php if (!empty($data_info['instituteName'])) {
        echo "" . $data_info['instituteName'];
    } ?> </p>
                            </h3>
                            <div class="time">
                                &nbsp;
                                <span class="editable" id="country"><?php if (!empty($data_info['town'])) {
                                        echo "<b>Town/Village :</b> " . $data_info['town'];
                                    } ?></span>
                                <span class="editable" id="city"><?php if (!empty($data_info['city'])) {
                                        echo "<b>City :</b> " . $data_info['city'];
                                    } ?></span>
                                <span class="editable" id="country">
<?php
if (!empty($data_info['district'])) {
    foreach (getDistrictName() as $key => $value) {
        if ($key == $data_info['district']) {
            echo "<b>District :</b> " . $value;
        }
    }
}
?>
                                </span>
                            </div>

                        </div>





                        <div class="widget-toolbar no-border invoice-info">

                            <div class="pull-right">
                                <a href="#">
                                    <i class="ace-icon fa fa-print"></i>
                                </a>
                            </div>

                        </div>


                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-24">
                            <center>
                                <div id="id-message-infobar" class="message-infobar">
                                    <span class="blue bigger-150">For the period of </span>
                                    <span class="grey bigger-130"><?php echo $fromDate; ?> <font color="red">To </font><?php echo $toDate; ?></span>
                                </div>
                            </center>

                            <div class="space"></div>

                            <div>          

                                <table class="table table-striped ">

                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-left bolder">Income Statement</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $s = 1;
                                    $credittotal = 0;
                                    $debittotal = 0;
                                    $totalpaidamount = 0;

                                    foreach ($getdata as $value) {
                                        $studentpayment = $totalpaidamount;
                                        $debittotal = $value['debit'] + $debittotal;
                                        $credittotal = $value['credit'] + $credittotal;
                                        ?> 
                                        <tbody>
                                            <tr>
                                                <td class="text-left">    <?php echo getIncomeHeadCategoryName($value['financeHead']) ?></td>

                                                <td class="text-right">
                                                    <?php 
                                                         $xlds=explode(".",$value['credit']);
                                                         if(!empty($xlds[1])){ echo $value['credit']; }
                                                         else{ echo $value['credit'].".00"; }
                                                    ?>
                                               </td>
                                            </tr>

                                            <?php
                                            
                                                }
                                                foreach ($getpaymentdata as $dataz) {
                                                    $time = strtotime($dataz['paymentDate']);
                                                    $thismonth = date("d-m-Y", $time);
                                                    $get_yr = date('d-m-Y', strtotime($thismonth));

                                                    // if ($get_yr == $fromDate) {
                                                    $dataz['amount'];

                                                    $totalpaidamount = $totalpaidamount + $dataz['amount'];
                                                    // }
                                                }
                                                if (!empty($totalpaidamount)) {
                                            ?>
                                        <tr>
                                            
                                            <td class="text-left bolder">Student Total Payment</td>
                                           
                                            <td class="text-right"> 
                                                <?php
                                               
                                                if (!empty($totalpaidamount)) {
                                                    $xlds = explode(".", $totalpaidamount);
                                                    if (!empty($xlds[1])) {
                                                        echo $totalpaidamount;
                                                    } else {
                                                        echo $totalpaidamount . ".00";
                                                    }
                                                } else {
                                                    echo 0.00;
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                                <?php   }   ?>

                                        <tr>
                                            <td class="center"><span class="blue bigger-150">Total Income </span></td>
                                            <td class="text-right"><span class="header bolder"> <?php echo $totalcredittotal = $credittotal + $totalpaidamount; ?></span></td>
                                        </tr>




                                    </tbody>
                                </table>


                                <table class="table table-striped ">

                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-left bolder">Expenses Statement</th>
                                        </tr>
                                    </thead>
                                    <?php
                                            $s = 1;
                                            $credittotal = 0;
                                            $debittotal = 0;
                                            $totalpaidamount = 0;

                                            foreach ($getdata_expences as $value) {
                                                $studentpayment = $totalpaidamount;
                                                $debittotal = $value['debit'] + $debittotal;
                                                $credittotal = $value['credit'] + $credittotal;
                                    ?> 
                                        <tbody>
                                            <tr>
                                                <td class="text-left">    <?php echo getIncomeHeadCategoryName($value['financeHead']) ?></td>

                                                <td class="text-right">
                                                    <?php 
                                                         $xld=explode(".",$value['debit']);
                                                         if(!empty($xld[1])){ echo $value['debit']; }
                                                         else{ echo $value['debit'].".00"; }
                                                    ?>
                                                </td>
                                            </tr>
                                            
                                    <?php   }   ?>
                                   
                                        <tr>
                                            <td class="center"><span class="red bigger-150">Total Expenses </span></td>
                                            <td class="text-right"><span class="header bolder ">
                                                <?php
                                                     $studentpayment = $totalpaidamount;
                                                
                                                $totalcredit = $debittotal + $studentpayment; 
                                                
                                                         $xld=explode(".",$totalcredit);
                                                         if(!empty($xld[1])){ echo $totalcredit; }
                                                         else{ echo $totalcredit.".00"; }
                                                    ?>
                                                </span> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="hr hr8 hr-double hr-dotted"></div>

                            <div class="well">
                                <div class="col-sm-8 pull-left">
                                    <h4 class="center">
                                        Total amount :
                                        <span class="green text-right"> 
                                          
                                             <?php
                                                $total_amount = $totalcredittotal - $totalcredit;

                                                $xld = explode(".", $total_amount);
                                                if (!empty($xld[1])) {
                                                    echo $total_amount;
                                                } else {
                                                    echo $total_amount . ".00";
                                                }
                                            ?>
                                        
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->