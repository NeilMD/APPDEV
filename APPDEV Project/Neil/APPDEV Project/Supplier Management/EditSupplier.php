<!DOCTYPE html>

<?php
	$self = $_SERVER['PHP_SELF'];
	if(isset($_POST['addProduct'])){
		session_start();
		$_SESSION['supplierID'] = $_POST['supplierID'];
		$_SESSION['supplierName'] = $_POST['supplierName'];
		$_SESSION['supplierContactPerson'] = $_POST['supplierContactPerson'];
		$_SESSION['supplierAddress'] = $_POST['supplierAddress'];
		$_SESSION['contactNum'] = $_POST['contactNum'];
		$_SESSION['emailAddress'] = $_POST['emailAddress'];
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."/AddProduct.php");
	}
	
	if(isset($_POST['change'])){
		session_start();
		$_SESSION['newSupplierContactPerson'] = $_POST['supplierContactPerson'];
		$_SESSION['newSupplierAddress'] = $_POST['supplierAddress'];
		$_SESSION['newContactNum'] = $_POST['contactNum'];
		$_SESSION['newEmailAddress'] = $_POST['emailAddress'];
		
		$_SESSION['supplierID'] = $_POST['supplierID'];
		$_SESSION['supplierName'] = $_POST['supplierName'];
		
		$_SESSION['oldSupplierContactPerson'] = $_POST['old_supplierContactPerson'];
		$_SESSION['oldSupplierAddress'] = $_POST['old_supplierAddress'];
		$_SESSION['oldContactNum'] = $_POST['old_contactNum'];
		$_SESSION['oldEmailAddress'] = $_POST['old_emailAddress'];
		
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."/EditSupplierConfirmation.php");
		
	}
	
	if(isset($_POST['edit'])){
		$error = NULL;

		if(empty($_POST['supplier'])){
			$error.= "<p>Error: Please select a supplier before proceeding </p>";
		}		
		
		if(isset($error)){
			echo '<font color="red">'.$error.'</font>';
		}	
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
						$query = "SELECT *
								    FROM supplier;";
						
						$result=mysqli_query($databaseConnection,$query);
						
						//BODY
						while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
							echo "<tr>
									<td align=\"center\"> {$row['supplierID']} </td>
									<td align=\"center\"> {$row['supplierName']}</td>
									<td align=\"center\"> <input type = 'radio' name = \"supplier\" value={$row['supplierID']} /> </td>
								  </tr>";	
						}
						
						echo '</table>';
						echo '<input  type="submit" name="edit" value="Edit Selected Supplier">';
					?>
				</form>
		</fieldset>
		
		<?php 
			if(isset($_POST['edit']) AND isset($_POST['supplier'])){
				
				$supplierID = $_POST['supplier'];
				$self = $_SERVER['PHP_SELF'];
				
				$query = "SELECT *
						    FROM supplier
							WHERE supplierID = $supplierID;";
				
				require_once("/../DatabaseConnect.php");
				
				$result = mysqli_query($databaseConnection,$query);
				$row=mysqli_fetch_array($result,MYSQL_ASSOC);
				
				echo "<fieldset>";
					echo "<legend> Editing Supplier: {$row['supplierName']} </legend>";
					echo "<form action=\"$self\" method='POST'>";
						echo "<input type=\"Submit\" name=\"editSupplier\" value=\"Edit supplier details\">";
						echo "<input type=\"Submit\" name=\"addProduct\" value=\"Add product for supplier\">";
						
						/* Hidden fields */
						echo "<input type=\"hidden\" name=\"supplierID\" value=\"{$row['supplierID']}\">";
						echo "<input type=\"hidden\" name=\"supplierName\" value=\"{$row['supplierName']}\">";
						echo "<input type=\"hidden\" name=\"supplierContactPerson\" value=\"{$row['supplierContactPerson']}\">";
						echo "<input type=\"hidden\" name=\"supplierAddress\" value=\"{$row['supplierAddress']}\" />";
						echo "<input type=\"hidden\" name=\"contactNum\" value=\"{$row['contactNum']}\">";
						echo "<input type=\"hidden\" name=\"emailAddress\" value=\"{$row['emailAddress']}\">";
					echo "</form>";
				echo "</fieldset>";
			}
			
			if(isset($_POST['editSupplier'])) {
				$supplierID = $_POST['supplierID'];
				$supplierName = $_POST['supplierName'];
				$supplierContactPerson = $_POST['supplierContactPerson'];
				$supplierAddress = $_POST['supplierAddress'];
				$contactNum = $_POST['contactNum'];
				$emailAddress = $_POST['emailAddress'];
				
				echo "<form method=\"post\" action=\"$self\">";
				echo "<fieldset>";
				echo "<legend> Editing Supplier Details: $supplierName </legend>";
				
				echo "Supplier ID: $supplierID <br />";
				echo "Name: $supplierName <br />";
				echo "Contact Person: <input type=\"text\" name=\"supplierContactPerson\" value=\"$supplierContactPerson\" /> <br />";	
				echo "Address: <input type=\"text\" name=\"supplierAddress\" value=\"$supplierAddress\" /> <br />";	
				echo "Contact Number: <input type=\"text\" name=\"contactNum\" value=\"$contactNum\" /> <br />";	
				echo "E-mail Address: <input type=\"text\" name=\"emailAddress\" value=\"$emailAddress\" /> <br />";
				
				echo "<input type=\"hidden\" name=\"supplierID\" value=$supplierID />";
				echo "<input type=\"hidden\" name=\"supplierName\" value=\"$supplierName\" />";
				
				echo "<input type=\"hidden\" name=\"old_supplierContactPerson\" value=\"$supplierContactPerson\" />";
				echo "<input type=\"hidden\" name=\"old_supplierAddress\" value=\"$supplierAddress\" />";
				echo "<input type=\"hidden\" name=\"old_contactNum\" value=\"$supplierContactPerson\" />";
				echo "<input type=\"hidden\" name=\"old_emailAddress\" value=\"$emailAddress\" />";
				
				echo "<input type=\"Submit\" name=\"change\" value=\"Proceed with changes\" /> <br />";
				
				echo "</fieldset>";
				echo "</form>";
			}		
		?>
		<a href="SupplierMain.php"> Go back to Main </a>
	</body>
</html>