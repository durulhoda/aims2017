

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
    <div class="box margin-bottom">
        <div class="margin">
            <!-- CONTENT -->
            <article class="s-12 m-7 l-6">
                <h3 class="titlehd"> Contact With Us
                </h3>
                <!-- CONTENT -->
                <section class="s-12 m-7 l-12">


                    <form  class="form-horizontal" action="<?php echo base_url()?>home/sendEmail" method="post" >
                        <ul class="form-style-1">
                            <li><label>Full Name <span class="required">*</span></label><input type="text"  name="sender_name" class="field-divided" placeholder="First" />&nbsp;<input type="text" name="field2" class="field-divided" placeholder="Last" /></li>
                            <li>
                                <label>Email <span class="required">*</span></label>
                                <?php echo form_error('sender_email', '<div class="red">', '</div>'); ?>
                                <input type="email" placeholder="Email" name="sender_email" class="field-long" />
                            </li>
                          <li>
                                <label>Phone <span class="required">*</span></label>
                                <?php echo form_error('sender_phone', '<div class="red">', '</div>'); ?>
                                <input type="text" name="sender_phone" placeholder="Phone" class="field-long" />
                            </li>
                            <li>
                                <label>Your Message <span class="required">*</span></label>
                                <textarea name="sender_message" id="field5" placeholder="Message" class="field-long field-textarea"></textarea>
                            </li>
                            <li>
                                <input type="submit" name="save" value="Submit" />
                            </li>
                        </ul>
                    </form>




                </section>

            </article>
            <!-- ASIDE NAV -->
            <?php
                if(!empty($getdata))
                {
            ?>
            <aside class="s-12 l-6">
                <h3 class="titlehd">Our Location</h3>
                
                 <?php 
              foreach($getdata as $value){

                            echo $value['contactInfo']; 

                          }
                      ?>
                
                 <h5 class="titlehd">Map Location</h5>
                 
                <span><iframe src="https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d2169.3440795920346!2d90.39664564818662!3d23.8758805557167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e6!4m3!3m2!1d23.8754401!2d90.3969455!4m0!5e0!3m2!1sbn!2sbd!4v1447219783790" width="500" height="250" frameborder="0" style="border:0" allowfullscreen></iframe></span>
               
            </aside>
            <?php
                }
             ?>   
        </div>

    </div>
</div>
