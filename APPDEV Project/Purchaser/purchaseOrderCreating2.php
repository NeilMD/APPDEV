<!DOCTYPE html>
<html>

	<head> 
		<title> 
			Purchase Order Quantity
		</title>
	</head>
<!-- -----------------  -->
	<body>
		<fieldset>
			<legend>Please quantity of each product</legend>
			<form method="POST" action="purchaseOrderConfirmationCreation.php">
			
			<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
				<tr>
				  <td align="center"><b>Product ID</b></td>
				  <td align="center"><b>Product Name</b></td>
				  <td align="center"><b>Size</b></td>
				  <td align="center"><b>Unit</b></td>
				  <td align="center"><b>Brand</b></td>
				  <td align="center"><b>Content</b></td>
				  <td align="center"><b>Measurement</b></td>
				  <td align="center"><b>Price</b></td>
				  <td align="center"><b>Quantity</b></td>
				</tr>
			<?php
				$products = $_POST['products'];
				$count = count($products);
				$PRID = $_POST['purchaseRequisition'];
				
				for($i = 0; $i < $count; $i++){
					$query = "SELECT pr.productID, productName, size, unit, brand, content, measurement, price
										FROM (SELECT *
												FROM prices
											   WHERE supplierID = {$_POST['supplier']}) pr JOIN product p
																		                     ON pr.productID = p.productID
							   WHERE pr.productID = {$products[$i]};";
					require_once("/../DatabaseConnect.php");
					$result = mysqli_query($databaseConnection,$query);
					$row = mysqli_fetch_array($result,MYSQL_ASSOC);
							  
					echo" 
							<tr>
							  <td align=\"right\">{$row['productID']}</td>
							  <td align=\"left\">{$row['productName']}</td>
							  <td align=\"left\">{$row['size']}</td>
							  <td align=\"left\">{$row['unit']}</td>
							  <td align=\"left\">{$row['brand']}</td>
							  <td align=\"left\">{$row['content']}</td>
							  <td align=\"left\">{$row['measurement']}</td>
							  <td align=\"left\">{$row['price']}</td>
							  
							  <td align=\"center\"><input name=\"productQ$i\" required=\"required\" autocomplete=\"on\" type=\"number\" min=1  /></td>
							  
							  <input name=\"productID$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value={$row['productID']} />

							  <input name=\"productName$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"{$row['productName']}\" /> 
							  <input name=\"productSize$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"{$row['size']}\" />
							  <input name=\"productUnit$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"{$row['unit']}\" />
							  <input name=\"productBrand$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"{$row['brand']}\" />
							  <input name=\"productContent$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"{$row['content']}\" /> 
							  <input name=\"productMeasurement$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"{$row['measurement']}\" />
							  <input name=\"productPrice$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"{$row['price']}\" />
							</tr>";
				}
				
			?>
			</table>
			
			
				<input type="hidden" name="count" value=<?php echo $count ?> />
				<input type="hidden" name="shippingterms"value="<?php echo $_POST['shippingterms']; ?>" />
				<input type="hidden" name="shippingmethod"value="<?php echo $_POST['shippingmethod']; ?>" />
				<input type="hidden" name="deliveryAddress"value="<?php echo $_POST['deliveryAddress']; ?>" />
				<input type="hidden" name="dateYear" value="<?php echo $_POST['dateYear']; ?>" />
				<input type="hidden" name="dateMonth" value="<?php echo $_POST['dateMonth']; ?>"/>
				<input type="hidden" name="dateDay" value="<?php echo $_POST['dateDay']; ?>" />
				<input type="hidden" name="supplier" value=<?php echo $_POST['supplier']; ?> />
				<input type="hidden" name="purchaseRequisition" value=<?php echo $_POST['purchaseRequisition']; ?> />
				
				<input type="Submit" name="submit" value="Submit" />
			</form>
		</fieldset>
		<form action="purchaseOrderCreating.php" method="POST" >
			<input type="Submit" name="cancel" value="Cancel" />
			<input type="hidden" name="purchaseRequisition" value=<?php echo $_POST['purchaseRequisition']; ?> />
		</form>
	</body>
</html>