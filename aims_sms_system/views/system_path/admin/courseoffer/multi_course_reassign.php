   <!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Registration Complete
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                Please Assign Subject For New Student
            </small>
        </h1>
    </div><!-- /.page-header -->
<div class="row">
    <div class="col-sm-5">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">
                    <i class="ace-icon fa fa-quote-left smaller-80"></i>
                    Student Short Profile
                </h4>
            </div>
            <form action="<?php echo admin_Url(); ?>/assigncourse/multiinsertassigncourse" method="post">  
            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                    <?php foreach ($studentinfo as $key => $stdInfo) : ?>
                    	<input type="hidden" value="<?php echo $stdInfo['studentId']; ?>" name="studentId[]">
                        <div class="col-xs-12">
                            <blockquote class="pull-left">
                                <span class="green">
                                    <i class="ace-icon fa fa-user"></i>&nbsp;
                                    <?php if(!empty($stdInfo['firstName'])){ echo $stdInfo['firstName'];} ?></span>
                                <small>  
                                    Student Id: 
                                    <cite title="Student Gender" class="red bolder"> <?php echo ($stdInfo['studentId']); ?> </cite>                                    
                                </small>
                                
                                <?php if(!empty($stdInfo['gender'])){ ?>
                                    <small>  
                                        Gender:
                                        <cite title="Student Gender" class="lighter red"> <?php echo element($stdInfo['gender'],getGendar(),Null); ?> </cite>                                    
                                    </small>
                                <?php } ?>
                                
                                <?php if(!empty($stdInfo['dateOfBirth'])){ ?>
                                    <small>    
                                        Birth Date:
                                        <cite title="Student Birth Date" class="lighter red"> <?php echo date('d F Y', strtotime(date($stdInfo['dateOfBirth'], strtotime($stdInfo['dateOfBirth'])))); ?> </cite>                                    
                                    </small>
                                <?php } ?>    
                               
                            </blockquote>
                            <blockquote class="pull-right">
                                <?php
                                     if ($stdInfo['photo']) {
                                  ?>
                                     <img  src="<?php if (file_exists($stdInfo['photo'])) { echo base_url() . $stdInfo['photo']; } else { echo base_url() . "uploads/default/default.png"; } ?>" width="60">
                                 <?php 
                                        } 
                                 ?>
                                
                            </blockquote>
                            
                        </div>

                    <?php endforeach; ?>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote>
                                 <span class='lighter red bolder'><i class="ace-icon fa fa-cogs"></i>&nbsp; Enrollment Information </span>                                
                               
                                    <small>        
                                        <span class="green"> Class Level: </span>
                                        <cite title="Class level"> <?php echo element($studentinfo[0]['programLevel'], getProgramLevel(), Null); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Class: </span>
                                        <cite title="Class"> <?php echo getProgramName($studentinfo[0]['programId'][0]); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Medium: </span>
                                        <cite title="Class level"> <?php echo getmediumName($studentinfo[0]['mediumId'][0]); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Shift: </span>
                                        <cite title="Class level"> <?php echo getshiftName($studentinfo[0]['shiftId'][0]); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Group: </span>
                                        <cite title="Class level"> <?php echo getGroupName($studentinfo[0]['groupId'][0]); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Section: </span>
                                        <cite title="Class level"> <?php echo getsectionName($studentinfo[0]['sectionId'][0]); ?> </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Session: </span>
                                        <cite title="Class level"> <?php echo getSessionName($studentinfo[0]['sessionId'][0]); ?> </cite>                                    
                                    </small>
                                 
                            </blockquote>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-7">       

        <div class="row">
            <div class="col-xs-12">
                  <div class="row">
                     <div class="col-xs-12">
                        <!-- form  -->
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            Sl No.
                                        </th>
                                        <th class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th>Subject Name</th>
                                        <th>Subject Code</th>                                        
                                        <th>Subject Mark</th>
                                        <th>Assign Teacher</th>
                                        <th class="hidden-480">Subject Category</th>
                                       
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $i = 1;
                                        foreach ($courseassignlist as $value) {

                                     ?>
                                    <tr>
                                        <td class="center">
                                            <?php echo $i++; ?>
                                        </td>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" checked='checked'  name="courseId[]" value="<?php echo $value['courseId'] ?>" class="ace" />
                                                
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <a href="#"><?php
                                                    if (!empty($value['courseId'])) {
                                                        echo getCourseName($value['courseId']);
                                                    }
                                                    
                                                    ?></a>
                                        </td>
                                        <td><?php
                                                    if (!empty($value['courseId'])) {
                                                        echo getCourseCode($value['courseId']);
                                                    }
                                                    
                                                    ?>
                                        </td>
                                        <td class="hidden-480">
                                                <?php
                                                    if (!empty($value['marks'])) {
                                                        echo $value['marks'];
                                                    }
                                                    ?></td>
                                        <td class="hidden-480">
                                                <?php
                                                    $techername=getTeacher($value['employeeId']);
                                                        echo $techername['firstName'] . " " . $techername['lastName'];
                      
                                                    ?>
                                            <input type='hidden' name='employeeId[]' value='<?php echo $value['employeeId']; ?>'>
                                        </td>
                                        <td class="hidden-480">
                                            <div class="hidden-480">
                                                   
                                                    <select name="courseStatus[]" required="1" class="form-control" id="form-field-select-1">
                                                         
                                                        <?php
                                                        foreach (getSubjectcategory() as $key => $value) {
                                                            ?>
                                                            <option value="<?php echo $key; ?>" 
                                                                    <?php echo set_select("courseStatus[]", $key, FALSE); ?> >
                                                                        <?php echo $value; ?>
                                                            </option> 

                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            
                                        </td>
                                    </tr>
                                    <?php                                    
                                            }
                                    ?>
                                </tbody>
                            </table>   
                        <input type="hidden" value="<?php echo $studentinfo[0]['programOfferId']; ?>" name="programOfferId">
                        
                  
                    <button class="btn btn-danger"  onclick="return checkConfirm('To Select Assigned Subject?');" name="confirmReg">
                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Submit To Assign Course
                    </button>
                </form> 
                
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->



