 
<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
        <i class="ace-icon fa fa-exchange green"></i>
Exam Routine 
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
        
        

            <!-- div.table-responsive -->

          
           	<div class="row">
                    
			<div class="col-xs-12">          
                   <?php
            if (!empty($examroutine)) {
                ?>
                <div class="row">
                    
                    <div class="col-xs-11">

                    <button style="margin-top: 5px;" aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
                            <span class="btn btn-purple no-border">
                                <i class="ace-icon fa fa-print bigger-130"></i>
                                <span class="bigger-110">Print</span>
                            </span>
                    </button>

                    <div id="printableArea" >
                        <div>
            <!-- div.dataTables_borderWrap -->
            <div style="margin: 10px auto;  width: 900px; border: 0px solid #cccccc; " >
                <div style=" border: 4px solid #d9d9d9;">
                    <div>
                        <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                            <tr style=" font-family: cambria;">
                                <td style="text-align: center;">
                                    <p style="margin-left:5px;">
                                        <?php
                                        $ins_info = getInstituteInfo();
                                        ?>

                                        <img style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">
                                        <br>
                                        <div style="font-size: 20px; font-size: 35px; color: royalblue;">
                                        <?php
                                        $ins_name = getInstituteInfo();
                                        echo $ins_name['instituteName'];
                                        ?>
                                    </div>
                                        <div style="line-height: 3px; font-size: 18px; color: #444;">
                                        <?php echo $ins_info['town'] . ", " . $ins_info['city'] . ", " . $ins_info['district_name']; ?>
                                    </div>

                        <h3 align="center" class="text-success">Exam Routine for <?php echo getSemesterName($examroutine[0]['semester_id']);?></h3>
                        <strong>

                                        <h4 class="green"><i class="ace-icon fa fa-caret-right blue"></i>Class: <?php echo getProgramName($programinfo['programId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Medium: <?php echo getmediumName($programinfo['mediumId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;

                                        <i class="ace-icon fa fa-caret-right blue"></i>Shift: <?php echo getshiftName($programinfo['shiftId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Group: <?php echo getGroupName($programinfo['groupId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Section: <?php echo getsectionName($programinfo['sectionId']) . "</b>";
                                        ?>
                                        &nbsp;&nbsp;&nbsp;


                                        <i class="ace-icon fa fa-caret-right blue"></i>Session: <?php echo getSessionName($programinfo['sessionId']) . "</b>";
                                        ?></strong>


                                        

                        <table style="margin-top: 5px;" id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th class="text-warning">Sl No.</th>
                                    <th class="text-info">Date</th>
                                    <th class="text-info">Day</th>
                                    <th class="text-info">Subject</th>
                                    <th class="text-danger">Room</th>
                                    <th class="text-danger">Time Slot</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($examroutine as $value) {
                                    ?>
                                    <tr>
                                        <td class="text-warning"> <?php echo $sl++; ?></td>
                                        <td class="text-info"><?php if (!empty($value['date'])) { echo $value['date'];
                                                    }
                                                    ?> </td>
                                        <td class="text-info"> <?php
                                            $timestamp = strtotime($value['date']);
                                            $day = date('l', $timestamp);
                                            
                                            echo $day;
                                       ?> 
                                    </td>
                                        <td class="text-info"> <?php
                                        if(!empty($value['courseId'])){  echo getCourseName($value['courseId']);   }
                                       ?> </td>
                                        <td class="text-danger">
                                                <?php
                                        if(!empty($value['room'])){  echo $value['room'];   }
                                       ?> 
                                        </td>
                                        <td class="text-danger">  <?php
                                        if(!empty($value['examtime'])){  echo $value['examtime'];   }
                                       ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </div><!-- /.span -->
                </div><!-- /.row -->
                    <?php
                        }
                    ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    

    
    
    
    
    
