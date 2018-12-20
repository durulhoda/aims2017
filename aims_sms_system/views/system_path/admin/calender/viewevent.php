
<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Academic Calender
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Event List
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
            
            <div id="modal-forms" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"> &times;</button>
                            <h4 class="green bigger">Search Again</h4>
                        </div>
                        <div class="modal-body">
                        
         
             <form  action="<?php echo admin_Url(); ?>/academiccalender/searcheventlist" method="post" class="form-horizontal" role="form">

                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Month :&nbsp; <?php echo form_error('data[transportId]'); ?></label>

                    <select name="data[month]" class="col-xs-9 col-sm-3" class="form-control">
                        <option value="">Select</option>
                        <?php
                        foreach (getMonthList() as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" 
                                    <?php echo set_select("data[month]", $key, FALSE); ?> >
                                    <?php echo $value; ?>
                            </option> 

                            <?php
                        }
                        ?>

                    </select>  

                </div>
                
                        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Year : &nbsp; <?php echo form_error('data[categoryId]'); ?></label>

                    <select name="data[year]" class="col-xs-9 col-sm-3" class="form-control">
                       <option value="">Select</option>
                            <?php
                                    foreach(getyearList() as $key =>$value)
                                    {
                                ?>
                                    <option value="<?php echo $key; ?>" 
                                            <?php echo set_select("data[year]", $key, FALSE); ?> >
                                                <?php echo $value; ?>
                                    </option> 
                                
                                <?php
                                    }
                                ?>
                                        
                    </select>  

                </div>
        
 
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Search
                        </button>


                    </div>
                </div>
            </form>
             
       
                         </div>      
                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->
            
                <h4 class="pink">
                    <i class="ace-icon fa fa-hand-o-right red"></i>
                    <a href="#modal-forms" role="button" class="red" data-toggle="modal"> Search Again Class Offer Information </a>
                </h4>
            <div class="hr hr-18 dotted hr-double"></div>
              <?php
                if(!empty($eventlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                
                                <thead>
                                    <tr>                                
                                        <th>Sl No.</th>
                                        <th>Event Time</th>
                                        <th>Event Title</th>
                                        <th>Description</th>
                                        <th>Action</th>   
                                          
                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sl=1;
                                        foreach($eventlist as $value)
                                        {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>                                        
                                        <td> 
                                           <?php
                                            if (!empty($value['startdate'])) {
                                                echo "<b>".($value['startdate'])."</b>";
                                            }
                                            ?> <span class="red">To</span> <?php
                                            if (!empty($value['enddate'])) {
                                                echo "<b>".($value['enddate'])."</b>";
                                            }
                                            ?></td>
                                         <td><?php
                                            if (!empty($value['title'])) {
                                                echo ($value['title']);
                                            }
                                            ?></td>    
                                        <td>
                                                 <?php
                                            if (!empty($value['description'])) {
                                                                                          
                                                    $string = $value['description'];
                                                    $string = character_limiter($string, 20);
                                                    echo $string; 
                                                ?>
                                            
                                             <a href="<?php echo admin_Url() . "/academiccalender/viewevent/" . $value['calendarId']; ?>">VIEW More</a>
                                                    
                                            <?php  } ?>
                                        </td>
                                                    
                                                 
                                                    
                                      
                                        
                                        
                                               <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo admin_Url();?>/academiccalender/editevent/<?php echo $value['calendarId']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url();?>/academiccalender/deleteevent/<?php echo $value['calendarId']; ?>" class="btn btn-xs btn-danger">
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
                                                            <a href="<?php echo admin_Url();?>/academiccalender/editevent/<?php echo $value['calendarId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url();?>/academiccalender/deleteevent/<?php echo $value['calendarId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
                        </div>
                 
                </div><!-- /.span -->
                    <?php
               }
           ?>
            </div><!-- /.row -->
         
        </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 

    
    
    
    
    
    