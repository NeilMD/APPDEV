<!DOCTYPE html>

<?php	
	session_start();
	
	if(empty($_SESSION['fullname'])){
		$_SESSION['fullname'] = 'Juliano B. Laguio';
		$_SESSION['username'] = 'Lian';
		$_SESSION['affiliation'] = 'Engineer';
	}
	
	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
	$affiliation = $_SESSION['affiliation'];
	
	if(isset($_POST['submit'])){
		require_once("\..\DatabaseConnect.php");
		$supplier = $_POST["supplier"];
		$shippingmethod = $_POST["shippingmethod"];
		$shippingterms = $_POST["shippingterms"];
		$deliveryDate = "{$_POST['dateYear']}-{$_POST['dateMonth']}-{$_POST['dateDay']}";
		$deliveryAddress = $_POST['deliveryAddress'];
		$PRID =  $_POST['purchaseRequisition'];
		$statusID = 2;
		
		$query = "INSERT INTO purchaseorder (supplierID, preparedBy, shippingMethod, shippingTerms, POStatusID, deliveryDate, deliveryAddress, purchaseRequisitionFormID )
					   VALUES               ($supplier,     '$fullname', '$shippingmethod', '$shippingterms', $statusID, '$deliveryDate', '$deliveryAddress', $PRID );";
		$result = mysqli_query($databaseConnection,$query);
	
		if($result){
			echo "<font color=\"green\" ><p>Purchase order created! </p></font>";
		}else{
			echo "<font color=\"red\" ><p>Purchase order creation failed!</p></font>";
		}
		
		$query = "SELECT last_insert_id() as 'ID'
					FROM purchaseorder; ";		
		$result = mysqli_query($databaseConnection,$query);
		$row = mysqli_fetch_array($result,MYSQL_ASSOC);
		$POID = $row['ID'];
		$count = $_POST['count'];
		$query ="";
		for($i = 0; $i < $count; $i++){
				$productQuantity = $_POST["productQ$i"];
				$productID = $_POST["productID$i"];
				$query .= "INSERT INTO orders (PurchaseOrderID, productID, quantity) VALUES ($POID, $productID, $productQuantity);";
		}
		
		$result = mysqli_query($databaseConnection,$query);
		
	}
?>
<html>

	<head> 
		<title> 
			Create purchase order page
		</title>
	</head>
