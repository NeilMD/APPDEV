<!DOCTYPE html>
<?php
	session_start();
	$supplierID = $_SESSION['supplierID'];
	$supplierName = $_SESSION['supplierName'];
	$self = $_SERVER['PHP_SELF'];
	
	if(isset($_POST['createProduct'])){
		
		$productName = $_POST['productName'];
		$size = $_POST['size'];
		$unit = $_POST['unit'];
		$brand = $_POST['brand'];
		$content = $_POST['content'];
		$measurement = $_POST['measurement'];
		
		require_once("/../DatabaseConnect.php");
		
		$query = "INSERT INTO product (productName, size, unit, brand, content, measurement)
				                VALUES('$productName', '$size', '$unit', '$brand', '$content', '$measurement');";
		
		$result = mysqli_query($databaseConnection,$query);
		
		if($result){
			echo "<font color=\"green\"><p> Product Succesfully Created. </p></font>";
		}else{
			echo "<font color=\"red\"><p> Product Creation Failed.</p> </font>";
		}
					
	}
	
	
	if(isset($_POST['insertProduct'])){
		
		$productID = $_POST['pro'];
		$price = $_POST['price'];
		
		require_once("/../DatabaseConnect.php");
		
		$query = "INSERT INTO prices (productID, supplierID, price)
						VALUES('$productID', '$supplierID', $price);";	 
						
		$result = mysqli_query($databaseConnection,$query);
		
		if($result){
			echo "<font color=\"green\"><p> Product Succesfully Added.</p> </font>";
		}else{
			echo "<font color=\"red\"><p> Product Addition Failed.</p> </font>";
		}
	}
	
	if(isset($_POST['return'])){
		unset($_SESSION['supplierID']);
		unset($_SESSION['supplierName']);
		unset($_SESSION['supplierContactPerson']);
		unset($_SESSION['supplierAddress']);
		unset($_SESSION['contactNum']);
		unset($_SESSION['emailAddress']);
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."/AddProductSelectSupplier.php");
	}
	
	
	if(isset($_POST['options'])){
		$option = $_POST['options'];
		if($option == "Remove selected product"){
			$query = "DELETE FROM prices 
							 WHERE productID = {$_POST['product']}
							   AND supplierID = $supplierID;";
			
			require_once("/../DatabaseConnect.php");
			
			$result = mysqli_query($databaseConnection,$query);
			
			if($result){
				echo "<font color=\"green\"><p>Succesfully Deleted!</p> </font>";
			}else{
				echo "<font color=\"red\"><p>Product Deletion failed!</p> </font>";
			}
			echo $query;
			
		}
	}
