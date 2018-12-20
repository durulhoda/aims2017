<div class="page-header">

    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
        <span class="btn btn-purple no-border">
            <i class="ace-icon fa fa-print bigger-130"></i>
            <span class="bigger-110">Print</span>
        </span>
    </button>
</div><!-- /.page-header -->

<div id="printableArea" >
     <?php foreach($studentinfo as $info){?> 
    <div style="margin: 10px auto; width: 450px;" > 
        <div style=" border: 1px solid #d9d9d9; height: 153px;">      
            <div>   
                <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                    <tr style=" font-family: cambria;"> 
                        <td style="text-align: center;">
                            <p style="float: left;
                               height: 40px;
                               margin-left:50px;">
                               
                                  <div class="pull-left" style="font-size: 10px;margin-top: 2px; font-size: 15px; color: royalblue;"><img src="  
                                    <?php echo base_url().$institute_details[0]['logo'];?>" height="40px" width="50px" alt="Institute Logo"/>
                                </div>
                            <div align="center">
                                <div style="font-size: 15px; color: royalblue;">   
                                   <b class="blue"> <?php echo $institute_details[0]['instituteName'];?></b>
                                </div>   
                                <div style="font-size: 13px;">   
                                    <?php echo $institute_details[0]['town'] . ", " . $institute_details[0]['city'].", ".$institute_details[0]['disname']; ?>
                                </div>  
                            </div>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        <div>

            <img src="<?php echo base_url().$info['photo'];?>" alt="Student Photo" width="60px" height="120px" align="middle" style="padding-top:60px;padding-left: 3px;margin-top: -50px;">
        </div>
            <div style="margin-left: 85px;margin-top: -77px;">
                           <table>
                            <tr>
                                <td>
                                     <span style="font-size: 10px; float: right;">ID<strong>  : </strong>
                                    </span>                                       
                               
                                </td>
                                <td>
                                    <span style="font-size: 10px;">
                                        <b class="red">&nbsp;&nbsp;&nbsp;<?php echo $info['applicationId'];?> </b>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 10px; float: right;">Name  <strong>  : </strong></span>
                               </td>
                               <td>
                                    <span style="font-size: 10px;  margin-top: 2px;">
                                        <b class="green">&nbsp;&nbsp;&nbsp;<?php echo $info['firstName'];?></b>
                                    </span>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 10px; float: right;">Class  <strong>  : </strong></span>
                                </td>
                                <td>
                                    <span style="font-size: 10px;  margin-top: 2px;">
                                        <b class="green">&nbsp;&nbsp;&nbsp;<?php echo $other_basic_info[0]['programName'];?></b>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 10px; float: right;">Group  <strong>  : </strong></span>
                                </td>
                                 <td>   
                                    <span style="font-size: 10px;  margin-top: 2px;">
                                        <b class="green">&nbsp;&nbsp;&nbsp;<?php echo $other_basic_info[0]['groupName'];?></b>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 10px; float: right;">Session  <strong>  : </strong></span>
                               </td>
                               <td>
                                    <span style="font-size: 10px;  margin-top: 2px;">
                                        <b class="green">&nbsp;&nbsp;&nbsp;<?php echo $other_basic_info[0]['session'];?></b>
                                    </span>
                               </td>
                            </tr>
                    </table>
            </div>

                    <div style='
                         float: right;
                         height: auto;
                         font-size: 10px;
                         margin-right: -41px;
                         margin-top: -12px;
                         margin-left: -60px;
                         text-decoration: overline;
                         width: 143px;'>
                         Authorized Authority
                     </div>
                    <div style='
                         float: right;
                         height: auto;
                         font-size: 10px;
                         margin-right: 0px;
                         margin-top: -12px;
                         margin-left: 65px;
                         text-decoration: overline;
                         width: 143px;'>
                       Validation Date
                     </div>
                    
                </div>

            </div>
            <br/>
             <br/>
              
             <?php }?>
        </div>
<!-- Right Side/Main Content End --> 







