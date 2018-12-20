<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Assign Subject
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Assign Subject
        </small>
    </h1>
</div><!-- /.page-header -->
<div class="row">
    <form action="<?php echo admin_Url(); ?>/assigncourse/updateassigncourse" method="post">
        <div class="col-sm-4">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">
                        <i class="ace-icon fa fa-user"></i>&nbsp;
                        Student Short Profile
                    </h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                        <?php
                        if (!empty($editData)) {
                            ?> 


                            <div class="row">
                                <div class="col-xs-14">
                                    <blockquote class="pull-left">



                                        <small>  
                                            Student Id: 
                                            <cite title="Student Id" class="red bolder">               
                                                <?php if (!empty($editData['studentId'])) {
                                                    echo $editData['studentId'];
                                                } ?>
                                                <input type="hidden" checked='checked' name="studentId" id="studentId" value='<?php echo $editData['studentId']; ?>'> 

                                            </cite>                                    
                                        </small>
                                        <small>  
                                            Student Name:
                                            <cite class="lighter red"> 

    <?php if (!empty($editData['firstName'])) {
        echo $editData['firstName'];
    } ?> 
                                            </cite>                                    
                                        </small>
                                        <small>    
                                            Class:
                                            <cite  class="lighter red">

    <?php if (!empty($editData['programId'])) {
        echo getProgramName($editData['programId']);
    } ?> 

                                            </cite>                                    
                                        </small>    

                                        <small>    
                                            Medium:
                                            <cite  class="lighter red">

    <?php if (!empty($editData['mediumId'])) {
        echo getmediumName($editData['mediumId']);
    } ?> 

                                            </cite>                                    
                                        </small> 

                                        <small>    
                                            Shift:
                                            <cite  class="lighter red">

    <?php if (!empty($editData['shiftId'])) {
        echo getshiftName($editData['shiftId']);
    } ?> 

                                            </cite>                                    
                                        </small> 

                                        <small>    
                                            Group:
                                            <cite  class="lighter red">

    <?php if (!empty($editData['groupId'])) {
        echo getGroupName($editData['groupId']);
    } ?> 

                                            </cite>                                    
                                        </small> 

                                        <small>    
                                            Section:
                                            <cite  class="lighter red">

    <?php if (!empty($editData['sectionId'])) {
        echo getsectionName($editData['sectionId']);
    } ?> 

                                            </cite>                                    
                                        </small> 

                                        <small>    
                                            Session:
                                            <cite  class="lighter red">


    <?php if (!empty($editData['sessionId'])) {
        echo getSessionName($editData['sessionId']);
    } ?> 
                                                <input type='hidden' name='programOfferId' value='<?php echo $editData['programOfferId']; ?>'>
                                            </cite>                                    
                                        </small> 

                                        <small>    
                                            Roll No:
                                            <cite class="lighter red">
                                                <input type="text" name="roll_no" value="<?php echo isset($roll_no[$editData['studentId']]) ? $roll_no[$editData['studentId']] : ''; ?>" class="form-controll">
                                            </cite>                                    
                                        </small>


                                    </blockquote>


                                </div>

                            </div>


    <?php
}
?> 
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
                                Subject List By Category
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main row ">


<?php
if (!empty($courseassignlist)) {


    ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>       
                                                        <th>Sl no</th>
                                                        <th>Subject Category</th>
                                                        <th>Subject Name</th>
                                                        <th>Assign Teacher</th>
                                                        <th>Mark</th>
                                                        <th>Select</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>

                                                    </tr>
                                                                <?php
                                                                $i = 0;
                                                                foreach ($courseassignlist as $value) {
                                                                    //   $cat_id=getCommonCourseIdByName($value['categoryName']);
                                                                    //       if ($value['categoryName'] == 'Common') {
                                                                    ?>
                                                        <tr>

                                                            <td><?php echo $i + 1; ?></td>   
                                                            <td>
                                                                <select name='courseStatus[]'>
                                                                    <option value="" selected="selected"></option>   
                                                                    <?php
                                                                    foreach (getSubjectcategory() as $key => $valueSt) {
                                                                        if ($editData['courseStatus']) {
                                                                            $editDatas = explode(",", trim($editData['courseId'], ","));
                                                                            $editDatasstatus = explode(",", trim($editData['courseStatus'], ","));

                                                                            $countcourse = count($editDatas);
                                                                            for ($x = 0; $x < $countcourse; $x++) {
                                                                                //      echo ">".$editDatas[$x]."<";
                                                                                if ($value['courseId'] == $editDatas[$x]) {
                                                                                    $status = $editDatasstatus[$x];
                                                                                    ?>
                                                                                    <option value="<?php echo $key; ?>" 
                                                                                    <?php echo ($status == $key) ? "selected" : "" ?> >     
                                                                                    <?php echo $valueSt; ?>
                                                                                    </option>                                                
                                                                                    <?php
                                                                                    $select = 1;
                                                                                    break;
                                                                                } else {
                                                                                    $select = 0;
                                                                                }
                                                                            }
                                                                            if ($select == 0) {
                                                                                ?>
                                                                                <option value="<?php echo $key; ?>" >     
                                                                                <?php echo $valueSt; ?>
                                                                                </option>            
                    <?php
                }
            }
        }
        ?>
                                                                </select> 
                                                            </td>

                                                            <td>
        <?php
        if (!empty($value['courseId'])) {
            echo getCourseName($value['courseId']);
        }
        ?>                                                
                                                                <input type="hidden" name="courseId[]" value="<?php echo $value['courseId']; ?>">
                                                            </td>
                                                            <td>
                                                                <?php if (!empty($value['employeeId'])) {
                                                                    $emp= getoneEmployeeName($value['employeeId']);
                                                                    echo $emp['firstName']." ".$emp['lastName'];
                                                                } ?> 

                                                                <input type='hidden' name='employeeId[]' value='<?php echo $value['employeeId']; ?>'>
                                                            </td>       

                                                            <td>
                                                                    <?php
                                                                    if (!empty($value['marks'])) {
                                                                        echo $value['marks'];
                                                                    }
                                                                    ?>
                                                            </td>  


                                                            <td style="background: #ccc; text-align: center">
                                                                <?php
                                                                if ($editData['courseId']) {
                                                                    $editDatas = explode(",", trim($editData['courseId'], ","));
                                                                    $countcourse = count($editDatas);
                                                                    for ($x = 0; $x < $countcourse; $x++) {
                                                                        //      echo ">".$editDatas[$x]."<";
                                                                        if ($value['courseId'] == $editDatas[$x]) {
                                                                            //       echo $editDatas[$x]."-";
                                                                            ?>

                                                                            <input type="checkbox" checked='checked' name="serial[]" id="serial[]" value="<?php echo $i; ?>">

                                                                            <?php
                                                                            $checked = 1;
                                                                            break;
                                                                        } else {
                                                                            $checked = 0;
                                                                        }
                                                                    }
                                                                    if ($checked == 0) {
                                                                        ?>

                                                                        <input type="checkbox" name="serial[]" id="serial[]" value="<?php echo $i; ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </tbody>

                                            </table>
                                        </div><!-- /.span -->
                                    </div><!-- /.row -->
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="btn btn-danger" name="save">

                            <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                            Update Subject Assign
                        </button>

    <?php
}
?>
                </div>
            </div>
        </div>
    </form>
</div><!-- PAGE CONTENT ENDS -->