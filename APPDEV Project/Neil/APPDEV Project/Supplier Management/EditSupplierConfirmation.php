<!DOCTYPE html>
<?php
	$self = $_SERVER['PHP_SELF'];
	
	session_start();
	
	if(isset($_POST['cancel'])){
		unset($_SESSION['newSupplierContactPerson']);
		unset($_SESSION['newSupplierAddress']);
		unset($_SESSION['newContactNum']);
		unset($_SESSION['newEmailAddress']);
		
		unset($_SESSION['supplierID']);
		unset($_SESSION['supplierName']);
		
		unset($_SESSION['oldSupplierContactPerson']);
		unset($_SESSION['oldSupplierAddress']);
		unset($_SESSION['oldContactNum']);
		unset($_SESSION['oldEmailAddress']);
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."/EditSupplier.php");
	}
	
	$newSupplierContactPerson = $_SESSION['newSupplierContactPerson'];
	$newSupplierAddress = $_SESSION['newSupplierAddress'];
	$newContactNum = $_SESSION['newContactNum'];
	$newEmailAddress = $_SESSION['newEmailAddress'];
	
	$supplierID = $_SESSION['supplierID'];
	$supplierName = $_SESSION['supplierName'];
	
	$oldSupplierContactPerson = $_SESSION['oldSupplierContactPerson'];
	$oldSupplierAddress = $_SESSION['oldSupplierAddress'];
	$oldContactNum = $_SESSION['oldContactNum'];
	$oldEmailAddress = $_SESSION['oldEmailAddress'] ;
	
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
		mysqli_query($databaseConnection,$query);
	
		unset($_SESSION['newSupplierContactPerson']);
		unset($_SESSION['newSupplierAddress']);
		unset($_SESSION['newContactNum']);
		unset($_SESSION['newEmailAddress']);
		
		unset($_SESSION['supplierID']);
		unset($_SESSION['supplierName']);
		
		unset($_SESSION['oldSupplierContactPerson']);
		unset($_SESSION['oldSupplierAddress']);
		unset($_SESSION['oldContactNum']);
		unset($_SESSION['oldEmailAddress']);
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
		<form method="POST" action="<?php echo $self; ?>"> 
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
					<td> <?php echo $oldSupplierContactPerson; ?> </td>
					<td> <?php echo $oldSupplierAddress; ?>  </td>
					<td> <?php echo $oldContactNum; ?>  </td>
					<td> <?php echo $oldEmailAddress; ?>  </td>
				</tr>
				
				<tr>
					<td> NEW </td>
					<td> <?php echo $newSupplierContactPerson; ?> </td>
					<td> <?php echo $newSupplierAddress; ?>  </td>
					<td> <?php echo $newContactNum; ?>  </td>
					<td> <?php echo $newEmailAddress; ?>  </td>
				</tr>
			</table>
			
			<input type="Submit" name="proceed" value="Proceed with changes">
		</fieldset>
		</form>
		
		<form action="<?php echo $self ?>" method="post" >
			<input type="Submit" name="cancel" value="Cancel Changes" />
		</form>
	</body>
</html>