<!DOCTYPE html>
<html>
	<head> 
		<title>
			View Suppliers
		</title>
	</head>	
<!-- -----------------  -->
	<body>
		<fieldset>
			<legend align="center"> Suppliers List </legend>
			
			<?php
				require_once("/../DatabaseConnect.php");
				$query = "SELECT *
						    FROM supplier;";
				$result=mysqli_query($databaseConnection,$query);
				
				echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">';
				
				// TITLE 
				echo '
					  <tr>
						<b>
						  <td align="center"> Supplier ID </td>
						  <td align="center"> Supplier Name </td>
						  <td align="center"> Supplier Contact Person </td>
						  <td align="center"> Supplier Address </td>
						  <td align="center"> Contact Num </td>
						  <td align="center"> Email Address </td>		
						</b>
					   </tr>';
				
				//BODY
				while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
					echo "<tr>
							<td align=\"left\"> {$row['supplierID']}</td>
							<td align=\"left\"> {$row['supplierName']}</td>
							<td align=\"left\"> {$row['supplierContactPerson']}</td>
							<td align=\"left\"> {$row['supplierAddress']}</td>
							<td align=\"center\"> {$row['contactNum']}</td>
							<td align=\"left\"> {$row['emailAddress']}</td>
						  </tr>";	
				}
				echo '</table>';
			?>
		</fieldset>
		<a href= "<?php echo $_SERVER['PHP_SELF']; ?>"> Refresh </a>  <br />
		<a href="SupplierMain.php"> Go back to Main </a>
		
	</body>
</html>