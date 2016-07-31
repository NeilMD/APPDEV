<!DOCTYPE html>
<?php
	session_start();
	$username = $_SESSION['username'];
	$newPassword = $_SESSION['newPassword'];
	$newAffiliation = $_SESSION['newAffiliation'];
	$newEmail = $_SESSION['newEmail'];
	$newMobile = $_SESSION['newMobile'];
	$newFullname = $_SESSION['newFullname'];

	$oldPassword = $_SESSION['old_password'];
	$oldAffiliation = $_SESSION['old_affiliation'];
	$oldEmail = $_SESSION['old_email'];
	$oldMobile = $_SESSION['old_mobile'];
	$oldFullname = $_SESSION['old_fullname'];
	
	if(isset($_POST['proceed'])){
		require_once("/../DatabaseConnect.php");
		$query = "UPDATE user
				  SET userPassword = '$newPassword'
					 ,affiliation = '$newAffiliation'
				     ,email = '$newEmail'
					 ,mobile = '$newMobile'
					 ,fullName = '$newFullname'
				 WHERE userName = '$username';
				";
		mysqli_query($databaseConnection,$query);
		
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['affiliation']);
		unset($_SESSION['email']);
		unset($_SESSION['mobile']);
		unset($_SESSION['fullname']);
		
		unset($_SESSION['old_password']);
		unset($_SESSION['old_affiliation']);
		unset($_SESSION['old_email']);
		unset($_SESSION['old_mobile']);
		unset($_SESSION['old_fullname']);
		
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/EditUsers.php");
		
	}
	
	if(isset($_POST['cancel'])){
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['affiliation']);
		unset($_SESSION['email']);
		unset($_SESSION['mobile']);
		unset($_SESSION['fullname']);
		
		unset($_SESSION['old_password']);
		unset($_SESSION['old_affiliation']);
		unset($_SESSION['old_email']);
		unset($_SESSION['old_mobile']);
		unset($_SESSION['old_fullname']);
		
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/EditUsers.php");
	}
?>
<html>
	<head> 
		<title>
			Edit User Confirmation
		</title>

	</head>
	
	
	<body>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
		<fieldset>
			<legend align="left"> <?php echo "Proceed with changes for user $username?" ?></legend>
			<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

				<tr> 
					<td> </td>
				<!--	<td> Password </td> -->
					<td> Affiliation </td>
					<td> E-mail</td>
					<td> Mobile </td>
					<td> Fullname </td>
				</tr>
				
				<tr>
					<td> OLD </td>
					<!-- <td> <?php echo $oldPassword; ?> </td> -->
					<td> <?php echo $oldAffiliation; ?>  </td>
					<td> <?php echo $oldEmail; ?>  </td>
					<td> <?php echo $oldMobile; ?>  </td>
					<td> <?php echo $oldFullname; ?>  </td>	
				</tr>
				
				<tr>
					<td> NEW </td>
					<!-- <td> <?php echo $newPassword; ?> </td> -->	
					<td> <?php echo $newAffiliation; ?>  </td>
					<td> <?php echo $newEmail; ?>  </td>
					<td> <?php echo $newMobile; ?>  </td>
					<td> <?php echo $newFullname; ?>  </td>
				</tr>
			</table>
			
			<input type="Submit" name="proceed" value="Proceed with changes">
		</fieldset>
		</form>
		
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
			<input type="Submit" value="Cancel Changes" name="cancel" />
		</form>
	</body>
</html>