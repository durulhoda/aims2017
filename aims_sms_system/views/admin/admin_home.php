<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="AIMS- Academic Management System">
	<meta name="author" content="School Management System">
        <script type="text/javascript">
        function check_delete()
        {
            
            var chk=confirm('Are You Sure to delete This?');
            if(chk){
                return true;
                
            }
            else{
                return false;
            }
        }
        
        function check_publish()
        {
            
            var chk=confirm('Are You Sure to publish This?');
            if(chk){
                return true;
                
            }
            else{
                return false;
            }
        }
        
        function check_unpublish()
        {
            
            var chk=confirm('Are You Sure to unpublish This?');
            if(chk){
                return true;
                
            }
            else{
                return false;
            }
        }
        
     
       
        </script>

	<!-- The styles -->
	<link href="<?php echo base_url();?>adminasstes/css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo base_url();?>adminasstes/css/bootstrap-responsive.css" rel="stylesheet">
<!--        <link href="<?php echo base_url();?>adminasstes/css/bootstrap-spacelab.css" rel="stylesheet">-->
	<link href="<?php echo base_url();?>adminasstes/css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo base_url();?>adminasstes/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo base_url();?>adminasstes/css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo base_url();?>adminasstes/css/chosen.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>adminasstes/css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo base_url();?>adminasstes/img/favicon.ico">
        
        <link rel="stylesheet" href="<?php echo base_url();?>adminasstes/editor/themes/default/default.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>adminasstes/editor/plugins/code/prettify.css" />
	<script charset="utf-8" src="<?php echo base_url();?>adminasstes/editor/kindeditor.js"></script>
	<script charset="utf-8" src="<?php echo base_url();?>adminasstes/editor/plugins/code/prettify.js"></script>
		
</head>

<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo base_url();?>dashboard"> <img alt="AIMS" src="<?php echo base_url();?>adminasstes/img/logo20.png" /> <span>AIMS</span></a>
				
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $this->session->userdata('admin_name'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
                                                <li><a href="<?php echo base_url();?>dashboard/admin_logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a target="_blank" href="<?php echo base_url(); ?>">Visit Site</a></li>
						<li class="navbar-search span2 pull-left">
                                                    <script>
                                                          var d = new Date(); 
                                                            document.write (d.toDateString());
                                                    </script>   
                                                    
							
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="<?php echo base_url()?>dashboard"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						                                     
                                                <?php
                                        //        $access_level = $this->session->userdata('access_level');
                                        //        if($access_level==1)
                                         //       {
                                                ?>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/contentmessage"><i class="icon-picture"></i><span class="hidden-tablet">About Institute Content</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/viewcontentmessage"><i class="icon-picture"></i><span class="hidden-tablet">View About Content</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/academiccontent"><i class="icon-picture"></i><span class="hidden-tablet">Academic Content</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/viewacademiccontent"><i class="icon-picture"></i><span class="hidden-tablet">View Academic Content</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/honorboard"><i class="icon-picture"></i><span class="hidden-tablet">Honor Board Content</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/viewhonorboard"><i class="icon-picture"></i><span class="hidden-tablet">View Honor Board</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/management"><i class="icon-picture"></i><span class="hidden-tablet">Add Member & Employee</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/managementlist"><i class="icon-picture"></i><span class="hidden-tablet">Member & Employee List</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/addResult"><i class="icon-picture"></i><span class="hidden-tablet">Add Result Summery</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/resultlist"><i class="icon-picture"></i><span class="hidden-tablet">View Result Summery</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/MeritStudent"><i class="icon-picture"></i><span class="hidden-tablet">Merit Student List</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/viewMeritStudentlist"><i class="icon-picture"></i><span class="hidden-tablet">View Merit Student List</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/addphoto"><i class="icon-picture"></i><span class="hidden-tablet">Insert Image</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/viewphoto"><i class="icon-picture"></i><span class="hidden-tablet">View Image</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/contact"><i class="icon-picture"></i><span class="hidden-tablet">Add Contact</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/contactlist"><i class="icon-picture"></i><span class="hidden-tablet">View Contact</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/career"><i class="icon-picture"></i><span class="hidden-tablet">Career</span></a></li>
                                                    <li><a class="ajax-link" href="<?php echo base_url();?>dashboard/viewjobinfo"><i class="icon-picture"></i><span class="hidden-tablet">Career List</span></a></li>
                                                    
			  
                                                <?php
                                        //        }
                                           
                                                ?>    
                                          
                                              
					</ul>
<!-- 
					<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
				 -->
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			
			<div id="content" class="span10">
			<!-- content starts -->
			
                        <?php
                        if(isset($breadcrumb)){
                        
                        ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url()?>super_admin">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url()?>super_admin">Dashboard</a>
					</li>
				</ul>
			</div>
                         <?php
                        }

                        
                        ?>
			
			<?php echo $admin_maincontent; ?>
</div>

    <footer>
        <br>
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="#" target="_blank">AIMS</a> 2014</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://www.adventure-soft.com">adventure-soft</a></p>
    </footer>
 
                         </div> </div>
	<!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo base_url();?>adminasstes/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?php echo base_url();?>adminasstes/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo base_url();?>adminasstes/js/jquery.dataTables.min.js'></script>

	

	<!-- select or dropdown enhancer -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo base_url();?>adminasstes/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo base_url();?>adminasstes/js/charisma.js"></script>
	
		
</body>
</html>
