<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Academic Calender
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            View Event
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
        <form  action="<?php echo admin_Url(); ?>/academiccalender/searcheventlist" method="post" class="form-horizontal" role="form">



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">To Date</label>
                <div class="col-sm-9">
                    <span class="input-icon">
                               <select name="data[tomonth]" class="col-xs-9 col-sm-12" class="form-control">
                        <option value="">Select Month</option>
                        <?php
                        foreach (getMonthList() as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" 
                                    <?php echo set_select("data[tomonth]", $key, FALSE); ?> >
                                    <?php echo $value; ?>
                            </option> 

                            <?php
                        }
                        ?>

                    </select>  
                   
                    </span>


&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;


                    <span class="input-icon input-icon-right">
                        <select name="data[toyear]" class="col-xs-9 col-sm-12" class="form-control">
                        <option value="">Select Year</option>
                        <?php
                        foreach (getyearList() as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" 
                                    <?php echo set_select("data[toyear]", $key, FALSE); ?> >
                                    <?php echo $value; ?>
                            </option> 

                            <?php
                        }
                        ?>

                    </select>  
                     
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">From Date</label>
                <div class="col-sm-9">
                    <span class="input-icon">
                              <select name="data[frmmonth]" class="col-xs-9 col-sm-12" class="form-control">
                        <option value="">Select Month</option>
                        <?php
                        foreach (getMonthList() as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" 
                                    <?php echo set_select("data[frmmonth]", $key, FALSE); ?> >
                                    <?php echo $value; ?>
                            </option> 

                            <?php
                        }
                        ?>

                    </select>  
                    
                    </span>
                    
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <span class="input-icon input-icon-right">
                      <select name="data[frmyear]" class="col-xs-9 col-sm-12" class="form-control">
                        <option value="">Select Year</option>
                        <?php
                        foreach (getyearList() as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" 
                                    <?php echo set_select("data[frmyear]", $key, FALSE); ?> >
                                    <?php echo $value; ?>
                            </option> 

                            <?php
                        }
                        ?>

                    </select>  
                     
                    </span>
                </div>
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




        <div class="col-xs-12">

            <?php
            if (!empty($hostelrentlist)) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th>Sl No.</th>
                                    <th>Hostel Name</th>
                                    <th>Room</th> 
                                    <th>Rent Amount</th>  
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
    <?php
    $sl = 1;
    foreach ($hostelrentlist as $val) {
        ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php if (!empty($val['hostelId'])) {
                                echo getHostelName($val['hostelId']);
                            } ?></td>

                                        <td><?php echo $val['hostelRoom']; ?></td>


                                        <td><?php echo $val['rent']; ?></td>

                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo admin_Url(); ?>/hostelrent/edithostelRent/<?php echo $val['rentId']; ?>" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo admin_Url(); ?>/hostelrent/deletehostelRent/<?php echo $val['rentId']; ?>" class="btn btn-xs btn-danger">
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
                                                            <a href="<?php echo admin_Url(); ?>/hostelrent/edithostelRent/<?php echo $val['rentId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo admin_Url(); ?>/hostelrent/deletehostelRent/<?php echo $val['rentId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
















