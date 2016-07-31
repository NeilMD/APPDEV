<!DOCTYPE html>
<?php
	$self = $_SERVER['PHP_SELF'];

				
	$newSupplierContactPerson = $_POST['newSupplierContactPerson'];
	$newSupplierAddress = $_POST['newSupplierAddress'];
	$newContactNum = $_POST['newContactNum'];
	$newEmailAddress = $_POST['newEmailAddress'];
	
	$supplierID = $_POST['supplierID'];
	$supplierName = $_POST['supplierName'];
	
	$old_SupplierContactPerson = $_POST['old_supplierContactPerson'];
	$old_SupplierAddress = $_POST['old_supplierAddress'];
	$old_ContactNum = $_POST['old_contactNum'];
	$old_EmailAddress = $_POST['old_emailAddress'] ;
	
	if(isset($_POST['proceed'])){
		$query = "
				UPDATE supplier
				SET supplierContactPerson = '$newSupplierContactPerson'
				   ,supplierAddress = '$newSupplierAddress'
				   ,contactNum = '$newContactNum'
				   ,emailAddress = '$newEmailAddress'
				WHERE supplierID = $supplierID;
				";
		
		require_once("\..\DatabaseConnect.php");
		$result = mysqli_query($databaseConnection,$query);
		
		if(!$result){
			echo $query;
		}
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."/EditSupplier.php");
	}
?>
<html>
	<head> 
		<title>
			Edit Supplier Confirmation
		</title>

	</head>
	<body>		
		<fieldset>
			<legend align="left"> <?php echo "Proceed with changes for supplier \"$supplierName\" with ID \"$supplierID\"?" ?></legend>
			<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

				<tr> 
					<td> </td>
					<td> Contact Person </td>
					<td> Supplier Address </td>
					<td> Contact Number</td>
					<td> E-mail address </td>
				</tr>
				
				<tr>
					<td> OLD </td>
					<td> <?php echo $old_SupplierContactPerson; ?> </td>
					<td> <?php echo $old_SupplierAddress; ?>  </td>
					<td> <?php echo $old_ContactNum; ?>  </td>
					<td> <?php echo $old_EmailAddress; ?>  </td>
				</tr>
				
				<tr>
					<td> NEW </td>
					<td> <?php echo $newSupplierContactPerson; ?> </td>
					<td> <?php echo $newSupplierAddress; ?>  </td>
					<td> <?php echo $newContactNum; ?>  </td>
					<td> <?php echo $newEmailAddress; ?>  </td>
				</tr>
			</table>
			
			<form method="POST" action="<?php echo $self; ?>"> 
				<input type="Submit" name="proceed" value="Proceed with changes">
				
				<input type="hidden" name="newSupplierContactPerson" value="<?php echo $newSupplierContactPerson ?>" />
				<input type="hidden" name="newSupplierAddress" value="<?php echo $newSupplierAddress ?>" />
				<input type="hidden" name="newContactNum" value="<?php echo $newContactNum ?>" />
				<input type="hidden" name="newEmailAddress" value="<?php echo $newEmailAddress ?>" />	
				
				<input type="hidden" name="supplierID" value="<?php echo $supplierID ?>" />
				<input type="hidden" name="supplierName" value="<?php echo $supplierName ?>" />
				
				<input type="hidden" name="old_supplierContactPerson" value="<?php echo $old_SupplierContactPerson ?>" />
				<input type="hidden" name="old_supplierAddress" value="<?php echo $old_SupplierAddress ?>" />
				<input type="hidden" name="old_contactNum" value="<?php echo $old_ContactNum ?>" />
				<input type="hidden" name="old_emailAddress" value="<?php echo $old_EmailAddress ?>" />
			</form>
		</fieldset>
		
		
		<form action="EditSupplier.php" method="GET" >
			<input type="Submit" name="cancel" value="Cancel Changes" />
		</form>
	</body>
</html>