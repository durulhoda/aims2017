<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Payment
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Add Payment
            </small>
        </h1>
    </div><!-- /.page-header -->
<div class="row">
    
    <div class="col-sm-4">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-user"></i>&nbsp;
                    Student Short Profile
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    
                     <?php
                     $fineamount = 0;
        if (!empty($info)) {
            ?> 
                    
                    
                    <div class="row">
                        <div class="col-xs-14">
                            <blockquote class="pull-left">
                               

                                <span class="green">
                                    
                                    <?php  if (!empty($feeslist['firstName'])) { echo $feeslist['firstName'];} ?>
                                </span>
                                <small>  
                                    Student Id: 
                                    <cite title="Student Id" class="red bolder">               
                                            <?php echo $studentId; ?> 
                                            <input  type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                                    </cite>                                    
                                </small>
                                <small>  
                                    Student Name:
                                    <cite class="lighter red"> 
                                        
                                          <?php
                                            if (!empty($studentId)) {

                                                echo $info['firstName'] . " " . $info['lastName'];
                                            }
                                            ?>  
                                    </cite>                                    
                                </small>
                                <small>    
                                    Class:
                                    <cite  class="lighter red">
                                      <?php
                                            if (!empty($studentId)) {

                                                echo getProgramName($info['programId']);
                                            }
                                            ?>
                                         <input  type="hidden" name="programOfferId" value="<?php echo $info['programOfferId']; ?>">
                                    </cite>                                    
                                </small>    
                                  
                               
                            </blockquote>
                            
                             <blockquote class="pull-right">
                              <?php
                                     if ($studentlist['photo']) {
                                  ?>
                                     <img  src="<?php if (file_exists($studentlist['photo'])) { echo base_url() . $studentlist['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60">
                                 <?php 
                                        } 
                                 ?>
                                
                            </blockquote>
                           
                           
                            
                        </div>
                        
                    </div>
                    
                  
     <?php
        
    }
    ?> 
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">       

        <div class="row">
            <div class="col-xs-12">
              
                   
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                                Payment Details
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main row ">
                              
                                   
              <?php
            if (!empty($feeslist)) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr> 
                                        <th>Sl no.</th>

                                        <th>Session</th>
                                        <th>Group</th>
                                        <th>Date</th>	
                                        <th>Payment Head</th>
                                        <th>Payable Amount</th>
                                        <th>Fees Status</th>
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
                                              <?php echo getSessionName($info['sessionId']); ?>
                                        </td>
                                        
                                          <td>
                                              <?php echo getGroupName($info['groupId']); ?>
                                        </td>
                                        
                                        <td><?php echo $value['created_at']; ?></td>
                                        <td>
                                                    <?php if (!empty($value['headId'])) {
                                                echo getPaymentHeadName($value['headId']);
                                            } ?>
                                        </td>
                                        
                                        <td>
                                            <?php
                                        if (getStudentDiscountList($studentId, $value['headId'], $programOfferId)) {
                                            $dis = getStudentDiscountList($studentId, $value['headId'], $programOfferId);
                                            echo $dis["amount"];
                                        } else {
                                            echo $value['amount'];
                                        }
                                        ?>
                                        </td>
                                        
                                        
                                        <td> 
                                            
                                           <?php 
                                            $te= $value['headId'];
                                           if (getStudentpaymentListt($studentId,$te, $sessionId, 1)) {
                                               
                                               echo 'paid';
                                           }else {
                                               
                                             echo '<b style="color:red;"> Due ';
                                           }
                                            ?> 
                                            
                                        
                                        
                                        </td>
                                       
                                    </tr>
                                    
                                   
                                    <?php
                                        }
                                      if(!empty($finelist))
                                      {
                                         //$fineamount = 0;
                                        foreach ($finelist as $value) {
                                ?>
                                    <tr>
                                        
                                        <td>
                                            <?php echo $xl++; ?>
                                        </td>
                                        <td>
                                              <?php echo getSessionName($info['sessionId']); ?>
                                        </td>
                                        <td>
                                              <?php echo getGroupName($info['groupId']); ?>
                                        </td>
                                        
                                        
                                        <td><?php echo $value['date']; ?></td>
                                        <td>
                                            <?php if (!empty($value['finehead'])) {
                                                echo isset($finecauselist[$value['finehead']]) ? $finecauselist[$value['finehead']] : "";
                                            } ?>
                                        </td>
                                        
                                        <td>
                                            <?php
                                                if (!empty($value['amount'])) {
                                                    echo $value['amount'];
                                                }
                                        ?>
                                        </td>
                                        
                                        <td>
                                            <?php if (!getStudentpaymentList($studentId, $value['finehead'], $sessionId, 2)) {
                                                echo '<b style="color:red;"> Due ';
                                             } else {
                                                echo "Paid";
                                             } ?>
                                         </td>
                                       
                                    </tr>
                                    <?php
                                            $fineamount = $fineamount + $value['amount'];
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
                            </tbody>
                        </table>
                    </div><!-- /.span -->
                </div><!-- /.row -->
                <?php
            }
            ?>
                 <div class="col-xs-6">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr> 
                                        <th>Summery</th>

                                        <th>Amount</th>
                                       
                                    </tr>
                            </thead>

                            <tbody>
                                    <tr>
                                        <td >Payable Amount(Head) :</td> 
                                        <td>
                                            <?php echo $totalfees = ($totalfees) ? $totalfees : 0; ?>        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Payable Amount(fine) :</td> 
                                        <td> 
                                            <?php echo $fineamount = ($fineamount) ? $fineamount : 0; ?>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Payable Amount :</td>
                                        <td><?php echo $total_payable = ($totalfees + $fineamount); ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>Total Discount(Head) :</td>
                                        <td><?php echo $tot_discount; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Net Payable Amount :</td>
                                        <td><?php echo $net_payable = ($total_payable - $tot_discount); ?></td>
                                    </tr>
                                    <tr>
                                        <td >Paid Amount :</td> 
                                        <td><?php echo $totalamount; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Due :</td>
                                        <td><?php echo ($net_payable - $totalamount); ?></td>
                                    </tr>
                              

                            </tbody>
                        </table>
                    </div><!-- /.span -->
                
                
                            </div>

                        </div>
                        
                    </div>
                   
                 
                
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->



