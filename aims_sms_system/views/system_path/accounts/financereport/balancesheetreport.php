<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
                   
<div class="page-header">
    <h1>
        Finance
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Balance Sheet
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
                                            
                                            <th class="center hidden-480"></th>


                                            <th class="hidden-480">Equity</th>

                                        </tr>
                                    </thead>
                           <?php
                            $s = 1;
                            $equitytotal=0;
                            $creditbalance=0;
                            $debitbalance=0;
//                            $debittotal=0;
                            foreach ($getdata as $value) {
                                        $time = strtotime($value['addDate']);
                                        $thismonth= date("d-m-Y",$time); 
                                        $get_yr=date('Y', strtotime($thismonth));
                                        
                                     //   if($get_yr==$year){
                                            
//                                            $debittotal=$value['debit']+$debittotal;
                                            
                                if($value['financeCategory']==3){
                                    
                                    
                                    
                        ?>
                                    
                                                <tbody>

                                                                <?php
                                                                $equitytotal = $creditbalance + $equitytotal - $debitbalance;
                                                            }
                                                   //     }
                                                    }

                                                    $credittotal = 0;
                                                    foreach ($getdata as $value) {
                                                        $time = strtotime($value['addDate']);
                                                        $thismonth = date("d-m-Y", $time);
                                                        $get_yr = date('Y', strtotime($thismonth));

                                                    //    if ($get_yr == $year) {

//                                            $debittotal=$value['debit']+$debittotal;

                                                            if ($value['financeCategory'] == 1) {
                                                                $credittotal = $value['credit'] + $credittotal;
                                                                ?>
                                                                <?php
                                                                $value['credit'];
                                                                ?>


                                                                <?php
                                                            }
                                                      //  }
                                                    }
                                                    $debittotal = 0;
                                                    foreach ($getdata as $value) {
                                                        $time = strtotime($value['addDate']);
                                                        $thismonth = date("d-m-Y", $time);
                                                        $get_yr = date('Y', strtotime($thismonth));

                                                     //   if ($get_yr == $year) {

                                                            if ($value['financeCategory'] == 2) {
                                                                $debittotal = $value['debit'] + $debittotal;
                                                                ?>
                                                                <?php
                                                                $value['debit'];
                                                                ?>


                                                                <?php
                                                            }
                                                       // }
                                                    }

                                                    $sl = 0;
                                                    $totalpaidamount = 0;
                                                    foreach ($getpaymentdata as $valuez) {

                                                        $time = strtotime($valuez['paymentDate']);
                                                        $thismonth = date("d-m-Y", $time);
                                                        $get_yr = date('Y', strtotime($thismonth));

                                                     //   if ($get_yr == $year) {

                                                            if ($s <> $sl) {

                                                                foreach ($getpaymentdata as $dataz) {
                                                                    $time = strtotime($dataz['paymentDate']);
                                                                    $thismonth = date("d-m-Y", $time);
                                                                    $get_yr = date('Y', strtotime($thismonth));

                                                               //    if ($get_yr == $year) {
                                                                        $dataz['amount'];

                                                                        $totalpaidamount = $totalpaidamount + $dataz['amount'];
                                                                   // }
                                                                }
                                                            }
                                                            $sl = $s;
                                                      //  }

                                                       
                                                       
                                                    } $studentpayment = $totalpaidamount;

                                                    $profitloss = $credittotal + $studentpayment - $debittotal;
                                                    ?> 

                                   
                                    
                                    
                                        <tr>
                                            <td></td>
                                        <td > <?php
                                        if($profitloss > 0){ 
                                   
                                            ?>
                                        Net Profit
                                        </td>
                                         <td >   <?php 
                                        
                                        }
                                        elseif($profitloss < 0){ 
                                            ?>
                                         Net Loss 
                                         </td>
                                          <td > <?php 
                                        
                                        }else{ 
                                            ?>
                                          Net Profit/Loss
                                          </td>
                                          <?php } ?>
                                         <td >
                                            
                                              
                                           </td>
                                        <td colspan="1">
                                        </td>
                                        <td> 
                                        </td>
                                         <td>  
                                             <?php                                                 
                                                    $xlds = explode(".", $profitloss);
                                                        if (!empty($xlds[1])) {
                                                            echo $profitloss;
                                                        } else {
                                                            echo $profitloss . ".00";
                                                        }
                                            ?>
                                        </td>
                                         
                                    
                                    </tr>
                                    
                               
                                       <tr>
                                        <td ></td>
                                        <td >Total Equity</td>
                                        <td colspan="1"></td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td>
                                            <?php 
                                                $ttl_quity= $equitytotal+$profitloss; 
                                                $xlds = explode(".", $ttl_quity);
                                                        if (!empty($xlds[1])) {
                                                            echo $ttl_quity;
                                                        } else {
                                                            echo $ttl_quity . ".00";
                                                        }
                                            ?></td>
                                      
                                    </tr>

                            




                                    </tbody>
                                </table>

                            </div>

                            <div class="hr hr8 hr-double hr-dotted"></div>



                            <div class="space-6"></div>
                            <div class="well">
                                <div class="col-sm-5 pull-right">
                                    <h4 class="pull-left">
                                        Total Equity(loss):
                                        <span class="green">
                                            <?php 
                                                $totl_loss= $equitytotal+$profitloss; 
                                                    $xlds = explode(".", $totl_loss);
                                                        if (!empty($xlds[1])) {
                                                            echo $totl_loss;
                                                        } else {
                                                            echo $totl_loss . ".00";
                                                        }
                                             ?>
                                        </span>
                                    </h4>
                                </div><BR>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->