<!-- -----------------  -->
	<body>
		<?php
			$PRID = $_POST['purchaseRequisition'];
			
			$query = "SELECT pr.purchaseRequisitionFormID AS id, pr.date AS date, pr.comments AS comment, p.Title AS title, pc.projectName  AS projectName, pc.projectCharterID
								 FROM purchaserequisitionform pr JOIN phases p
														 		   ON pr.phaseno = p.phaseno 
																  AND pr.projectCharterID = p.projectCharterID
																 JOIN projectcharter pc
																   ON pc.projectCharterID = p.projectCharterID
									WHERE purchaseRequisitionFormID = $PRID;";
			require_once("/../DatabaseConnect.php");
			
			$result = mysqli_query($databaseConnection,$query);
			
			$row = mysqli_fetch_array($result,MYSQL_ASSOC);

			
		?>
		<fieldset>
			<legend align="center"><b><font size=6%>Requisition Form</font></b></legend>
			<br />
			
			<div align="right">
				<b>Date Created:</b> <?php echo $row['date'];?>
			</div>
			<div align="center">
				Project: <br /> 
				<font size=5%>
					<?php echo "{$row['projectName']}" ;?>
				</font>
				<br /> <br/>
				Phase:<br />
				<font size=5%>
					<?php echo "{$row['title']}" ;?>
				</font>	
			</div>
			
			<br />
			<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
				 <tr>
					  <td align="center"> Product ID </td>
					  
					  <td align="center"> Product Name </td>
					  
					   <td align="center"> Size </td>
					   
					  <td align="center"> Unit </td>
					  
					  <td align="center"> Brand </td>
					  
					  <td align="center"> Content </td>
					  
					  <td align="center"> Measurement </td>
				</tr>
				<?php
					$query = "SELECT p.productID, productName, size, unit, brand, content, measurement
								FROM product p JOIN (SELECT *
													   FROM projectChartItem
													  WHERE purchaseRequisitionFormID = $PRID) pc
												 ON p.productID = pc.productID;";
					
					$result = mysqli_query($databaseConnection,$query);
			
					while($productRow = mysqli_fetch_array($result,MYSQL_ASSOC)){
						echo" 
							<tr>
							  <td align=\"right\">{$productRow['productID']}</td>
							  
							  <td align=\"left\">{$productRow['productName']}</td>
							  
							   <td align=\"left\">{$productRow['size']}</td>
							   
							  <td align=\"left\">{$productRow['unit']}</td>
							  
							  <td align=\"left\">{$productRow['brand']}</td>
							  
							  <td align=\"left\">{$productRow['content']}</td>
							  
							  <td align=\"left\">{$productRow['measurement']}</td>
							</tr>	";
					}
				?>
			</table>
			<br />
			
			<font size=5%>
				<b>Comments:</b><br />
			</font>
			<font size=4%>
				<?php echo "{$row['comment']}";?>
			</font>
			
		</fieldset>
		
		<?php
			if(empty($_POST['next'])){
				echo"
				<br/>
				<form method=\"post\" action=\"{$_SERVER['PHP_SELF']} \" >
					<fieldset>
						<legend><b><font size=5%> Please select a supplier before you continue</font></b></legend>
						<br />
						Supplier: <select name=\"supplier\" required=\"required\" autocomplete=\"on\" >
									<option> </option>";
									$query="SELECT * 
											  FROM supplier;";
									require_once("/../DatabaseConnect.php");
									$result = mysqli_query($databaseConnection,$query);
									while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
										echo "<option name=\"supplier\" value={$row['supplierID']}>{$row['supplierName']}</option>";
									}
				
				echo "	           </select> <br />				
						<br />
						<input type=\"hidden\" name=\"purchaseRequisition\" value=$PRID />
						<input type=\"submit\" value=\"Next Step\" name=\"next\" />
					</fieldset>
				</form>";
			}
		?>
		
		
		<?php
			if(isset($_POST['next'])){
				echo "<fieldset>";
					echo "<legend>Enter the details below</legend>";
					echo "<form method=\"POST\" action=\"purchaseOrderCreating2.php\">";
					
					echo "Shipping Terms    <input type=\"text\" maxlength=45 name=\"shippingterms\" required=\"required\" autocomplete=\"on\" /><br />
						  Shipping Method   <input type=\"text\" maxlength=45 name=\"shippingmethod\" required=\"required\" autocomplete=\"on\"  /><br />
						  Delivery Address: <input type=\"text\" maxlength=45 size=40 name=\"deliveryAddress\" required=\"required\" autocomplete=\"on\"  /><br />
						  Delivery Date: <br / >
						  <select name=\"dateYear\" required=\"required\" autocomplete=\"on\" >
							<option></option>";
							  for($i = 2017; $i >= 2010 ; $i--){
								echo "<option value=$i> $i </option>";
							  }
					echo "</select >
						  <select name=\"dateMonth\" required=\"required\" autocomplete=\"on\">
						  <option></option>
							<option value=1> January </option>
							<option value=2> February </option>
							<option value=3> March </option>
							<option value=4> April </option>
							<option value=5> May </option>
							<option value=6> June </option>
							<option value=7> July </option>
							<option value=8> August </option>
							<option value=9> September </option>
							<option value=10> October </option>
							<option value=11> November </option>
							<option value=12> December </option>
						  </select>
						
					      <select name=\"dateDay\" required=\"required\" autocomplete=\"on\">
						  <option></option>";
						  for($i = 1; $i <= 31 ; $i++){
							echo "<option value=$i> $i </option>";
						  }
					echo "</select>";
					

					$query="SELECT supplierName
							  FROM supplier
							WHERE supplierID = {$_POST['supplier']};";
							  
					require_once("/../DatabaseConnect.php");
					
					$result = mysqli_query($databaseConnection,$query);
					$row = mysqli_fetch_array($result,MYSQL_ASSOC);
					
						echo "<br />Select products to include from supplier: {$row['supplierName']}<br /><br />";
						
						echo "<table width=\"75%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#000000\" >
								<tr>
								   <td align=\"center\"><b>Product ID</b></td>
								   <td align=\"center\"><b>Name</b></td>
								   <td align=\"center\"><b>Size</b></td>
								   <td align=\"center\"><b>Unit</b></td>
								   <td align=\"center\"><b>Brand</b></td>
  								   <td align=\"center\"><b>Content</b></td>
								   <td align=\"center\"><b>Measurement</b></td>
								   <td align=\"center\"><b>Price</b></td>
								   <td align=\"center\"><b>Selected Option</b></td>
								</tr>";
						
							$query = "SELECT pr.productID, productName, size, unit, brand, content, measurement, price
										FROM (SELECT *
												FROM prices
											   WHERE supplierID = {$_POST['supplier']}) pr JOIN product p
																		                     ON pr.productID = p.productID;";
																		  
							$result = mysqli_query($databaseConnection,$query);
							
							while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
								echo "<tr>
									   <td align=\"right\">{$row['productID']}</td>
									   <td align=\"left\">{$row['productName']}</td>
									   <td align=\"left\">{$row['size']}</td>
									   <td align=\"left\">{$row['unit']}</td>
									   <td align=\"left\">{$row['brand']}</td>
									   <td align=\"left\">{$row['content']}</td>
									   <td align=\"left\">{$row['measurement']}</td>
									   <td align=\"right\">{$row['price']}</td>
									   <td align=\"center\"><input 	type=\"checkbox\" name=\"products[]\" value={$row['productID']} \></td>
									</tr>";
							}
						echo "</table>";
					
					echo "<input type=\"hidden\" value=$PRID name=\"purchaseRequisition\" />";
					echo "<input type=\"hidden\" value={$_POST['supplier']} name=\"supplier\" />";
					echo "<input type=\"Submit\" value=\"proceed\"/>";
					echo "</form>";
				echo "</fieldset>";
			}
			
		?>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<input type="Submit" value="Refresh" />
			<input type="hidden" value=<?php echo $PRID; ?> name="purchaseRequisition"/>
		</form>
		<a href="..\Neil\startbootstrap-sb-admin-2-1.0.8\pages\MaterialsupplyList_backend.php">  Compare Supplier Prices</a><br/>
		<a href="RequisitionView.php">  Return to requisition forms view</a>
	</body>
</html>