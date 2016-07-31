<!DOCTYPE html>

<?php
	session_start();
	$array = array();
	array_push($array, '');
	$_SESSION['cart'] = $array;
	  
	 
?>

<html>
	<head>
			<title>
				Create Requisition Form
			</title>
	</head>
	 
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	 <script src=" https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="../jquery.dataTables.css">
  
	<script type="text/javascript" charset="utf8" src="../jquery.dataTables.js"></script>


	
	
	<body>

	<div class="row">
	
	<div  style=" float: left;
	height: 1000px;
    width: 45%;
    margin: 0;
    padding: 1em;">
		<h1> Materials to be bought</h1>
		 <table border='1' id="table_id1" class="display">
		    <thead>
		        <tr>
		            <th width='70%'>Item Name</th>
		            <th width='30%'>Actions</th>
		        </tr>
		    </thead>
		    <tbody>

		    	<?php
					require_once("/../DatabaseConnect.php");
					$query="SELECT *
							  FROM Product";
											 
									
									
					$result = mysqli_query($databaseConnection,$query);
					 		
					while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
					echo '<tr>';
					echo ' <td>'.$row['productName'].'</td>';
					echo ' <td><button class="add" id="'.$row['productID'].'" >Add</button></td';
					echo '</tr>';
					 
					}
				?>
		        
		    </tbody>
		</table>
		 
		<a  id ='temp' href="">View Cart</a>
	</div>
	<div style="
	 width: 45%;
	 float: right;
    height: 1000px;
    padding: 1em;
    overflow: hidden;">
	 <a id="a" ></a>
	 </div>
	 
	</div>
	
	</body>

		<script>
		$(document).ready( function () {
    		$('#table_id1').DataTable();
    		 
		} );
		$('#table_id1').DataTable();
	</script>

	<script>
	 

	 $(".add").click(function(){
				var posting = $.post('viewCart.php',
									 {sendCellValue: this.id,  }

									);
				 posting.done(function(data){
				 	 $('#a').empty().append(data);
				 	 	
				 });

			});	 
	   
		
	</script>

</html>
 