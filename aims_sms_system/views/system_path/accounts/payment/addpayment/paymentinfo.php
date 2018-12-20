<div class="page-content">
    <!-- /Content Section  -->  
    <div style="margin-top: 20px; padding: 3.5px;">                     
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
    <form action="<?php echo acc_Url(); ?>/paymentadd/insertpaymentadd" method="post">
        <div class="col-sm-5">
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
                        if (!empty($feeslist)) {
                            ?> 


                            <div class="row">
                                <div class="col-xs-12">
                                    <blockquote class="pull-left">


                                        <span class="green">

                                            <?php if (!empty($feeslist['firstName'])) {
                                                echo $feeslist['firstName'];
                                            } ?>
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
                                    

                                </div>

                            </div>


                            <?php
                        }
                        ?> 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-7">       

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
                                                        <th>Select</th>
                                                        <th>Session</th>
                                                        <th>Payment Head</th>
                                                        <th>Amount</th>
                                                        <th>Discount</th>


                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td> <input type="hidden"  value="0" id="more" /> </td>
                                                    </tr>
                                                    <?php
                                                    foreach ($feeslist as $value) {

                                                        $discount = getStudentDiscountList($studentId, $value['headId']); // Get Student Discount by Payment Head ID 
                                                        ?>
                                                        <tr>


                                                            <td>
                                                                <?php
                                                                if (!getStudentpaymentList($studentId, $value['headId'], $info['sessionId'])) {
                                                                    ?>
                                                                    <input type="checkbox" name="headId[]"  value="<?php echo $value['headId']; ?>">

                                                                    <input type="checkbox" name="amount[]"  id="more" value="<?php
                                                                    if (!empty($discount)) {
                                                                        echo $discount["amount"];
                                                                    } else {
                                                                        echo $value['amount'];
                                                                    }
                                                                    ?>">

                                                                    <?php
                                                                } else {
                                                                    echo "Paid";
                                                                }
                                                                ?>
                                                            </td>

                                                            <td>

                                                                <?php
                                                                if (!getStudentpaymentList($studentId, $value['headId'], $info['sessionId'])) {
                                                                    ?>
                                                                    <?php echo getSessionName($info['sessionId']); ?>
                                                                    <input  type="hidden" name="sessionId[]" value="<?php echo $info['sessionId']; ?>"> 
                                                                    <?php
                                                                } else {
                                                                    echo getSessionName($info['sessionId']);
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
                                                            if (!getStudentpaymentList($studentId, $value['headId'], $info['sessionId'])) {

                                                                if (empty($discount)) {
                                                                    ?>
                                                                    <td style=" color: red;">
                                                                        <?php echo $value['amount']; ?>
                                                                     <!--   <input type="hidden" name="amount" value="<?php echo $value['amount']; ?>">-->

                                                                    </td> 
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <td style="color: red; ">
                                                                        <?php
                                                                        echo $discount["amount"];
                                                                        ?>
                                                                    <!--    <input type="hidden" name="amount" value="<?php echo $x["amount"]; ?>"> -->
                                                                    </td> 
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <td style="color:green;">
                                                                    <?php
                                                                    if (!empty($discount)) {

                                                                        echo $discount["amount"];
                                                                    } else {
                                                                        echo $value['amount'];
                                                                    }
                                                                    ?>

                                                                </td>  
                                                                <?php
                                                            }
                                                            ?>                  

                                                            <td>
                                                                <?php
                                                                if (!empty($discount)) {

                                                                    echo $discount["discount"] . "%";
                                                                } else {
                                                                    echo "N/A";
                                                                }
                                                                ?>

                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }

                                                    foreach ($finelist as $value) {
                                                        ?>
                                                        <tr>
                                                            <td>
        <?php
        if (!getStudentpaymentList($studentId, $value['finehead'], $value['date'])) {
            ?>
                                                                    <input type="checkbox" name="headId[]" value="<?php echo $value['finehead']; ?>">

                                                                    <input type="checkbox" name="amount[]" id="more" value="<?php echo $value['amount']; ?>">

            <?php
        } else {
            echo "Paid";
        }
        ?>
                                                            </td>  
                                                            <td>
        <?php
        if (!getStudentpaymentList($studentId, $value['finehead'], $value['date'])) {
            ?>
                                                                    <?php echo $value['date'] ?>
                                                                    <input  type="hidden" name="sessionId[]" value="<?php echo $value['date']; ?>">
                                                                    <?php
                                                                } else {
                                                                    echo $value['date'];
                                                                }
                                                                ?>

                                                            </td>
                                                            <td>
        <?php
        if (!empty($value['finehead'])) {
            echo $value['finehead'];
        }
        ?>

                                                            </td>  
                                                                <?php
                                                                if (!getStudentpaymentList($studentId, $value['finehead'], $value['date'])) {
                                                                    ?>
                                                                <td style="color: red;">
                                                                <?php echo $value['amount']; ?>
                            <!--                                                    <input type="hidden" name="amount" value="<?php echo $value['amount']; ?>">-->
                                                                </td>  
                                                                    <?php
                                                                } else {
                                                                    ?>

                                                                <td style="color:green;">
                                                                <?php echo $value['amount']; ?>

                                                                </td>  
                                                                    <?php
                                                                }
                                                                ?>
                                                            <td>
                                                                N/A

                                                            </td>          
                                                        </tr>    
        <?php
    }
    ?>    
                                                </tbody>
                                                <tfoot >

                                                <th colspan="5" > Total : <span class="totalSum"> </span> <textarea style="display: none;" class="totalSum" ></textarea> </th>
                                                <input class="totalSum" id="sunHidden" type="hidden" name="data[amount]">
                                                </tfoot>
                                            </table>
                                        </div><!-- /.span -->
                                    </div><!-- /.row -->
    <?php
}
?>
                                <div class="radio" required="1">  
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Payment Method:</label>
                                    <label>
                                        <input name="paymentMethod" type="radio" value="cash" class="ace" />
                                        <span class="lbl"> Cash</span>
                                    </label>
                                    <label>
                                        <input name="paymentMethod" type="radio" value="check" class="ace" />
                                        <span class="lbl"> Check</span>
                                    </label>
                                    <label>
                                        <input name="paymentMethod" type="radio" value="card"  class="ace" />
                                        <span class="lbl"> Card</span>
                                    </label>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bank/ Card Name : </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="bankName" id="form-field-1" placeholder="Bank/ Card Number" class="col-xs-10 col-sm-8" />
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Check/ Card Number : </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="chequeNumber" id="form-field-1" placeholder="Check/ Card Number" class="col-xs-10 col-sm-8" />
                                    </div>
                                </div>



                            </div>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-danger" name="regConfirm">

                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Payment
                    </button>


                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        
      
            
            
            // count amount total
        function displayVals() {
            calcUsage();
        }
        var $cbs = $('input[id="more"]');
        function calcUsage() {
            var total = $("#more").val();
            $cbs.each(function() {
                if (this.checked)
                    total = parseInt(total) + parseInt(this.value);
            });
            $(".totalSum").text(total);
            $("#sunHidden").val(total);
        }

        $("select").change(displayVals);
        displayVals();
        //For  checkboxes

        $cbs.click(calcUsage);


    </script>
</div><!-- PAGE CONTENT ENDS -->



