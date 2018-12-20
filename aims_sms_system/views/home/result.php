<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box margin-bottom">
        <div class="margin">
            <!-- CONTENT -->
            <article class="s-12 m-7 l-8">
                <h3 class="titlehd"> Result List of         <?php
                    echo ($rsid == 1) ? "PSC" : "";
                    echo ($rsid == 2) ? "JSC" : "";
                    echo ($rsid == 3) ? "SSC" : "";
                    echo ($rsid == 4) ? "HSC" : "";
                    echo ($rsid == 5) ? "HSC(BM)" : "";
                    echo ($rsid == 6) ? "BA" : "";
                    echo ($rsid == 7) ? "BA(HON)" : "";
                    echo ($rsid == 8) ? "BBS" : "";
                    echo ($rsid == 9) ? "BSS" : "";
                    echo ($rsid == 10) ? "MA" : "";
                    ?> 
                </h3>
                <!-- CONTENT -->
                <section class="s-12 m-7 l-12">



                    <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                    <!-- Table goes in the document BODY -->

                    <table class="imagetable">

                        <tr>       

                            <th>Group</th>
                            <th>Exam Year</th>
                            <th>Total Student</th>
                            <th>A+</th>
                            <th>A</th>
                            <th>A-</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>F</th>
                        </tr>


                        <?php
                            
                            if(!empty($getdata))
                            {
                                $s = 1;
                                foreach ($getdata as $value) {
                                if ($value['exam_type'] == $rsid) {

                                $t_stu = $value['grade_Ap'] + $value['grade_A'] + $value['grade_Am'] + $value['grade_B'] + $value['grade_C'] + $value['grade_D'] + $value['grade_F'];
                                ?>
                                <tr>
                                    <td>
                                        <?php $name=getGroupName($value['group']); 
                                            if(!empty($name))
                                            {
                                                echo $name;
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $value['exam_year']; ?></td>
                                    <td><?php echo $t_stu; ?></td>
                                    <td><?php echo $value['grade_Ap']; ?></td>
                                    <td><?php echo $value['grade_A']; ?></td>
                                    <td><?php echo $value['grade_Am']; ?></td>
                                    <td><?php echo $value['grade_B']; ?></td>
                                    <td><?php echo $value['grade_C']; ?></td>
                                    <td><?php echo $value['grade_D']; ?></td>
                                    <td><?php echo $value['grade_F']; ?></td>


                                </tr>



                                <?php
                            }
                            $s++;
                            }
                          }
                        ?>
                    </table>




                </section>

            </article>
            <!-- ASIDE NAV -->
            
            <?php
                if(!empty($getnoticedata))
                {
            ?>
            <aside class="s-12 l-4">
                <h3 class="titlehd">Notice Board</h3>
                <div class="aside-nav">
                    <ul>
                    <?php
                    foreach ($getnoticedata as $value) {
                        ?>
                            <span class="dte">&nbsp; <?php echo $value['dateAdd']; ?></span>
                            <li>
                                <a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>"><?php $limit = character_limiter($value['title'], 20);
                        echo $limit;
                        ?></a></li>
                                <?php } ?>
                    </ul>
                </div>
            </aside>
            <?php
                }
            ?>
        </div>

    </div>
</div>
