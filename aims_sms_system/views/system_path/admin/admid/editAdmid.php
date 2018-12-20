
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Admission Test Information 
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Admid Card Information 
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
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/admidcontroller/updatequata/<?php echo $editData['id'];?>" enctype="multipart/form-data" method="post" autocomplete="off">

                <div class="col-xs-12 col-sm-12">  
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Date   </label>
                        <div class="input-group input-group-sm">
                            <input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="data[ExamDate]" value="<?php echo $editData['ExamDate'];?>" placeholder="Enter Marks">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                                        
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Exam Time   </label>
                        <div class="input-group input-group-sm">
                            <input id="id-date-picker-1" class="form-control" type="text" name="data[ExamTime]" value="<?php echo $editData['ExamTime'];?>" placeholder="Enter Marks">
                            <span class="input-group-addon">
                           <i class="fa fa-clock-o bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    </div>
                     <div class="col-xs-12 col-sm-12"> 
                    
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Bangla   </label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" id ="v0" onkeyup="calculate()" name="data[bangla]" value="<?php echo $editData['bangla'];?>" placeholder="Enter Marks">
                            <span class="input-group-addon">
                                
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">English  </label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="text" id ="v1" onkeyup="calculate()" name="data[english]" value="<?php echo $editData['english'];?>" placeholder="Enter Marks">
                            <span class="input-group-addon">
                             
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">Mathmatics   </label>
                        <div class="input-group input-group-sm">
                            <input  class="form-control" type="text" id ="v2" onkeyup="calculate()" name="data[math]" value="<?php echo $editData['math'];?>" placeholder="Enter Marks">
                            <span class="input-group-addon">
                               
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="form-field-1">General Knowledge </label>
                        <div class="input-group input-group-sm">
                            <input  class="form-control" type="text" id ="v3" onkeyup="calculate()" name="data[gk]" value="<?php echo $editData['gk'];?>" placeholder="Enter Marks">
                            <span class="input-group-addon">
                              
                            </span>
                        </div>
                    </div>
                         
                            <div class="col-sm-4">
                        <label class="control-label" for="form-field-1"> Total Marks </label>
                        <div class="input-group input-group-sm">
                           <input type="text" name="data[total]" value="<?php echo $editData['total'];?>" id="result" onkeyup="calculate()"  readonly>
                        
                        </div>
                    </div>
                      
                    </div>
              
                                  
                 
          
         <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-11">
                                <button class="btn btn-success"  type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update Information
                                </button>

                            </div>
                        </div>
                    </div>   
         </div>
            </form>
            
              
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 

    
 <script type="text/javascript">

function calculate(){
var result = document.getElementById('result');
var el, i = 0, total = 0; 
while(el = document.getElementById('v'+(i++)) ) {
el.value = el.value.replace(/\\D/,"");
total = total + Number(el.value);
}
result.value = total;
if(document.getElementById('v0').value =="" && document.getElementById('v1').value =="" && document.getElementById('v2').value =="" ){
 result.value ="";
}
}
</script>

