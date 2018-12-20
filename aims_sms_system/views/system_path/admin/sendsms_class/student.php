<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            SMS
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Send SMS to Student
            </small>
        </h1>
    </div><!-- /.page-header -->

<div id="response_message" style="display: none;" class="page-header">
    <h1 id="message_container">
    </h1>
</div>

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
               <div class="widget-box transparent ">
                    <div class="widget-header widget-header-large">
                        <div class="widget-toolbar pull-left">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer purple"></i>
                            <a href="#modal-table_student" role="button" class="purple" data-toggle="modal"> Search Attendance </a>

                        </div>
                   
                    </div>
            </div>
            
                <div id="modal-table_student" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Search Student
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body no-padding">
                                    <div class="col-xs-12">
                                        <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/sendsms/sendbyattendance" enctype="multipart/form-data" method="post">

                                            <div class="col-xs-12 col-sm-12">  
                                                <!-- PAGE CONTENT BEGINS -->


                                                <div class="col-sm-4">
                                                    <label class="control-label" for="form-field-1">From Date   &nbsp; <?php echo form_error('data[fromDate]', '<span class="successMessage">', '</span>'); ?></label>

                                                    <div class="input-group input-group-sm">
                                                        <input class="form-control date-picker" id="id-date-picker-1" name="data[fromDate]" type="text" data-date-format="dd-mm-yyyy" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar bigger-110"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="form-field-1">To Date   &nbsp; <?php echo form_error('data[toDate]', '<span class="successMessage">', '</span>'); ?></label>

                                                    <div class="input-group input-group-sm">
                                                        <input class="form-control date-picker" id="id-date-picker-1" name="data[toDate]" type="text" data-date-format="dd-mm-yyyy" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar bigger-110"></i>
                                                        </span>
                                                    </div>
                                                </div>                


                                            </div>                      

                                            <div class="col-xs-12">
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-success" name="search" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i> Search Student
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>        
                                        </form>      

            
               </div>
            </div>   </div>
            </div>
               </div></div></div>


        <div style="display: none;">
<!--            <form id="api_form" action="--><?php //echo base_url();?><!--systemaccess/sendsms_class/searchstudentnumber" method="post">-->
            <form id="api_form" action="https://api.mobireach.com.bd/SendTextMultiMessage" method="post">
                <input type="hidden" name="Username" value="advsoft" />
                <input type="hidden" name="Password" value="Fima@302124" />
                <input type="hidden" name="From" value="8801847050122"/>
            </form>
        </div>




        
        
        <div class="col-xs-12">
            <form id="target" class="form-horizontal" role="form" action="<?php echo base_url();?>systemaccess/sendsms_class/searchstudentnumber" enctype="multipart/form-data" method="post">
                
                   <div class="col-xs-12 col-sm-12">  
                    <!-- PAGE CONTENT BEGINS -->
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Session  &nbsp; <?php echo form_error('data[sessionId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsessionid" onchange="return getOfferedSession_classId(); " data-placeholder="Select" name="data[sessionId]"  required="1" class="form-control">
                                <option value="">Select</option>
                                 <?php foreach (getOfferedSession() as $value) { ?>
                                    <option value="<?php echo $value['sessionId']; ?>" 
                                            <?php echo set_select('data[sessionId]', $value['sessionId'], FALSE) ?> >
                                        <?php echo $value['session']; ?></option>                                                
                                <?php   }    ?>
                            </select>
                        </div>
                     
                        <div class=" col-xs-10 col-sm-4">
                                <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programId]', '<span class="successMessage">', '</span>'); ?></label>
                                <select id="getprogramid" onchange="return getOfferedprogramId(); " name="data[programId]" required="1" class="form-control">

                                </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Medium  &nbsp; <?php echo form_error('data[mediumId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getmediumid" onchange="return getOfferedmediumId(); " name="data[mediumId]" required="1" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Shift  &nbsp; <?php echo form_error('data[shiftId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getshiftid" onchange="return getOfferedshiftId(); " name="data[shiftId]" required="1" class="form-control" >

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Group  &nbsp; <?php echo form_error('data[groupId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getgroupid" onchange="return getOfferedgroupId(); " name="data[groupId]" required="1" class="form-control">

                            </select>
                        </div>
                        <div class=" col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Section  &nbsp; <?php echo form_error('data[sectionId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select id="getsectionid" name="data[sectionId]" required="1" class="form-control" >

                            </select>
                        </div>
                      
                    </div>
         
                    <div class="col-xs-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-12">
                                <button class="btn btn-success" name="search" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </div>        
            </form>

        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 


<script>

    $(function(){
        $('#target').submit(function(evt){
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "<?php echo base_url();?>systemaccess/sendsms_class/get_student_info_for_sms",
                data: $('#target').serialize(),
                success: function (data) {
                    var resp = JSON.parse(data);
                    if(resp.status=='Success')
                    {
                        var html = '<input type="hidden" name="To" value="'+resp.student_ids+'"/>' +
                            '<input type="hidden" name="Message" value="'+resp.msg+'"/>';
                        $('#api_form').append(html);
                        $('#api_form').submit();
                    }
                    else
                    {
                        $("#response_message").show();
                        $("#message_container").html(resp.message);
                    }
                },
                error: function(data) {
                    alert('error');
                }
            });
            evt.preventDefault();
        });
    });



</script>
