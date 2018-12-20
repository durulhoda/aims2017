<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Academic Calender
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Add Event Details
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
        

    <div class="contentbox">



        <div id="tabs">
            <div id="tabs-1">



                <table style="width: 20%; margin: 0px 5%; float: left;" >
                    <tr>
                        <td colspan="3" class="widget-header" style="text-align: center;height: 56px;font-size: 22px;" >SELECT MONTH</td>
                    </tr>
                    <?php
                    for ($i = 0; $i <= 12; $i++) {
                        $time = strtotime("first day of +" . $i . " months");
                        $thismonth = date("d-m-Y", $time);
                        ?>
                        <tr >
                            <td  style="background: #eee; text-align: center; padding: 5px;">

                                <a href="<?php echo admin_Url() ?>/academiccalender/addshowmonthlyevent/<?php echo $thismonth; ?>">
                                    <button style="background: #501d73 linear-gradient(to bottom, #eee, #2980b9) repeat scroll 0 0;
                                            border-radius: 24px 2px 24px 2px;
                                            box-shadow: 0 1px 3px #666666;
                                            color: #ffffff;
                                            font-family: Georgia;
                                            font-size: 17px;
                                            padding: 7px 10px;
                                            text-decoration: none;
                                            width: 200px;">
                                            <?php echo date('F Y', strtotime($thismonth)); ?> 

                                    </button>
                                </a>

                            </td>
                        </tr>     
                        <?php
                    }
                    ?>

                    </tr>
                </table>


                <table style="width: 60%; margin: 0px 5%; float: right;" >

                    <?php
                   
                    if (!empty($date)) {
                        ?>

                        <tr style=" border: 1px solid #D8D8D8;">
                            <td colspan="6" class="widget-header" style="text-align: center" >
    <?php
    $time = strtotime($date);
    $thismonth = date("d-m-Y", $time);
    echo "<h2>" . date('F Y', strtotime($thismonth)) . "</h2>";
    ?>

                            </td>
                        </tr>
                                <?php
                            }
                            ?>
<tr>
     <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 200px; border: 1px solid #c1c1c1; text-align: center">Select Box</td>
   
    <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 200px; border: 1px solid #c1c1c1; text-align: center">Date</td>
    <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 150px; border: 1px solid #c1c1c1; text-align: center">Day</td>
    <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 350px; border: 1px solid #c1c1c1; text-align: center">Event Name</td>
    <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 350px; border: 1px solid #c1c1c1; text-align: center">Event Description</td>
 <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 350px; border: 1px solid #c1c1c1; text-align: center">Select Color</td>

</tr>
<?php
if (!empty($date)) {

    //   foreach ($eventlist as $value) {


    $now = date($date);
    $month = date("m", strtotime($now));
    $year = date("Y", strtotime($now));


    $first = date('d-m-Y', mktime(0, 0, 0, $month, 1, $year));
    $last = date('t-m-Y', mktime(0, 0, 0, $month, 1, $year));

    $thisTime = strtotime($first);
    $endTime = strtotime($last);
    $sl=0;
    while ($thisTime <= $endTime) {
         $sl++;
        $thisDate = date('d-m-Y', $thisTime);
        $tthisDate = getEventdate($thisDate);
        //    echo "<pre>";              print_r($tthisDate);
        //   echo   $tthisDate['description'];
        ?>
<form action="<?php echo admin_Url();?>/academiccalender/insertEvent" method="post">
                            <tr style="border: 1px solid #D8D8D8" >
                                   <td style="background: #29C5DE;text-align: center">

                                       <input type="checkbox" value="<?php echo $sl;?>" name="sl[]">
                                </td>
                                <td style="background: #29C5DE;text-align: center">
                            <?php
                            echo $thisDate;
                            ?>
                                    <input type="hidden" value="<?php echo $thisDate;?>" name="startdate[]">
                                </td>
                                <!-- ----- Get Day name -------    -->  

                                    <?php
                                    $timestamp = strtotime($thisDate);
                                    $day = date('l', $timestamp);

                                    if ($day == 'Friday') {
                                        ?> 

                                    <td style="background: #FAD00C;text-align: center">
                                    <?php echo $day; ?>
                                    </td>
                                    <?php
                                } else {
                                    ?> 
                                    <td style="background: #C5CCD2;text-align: center">
                                        <?php echo $day; ?>
                                    </td>
                                    <?php
                                }
                                ?> 

                                <!-- ----- Get Event Description by date -------    -->                

                              
                                    <td style="background: #EE452D; color: #fff;text-align: center">
                                    
                                        
                                          <div class="widget-box transparent ">
                    <div>
                        <input type="text" name="title[]">
                    </div>
                                              
            </div>
            
                                    </td>
                                    
                                     <td style="background: #EE452D; color: #fff;text-align: center"> 
                                         <div>
                        <input type="text" name="description[]">
                    </div>
                                    </td>
                                    
                                          <td style="background: #EE452D; color: #fff;text-align: center"> 
                                         <div>
                                             <select name="color[]">
                                                 <option> Select</option>
                                                 <option value="1"> Red</option>
                                                 <option value="2"> Green</option>
                                                 <option value="3"> Blue</option>
                                                 <option value="4"> Yellow</option>
                                                 
                                             </select>
                    </div>
                                    </td>
                                    
                                   


                            </tr>
                           
                                <?php
                                $thisTime = strtotime('+1 day', $thisTime); // increment for loop
                                //  }
                            }
                            
                        }
                        ?>
                            
                </table>
                <div class="col-md-offset-3 col-md-9"><br></div>
        <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-info" name="submit" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Insert Event Calender
                    </button>


                </div>
            </div>
</form>

            </div>
        </div>                  

        <div style="clear:both;"></div>      

    </div> 

</div>
</div>

