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
    if (!empty($studentlist)) {
        ?>
        <div class="col-xs-12 col-sm-12">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-large">
                    <h3 class="widget-title grey lighter">
                        <i class="ace-icon fa fa-exchange green"></i>
                        SMS
                        <small class="red">
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Send SMS to Student
                        </small>
                    </h3>         
                </div>    
                <div class="table-header">
                    Student List
                </div>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>

                    <form class="form-horizontal" role="form" action="<?php echo admin_Url() ?>/sendsms/tostudent" enctype="multipart/form-data" method="post">

                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="hidden-480">
                                        <input type="checkbox" name="checkall" onclick="checkedAll()"/>
                                    </th>
                                    <th class="center"> Sl No. <input type="hidden" name="sessionId" value="<?php echo $sessionId; ?>"></th>                     
                                    <th class="hidden-480">Student Id</th>
                                    <th class="hidden-480">Student Name</th>
                                    <th class="hidden-480">Student Phone Number</th>
                                    <th class="hidden-480">Father Phone Number</th>
                                    <th class="hidden-480">Mother Phone Number</th>
                                    <th class="hidden-480">Email Address</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sl = 1;
                                foreach ($studentlist as $value) {
                                    ?>                     
                                    <tr>
                                        <td><input type="checkbox" name="studentId[]" value="<?php echo $value['studentId']; ?>"></td>
                                        <td class="center">
                                            <?php echo $sl++; ?>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <?php
                                                if (!empty($value['studentId'])) {
                                                    echo $value['studentId'];
                                                }
                                                ?> 

                                            </a>
                                        </td>
                                        <td><?php
                                            if (!empty($value['firstName'])) {
                                                echo $value['firstName'] . " " . $value['middleName'] . " " . $value['lastName'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (!empty($value['phone'])) {
                                                echo $value['phone'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (!empty($value['fatherPhone'])) {
                                                echo $value['fatherPhone'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (!empty($value['motherPhone'])) {
                                                echo $value['motherPhone'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (!empty($value['email'])) {
                                                echo $value['email'];
                                            }
                                            ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>                     
                            </tbody>   
                        </table>   
                          
                <div class="col-xs-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-12">
                            <button class="btn btn-success" onclick="this.form.target = '_blank';return true;" name="sendsms" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> SEND SMS
                            </button>
                        </div>
                    </div>
                </div>
                </form>
                    </div> 
            </div><!-- /.col-x12 -->
            <?php
        }
        ?>

    </div> <!-- /.row --> 

</div> <!-- /.row --> 

