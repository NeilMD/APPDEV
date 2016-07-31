<!DOCTYPE html>
<html>

	<head> 
		<title> 
			Confirm creation of Purchase Order
		</title>
	</head>
<!-- -----------------  -->
	<body>
		<fieldset>
			<legend>Confirm Purchase Order? </legend>
			<form method="POST" action="purchaseOrderCreating.php">
			
			<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
				<tr>
				  <td align="center"><b>Product ID</b></td>
				  <td align="center"><b>Product Name</b></td>
				  <td align="center"><b>Unit</b></td>
				  <td align="center"><b>Quantity</b></td>
				  <td align="center"><b>Unit Price (Php)</b></td>
				  <td align="center"><b>Unit Total (Php)</b></td>
				  
				  
				</tr>
			<?php
				$totalPrice = 0.0;
				
				$count = $_POST['count'];
				$PRID = $_POST['purchaseRequisition'];
				
				for($i = 0; $i < $count; $i++){
					$productID = $_POST["productID$i"];
					$productName = $_POST["productName$i"];
					$productUnit = $_POST["productUnit$i"];
					$productPrice = $_POST["productPrice$i"];
					$productQuantity = $_POST["productQ$i"];
					$unitTotal = $productPrice*$productQuantity;
					$totalPrice += $unitTotal;
					echo" 
							<tr>
							  <td align=\"right\">$productID</td>
							  <td align=\"left\">$productName</td>
							  <td align=\"left\">$productUnit</td>
							  <td align=\"right\">$productQuantity</td>
							  <td align=\"right\">$productPrice</td>
							  <td align=\"right\">$unitTotal</td>
							  
							  <input name=\"productID$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=$productID />
							  <input name=\"productQ$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=$productQuantity />
							</tr>";
				}
				
				echo "<tr><td colspan=5></td><td align=\"right\"><b>Grand Total: </b>$totalPrice</td></tr>";
				
			?>
			<!--
							<input name=\"productName$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"$productName\" /> 
							  <input name=\"productSize$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"$productSize\" />
							  <input name=\"productUnit$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"$productUnit\" />
							  <input name=\"productBrand$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"$productBrand\" />
							  <input name=\"productContent$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"$productContents\" /> 
							  <input name=\"productMeasurement$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"$productMeasurement\" />
							  <input name=\"productPrice$i\" required=\"required\" autocomplete=\"on\" type=\"hidden\" value=\"$productPrice\" />
			-->
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