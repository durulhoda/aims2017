<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
    Payment
     <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Due Payment
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



    <!-- div.table-responsive -->


    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form  action="<?php echo admin_Url(); ?>/payments/duesearch" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Session :&nbsp;</label>
                    <select class="col-xs-10 col-sm-2" name="data[sessionId]"  required="">
                        <option value="">Select</option>
                        <?php foreach (getOfferedSession() as $value) { ?>
                            <option value="<?php echo $value['sessionId']; ?>" 
                                    <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                <?php echo $value['session']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student ID : </label>
                    <input type="text" id="form-field-1" name="data[studentId]" placeholder="Student ID" class="col-xs-10 col-sm-2" />
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-search bigger-110"></i>
                            Search
                        </button>


                    </div>
                </div>
            </form>
            
            
  <div class="row">
    
    <div class="col-sm-4">
              <?php
        if (!empty($feeslist)) {
            ?> 
        <div class="widget-box">
              
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-user"></i>&nbsp;
                    Student Short Profile
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    
             
                    
                    
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
                    
                  
     <?php
        
    }
    ?> 
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">       

        <div class="row">
              <?php
                                if (!empty($feeslist)) {
                                    ?>
            <div class="col-xs-12">
               <div class="widget-box">
                   
                        <div class="widget-body">
                            <div class="widget-main row ">
         
                 <div class="col-xs-12">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                               <tr> 
                                <th>Sl no.</th>
                                <th>Session</th>
                                <th>Date</th>
                                <th>Payment Head</th>
                                <th>Payable Amount</th>
                                <th>Payment Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                <?php
                                $sl=1;
                                $fineamount=0;
                                foreach ($feeslist as $value) {
                                    ?>
                                    <tr>
                                        
                                        <td>
                                            <?php echo $sl++; ?>
                                        </td>
                                        <td>
                                            <?php echo getSessionName($info['sessionId']); ?>
                                        </td>
                                        <td><?php echo $value['created_at'] ?></td>
                                        <td>
                                                <?php
                                                if (!empty($value['headId'])) {
                                                    echo getPaymentHeadName($value['headId']);
                                                }
                                                ?>
                                        </td>
                                        
                                        <td>
                                           <?php echo $value['amount']; ?>
                                        </td>
                                        
                                         <?php
                                        if (!getStudentpaymentList($studentId, $value['headId'], $info['sessionId'], 1)) {
                                            ?>
                                      
                                        <td>
                                                    Not Paid
                                                </td>  
                                                <?php
                                            } else {
                                                ?>

                                                <td>
                                                    Paid
                                                    </td>
                                                 
                                                <?php
                                            }
                                            ?>
                                       
                                    </tr>
                                    
                                   
                                    <?php
                                   // $fineamount=$famount+$fineamount;
                                }
                                ?>
                                    
                                   <?php $fineamount=0;
                                foreach ($finelist as $value){
                                                ?>

                                        <tr>
                                            <td><?php echo $sl++; ?>   </td>
                                            <td> <?php echo getSessionName($info['sessionId']); ?></td>
                                            <td> <?php echo $value['date'] ?> </td>
                                            <td>
                                                        <?php
                                                        if (!empty($value['finehead'])) {
                                                            echo isset($finecauselist[$value['finehead']]) ? $finecauselist[$value['finehead']] : "";
                                                        }
                                                        ?>
                                            </td>
                                            <td><?php echo $famount= $value['amount']; ?></td>
                                            <?php
                                        if (!getStudentpaymentList($studentId, $value['finehead'], $sessionId, 2)) {
                                            ?>
                                            <td>
                                               Not Paid
                                            </td>  
                                            <?php
                                        } else {
                                            ?>

                                            <td>
                                                 Paid
                                                
                                            </td>  
                                            <?php
                                        }
                                        ?>
                                               
                                        </tr>
                                                        <?php
                                                        $fineamount=$famount+$fineamount;
                                                            }
                                                    ?>   
                            
                       
                            <tr>  
                                
                                
                              
                              

                            </tbody>
                        </table>
                     
                     <button class="btn btn-danger btn-block">Total Due : <?php echo ($totalfees + $fineamount) - ($totalamount + $tot_discount); ?> /- </button>

                    </div><!-- /.span -->
                    <?php
                                }
                                ?>
               
                            </div>
                            

                        </div>
                        
                    </div>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->









