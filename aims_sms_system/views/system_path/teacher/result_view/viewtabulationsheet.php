<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Result Tabulation Sheet
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Generate Tabulation Sheet
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
        
        <?php
                if (!empty($studentlistdata)) {
                    $ins_logo=  getInstituteLogo();
            ?>
        <div class="col-xs-12 col-sm-12">
              
            <!-- div.dataTables_borderWrap -->
                 <div id="printDIV" >
                        
                        <div class="viewBox text-center fix" >
                                <div class="page-header">
                                    
                                        <h1>
                                            <img src="<?php if(file_exists($ins_logo)){ echo base_url().$ins_logo; } else{ echo base_url()."uploads/default/aims.png"; }?>" width="60">
                                           <strong> <?php echo  getInstituteName(); ?></strong>
                                            <small class="red">
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                Student Marks Tabulation Sheet
                                            </small>
                                        </h1>
                                    </div><!-- /.page-header -->   
                                <table id="simple-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">
                                                    Class :  <?php echo getProgramName($programId); ?> 
                                                </th>

                                                <th class="hidden-680">
                                                     Medium :  <?php echo getmediumName($mediumId); ?>  
                                                </th>
                                                <th class="hidden-680">
                                                    Shift :  <?php echo getshiftName($shiftId); ?> 
                                                </th>
                                                <th class="hidden-680">
                                                   Group :  <?php echo getGroupName($groupId); ?> 
                                                </th>
                                                <th class="hidden-480">
                                                   Section : <?php echo getsectionName($sectionId); ?> 
                                                </th>
                                                <th class="hidden-480">
                                                    Session : <?php echo getSessionName($sessionId); ?> 
                                                </th>
                                                <th class="hidden-480">
                                                    <b>Semester : </b> 
                                                </th>

                                            </tr>
                                        </thead>
                                </table>          
                               
                        </div>
                        <div class="viewBox fix"  style="overflow-x: scroll">
                   <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">
                                    Sl No.
                                </th>

                                <th class="hidden-480">Student Id</th>
                                <th class="hidden-480">Student Name</th>
                                <?php 
                                    foreach($listdata as $vab){                                    
                                ?>
                                <th class="hidden-480">
                                    <table>
                                                <tr style=" border: 1px solid #cccccc;"> <td colspan="4"><?php if (!empty($vab['courseId'])) {
                                                echo getCourseName($vab['courseId']);
                                            } ?></td></tr>
                                                <tr style=" border: 1px solid #cccccc;"> <td colspan="4" class="text-danger"><?php if (!empty($vab['marks'])) {
                                                echo $vab['marks'];
                                            } ?></td></tr>
                                                <tr style=" border: 1px solid #cccccc;"> 
                                                        <?php
                                                            foreach (getExamList() as $velues) {
                                                        ?>                                            
                                                            <td style="border-right: 1px solid #cccccc;padding:4px">
                                                                <?php
                                                                $words = explode(" ", $velues['examtypeName']);
                                                                $acronym = "";
                                                                foreach ($words as $w) {
                                                                    echo $acronym = $w[0];
                                                                }
                                                                ?>
                                                            </td>
                                                            <?php
                                                        }
                                                        ?>
                                                    <td class="text-success" style="border-right: 1px solid #cccccc;padding:3px">Tot.</td>

                                                </tr>
                                    </table>
                                </th>
                                   <?php } ?>

                            </tr>
                           
                        </thead>
                        <tbody>
                             <?php 
                                $s=1;
                                   $chkID=0; 
                                   foreach($studentlistdata as $vabs){
                                   if($chkID!=$vabs['studentId']){    
                                ?>
                            <tr>
                                <td class="center">
                                    <?php echo $s++; ?>
                                </td>
                                <td class="hidden-480"><?php if(!empty($vabs['studentId'])){ echo $vabs['studentId'];} ?></td>  
                                <td class="hidden-480">
                                    <?php 
                                        if(!empty($vabs['studentId'])){ 
                                            echo  $vabs['firstName']." ".$vabs['lastName'];                       
                                        }
                                    ?>
                                </td> 
                                <?php 
                                foreach($listdata as $vab){
                                    $arry=array(
                                         'programOfferId'=> $vab['programOfferId'],
                                         'courseId'=>$vab['courseId']
                                            );
                                    $SubMarks=getCourseMarks($arry);
                                    $calculate=($SubMarks*33)/100;
                                ?>
                                <td style=" border: 1px solid #cccccc; text-align: left">
                                    <table>
                                        
                                        <tr style=" border: 1px solid #cccccc;"> 
                                            <?php
                                                $ttl_mrk=0;
                                                $mrk=0;
                                               
                                                 foreach (getExamList() as $velues) { 

                                            ?>                                            
                                            <td style="border-right: 1px solid #cccccc;padding:5px"> <?php if(!empty($velues['examtypeId'])){ echo $mrk=getMark_stuid_corid_emtyp($vabs['studentId'],$vab['courseId'],$velues['examtypeId']); } else{ echo 0;}//$mrk=$vabs['marks']; ?> </td>
                                            <?php
                                                        $ttl_mrk=$ttl_mrk+$mrk;
                                                 }      
                                               ?>
                                                   
                                            <td style="padding:8px; "> <?php 
                                                    if(($calculate<$ttl_mrk) || ($calculate==$ttl_mrk))
                                                    {    
                                                        echo "<span style=\"color:green;\">".$ttl_mrk."</span>"; 
                                                    }
                                                    else
                                                    {
                                                        echo "<span style=\"color:red;\">".$ttl_mrk."</span>"; 
                                                    }
                                                    ?> </td>
                                            
                                        </tr>
                                    </table>
                                </td>
                               
                                <?php
                                           } 
                                       ?>
                               
                            </tr>
                            <?php   
                                        $chkID=$vabs['studentId'];
                                        }
                                   }
                                        
                                  ?>

                        </tbody>
                    </table>
                        </div>
                  
                     </div>
        </div><!-- /.col-x12 -->
         <?php
            }
        ?>
          <button style='margin: 10px 45%;' onclick="javascript:printDiv('printDIV')" type="button" class="btn btn-danger"> 
                <i class="ace-icon fa fa-print"></i>
                PRINT </button>
    </div> <!-- /.row --> 
    
    
    
    
    
    
    
    
    
    
    