?>
<html>
	<head> 
		<title>
			Add Product for supplier
		</title>

	</head>
	
	
	<body>
		<fieldset>
		<legend align="left"> Currently Editing Supplier </legend>
			<?php
				echo "Suplier ID: $supplierID <br />";
				echo "Suplier Name: $supplierName <br />";
			?>
		</fieldset>
		
		<form action="<?php echo $self ?>"  method="POST" >
		<fieldset>
			<legend align="center"> Products List </legend>
			<?php
				echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">';
				
				require_once("/../DatabaseConnect.php");
				$query = "SELECT *
							FROM product
						   WHERE productID NOT IN (SELECT productID
													 FROM prices
													WHERE supplierID = $supplierID);";
				$result = mysqli_query($databaseConnection,$query);
				
				// TITLE 
				echo '
					  <tr>
						<b>
						  <td align="center"> Product ID </td>
						  <td align="center"> Product Name </td>
						  <td align="center"> Size </td>
						  <td align="center"> Unit </td>
						  <td align="center"> Brand </td>
						  <td align="center"> Content </td>
						  <td align="center"> Measurement </td>
						  <td align="center"> Option </td>
						</b>
					   </tr>';
				
				//BODY
				while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
					echo "<tr>
						<td align=\"right\"> {$row['productID']}</td>
						<td align=\"left\">  {$row['productName']}</td>
						<td align=\"left\">  {$row['size']}</td>
						<td align=\"left\">  {$row['unit']}</td>
						<td align=\"left\">  {$row['brand']}</td>
						<td align=\"left\">  {$row['content']}</td>
						<td align=\"left\">  {$row['measurement']}</td>
						
						<td align=\"center\"> <input type='radio' name=\"product\" value={$row['productID']} />
					  </tr>";
				}
				echo '</table>';
				
				echo "<br />";
				echo "<input type=\"submit\" value =\"Add selected product to supplier\" name=\"addProduct\" />
					  <br />
					  <input type=\"submit\" value =\"Create new product\" name=\"newProduct\" />" ;
			?>
		</fieldset>
		</form>
		
		<?php
			if(isset($_POST['addProduct']) AND isset($_POST['product'])){
				$query = "SELECT *
							FROM product
						   WHERE productID = {$_POST['product']};";
				
				$result = mysqli_query($databaseConnection,$query);

				$row = mysqli_fetch_array($result,MYSQL_ASSOC);
				
				echo "<form action=\"$self\" method=\"POST\">";
				
				echo "<fieldset>";
				echo "<legend> Enter product details </legend>";
				
				echo "ID: {$row['productID']}<br />";
				echo "Name: {$row['productName']}<br />";
				echo "Size: {$row['size']}<br />";
				echo "Unit: {$row['unit']}<br />";
				echo "Brand: {$row['brand']}<br />";
				echo "Content: {$row['content']}<br />";
				echo "Measurement: {$row['measurement']}<br />";
				echo "Price: <input type=\"number\" step=\"any\" min=\"0\" name=\"price\" /><br />";
				echo "<input type=\"hidden\" name=\"pro\" value=\"{$row['productID']}\" /><br />";
				
				echo "<input type=\"Submit\" name=\"insertProduct\" value=\"Create Product\" />";
				echo "</fieldset>";
				
				echo "</form>";
			}	
		?>
		
		<?php
			if(isset($_POST['newProduct'])){
				echo "<form action=\"$self\" method=\"POST\">";
				echo "<fieldset>";
				echo "<legend> Enter product details </legend>";
				echo "Name: <input required=\"required\" type=\"text\" name=\"productName\" /><br />";
				echo "Size*: <input type=\"text\" name=\"size\" /><br />";
				echo "Unit: <input required=\"required\" type=\"text\" name=\"unit\" /><br />";
				echo "Brand*: <input type=\"text\" name=\"brand\" /><br />";
				echo "Content*: <input type=\"text\" name=\"content\" /><br />";
				echo "Measurement*: <input type=\"text\" name=\"measurement\" /><br />";
				echo "*Optional field<br />";
				echo "<input type=\"Submit\" name=\"createProduct\" value=\"Create Product\" />";
				echo "</fieldset>";
				echo "</form>";			
			}
		?>
		
		
		
		<fieldset>
			<legend align="center"> Supplier's Current Available Products </legend>
			
			<?php
				echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">';
				
				require_once("/../DatabaseConnect.php");
				$query = "SELECT p.productID, p.productName, p.size, p.unit, p.brand, p.content, p.measurement, pr.price
							FROM product p JOIN prices pr
										     ON p.productID = pr.productID
										   JOIN supplier s
										     ON pr.supplierID = s.supplierID
						    WHERE s.supplierID = $supplierID;
               ";
			   
				$result = mysqli_query($databaseConnection,$query);
				
				// TITLE 
				echo '
					  <tr>
						<b>
						  <td align="center"> Product ID </td>
						  <td align="center"> Product Name </td>
						  <td align="center"> Size </td>
						  <td align="center"> Unit </td>
						  <td align="center"> Brand </td>
						  <td align="center"> Content </td>
						  <td align="center"> Measurement </td>
						  <td align="center"> Price </td>
						  <td align="center"> Option </td>
						</b>
					   </tr>';
					  
				// BODY
				echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\" >";
				while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
					echo "<tr>
						<td align=\"right\"> {$row['productID']}</td>
						<td align=\"left\"> {$row['productName']}</td>
						<td align=\"left\"> {$row['size']}</td>
						<td align=\"left\"> {$row['unit']}</td>
						<td align=\"left\"> {$row['brand']}</td>
						<td align=\"left\"> {$row['content']}</td>
						<td align=\"left\"> {$row['measurement']}</td>
						<td align=\"left\"> {$row['price']} </td>
						<td align=\"center\"> <input required=\"required\" name=\"product\" type=\"radio\" value={$row['productID']} > </option> </td>
					  </tr>";
				}
				
				echo '</table>';
				
				echo "<input type=\"Submit\"  name=\"options\" value=\"Remove selected product\" />";
				// echo "<input type=\"Submit\"  name=\"options\" value=\"Edit selected product\" />";
				
				echo "</form>";
			?>
		</fieldset>
		
		<form action="<?php echo $self ?>" method="post" >
			<input type="Submit" name="return" value="Return to supplier selection" />
		</form>
	</body>
</html>