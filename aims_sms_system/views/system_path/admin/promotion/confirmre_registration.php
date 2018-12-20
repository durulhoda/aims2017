<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Re-Registration Complete
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

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote class="pull-left">
                                <span class="green">
                                    <i class="ace-icon fa fa-user"></i>&nbsp;
                                    Jerry
                                    </span>
                                <small>  
                                    Student Id: 
                                    <cite title="Student Gender" class="red bolder"> 5245 </cite>                                    
                                </small>
                                
                               
                                    <small>  
                                        Gender:
                                        <cite title="Student Gender" class="lighter red">sdfs </cite>                                    
                                    </small>
                         
                                
                               
                                    <small>    
                                        Birth Date:
                                        <cite title="Student Birth Date" class="lighter red"> 524524 </cite>                                    
                                    </small>
                                 
                               
                            </blockquote>
                            <blockquote class="pull-right">
                               gdfgdgdf
                            </blockquote>
                            
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <blockquote>
                                 <span class='lighter red bolder'><i class="ace-icon fa fa-cogs"></i>&nbsp; Enrollment Information </span>                                
                               
                                    <small>        
                                        <span class="green"> Class Level: </span>
                                        <cite title="Class level"> sgdrgf</cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Class: </span>
                                        <cite title="Class"> dfbgc</cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Medium: </span>
                                        <cite title="Class level">bgbdg </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Shift: </span>
                                        <cite title="Class level"> yggy </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Group: </span>
                                        <cite title="Class level"> yhgj </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Section: </span>
                                        <cite title="Class level"> A </cite>                                    
                                    </small>
                                    <small>        
                                        <span class="green"> Session: </span>
                                        <cite title="Class level"> 2015 </cite>                                    
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
                <form action="<?php echo admin_Url(); ?>/assigncourse/insertassigncourse" method="post">
                    
                    <div class="row">
                        <div class="col-xs-12">
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
                                 
                                    <tr>
                                        <td class="center">
                                           1 
                                        </td>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" checked='checked'  name="courseId[]" value="" class="ace" />
                                                
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <a href="#">557</a>
                                        </td>
                                        <td>5648
                                        </td>
                                        <td class="hidden-480">
                                               dgdh
                                        </td>
                                        <td class="hidden-480">
                                              fcbbc
                                            <input type='hidden' name='employeeId[]' value=''>
                                        </td>
                                        <td>
                                           dfgdfg
                                            <input type='hidden' name='courseStatus[]' value=''>
                                        </td>
                                    </tr>
                                 
                                </tbody>
                            </table>   
                        <input type="hidden" value="" name="programOfferId">
                        <input type="hidden" value="" name="studentId">
                  
                    <button class="btn btn-danger"  onclick="return checkConfirm('To Select Assigned Subject?');" name="confirmReg">
                        <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                        Submit To Assign Course
                    </button>
                </form> 
                
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->



