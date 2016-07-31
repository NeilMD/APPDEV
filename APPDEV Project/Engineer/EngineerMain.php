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
			Project Engineer Menu
		</title>

	</head>
	
	<body>
		
		<fieldset>
			<legend> <b> <font size="10%"> Project Engineer Main </font> </b> </legend>
			Hello, <?php echo $fullname; ?>!
			
			<ol style="list-style-type:disc">
			  <li> <a href="PurchaseOrderList.php"> Confirm Purchase Order Delivery</a> </li>
			  <li> <a href="..\Neil\APPDEV Project\Forms\purchaseRequisitionForm.php"> Create Requisition Form </a> </li>
			  <li> <a href="..\Neil\startbootstrap-sb-admin-2-1.0.8
			  \pages\ProjectList_backend.php">View Project List</a> </li>
			</ol> 
			
		</fieldset>
		
		<form method="GET"	action="/../APPDEV Project/Session.php">
			<input type="Submit" value="log-out" name="logout" />
		</form>
	</body>
</html>