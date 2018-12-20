 <!-- ASIDE NAV AND CONTENT -->
    <div class="line" style="height: auto">
        <div class="box margin-bottom">
            <div class="margin">
                <div style="text-align: right;">
                    <button style="margin-top: 5px;" aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
                                <span class="btn btn-purple no-border">
                                    <i class="ace-icon fa fa-print bigger-130"></i>
                                    <span class="bigger-110">Print</span>
                                </span>
                    </button>
                </div>
<!-- ####################################################################################################### -->
 <div id="printableArea" >
 <?php
 $results=getlistPeriod();
 $prds=array();
 //$prds[0]='Break Time';
 foreach($results as $r)
 {
     $prds[$r['periodId']] = $r['periodName'];
 }
// echo '<pre>';
// print_r($prds);
 ?>



<div class="wrapper col3">
  <div id="container_box">
      
                    <?php
                        $programInfo=getofferProgramInfoById($programOfferId);
                    ?>


      <p style="margin-left:5px;">
          <?php
          $ins_info = getInstituteInfo();
          ?>

          <img style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">
      <div style="font-size: 20px; font-size: 35px; color: royalblue;text-align: center">
          <?php
          $ins_name = getInstituteInfo();
          echo $ins_name['instituteName'];
          ?>
      </div>
      <div style="line-height: 3px; font-size: 18px; color: #444;text-align: center;">
          <?php echo $ins_info['town'] . ", " . $ins_info['city'] . ", " . $ins_info['district_name']; ?>
      </div>
      <div style="text-align: center">
      <strong>

          <h4 class="green"><i class="ace-icon fa fa-caret-right blue"></i>Class: <?php echo getProgramName($programInfo['programId']) . "</b>";
              ?>
              &nbsp;&nbsp;&nbsp;


              <i class="ace-icon fa fa-caret-right blue"></i>Medium: <?php echo getmediumName($programInfo['mediumId']) . "</b>";
              ?>
              &nbsp;&nbsp;&nbsp;

              <i class="ace-icon fa fa-caret-right blue"></i>Shift: <?php echo getshiftName($programInfo['shiftId']) . "</b>";
              ?>
              &nbsp;&nbsp;&nbsp;


              <i class="ace-icon fa fa-caret-right blue"></i>Group: <?php echo getGroupName($programInfo['groupId']) . "</b>";
              ?>
              &nbsp;&nbsp;&nbsp;


              <i class="ace-icon fa fa-caret-right blue"></i>Section: <?php echo getsectionName($programInfo['sectionId']) . "</b>";
              ?>
              &nbsp;&nbsp;&nbsp;


              <i class="ace-icon fa fa-caret-right blue"></i>Session: <?php echo getSessionName($programInfo['sessionId']) . "</b>";
          ?></strong>
          <p style="text-align: center;">Assembly TIme : <?php echo getPeriodTime($programInfo['shiftId'],1);?></p>
      </div>



<!--     <h2>-->

