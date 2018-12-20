<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content"> 
<!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
        <i class="ace-icon fa fa-exchange green"></i>
Exam Routine 
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
        
        

            <!-- div.table-responsive -->

          
           	<div class="row">
                    
			<div class="col-xs-12">          
                   <?php
            if (!empty($examroutine)) {
                ?>
                <div class="row">
                    
                    <div class="col-xs-11">
                              <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                             <i class="ace-icon fa fa-bullhorn"></i>
                                Exam Routine Information of <strong><?php echo getProgramName($programinfo['programId']);   ?></strong>
                            
                        </h3>

                        

                        <div class="widget-toolbar hidden-480">
                            <i class="ace-icon fa fa-print"></i>
                                <a href="<?php echo base_url('systemaccess/examroutine/printexamroutine/'.$programOfferId); ?>" role="button" class="green" > Print Exam Routine </a>
                                
                            
                        </div>
                       
                    </div>

                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th>Sl No.</th>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Subject</th>
                                    <th>room</th>
                                    <th>Time Slot</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($examroutine as $value) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php if (!empty($value['date'])) { echo $value['date'];
                                                    }
                                                    ?> </td>
                                        <td> <?php
                                            $timestamp = strtotime($value['date']);
                                            $day = date('l', $timestamp);
                                            
                                            echo $day;
                                       ?> </td>
                                        <td> <?php
                                        if(!empty($value['courseId'])){  echo getCourseName($value['courseId']);   }
                                       ?> </td>
                                        <td>
                                                <?php
                                        if(!empty($value['room'])){  echo $value['room'];   }
                                       ?> 
                                        </td>
                                        <td>    <?php
                                        if(!empty($value['examtime'])){  echo $value['examtime'];   }
                                       ?></td>
                                        

                                      
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
    </div>
</div>
        </div>
    

    
    
    
    
    
