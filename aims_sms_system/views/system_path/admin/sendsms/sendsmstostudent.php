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
              //  if (!empty($studentlist)) {
            ?>
            <div class="col-xs-12 col-sm-12">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-exchange green"></i>
                                        SMS
                            <small class="red">
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                        Send SMS to Student
                            </small>
                       </h3>         
                    </div>    
                </div> 
                <div class="row">
                    {

                      <form action="http://localhost/aims/systemaccess/sendsms/send_sms_to_parents" method="post">
                        
                        <div class="col-xs-6 col-sm-7">
                            <div class="col-xs-6 col-sm-5 pricing-span-header">
                                <div class="widget-box transparent">
                                    <div class="widget-header">
                                        
                                        <h5 class="widget-title bigger lighter">Student Name</h5>
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <ul class="list-unstyled list-striped pricing-table-header">
                                                <?php
                                                    $i=1;
                                                    foreach ($_POST['studentId'] as $value) {

                                                        $info=  getstudentBasicInfo($value, $sessionId);
                                                        if(!empty($info)){
                                                        
                                                 ?>
                                                    <li>
                                                        <a target="_blank" href="<?php echo admin_Url() ."/student/viewstudentInfo/" .$value;?>">  
                                                            <?php
                                                            if (!empty($value)) {
                                                                  echo $info['firstName']." ".$info['lastName'] ;
                                                            }
                                                            ?>
                                                       </a>      
                                                    </li>
                                                   
                                                 <?php
                                                        }
                                                    }  
                                                 ?>
                                                   
                                                    
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-7 pricing-span-body">
                                <div class="pricing-span">
                                    <div class="widget-box pricing-box-small widget-color-red3">
                                        <div class="widget-header">
                                            <h5 class="widget-title bigger lighter">Father Number</h5>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main no-padding">
                                                <ul class="list-unstyled list-striped pricing-table">
                                                    <?php
                                                    $i=0;
                                                    $father_number="";
                                                    foreach ($_POST['studentId'] as $value) {

                                                        $info=  getstudentBasicInfo($value, $sessionId);
                                                        if(!empty($info)){
                                                        
                                                 ?>
                                                    <li> 
                                                             <?php
                                                                if (!empty($info['fatherPhone'])) {
                                                                    echo $f_number=$info['fatherPhone'] ;
                                                                }
                                                            ?>
                                                           
                                                    </li>
                                                   
                                                  <?php
                                                        }
                                                        $i++;
                                                        
                                                        $father_number=$f_number.",".$father_number;
                                                    }   
                                                    
                                                    
                                                 ?>
                                                    <input type="hidden" id="field1" value="<?php echo $father_number ?>">
                                                </ul>

                                            </div>
                                        </div>
                                         
                                        <div>
                                            <a href="" class="btn btn-block btn-sm btn-danger">
                                                <span>Total Number : <?php echo $i; ?></span>
                                            </a>
                                        </div> 
                                        
                                    </div>
                                </div>
                       
                                <div class="pricing-span">
                                    <div class="widget-box pricing-box-small widget-color-green">
                                        <div class="widget-header">
                                            <h5 class="widget-title bigger lighter">Mother Number</h5>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main no-padding">
                                                <ul class="list-unstyled list-striped pricing-table">
                                                   <?php
                                                    $i=0;
                                                     $mother_number="";
                                                    foreach ($_POST['studentId'] as $value) {

                                                        $info=  getstudentBasicInfo($value, $sessionId);
                                                        if(!empty($info)){
                                                        
                                                    ?>
                                                       <li> 
                                                                <?php
                                                                   if (!empty($info['motherPhone'])) {
                                                                        echo $m_number=isset($info['motherPhone']) ? $info['motherPhone'] : "" ;
                                                                    }
                                                                    ?>
                                                                    
                                                       </li>

                                                     <?php
                                                           }
                                                           $i++;
                                                           $m_number = isset($m_number) ? $m_number : "";
                                                           $mother_number=$m_number.",".$mother_number;
                                                          
                                                  
                                                           
                                                       } 
                                                       
                                                    ?>
                                                    <input type="hidden" id="field3" value="<?php echo $mother_number ?>">
                                                        
                                                       
                                                </ul>

                                            </div>

                                        </div>
                                        <div>
                                                <a href="" class="btn btn-block btn-sm btn-success">
                                                    <span>Total Number : <?php echo $i; ?></span>
                                                </a>
                                            </div>                                           
                                        
                                    </div>
                                   
                                </div>
                                 <?php if(!empty($father_number) && !empty($mother_number)){  $all_number=$father_number.$mother_number; } ?>
                            </div>
                        </div>
                        
                        <div class="col-xs-6 col-sm-5">
                            <textarea style="width: 388px; height: 150px;" name="Message" class="form-control" id="form-field-8" placeholder="write your message"></textarea>
                              <div class="space-10"></div>  
                              <input type="text" name="To" id="result">
                              <input type="hidden" name="To" id="field4" value="<?php echo $all_number; ?>">
                                <!--     <input type="text" name="To" id="result" value="<?php echo $all_number; ?>">-->
                              <input class="btn btn-sm btn-success" type="submit" value="Send SMS" />
                        </div>
                    </form>   
          

                </div><!-- PAGE CONTENT ENDS -->
            </div><!-- /.col-x12 -->
         
                
         <?php
       //     }
        ?>
        
    
    
</div> <!-- /.row --> 
<div style="margin-left:230px; ">
<button onclick="myFunction()">To Father Number</button>
<button onclick="myFunctionfiend3()">To Mother Number</button>

<button onclick="myFunctionall()">To ALL Number</button>  
   </div> 
<script>
function myFunction() {
    document.getElementById("result").value = document.getElementById("field1").value;
}

function myFunctionfiend3() {
    document.getElementById("result").value = document.getElementById("field3").value;
}

function myFunctionall() {
    document.getElementById("result").value = document.getElementById("field4").value;
}
</script>