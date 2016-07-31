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
					echo "<a href=\"PurchaserMain.php\"> Return to main </a>";
				}else{
					$selectedPO = $_POST['purchaseorder'];
					
					$query = "SELECT *
								FROM purchaseorder po JOIN REF_POStatus rpo
													 ON po.POStatusID = rpo.POStatusID
							  WHERE po.PurchaseOrderID = $selectedPO;";
					
					require_once("\..\DatabaseConnect.php");
					
					$result=mysqli_query($databaseConnection,$query);
					
					$row=mysqli_fetch_array($result,MYSQL_ASSOC);
					
					$supplierID = $row['supplierID'];
					$preparedBy = $row['preparedBy'];
					
					echo "<fieldset>";
					echo "<legend align=\"center\"> <b> Purchase Order  </b> 	</legend>";
					
						
						echo "<div align=\"right\"> <b> Date:</b> {$row['date']} </div>";
						echo "<font size=\"3%\" align=\"left\"><b>P.O. #</b> [$selectedPO] <br />
															   Unit 2907, 2908 (29th Flr.), World <br />
															   Trade Exchange Bldg., No 215 <br />
															   Juan Luna St., Binondo 10006 <br /> </font> <br />";
									
						
						$query = "SELECT *
									FROM supplier
								  WHERE supplierID = $supplierID;";
								  
						$result=mysqli_query($databaseConnection,$query);
						
						
						$supplierRow = mysqli_fetch_array($result,MYSQL_ASSOC);
							
						echo "<div style=\"padding-left:10%;\"><font size=\"3%\" align=\"left\"><b>Supplier:</b> {$supplierRow['supplierName']} </div>			   
							  <div style=\"padding-left:14.4%\" > {$supplierRow['supplierAddress']}<br /></div> </font> <br />";
							  
							  echo "<div style=\"padding-left:10%;\"><font size=\"3%\" align=\"left\"><b>Deliver to:</b>  </div>			   
							  <div style=\"padding-left:14.4%\" > {$row['deliveryAddress']}<br /></div> </font> <br />";
						// Details
						echo "<table width=\"75%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#000000\" >";
							echo '
								  <tr>
									  <td align="center"><b>Shipping Method</b> </td>
									  
									  <td align="center"><b>Shipping Terms</b></td>
									  
									  <td align="center"><b>Delivery Date</b></td>
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
									  <td align="center"><b>Item #</b> </td>
									  
									  <td align="center"><b>Particular</b></td>
									  
									  <td align="center"><b>Quantity</b></td>
									  
									  <td align="center"><b>Unit</b></td>
									  
									  <td align="center"><b>Unit Cost (Php)</b></td>
									  
									  <td align="center"><b>Unit Totals (Php)</b></td>
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
								$total += $unitTotal;
								echo "
								  <tr>
									  <td align=\"right\">{$roar['id']}</td>
									 
									  <td align=\"left\">{$roar['name']}</td>
									  
									  <td align=\"right\">{$roar['quantity']}</td>
									  
									  <td align=\"right\">$unit</td>
									  
									  <td align=\"right\">$price</td>
									  
									  <td align=\"right\">$unitTotal</td>
								   </tr>";
								
							}

							echo "<tr>
									<td COLSPAN=5> </td> <td align=\"right\"><b>Grand Total: </b>$total</td>
								  </tr>";
									   
							
							
						echo "</table> <br />";
						
					echo "<b>Prepared by:</b>$preparedBy <br /><br />"; 
					echo "<b>Status:</b><br/> {$row['name']}";
					echo "<br />
						  <br />
						 <b>Comments:</b><br />
						   {$row['comments']}";
					
					echo "</fieldset>";
					echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\" >";
					echo "<br /><br /><input type=\"Submit\" value=\"Return to PO List\" name=\"aguy\" />";
					echo "</form>";
				}
				
			?>
	</body>
</html>