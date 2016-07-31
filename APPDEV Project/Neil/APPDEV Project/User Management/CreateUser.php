<!DOCTYPE html>

<?php
	$self = $_SERVER['PHP_SELF'];
	
	if(isset($_POST['submit'])){
		$errorMessage = NULL;
		$valid = true;
		
		if(empty($_POST["username"] )) {
			$errorMessage .= "<b> <p> Error: Username field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST["password"] )) {
			$errorMessage .= "<b> <p> Error: Password field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST['repassword'])){
			$errorMessage .= "<b> <p> Error: Please re-type your password.</p> </b>";
			$valid = false;
		}
		if(empty($_POST["affiliation"] )) {
			$errorMessage .= "<b> <p> Error: Affiliation field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST['email'])){
			$errorMessage .= "<b> <p> Error: E-mail field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST['mobile'])){
			$errorMessage .= "<b> <p> Error: Mobile field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST['fullname'])){
			$errorMessage .= "<b> <p> Error: Fullname field empty</p> </b>";
			$valid = false;
		}
		
		if($_POST['password'] != $_POST['repassword']){
			$errorMessage .= "<b><p> Error: Password does not match the retyped password</p></b>";
			$valid = false;
		}
		
		if($valid){
			require_once("\..\DatabaseConnect.php");
			require_once("\..\Cryptosystem.php");
			
			$username = $_POST["username"];
			$password = encrypt($_POST['password']);
			$affiliation = $_POST["affiliation"];
			$email = $_POST["email"];
			$mobile = $_POST["mobile"];
			$fullname = $_POST['fullname'];

			$query = "INSERT INTO user (userName, userPassword, affiliation, email, mobile, fullName) 
					  VALUES ('$username', '$password', '$affiliation', '$email', '$mobile', '$fullname');";
					  
			$result = mysqli_query($databaseConnection,$query);
			
			if($result){
				header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."/UserMain.php");
			}else{
				$errorMessage .= "<p>User creation failed!</p>"."<p>$query</p>";
			}
		}
		
		if(isset($errorMessage)){
			echo '<font color="red">'.$errorMessage.'</font>';
		}
		
	}// end of submit
?>
<html>

	<head> 
		<title> 
			Create User Page
		</title>
	</head>
<!-- -----------------  -->
	<body>
		
		<form method="post" action="<?php echo $self; ?>">
			<fieldset>
					<legend> Please fill in the user information below </legend>
				Fullname:        <input type="text" maxlength=60 name="fullname" value="<?php 
																						if(isset($_POST['fullname'])){
																							echo $_POST['fullname'];
																						}																				  
																					?>" /> <br />
				Username:     <input type="text" maxlength=25 name="username" value= "<?php 
																						if(isset($_POST['username'])){
																							echo $_POST['username'];
																						}
																					?>" /> <br />
				Affiliation:  <select name="affiliation">
								<option value="Vice president">Vice president</option>
								<option value="Engineer"> Engineer</option>
								<option value="Purchaser">Purchaser </option>
								<option value="Admin">Admin</option>
							</select>
							<br />
				E-mail:         <input type="email" maxlength=45 name="email" value="<?php 
																					if(isset($_POST['email'])){
																						echo $_POST['email'];
																					}																				  
																				?>" /><br />
				Mobile:        <input type="number_format" maxlength=13 name="mobile" value="<?php 
																							if(isset($_POST['mobile'])){
																								echo $_POST['mobile'];
																							}																			  
																						  ?>"/> <br />
				Password:      <input type="password" maxlength=45 name="password" /><br />
				Re-type Password:     <input type="password" maxlength=45 name="repassword" /><br />
				<input type="submit" value="Create User" name="submit"> </input> 
			</fieldset>
		</form>
		
		
		<a href="UserMain.php">  <- Cancel User Creation </a>
		
	</body>
</html>