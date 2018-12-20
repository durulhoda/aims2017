<!-- /Content Section  -->                    
    <div class="page-header">
        <h1>
            Academic Calender
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
                View Event Details
            </small>
        </h1>
    </div><!-- /.page-header -->
<div class="row">
   

    <div class="col-sm-12">       

        <div class="row">
            <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                                Event Information of <b> <?php echo $editData["title"]; ?></b>
                            </h4>
                        </div>

                        <div class="widget-body">
                           
                            <div class="widget-main">
                                <span class='lighter green bolder'><i class="menu-icon fa fa-tachometer"></i>  <?php echo $editData["title"]; ?> from <b> <?php echo $editData["startdate"]; ?> To <?php echo $editData["enddate"]; ?> </b> </span>
                                

                                <hr> 

                                <?php echo $editData["description"]; ?>
                            </div>

                        </div>
                        
                    </div>
                   
                 
                
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->



