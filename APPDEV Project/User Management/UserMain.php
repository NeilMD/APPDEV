<!DOCTYPE html>
<?php
	session_start();
	$username = $_SESSION['username'];
	$fullname = $_SESSION['fullname'];
	$affiliation = $_SESSION['affiliation'];
?>
<html>
	<head> 
		<title>
			User Accounts Administration
		</title>

	</head>
	
	<body>
		
		<fieldset>
			<legend> <b> <font size="10%"> User Account Administration </font> </b> </legend>
			Hello, <?php echo $fullname; ?>!
			
			<ol style="list-style-type:disc">
			  <li> <a href="CreateUser.php"> Create user </a> </li>
			  <li> <a href="ViewUsers.php"> View users  </a> </li>
			  <li> <a href="EditUsers.php"> Edit users  </a> </li>
			</ol> 
			
		</fieldset>
		
		<form method="GET"	action="/../APPDEV Project/Session.php">
			<input type="Submit" value="log-out" name="logout" />
		</form>
	</body>
</html>