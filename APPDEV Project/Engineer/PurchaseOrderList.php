<?php
	if(isset($_POST['status'])){
		//Completed with reservation
		
		
		
		require_once("\..\DatabaseConnect.php");
		
		$query = "SELECT POStatusID
					FROM REF_POStatus
				  WHERE name = '{$_POST['status']}';";
		$result=mysqli_query($databaseConnection,$query);
		$row = mysqli_fetch_array($result,MYSQL_ASSOC);
		
		$PO = $_POST['POID'];
		$POStatusID = $row['POStatusID'];
		
		$query = "UPDATE purchaseorder
					 SET POStatusID = $POStatusID
					    ,comments = '{$_POST['comments']}'
				   WHERE PurchaseOrderID = $PO;"; 
		
		
		
		$result=mysqli_query($databaseConnection,$query);
		
		if($result){
			echo "<font color=\"green\"><p>Purchase order confirmed!</p></font>";
		}else{
			echo "<font color=\"green\"><p>Purchase confirmation failed!</p></font>";
		}
	}
?>

<html>
	<head>
		<title> 
			Purchaser Order List
		</title>
	</head>
<!-- ------------------------------ --> 
	<body>	
			<?php
				if(empty($_POST['selectPO'])){
					
					echo "<fieldset>";
					echo "<legend> Select a Purchase Order </legend>";
					
					echo "<form method=\"GET\" action=\"{$_SERVER['PHP_SELF']}\">
									Search for ID: <br />
									<input type=\"number\" min=0 name=\"filter\" required=\"required\" autocomplete=\"\"  />
									<input type=\"Submit\" name=\"searchID\" value=\"Search\" />
						  </form>";
					
					echo "<form method=\"GET\" action=\"{$_SERVER['PHP_SELF']}\">";
						echo "Filter by status<br />";
						echo "<select name=\"filter\" required=\"required\" >";
							echo "<option> </option>";
							
							$query = "SELECT * 
										FROM REF_POStatus;";
										
							require_once("/../DatabaseConnect.php");
							
							$result=mysqli_query($databaseConnection,$query);
							
							while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
								echo "<option value={$row['POStatusID']} >{$row['name']} </option>";
							}
							
						echo "</select>";
						echo "<input type=\"Submit\" name=\"searchStatus\" value=\"Filter\" />";
					echo "</form>";
					
					// TITLE 
					echo "<form action=\"{$_SERVER['PHP_SELF']}\"  method=\"POST\">";
					
						echo "<table width=\"75%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#000000\" >";
							echo '
								  <tr>
									  <td align="center"> Purchase Order # </td>
									  
									  <td align="center"> Date Created </td>
									  
									   <td align="center"> Delivery Date </td>
									   
									  <td align="center"> Recipient </td>
									  
									  <td align="center"> Status </td>
									  
									  <td align="center"> Option </td>
								   </tr>';
							
								require_once("/../DatabaseConnect.php");
								
								
								$query ="";
								
								if(isset($_GET['searchID'])){
									$query = "SELECT PurchaseOrderID, date, supplierName as supplier, pos.name as name, po.deliveryDate as deliveryDate
											FROM purchaseorder po JOIN supplier s
																	ON s.supplierID = po.supplierID
																  JOIN REF_POStatus pos
																	ON pos.POStatusID = po.POStatusID
											WHERE PurchaseOrderID = {$_GET['filter']};";
								}else if(isset($_GET['searchStatus'])){
									$query = "SELECT PurchaseOrderID, date, supplierName as supplier, pos.name as name, po.deliveryDate as deliveryDate
											FROM purchaseorder po JOIN supplier s
																	ON s.supplierID = po.supplierID
																  JOIN REF_POStatus pos
																	ON pos.POStatusID = po.POStatusID
											WHERE pos.POStatusID = {$_GET['filter']};";
									
								}else{
									$query = "SELECT PurchaseOrderID, date, supplierName as supplier, pos.name as name, po.deliveryDate as deliveryDate
											FROM purchaseorder po JOIN supplier s
																	ON s.supplierID = po.supplierID
																  JOIN REF_POStatus pos
																	ON pos.POStatusID = po.POStatusID;";
								}
																			
																	
								$result=mysqli_query($databaseConnection,$query);
								
								if($result){
									while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
										echo "<tr>
												<td align=\"left\"> {$row['PurchaseOrderID']}</td>
												
												<td align=\"left\"> {$row['date']}</td>
												
												<td align=\"left\"> {$row['deliveryDate']}</td>
												
												<td align=\"left\"> {$row['supplier']}</td>
												
												<td align=\"center\"> {$row['name']}</td>
												
												<td align=\"center\"> <input type=\"radio\" required=\"\" value={$row['PurchaseOrderID']} name=\"purchaseorder\" /> </td>
											  </tr>";
									}
								}
								
							echo "</table>";
							echo "<input type=\"Submit\" name=\"selectPO\" value=\"Select Purchase Order\" />";
						
						echo "</form>";
						
						echo "</fieldset>";
						
					echo "<a href=\"{$_SERVER['PHP_SELF']}\"> Refresh </a><br />";
					echo "<a href=\"EngineerMain.php\"> Return to main </a>";
				}else{
					$selectedPO = $_POST['purchaseorder'];
					
					$query = "SELECT *
								FROM purchaseorder
							  WHERE PurchaseOrderID = $selectedPO;";
					
					require_once("\..\DatabaseConnect.php");
					
					$result=mysqli_query($databaseConnection,$query);
					
					$row=mysqli_fetch_array($result,MYSQL_ASSOC);
					
					$supplierID = $row['supplierID'];
					$preparedBy = $row['preparedBy'];
					
					echo "<fieldset>";
					echo "<legend align=\"center\"> <b> Purchase Order  </b> 	</legend>";
					
						
						echo "<div align=\"right\">  Date: {$row['date']} </div>";
						echo "<font size=\"3%\" align=\"left\">P.O. # [$selectedPO] <br />
															   Unit 2907, 2908 (29th Flr.), World <br />
															   Trade Exchange Bldg., No 215 <br />
															   Juan Luna St., Binondo 10006 <br /> </font> <br />";
									
						
						$query = "SELECT *
									FROM supplier
								  WHERE supplierID = $supplierID;";
								  
						$result=mysqli_query($databaseConnection,$query);
						
						
						$supplierRow = mysqli_fetch_array($result,MYSQL_ASSOC);
							
						echo "<div style=\"padding-left:10%;\"><font size=\"3%\" align=\"left\">Supplier: {$supplierRow['supplierName']} </div>			   
							  <div style=\"padding-left:14.4%\" > {$supplierRow['supplierAddress']}<br /></div> </font> <br />";
							  
							  echo "<div style=\"padding-left:10%;\"><font size=\"3%\" align=\"left\">Deliver to:  </div>			   
							  <div style=\"padding-left:14.4%\" > {$row['deliveryAddress']}<br /></div> </font> <br />";
						// Details
						echo "<table width=\"75%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#000000\" >";
							echo '
								  <tr>
									  <td align="center">Shipping Method </td>
									  
									  <td align="center">Shipping Terms</td>
									  
									  <td align="center">Delivery Date</td>
								   </tr>';
							
							echo "
								<tr>
									<td align=\"center\">{$row['shippingMethod']} </td>
									<td align=\"center\">{$row['shippingTerms']}</td>
									<td align=\"center\"	> {$row['deliveryDate']} </td>
								</tr>";
						echo "</table>";
							
						echo "<br />";
							
							
						// ITEMS LIST
						echo "<table width=\"75%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#000000\" >";
							echo '
								  <tr>
									  <td align="center">Item # </td>
									  
									  <td align="center">Particular</td>
									  
									  <td align="center">Quantity</td>
									  
									  <td align="center">Unit</td>
									  
									  <td align="center">Unit Cost (Php)</td>
									  
									  <td align="center">Unit Totals (Php)</td>
								   </tr>';
							
						
							require_once("\..\DatabaseConnect.php");
							
							$query = "SELECT o.productID AS id, p.productName AS name, o.quantity as quantity, p.unit, pr.price	
										FROM (SELECT *
												FROM orders 
											  WHERE PurchaseOrderID = $selectedPO) o JOIN product p
																			 ON o.productID = p.productID
																		   JOIN (SELECT *
																				   FROM prices
																				  WHERE supplierID = $supplierID) pr
																			 ON p.productID = pr.productID; ";
							
							$result=mysqli_query($databaseConnection,$query);
							
							$total = 0;
							
							while($roar=mysqli_fetch_array($result,MYSQL_ASSOC)){
								$unit = $roar['unit'];
								$price = $roar['price'];
								$unitTotal = $roar['quantity']*$price;
								$total += unitTotal;
								echo "
								  <tr>
									  <td align=\"center\">{$roar['id']}</td>
									 
									  <td align=\"center\">{$roar['name']}</td>
									  
									  <td align=\"center\">{$roar['quantity']}</td>
									  
									  <td align=\"center\">$unit</td>
									  
									  <td align=\"center\">$price</td>
									  
									  <td align=\"center\">$unitTotal</td>
								   </tr>";
								
							}

							echo "<tr>
									<td COLSPAN=5> <th>Grand Total: $total</th> </td>
								  </tr>";
									   
							
							
						echo "</table> <br />";
						
					echo "Prepared by: $preparedBy <br /><br />"; 
							
							
					echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\" >";
					echo "<input type=\"Submit\" value=\"Completed\" name=\"status\" />";
					echo "<input type=\"Submit\" value=\"Completed with reservations\" name=\"status\" />";
					echo "<input type=\"Submit\" value=\"Delayed\" name=\"status\" />";
					
					echo "<input type=\"hidden\" value=$selectedPO name=\"POID\" />";
					echo "<br /><br />Comments: <br />
						  <textarea name=\"comments\" >{$row['comments']}</textarea>";
					echo "</form>";
					
					echo "</fieldset>";
					echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\" >";
					echo "<br /><br /><input type=\"Submit\" value=\"Return to PO List\" name=\"aguy\" />";
					echo "</form>";
				}
				
			?>
	</body>
</html>