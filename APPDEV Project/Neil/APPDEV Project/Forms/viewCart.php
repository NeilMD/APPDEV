
<?php
 session_start();	
 print_r($_SESSION['cart']);
if(!empty($_POST['sendCellValue'])){
	if(in_array($_POST['sendCellValue'], $_SESSION['cart']))
	{

	}
	else{
	array_push($_SESSION['cart'],$_POST['sendCellValue']);		

	}
}
	if(!empty($_POST['deleteValue'])){
		$needle = $_POST['deleteValue'];
		unset($_SESSION['cart'][array_search($needle, $_SESSION['cart'])]);	
	}

 

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	 <script src=" https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="../jquery.dataTables.css">
  
	<script type="text/javascript" charset="utf8" src="../jquery.dataTables.js"></script>




<html>
	<title>
		
	</title>
	<body>
	<a id="a"></a>
		<div  style="height:300px;width:500px;">
		<h1>Cart</h1>
		 <table align='center' border='1' id="table_id" class="display">
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
							  FROM Product
							 WHERE PRODUCTID";
											 
									
				 
					$result = mysqli_query($databaseConnection,$query);
					$cnt = 0;
					while($row=mysqli_fetch_array($result,MYSQL_ASSOC)) {
						 
					 if(!empty($_SESSION['cart'])){

					 
						if( array_search($row['productID'], $_SESSION['cart'])){

							echo '<tr id="row'.$row['productID'].'">';
								echo ' <td>'.$row ['productName'].'</td>';
								 echo ' <td><button class="delete"  id="'.$row ['productID'].'" >Delete</button></td';
								echo '</tr>';
							}
						}
					
					}
					
				?>

		         
		    </tbody>
		</table>
		<br/>
		<a href='Takeout.php'>Takeout</a><br/>
		<a href='purchaseRequisitionForm.php'>Go back</a>
	</div>
	</body>
		
	<script>
		$(document).ready( function () {
    		 
    		$('#table_id').DataTable();
		} );
			$('#table_id').DataTable();
	</script>
	<script>
	 

	 $(".delete").click(function(){
				var posting = $.post('viewCart.php',
									 {deleteValue: this.id}

									);
				 posting.done(function(data){
				 	 	$('#a').empty().append(data);	
				 	 	
				 });

			});	 
		
	</script>
</html>

