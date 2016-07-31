<html>
	<head>
		<title> Requisition Forms </title>
	</head>
	
	
	<body>
		<fieldset>
			<legend> Select a requisition form</legend>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" >	
				Search by ID <br />
				<input required="required" type="number" min=0 name="filter" />
				<input type="Submit" name="searchID" value="Search"/>
			</form>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" >
				Search by Project <br />
				<input required="required" type="text" name="filter" />
				<input type="Submit" name="searchProject" value="Search"/>
			</form>
			
			<form action="purchaseOrderCreating.php" method="POST" >
			
			<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
				 <tr>
					  <td align="center"> Purchase Requistion Form ID </td>
					  
					  <td align="center"> Date Created </td>
					  
					   <td align="center"> Comments </td>
					   
					  <td align="center"> Phase </td>
					  
					  <td align="center"> Project </td>
					  
					  <td align="center"> Option </td>
				</tr>
				
				
				<?php
					$query = "";
					
					if(isset($_GET['searchID'])){
						$query = "SELECT pr.purchaseRequisitionFormID AS id, pr.date AS date, pr.comments AS comment, p.Title AS title, pc.projectName  AS projectName
								FROM purchaserequisitionform pr JOIN phases p
																  ON pr.phaseno = p.phaseno 
																 AND pr.projectCharterID = p.projectCharterID
																JOIN projectcharter pc
																  ON pc.projectCharterID = p.projectCharterID;
									WHERE id = {$_GET['filter']} ";
					}else if(isset($_GET['searchProject'])){
						$query = "SELECT pr.purchaseRequisitionFormID AS id, pr.date AS date, pr.comments AS comment, p.Title AS title, pc.projectName  AS projectName
								FROM purchaserequisitionform pr JOIN phases p
																  ON pr.phaseno = p.phaseno 
																 AND pr.projectCharterID = p.projectCharterID
																JOIN projectcharter pc
																  ON pc.projectCharterID = p.projectCharterID
									WHERE projectName LIKE '%{$_GET['filter']}%';";
					}else{
						$query = "SELECT pr.purchaseRequisitionFormID AS id, pr.date AS date, pr.comments AS comment, p.Title AS title, pc.projectName  AS projectName
								FROM purchaserequisitionform pr JOIN phases p
																  ON pr.phaseno = p.phaseno 
																 AND pr.projectCharterID = p.projectCharterID
																JOIN projectcharter pc
																  ON pc.projectCharterID = p.projectCharterID;";
					}
					
								
					require_once("/../DatabaseConnect.php");
					
					$result=mysqli_query($databaseConnection,$query);
					
					if($result){
						while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
							echo "<tr>
									<td align=\"left\"> {$row['id']}</td>
									
									<td align=\"left\"> {$row['date']}</td>
									
									<td align=\"left\"> {$row['comment']}</td>
									
									<td align=\"left\"> {$row['title']}</td>
									
									<td align=\"center\"> {$row['projectName']}</td>
									
									<td align=\"center\"> <input type=\"radio\" required=\"required\" value={$row['id']} name=\"purchaseRequisition\" /> </td>
								  </tr>";
						}
					}
				?>
			</table>
			<input type="Submit" name="select" value="Select Purchase Requisition" />
			</form>
			
		</fieldset>
		<a href="PurchaserMain.php">Return to Main Menu</a>
	</body>

</html>