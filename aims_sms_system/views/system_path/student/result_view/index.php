<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <!-- /Content Section  -->                    
            <div class="page-header">
                <h1>
                    Student Result Information
                    <small class="red">
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Show Your Result
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
                ?>

                <div class="col-xs-12 col-sm-12">
                    <form class="form-horizontal" role="form" action="<?php echo student_Url(); ?>/result_view/searchresults" enctype="multipart/form-data" method="post">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="col-xs-10 col-sm-4">
                            <label class="control-label" for="form-field-1">Semester &nbsp; <?php echo form_error('semesterId', '<span class="successMessage">', '</span>'); ?></label>
                            <select name="data[semesterId]" required="1" class="form-control" >
                                <option value="">Select</option>
                                <?php foreach (getSemesterInfoArray() as $velues) { ?>
                                    <option value="<?php echo $velues['semesterId']; ?>" <?php echo set_select('semesterId', $velues['semesterId'], FALSE) ?>><?php echo $velues['semester'] ?></option>
                                <?php } ?>
                            </select>
                        </div>  
                        <div class="col-xs-10 col-sm-4">
                            <?php $studentId = $this->session->userdata('studentId'); ?>
                            <label class="control-label" for="form-field-1">Class  &nbsp; <?php echo form_error('data[programOfferId]', '<span class="successMessage">', '</span>'); ?></label>
                            <select  data-placeholder="Select" name="data[programOfferId]"  required="1" class="form-control">
                                <option value="">Select</option>
                                <?php foreach (getStudent_all_Class($studentId) as $value) { ?>
                                    <option value="<?php echo $value['programOfferId']; ?>" 
                                            <?php echo set_select('data[programOfferId]', $value['programOfferId'], FALSE) ?> >
                                        <?php echo getProgramName($value['programId']) . " - " . getSessionName($value['sessionId']); ?></option>                                                
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-xs-12">
                            <div class="clearfix form-actions">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit" name="search">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Show Result
                                    </button>

                                </div>
                            </div>
                        </div>        
                    </form> 
                </div><!-- /.col-x12 -->
                <hr>

                <div class="row bottomlkj">
                    <?php
                    if (!empty($markslist)) {
                        $result = [];
                        $failed_once = false;
                        foreach ($markslist as $course_mark) {
                            if ((int) $course_mark['marks'] == (int) 0) {
                                $failed_once = true;
                                echo '<div style="background-color:#dd5a43; width: 94%; height:80px; margin-top:140px; text-align:center; font-size: 55px; color:#fff; margin-left: 35px; line-height:80px; "> You have failed for absent. :( </div>';
                                break;
                            } else if ((int) $course_mark['marks'] < (int) 33) {
                                $failed_once = true;
                                //echo '<div style="background-color:#dd5a43; width: 94%; height:80px; margin-top:140px; text-align:center; font-size: 55px; color:#fff; margin-left: 35px; line-height:80px; "> You have failed :( </div>';
                                ?>
                                    <form action="<?php echo student_Url() ?>/result_view/transcriptView" id='payment-form' method="post">
                                        <div class="col-sm-4">
                                            <div class="widget-box">
                                                <div class="widget-body" >
                                                    <div class="widget-main">

                                                        <?php
                                                        if (!empty($studentId)) {
                                                            $value = getstudentNameInfo($studentId);
                                                        }
                                                        ?>  <div class="row" >
                                                            <div class="col-xs-14">

                                                                <blockquote class="pull-left">
                                                                    <small>  
                                                                        Id: 
                                                                        <cite title="Student Id" class="red bolder">               
                                                                            <?php echo $studentId; ?> 
                                                                            <input  type="hidden" name="data[studentId]" value="<?php echo $studentId; ?>">
                                                                        </cite>                                    
                                                                    </small>

                                                                    <small>
                                                                        Name:
                                                                        <cite class="lighter red"> 

                                                                            <?php
                                                                            if (!empty($studentId)) {

                                                                                echo $value['firstName'] . " " . $value['lastName'];
                                                                            }
                                                                            ?>  
                                                                        </cite>

                                                                    </small>

                                                                    <small>
                                                                        Class:
                                                                        <cite class="lighter red"> 

                                                                            <?php
                                                                            echo "" . getProgramName($value['programId']) . "<br/> ";
                                                                            ?> 
                                                                        </cite>

                                                                    </small>

                                                                    <small>
                                                                        Section:
                                                                        <cite class="lighter red"> 


                                                                            <?php
                                                                            echo "" . getsectionName($value['sectionId']) . "<br/> ";
                                                                            ?> 
                                                                        </cite>

                                                                    </small>
                                                                </blockquote>

                                                            </div>

                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-8">       

                                            <div class="row">
                                                <div class="col-xs-12">


                                                    <div class="widget-box">
                                                        <div class="widget-header widget-header-flat">
                                                            <h4 class="smaller">
                                                                <i class="ace-icon fa fa-external-link"></i>
                                                                Result Information
                                                            </h4>
                                                        </div>

                                                        <div class="widget-body">
                                                            <div class="widget-main row ">


                                                                <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>                                
                                                                            <th>Sl no.</th>
                                                                            <th>Subject</th>
                                                                            <th>Semester</th>
                                                                            <th>Exam Type</th>
                                                                            <th>Total Mark</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <?php
                                                                        $sl = 1;
                                                                        foreach ($markslist as $value) {
                                                                            ?>
                                                                            <tr>

                                                                                <td> <?php echo $sl++; ?></td>

                                                                                <td>
                                                                                    <?php
                                                                                    if (!empty($value['courseId'])) {
                                                                                        echo getCourseName($value['courseId']);
                                                                                    }
                                                                                    ?>
                                                                                    <input type="hidden" name="data[courseId]" value ="<?php
                                                                                    if (!empty($value['courseId'])) {
                                                                                        echo $value['courseId'];
                                                                                    }
                                                                                    ?>"      />           
                                                                                </td>

                                                                                <td>

                                                                                    <?php
                                                                                    if (!empty($value['semesterId'])) {
                                                                                        echo getSemesterName($value['semesterId']);
                                                                                    }
                                                                                    ?>

                                                                                </td>

                                                                                <td>

                                                                                    <?php
                                                                                    if (!empty($value['examtypeId'])) {
                                                                                        echo getExamTypeName($value['examtypeId']);
                                                                                    }
                                                                                    ?>

                                                                                </td>

                                                                                <td >
                                                                                    <?php
                                                                                    if (!empty($value['marks'])) {
                                                                                        echo $value['marks'];
                                                                                    } else {
                                                                                        echo 'Absent';
                                                                                    }
                                                                                    ?>

                                                                                </td>

                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                    </tbody>
                                                                </table>

                                                            </div>

                                                        </div>

                                                    </div>



                                                </div>
                                            </div>
                                            <div class="clearfix form-actions">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button class="btn btn-info" type="submit" name="save">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                        Please click here for transcript view
                                                    </button>
                                                    <input type="hidden" name="data[programOfferId]" value ="<?php
                                                    if (!empty($programOfferId)) {
                                                        echo $programOfferId;
                                                    }
                                                    ?>" />
                                                    <input type="hidden" name="data[semesterId]" value ="<?php
                                                    if (!empty($semesterId)) {
                                                        echo $semesterId;
                                                    }
                                                    ?>" />
                                                </div>
                                            </div>
                                        </div>

                                    </form> 
                                <?php
                                break;
                            }
                        }
                        if (!$failed_once) {
                            ?>
                            <div hidden="hidden">
                                <form action="<?php echo student_Url() ?>/result_view/transcriptView" method="post" id="autoload">
                                    <div class="col-sm-4">
                                        <div class="widget-box" style="visibility: hidden">
                                            <div class="widget-body" >
                                                <div class="widget-main">

                                                    <?php
                                                    if (!empty($studentId)) {
                                                        $value = getstudentNameInfo($studentId);
                                                    }
                                                    ?>  <div class="row" >
                                                        <div class="col-xs-14">

                                                            <blockquote class="pull-left">

                                                                <small>  
                                                                    Id: 
                                                                    <cite title="Student Id" class="red bolder">               
                                                                        <?php echo $studentId; ?> 
                                                                        <input  type="hidden" name="data[studentId]" value="<?php echo $studentId; ?>">
                                                                    </cite>                                    
                                                                </small>

                                                                                                                                                                    <!--                                                        <small>
                                                                                                                                                                                                                                Name:
                                                                                                                                                                                                                                <cite class="lighter red"> 

                                                                <?php
                                                                if (!empty($studentId)) {

                                                                    echo $value['firstName'] . " " . $value['lastName'];
                                                                }
                                                                ?>  
                                                                                                                                                                                                                                </cite>

                                                                                                                                                                                                                            </small>-->

                                                                                                                                                                    <!--                                                        <small>
                                                                                                                                                                        Class:
                                                                                                                                                                        <cite class="lighter red"> 

                                                                <?php
                                                                echo "" . getProgramName($value['programId']) . "<br/> ";
                                                                ?> 
                                                                                                                                                                        </cite>

                                                                                                                                                                    </small>-->

                                                                                                                                                                    <!--                                                        <small>
                                                                                                                                                                                                                                Section:
                                                                                                                                                                                                                                <cite class="lighter red"> 


                                                                <?php
                                                                echo "" . getsectionName($value['sectionId']) . "<br/> ";
                                                                ?> 
                                                                                                                                                                                                                                </cite>

                                                                                                                                                                                                                            </small>-->


                                                            </blockquote>

                                                        </div>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">       

                                        <!-- <div class="row">
                                                                            <div class="col-xs-12">


                                                                                <div class="widget-box">
                                                                                    <div class="widget-header widget-header-flat">
                                                                                        <h4 class="smaller">
                                                                                            <i class="ace-icon fa fa-external-link"></i>
                                                                                            Result Information
                                                                                        </h4>
                                                                                    </div>

                                                                                    <div class="widget-body">
                                                                                        <div class="widget-main row ">


                                                                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>                                
                                                                                                        <th>Sl no.</th>
                                                                                                        <th>Subject</th>
                                                                                                        <th>Semester</th>
                                                                                                        <th>Exam Type</th>
                                                                                                        <th>Total Mark</th>
                                                                                                    </tr>
                                                                                                </thead>

                                                                                                <tbody>
                                        <?php
                                        $sl = 1;
                                        foreach ($markslist as $value) {
                                            ?>
                                                                                                                                                                                            <tr>

                                                                                                                                                                                                <td> <?php echo $sl++; ?></td>

                                                                                                                                                                                                <td>
                                            <?php
                                            if (!empty($value['courseId'])) {
                                                echo getCourseName($value['courseId']);
                                            }
                                            ?>
                                                                                                                                                                                                    <input type="hidden" name="data[courseId]" value ="<?php
                                            if (!empty($value['courseId'])) {
                                                echo $value['courseId'];
                                            }
                                            ?>"      />           
                                                                                                                                                                                                </td>

                                                                                                                                                                                                <td>

                                            <?php
                                            if (!empty($value['semesterId'])) {
                                                echo getSemesterName($value['semesterId']);
                                            }
                                            ?>

                                                                                                                                                                                                </td>

                                                                                                                                                                                                <td>

                                            <?php
                                            if (!empty($value['examtypeId'])) {
                                                echo getExamTypeName($value['examtypeId']);
                                            }
                                            ?>

                                                                                                                                                                                                </td>

                                                                                                                                                                                                <td >
                                            <?php
                                            if (!empty($value['marks'])) {
                                                echo $value['marks'];
                                            } else {
                                                echo 'Absent';
                                            }
                                            ?>

                                                                                                                                                                                                </td>

                                                                                                                                                                                            </tr>
                                            <?php
                                        }
                                        ?>

                                                                                                </tbody>
                                                                                            </table>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>



                                                                            </div>
                                                                        </div>-->
                                        <div class="clearfix form-actions ">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn btn-info showmobile" type="submit" name="save">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Please click here for transcript view
                                                </button>
                                                <input type="hidden" name="data[programOfferId]" value ="<?php
                                                if (!empty($programOfferId)) {
                                                    echo $programOfferId;
                                                }
                                                ?>" />
                                                <input type="hidden" name="data[semesterId]" value ="<?php
                                                if (!empty($semesterId)) {
                                                    echo $semesterId;
                                                }
                                                ?>" />
                                            </div>
                                        </div>
                                    </div>

                                </form> 
                            </div>

                            <?php
                        }
                    }
                    ?>
                </div><!-- /.row -->

            </div> <!-- /.row --> 
        </div><!-- /.col-x12 -->
    </div> <!-- /.row -->
</div>


<script type="text/javascript">
    //This function use for automatic load transcript controller.
    function myfunc() {
        var frm = document.getElementById("autoload");
        frm.submit();
    }
    window.onload = myfunc;
</script>



