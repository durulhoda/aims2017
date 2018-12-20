<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box margin-bottom">
        <div class="margin">
            <!-- CONTENT -->
            <article class="s-12 m-7 l-8">
                <h3 class="titlehd"> <?php
                    echo ($rsid == 2) ? "National Events" : "";
                    echo ($rsid == 3) ? "Academic Gallery" : "";
                    echo ($rsid == 4) ? "Others" : "";
                    ?> Photo Photo Gallery
                </h3>

                <!-- GALLERY CAROUSEL -->

                <section class="s-12 l-12">

                        <?php
                        
                        if(!empty($getdata))
                        {
                            foreach ($getdata as $value) {
                                if ($value['category'] == $rsid && !empty($value['image'])) {
                                ?>


                            <div class="margin">

                                <div class="s-12 m-6 l-4">

                                    <img class="mimg" src="<?php echo base_url() . $value['image'] ?>"   />



                      <!--<p class="margin-bottom">Name / �20</p>-->
                                    <form class="customform s-12" action="">
                                        <div class="margin-bottom">
                                            <button type="submit"><?php echo $value['title'] ?></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                    <?php
                                }
                            }
                        }
                    ?>

                </section>

                <span style=" margin-left: 0; padding: 5px;">
                    <a href="<?php echo base_url(); ?>home/"><font color="green">More Gallery Images</font></a>
                </span>


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
