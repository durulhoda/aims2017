<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Hostel
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Add Hostel Bed Information
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

    <!-- div.table-responsive -->


        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form  action="<?php echo acc_Url(); ?>/hostelbed/inserthostelbed" method="post" class="form-horizontal" role="form">

       
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hostel Category : &nbsp; <?php echo form_error('data[categoryId]'); ?></label>

                    <select name="data[hostelId]" class="col-xs-9 col-sm-3" class="form-control">
                       <option value="">Select</option>
                                        <?php foreach (getHostelcategoryList() as $values) { ?>
                                            <option value="<?php echo $values['categoryId']; ?>" 
                                                    <?php echo set_select('data[categoryId]', $values['categoryId'], FALSE) ?>>
                                                        <?php echo $values['categoryName']; ?>
                                            </option>
                                        <?php } ?>
                    </select>  

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hostel Name :&nbsp; <?php echo form_error('data[transportId]'); ?></label>

                    <select name="data[hostelRoom]" class="col-xs-9 col-sm-3" class="form-control">
                            <option value="">Select</option>
                                        <?php foreach (getHostelRoomList() as $values) { ?>
                                            <option value="<?php echo $values['hostelRoom']; ?>" 
                                                    <?php echo set_select('data[hostelRoom]', $values['hostelRoom'], FALSE) ?>>
                                                        <?php echo $values['hostelRoom']; ?>
                                            </option>
                                        <?php } ?>
                    </select>  

                </div>
        
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bed Number : &nbsp; </label>

                    <input type="text" name="data[bedNo]" value="<?php echo set_value("data[bedNo]"); ?>"></td>

                </div>
                
              
 
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>


                    </div>
                </div>
            </form>

          

      
        <div class="col-xs-12">
          
             <?php
                if(!empty($hostelbedlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>Sl No.</th>
                                <th>Hostel Category</th>
                                <th>Room</th> 
                                <th>Bed Number</th>  
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $sl=1;
                                foreach($hostelbedlist as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                <td><?php if(!empty($val['hostelId'])){ echo getHostelName($val['hostelId']);}?></td>
                                
                                <td><?php echo $val['hostelRoom'];?></td>
                              
                                
                                <td><?php echo $val['bedNo'];?></td>

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                            
                                         <a href="<?php echo acc_Url();?>/hostelbed/edithostelBed/<?php echo $val['bedId']; ?>" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo acc_Url();?>/hostelbed/deletehostelBed/<?php echo $val['bedId']; ?>" class="btn btn-xs btn-danger">
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
                                                    <a href="<?php echo acc_Url();?>/hostelbed/edithostelBed/<?php echo $val['bedId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo acc_Url();?>/hostelbed/deletehostelBed/<?php echo $val['bedId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
          </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 








    

    
    
    
    
    
