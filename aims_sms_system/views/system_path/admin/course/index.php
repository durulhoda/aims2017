<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        All Subject Information
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Add New Subject
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
    <div class="col-xs-12">
        <form class="form-horizontal" role="form" action="<?php echo admin_Url();?>/course/insertcourse" method="post">
            <div class="col-xs-12 col-sm-12">  
                <!-- PAGE CONTENT BEGINS -->
                <div class="has-error col-xs-10 col-sm-3">   
                    <label class="control-label" for="form-field-1">Subject Name &nbsp; <?php echo form_error('data[courseName]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[courseName]" required="1" value="<?php echo set_value("data[courseName]"); ?>" class="form-control" id="form-field-1" placeholder="Subject Name" />

                </div>
                <div class="has-error col-xs-10 col-sm-3">   
                    <label class="control-label" for="form-field-1">Subject Code  &nbsp; <?php echo form_error('data[courseCode]', '<span class="successMessage">', '</span>'); ?></label>
                    <input type="text" name="data[courseCode]" required="1" value="<?php echo set_value("data[courseCode]"); ?>" class="form-control" id="form-field-1" placeholder="Subject Code" />

                </div> 
                <div class="has-error col-xs-10 col-sm-3">
                    <label class="control-label" for="form-field-1">Class/Program Level  &nbsp; <?php echo form_error('data[programLevel]', '<span class="successMessage">', '</span>'); ?></label>
                    <select name="data[programLevel]" required="1" class="form-control" id="form-field-select-1">

                        <?php
                        $data_info=getclasslevelfrominstitute();
                        $getData = explode(",", trim($data_info["programLevel"]));    
                        foreach ($getData as $value)
                        {
                            ?>
                            <option value="<?php echo $value; ?>" >
                               <?php 
                               echo element($value,getProgramLevel_institute(), null)  ;
                               ?>
                           </option> 

                           <?php
                       }
                       ?>
                   </select>
               </div>
               <!--<div class="has-error col-xs-10 col-sm-3">   
                <label class="control-label" for="form-field-1">Marge Sub &nbsp; <?php// echo form_error('data[courseCode]', '<span class="successMessage">', '</span>'); ?></label>
             
            <select name="data[marge]" id=""  class="form-control">
                <option ></option>
                <?php//  foreach($courselist as $val)
                   // {
 //foreach(getProgramLevel() as $key =>$value)
                               // {
                                  //  if($key==$val['programLevel'])
                                 //   {
                                  //     $lavel=$value;
                                  //  }
                               // }
                        ?>
                <option value="<?php// echo $val['courseId']?>"> <?php// echo $val['courseName'].' <b>( '. $lavel.' )</b> '?></option>
            <?php// } ?>
            </select>
            </div>--> 

        </div> 


        <div class="col-xs-12">
            <div class="clearfix form-actions">
                <div class="col-md-12">
                    <button  class="btn btn-success" name="btnSubmit" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i> Add New Subject
                    </button>

                </div>
            </div>
        </div>        
    </form>

    <?php
    if(!empty($courselist))
    {
     ?>
     <div class="row">
        <div class="col-xs-12">
            <table id="simple-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>                                
                        <th>Sl No.</th>
                        <th>Subject Name</th>
                        <th class="hidden-480">Subject Code</th>
                        <th >Marge</th>
                        <th>Subject Level</th>                               
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sl=1;
                    foreach($courselist as $val)
                    {
                        ?>
                        <tr>
                            <td> <?php echo $sl++; ?></td>
                            <td> <?php echo $val['courseName'] ?></td>
                            <td> <?php echo $val['courseCode'] ?></td>
                            <td> <?php echo $val['marge'] ?></td>
                            <td> 
                                <?php
                                foreach(getProgramLevel() as $key =>$value)
                                {
                                    if($key==$val['programLevel'])
                                    {
                                        echo $value;
                                    }
                                }
                                ?>
                            </td>

                            <td>
                                <div class="hidden-sm hidden-xs btn-group">

                                    <a href="<?php echo admin_Url();?>/course/editdcourse/<?php echo $val['courseId']; ?>"  class="btn btn-xs btn-info">
                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                    </a>

                                    <a href="<?php echo admin_Url();?>/course/deletecourse/<?php echo $val['courseId']; ?>" class="btn btn-xs btn-danger">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </a>


                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                            <li>
                                                <a href="<?php echo admin_Url();?>/course/editdcourse/<?php echo $val['courseId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo admin_Url();?>/course/deletecourse/<?php echo $val['courseId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div><!-- /.span -->
    </div><!-- /.row -->
    <?php
}
?>

</div><!-- /.col-x12 -->
</div> <!-- /.row --> 


