<!DOCTYPE html>

<?php
	$self = $_SERVER['PHP_SELF'];
	
	if(isset($_POST['edit'])){
		session_start();
		$_SESSION['supplierID'] = $_POST['supplier'];
		
		$query = "SELECT supplierName 
					FROM supplier
				  WHERE supplierID = {$_POST['supplier']}";
		
		$result=mysqli_query($databaseConnection,$query);
		
		$row=mysqli_fetch_array($result,MYSQL_ASSOC);
		
		$_SESSION['supplierName' ] = $row['supplierName'];
		
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."/AddProduct.php");	
	}
?>
<html>
	<head> 
		<title>
			Edit Supplier
		</title>

	</head>
<!-- --------------------------- -->
	<body>
		<fieldset>
			<legend align="center"> Select supplier to edit  </legend>
				<form method="GET" action="<?php echo $self; ?>"> 
					Search the ID of supplier <br />
					<input type="number"  min=0 required="required" name="filter" />
					<input type="Submit" value="Search ID" name="searchID" />
				</form>
				<br/>
				<form method="GET" action="<?php echo $self; ?>"> 
					Search the name of the supplier <br />
					<input type="text" required="required" name="filter" />
					<input type="Submit" value="search Name" name="searchName" />
				</form>
				<br />
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<?php
						echo '<table width="75%" border="1" align="center" cellpadding="0" 	cellspacing="0" bordercolor="#000000">';
						
						// TITLE 
						echo '
							  <tr>
								<b>
								  <td align="center" style="width:0.6%"> Supplier ID</td>
								  <td align="center" style="width:10%"> Supplier Name</td>
								  <td align="center" style="width:2%"> Option</td>
								  
								</b>
							   </tr>';
						
						require_once("/../DatabaseConnect.php");
						
						$query ="";
						if(isset($_GET['searchID'])){
							$query = "SELECT *
										FROM supplier
									   WHERE supplierID = {$_GET['filter']};";
						}else if(isset($_GET['searchName'])){
							$query = "SELECT *
										FROM supplier
									   WHERE supplierName LIKE '%{$_GET['filter']}%';";
						}else{
							$query = "SELECT *
										FROM supplier;";
						}
						
						
						$result=mysqli_query($databaseConnection,$query);
						
						//BODY
						while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
							echo "<tr>
									<td align=\"center\"> {$row['supplierID']} </td>
									<td align=\"center\"> {$row['supplierName']}</td>
									<td align=\"center\"> <input type = 'radio' name = \"supplier\" required=\"required\" value={$row['supplierID']} /> </td>
								  </tr>";	
						}
						
						echo '</table>';
						echo '<input  type="submit" name="edit" value="Edit Selected Supplier">';
					?>
				</form>
		</fieldset>
		<a href="SupplierMain.php"> Go back to Main </a>
	</body>
</html>