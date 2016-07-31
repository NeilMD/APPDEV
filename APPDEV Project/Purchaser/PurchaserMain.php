<!DOCTYPE html>
<?php
	session_start();
	$username = $_SESSION['username'];
	$fullname = $_SESSION['fullname'];
	$affiliation = $_SESSION['affiliation'];
?>
<html>
	<head> 
		<title>
			Purchaser Menu
		</title>
	</head>
	
	<body>
		
		<fieldset>
			<legend> <b> <font size="10%"> Purchaser Menu </font> </b> </legend>
			Hello, <?php echo $fullname; ?>!
			
			<ol style="list-style-type:disc">
			  <li> <a href="RequisitionView.php"> Create Purchaser Order </a> </li>
			  <li> <a href="ViewPurchaseOrders.php"> View Purchaser Orders </a> </li>
			  <li> <a href="\..\APPDEV Project\Supplier Management\SupplierMain.php"> Manage Suppliers </a> </li>
			</ol> 
			
		</fieldset>
		
		<form method="GET"	action="/../APPDEV Project/Session.php">
			<input type="Submit" value="log-out" name="logout" />
		</form>
	</body>
</html>