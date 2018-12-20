 
<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
Add Payment
 <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Payment Details
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
        
        
<div class="row">
    <div class="col-sm-4 col-sm-offset-1">
        <div class="widget-box transparent">
         <div class="widget-header widget-header-large  float-right">
                 <button class="btn btn-danger" onclick="printDiv('printableArea')">
                    Print A Copy
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>     

         </div>  
          
            
            
          <div id="printableArea">        
            <div class="row">
                <div style="width:365px; margin-left: 15px;"><br>
                                      <?php
                    $ins_info = getInstituteInfo();
                    ?>
                         
    <div style="width: 70px; margin-left: 162px;">
        <img src="<?php echo base_Url() . $ins_info['logo'] ?>" alt="Institute Logo" width="70" height="70" align="middle"> 
    </div>
                    
                    <h5 style="text-align: center;">    <?php   $ins_name=getInstituteInfo(); 
                    echo $ins_name['instituteName'] ;
              ?></h5>
       
    <p style="margin-left:41px;">
      
        <span style="line-height: 19px; margin-left: 90px;">   
              <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?>
        </span>

    <div style="font-size: 12px; float: right;  margin-right: 3px; margin-top: -6px;">   
        Date:12-12-2016
    </div>

    <div style="font-size: 14px;  margin-top: 27px; padding-left: 65px; background: #efefef;">   
        Payment Details (Student Copy)
    </div><br>

    <table>
        <tr>
            <td style="color:green">ID&nbsp;</td>
            <td>:</td>
            <td>&nbsp; <?php if (!empty($studentId)) { echo $studentId;   } ?></td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td style="color:green">Class&nbsp;</td>
            <td>:</td>
            <td>&nbsp; <?php echo getProgramName($info['programId']); ?></td>
        </tr>
        
          <tr>
              <td style="color:green">Name&nbsp;</td>
            <td>:</td>
            <td>&nbsp; <?php echo $info['firstName'] . " " . $info['lastName']; ?></td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>Session&nbsp;</td>
            <td>:</td>
            <td>&nbsp; <?php echo getSessionName($info['sessionId']); ?></td>
        </tr>
        
    </table>
<br>
    
     <table id="simple-table" class="table table-bordered">
                            <thead>
                                <tr> 
                                    <th>#</th>
                                    <th>Payment Head</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if($feeslist) : ?>
                            <?php foreach($feeslist as $key => $val) : ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td>
                                    <?php if ($val['payment_status'] == 1) : ?>
                                        <?php echo getPaymentHeadName($val['headId']); ?>
                                    <?php else : ?>
                                    <?php echo isset($finecauselist[$val['headId']]) ? $finecauselist[$val['headId']] : ""; ?>
                                    <?php endif; ?>
                                    </td>
                                    <td><?php echo $val['amount']; ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                                <tr>   
                                    <td colspan="2">
                                        <span style="float: right;"><b> Total:</b></span>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php echo $totalsum['amount'];?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
  

<div style="color:red; text-align: center;">
    <?php

    function convert_number_to_words($number) {

        $hyphen = '-';
        $conjunction = ' and ';
    //    $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Fourty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
            1000000000000000 => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
    ?>

Word In (tk): <?php echo convert_number_to_words($totalsum['amount']); ?> only.


    
</div>
<div style="font-family: sans-serif; margin-top: 44px; float: right;">
 <div>-------------------------------</div>   
    Authorized Signature</div>
</div>
                        </div>
                        
                    </div>
                </div></div></div> </div></div></div>

 