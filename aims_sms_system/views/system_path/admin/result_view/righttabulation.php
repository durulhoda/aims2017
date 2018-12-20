
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
            <div style="width: 100%;" id="printDIV" >

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
                                <th >
                                    Sl No.
                                </th>

                                
                                <th style="text-align: center;">
                                                Student Name/ID
                                                <div style="width: 260px;">&nbsp;</div>
                                            </th>
                                         

                                <?php
                                foreach ($listdata as $vab) {
                                    ?>
                                    <th>
                                        <table border="1" width="240px">
                                            <tr> <td style="z-index:33;top:128px;left:242px;width:242px;height:27px;text-align:center;" colspan="4"><?php
                                                    if (!empty($vab['courseId'])) {
                                                        echo getCourseName($vab['courseId']);
                                                    }
                                                    ?></td></tr>
                                            <tr> <td colspan="4" class="text-danger" align="center"><?php
                                                    if (!empty($vab['marks'])) {
                                                        echo 'Full Marks-'. $vab['marks'];
                                                    }
                                                    ?>


                                                </td></tr>
                                            <tr height="100px"> 
                                                <?php
                                             
                                                $CourseDevideList = getMarkCategory_ByCourse($vab['courseId'],$vab['programOfferId']);
                                                $explode_words = array_filter(explode(",", $CourseDevideList['mark_cat_id']));
                                                        foreach ($explode_words as $word_val) {
                                                    ?>                                            
                                                 
                                                        <td style="top: 0px; left: 0px; width: 73px; transform: rotate(-90deg); transform-origin: 39px 51px 0;  height: 28px;">
                                                <?php          
                                                    $CatagoryTitle=getMarkTitle($word_val);
                                                    echo substr($CatagoryTitle,0,20);        
                                                        ?>
                                                    </td>
                                                <?php  }  ?>    
                                                 <td style="top: 0px; left: 0px; width: 73px; transform-origin: 39px 51px 0;  transform: rotate(-90deg); height: 28px; color:red;">
                                             Total.</td>

                                            </tr>
                                        </table>
                                    </th>
    <?php } ?>

                            </tr>

                        </thead>
                        <tbody border="1">
                      
                                               
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
                                    
                                
                                              <td width="100px" style=" text-align: left">
                                             <?php
                                            if (!empty($vabs['studentId'])) {
                                                echo $vabs['firstName'] . " " . $vabs['lastName']. "(". $vabs['studentId'].")";
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
                                            ?>

                                            <td width="100px" style=" text-align: left">
                                                <table width="240px" border="1">

                                                    <tr> 
                                                        <?php
                                                        $ttl_mrk = 0;
                                                        $mrk = 0;
                                                       $mrk = GetMarkBy_StuId_CouId_PrgId($vabs['studentId'],$vab['programOfferId'], $semesterId, $vab['courseId']);
                                                         //  echo "<pre>"; print_r($mrk);
                                                         
                                                        $data = explode(',', $mrk);
                                                        $filter_data = array_filter($data); 
                                                   //    echo "<pre>"; print_r($data);
                                                     // foreach (getsub_objecList() as $velues) {
                                                            
                                                            ?> 
                                                           <?php
                                                                // data from field `user_traits` FROM `database`    
                                                             foreach ($filter_data as $key=>$value){
                                                           ?>
                                                           <td style="padding:9px">
                                                               
                                                                    <?php
                                                                    
                                                               
                                                                      echo $value;
                                                                 
                                                               
                                                                    ?>
                                                            </td> 
                                                                <?php        
                                                                    }  

                                                        ?>
                                                             
                                                        <td style="padding:9px; "> 

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
      <button style='margin: 10px 45%;' onclick="javascript:printDiv('printDIV')" type="button" class="btn btn-danger"> 
        <i class="ace-icon fa fa-print"></i>
        PRINT </button>
    
        <?php
    }
    ?>
                    

           
  </div>
</div> <!-- /.row --> 











