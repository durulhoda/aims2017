<!-- Right Side/Main Content Start -->
<div id="rightside">       

    <!-- Alternative Content Box End -->

    <div class="contentcontainer lar left">
        <div class="headings altheading">
            
        </div>

        <div class="contentbox">
                    
          <div id="tabs">
               

                <div id="tabs-1">
                  
                  <!-- if want to send only single sms for every time, have to change action="..../SendTextMessage" & for multiple sms write action=".../SendTextMultiMessage" -->  
                  
                 <!-- <form style="margin: 0px 10%" id="abcd" onclick="hello()" action="https://bmpws.robi.com.bd/ApacheGearWS/SendTextMessage" method="post"> -->
                 <form action="https://api.mobireach.com.bd/SendTextMultiMessage" method="post">
                        <input type="hidden" name="Username" value="advsoft" />
                        <input type="hidden" name="Password" value="Fima@302124" />
                        <input type="hidden" name="From" value="8801847050122"/>

                          <div style="margin-top: 20px; width: 25%; float: left; " >
                            <div class="headings altheading">
                                <h3 style="text-align:center">Employee Id</h3>
                            </div>
                            <div >
                                <table  width='100%'>
                                    <?php
                                    foreach ($employeeId as $value) {
                                        ?>

                                        <tr>
                                            <td style="background: #ddd; border: 1px solid #ccc; text-align: center; font-size: 14px">
                                                 <?php
                                                if (!empty($value)) {
                                                    echo $value ;
                                                }
                                                ?>
                                                <!-- <input type="hidden" name="To" value="<?php  //echo getEmployeePhoneNumber($value); ?>"> -->
                                                <input type="hidden" name="To" value="8801921821909">
                                            </td>
                                        </tr> 

                                        <?php
                                    }
                                    ?> 
                                </table>
                            </div>
                        </div>

                         <div style=" width: 58.5%;  float: left; margin-left: 20px;">
                            <div style="margin-top: 20px">
                                <div class="headings altheading">
                                    <h3 style="text-align:center">Write SMS </h3>
                                </div>

                                <div>

                                    <table>      

                                        <tr>
                                            <td>    <textarea style="width: 550px" rows="10" type="text" name="Message" value="testmessage" /> </textarea> </td>
                                        </tr>
                                    
                                        <tr >
                                            
                                            <td><input class="btn btn-success" type="submit" value="Send SMS" /></td>
                                        </tr>
                                    </table>


                                </div>
                            </div>
                        </div>


          
                </form>
             
        </div>
    </div>
        </div>
    </div>