<!--         <h3 class="titlehd">-->
<!--             Class Routine Information of --><?php //echo getProgramName($programInfo['programId']). "(". getsectionName($programInfo['sectionId']).")";   ?>
<!--         </h3>-->

         &nbsp;&nbsp;&nbsp;
         <span class="text-right">
            <?php 

                    foreach ($prds as $key => $value) {
                      if($key ==0){
                          echo "Break Time: ".getPeriodTime($programInfo['shiftId'],$key);
                      }
                    }
              ?>
        </span>
 
     <br>
    
     <hr>
     
            
                    <div style="margin: 10px auto; border:0px solid black;width: 100%; height: 100%; text-align: center">
                        
                        <div style="margin: 0px; border:1px solid #D8D8D8; width: 15%; float: left;clear: right; height: 99.5% ">
                                        
                                        <section style="background: #EAEAEA; padding-top: 10px; border-bottom: 1px solid black; width: 100%;height: 100px ">
                                            Day/Time-Period
                                        </section> 
                            
                            
                            <?php foreach (getDay() as $key => $value) { ?>
                                   
                                        <section style="background: #EAEAEA; padding-top: 20px; border-bottom: 1px solid black; width: 100%; height: 225px ">
                                            <?php if(!empty($value)){echo $value;}  ?>
                                        </section>
                                  <?php }   ?>
                        </div>
                        
                        
                        <div style="margin: 0px; border:0px solid black; width: 84%; float: right;height: 100% ">
                            <div style="margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 100px ">
                                 <?php 
                                 
                                 foreach ($prds as $key => $value) {
                                     if($key !=0){
                                     ?>
                                   
                                        <section style="background: #EAEAEA; padding: 5px 0px 0px; border-right:1px solid #A2B6C8; width: 10.98%;float: left; clear:right;  height: 92%">
                                             <?php  echo $value. "</br>". getPeriodTime($programInfo['shiftId'],$key);  ?>
             
                                        </section>
                                 <?php } }  ?>
                            </div>




                            <div style="background: #fff; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 225px; ">
                                <?php
                                foreach($class_routine_info as $index=>$value)
                                {

                                    if($index =="Saturday")
                                    {
                                        foreach ($prds as $key => $vass) {
                                        ?>

                                        <section style="  padding-top: 7px; border-right:1px solid #D8D8D8; width: 10.98%;float: left; clear:right;  height: 91% ">
                                            <?php

                                                if($key !=0)
                                                {
                                                    if(!empty($value[$key]['course_employee_name']))
                                                    {
                                                        echo $value[$key]['course_employee_name'];
                                                    }
                                                }

                                            ?>

                                        </section>


                                    <?php
                                        }
                                    }
                                }
                                ?>
                            </div>

                            <div style="background: #EAEAEA; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 225px ">
                                <?php
                                foreach($class_routine_info as $index=>$value)
                                {

                                    if($index =="Sunday")
                                    {
                                        foreach ($prds as $key => $vass) {
                                            ?>

                                            <section style="  padding-top: 7px; border-right:1px solid #D8D8D8; width: 10.98%;float: left; clear:right;  height: 91% ">
                                                <?php

                                                if($key !=0)
                                                {
                                                    if(!empty($value[$key]['course_employee_name']))
                                                    {
                                                        echo $value[$key]['course_employee_name'];
                                                    }
                                                }

                                                ?>

                                            </section>


                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div style="background: #fff; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 225px ">
                                <?php
                                foreach($class_routine_info as $index=>$value)
                                {

                                    if($index =="Monday")
                                    {
                                        foreach ($prds as $key => $vass) {
                                            ?>

                                            <section style="  padding-top: 7px; border-right:1px solid #D8D8D8; width: 10.98%;float: left; clear:right;  height: 91% ">
                                                <?php

                                                if($key !=0)
                                                {
                                                    if(!empty($value[$key]['course_employee_name']))
                                                    {
                                                        echo $value[$key]['course_employee_name'];
                                                    }
                                                }

                                                ?>

                                            </section>


                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div style="background: #EAEAEA; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 225px ">
                                <?php
                                foreach($class_routine_info as $index=>$value)
                                {

                                    if($index =="Tuesday")
                                    {
                                        foreach ($prds as $key => $vass) {
                                            ?>

                                            <section style="  padding-top: 7px; border-right:1px solid #D8D8D8; width: 10.98%;float: left; clear:right;  height: 91% ">
                                                <?php

                                                if($key !=0)
                                                {
                                                    if(!empty($value[$key]['course_employee_name']))
                                                    {
                                                        echo $value[$key]['course_employee_name'];
                                                    }
                                                }

                                                ?>

                                            </section>


                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div style="background: #fff;margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 225px ">
                                <?php
                                foreach($class_routine_info as $index=>$value)
                                {

                                    if($index =="Wednessday")
                                    {
                                        foreach ($prds as $key => $vass) {
                                            ?>

                                            <section style="  padding-top: 7px; border-right:1px solid #D8D8D8; width: 10.98%;float: left; clear:right;  height: 91% ">
                                                <?php

                                                if($key !=0)
                                                {
                                                    if(!empty($value[$key]['course_employee_name']))
                                                    {
                                                        echo $value[$key]['course_employee_name'];
                                                    }
                                                }

                                                ?>

                                            </section>


                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div style="background: #EAEAEA; margin: 0px; border:1px solid #D8D8D8; width: 100%;  height: 225px ">
                                <?php
                                foreach($class_routine_info as $index=>$value)
                                {

                                    if($index =="Thursday")
                                    {
                                        foreach ($prds as $key => $vass) {
                                            ?>

                                            <section style="  padding-top: 7px; border-right:1px solid #D8D8D8; width: 10.98%;float: left; clear:right;  height: 91% ">
                                                <?php

                                                if($key !=0)
                                                {
                                                    if(!empty($value[$key]['course_employee_name']))
                                                    {
                                                        echo $value[$key]['course_employee_name'];
                                                    }
                                                }

                                                ?>

                                            </section>


                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            
                        </div>
                        
                        
                    </div>               
                    </div>

           

