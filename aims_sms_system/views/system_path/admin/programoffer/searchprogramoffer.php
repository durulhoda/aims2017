<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Class Offer Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                All Class Offer Information
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
            <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/program/programOfferList" method="post">
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
                       
                    </div> 
                                
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            
                            <button class="btn btn-success" name="btnSubmit" type="submit">
                             Search Class Offer Information
                            </button>

                        </div>
                    </div>
                </div>        
            </form>
             <?php
                if(!empty($programlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>Sl No.</th>
                                <th>Class/Program Name</th>
                                <th>Class/Program Level</th>                               
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $sl=1;
                                foreach($programlist as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                <td> <?php echo $val['programName'] ?></td>
                                <td> 
                                    <?php
                                        foreach(getProgramLevel() as $key =>$value)
                                        {
                                            if($key==$val['programLevel'])
                                            {
                                                echo $value;
                                            }
                                        }
                                    ?>
                                </td>

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                            
                                         <a href="<?php echo admin_Url();?>/program/editdprogram/<?php echo $val['programId']; ?>" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo admin_Url();?>/program/deleteprogram/<?php echo $val['programId']; ?>" class="btn btn-xs btn-danger">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </a>

                                        
                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="<?php echo admin_Url();?>/program/editdprogram/<?php echo $val['programId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo admin_Url();?>/program/deleteprogram/<?php echo $val['programId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                        <span class="red">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.span -->
            </div><!-- /.row -->
             <?php
               }
           ?>
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 
    
            
        