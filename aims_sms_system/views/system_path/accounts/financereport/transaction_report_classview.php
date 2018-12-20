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
                                    <span class="grey bigger-130"><?php echo $from_date_time; ?> <font color="red">To </font><?php echo $to_date_time; ?></span>
                                </div>
                            </center>

                            <div class="space"></div>

                            <div>          

                                <table class="table table-striped ">

                                    <thead>
                                        <tr>                                
                                            <th>Sl No.</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Payment Date</th>   
                                            <th>Paid Amount</th>                                              
                                        </tr>
                                    </thead>
                                    <?php
                                    $s = 1;
                                    $totalpaidamount = 0;

                                    foreach ($report_list as $value) {
                                          
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
                                                
                                                ?>

                                        <tr>
                                            <td class="center"><span class="blue bigger-150">Total Income </span></td>
                                            <td class="text-right"><span class="header bolder"> <?php echo $totalcredittotal = $credittotal + $totalpaidamount; ?></span></td>
                                        </tr>

                                    </tbody>
                                   
                                </table>


                                
                            </div>

                            <div class="hr hr8 hr-double hr-dotted"></div>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->