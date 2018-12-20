<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box margin-bottom">
        <div class="margin">
            <!-- CONTENT -->
            <article class="s-12 m-7 l-8">
                <h3 class="titlehd"> Meritorious Student List of <?php  $ins_info = getInstituteInfo();
                                                    if (!empty($ins_info)) {   echo $ins_info['instituteName'];}  ?>      
                </h3>
                <!-- CONTENT -->
                <section class="s-12 m-7 l-12">



                    <!-- CSS goes in the document HEAD or added to your external stylesheet -->
                    <?php
                        if (!empty($getdata)) {
                            ?>
                    <!-- Table goes in the document BODY -->

                    <table class="imagetable">

                        <tr> 
                            <th>Sl.No</th>
                            <th>Image</th>
                            <th>Student Name</th>
                            <th>Current Position</th>
                            <th>Passed Year</th>
                        </tr>


                        <?php
                        $s = 1;
                        foreach ($getdata as $value) {
                          
                                ?>
                                <tr>
                                    <td><?php echo $s++; ?></td>
                                    <td><?php
                                        if ($value['image']) {
                                            ?>
                                            <img  src="<?php if (file_exists($value['image'])) {
                                                echo base_url() . $value['image'];
                                            } else {
                                                echo base_url() . "uploads/default/default.png";
                                            } ?>" width="60" height="60">
                                        <?php } ?>
                                    </td>
                                    <td><?php if (!empty($value['stuName'])) {
                                    echo $value['stuName'];
                                } ?></td>
                                    <td>
                                <?php
                                if (!empty($value['position'])) {
                                    echo ($value['position']);
                                }
                                ?>
                                    </td>
                                    
                                    <td>
                                <?php if (!empty($value['year'])) {
                                    echo $value['year'];
                                } ?>
                                    </td>



                                </tr>
                              


        <?php
  
}
?>
                    </table>

                     <?php
                        }
                     ?>


                </section>

            </article>
            <!-- ASIDE NAV -->

                        <?php
                        if (!empty($getnoticedata)) {
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
                                    <a href="<?php echo base_url(); ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>"><?php
                    $limit = character_limiter($value['title'], 20);
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

