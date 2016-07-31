<! DOCTYPE html>
<?php
	session_start();
	#if($_SESSION['affiliation'] <> 'Purchaser')
	#	header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");

?>
<html>
	<head>
		<title>
				Purchaser Main
		</title>
	</head>

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	 <script src=" https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="../jquery.dataTables.css">
  
	<script type="text/javascript" charset="utf8" src="../jquery.dataTables.js"></script>
	
	<body>
	<a href=''>Create PO</a><br/>
	<div>
		<?php
			require_once('\..\DatabaseConnect.php');
				$query ='SELECT *
						   FROM PURCHASEORDER PC   JOIN REF_POSTATUS RP
						   ON PC.POSTATUSID = RP.POSTATUSID';
			$result = mysqli_query($databaseConnection, $query);
			 
			echo '<h1>PO</h1>';

			echo '<table  border="1" id="table" class="display">';

				echo '
					  <tr>
						<b>
						  <th align="center"> PO # </th>
						  <th align="center"> Status </th>
						  <th align="center"> Comments </th>   
					   </tr>';

				while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
					echo "<tr>
							<td align=\"center\"> {$row['PurchaseOrderID']}</td>
							<td align=\"center\"> {$row['name']}</td>
							<td align=\"left\"> asdasd</td>
							 
						  </tr>
						  <tr>
							<td align=\"center\"> 2</td>
							<td align=\"center\"> {$row['name']}</td>
							<td align=\"left\"> {$row['comments']}</td>
							 
						  </tr>
						    <tr>
							<td align=\"center\"> 3</td>
							<td align=\"center\"> {$row['name']}</td>
							<td align=\"left\"> asdasd</td>
							 
						  </tr>
						    <tr>
							<td align=\"center\">4</td>
							<td align=\"center\"> {$row['name']}</td>
							<td align=\"left\">asdasd</td>
							 
						  </tr>
						    <tr>
							<td align=\"center\"> 5</td>
							<td align=\"center\"> {$row['name']}</td>
							<td align=\"left\"> asdasd</td>
							 
						  </tr>
						    <tr>
							<td align=\"center\"> {$row['PurchaseOrderID']}</td>
							<td align=\"center\"> {$row['name']}</td>
							<td align=\"left\"> asdasd</td>
							 
						  </tr>";		
				}
		?>
		
		</div>
	</body>
	<script>
		 
		$(document).ready( function () {
    		$('#table').DataTable();
    		 
		} );
		$('#table').DataTable();
		 
	</script>
