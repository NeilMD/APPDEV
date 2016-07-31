<!DOCTYPE html>

<?php
	
	
	function loginUser($username, $affiliation, $fullname, $header){
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['affiliation'] = $affiliation;
		$_SESSION['fullname'] = $fullname;
		header($header);
	}
	
	$self = $_SERVER['PHP_SELF'];
	
	$error = NULL;
	if(isset($_POST['login'])){
		$valid = TRUE;
		if(empty($_POST['username'])){
			$error .= "Username field empty! <br />";
			$valid = FALSE;
		}
		if(empty($_POST['password'])){
			$error .= "Password field empty! <br />";
			$valid = FALSE;
		}
		if($valid){
			require_once("\..\..\Cryptosystem.php");
			require_once("\..\..\DatabaseConnect.php");
			
			$query = "SELECT userName as username,
							 userPassword as password,
							 affiliation,
							 fullName as fullname
					    FROM user
					    WHERE username = '{$_POST['username']}';";
			
			//echo $query;
			$result = mysqli_query($databaseConnection,$query);
			$row = mysqli_fetch_array($result, MYSQL_ASSOC);
			
			if(empty($row)){	
				$error .= "User does not exist!.<br />";
				$valid = FALSE;
			}else{
				$password = decrypt($row['password']);
				if($password != $_POST['password']){
					$error .= "Incorrect password!.<br />";
				}else{
					$username = $row['username'];
					$affiliation = $row['affiliation'];
					$fullname = $row['fullname'];
					$header = null;
					
					if($affiliation == "Vice president"){
						
						 
						$header = "Location: ../../Forms/purchaseOrderCreating.php";
						
						$temp ="Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."\VpDashboard.php";
					}else if($affiliation =="Engineer"){
						
					}else if($affiliation =="Purchaser"){
						
					}else if($affiliation =="Admin"){
						$header = "Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."\..\..\User Management\UserMain.php";
					}
					loginUser($username, $affiliation, $fullname, $header);
					//echo $affiliation;
					
				}		
			}
		}
		
	}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Global Lands Develop and Invest Corporation - Project Management Information System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
div.relative {
	width: 100%;
    position: relative;
	top: 70px;
	
}
#logo
{
	width:800px;
	margin-left: auto;
	margin-right: auto;
}
</style>

</head>

<body>
<div class="relative">
<div class="row">
  <div class="col-lg-12">
  
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="business-people-working-on-computer-web-header.jpg" alt="Global Lands Develop and Invest Corporation">
    </div>

    <div class="item">
      <img src="commercial-tall-buildings-blue-web-header.jpg" alt="Chania">
    </div>

    <div class="item">
      <img src="Construction-Accidents-Header.jpg" alt="Flower">
    </div>

    
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
  
  </div>
  
  </div>

 </div>
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><b>Please Log In</b></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo $self ?>" method="POST" ">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                
								<?php
									if(isset($error) AND isset($_POST['login'])){
										echo "<font color=\"red\">$error</font>";
									}
								?>
                                <!-- Change this to a button or input when using this as a form -->
								<input type="Submit" name="login" value="Login" class="btn btn-lg btn-success btn-block" />
								 <!-- 
                                <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>
								-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
			
		
		
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
