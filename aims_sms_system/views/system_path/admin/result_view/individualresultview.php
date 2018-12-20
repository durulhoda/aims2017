   <div class="widget-header widget-header-large">
                    <h3 class="widget-title grey lighter">
                        <i class="ace-icon fa fa-exchange green"></i>
                        Academic Information 
                                             
                    </h3>
                </div>
                <div class="row">
     <?php
                    if (!empty($markslist)) {
                        ?>
                        <form action="<?php echo admin_Url()?>/student/transcriptView" method="post">
        <div class="col-sm-4">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">
                        <i class="menu-icon fa fa-list-alt"></i>&nbsp;
                        Student Information
                    </h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                   <?php
    if (!empty($studentId)) {
        $value = getstudentNameInfo($studentId);
    }
    ?>  <div class="row">
                            <div class="col-xs-14">

                                <blockquote class="pull-left">



                                      <small>  
                                     Id: 
                                    <cite title="Student Id" class="red bolder">               
                                            <?php echo $studentId; ?> 
                                            <input  type="hidden" name="data[studentId]" value="<?php echo $studentId; ?>">
                                    </cite>                                    
                                </small>

                                <small>
                                     Name:
                                    <cite class="lighter red"> 
                                        
                                          <?php
                                            if (!empty($studentId)) {

                                                echo $value['firstName'] . " " . $value['lastName'];
                                            }
                                            ?>  
                                    </cite>

                                    </small>
                                   <small>
                                     Class:
                                <cite class="lighter red"> 
                                        
                                        <?php
                                              echo "" . getProgramName($value['programId']) . "<br/> ";
                                                ?> 
                                    </cite>

                                    </small>

                                       <small>
                                     Section:
                                    <cite class="lighter red"> 
                                        
                                         
                                            <?php
                                              echo "" . getsectionName($value['sectionId']) . "<br/> ";
                                                ?> 
                                    </cite>

                                    </small>


                                </blockquote>





                            </div>

                        </div>

                 

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
                                Result Information
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main row ">


                                <table id="simple-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                
                                    <th>Sl no.</th>
                                    <th>Subject</th>
                                    <th>Semester</th>
                                    <th>Exam Type</th>
                                    <th>Total Mark</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $sl=1;
                                            foreach($markslist as $value)
                                            {
                                        ?>
                                        <tr>

                                            <td> <?php echo $sl++; ?></td>

                                            <td>
                                                <?php
                                                if (!empty($value['courseId'])) {
                                                    echo getCourseName($value['courseId']);
                                                }
                                                ?>
                                                <input type="hidden" name="data[courseId]" value ="<?php if (!empty($value['courseId'])) {
                                                    echo $value['courseId'];
                                                } ?>"      />           
                                            </td>

                                                  <td>

                                           <?php
                                                if (!empty($value['semesterId'])) {
                                                    echo getSemesterName($value['semesterId']);
                                                }
                                                ?>
                                                  
                                        </td>

                                             <td>

                                            <?php
                                            if (!empty($value['examtypeId'])) {
                                                echo getExamTypeName($value['examtypeId']);
                                            }
                                            ?>
                                                          
                                        </td>

                                <td >
                                        <?php
                                        if (!empty($value['marks'])) {
                                            echo $value['marks'];
                                        }
                                        ?>
                                              
                                 </td>
                                          
                                        </tr>
                                         <?php
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>



                </div>
            </div>
            <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit" name="save">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Transcript View
            </button>
                  <input type="hidden" name="data[programOfferId]" value ="<?php if (!empty($programOfferId)) { echo $programOfferId;} ?>" />
                  <input type="hidden" name="data[semesterId]" value ="<?php if (!empty($semesterId)) { echo $semesterId;} ?>" />
            </div>
            </div>
        </div>

        <?php
    }
        ?>
    </form>

</div><!-- /.row -->