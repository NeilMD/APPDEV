<!DOCTYPE html>

<html>
	<head> 
		<title>
			Edit Users
		</title>
	</head>
<!-- -----------------  -->	

<?php
	session_start();
	
	if(empty($_SESSION['fullname'])){
		$_SESSION['fullname'] = 'Juliano B. Laguio';
		$_SESSION['username'] = 'Lian';
		$_SESSION['affiliation'] = 'Engineer';
	}
	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
	$affiliation = $_SESSION['affiliation'];
	
	if(isset($_POST['proceed'])){
		$error = NULL;
		$isValid = true;
		
		require_once("/../DatabaseConnect.php");
		require_once("/../Cryptosystem.php");
		
		$query = "SELECT *
					FROM user
				  WHERE  userName = '$username';";
				  
		$result = mysqli_query($databaseConnection,$query);
		$row = mysqli_fetch_array($result,MYSQL_ASSOC);
		
		if( $_POST['password'] != decrypt($row['userPassword']) ){
			$isValid = false;
			
			$error .= "<p> Invalid password  </p>";
		}
		
		
		if($isValid){
			session_start();
			$_SESSION['newPassword'] = $_POST['password'];
			$_SESSION['newAffiliation'] = $_POST['affiliation'];
			$_SESSION['newEmail'] = $_POST['email'];
			$_SESSION['newMobile'] = $_POST['mobile'];
			$_SESSION['newFullname'] = $_POST['fullname'];
			
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['old_password'] = $_POST['old_password'];
			$_SESSION['old_affiliation'] = $_POST['old_affiliation'];
			$_SESSION['old_email'] = $_POST['old_email'];
			$_SESSION['old_mobile'] = $_POST['old_mobile'];
			$_SESSION['old_fullname'] = $_POST['old_fullname'];
			
			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/EditUsersConfirmation.php");
		}
		
		if(isset($error)){
			echo "<font color=\"red\">".$error."</font>";
		}
	}
?>
	<body>
		<fieldset>
			<legend align="center"> Select user to edit  </legend>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					Search for username: <br />
					<input type="text" name="filter"  required="required" autocomplete="" />
					<input type="Submit" name="search" value="Search" />
				</form>
				<br />
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<?php
						echo '<table width="75%" border="1" align="center" cellpadding="0" 	cellspacing="0" bordercolor="#000000">';
						
						// TITLE 
						echo '
							  <tr>
								  <td align="center" style="width:80%"> Usernames </td>
								  <td align="center" style="width:20%"> Options </td>
							   </tr>';
						
						require_once("/../DatabaseConnect.php");
						
						$query = "";
						if(isset($_POST['search'])){
							$query = "SELECT *
										FROM USER
									  WHERE username LIKE '%{$_POST['filter']}%';";
						}else{
							$query = "SELECT *
									FROM user;";
						}
						
						
						$result=mysqli_query($databaseConnection,$query);
						
						//BODY
						$control = 0;
						while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
							echo "<tr>
									<td align=\"center\" > {$row['userName']}</td>
									<td align=\"center\"> 
									<input type = 'radio' required=\"required\" autocomplete=\"on\" name = \"user\" value=\"{$row['userName']}\" \>
					
									</td>
									
								  </tr>";	
							++$control;
						}
						
						
						echo '</table>';
						echo '<input  type="submit" name="submit" value="Edit Selected User">';
					?>
				</form>
		</fieldset>
		
		<?php
			if(isset($_POST['submit'])){
				require_once("/../DatabaseConnect.php");
				$query = "SELECT *
							FROM user
						   WHERE userName = '{$_POST['user']}';";
				
				$result=mysqli_query($databaseConnection,$query);
				
				if($result){
					$row=mysqli_fetch_array($result, MYSQL_ASSOC);
					
					$username = $row['userName'];
					$password = $row['userPassword'];
					$affiliation = $row['affiliation'];
					$email =  $row['email'];
					$mobile = $row['mobile'];
					$fullname = $row['fullName'];
					$dateCreated = $row['dateCreated'];
					
					echo '<fieldset>';
					echo '<legend> Fill-in </legend>';
					echo "<form method='post' action=EditUsers.php>";
					//echo "<form method='post' action='EditUsersConfirmation.php'>";
						echo "Username: $username".'<br \>';  // <input type=\"text\" name=\"username\" value=\"$username\" />".'<br />';
						//echo "Password <input type=\"text\" name=\"password\" value=\"$password\" />".'<br />';
						
						$vice = "value=\"Vice president\"";
						$eng = "value=\"Engineer\"";
						$purch = "value=\"Purchaser\"";
						$admin = "value=\"Admin\"";
						
						if($affiliation == "Vice President"){
							$vice .= " selected=\"selected\" ";
						}else if($affiliation == "Engineer"){
							$eng .= "  selected=\"selected\" ";
						}else if($affiliation == "Purchaser"){
							$purch .= "  selected=\"selected\" ";
						}else if($affiliation == "Admin"){
							$admin .= "  selected=\"selected\" ";
						}
						echo "Affiliation:  <select required=\"required\" autocomplete=\"on\" name=\"affiliation\">
												<option> </option>
												<option $vice >Vice President</option>
												<option $eng > Engineer</option>
												<option $purch >Purchaser </option>
												<option $admin >Admin</option>
											</select>
								<br />";
						echo "E-mail <input type=\"text\" name=\"email\" value=\"$email\" />".'<br />';
						echo "Mobile <input type=\"text\" name=\"mobile\" value=\"$mobile\" />".'<br />';
						echo "Fullname <input type=\"text\" name=\"fullname\" required=\"required\" autocomplete=\"on\" value=\"$fullname\" />".'<br />';
						

						echo "Date Created: $dateCreated".'<br /><br />';
						echo "Enter your password below to continue <br />";
						
						echo "Password: <input type=\"password\" name=\"password\" required=\"required\" autocomplete=\"on\"  />".'<br />';
						echo "<input type=\"submit\" name=\"proceed\" value=\"Proceed\">";
						

						echo "<input type=\"hidden\" name=\"username\" value=\"$username\" />";
						echo "<input type=\"hidden\" name=\"old_password\" value=\"$password\" />";
						echo "<input type=\"hidden\" name=\"old_affiliation\" value=\"$affiliation\" />";
						echo "<input type=\"hidden\" name=\"old_email\" value=\"$email\" />";
						echo "<input type=\"hidden\" name=\"old_mobile\" value=\"$mobile\" />";
						echo "<input type=\"hidden\" name=\"old_fullname\" value=\"$fullname\" />";
						
					echo '</form>';
					echo '</fieldset>';
				}					
			}
		?>
		<a href= "<?php echo $_SERVER['PHP_SELF']; ?>"> Refresh </a>  <br />
		<a href="UserMain.php"> Go back to Main </a>
		
	</body>
</html>