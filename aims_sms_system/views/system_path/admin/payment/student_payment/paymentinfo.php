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
    <form action="<?php echo admin_Url(); ?>/student_payment/add" method="post">
        <div class="col-sm-7">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">
                        <i class="ace-icon fa fa-user"></i>&nbsp;
                        Student Short Profile&nbsp;(<?php echo ($student_info->firstName) ? $student_info->firstName : ''; ?>)
                    </h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <?php
                        if (!empty($student_info)) {
                            ?> 
                            <div class="row">
                                <div class="col-xs-6">
                                    <blockquote class="pull-left" style="padding-bottom: 2px;">
                                        <small>  
                                            Student Id: 
                                            <cite class="red bolder">               
                                                <?php echo $studentId; ?> 
                                                <input type="hidden" name="studentId" value="<?php echo $studentId; ?> ">
                                                <input type="hidden" name="programOfferId" value="<?php echo $programOfferId; ?> ">
                                            </cite>                                    
                                        </small>
                                        <small>  
                                            Roll No: 
                                            <cite class="red bolder">               
                                                <?php echo ($student_info->roll_no) ? $student_info->roll_no : ''; ?>
                                            </cite>                                    
                                        </small>
                                        <small>
                                            Session:
                                            <cite class="lighter red"> 
                                            <?php echo ($student_info->sessionId) ? getSessionName($student_info->sessionId) : ''; ?> 
                                            </cite>
                                        </small>
                                        <small>    
                                            Class:
                                            <cite  class="lighter red">
                                                <?php echo ($student_info->programId) ? getProgramName($student_info->programId) : ''; ?>
                                            </cite>                                    
                                        </small>  
                                    </blockquote>
                                </div>
                                <div class="col-xs-6">
                                    <blockquote class="pull-left" style="padding-bottom: 2px;"> 
                                        <small>    
                                            Group:
                                            <cite  class="lighter red">
                                                <?php echo ($student_info->groupId) ? getGroupName($student_info->groupId) : ''; ?>
                                            </cite>                                    
                                        </small> 
                                        <small>    
                                            Medium:
                                            <cite  class="lighter red">
                                                <?php echo ($student_info->mediumId) ? getmediumName($student_info->mediumId) : ''; ?>
                                            </cite>                                    
                                        </small> 
                                        <small>    
                                            Shift:
                                            <cite  class="lighter red">
                                                <?php echo ($student_info->shiftId) ? getshiftName($student_info->shiftId) : ''; ?>
                                            </cite>                                    
                                        </small>  
                                        <small>    
                                            Section:
                                            <cite  class="lighter red">
                                                <?php echo ($student_info->sectionId) ? getsectionName($student_info->sectionId) : ''; ?>
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
        <div class="col-sm-5">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">
                        <i class="ace-icon fa fa-user"></i>&nbsp;
                        Student Payment Add
                    </h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                         
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Payment Head<span style="color:red;">*</span> : </label>
                                        <select  class="col-xs-10 col-sm-8" id="headId">
                                            <option value="">Select a head name</option>
                                            <?php if ($headlist) : 
                                                foreach ($headlist as $key => $val) :
                                            ?>
                                            <option value="<?php echo $val->headId ?>"><?php echo $val->headName."->".$val->amount; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                </div>
                                <br>
                                <div class="form-group month" style="display: none;">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Month<span style="color:red;">*</span> : </label>
                                        <select  class="col-xs-10 col-sm-8" id="month">
                                            <option value="">Select a month name</option>
                                            <?php if (monthlist()) : 
                                                foreach (monthlist() as $key => $val) :
                                            ?>
                                            <option value="<?php echo $key ?>"><?php echo $val; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <input type="hidden" id="is_month">
                                </div>
                                <hr>
                                <div class="form-group" style="text-align: center;margin-bottom: 0px;">
                                <a class="btn btn-info btn-sm" id="add">Add</a>
                                </div>
                            </div>
                        </div>
                             
                    </div>
                </div>

            </div>
        </div>

        <div class="col-sm-8  col-sm-offset-2">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="smaller">
                        <i class="ace-icon fa fa-external-link"></i>
                        Payment Details
                    </h4>
                </div>
                <div class="widget-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Head Name</th>
                            <th>Amount</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody id="payment_detail">
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12">       
            <div class="row">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                        <h4 class="smaller">
                            <i class="ace-icon fa fa-external-link"></i>
                            Payment
                        </h4>
                    </div>
                    <div class="widget-body">
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>Total Amount</label>
                            <input type="text" readonly="" class="form-control" name="total_amount" id="total_amount">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                            <label>Discount</label>
                            <select  class="form-control" id="discount" name="discount_id">
                                <option value="">Select a discount</option>
                                <?php if ($discountlist) : 
                                    foreach ($discountlist as $key => $val) :
                                        $type = ($val->type == 1) ? "Percent" : "Amount";
                                ?>
                                <option value="<?php echo $val->id ?>"><?php echo $val->name."->".$type."->".$val->amount; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>Net Discount</label>
                            <input type="text" readonly="" class="form-control" name="net_discount" id="net_discount" value="0">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>Fine Cause</label>
                            <select  class="form-control" id="fine_id" name="fine_id">
                                <option value="">Select a fine cause</option>
                                <option value="1">Absent</option>
                                <option value="2">Late Present</option>
                                <option value="3">Others</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>Fine Amount</label>
                            <input type="text" disabled="" class="form-control" name="fine_amount" id="fine_amount" value="0">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>Net Amount</label>
                            <input type="text" readonly="" class="form-control" name="net_amount" id="net_amount">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>Pay Amount</label>
                            <input type="text" class="form-control" name="paid_amount" id="paid_amount" value="0">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                            <label>Due</label>
                            <input type="text" readonly="" class="form-control" name="due" id="due">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>Payment Type</label>
                            <select  class="form-control" id="payment_type" name="payment_type">
                                <option value="1">Cash</option>
                                <option value="2">Bank</option>
                                <option value="3">Bkash</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-3 mb_name" style="display: none;">
                            <div class="form-group">
                            <label>Mobile No/Bank Name</label>
                            <input type="text" class="form-control" name="mb_name" id="mb_name">
                            </div>
                        </div>
                        <div class="col-sm-2 at_no" style="display: none;">
                            <div class="form-group">
                            <label>AC No/Tran. No</label>
                            <input type="text" class="form-control" name="at_no" id="at_no">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <button type="submit" class="btn btn-danger" name="regConfirm">

                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Payment
                    </button>
    </form>
    <script type="text/javascript">  
        $(document).on('change', '#headId', function(){
            //alert(5);
            var id = $(this).val();
            var targetUrl = 'http://localhost/aminur/systemaccess/student_payment/checkHeadInfo';
            var sendData = {id:id};
           // console.log(id);
            $.post( targetUrl, sendData).done( function( resp ) { 
                console.log("resp="+resp);
                if (resp) {
                    $('.month').show();
                    $('#is_month').val(1);
                } else {
                     $('.month').hide();
                     $('#is_month').val(0);
                }
            });
        });    

        $(document).on('click', '#add', function(){
            var headId = $('#headId').val();
            var string = $("#headId option:selected").text();
            var headInfo = string.split('->');
            var is_month = $('#is_month').val();
            var headName = headInfo[0];
            var month_id = 0
            if (is_month == 1) {
                var month_id = $('#month').val();
                if (!month_id) {
                    alert('Please, select a month...');
                    return false;
                }
                var month_name = $('#month option:selected').text();
                var headName = headName+"->"+month_name;
                
            }
            
            var row = '';
            row += '<tr class="success">';
            row +='<td>'+headName+'<input type="hidden" name="headId[]" value="'+headId+'"><input type="hidden" name="month_id[]" value="'+month_id+'"></td>';
            row +='<td>'+headInfo[1]+'<input type="hidden" name="amount[]" id="amount" value="'+headInfo[1]+'"></td>';
            row +='<td><button class="remove"><i class="fa fa-times"></i></button></td>';
            row += '</tr>';
            $('#payment_detail').append(row);
            total(headInfo[1]);
            
        }); 

        $(document).on('click','.remove', function() {
            $(this).closest('tr').remove();
            total();
        });  

        function total(amount = 0)
        {
            total_amount = 0;
            $('#payment_detail #amount').each(function(){
                console.log('dd'+$(this).val());
                total_amount += parseFloat($(this).val());
            });
            $('#total_amount').val(total_amount);
            netPayment(total_amount, 0);
            due(0);
        } 

        function netPayment(total_amount = 0, fine_amount = 0 ){
            var discount = parseFloat($('#net_discount').val());
           
            if (!fine_amount) {
                var fine_amount = parseFloat($('#fine_amount').val());
            }
             if (isNaN(fine_amount)) {
                var fine_amount = 0;
            }
            var fine_amount = parseFloat(fine_amount);
            var total_amount = parseFloat(total_amount);
            if (isNaN(discount)) {
                var discount = 0;
            }
            
            var tot_amount = parseFloat(total_amount + fine_amount);
            var net_amount = parseInt(tot_amount - discount);
            console.log('total_amount'+ typeof total_amount);
            console.log('fine_amount'+ typeof fine_amount);
            console.log('tot_amount'+ typeof tot_amount);
            $('#net_amount').val(net_amount);
        }

        function due(paid_amount = 0)
        {
           // console.log('d'+paid_amount);
            if (!paid_amount) {
                var paid_amount = parseInt($('#paid_amount').val());
            }
            if (isNaN(paid_amount)) {
                var paid_amount = 0;
            }

            var net_amount = parseFloat($('#net_amount').val());
            var due = parseInt(net_amount - paid_amount);

            if (isNaN(due)) {
                var due = 0;
            }
            $('#due').val(due);
        } 

        $(document).on('keyup', '#paid_amount', function(){
                paid_amount = parseFloat($(this).val());
                var net_amount = parseFloat($('#net_amount').val());
                due(paid_amount);
                if (paid_amount > net_amount) {
                    $(this).val(net_amount);
                    $('#due').val(0);
                }
            });

        $(document).on('change', '#discount', function(){
            var id = $(this).val();
            var total_amount = parseFloat($('#total_amount').val());
            var targetUrl = 'http://localhost/aminur/systemaccess/student_payment/getDiscountInfo';
            var sendData = {id:id,total_amount:total_amount};
           // console.log(id);
            $.post( targetUrl, sendData).done( function( resp ) { 
                 //console.log("resp="+resp);
                 //var net_amount = parseInt(total_amount - resp);
                 $('#net_discount').val(resp);
                 $('#paid_amount').val(0);
                 netPayment(total_amount, 0);
                // $('#net_amount').val(net_amount);
                 due(0);
            });
        });

        $(document).on('change', '#payment_type', function(){
            var id = $(this).val();
            if (id == 1 || !id) {
                $('.mb_name, .at_no').hide();
            } else {
                 $('.mb_name, .at_no').show();
            }
        });
        $(document).on('change', '#fine_id', function(){
            var id = $(this).val();
            if (id) {
                $('#fine_amount').prop('disabled', false);
                $('#fine_amount').val(0);
                var total_amount = parseFloat($('#total_amount').val());
                netPayment(total_amount, 0);
                due(0);
            } else {
                $('#fine_amount').prop('disabled', true);
            }
        });

        $(document).on('keyup', '#fine_amount', function(){
            var fine_amount = $(this).val();
            var total_amount = parseFloat($('#total_amount').val());
            netPayment(total_amount, fine_amount);
            due(0);
        });
    </script>
</div><!-- PAGE CONTENT ENDS -->



