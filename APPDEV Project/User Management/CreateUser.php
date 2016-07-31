<!DOCTYPE html>

<?php
	$self = $_SERVER['PHP_SELF'];
	
	if(isset($_POST['submit'])){
		$errorMessage = NULL;

		if($_POST['password'] != $_POST['repassword']){
			$errorMessage .= "<p>Password mismatch.</p>";
		}
			
		
		if(isset($errorMessage)){
			echo '<font color="red">'.$errorMessage.'</font>';
		}else{
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
				echo "<font color=\"green\" > User created!  </font>";
			}else{
				$errorMessage .= "<p>User creation failed! User may already exist </p>";
			}
		}
		
		if(isset($errorMessage)){
			echo "<font color=\"red\">$errorMessage</font>";
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
				Fullname:        <input required="required" autocomplete="on" type="text" maxlength=60 name="fullname"  /> <br />
				
				Username:     <input required="required" autocomplete="on" type="text" maxlength=25 name="username"  /> <br />
				
				Affiliation:  <select required="required" autocomplete="on" name="affiliation">
								<option> </option>
								<option value="Vice President">Vice President</option>
								<option value="Engineer"> Engineer</option>
								<option value="Purchaser">Purchaser </option>
								<option value="Admin">Admin</option>
							</select>
							<br />
							
				E-mail:         <input autocomplete="on" type="email" maxlength=45 name="email" /><br />
				Mobile:        <input  autocomplete="on" type="number_format" maxlength=13  name="mobile" /> <br />
				Password:      <input required="required" type="password" maxlength=45 name="password" /><br />
				Re-type Password: <input required="required" type="password" maxlength=45 name="repassword" /><br />
				
				<input type="submit" value="Create User" name="submit"> </input> 
			</fieldset>
		</form>
		
		
		<a href="UserMain.php">  <- Cancel User Creation </a>
		
	</body>
</html>