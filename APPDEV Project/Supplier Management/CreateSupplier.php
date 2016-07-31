<!DOCTYPE html>

<?php
	if(isset($_POST['submit'])){
		$errorMessage = NULL;

		
		require_once("\..\DatabaseConnect.php");
		
		$supplierName = $_POST["suppliername"];
		$supplierContactPerson = $_POST["suppliercontactperson"];
		$emailAddress = $_POST["email"];
		$contactNum = $_POST["mobile"];
		$supplierAddress = $_POST['supplieraddress'];
		
		$query = "INSERT INTO supplier (supplierName, supplierContactPerson, supplierAddress, contactNum, emailAddress) 
				  VALUES ('$supplierName', '$supplierContactPerson', '$supplierAddress' , '$contactNum' , '$emailAddress') ;";
				  
		$result = mysqli_query($databaseConnection,$query);
		
		if($result){
			echo "<p>Supplier created! </p>";
			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/SupplierMain.php");
		}else{
			$errorMessage .= "<p>User creation failed!</p>";
		}
		
		if(isset($errorMessage)){
			echo '<font color="red">'.$errorMessage.'</font>';
		}
	}// end of submit
?>
<html>

	<head> 
		<title> 
			Create User Page
		</title>
	</head>
<!-- -----------------  -->
	<body>
		
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
					<legend> Please fill in the supplier information below </legend>
				Supplier Name       <input type="text" required="required" autocomplete="on" maxlength=60 name="suppliername"  /> <br />
				Supplier Contact Person  <input type="text" required="required" autocomplete="on" maxlength=25 name="suppliercontactperson"  /> <br />
				Supplier Address <input type="text" required="required" autocomplete="on"  maxlength=25 name="supplieraddress"  /> <br />
				E-mail        <input type="text" required="required" autocomplete="on" maxlength=45 name="email" /><br />
				Mobile       <input type="number_format" required="required" autocomplete="on" maxlength=13 name="mobile" /> <br />
				<input type="submit" value="Create Supplier" name="submit"> </input> 
			</fieldset>
		</form>
		
		<a href="SupplierMain.php">  <- Cancel supplier creation </a>
		
	</body>
</html>