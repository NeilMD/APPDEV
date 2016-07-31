<!DOCTYPE html>

<?php	

	session_start();
	echo $_SESSION['fullname'];
	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
	$affiliation = $_SESSION['affiliation'];
	
	if(isset($_POST['submit'])){
		$errorMessage = NULL;
		$valid = true;
		
		if(empty($_POST["project"]))
		{
			$errorMessage .= "<b> <p> Error: Project name field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST["supplier"] )) {
			$errorMessage .= "<b> <p> Error: Supplier field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST["shippingmethod"] )) {
			$errorMessage .= "<b> <p> Error: shipping method field empty</p> </b>";
			$valid = false;
		}
		if(empty($_POST["shippingterms"])){
			$errowMessage = "<b> <p> Error: shipping terms field empty</p> </b>";
			$valid = false;
		}
				
		if(isset($errorMessage)){
			echo '<font color="red">'.$errorMessage.'</font>';
		}
		
		if($valid){
			require_once("\..\DatabaseConnect.php");
			$projectname = $_POST["project"];
			$supplier = $_POST["supplier"];
			$shippingmethod = $_POST["shippingmethod"];
			$shippingterms = $_POST["shippingterms"];
			$approvedBy = 'Agnes So';
			$actual_time=date("D M Y, time()");
	
			$query = "INSERT INTO purchaseOrder 
					  VALUES ( 1,'$actual_time', '$supplier', '$_SESSION[fullname]', '$shippingmethod', '$shippingterms', '$approvedBy','$username','$projectname');";
			//missing: projectname, supplier, preparedBy, approvedBy
			
			$result = mysqli_query($databaseConnection,$query);
			
			if($result){
				echo "<p>Purchase order created! </p>";
				header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/main.php");
			}else{
				print_r($result);
				echo "<p>Purchase order creation failed!</p>"."<p>$query</p>";
			}
			
			
		}
	}
		//INSERT INTO user (username, password, affilliation)
		//VALUES ('cloud','1234','Success')
		
		
		
	// end of submit
?>
<html>

	<head> 
		<title> 
			Create purchase order page
		</title>
	</head>
<!-- -----------------  -->
	<body>
		
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
					<legend> Please fill in the purchase order information below </legend>
				Project Name <select name="project">
				<option> </option>	
								<?php
								require_once("/../DatabaseConnect.php");
									$query="SELECT *
											  FROM projectcharter;";
											 
									
									
									$result = mysqli_query($databaseConnection,$query);
									
									while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
										echo "<option value={$row['projectCharterID']}>{$row['projectName']}</option>";
									}
								?>
							</select> <br />	
							
				Supplier    <select name="supplier">
								<option> </option>
								<?php
									$query="SELECT * 
											  FROM supplier;";
											  
									require_once("/../DatabaseConnect.php");
									
									$result = mysqli_query($databaseConnection,$query);
									
									while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
										echo "<option value={$row['supplierID']}>{$row['supplierName']}</option>";
									}
								?>
							</select> <br />
				Shipping Terms     <input type="text" maxlength=45 name="shippingterms" value= "<?php if(isset($_POST['shippingterms']))
																								{ echo $_POST['shippingterms'];} ?>" /><br />
				Shipping Method     <input type="text" maxlength=45 name="shippingmethod" value= "<?php if(isset($_POST['shippingmethod']))
																								{ echo $_POST['shippingmethod'];} ?>" /><br />
				
				<input type="submit" value="Create Purchase Order" name="submit"> </input> 
			</fieldset>
		</form>
		
		<a href="Main.php">  <- Cancel Purchase Order Creation </a>
		
	</body>
</html>