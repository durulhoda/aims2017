<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box  margin-bottom">
        <div class="margin">
            <!-- ASIDE NAV 1 -->
            <aside class="s-12 l-3">
                <h3 class="titlehd">More Information</h3>
                <div class="aside-nav">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>home/OurMission"> Mission Statement</a></li>
                        <li><a href="<?php echo base_url(); ?>home/LandInfo">Land Information </a></li>
                        <li><a href="<?php echo base_url(); ?>home/BuildingInfo">Building Information </a></li>
                        <li><a href="<?php echo base_url(); ?>home/RoomInfo"> Room Information</a></li>
                        <li><a href="<?php echo base_url(); ?>home/career">Career</a></li>
                        <li><a href="<?php echo base_url(); ?>home/PostInfo">Post Information</a></li>
                    </ul>
                </div>
            </aside>





            <!-- CONTENT -->
            <section class="s-12 l-6">

                <h3 class="titlehd">
                    <?php
                    if (!empty($category)) {
                        foreach (getAcademicMessageInfo() as $key => $value) {
                            if ($key == $category) {
                                echo $value;
                            }
                        }
                    }
                    ?>
                </h3>

                <!-- CSS goes in the document HEAD or added to your external stylesheet -->

                <!-- Table goes in the document BODY -->
                <?php
                       if (!empty($rowdata)) {
                    ?>
                <table class="imagetable">

                    <tr>

                        <th width="2%">SL No.</th>
                        <th>Date</th>
                        <th>Title</th>

                        <th>Details</th>
                    </tr>
                        <?php
                        $s = 1;
                        foreach ($rowdata as $value) {
                            ?>
                        <tr>
                            <td width="2%"><?php
                        echo $s++;
                        ?></td>
                            <td> <?php echo $value['dateAdd']; ?> 
                            </td>
                            <td> <?php echo $value['title']; ?></td>


                            <td><a  class="btn btn-default" href="<?php echo base_url() ?>home/ViewAcademicInformation/<?php echo $value['id'] ?>" > <font color="red">More Info</font></a></td>
                        </tr>
                            <?php
                            $s++;
                        }
                        ?>
                </table>
                    <?php
                      
                        }
                     ?>
            </section>
            <!-- ASIDE NAV 2 -->

<?php
if (!empty($getnoticedata)) {
    ?>
                <aside class="s-12 l-3">
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