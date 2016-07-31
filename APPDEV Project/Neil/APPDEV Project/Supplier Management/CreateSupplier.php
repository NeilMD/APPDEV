<!DOCTYPE html>

<?php
	if(isset($_POST['submit'])){
		$errorMessage = NULL;
		$valid = true;
		
		if(empty($_POST["suppliername"]))  {
			$errorMessage .= "<b> <p> Error: Supplier Name field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST["supplieraddress"] )) {
			$errorMessage .= "<b> <p> Error: Supplier Address field empty</p> </b>";
			$valid = false;
		}

		if(empty($_POST['suppliercontactperson'])){
			$errorMessage .= "<b> <p> Error: Supplier contact person field empty</p> </b>";
			$valid = false;
		}
		
		if($valid){
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
				Supplier Name       <input type="text" maxlength=60 name="suppliername" value="<?php 
																						if(isset($_POST['suppliername'])){
																							echo $_POST['suppliername'];
																						}																				  
																					?>" /> <br />
				Supplier Contact Person  <input type="text" maxlength=25 name="suppliercontactperson" value= "<?php 
																						if(isset($_POST['suppliercontactperson'])){
																							echo $_POST['suppliercontactperson'];
																						}
																					?>" /> <br />
				Supplier Address <input type="text" maxlength=25 name="supplieraddress" value="<?php 
																						if(isset($_POST['supplieraddress'])){
																							echo $_POST['supplieraddress'];
																						}																				  
																					  ?>" /> <br />
				E-mail        <input type="text" maxlength=45 name="email" value="<?php 
																					if(isset($_POST['email'])){
																						echo $_POST['email'];
																					}																				  
																				?>" /><br />
				Mobile       <input type="number_format" maxlength=13 name="mobile" value="<?php 
																							if(isset($_POST['mobile'])){
																								echo $_POST['mobile'];
																							}																			  
																						  ?>"/> <br />
				<input type="submit" value="Create Supplier" name="submit"> </input> 
			</fieldset>
		</form>
		
		<a href="SupplierMain.php">  <- Cancel supplier creation </a>
		
	</body>
</html>