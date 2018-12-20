<style>
    .center_border{
        border: 2px solid #D8D8D8;
        padding: 4px;
        text-align: center;
        vertical-align: middle;
    }
    .red{color: red;font-weight: bold;}
    .black{color: red;font-weight: bold;}
    .color_green{color:green !important;font-weight: bold;}
    .color_blue{color:blue !important;font-weight: bold;}
    .color_red{color:red !important;font-weight: bold;}
    .color_royalblue{color:royalblue !important;font-weight: bold;}
    .green{color:green;font-weight: bold;}
    .gradeView tr td{
        padding: 0px; border: 1px solid #cccccc; text-align: center
    }
    .detailsTable tr th{
        border: 2px solid #cccccc; padding: 4px; text-align: center
    }

</style>

<div class="page-header">

    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
        <span class="btn btn-purple no-border">
            <i class="ace-icon fa fa-print bigger-130"></i>
            <span class="bigger-110">Print</span>
        </span>
    </button>
</div><!-- /.page-header -->


<div id="printableArea" >
     <?php
     $count=0;
         foreach($studentinfo as $info)
         {
         ++$count;
     ?>
    <div style="margin: 10px auto; width: 910px;  border: 3px solid #cccccc;<?php if($count%2==0){echo 'page-break-after:always;';}?>;margin-top: 50px;margin-bottom: 80px;" >
        <div style=" border: 1px solid #d9d9d9; height: 630px;">      
            <div>   
                <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                    <tr style=" font-family: cambria;"> 
                        <td style="text-align: center;">
                            <p style="float: center;
                               height: 0px;
                               margin-left: 60px;">
                               
                                  <div class="pull-center"><img src="  
                                    <?php echo base_url().$institute_details[0]['logo'];?>" height="70px" width="auto" alt="0"/>
                                </div>
                            <div align="center">
                                <div style="font-size: 20px; font-size: 30px; color: royalblue;">   
                                    <b class="blue"><?php echo $institute_details[0]['instituteName'];?></b>
                                </div>   
                                <div style="font-size: 20px; font-size: 18px; ">   
                                    <?php echo  $institute_details[0]['town'].", ".$institute_details[0]['city'].", ".$institute_details[0]['disname']; ?>
                                </div>  
                            </div>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
                
                    <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 2px">
                        <tr>
                            <td style="text-align: center; "> 
                            <h4 class="green" style="font-family: Algerian;">ADMIT CARD for&nbsp;<?php echo getSemesterName($semester_type);?><strong>'</strong><?php echo $other_basic_info[0]['session'];?></h4> 
                            </td> 
                        </tr>
                    </table> 

                    <table style="width:100%; height:41px; border-bottom:2px solid #ddd; margin-bottom: 2px">
                        <tr>
                            <td style="text-align: center; font-size: 16px; "><strong>Class<strong>:</strong> 		 <?php echo $other_basic_info[0]['programName'];?><strong>,</strong>&nbsp;
                                	<strong>Medium<strong>  : </strong><?php echo $other_basic_info[0]['mediumName'];?><strong>,</strong>&nbsp;
                                	<strong>Shift<strong>  : </strong><?php echo $other_basic_info[0]['shiftName'];?><strong>,</strong>&nbsp;
                                	<strong>Group<strong>  : </strong><?php echo $other_basic_info[0]['groupName'];?><strong>,</strong>&nbsp;
                                	<strong>Section<strong>  : </strong><?php echo $other_basic_info[0]['sectionName'];?><!--<strong>,</strong>&nbsp;
                                	<strong>Session<strong>  : </strong><?php //echo $other_basic_info[0]['session'];?>-->
                                </td>
                            </td> 
                        </tr>
                    </table>         

                    <div style='background: #fff none repeat scroll 0 0;
                         border: 4px solid #eeeef3;
                         float: right;
                         height: 184px;
                         margin-left: 9px;
                         margin-top: -49px;
                         width: 160px;text-align: center;'>
                         <img src="<?php echo base_url().$info['photo'];?>"
                           alt="Student Photo" width="150px" height="175px" align="middle" style="padding-top:1px;">
                    </div>
                    <div style="margin-left: 700px;margin-top: 145px;">
                        <center>
                             <span  style="font-size: 16px;margin-top: 10px;">
                               <b class="green">Id:&nbsp;<?php echo $info['studentId'];?> </b>
                             </span><br/>
                             <span  style="font-size:16px;margin-top: 3px;">
                               <b class="blue"><?php echo $info['firstName'];?></b>
                             </span><br/>
                             <span  style="font-size:14px;margin-top: 3px;">
                               <b class="red"><?php echo 'Roll No. '.$info['roll_no'];?></b>
                             </span>
                        </center>
                    </div>
                        <table style="width:78%; font-size: 12px; margin-top: -205px; float: left; padding: 4px; margin-right: 14px; border-collapse: collapse;margin-left: 2px;border: 4px solid #eee; margin-right: 4px;border: 4px solid #eee; ">

                        <tr collpsan="2">
                            <td colspan="5" style="width:85%; border: 4px solid #blue; text-align: center;font-size: 16px;"><b>EXAM ROUTINE</b>
                            </td>
                        </tr>
                        
                        <tr >
                            <td width="5%" style=" border: 2px solid #cccccc; text-align: left;font-size: 16px;" ><p class="blue" style="text-align: center;">Date</p></td>
                            <td width="12%" style=" border: 2px solid #cccccc; text-align: left;font-size: 16px;" ><p class="blue" style="text-align: center;">Subject Name</p></td>
                            <td width="4%" style=" border: 2px solid #cccccc; text-align: left;font-size: 16px;" ><p class="blue" style="text-align: center;">Subject Code</p></td>
                            <td width="6%" style=" border: 2px solid #cccccc; text-align: left;font-size: 16px;" ><p class="blue" style="text-align: center;">Time</p></td>
                            <td width="5%" style=" border: 2px solid #cccccc; text-align: left;font-size: 16px;" ><p class="blue" style="text-align: center;">Room No.</p></td>
                        </tr>
                        <?php 
                        foreach($exam_routine as $routine){?>
                        <tr>
                            <td style=" border: 2px solid #cccccc; text-align: left;font-size: 14px;">    
                                 <?php echo $routine['date'];?>
                            </td>
                            <td style=" border: 2px solid #cccccc; text-align: left;font-size: 14px;">    
                                <?php echo $routine['courseName'];?>
                            </td>
                            <td style=" border: 2px solid #cccccc; text-align: center;font-size: 14px;">    
                                <?php echo $routine['courseCode'];?>
                            </td>
                            <td style=" border: 2px solid #cccccc; text-align: left;font-size: 14px;">    
                                 <?php echo $routine['examtime'];?>
                            </td>
                            <td style=" border: 2px solid #cccccc; text-align: center;font-size: 14px;">    
                                 <?php echo $routine['room'];?>
                            </td>
                        </tr>
                        <?php }?>
                    </table>

                        <!--<div  style='background:  none repeat scroll 0 0;
                             border: 3px solid #eeeef3;
                             float: left;
                             height: auto;
                            /* margin-left: 411px;*/
                             font-size: 15px;
                             margin-top: -147px;
                             width: 212px;'><b class="red">Exam :&nbsp;<?php //echo getSemesterName($semester_type);?></b>
                             </div>

                    </div>-->
                    
                    <!--<table  style="width:24%; /*float: left;*/ padding: 4px; border: 4px solid #eee; margin-right: 1px; border-collapse: collapse;margin-left:421px;margin-top: -225px; height: 145px;">

                            <tr collpsan="2">
                                <td colspan="2" style=" border: 1px solid #cccccc; text-align: center">Enroll Information</td>
                            </tr>
                            
                            <tr >
                                <td style=" border: 1px solid #cccccc; text-align: left">Class<strong>  : </strong> </td>
                                <td style=" border: 1px solid #cccccc; text-align: left">
                                    <?php //echo $other_basic_info[0]['programName'];?>
                                </td>

                            </tr>
                            <tr >
                                <td style=" border: 1px solid #cccccc; text-align: left">Medium<strong>  : </strong> </td>
                                <td style=" border: 1px solid #cccccc; text-align: left">
                                   <?php //echo $other_basic_info[0]['mediumName'];?>
                                </td>

                            </tr>
                            <tr>
                                <td style=" border: 1px solid #cccccc; text-align: left"> 
                                    Shift<strong>  : </strong>                                        
                                </td>
                                <td style=" border: 1px solid #cccccc; text-align: left">    
                                    <?php //echo $other_basic_info[0]['shiftName'];?>
                                </td>

                            </tr>
                            <tr>
                                <td style=" border: 1px solid #cccccc; text-align: left"> 
                                    Group<strong>  : </strong>                                    
                                </td>
                                <td style=" border: 1px solid #cccccc; text-align: left">    
                                    <?php //echo $other_basic_info[0]['groupName'];?>
                                </td>

                            </tr>

                            <tr>
                                <td style=" border: 1px solid #cccccc; text-align: left"> 
                                    Section<strong>  : </strong>                                         
                                </td>
                                <td style=" border: 1px solid #cccccc; text-align: left">    
                                    <?php //echo $other_basic_info[0]['sectionName'];?>
                                </td>
                            </tr>
                            <tr >
                                <td style=" border: 1px solid #cccccc; text-align: left">Session<strong>  : </strong> </td>
                                <td style=" border: 1px solid #cccccc; text-align: left">
                                    <?php //echo $other_basic_info[0]['session'];?>
                                </td>

                            </tr>-->



                        </table>

                         <div style='
                         float: right;
                         height: auto;
                         margin-right: -50px;
                         margin-top: 87px;
                         margin-left: 35px;
                         text-decoration: overline;
                         width: 201px;'>
                         <img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/ec.png"; ?>">
                         Authorized Signature
                     </div>

                     </table>
                         <style="font-family:Segoe UI Semibold; text-align:center;"> Admit Card generated by:&nbsp;&nbsp;<style= class="color_red" style=" font-family: century gothic;"> aims &nbsp;<style= class="color_blue" style=" font-family: century gothic;">||&nbsp;<style= class="color_green" style= "font-family:Segoe UI Semibold;"> Powerd by:&nbsp;&nbsp;<style=  class="color_green" style=  " font-family: Segoe UI Semibold;">www.adventure-soft.com<style=" font-family: Segoe UI Semibold;"></h6>
                     </div>

                   <!-- <div style='
                         float: left;
                         height: auto;
                         margin-right: 80px;
                         margin-top: 50px;
                         margin-left: 35px;
                         text-decoration: overline;
                         width: 201px;'>
                         Student Signature
                     </div>-->

                   
                </div>

            </div>
              
             <?php }?>
        </div>
<!-- Right Side/Main Content End --> 







