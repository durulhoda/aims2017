<style>
@page {
   size: 7in 9.25in;
   margin: 27mm 16mm 27mm 16mm;
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
     <?php foreach($studentinfo as $info){?> 
    <div style="margin: 10px auto; width: 500px;  border: 2px solid #cccccc; display: inline-block;" > 
        <div style=" border: 2px solid #d9d9d9; height: 300px;">      
            <div>   
                <span></span><table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                    <tr style=" font-family: cambria;"> 
                        <td style="text-align: center;">
                            <p style="float: left;
                               height: 60px;
                               margin-left: 40px;">
                            <div align="center">
                                <div style="font-size: 20px; font-size: 35px;">   
                                   <h4 ><b class="red"><?php echo $institute_details[0]['instituteName'];?></b> </h4>
                                </div>   
                                <div style="font-size: 20px; font-size: 18px; ">   
                                   <h5> <?php echo $institute_details[0]['town'] . ", " . $institute_details[0]['city'].", ".$institute_details[0]['disname']; ?> </h5>
                                </div>  
                            </div>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
                    <span style="width:100%; border-bottom: 1px solid #ddd; margin-bottom: 1px">
                            <h4 style="font-family: Algerian;text-align: center;"><b class="green">Exam:&nbsp;<?php echo getSemesterName($semester_type);?></b></h4> 
                    </span> 
                   
                    <div style='margin: -1px 10px 10px; font-family: cambria; height: 60px; width:98%; border:1px solid #E8E8E8;'>
                       
                        <div align="center">
                            <span><h5>ID : <b class="red"><?php echo $info['studentId'];?></b>, Roll No. : <b class="red"><?php echo $info['roll_no'];?></b></h5></span><p></p>
                            <span ><h4><b class="blue"><?php echo $info['firstName'];?></b></h4></span>
                        </div>
                    </div>
                    
                    <table  style="width:74%; float: left; border: 2px solid #eee; margin-right: 1px; border-collapse: collapse;margin-left:69px;margin-top: 0px; height: 35px;">
                            
                            <tr >
                                <td style=" border: 1px solid #cccccc; text-align: center"><b class="green">Class&nbsp;</b><b class="blue">:&nbsp;<?php echo $other_basic_info[0]['programName'];?></b> </td>

                                <td style=" border: 1px solid #cccccc; text-align: center"><b class="green">Medium&nbsp;</b><b class="blue">:&nbsp; <?php echo $other_basic_info[0]['mediumName'];?></b> </td>

                                <td style=" border: 1px solid #cccccc; text-align: center"><b class="green"> 
                                    Shift&nbsp;</b><b class="blue">:&nbsp;<?php echo $other_basic_info[0]['shiftName'];?></b>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style=" border: 1px solid #cccccc; text-align: center"><b class="green"> 
                                    Group&nbsp;</b><b class="blue">:&nbsp;<?php echo $other_basic_info[0]['groupName'];?></b>
                                </td>

                                <td style=" border: 1px solid #cccccc; text-align: center"><b class="green"> 
                                    Section&nbsp;</b><b class="blue">:&nbsp;<?php echo $other_basic_info[0]['sectionName'];?></b>
                                </td>

                                <td style=" border: 1px solid #cccccc; text-align: center"><b class="green">Session&nbsp;</b><b class="blue">:&nbsp;<?php echo $other_basic_info[0]['session'];?></b> </td>
                            </tr>
                        </table>
                        <!--<div style='background: #fff none repeat scroll 0 0;
                             border: 3px solid #eeeef3;
                             float: left;
                             height: auto;
                             margin-left: 165px;
                             margin-top: 7px;
                             font-size: 16px;
                             width: 201px;'><b class="green">Exam:&nbsp;<?php echo getSemesterName($semester_type);?></b>
                             </div>-->

                        

                         <div style='
                         float: right;
                         height: auto;
                         margin-right: -50px;
                         margin-top:50px;
                         margin-left: 15px;
                         text-decoration: overline;
                         width: 201px;'>
                         Exam Controller
                     </div>

                    <div style='
                         float: left;
                         height: auto;
                         margin-right: -50px;
                         margin-top:50px;
                         margin-left: 15px;
                         text-decoration: overline;
                         width: 201px;'>
                         Authorized Signature
                     </div>

                   
                </div>

            </div>
             <?php }?>
        </div>
<!-- Right Side/Main Content End --> 







