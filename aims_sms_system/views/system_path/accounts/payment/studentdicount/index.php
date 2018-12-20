<div class="page-content">
    <div style="margin-top: 20px; padding: 3.5px;">   
<!-- /Content Section  -->                     
<div class="page-header">
                <h1> 
                    Payment
                        <small class="red">
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Student Discount
                        </small>
              </h1>
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
        
            <!-- div.table-responsive -->
                                <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
                                        <form  action="<?php echo acc_Url(); ?>/payments/searchpaymentinfo" method="post" class="form-horizontal" role="form">

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student ID: &nbsp; </label>
                                                    <input type="text" required="1" id="Name" class="Name" placeholder="Student Id" name="data[studentId]" /> <br />

                                                </div>


                                                <div class="clearfix form-actions">
                                                        <div class="col-md-offset-3 col-md-9">
                                                                <button class="btn btn-info" name="submit" type="submit">
                                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                                        Search
                                                                </button>
                                                        </div>
                                                </div>
                                        </form>
                                              
            
        </div>
            <!-- /.col-x12 -->
            
           <?php
        if (!empty($feeslist)) {
            ?>     
       <div class="col-sm-7">
           <div class="widget-header widget-header-large  float-right">
                 <button class="btn btn-danger" onclick="printDiv('printableArea')">
                    Print A Copy
                    <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                </button>     


         </div>           
          <div id="printableArea">      
                     
                 
        <div class="widget-box">
            
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-user"></i>&nbsp;
                    Student Information
                </h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    
                    <div class="row">
                        <div class="col-xs-12">
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
                                     if ($info['photo']) {
                                  ?>
                                     <img  src="<?php if (file_exists($info['photo'])) { echo base_url() . $info['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60">
                                 <?php 
                                        } 
                                 ?>
                                
                            </blockquote>
                            
                        </div>
                        
                    </div>
          
                     
                </div>
            </div>
            
        </div>
           <div class="row">
               <?php
               if (!empty($feeslist)) {
                   ?>
                   <div class="col-xs-12">


                       <div class="widget-box">
                           <div class="widget-header widget-header-flat">
                               <h4 class="smaller">
                                   <i class="ace-icon fa fa-external-link"></i>
                                   Discount Summery
                               </h4>
                           </div>

                           <div class="widget-body">
                               <div class="widget-main row ">

                                   <div class="row">
                                       <div class="col-xs-12">
                                           <table id="simple-table" class="table table-striped table-bordered table-hover">
                                               <thead>
                                                   <tr>                                
                                                       <th>Date</th>
                                                       <th>Payment Head</th>
                                                       <th>Main Amount</th>
                                                       <th>Discunt(%)</th> 
                                                       <th>Amount</th> 
                                                   </tr>
                                               </thead>

                                               <tbody>

                                                   <?php
                                                   foreach ($discountlist as $valuess) {
                                                       ?>
                                                       <tr>


                                                           <td>
                                                               <?php
                                                               echo $valuess['date'];
                                                               ?>
                                                           </td>

                                                           <td>

                                                               <?php
                                                               if (!empty($valuess['headId'])) {
                                                                   echo getPaymentHeadName($valuess['headId']);
                                                               }
                                                               ?>
                                                           </td>
                                                           <td> 
                                                               <?php
                                                               if (!empty($valuess['headAmount'])) {
                                                                   echo $valuess['headAmount'];
                                                               }
                                                               ?>

                                                           </td>
                                                           <td> 
                                                               <?php
                                                               if (!empty($valuess['discount'])) {
                                                                   echo $valuess['discount'];
                                                               }
                                                               ?>
                                                           </td>


                                                           <td>
                                                               <?php
                                                               if (!empty($valuess['amount'])) {
                                                                   echo $valuess['amount'];
                                                               }
                                                               ?>
                                                           </td>




                                                       </tr>


                                                       <?php
                                                   }
                                                   ?>

                                               </tbody>
                                           </table>
                                       </div><!-- /.span -->
                                   </div><!-- /.row -->
                                   <?php
                               }
                               ?>

                           </div>
                       </div>

                   </div>
               </div>
           </div>      
           
        </div>      
</div>
  <?php
        
        }
         if (!empty($feeslist)) {
    ?>     
       <div class="col-sm-5">       

        <div class="row">
            <div class="col-xs-12">
            
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                              Add Discount
                            </h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main row ">
                              
                                   
             
                <div class="row">
                    <div class="col-xs-12">
                        <form action="<?php echo acc_Url(); ?>/payments/insertDiscount" method="post" >
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                <th>Select</th>
                                <th>Payment Head</th>
                                <th>Amount</th>
                                <th>Discount (%)</th>
                                <th>Discount Amount</th>
                                <th>Amount</th> 
                                </tr>
                                <input  type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                            </thead>

                            <tbody>
                                <?php
                                
                                foreach ($feeslist as $value) {
                                    ?>
                                    <tr>
                                           <td>
                                             <?php
                                                if (!getStudentDiscountList($studentId, $value['headId'])) {
                                                    ?>
                                                    <input type="checkbox" name="headId[]" value="<?php echo $value['headId']; ?>">
                                                    <?php
                                                } else {
                                                    echo "N/A";
                                                }
                                                ?>
                                                </td>
                                        
                                        <td>
                                           <?php
                                                if (!empty($value['headId'])) {
                                                    echo getPaymentHeadName($value['headId']);
                                                }
                                                ?>
                                        </td>
                                      
                                                 <?php
                                            if (!getStudentDiscountList($studentId, $value['headId'])) {
                                                ?>
                                                <td style="border: 1px solid #D8D8D8; color: red; text-align: center">
                                                    <?php echo $value['amount']; ?>
                                                    <input onkeydown="updateNewAmount()" type="hidden" name="headAmount" value="<?php echo $value['amount']; ?>">
                                                </td>  
                                                <?php
                                            } else {
                                                ?>

                                                <td >
                                                    <?php echo $value['amount']; ?>  Added

                                                </td>  
                                                <?php
                                            }
                                            ?>
                                        <td> 
                                          <?php
                                                if (!getStudentDiscountList($studentId, $value['headId'])) {
                                                    ?>
<!--                                                    <select id="dropdown_selector">
                                                        <option value="">Select Discount(%)</option> 
                                                            <?php
                                                                foreach (getDiscount_percentage() as $key => $dis_value) {
                                                            ?>
                                                                <option value="<?php echo $key; ?>" >
                                                                        <?php echo $dis_value; ?>
                                                                </option> 

                                                            <?php
                                                                }
                                                            ?>                                                         
                                                    </select>-->
                                                    <input  style="width:60px;text-align: center" placeholder="00" maxlength="2" required="1" onkeydown="updateNewAmount()" id="showoption" type="text" name="discount">
                                                    <?php
                                                } else {
                                                    echo "Added";
                                                }
                                                ?>
                                        </td>
                                        
                                        <td>
                                                           <?php
                                                if (!getStudentDiscountList($studentId, $value['headId'])) {
                                                    ?>
                                                    <input style="width:50px;" type="text" name="disamount" >
                                                    <?php
                                                } else {
                                                    echo "Added";
                                                }
                                                ?>

                                        </td>
                                        
                                        <td>
                                                <?php
                                                if (!getStudentDiscountList($studentId, $value['headId'])) {
                                                    ?>
                                                    <input style="width:50px;" type="text"  name="amount" value="0">
                                                    <?php
                                                } else {
                                                    echo "Added";
                                                }
                                                ?>
                                            </td> 

                                    </tr>
                                    
                                   
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table> 
                                <div class="col-md-offset-1 col-md-5">
                                      <button class="btn btn-info" name="submit" type="submit">
                                          <i class="ace-icon fa fa-check bigger-110"></i>
                                          Save
                                      </button>
                                </div>
                          </form>
                    </div>
                   
                    <!-- /.span -->
                </div><!-- /.row -->
      
                            </div>

                        </div>
                        
                    </div>
                 </div>
            </div>
        </div>
    <?php
            }
          ?>
                
       <script>
                                                        function updateNewAmount() {
                                                            var oldPrice = document.getElementsByName("headAmount")[0].value;
                                                            var discountPrct = document.getElementsByName("discount")[0].value;
                                                            if (!isNaN(oldPrice) && !isNaN(discountPrct)) {
                                                            var discount = (oldPrice / 100) * discountPrct;
                                                            var payableamount = oldPrice - discount;
                                                                if (discount > 0)
                                                                    document.getElementsByName("disamount")[0].value = discount;
                                                                document.getElementsByName("amount")[0].value = payableamount;
                                                            }
                                                        }                                                                                                              
                  // By Select discount percentage get value and change amount
                  //-----------------------------------------------------------------------
//                   $(document).ready(function()
//                    {
//                      /* we are assigning change event handler for select box */
//                            /* it will run when selectbox options are changed */
//                            $('#dropdown_selector').change(function()
//                            {
//                                    /* setting currently changed option value to option variable */
//                                    var option = $(this).find('option:selected').val();
//                                    /* setting input box value to selected option value */
//                                    $('#showoption').val(option);
//                            });
//                    });
        </script>
</div>
 <!-- PAGE CONTENT ENDS -->

