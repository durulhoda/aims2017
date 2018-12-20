                 
    <div class="page-header">
        <h1>
            Student Marks Information
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Subject Marks
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
        <?php if (isset($programOfferId) && $programOfferId) : ?>
            <div class="col-xs-12 col-sm-12">
                <div class="col-xs-12 col-sm-12">
                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-large">
                            <h3 class="widget-title grey lighter">
                                <i class="ace-icon fa fa-exchange green"></i>
                                <?php echo $title."Student Marks"; ?>
                            </h3>
                        </div>
                    </div><!-- PAGE CONTENT ENDS -->
            </div>
            <div class="row">

                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                            <b> Enrollment Information</b>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <ul class="list-unstyled spaced">
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Session: 
                                    <?php
                                    echo "<b>" . getSessionName($data['sessionId']) . "</b>";
                                    ?>
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Class:
                                    <?php
                                    echo "<b>" . getProgramName($data['programId']) . "</b>";
                                    ?>
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Medium: 
                                    <?php
                                    echo "<b>" . getmediumName($data['mediumId']) . "</b>";
                                    ?>
                                </li>

                            </ul>
                        </div>
                    </div>   
                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <ul class="list-unstyled spaced">


                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Group: 
                                    <?php
                                    echo "<b>" . getGroupName($data['groupId']) . "</b>";
                                    ?>
                                </li>
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Section: 
                                    <?php
                                    echo "<b>" . getsectionName($data['sectionId']) . "</b>";
                                    ?>
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Shift: 
                                    <?php
                                    echo "<b>" . getshiftName($data['shiftId']) . "</b>";
                                    ?>
                                </li>

                            </ul>
                        </div>
                    </div>   
                </div><!-- /.col -->
                <div class="col-sm-4 ">
                    <div class="row">
                        <div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right">
                            <b> Subject Information</b>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12">
                        <div>
                            <ul class="list-unstyled spaced">
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Subject: 
                                    <?php
                                    echo "<b>" . getCourseName($courseId) . "</b>";
                                    ?>
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Teacher Name: 
                                    <?php
                                    $name = getTeacher($employeeId);
                                    echo "<b>" . $name['firstName'] . " " . $name['lastName'] . "</b>";
                                    ?>
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Exam: 
                                    <?php
                                    echo "<b>" . getSemesterName($semesterId) . "</b>";
                                    ?>
                                    &nbsp;
                                    <!--<i class="ace-icon fa fa-caret-right blue"></i>Exam Type: 
                                    <?php
                                    //echo "<b>" . getExamTypeName($examtypeId) . "</b>";
                                    ?>-->
                                </li>


                            </ul>
                        </div>
                    </div>   

                </div><!-- /.col -->

            </div><!-- /.row -->
            <div class="col-md-12">
                <form id="frm1" action="<?php echo admin_Url();?>/studentmarks/insert_mark_save" method="post" autocomplete="off">
            <div class="col-xs-12 col-sm-12">
                <!-- PAGE CONTENT BEGINS -->

                <input type="hidden" name="studentId" value="<?php echo isset($studentId) ? $studentId : 0 ?>">
                <input type="hidden" name="semesterId" value="<?php echo isset($semesterId) ? $semesterId : 0 ?>">
                <input type="hidden" name="courseId" value="<?php echo isset($courseId) ? $courseId : 0 ?>">
                <input type="hidden" name="programOfferId" value="<?php echo isset($programOfferId) ? $programOfferId : 0 ?>">
                <input type="hidden" name="employeeId" value="<?php echo isset($employeeId) ? $employeeId : 0 ?>">  
                <input type="hidden" name="assign_id" value="<?php echo isset($assign_id) ? $assign_id : 0; ?>">
            </div>
            <div>
                <table id="simple-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>    
                           <?php if ($dividemark) :
                            $mark_val = explode(",", trim($dividemark['divide_mark'], ","));
                            $mark_ttl = explode(",", trim($dividemark['mark_cat_id'], ","));
                            $count_markval = count($mark_val); 
                        for ($mrk = 0; $mrk < $count_markval; $mrk++) :

                            $mark_val[$mrk];
                            $mrkttl = getMarkTitle($mark_ttl[$mrk]);
                        ?>
                        <th><?php echo $mrkttl . "-" . $mark_val[$mrk]; ?></th> 
                        <?php endfor; ?>
                        <?php endif; ?>
                        <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <?php if ($dividemark) : 
                            $mark_val = explode(",", trim($dividemark['divide_mark'], ","));
                            if(isset($assign_id)) :
                                $d_mark = explode(",", trim($divide_mark, ","));
                            endif;
                            $count_markval = count($mark_val);
                            for ($mrk = 0; $mrk < $count_markval; $mrk++) : ?>
                            <td>
                                <input type="hidden" name="current_mark" class="current_mark current_mark_<?php echo $mrk+1; ?>" value="<?php echo isset($mark_val[$mrk]) ? $mark_val[$mrk] : 0 ?>">
                               <?php if (isset($assign_id)) : ?>
                                <input type="text" name="other_marks[]" value="<?php echo isset($d_mark[$mrk]) ? $d_mark[$mrk] : 0; ?>" required="" class="marks marks_<?php echo $mrk+1; ?>">
                                <?php else : ?>
                                    <input type="text" name="other_marks[]" value="" required="" class="marks marks_<?php echo $mrk+1; ?>">
                            <?php endif; ?>
                            </td>
                        <?php endfor; ?>
                        <?php endif; ?>
                            <td>
                                <input type="text" readonly="" name="total" value="<?php echo isset($marks) ? $marks : ''; ?>" required="" class="">
                                <input type="hidden" class="len" value="<?php echo $count_markval; ?>">
                            </td>
                        </tr>
                    </tbody>   
                </table>   
                <div class="form-group col-md-4 col-md-offset-4">
                    <div id="form-field-select-1">
                        <button class="btn btn-danger" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i> <?php echo $title; ?> Marks
                        </button>
                        <input type="reset" name="" value="Refresh" class="btn btn-info">
                    </div>    
                </div>
            </div>
        </form>
            </div>
        <?php endif; ?>
    </div> <!-- /.row --> 
    <script type="text/javascript">
         $(document).on('keyup','.marks', function() {
            var len = $('.len').val();
            var sum = 0;
            for (i = 1; i<= len; i++) {
                var mark = parseFloat($('.marks_'+i).val());
                var current_mark = parseFloat($('.current_mark_'+i).val());
                if (mark > current_mark) {
                    var mark = current_mark;
                    $('.marks_'+i).val(current_mark);
                }
                if (!isNaN(mark) && mark.length !== 0) {
                     sum += parseFloat(mark);
                 }
            }
           // console.log('sum='+sum);
            $('input[name="total"]').val(sum);
            //alert(len);
         });
        // function calculate($this) {
        //     var sum = 0;
        //     $('tr').find('.marks').each(function () {
        //          var mark = parseFloat($(this).val());
        //         // console.log('dd'+$this.find('.current_mark').val());
        //         if (!isNaN(mark) && mark.length !== 0) {
        //             sum += parseFloat(mark);
        //         }
        //     });
        //     console.log("sum = "+sum);
        //     $('input[name="total"]').val(sum);
        // }
        // $(document).on('keyup','.marks', function() {
        //     $this = $(this).closest('tr');
        //   //  check($this);
        //     //var marks = $this.find('.marks').val();
        //     //var current_marks = $this.find('.current_mark').val();
        //     //alert(marks);
        //     //alert(current_marks);
        //     calculate($this);
        // });
    </script>