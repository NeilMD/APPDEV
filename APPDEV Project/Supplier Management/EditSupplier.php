<!DOCTYPE html>

<?php
	$self = $_SERVER['PHP_SELF'];
?>
<html>
	<head> 
		<title>
			Edit Supplier Product
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
									<td align=\"center\"> <input type=\"radio\" required=\"required\" name = \"supplier\" value={$row['supplierID']} /> </td>
								  </tr>";	
						}
						
						echo '</table>';
						echo '<input  type="submit" name="editSupplier" value="Edit Selected Supplier">';
					?>
				</form>
		</fieldset>
		
		<?php 
			if(isset($_POST['editSupplier'])) {
				$supplierID = $_POST['supplier'];
				
				$query = "SELECT *
						    FROM supplier
							WHERE supplierID = $supplierID;";
				
				require_once("/../DatabaseConnect.php");
				
				$result = mysqli_query($databaseConnection,$query);
				$row = mysqli_fetch_array($result,MYSQL_ASSOC);
				
				$supplierName = $row['supplierName'];
				$supplierContactPerson = $row['supplierContactPerson'];
				$supplierAddress = $row['supplierAddress'];
				$contactNum = $row['contactNum'];
				$emailAddress = $row	['emailAddress'];
				
				echo "<form method=\"post\" action=\"EditSupplierConfirmation.php\">";
				echo "<fieldset>";
				echo "<legend> Editing Supplier Details: $supplierName </legend>";
				
				echo "Supplier ID: $supplierID <br />";
				echo "Name: $supplierName <br />";
				
				
				echo "Contact Person: <input required=\"required\" autocomplete=\"on\" type=\"text\" name=\"newSupplierContactPerson\" value=\"$supplierContactPerson\" /> <br />";	
				echo "Address: <input required=\"required\" autocomplete=\"on\" type=\"text\"  type=\"text\" name=\"newSupplierAddress\" value=\"$supplierAddress\" /> <br />";	
				echo "Contact Number: <input required=\"required\" autocomplete=\"on\" type=\"text\"  type=\"text\" name=\"newContactNum\" value=\"$contactNum\" /> <br />";	
				echo "E-mail Address: <input required=\"required\" autocomplete=\"on\" type=\"text\"  type=\"text\" name=\"newEmailAddress\" value=\"$emailAddress\" /> <br />";
				
				echo "<input type=\"hidden\" name=\"supplierID\" value=$supplierID />";
				echo "<input type=\"hidden\" name=\"supplierName\" value=\"$supplierName\" />";
				
				echo "<input type=\"hidden\" name=\"old_supplierContactPerson\" value=\"$supplierContactPerson\" />";
				echo "<input type=\"hidden\" name=\"old_supplierAddress\" value=\"$supplierAddress\" />";
				echo "<input type=\"hidden\" name=\"old_contactNum\" value=\"$contactNum\" />";
				echo "<input type=\"hidden\" name=\"old_emailAddress\" value=\"$emailAddress\" />";
				
				echo "<input type=\"Submit\" name=\"change\" value=\"Proceed with changes\" /> <br />";
				
				echo "</fieldset>";
				echo "</form>";
			}		
		?>
		<a href="SupplierMain.php"> Go back to Main </a>
	</body>
</html>