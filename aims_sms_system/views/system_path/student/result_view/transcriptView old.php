<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box transparent ">
            <div class="widget-header widget-header-large">
                <div class="pull-right">
                    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
                        <span class="btn btn-purple no-border">
                            <i class="ace-icon fa fa-print bigger-130"></i>
                            <span class="bigger-110">Print Transcript</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div id="printableArea" >
            <div style="margin: 10px auto;  width: 850px; border: 0px solid #cccccc; " >
                <div style=" border: 1px solid #d9d9d9;">
                    <div >
                        <table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
                            <tr style=" font-family: cambria;">
                                <td style="text-align: center;">
                                    <p style="margin-left:5px;">
                                        <?php
                                        $ins_info = getInstituteInfo();
                                        ?>

                                        <img style="margin-top:3px; " src="<?php echo base_Url() . $ins_info['logo'] ?>" height="80">
                                        <br>
                                    <div style="font-size: 20px; font-size: 35px; color: royalblue;">
                                        <?php
                                        $ins_name = getInstituteInfo();
                                        echo $ins_name['instituteName'];
                                        ?>
                                    </div>
                                    <div style="line-height: 3px; font-size: 18px; color: #444;">
                                        <?php echo $ins_info['town'] . ", " . $ins_info['city']; ?>
                                    </div>

                                    </p>

                                </td>

                            </tr>
                            <tr> <td style="text-align: center; "> <h3 style="font-family: Algerian;">ACADEMIC TRANSCRIPT</h3> </td> </tr>

                        </table>

                        <div style='margin-top: 10px;float:left; border:0px solid red; width:160px; margin-left: 20px;'>
                                    
                            <?php
                            if ($studentlist['photo']) {
                                ?>
                                <img  src="<?php
                                if (file_exists($studentlist['photo'])) {
                                    echo base_url() . $studentlist['photo'];
                                } else {
                                    echo base_url() . "uploads/default/default.png";
                                }
                                ?>" width="152" height="auto" align="middle">
                                      <?php
                                  }
                                  ?>
                        </div>
                        <div style='margin: 10px 10px 20px; font-family: cambria; height: 170px; width:98%; border:0px solid red;'>

                            <table style="width:40%; float: left;border:0px solid red; line-height: 13px; margin-left: 70px;">


                                    <tr>
                                    <td style="text-align: left; ">    <span style="font-size: 14px; color: red;"><strong>ID <strong> </span>
                                    </td>
                                    <td>
                                        <span style="font-size: 14px; color: red;">
                                            <strong>  : </strong><strong><?php echo ($studentlist['studentId']); ?> </strong>
                                        </span>

                                    </td>
                                    </tr>

                                    <tr style="line-height: 30px;">
                                        <td style="text-align: left; margin-top: 2px; ">
                                            <span style="font-size: 14px; color: green;"><strong> Name </strong> </span>
                                        </td>
                                        <td>
                                            <span style="font-size: 14px;color: green;  margin-top: 2px;">
                                                <strong>  : </strong> <strong><?php
                                                    if (!empty($studentlist['firstName'])) {
                                                        echo $studentlist['firstName'];
                                                    }
                                                    ?> </strong>
                                            </span>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;">Class </span>
                                        </td>

                                        <td>
                                            <?php if (!empty($programinfo['programId'])) { ?>
                                                <p>
                                                    <strong>  : </strong>  <?php echo getProgramName($programinfo['programId']); ?>
                                                </p>
                                            <?php } ?>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;"> Group </span>
                                        </td>
                                        <td>
                                            <?php if (!empty($programinfo['groupId'])) { ?>
                                                <p>
                                                    <strong>  : </strong>  <?php echo getGroupName($programinfo['groupId']); ?>
                                                </p>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;"> Shift </span>
                                        </td>
                                        <td>
                                            <?php if (!empty($programinfo['shiftId'])) { ?>
                                                <p>
                                                    <strong>  : </strong> <?php echo getshiftName($programinfo['shiftId']); ?>
                                                </p>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;">Section </span>
                                        </td>
                                        <td>
                                            <?php if (!empty($programinfo['sectionId'])) { ?>
                                                <p>
                                                    <strong>  : </strong> <?php echo getsectionName($programinfo['sectionId']); ?>
                                                </p>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;">Exam</span>
                                        </td>
                                        <td>
                                            <?php if (!empty($semesterId)) { ?>
                                                <p>
                                                    <strong>  : </strong>   <?php echo getSemesterName($semesterId); ?>
                                                </p>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: left; "><span style="font-size: 14px;"> Session </span>
                                        </td>

                                        <td>
                                            <?php if (!empty($programinfo['sessionId'])) { ?>
                                                <p>
                                                    <strong>  : </strong> <?php echo getSessionName($programinfo['sessionId']); ?>
                                                </p>
                                            <?php } ?>
                                        </td>
                                    </tr>


                            </table>

                            <table style="width:28%; float: right; border: 2px solid #cccccc; margin-right: 8px; border-collapse: collapse; ">
                                                        <tr >
                                                            <td style=" border: 1px solid #cccccc; text-align: center">Grade Letter</td>
                                                            <td style=" border: 1px solid #cccccc; text-align: center">Exam Marks</td>
                                                            <td style=" border: 1px solid #cccccc; text-align: center">Grade Point</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                A+
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                80-100
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                5
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                A
                                                            </td>
                                                            <td style=" padding: 0px;border: 1px solid #cccccc; text-align: center">
                                                                70-79
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                4
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style=" padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                A-
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                60-69
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                3.50
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                B
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                50-59
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                3
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                C
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                40-49
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                2
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                D
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                33-39
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                1
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                F
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                0-32
                                                            </td>
                                                            <td style="padding: 0px; border: 1px solid #cccccc; text-align: center">
                                                                0
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    </div>
                                                    <hr>

                                                    <table style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse; fo">
                                                        <tr>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Sl no.</th>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Subject</th>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Code</th>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Full Mark</th>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Ob Marks</th>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">Total Mark</th>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">GP</th>
                                                            <th  style=" border: 1px solid #cccccc; padding: 4px; text-align: center">L.G.</th>

                                                        </tr>

                                                        <?php
                                                        $i = 1;

                                                        $totalcoursemark = 0;
                                                        $totalmark = 0;
                                                        $totalgradepoint = 0;

                                                        $infox['studentId'] = $studentlist['studentId'];
                                                        $infox['programOfferId'] = $programOfferId;
                                                        //$valuess = getCourseIdByStudent($infox);

                                                        $assigncourselist = getAssignCourseListByPrg_stuid($infox['programOfferId'], $infox['studentId']);
                                                        $explodeCourse = array_filter(explode(',', trim($assigncourselist['courseId'])));
                                                        $explodeCourseStatus = array_filter(explode(',', trim($assigncourselist['courseStatus'])));
                                                        //echo "<pre>"; print_r($assigncourselist);
                                                        foreach ($markslist as $value) {

                                                            //$countcourse = count($editDatas);
                                                            $expld_course = 0;
                                                            $ResultSubject[] = $value['courseId'];

                                                            $optional_subject = 0;


                                                            for ($sll = 1; $sll < count($explodeCourse); $sll++) {
                                                                $chk_status = $explodeCourseStatus[$sll]; // get COURSE STATUS------
                                                                if ($chk_status == 2 && $explodeCourse[$sll] == $value['courseId']) {
                                                                    $optional_subject = 2;
                                                                    $expld_course = $explodeCourse[$sll];
                                                                    break;
                                                                }
                                                            }

                                                            // Subject ----NAme & Code

                                                            if (!empty($value['courseId'])) {
                                                                $print_course_name = ($value['courseName']);
                                                                if (!empty($optional_subject) == 2) {
                                                                    // print optional subject
                                                                    $print_optional_course_name = ($value['courseName']);
                                                                }
                                                            }

                                                            if (!empty($value['courseId'])) {
                                                                $print_course_code = ($value['courseCode']);
                                                                if (!empty($optional_subject) == 2) {
                                                                    // print optional subject
                                                                    $print_optional_course_code = ($value['courseCode']);
                                                                }
                                                            }

                                                            //-------------------------------------
                                                            // Subject Assign Full Marks -------------------
                                                            if (!empty($value['courseId'])) {
                                                                $coursemark = getCourseMarks($value);
                                                                $print_course_mark = $coursemark;
                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_course_mark = $coursemark;
                                                                }
                                                            }
                                                            //===================================
                                                            // Marks By Category -------------------
                                                            $data['courseId'] = $value['courseId'];

                                                            $data['programOfferId'] = $programOfferId;

                                                            $marks_devide = getMarkDevidevalue($data);

                                                            //echo "<br><pre>"; print_r($marks_devide);
                                                            $ex_pld = explode(",", trim($marks_devide['mark_cat_id']));
                                                            $ex_pld_assng_dvd = explode(",", trim($marks_devide['dis_divide_mark']));
                                                            $ex_pld_dvd = explode(",", trim($value['divide_mark']));
                                                            // this mark is from student marks table

                                                            $ex_pld_percnt = explode(",", trim($marks_devide['mark_percent']));

                                                            $marks = 0;
                                                            $print_category_mark = "";
                                                            $print_optional_category_mark = "";
                                                            $PassStatus = array();
                                                            for ($ck_val = 1; $ck_val < count($ex_pld) - 1; $ck_val++) {
                                                                //echo $ex_pld_assng_dvd[$ck_val]."++".$ex_pld_percnt[$ck_val];

                                                                $mrk_string = getMarkTitle($ex_pld[$ck_val]);

                                                                $category_mark = substr($mrk_string, 0, 1) . " - " . $ex_pld_dvd[$ck_val];

                                                                $SubPassMark = round(($ex_pld_assng_dvd[$ck_val] * ($ex_pld_percnt[$ck_val] / 100)) * (0.333));

                                                                if (!empty($ex_pld_percnt[$ck_val])) {

                                                                    $percent_marks = ($ex_pld_percnt[$ck_val] * $ex_pld_dvd[$ck_val]) / 100;

                                                                    // $marks = round($marks + $percent_marks);
                                                                    if ($value['programLevel'] == 4) {
                                                                        if (!empty($optional_subject) == 2) {
                                                                            $GradeStatus = 1; // Pass
                                                                            $marks = round($marks + $percent_marks);
                                                                        } else {
                                                                            if ($SubPassMark <= $percent_marks) {
                                                                                $PassStatus[] = 1; // Pass
                                                                            } else {
                                                                                $PassStatus[] = 0; // Fail
                                                                            }

                                                                            if (in_array(0, $PassStatus)) {
                                                                                $marks = round($marks + $percent_marks);
                                                                                $GradeStatus = 0; // Fail
                                                                            } else {
                                                                                $marks = round($marks + $percent_marks);
                                                                                $GradeStatus = 1; // Pass
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $GradeStatus = 1; // No Check
                                                                        $PassStatus[] = 1; // No Check
                                                                        $marks = round($marks + $percent_marks);
                                                                    }


                                                                    //echo "==> ".$marks." <br>";
                                                                    $category_mark = substr($mrk_string, 0, 1) . " - " . round($percent_marks);
                                                                }

                                                                $print_category_mark = $print_category_mark . "+" . $category_mark;

                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_category_mark = $print_optional_category_mark . "+" . $category_mark;
                                                                }
                                                            }

                                                            unset($PassStatus);

                                                            //======================================
                                                            // Subject Obtain Marks---------------------

                                                            if (!empty($marks)) {
                                                                $print_obtain_mark = $marks;
                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_obtain_mark = $marks;
                                                                }
                                                            }



                                                            //============================================
                                                            // Subject Grade Point=-----------------------
                                                            //echo "OP".$optional_subject."-";
                                                            $data['studentId'] = $value['studentId'];
                                                            $data['semester'] = $value['semester'];
                                                            $data['courseId'] = $value['courseId'];
                                                            //                                        $data['exam_type']=$value['exam_type'];
                                                            //   $mark= getExamMarks($data);

                                                            $percentmarks = (100 / $coursemark) * $marks;

                                                            $convertmarks = doubleval(intval($percentmarks));

                                                            if (in_array($convertmarks, range(80.00, 100.00))) {
                                                                if (!empty($optional_subject) == 2) {
                                                                    $minus_point = 5;
                                                                    $gradepoint = 0;
                                                                    $_fail_gradepoint = 5;
                                                                    $print_optional_gradepoint = $minus_point;
                                                                } else {
                                                                    if ($GradeStatus == 0) {
                                                                        $gradepoint = 0;
                                                                        $_fail_gradepoint = 0;
                                                                        $print_gradepoint = $gradepoint;
                                                                    } else {
                                                                        $gradepoint = 5;
                                                                        $_fail_gradepoint = 5;
                                                                        $print_gradepoint = $gradepoint;
                                                                    }
                                                                }

                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(70.00, 79.00))) {
                                                                if (!empty($optional_subject) == 2) {
                                                                    $minus_point = 4;
                                                                    $gradepoint = 0;
                                                                    $_fail_gradepoint = 4;

                                                                    $print_optional_gradepoint = $minus_point;
                                                                } else {
                                                                    if ($GradeStatus == 0) {
                                                                        $gradepoint = 0;
                                                                        $_fail_gradepoint = 0;
                                                                        $print_gradepoint = $gradepoint;
                                                                    } else {
                                                                        $gradepoint = 4;
                                                                        $_fail_gradepoint = 4;
                                                                        $print_gradepoint = $gradepoint;
                                                                    }
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(60.00, 69.00))) {
                                                                if (!empty($optional_subject) == 2) {
                                                                    $minus_point = 3.5;
                                                                    $gradepoint = 0;
                                                                    $_fail_gradepoint = 3.5;

                                                                    $print_optional_gradepoint = $minus_point;
                                                                } else {
                                                                    if ($GradeStatus == 0) {
                                                                        $gradepoint = 0;
                                                                        $_fail_gradepoint = 0;
                                                                        $print_gradepoint = $gradepoint;
                                                                    } else {
                                                                        $gradepoint = 3.5;
                                                                        $_fail_gradepoint = 3.5;
                                                                        $print_gradepoint = $gradepoint;
                                                                    }
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(50.00, 59.00))) {
                                                                if (!empty($optional_subject) == 2) {
                                                                    $minus_point = 3;
                                                                    $gradepoint = 0;
                                                                    $_fail_gradepoint = 3;

                                                                    $print_optional_gradepoint = $minus_point;
                                                                } else {
                                                                    if ($GradeStatus == 0) {
                                                                        $gradepoint = 0;
                                                                        $_fail_gradepoint = 0;
                                                                        $print_gradepoint = $gradepoint;
                                                                    } else {
                                                                        $gradepoint = 3;
                                                                        $_fail_gradepoint = 3;
                                                                        $print_gradepoint = $gradepoint;
                                                                    }
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(40.00, 49.00))) {
                                                                if (!empty($optional_subject) == 2) {
                                                                    $minus_point = 2;
                                                                    $gradepoint = 0;
                                                                    $_fail_gradepoint = 2;

                                                                    $print_optional_gradepoint = $minus_point;
                                                                } else {
                                                                    if ($GradeStatus == 0) {
                                                                        $gradepoint = 0;
                                                                        $_fail_gradepoint = 0;
                                                                        $print_gradepoint = $gradepoint;
                                                                    } else {
                                                                        $gradepoint = 2;
                                                                        $_fail_gradepoint = 2;
                                                                        $print_gradepoint = $gradepoint;
                                                                    }
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(33.00, 39.00))) {
                                                                if (!empty($optional_subject) == 2) {
                                                                    $minus_point = 1;
                                                                    $gradepoint = 0;
                                                                    $_fail_gradepoint = 1;

                                                                    $print_optional_gradepoint = $minus_point;
                                                                } else {
                                                                    if ($GradeStatus == 0) {
                                                                        $gradepoint = 0;
                                                                        $_fail_gradepoint = 0;
                                                                        $print_gradepoint = $gradepoint;
                                                                    } else {
                                                                        $gradepoint = 1;
                                                                        $_fail_gradepoint = 1;
                                                                        $print_gradepoint = $gradepoint;
                                                                    }
                                                                }
                                                                //    echo $a;
                                                            } else {
                                                                $gradepoint = 0;
                                                                $minus_point = 1;
                                                                $_fail_gradepoint = 0;

                                                                $print_gradepoint = $gradepoint;
                                                                $print_optional_gradepoint = $minus_point;
                                                            }

                                                            //======================================================
                                                            // ---------------------------------------------
                                                            if (in_array($convertmarks, range(80, 100))) {
                                                                if ($GradeStatus == 0) {
                                                                    $get_grade = "F";
                                                                    $print_grademark = $get_grade;
                                                                } else {
                                                                    $get_grade = "A+";
                                                                    $print_grademark = $get_grade;
                                                                }

                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_grademark = $get_grade;
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(70, 79))) {
                                                                if ($GradeStatus == 0) {
                                                                    $get_grade = "F";
                                                                    $print_grademark = $get_grade;
                                                                } else {
                                                                    $get_grade = "A";
                                                                    $print_grademark = $get_grade;
                                                                }

                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_grademark = $get_grade;
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(60, 69))) {
                                                                if ($GradeStatus == 0) {
                                                                    $get_grade = "F";
                                                                    $print_grademark = $get_grade;
                                                                } else {
                                                                    $get_grade = "A-";
                                                                    $print_grademark = $get_grade;
                                                                }

                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_grademark = $get_grade;
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(50, 59))) {
                                                                if ($GradeStatus == 0) {
                                                                    $get_grade = "F";
                                                                    $print_grademark = $get_grade;
                                                                } else {
                                                                    $get_grade = "B";
                                                                    $print_grademark = $get_grade;
                                                                }

                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_grademark = $get_grade;
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(40, 49))) {
                                                                if ($GradeStatus == 0) {
                                                                    $get_grade = "F";
                                                                    $print_grademark = $get_grade;
                                                                } else {
                                                                    $get_grade = "C";
                                                                    $print_grademark = $get_grade;
                                                                }

                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_grademark = $get_grade;
                                                                }
                                                                //    echo $a;
                                                            } elseif (in_array($convertmarks, range(33, 39))) {
                                                                if ($GradeStatus == 0) {
                                                                    $get_grade = "F";
                                                                    $print_grademark = $get_grade;
                                                                } else {
                                                                    $get_grade = "D";
                                                                    $print_grademark = $get_grade;
                                                                }

                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_grademark = $get_grade;
                                                                }
                                                                //    echo $a;
                                                            } else {
                                                                $get_grade = "F";

                                                                $print_grademark = $get_grade;
                                                                if (!empty($optional_subject) == 2) {
                                                                    $print_optional_grademark = $get_grade;
                                                                }
                                                            }

                                                            // --------------------------------------------
                                                            // End Foreach Counting====================
                                                            $count_i = $i;

                                                            $totalcoursemark = $coursemark + $totalcoursemark;
                                                            $totalmark = $marks + $totalmark;
                                                            $totalgradepoint = $gradepoint + $totalgradepoint;
                                                            $get_grade_arry[] = $_fail_gradepoint;

                                                            $i++;
                                                            //   echo '<pre>';      print_r($totalcoursemark);
                                                            // Now merge in array------------------------------

                                                            if ((!empty($optional_subject) != 2)) {

                                                                //$print_category_mark

                                                                $sorted_array_marks[] = $print_course_name . ">" . $print_course_code . ">" . $print_course_mark . ">" . $print_category_mark . ">" . $print_obtain_mark . ">" . $print_gradepoint . ">" . $print_grademark;
                                                                // $sorted_array_marks[]=$print_course_name.">".$print_course_code.">".$print_course_mark.">".$print_category_mark.">".$print_gradepoint.">".$print_grademark;
                                                            } elseif (!empty($optional_subject) == 2) {
                                                                //$print_optional_category_mark
                                                                $sorted_array_optionalmark[] = $print_optional_course_name . ">" . $print_optional_course_code . ">" . $print_optional_course_mark . ">" . $print_optional_category_mark . ">" . $print_optional_obtain_mark . ">" . $print_optional_gradepoint . ">" . $print_optional_grademark;
                                                            }
                                                        }
                                                        //End Foreach----------------------
                                                        //   echo "<pre>"; print_r($ResultSubject);
                                                        $NotInsertMark_Subject = (array_diff($explodeCourse, $ResultSubject));

                                                        if (!empty($NotInsertMark_Subject)) {
                                                            //echo "<pre>"; print_r($NotInsertMark_Subject);
                                                            foreach ($NotInsertMark_Subject as $key => $value) {
                                                                # code...
                                                                $subjectInfo = GetSubjectInformation($value, $infox['programOfferId']);

                                                                //   echo "<pre>"; print_r($subjectInfo);
                                                                if (!empty($subjectInfo)) {
                                                                    $Assignkey = array_search($subjectInfo['courseId'], $explodeCourse);

                                                                    $SubjectStatus = $explodeCourseStatus[$Assignkey];
                                                                    if ($SubjectStatus == 2) {
                                                                        $sorted_array_optionalmark[] = $subjectInfo['courseName'] . ">" . $subjectInfo['courseCode'] . ">" . $subjectInfo['FullMark'];
                                                                    } else {
                                                                        $BlankSubject[] = $subjectInfo['courseName'] . ">" . $subjectInfo['courseCode'] . ">" . $subjectInfo['FullMark'];
                                                                    }
                                                                }
                                                            }
                                                        }


                                                        $checkarraymark = array($convertmarks);

                                                        //===================================================

                                                        if (!empty($sorted_array_marks)) {

                                                            $serial = 0;
                                                            for ($f_s = 0; $f_s < count($sorted_array_marks); $f_s++) {
                                                                $explode = $sorted_array_marks[$f_s];

                                                                $xpld = explode(">", $explode);
                                                                ?>
                                                                <tr style="border: 1px solid #D8D8D8; " >
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php echo $serial = $f_s + 1; ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                                                        <?php
                                                                        if (!empty($xpld[0])) {
                                                                            echo $xpld[0];
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[1])) {
                                                                            echo $xpld[1];
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[2])) {
                                                                            echo $xpld[2];
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                                                        <?php
                                                                        if (!empty($xpld[3])) {
                                                                            $explodexx = $xpld[3];
                                                                            $xpldx = explode("+", $explodexx);

                                                                            for ($c = 1; $c < count($xpldx); $c++) {
                                                                                echo $xpldx[$c];
                                                                                if ($c != count($xpldx) - 1) {
                                                                                    echo ", ";
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        echo floor($xpld[4]);
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        echo $xpld[5];
                                                                        ?>
                                                                    </td>
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[6])) {
                                                                            echo $xpld[6];
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }

                                                        $BlankGrade = array();
                                                        if (!empty($BlankSubject)) {

                                                            $serial = 0;
                                                            for ($f_s = 0; $f_s < count($BlankSubject); $f_s++) {
                                                                $explode = $BlankSubject[$f_s];

                                                                $xpld = explode(">", $explode);
                                                                ?>
                                                                <tr style="border: 1px solid #D8D8D8; " >
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php echo $serial = $f_s + 1; ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                                                        <?php
                                                                        if (!empty($xpld[0])) {
                                                                            echo $xpld[0];
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[1])) {
                                                                            echo $xpld[1];
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[2])) {
                                                                            echo $xpld[2];
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                                                        0
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        0
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        echo 0;
                                                                        $BlankGrade[] = 0;
                                                                        ?>
                                                                    </td>
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        F
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }


                                                        if (!empty($sorted_array_optionalmark)) {

                                                            if (empty($serial)) {
                                                                $serial = 0;
                                                            }
                                                            for ($f_s = 0; $f_s < count($sorted_array_optionalmark); $f_s++) {
                                                                $explode = $sorted_array_optionalmark[$f_s];
                                                                $xpld = explode(">", $explode);
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8" style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">Optional Subject (GP above 2)</td>
                                                                </tr>
                                                                <tr style="border: 1px solid #D8D8D8; " >
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php echo $serial = $serial + 1; ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                                                        <?php
                                                                        if (!empty($xpld[0])) {
                                                                            echo $xpld[0];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[1])) {
                                                                            echo $xpld[1];
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[2])) {
                                                                            echo $xpld[2];
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: left">
                                                                        <?php
                                                                        if (!empty($xpld[3])) {
                                                                            $explodexx = $xpld[3];
                                                                            $xpldx = explode("+", $explodexx);
                                                                            for ($c = 1; $c < count($xpldx); $c++) {
                                                                                echo $xpldx[$c];
                                                                                if ($c != count($xpldx) - 1) {
                                                                                    echo ", ";
                                                                                }
                                                                            }
                                                                        } else {
                                                                            echo 0;
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[4])) {
                                                                            echo floor($xpld[4]);
                                                                        } else {
                                                                            echo 0;
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[5])) {
                                                                            echo $xpld[5];
                                                                        } else {
                                                                            echo 0;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border: 1px solid #D8D8D8; padding: 4px; text-align: center">
                                                                        <?php
                                                                        if (!empty($xpld[6])) {
                                                                            echo $xpld[6];
                                                                        } else {
                                                                            echo "F";
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            }
                                                        }
                                                        ?>


                                                        <tr>
                                                            <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                                                                Total Marks :  <?php
                                                                if (!empty($print_optional_course_mark)) {
                                                                    echo floor($totalcoursemark + $print_optional_course_mark);
                                                                } else {
                                                                    echo floor($totalcoursemark);
                                                                }
                                                                ?>




                                                            </td>
                                                            <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                                                                Obtain Marks :  <?php
                                                                if (!empty($totalmark)) {
                                                                    echo floor($totalmark);
                                                                } else {
                                                                    echo floor($totalmark);
                                                                }
                                                                ?>

                                                            </td>
                                                            <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                                                                GPA : <?php
                                                                if (in_array(0, $get_grade_arry) || in_array(0, $BlankGrade)) {
                                                                    echo $grade_mark = 0;
                                                                } else {
                                                                    if (!empty($minus_point)) {
                                                                        $minus_i = $count_i - 1;
                                                                        $minus = $minus_point - 2;

                                                                        $t_grade_witout_optional_point = $totalgradepoint + $minus;

                                                                        $cgpa = $t_grade_witout_optional_point / $minus_i;
                                                                        $substr = substr($cgpa, 0, 4);
                                                                        echo $grade_mark = $substr;
                                                                    } else {
                                                                        $cgpa = $totalgradepoint / $count_i;
                                                                        echo $grade_mark = substr($cgpa, 0, 4);
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">
                                                                Letter Grade : <?php
                                                                if (in_array(0, $get_grade_arry) || in_array(0, $BlankGrade)) {
                                                                    $grade_mark = 0;
                                                                    echo $grd = "F";
                                                                } else {
                                                                    $convertmark = $grade_mark;
                                                                    ;
                                                                    if (in_array($convertmark, range(0, 1))) {
                                                                        //if ($convertmark <0) {
                                                                        echo $grd = "F";
                                                                    } elseif ($convertmark >= 5) {
                                                                        echo $grd = "A+";
                                                                        //    echo $a;
                                                                    } elseif (4 <= $convertmark && $convertmark <= 5) {
                                                                        echo $grd = "A";
                                                                        //    echo $a;
                                                                    } elseif (3.5 <= $convertmark && $convertmark <= 3.99) {
                                                                        echo $grd = "A-";
                                                                        //    echo $a;
                                                                    } elseif (3 <= $convertmark && $convertmark <= 3.49) {
                                                                        echo $grd = "B";
                                                                        //    echo $a;
                                                                    } elseif (2 <= $convertmark && $convertmark <= 2.99) {
                                                                        echo $grd = "C";
                                                                        //    echo $a;
                                                                    } elseif (1 <= $convertmark && $convertmark <= 1.99) {
                                                                        echo $grd = "D";
                                                                        //    echo $a;
                                                                    } else {
                                                                        echo $grd = "F";
                                                                    }
                                                                }
                                                                ?>

                                                                &nbsp; &nbsp; &nbsp;
                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td colspan="8" style="padding:10px 0px 5px;text-align: center; font-size: 20px; font-weight: bold;">
                                                                <hr>
                                                                Result Comments :  <?php echo ($grd == 'A+') ? "Excellent Result" : ""; ?>
                                                                <?php echo ($grd == 'A') ? "Very Good Result" : ""; ?>
                                                                <?php echo ($grd == 'A-') ? "Keep Trying Better" : ""; ?>
                                                                <?php echo ($grd == 'B') ? "Try Hard Work" : ""; ?>
                                                                <?php echo ($grd == 'C') ? "Result Not Good" : ""; ?>
                                                                <?php echo ($grd == 'D') ? "Below Average Result" : ""; ?>
                                                                <?php echo ($grd == 'F') ? "Fail" : ""; ?>


                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="padding:10px 0px 10px 10px;text-align: left; font-size: 12px; font-weight: bold;"> <img src="<?php echo base_url(); ?>images/Photo/headmaster.jpg" width="100px" margin-left="10px"> <br>.............................................<br>Head Master</td>
                                                            <td colspan="4" style="padding:10px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;"><img src="<?php echo base_url(); ?>images/Photo/examcontr.jpg" width="100px" margin-left="10px"> <br>.............................................<br> Exam Controller </td>
                                                        </tr>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    </div>
                                                    </div>







