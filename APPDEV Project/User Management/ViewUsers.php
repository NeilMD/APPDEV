<!DOCTYPE html>
<html>
	<head> 
		<title>
			View Users
		</title>
	</head>	
<!-- -----------------  -->
	<body>
		<fieldset>
			<legend align="center"> Users List </legend>
			
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					Search for username: <br />
					<input type="text" name="filter" required="required" autocomplete=""  />
					<input type="Submit" name="search" value="Search" />
			</form>
			<br />
				
			<?php
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
				
				echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">';
				
				// TITLE 
				echo '
					  <tr>
						<b>
						  <td align="center"> Username </td>
						  <td align="center"> Affiliation </td>
						  <td align="center"> E-mail </td>
						  <td align="center"> Mobile </td>
						  <td align="center"> Fullname </td>
						  <td align="center"> Date Created </td>
						</b>
					   </tr>';
				
				//BODY
				while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
					echo "<tr>
							<td align=\"left\"> {$row['userName']}</td>
							<td align=\"left\"> {$row['affiliation']}</td>
							<td align=\"left\"> {$row['email']}</td>
							<td align=\"center\"> {$row['mobile']}</td>
							<td align=\"left\"> {$row['fullName']}</td>
							<td align=\"right\"> {$row['dateCreated']}</td>
						  </tr>";	
				}
				echo '</table>';
			?>
		</fieldset>
		<a href= "<?php echo $_SERVER['PHP_SELF']; ?>"> Refresh </a>  <br />
		<a href="UserMain.php"> Go back to Main </a>
		
	</body>
</html>