<!DOCTYPE html>
<?php
	$self = $_SERVER['PHP_SELF'];
	
	session_start();
	$username = $_SESSION['username'];
	$affiliation = $_SESSION['affiliation'];
	$fullname = $_SESSION['fullname'];	
	
	if(isset($_POST['logout'])){
		
	}
	
	
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">	
    <meta name="author" content="">
	<link rel="icon" href="background.png">

    <title>Global Lands Develop and Invest Corporation - Project Management Information System</title>

   <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link href="cloud.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
div.relative {
    position: relative;
	top: 40px;
    left: 365px;x
}
</style>
	
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <div clxass="row">
					<div class="col-lg-2 iconpad">
						<img src="background.png" width="150" height="60"> </img>
					</div>
					<div class="col-lg-10">
						<a class="navbar-brand" href="index.html" style="font-size: 20px">  Global Lands Develop and Invest Corporation - Project Management Information System</a>
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					
					
					
					
				</div>
            </div>
            <!-- /.navbar-header -->

           <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-tasks fa-fw" style="font-size: 20px"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks" >
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Creating  Project Plans</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Updating Status Report</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Creating Charter Report</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Monitoring Site</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Projects</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw" style="font-size: 20px"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        
                        <li>
                            <a href="login.html"> 
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i>  New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> New Report
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
				
				
                <li class="dropdown">
				<form action="<?php echo $self ?>" method="POST">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" style="font-size: 20px"></i>  <i class="fa fa-caret-down"></i>
                    </a>
					
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
	
						<li class="divider"></li>
                        <li><input type="Submit" value ="Log-out" name="logout" />
						
                        </li>
                    </ul>
				
					
				</form>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
			<div> <p> </p> </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html" style="font-size: 18px"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
							
                        </li>
						
						
                      
                        
						
						
						<li>
						  <a href="#" style="font-size: 18px"><i class="fa fa-sitemap fa-fw"></i>Projects<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
						
						
						
						<li>
                            <a href="vpProjectCharter.html"><i class="fa fa-plus"></i> Add a Project</a>
                        </li>
						
						
						
						<li>
                            <a href="vpProjectsView.html"><i class="fa fa-th fa-fw"></i> All Projects</a>
							
                        </li>
						
						
                        <li>
                            <a href="#"><i class="fa fa-star fa-fw"></i>Priority Projects<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Ejercito 888<span></span></a>
                                    
                                    <!-- /.nav-third-level -->
                                </li>
								<li>
                                    <a href="#">Soledad 888</a>
                                    <ul class="nav nav-third-level">
                                      
							

									
                                       
                                       
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
								
								                                <li>
                                    <a href="#">Felipe 888</a>
                                   
                                    <!-- /.nav-third-level -->
                                </li>
								
                            </ul>
							
							
							</ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						
						  <li>
						  <a href="#" style="font-size: 18px"><i class="fa fa-bar-chart-o fa-fw"></i>Forecast Charts<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
						
						
						<li>
                            <a href="forecast.html"><i class="fa fa-bar-chart-o fa-fw"></i> Project Cost Chart</a>
							
                        </li>
						
						
                        <li>
                            <a href="forecast_material.html"><i class="fa fa-bar-chart-o fa-fw"></i>Construction Materials Chart</a>
						
							
							
							</ul>
                            <!-- /.nav-second-level -->
                        </li>
						</li>
						
						
						</li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> <div class="background-image"><form class="fonttext" style="font-size: 70px"><?php echo"Welcome, $fullname"; ?></form></div>
					
					 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
			
            <div class="row">
               
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-play fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div style="font-size: 20px">Overall Progress Tasks</div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-times fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">2</div>
                                    <div style="font-size: 20px">Overall Delayed Tasks</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            
                        </a>
						
						
						
                    </div>
					
					
					
					
					
                </div>
					
			
			
					 <div class="col-lg-4 padBodyTop" style="font-size: 20px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <i class="fa fa-renren fa-fw style" style="font-size: 20px"></i> Project Completion Pie Chart 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
				
				<div class="col-lg-9 padBodyTop2">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw style" style="font-size: 20px"></i> <span style="font-size: 20px">Construction Project Schedule Overview </span>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Sort By
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Latest Projects</a>
                                        </li>
                                        <li><a href="#">Oldest Projects</a>
                                        </li>
                                        <li><a href="#">Near Completion Projects</a>
                                        </li>
                                        <li class="divider"></li>
                                        
                                    </ul>
                                </div>
                            </div>
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
							<div></div>
							
							 <div>
                                    <p>
                                        <a href="index.html"><strong style="font-size: 15px">Ejercito 888</strong></a>
                                        <span class="pull-right text-muted" style="font-size: 15px">50% In Progress</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                            <span class="sr-only">50% Complete</span>
                                        </div>
                                    </div>
                                </div>
								
								<div>
                                    <p>
                                       <a href="index.html"> <strong style="font-size: 15px">Soledad 888</strong> </a>
                                        <span class="pull-right text-muted" style="font-size: 15px">85% In Progress</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                                            <span class="sr-only">85% Complete</span>
                                        </div>
                                    </div>
                                </div>
								
								
								

								<div>
                                    <p>
                                    <a href="index.html">    <strong style="font-size: 15px">Collette 888</strong> 
                                        <span class="pull-right text-muted" style="font-size: 15px">65% Delayed</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                            <span class="sr-only">65% Complete</span>
                                        </div>
                                    </div>
                                </div>
								
								
								
								
								<div>
                                    <p>
                                    <a href="index.html">    <strong style="font-size: 15px">Felipe 888</strong> 
                                        <span class="pull-right text-muted" style="font-size: 15px">30% Delayed</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                            <span class="sr-only" >30% Complete</span>
                                        </div>
                                    </div>
                                </div>

								
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <!-- /.panel -->
                    
                    <!-- /.panel -->
                </div>
				
				
				
				
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Flot Charts JavaScript -->
    <script src="../bower_components/flot/excanvas.min.js"></script>
    <script src="../bower_components/flot/jquery.flot.js"></script>
    <script src="../bower_components/flot/jquery.flot.pie.js"></script>
    <script src="../bower_components/flot/jquery.flot.resize.js"></script>
    <script src="../bower_components/flot/jquery.flot.time.js"></script>
    <script src="../bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../js/flot-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
