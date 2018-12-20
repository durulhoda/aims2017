<!-- /Content Section  -->   
<style type="text/css">
    .rotate {

/* Safari */
-webkit-transform: rotate(-90deg);

/* Firefox */
-moz-transform: rotate(-90deg);

/* IE */
-ms-transform: rotate(-90deg);

/* Opera */
-o-transform: rotate(-90deg);

float: left;
    width: 100px;
    font-size: 20px;
    color: red;

}

table.class_routine tbody tr td{    vertical-align: middle;text-align: center;}
table.class_routine tbody tr th{    vertical-align: middle;text-align: center;}
.class_info{width: 255px}
</style>                 
    <div class="page-header">
    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
        <span class="btn btn-purple no-border">
          <i class="ace-icon fa fa-print bigger-130"></i>
          <span class="bigger-110">Prints Class Routine</span>
        </span>
    </button>
        
    </div><!-- /.page-header -->
    <div id="printableArea"> 
    <style tyle="text/css">
        @media print
       {
          .rotate {

/* Safari */
-webkit-transform: rotate(-90deg);

/* Firefox */
-moz-transform: rotate(-90deg);

/* IE */
-ms-transform: rotate(-90deg);

/* Opera */
-o-transform: rotate(-90deg);

float: left;
    width: 100px;
    font-size: 20px;
    color: red;

}

table.class_routine tbody tr td{    vertical-align: middle;text-align: center;}
table.class_routine tbody tr th{    vertical-align: middle;text-align: center;}
.class_info{width: 135px}
       }
    </style>
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
        <div class="col-xs-12 col-sm-12">
        <div style="margin: 10px auto 0px;  width: 100%; border: 0px solid #cccccc; ">
            <div style=" border: 1px solid #d9d9d9;">
               <table style="width:100%;margin-bottom: 3px">
                  <tbody>
                  <tr style=" font-family: cambria;">
                    <th colspan="7" style="text-align: center;">
                      <?php $logo = base_url().$institute_info->logo;?>
                        <p style="margin-left:5px;">
                        <img src="<?php echo $logo; ?>" style="margin-top:3px;" height="80" />  
                        <div style="font-size: 20px; font-size: 35px; color: royalblue;">    
                          <?php echo ($institute_info->institute_name) ? $institute_info->institute_name : "";?>          
                        </div>                                           
                        <div style="line-height: 3px; font-size: 18px; color: #444;"> 
                          <?php echo ($institute_info->address) ? $institute_info->address : ""; ?>                
                        </div>
                        </p>
                      </th>
                    </tr>
                  <tr>
                     <th colspan="11" style="text-align: center; ">
                        <u>
                           <h3 style="font-family: Algerian;">Class Shedule</h3>
                        </u>
                     </th>
                  </tr>
                  <tr class="center">
                    <th class="class_info">&nbsp;</th>
                     <th>
                        Class :  <?php echo getProgramName($programofferInfo->programId); ?> &nbsp;&nbsp;&nbsp;&nbsp;Medium :  <?php echo getmediumName($programofferInfo->mediumId); ?>&nbsp;&nbsp;&nbsp;&nbsp;Shift :  <?php echo getshiftName($programofferInfo->shiftId); ?> &nbsp;&nbsp;&nbsp;&nbsp;Group :  <?php echo getGroupName($programofferInfo->groupId); ?> &nbsp;&nbsp;&nbsp;&nbsp;Section : <?php echo getsectionName($programofferInfo->sectionId); ?> &nbsp;&nbsp;&nbsp;&nbsp;Session : <?php echo getSessionName($programofferInfo->sessionId); ?>  
                     </th>
                     <th>&nbsp;</th>
                  </tr>
               </tbody></table>
            </div>
         </div>
              <?php
                    if (!empty($class_routine_info)) {                       
              ?>
                <?php if ($periodlist) : ?>
                <table class="table table-bordered class_routine">
                   <thead>
                       <tr> 
                            <th>Week/Period Time</th>
                            <?php foreach($periodlist as $kp => $p) :?>
                            <th class="center" style="width: <?php echo (!$p['is_break_time']) ? '130px' : '100px'; ?>;"><?php echo $p['periodName']; ?><br><?php echo $p['periodTime'];?></th>
                            <?php endforeach; ?>
                       </tr>
                   </thead>
                   <tbody>
                        <?php $rc = count(getDay()); $i =0; foreach(getDay() as $dp => $d) : $i++;?>
                       <tr>
                           <th style="width: 100px;background: #ede;"><?php echo $dp; ?></th>
                           <?php foreach($periodlist as $key => $row) : ?>
                                <?php if (!$row['is_break_time']) : ?>
                                <td><?php echo isset($class_routine_info[$dp][$row['periodId']]['course_employee_name']) ? $class_routine_info[$dp][$row['periodId']]['course_employee_name'] : "Nill"; ?></td>
                            <?php else : ?>
                                <?php if ($i == 1) : ?>
                                <td rowspan="<?php echo $rc; ?>"><b class="rotate">Tiffin Time</b></td>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                       </tr>
                       
                       <?php endforeach; ?>
                   </tbody>
                </table>
            <?php endif; ?>
            </div>
                 
             <?php
                   }
             ?>
             
        </div>
        </div>
    </div> 