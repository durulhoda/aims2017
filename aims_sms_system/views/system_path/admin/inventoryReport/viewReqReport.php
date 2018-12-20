<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Inventory
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Inventory Required Report
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
 <div id="printDIV" >   
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
                            
                                
                                  <button  onclick="javascript:printDiv('printDIV')" type="button" class="btn btn-success"> 
        <i class="ace-icon fa fa-print"></i>
        </button>
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
    <div class="row">
                <div class="col-xs-12">
                    <div>
                      
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                    <tr>                                
                                        <th>Sl No.</th>
                                        <th>Date</th>
                                        <th>Item Head</th>
                                        <th>Inventory Name</th>
                                        <th>Item Piece</th>
                                        
                                         
                                          
                                      
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
                                
                                       
                                          <td> <?php echo $value['addDate']; ?></td> 
                                           <td>
                                             <?php if (!empty($value['categoryId'])) {
                                echo getinventorycategoryName($value['categoryId']);
                            } ?>
                                           </td>
                                           
                                                <td>
                                              <?php
                                                       if (!empty($value['inventoryName'])) {
                                                           echo $value['inventoryName'];
                                                       }
                                                      
                                                      
                                               ?>
                                           </td>
                                           
                                                <td>
                                              <?php
                                                       if (!empty($value['itemPiece'])) {
                                                           echo $value['itemPiece'];
                                                     
                                                       }
                                                      
                                               ?>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
    </div>
</div><!-- /.row -->