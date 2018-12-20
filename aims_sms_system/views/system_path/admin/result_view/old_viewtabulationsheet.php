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
        $ins_logo = getInstituteLogo();
        ?>
        <div class="col-xs-12 col-sm-12">

            <!-- div.dataTables_borderWrap -->
            <div id="printDIV" >

                <div class="viewBox text-center fix" >
                    <div class="page-header">

                        <h1>
                            <img src="<?php
                            if (file_exists($ins_logo)) {
                                echo base_url() . $ins_logo;
                            } else {
                                echo base_url() . "uploads/default/aims.png";
                            }
                            ?>" width="60">
                            <strong> <?php echo getInstituteName(); ?></strong>
                         
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
                                    <b>Semester : <?php echo getSemesterName($semesterId); ?></b> 
                                </th>

                            </tr>
                        </thead>
                    </table>          

                </div>
                
                    
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="15px">
                                    Sl No.
                                </th>

                                <th width="100px" class="hidden-480">Student</th>


                                <?php
                                foreach ($listdata as $vab) {
                                    ?>
                                    <th class="hidden-480">
                                        <table>
                                            <tr style=" border: 1px solid #cccccc;"> <td colspan="4"><?php
                                                    if (!empty($vab['courseId'])) {
                                                        echo getCourseName($vab['courseId']);
                                                    }
                                                    ?></td></tr>
                                            <tr style=" border: 1px solid #cccccc;"> <td colspan="4" class="text-danger"><?php
                                                    if (!empty($vab['marks'])) {
                                                        echo $vab['marks'];
                                                    }
                                                    ?>


                                                </td></tr>
                                            <tr style=" border: 1px solid #cccccc;"> 
                                                <?php
                                             
                                                $CourseDevideList = getMarkCategory_ByCourse($vab['courseId'],$vab['programOfferId']);
                                                $explode_words = array_filter(explode(",", $CourseDevideList['mark_cat_id']));
                                                        foreach ($explode_words as $word_val) {
                                                    ?>                                            
                                                    <td style="border-right: 1px solid #cccccc;padding:4px">
                                                <?php          
                                                    $CatagoryTitle=getMarkTitle($word_val);
                                                    echo substr($CatagoryTitle,0,2);        
                                                        ?>
                                                    </td>
                                                <?php  }  ?>    
                                                <td class="text-success" style="border-right: 1px solid #cccccc; padding:3px; color: red; ">Tot.</td>

                                            </tr>
                                        </table>
                                    </th>
    <?php } ?>

                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            $chkID = 0;
                            foreach ($studentlistdata as $vabs) {
                                if ($chkID != $vabs['studentId']) {
                                    ?>
                                    <tr>
                                        <td class="center">
                                        <?php echo $s++; ?>
                                        </td>
                                        <?php
                                        if (!empty($vabs['divide_mark'])) {
                                            // echo $vabs['divide_mark'];
                                        }
                                        ?>
                                        <td>

                                            <?php
                                            if (!empty($vabs['studentId'])) {
                                                echo "<b>" . $vabs['studentId'] . "</b><br>";
                                            }
                                            ?>
                                            <?php
                                            if (!empty($vabs['studentId'])) {
                                                echo $vabs['firstName'] . " " . $vabs['lastName'];
                                            }
                                            ?>
                                        </td>  

                                        <?php
                                        foreach ($listdata as $vab) {
                                            $arry = array(
                                                'programOfferId' => $vab['programOfferId'],
                                                'courseId' => $vab['courseId']
                                            );
                                            $SubMarks = getCourseMarks($arry);
                                            $calculate = ($SubMarks * 33) / 100;
                                            
                                          // echo "<pre>"; print_r($SubMarks);
                                            ?>

                                            <td width="100px" style=" border: 1px solid #cccccc; text-align: left">
                                                <table>

                                                    <tr style=" border: 1px solid #cccccc;"> 
                                                        <?php
                                                        $ttl_mrk = 0;
                                                        $mrk = 0; 
                                                        $mrk = GetMarkBy_StuId_CouId_PrgId($vabs['studentId'],$vab['programOfferId'], $semesterId, $vab['courseId']);
                                                       
                                                        $data = explode(',', $mrk);
                                                        $filter_data = array_filter($data); 
                                                  //     echo "<pre>"; print_r($mrk);
                                                     // foreach (getsub_objecList() as $velues) {
                                                            
                                                            ?> 
                                                        <?php
                                                                // data from field `user_traits` FROM `database`    
                                                         foreach ($filter_data as $key=>$value){
                                                       ?>
                                                           <td style="border-right: 1px solid #cccccc; padding:5px">
                                                               
                                                                    <?php
                                                                    
                                                               
                                                                      echo $value;
                                                                 
                                                               
                                                                    ?>
                                                            </td> 
                                                                <?php        
                                                                    }  

                                                        ?>
                                                             
                                                        <td style="padding:8px; "> 

                                                            <?php
                                                            if (!empty($filter_data)) {
                                                                echo "<span style=\"color:red; weight:bold;\">" .array_sum($filter_data) . "</span>";
                                                            } else {
                                                                echo "<span style=\"color:red;\">" . $ttl_mrk . "</span>";
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
                                    $chkID = $vabs['studentId'];
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











