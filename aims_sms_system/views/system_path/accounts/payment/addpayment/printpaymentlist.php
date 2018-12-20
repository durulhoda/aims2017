<div class="page-content">
    <div style="margin-top: 20px; padding: 3.5px;">   
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
                                        <th>Sl no.</th>

                                        <th>Payment Head</th>
                                        <th>Amount</th>
                                        
                                       
                                    </tr>
                            </thead>

                            <tbody>

                                <?php
                                $xl=1;
                                foreach ($feeslist as $value) {
                                    ?>
                                    <tr>
                                        
                                        <td>
                                            <?php echo $xl++; ?>
                                        </td>
                                      
                                        
                                       
                                        <td>
                                                    <?php if (!empty($value['headId'])) {
                                                echo getPaymentHeadName($value['headId']);
                                            } ?>
                                        </td>
                                        
                                        <td style="text-align: right;">
                                            <?php
                                        if (getStudentDiscountList($studentId, $value['headId'])) {
                                            $dis = getStudentDiscountList($studentId, $value['headId']);
                                            echo $dis["amount"];
                                        } else {
                                            echo $value['amount'];
                                        }
                                        ?>
                                        </td>
                                        
                                        
                                   
                                       
                                    </tr>
                                    
                                   
                                    <?php
                                        }
                                        
                                      if(!empty($finelist))
                                      {
                                         $fineamount = 0;
                                        foreach ($finelist as $value) {
                                ?>
                                    <tr>
                                        
                                        
                                       
                                    </tr>
                                    <?php
                                         echo   $fineamount = $fineamount + $value['amount'];
                                        }
                                      }
                                      if(!empty($paymentlist))
                                      {
                                        
                                         foreach ($paymentlist as $pa_value) {
                                     ?>
                                   <!--     <tr>
                                        
                                            <td>
                                                <?php echo $xl++; ?>
                                            </td>
                                            <td>
                                                  <?php echo getSessionName($pa_value['sessionId']); ?>
                                            </td>
                                            
                                            <td>
                                              <?php echo getGroupName($info['groupId']); ?>
                                        </td>
                                            
                                            <td><?php echo $pa_value['paymentDate']; ?></td>
                                            <td>
                                                <?php if (!empty($pa_value['headId'])) {
                                                        if (is_numeric($pa_value['headId'])) {
                                                           echo getPaymentHeadName($pa_value['headId']);
                                                        } else {
                                                            echo $pa_value['headId'];
                                                        }
                                                } ?>
                                            </td>
                                            <td> 0.0</td>
                                            <td>
                                                <?php
                                                    if (!empty($pa_value['amount'])) {
                                                        echo $pa_value['amount'];
                                                    }
                                            ?>
                                            </td>

                                        </tr>-->
                                        <?php
                                            
                                                }
                                            }
                                        ?>
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
  

</p>

</div>
                        </div>
                        
                    </div>
                </div></div></div> </div></div></div>