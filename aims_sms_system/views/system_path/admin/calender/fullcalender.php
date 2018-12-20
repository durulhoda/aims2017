<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Academic Calender
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            View Event Details
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
                    <!--- ####### Previous Month of this month##########---->            
                    <?php
                    $i = 1;
                    $time = strtotime("first day of -" . $i . " months");
                    $previousmonth = date("d-m-Y", $time);
                    ?>
                    <tr >
                        <td  style="background: #eee; text-align: center; padding: 5px;">

                            <a href="<?php echo admin_Url() ?>/academiccalender/showmonthlyevent/<?php echo $previousmonth; ?>">
                                <button style="background: #501d73 linear-gradient(to bottom, #eee, #2980b9) repeat scroll 0 0;
                                        border-radius: 24px 2px 24px 2px;
                                        box-shadow: 0 1px 3px #666666;
                                        color: #ffffff;
                                        font-family: Georgia;
                                        font-size: 17px;
                                        padding: 7px 10px;
                                        text-decoration: none;
                                        width: 200px;">

                                    <b>Prev</b>

                                </button>
                            </a>

                        </td>
                    </tr>

                    <?php
                    for ($i = 0; $i <= 12; $i++) {
                        $time = strtotime("first day of +" . $i . " months");
                        $thismonth = date("d-m-Y", $time);
                        ?>
                        <tr >
                            <td  style="background: #eee; text-align: center; padding: 5px;">

                                <a href="<?php echo admin_Url() ?>/academiccalender/showmonthlyevent/<?php echo $thismonth; ?>">
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

                    <!--- ####### Next Month of this month##########---->                   
                    <?php
                    $i = 13;
                    $time = strtotime("first day of " . $i . " months");
                    $previousmonth = date("d-m-Y", $time);
                    ?>
                    <tr >
                        <td  style="background: #eee; text-align: center; padding: 5px;">

                            <a href="<?php echo admin_Url() ?>/academiccalender/showmonthlyevent/<?php echo $previousmonth; ?>">
                                <button style="background: #501d73 linear-gradient(to bottom, #eee, #2980b9) repeat scroll 0 0;
                                        border-radius: 24px 2px 24px 2px;
                                        box-shadow: 0 1px 3px #666666;
                                        color: #ffffff;
                                        font-family: Georgia;
                                        font-size: 17px;
                                        padding: 7px 10px;
                                        text-decoration: none;
                                        width: 200px;">

                                    <b>Next</b>

                                </button>
                            </a>

                        </td>
                    </tr>
                </table>


                <table style="width: 60%; margin: 0px 5%; float: right;" >

                    <?php
                    if (!empty($date)) {
                        ?>

                        <tr style=" border: 1px solid #D8D8D8;">
                            <td colspan="3" class="widget-header" style="text-align: center" >
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
                        <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 200px; border: 1px solid #c1c1c1; text-align: center">Date</td>
                        <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 150px; border: 1px solid #c1c1c1; text-align: center">Day</td>
                        <td style="font-size: 16px; padding: 5px; background: #B7D8E1; width: 350px; border: 1px solid #c1c1c1; text-align: center">Event Name</td>
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
                        while ($thisTime <= $endTime) {
                            $thisDate = date('d-m-Y', $thisTime);
                            $tthisDate = getEventdate($thisDate);
                            //    echo "<pre>";              print_r($tthisDate);
                            //   echo   $tthisDate['description'];
                            ?>
                            <tr style="border: 1px solid #D8D8D8; height: 34px;">
                                <td style="background: #29C5DE;text-align: center">
                                    <?php
                                    echo $thisDate;
                                    ?>
                                </td>
                                <!-- ----- Get Day name -------    -->  

                                <?php
                                $timestamp = strtotime($thisDate);
                                $day = date('l', $timestamp);

                                if ($day == 'Friday') {
                                    ?> 

                                    <td style="background: red;text-align: center">
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

                                <?php
                                //  echo $thisDate;
                                if (!empty($tthisDate)) {
                                    ?>
                                    <td style="color: #fff;text-align: center; background: #9bb73a;">


                                        <div class="widget-box transparent ">
                                            <div>
                                                <div class="widget-toolbar pull-left">
                                                    <?php
                                                    if ($tthisDate['color'] == 1) {
                                                        ?>

                                                        <a href="#modal-table_student" style="width: 327px; background: #EE452D; color: #fff;text-align: center; padding: 4px;" role="button" data-toggle="modal">  <?php
                                                            //  $t= getEventdescription($thisDate); 
                                                            echo $tthisDate['title'];
                                                            ?> 

                                                        </a>  

                                                        <?php
                                                    } elseif ($tthisDate['color'] == 2) {
                                                        ?>

                                                        <a href="#modal-table_student" style="padding: 4px; width: 327px; background: green; color: #fff;text-align: center" role="button" data-toggle="modal">  <?php
                                                            //  $t= getEventdescription($thisDate); 
                                                            echo $tthisDate['title'];
                                                            ?> 

                                                        </a>
                                                        <?php
                                                    } elseif ($tthisDate['color'] == 3) {
                                                        ?>
                                                        <a href="#modal-table_student" style="padding: 4px; width: 327px; background: blue; color: #fff;text-align: center" role="button" data-toggle="modal">  <?php
                                                            //  $t= getEventdescription($thisDate); 
                                                            echo $tthisDate['title'];
                                                            ?> 

                                                        </a>
                                                        <?php
                                                    } elseif ($tthisDate['color'] == 4) {
                                                        ?>
                                                        <a href="#modal-table_student" style="padding: 4px; width: 327px; background: yellow; color: #fff;text-align: center" role="button" data-toggle="modal">  <?php
                                                            //  $t= getEventdescription($thisDate); 
                                                            echo $tthisDate['title'];
                                                            ?> 

                                                        </a>
                                                        <?php
                                                    }
                                                    ?>




                                                </div>
                                            </div>
                                        </div>
                                        <div id="modal-table_student" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header no-padding">
                                                        <div class="table-header">
                                                            <button class="close" data-dismiss="modal" aria-hidden="true">
                                                                <span class="white">&times;</span>
                                                            </button>
                                                            Event Details
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="modal-body no-padding">
                                                            <div class="col-xs-12 col-sm-12">  
                                                                <p style="background: #fff; color: #000;text-align: center; padding: 5px;">   <?php
                                                                    //  $t= getEventdescription($thisDate); 
                                                                    echo $tthisDate['description'];
                                                                    ?></p>
                                                            </div> 

                                                        </div> 



                                                        <div class="col-xs-12">
                                                            <div class="clearfix form-actions">
                                                                <div class="col-md-12">
                                                                    <button class="btn btn-success" name="search" type="submit">

                                                                        Event Start Date-<b> <?php echo $tthisDate['startdate']; ?></b> & End Date- <b><?php echo $tthisDate['enddate']; ?></b>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>       
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- PAGE CONTENT ENDS -->
                                    </td>
                                    <?php
                                } elseif ($day == 'Friday') {
                                    ?> 

                                    <td style="background: red;text-align: center">
                                        <?php echo "Govt. Holiday" ?>
                                    </td>
                                    <?php
                                } else {
                                    ?> 
                                    <td style="background: #9BB73A;text-align: center">
                                        <?php echo " "; ?>
                                    </td>
                                    <?php
                                }
                                ?>


                            </tr>
                            <?php
                            $thisTime = strtotime('+1 day', $thisTime); // increment for loop
                            //  }
                        }
                    }
                    ?>
                </table>


            </div>
        </div>                  

        <div style="clear:both;"></div>      

    </div> 

</div>
</div>

