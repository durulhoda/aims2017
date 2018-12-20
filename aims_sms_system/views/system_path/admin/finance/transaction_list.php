<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
           Finance
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                All Transaction Information
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
            <form class="form-horizontal"  action="<?php echo admin_Url(); ?>/financehead/financesearch" method="post" role="form">
                <div class="col-xs-12 col-sm-12">

                    <div class="col-xs-6 col-sm-3">
                        <label class="control-label" for="form-field-1">From Date &nbsp; <?php echo form_error('data[from_date]', '<span class="successMessage">', '</span>'); ?></label>
                        <div class="input-group input-group-sm">
                            <input class="form-control date-picker" id="id-date-picker-1" placeholder="dd/mm/yyyy" name="data[from_date]" value="<?php echo set_value("data[from_date]"); ?>" type="text" id="form-field-mask-1" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <label class="control-label" for="form-field-1">To Date &nbsp; <?php echo form_error('data[to_date]', '<span class="successMessage">', '</span>'); ?></label>
                        <div class="input-group input-group-sm">
                            <input class="form-control date-picker" id="id-date-picker-1" placeholder="dd/mm/yyyy" name="data[to_date]" value="<?php echo set_value("data[to_date]"); ?>" type="text" id="form-field-mask-1" />
                            <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                        </div>
                    </div>
                     <div class=" col-xs-6 col-sm-3">
                         <label class="control-label" for="form-field-1">Transaction Category  &nbsp; <?php echo form_error('data[financeCategory]', '<span class="successMessage">', '</span>'); ?></label>
                         <select  data-placeholder="Select" name="data[financeCategory]"  class="form-control">
                             <option value="">Select</option>
                             <option value="1">Income</option>
                             <option value="2">Expenses</option>
                             <option value="3">Liabilities</option>

                         </select>
                     </div>
                    <div class=" col-xs-6 col-sm-3">
                         <label class="control-label" for="form-field-1">Transaction Head  &nbsp; <?php echo form_error('data[financeHead]', '<span class="successMessage">', '</span>'); ?></label>
                         <select data-placeholder="Select" name="data[financeHead]"  class="form-control">
                             <option value="">Select</option>
                              <?php foreach (getIncomeHeadCategoryList() as $values) { ?>
                                 <option value="<?php echo $values['id']; ?>" 
                                         <?php echo set_select('data[financeHead]', $values['id'], FALSE) ?>>
                                             <?php echo $values['headcategory']; ?>
                                 </option>
                             <?php } ?>

                         </select>
                    </div>  

                </div>
                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" type="submit" name="btnSubmit"> Search Transaction Information  </button>
                        </div>
                    </div>
                </div>
            </form>   
    
              <?php
                if(!empty($headlist))
                {
              ?>
            



            <div id="printDIV" >     
<h4 class="lighter block green">Transaction History of <small  class="pink"><?php echo $from_date;?>  </small>- <small  class="pink"> <?php echo $to_date?></small>

                        <h3 class="header smaller lighter blue">     </h3>
</h4>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                      
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                    <tr>                                
                                        <th>Sl No.</th>
                                        <th>Finance Head</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Action</th>

                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sl=1;
                                        foreach($headlist as $value)
                                        {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>                                        
                                        <td> 
                                            
                                         <?php 
                               
                                ?>
                                        <?php echo getIncomeHeadCategoryName ($value['financeHead'])?>
                                        </td>
                                       
                                          <td> <?php echo $value['addDate']; ?></td> 
                                           <td>
                                              <?php
                                                       if (!empty($value['debit'])) {
                                                           echo $value['debit'];
                                                       }
                                                       elseif
                                                           (!empty($value['credit'])) {
                                                           echo $value['credit'];
                                                           }
                                                      
                                               ?>
                                           </td>
                                        <td> <?php echo $value['details']; ?></td>
                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                 <a href="<?php echo admin_Url();?>/financehead/editfinancedata/<?php echo $value['financeId']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url();?>/financehead/deletefinancedata/<?php echo $value['financeId']; ?>" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/financehead/editfinancedata/<?php echo $value['financeId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/financehead/deletefinancedata/<?php echo $value['financeId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                      
                                    </tr>
                                     <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                 
                </div><!-- /.span -->
            
            </div><!-- /.row -->
            </div>
          <button style='margin: 10px 45%;' onclick="javascript:printDiv('printDIV')" type="button" class="btn btn-success"> 
        <i class="ace-icon fa fa-print"></i>
        PRINT </button>
                    <?php
               }
           ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
    
    
    
    
    
    