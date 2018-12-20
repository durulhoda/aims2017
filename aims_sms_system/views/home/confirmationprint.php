

<div class="page-header">

    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
        <span class="btn btn-purple no-border">
            <i class="ace-icon fa fa-print bigger-130"></i>
            <span class="bigger-110">Print or Save</span>
        </span>
    </button>
</div><!-- /.page-header -->


<div id="printableArea" > 
    <div style="margin: 10px auto;  width: 850px; border: 0px solid #cccccc; " > 
        <div style=" border: 1px solid #d9d9d9;">      
            <div >   
                <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">                                
                    <tr style=" font-family: cambria;"> 
                        <td style="text-align: center;">
                            <p style="float: left;
                               height: 90px;
                               margin-left: 60px;">
                               <?php
                               $ins_info = getInstituteInfo();
                               ?>                                           

                                <img style="margin-top:-8px; width: 51%; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="60">     
                                <br>   
                            <div style="float: left;">
                                <div style="font-size: 28px; color: royalblue;">   
                                    <?php
                                    $ins_name = getInstituteInfo();
                                    echo $ins_name['instituteName'];
                                    ?>
                                </div>   
                                <div style="font-size: 18px; ">   
                                    <?php echo $ins_info['town'] . ", " . $ins_info['city']. ", " . $ins_info['district_name']; ?>
                                </div>                                          

                            </div>
                            </p>

                        </td>


                    </tr>
                </table>
                <table style="width:100%; border-bottom: 1px solid #ddd; margin-bottom: 1px">                                

                    <tr> <td style="text-align: center; "> <h4 style="font-family: Algerian;">Applicant Confirmation Slip</h4> </td> </tr>

                </table>         

                <div style='background: #fff none repeat scroll 0 0;
                     border: 4px solid #eeeef3;
                     float: left;
                     height: 208px;
                     margin-left: 9px;
                     margin-top: 7px;
                     width: 160px; text-align: center;'>
                     <?php
                     if ($photo) {
                         ?>
                        <img  src="<?php
                        if (file_exists($photo)) {
                            echo base_url() . $photo;
                        } else {
                            echo base_url() . "uploads/default/default.png";
                        }
                        ?>" width="152" height="162" align="middle">
                              <?php
                          }
                          ?> 

                </div>
                <div style='margin: 10px 10px 20px; font-family: cambria; height: 170px; width:98%; border:0px solid red;'>


                    <table style="border: 4px solid #eee;
                           float: left;
                           line-height: 12px;
                           margin-left: 9px;
                           width: 50%;">
                        <tr>
                            <td style="text-align: left; ">    <span style="font-size: 16px; float: left;">  Applicant ID<strong>  : </strong>  </span>                                       
                            </td>
                            <td>   
                                <span style="font-size: 16px;">
                                    <strong><?php echo $applicationId; ?> </strong>
                                </span>

                            </td>
                        </tr>

                        <tr style="line-height: 20px;">
                            <td style="text-align: left; margin-top: 2px; ">
                                <span style="font-size: 16px; float: left;">Applicant Name  <strong>  : </strong></span>                                       
                            </td>
                            <td>   
                                <span style="font-size: 16px;  margin-top: 1px;">
                                    <strong><?php
                                        if (!empty($firstName)) {
                                            echo $firstName;
                                        }
                                        ?> </strong>
                                </span>

                            </td>
                        </tr>  
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 16px; float: left;">Date Of Birth <strong>  : </strong>  </span>                                        
                            </td>

                            <td> 
                                <span style="font-size: 16px;  margin-top: 1px;">
                                    <strong><?php
                                        if (!empty($dateOfBirth)) {
                                            echo $dateOfBirth;
                                        }
                                        ?> </strong>
                                </span>
                            </td>

                        </tr> 
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 16px; float: left;">Gender <strong>  : </strong> </span>                                        
                            </td>

                            <td> 
                                <span style="font-size: 16px;  margin-top: 1px;">
                                    <strong><?php
                                        if (!empty($gender)) {
                                            if ($gender == '1') {
                                                echo "Boy";
                                            } else {
                                                echo "Girl";
                                            }
                                        }
                                        ?> </strong>
                                </span>
                            </td>

                        </tr> 
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 16px; float: left;">Religion <strong>  : </strong>  </span>                                        
                            </td>

                            <td> 
                                <span style="font-size: 16px;  margin-top: 2px;">
                                    <strong>
                                        <?php
                                        if (!empty($religion)) {
                                            echo element($religion, getReligion(), Null);
                                        }
                                        ?>
                                    </strong>
                                </span>
                            </td>

                        </tr> 
                        <tr>
                            <td style="text-align: left; "><span style="font-size: 16px; float: left;">Blood Group <strong>  : </strong> </span>                                        
                            </td>

                            <td> 
                                <span style="font-size: 16px;  margin-top: 2px;">
                                    <strong>
                                        <?php
                                        if (!empty($bloodGroup)) {
                                            echo element($bloodGroup, getBloodGroup(), Null);
                                        }
                                        ?>
                                    </strong>
                                </span>
                            </td>

                        </tr> 

                    </table>

                    <table style="width:28%; float: right; padding: 10px; border: 4px solid #eee; margin-right: 8px; border-collapse: collapse; ">

                        <tr collpsan="2">
                            <td colspan="2" style=" border: 1px solid #cccccc; text-align: center">Class Information</td>
                        </tr>
                        <tr >
                            <td style=" border: 1px solid #cccccc; text-align: left;">Class<strong>  : </strong> </td>
                            <td style=" border: 1px solid #cccccc; text-align: left;">


                                <?php if (!empty($datax['programId'])) { ?>
                                    <p>
                                        <?php echo getProgramName($datax['programId']); ?>
                                    </p>
                                <?php } ?>
                            </td>

                        </tr>
                        <tr>
                            <td style=" border: 1px solid #cccccc; text-align: left;"> 
                                Shift<strong>  : </strong>                                        
                            </td>
                            <td style=" border: 1px solid #cccccc; text-align: left;">    
                                <?php if (!empty($datax['shiftId'])) { ?>
                                    <p>
                                        <?php echo getshiftName($datax['shiftId']); ?>
                                    </p>
                                <?php } ?>
                            </td>

                        </tr>
                        <tr>
                            <td style=" border: 1px solid #cccccc; text-align: left;"> 
                                Group<strong>  : </strong>                                    
                            </td>
                            <td style=" border: 1px solid #cccccc; text-align: left;">    
                                <?php if (!empty($datax['groupId'])) { ?>
                                    <p>
                                        <?php echo getGroupName($datax['groupId']); ?>
                                    </p>
                                <?php } ?>
                            </td>

                        </tr>

                        <tr>
                            <td style=" border: 1px solid #cccccc; text-align: left;"> 
                                Session<strong>  : </strong>                                         
                            </td>
                            <td style=" border: 1px solid #cccccc; text-align: left;">    
                                <?php if (!empty($datax['sessionId'])) { ?>
                                    <p>
                                        <?php echo getSessionName($datax['sessionId']); ?>
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <table style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse; fo">

                    <p style="background: #eee; margin-top: 66px; text-align: center;">Contact Information</p>
                    <tr style="border: 1px solid #D8D8D8;">
                    <tr>
                        <td style="text-align: right;  width: 170px; ">Permanent Address :</td>
                        <td style="text-align: left;">
                            <p  rows="5" cols="30"><?php
                                if (!empty($permanentAddress)) {
                                    echo $permanentAddress;
                                }
                                ?></p>
                        </td>
                        <td style="text-align: right; width: 170px; ">Present Address :</td>
                        <td style="text-align: left;">
                            <p  rows="5" cols="30"><?php
                                if (!empty($presentAddress)) {
                                    echo $presentAddress;
                                }
                                ?></p>

                        </td>
                    </tr>

                    </tr>
                </table>

                <table style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse; fo">

                    <p style="background: #eee; margin-top: 8px; text-align: center;">Parent's Information</p>
                    <tr style="border: 1px solid #D8D8D8; " >
                        <td style=" width: 170px; border: 1px solid #D8D8D8; padding: 4px; text-align: left;">
                            Father's Name:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                if (!empty($fatherName)) {
                                    echo $fatherName;
                                }
                                ?> </strong>
                        </td>
                        <td style="border: 1px solid #D8D8D8; padding: 4px;  width: 170px; text-align: left;">
                            Mother's Name:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                if (!empty($motherName)) {
                                    echo $motherName;
                                }
                                ?> </strong>
                        </td>          

                    </tr>

                    <tr style="border: 1px solid #D8D8D8; " >
                        <td style=" width: 170px; border: 1px solid #D8D8D8; padding: 4px; text-align: left;">
                            Phone:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                if (!empty($fatherPhone)) {
                                    echo $fatherPhone;
                                }
                                ?> </strong>
                        </td>
                        <td style="border: 1px solid #D8D8D8; padding: 4px;  width: 170px; text-align: left;">
                            Phone:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                if (!empty($motherPhone)) {
                                    echo $motherPhone;
                                }
                                ?> </strong>
                        </td>          

                    </tr>

                    <tr style="border: 1px solid #D8D8D8; " >
                        <td style=" width: 150px; border: 1px solid #D8D8D8; padding: 4px; text-align: left;">
                            Profession:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                    if (!empty($applicantId["fatherProfession"])) {
                                        echo element($applicantId["fatherProfession"], getProfessionFather(), Null);
                                        }
                                    ?> </strong>
                        </td>
                        
                        <td style="border: 1px solid #D8D8D8; padding: 4px;  width: 150px; text-align: left;">
                            Profession:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                    if (!empty($applicantId["motherProfession"])) {
                                        echo element($applicantId["motherProfession"], getProfessionMother(), Null);
                                        }
                                    ?> </strong>
                        </td>
                    </tr>


                    <tr style="border: 1px solid #D8D8D8; " >
                        <td style=" width: 170px; border: 1px solid #D8D8D8; padding: 4px; text-align: left;">
                            NID:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                if (!empty($fnid)) {
                                    echo $fnid;
                                }
                                ?> </strong>
                        </td>
                        <td style="border: 1px solid #D8D8D8; padding: 4px;  width: 170px; text-align: left;">
                            NID:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                if (!empty($mnid)) {
                                    echo $mnid;
                                }
                                ?> </strong>
                        </td>          

                    </tr>
                    <tr style="border: 1px solid #D8D8D8;">
                        <td style=" width: 170px; border: 1px solid #D8D8D8; padding: 4px; text-align: left;">
                            Annual Income:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                                if (!empty($applicantId["fatherMonthlyIncome"])) {
                                    echo $applicantId["fatherMonthlyIncome"];
                                }
                                ?> </strong>
                        </td>
                       <!-- <td style="border: 1px solid #D8D8D8; padding: 4px;  width: 170px; text-align: right">
                            Mother's Monthly Income:
                        </td>

                        <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                            <strong><?php
                               // if (!empty($applicantId["motherMonthlyIncome"])) {
                                  //  echo $applicantId["motherMonthlyIncome"];
                               // }
                                ?> </strong>
                        </td>  -->    
                    </tr>
                </table>

                <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">  
                    <img src="<?php echo base_url(); ?>/images/Editing Cut.ico" style="margin-top: -12px; height: 26px; width: 37px; float:left;">   <div style=" border-bottom:2px dashed #000; margin-top: -25px;" > &nbsp; </div>
                </table>
                <div style="background: #fff; height: 480px;" >   
                    <table style="width:100%;">                                
                        <tr style=" font-family: cambria;"> 
                            <td style="text-align: center;">
                                <p style="float: left;
                                   height: 90px;
                                   margin-left: 60px;">
                                   <?php
                                   $ins_info = getInstituteInfo();
                                   ?>                                           

                                    <img style="margin-top:-8px; width: 51%; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">     
                                    <br>   
                                <div style="float: left;">
                                    <div style="font-size: 28px; color: royalblue;">   
                                        <?php
                                        $ins_name = getInstituteInfo();
                                        echo $ins_name['instituteName'];
                                        ?>
                                    </div>   
                                    <div style="font-size: 18px; ">   
                                    <?php echo $ins_info['town'] . ", " . $ins_info['city']. ", " . $ins_info['district_name']; ?>
                                    </div>                                          

                                </div>
                                </p>

                            </td>


                        </tr>
                    </table>
                    <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">                                

                        <tr> <td style="text-align: center; "> <h4 style="font-family: Algerian;">Admission Test- Admit Card</h4> </td> </tr>

                    </table>         

                    <div style='background: #fff none repeat scroll 0 0;
                         border: 4px solid #eeeef3;
                         float: left;
                         height: 214px;
                         margin-left: 9px;
                         margin-top: 1px;
                         width: 160px;text-align: center;'>
                         <?php
                         if ($photo) {
                             ?>
                            <img  src="<?php
                            if (file_exists($photo)) {
                                echo base_url() . $photo;
                            } else {
                                echo base_url() . "uploads/default/default.png";
                            }
                            ?>" width="152" height="162" align="middle">
                                  <?php
                              }
                              ?> 



                    </div>
                    <div style='margin: -1px 10px 20px; font-family: cambria; height: 170px; width:98%; border:0px solid red;'>


                        <table style="border: 4px solid #eee;
                               float: left;
                               line-height: 12px;
                               margin-left: 9px;
                               width: 50%;">


                            <tr>
                                <td style="text-align: left; ">    <span style="font-size: 14px; float: left;">  Applicant ID<strong>  : </strong>  </span>                                       
                                </td>
                                <td>   
                                    <span style="font-size: 14px;">
                                        <strong><?php echo $applicationId; ?> </strong>
                                    </span>

                                </td>
                            </tr>

                            <tr style="line-height: 30px;">
                                <td style="text-align: left; margin-top: 2px; ">
                                    <span style="font-size: 14px; float: left;">Applicant Name  <strong>  : </strong></span>                                       
                                </td>
                                <td>   
                                    <span style="font-size: 14px;  margin-top: 0px;">
                                        <strong><?php
                                            if (!empty($firstName)) {
                                                echo $firstName;
                                            }
                                            ?> </strong>
                                    </span>

                                </td>
                            </tr>  



                            <tr>
                                <td style="text-align: left; "><span style="font-size: 14px; float: left;">Date Of Birth <strong>  : </strong>  </span>                                        
                                </td>

                                <td> 
                                    <span style="font-size: 14px;  margin-top: 0px;">
                                        <strong><?php
                                            if (!empty($dateOfBirth)) {
                                                echo $dateOfBirth;
                                            }
                                            ?> </strong>
                                    </span>
                                </td>

                            </tr> 
                            <tr>
                                <td style="text-align: left; "><span style="font-size: 14px; float: left;">Gender <strong>  : </strong> </span>                                        
                                </td>

                                <td> 
                                    <span style="font-size: 14px;  margin-top: 0px;">
                                        <strong><?php
                                            if (!empty($gender)) {
                                                if ($gender = 1) {
                                                    echo "Boy";
                                                } else {
                                                    echo "Girl";
                                                }
                                            }
                                            ?> </strong>
                                    </span>
                                </td>

                            </tr> 

                        </table>

                        <table style="width:28%; float: right; padding: 10px; border: 4px solid #eee; margin-right: 8px; border-collapse: collapse; ">

                            <tr collpsan="2">
                                <td colspan="2" style=" border: 1px solid #cccccc; text-align: center">Class Information</td>


                            </tr>
                            <tr >
                                <td style=" border: 1px solid #cccccc; text-align: left;">Class<strong>  : </strong> </td>
                                <td style=" border: 1px solid #cccccc; text-align: left;">


                                    <?php if (!empty($datax['programId'])) { ?>
                                        <p>
                                            <?php echo getProgramName($datax['programId']); ?>
                                        </p>
                                    <?php } ?>

                                </td>

                            </tr>
                            <tr>
                                <td style=" border: 1px solid #cccccc; text-align: left;"> 
                                    Shift<strong>  : </strong>                                        
                                </td>
                                <td style=" border: 1px solid #cccccc; text-align: left;">    
                                    <?php if (!empty($datax['shiftId'])) { ?>
                                        <p>
                                            <?php echo getshiftName($datax['shiftId']); ?>
                                        </p>
                                    <?php } ?>
                                </td>

                            </tr>
                            <tr>
                                <td style=" border: 1px solid #cccccc; text-align: left;"> 
                                    Group<strong>  : </strong>                                    
                                </td>
                                <td style=" border: 1px solid #cccccc; text-align: left;">    
                                    <?php if (!empty($datax['groupId'])) { ?>
                                        <p>
                                            <?php echo getGroupName($datax['groupId']); ?>
                                        </p>
                                    <?php } ?>
                                </td>

                            </tr>

                            <tr>
                                <td style=" border: 1px solid #cccccc; text-align: left;"> 
                                    Session<strong>  : </strong>                                         
                                </td>
                                <td style=" border: 1px solid #cccccc; text-align: left;">    
                                    <?php if (!empty($datax['sessionId'])) { ?>
                                        <p>
                                            <?php echo getSessionName($datax['sessionId']); ?>
                                        </p>
                                    <?php } ?>
                                </td>

                            </tr>
                        </table>

                        <div style='background: #fff none repeat scroll 0 0;
                             border: 3px solid #eeeef3;
                             float: left;
                             height: auto;
                             margin-left: 9px;
                             margin-top: 7px;
                             width: 201px;'>Exam Date:  <?php
                             if (!empty($dataadmid['ExamDate'])) {
                                 echo $dataadmid['ExamDate'];
                             }
                             ?></div>

                        <div style='background: #fff none repeat scroll 0 0;
                             border: 3px solid #eeeef3;
                             float: left;
                             height: auto;
                             margin-left: 9px;
                             margin-top: 7px;
                             width: 201px;'>Exam Time:  <?php
                             if (!empty($dataadmid['ExamTime'])) {
                                 echo $dataadmid['ExamTime'];
                             }
                             ?>
                        </div>

                    </div>
                    <table style="width:49%; font-size: 12px; margin-top: 2px; float: right; padding: 0px; margin-right: 8px; border-collapse: collapse; ">

                        <tr collpsan="2">
                            <td colspan="4" style=" border: 1px solid #cccccc; text-align: center">Exam Marks (Total- <?php
                                if (!empty($dataadmid['total'])) {
                                    echo $dataadmid['total'];
                                }
                                ?> )</td>
                        </tr>
                        <tr >
                            <td style=" border: 1px solid #cccccc; text-align: center">Bangla </td>


                            <td style=" border: 1px solid #cccccc; text-align: center">English </td>
                            <td style=" border: 1px solid #cccccc; text-align: center">Mathmatics </td>
                            <td style=" border: 1px solid #cccccc; text-align: center">General Knowledge </td>
                        </tr>
                        <tr>

                            <td style=" border: 1px solid #cccccc; text-align: center">    
                                <?php
                                if (!empty($dataadmid['bangla'])) {
                                    echo $dataadmid['bangla'];
                                }
                                ?>
                            </td>
                            <td style=" border: 1px solid #cccccc; text-align: center">    
                                <?php
                                if (!empty($dataadmid['english'])) {
                                    echo $dataadmid['english'];
                                }
                                ?>
                            </td>
                            <td style=" border: 1px solid #cccccc; text-align: center">    
                                <?php
                                if (!empty($dataadmid['math'])) {
                                    echo $dataadmid['math'];
                                }
                                ?>
                            </td>
                            <td style=" border: 1px solid #cccccc; text-align: center">    
                                <?php
                                if (!empty($dataadmid['gk'])) {
                                    echo $dataadmid['gk'];
                                }
                                ?>
                            </td>

                        </tr>

                    </table>
                    <?php $rollNo = substr($applicationId,4); ?>
                    <div style='
                         float: left;
                         height: auto;
                         margin-left: 2px;
                         margin-top: 18px;
                         text-decoration: none;
                         width: 201px;'>Admission Test Roll:&nbsp;<strong><?php echo $rollNo;?></strong></div>

                    <div style='
                         float: right;
                         height: auto;
                         margin-right: -50px;
                         margin-top: 18px;
                         text-decoration: overline;
                         width: 201px;'>Exam Controller</div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<!-- Right Side/Main Content End --> 







