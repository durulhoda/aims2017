<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>  

<div class="form-group">
    <label class="control-label col-md-3">Large</label>
    <div class="col-md-4">         

    <select id="getgesignation" onchange="return getDesignationid(); " data-placeholder="Select..." class="form-control input-large select2me select2-offscreen">
            <option value="">Select</option>
            <?php foreach(getgesignation() as $degid){?>
            <option value="<?php echo $degid->desigId; ?>"><?php echo $degid->desig_Name; ?></option>
            <?php } ?>
        </select>
        <br>
        <select id="getDepartmentlist" data-placeholder="Select..." class="form-control input-large select2me select2-offscreen" onchange="return getDepartmentid(); ">
             
             
        </select>
         <br>
         <select id="getDepartmentid" data-placeholder="Select..." class="form-control input-large select2me select2-offscreen">
             
             
        </select>


    </div>
</div>

<p>&nbsp;</p>

 

 

<?php

 