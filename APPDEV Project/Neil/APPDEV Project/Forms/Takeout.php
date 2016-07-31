<?php
	session_start();
	
	 
	 if(isset($_POST['submit'])){
	 		require_once("\..\DatabaseConnect.php");
	 		$valid = true;
	 	 
	 		if(isset($_POST['phase']))
	 		{
	 			 echo $_POST['projectname'];
	 			$que="Select *
	 					from PROJECTCHARTER P JOIN PHASES PH
	 					 ON P.PROJECTCHARTERID = PH.PROJECTCHARTERID
	 					 WHERE P.PROJECTCHARTERID=".$_POST['projectname'];
	 			$result = mysqli_query($databaseConnection,$que);
	 			print_r($result);
	 			if($result){

	 			}else{
	 				$valid=false;
	 			}
	 		}
	 		if($valid){
				$query = "INSERT INTO purchaserequisitionform
					VALUES ( null,{$_POST['projectname']},{$_POST['phase']} ,'".date("Y-m-d ")."',
					'{$_POST['comments']}' );";
				echo	$query; 
				$result = mysqli_query($databaseConnection,$query);            
				if($result){
					 
					 $query2= "
					INSERT INTO PROJECTCHARTITEM VALUES
					";    
					$temp="";                 
					print_r($_SESSION['cart']);
					$cnt=0;
					foreach ($_SESSION['cart'] as $row2) {
									if($cnt>0){
									$temp.='(LAST_INSERT_ID(),'.$row2.'),';      

								}
								$cnt++;
							}
				
				$query2=$query2.substr($temp, 0,strlen($temp)-1).';';
				echo $query2."------";
				$result2 = mysqli_query($databaseConnection,$query2);

					if($result2){
						echo "<p>Purchase Requisition Form Created! </p>";
					header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/purchaserequisitionform.php");
					}else{
						// delete requisition 
						print_r($result);
					echo "<p>Purchase Requisition Form Failed!."."<p>".$query."</p>";
					}
				}

					  
					          
					  
					
				
			echo "Error: Phase  empty!";
			
			
			}
		
	 	 
	 	echo "Error: Project  empty!";
	}
	
		
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	 <script src=" https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="../jquery.dataTables.css">
  
	<script type="text/javascript" charset="utf8" src="../jquery.dataTables.js"></script>




<html>
	<title>
		Takeout
	</title>

	<body id="a">
		 <table align='center' border='1' id="table_id1" class="display">
		    <thead>
		        <tr>

		              <th width='70%'>Item Name</th>
		            
		            
		        </tr>
		    </thead>
		    <tbody>

		    	<?php		
		    		require_once("/../DatabaseConnect.php");
					$query="SELECT *
							  FROM Product";
											 
									
					 
					$result = mysqli_query($databaseConnection,$query);
					 
					while($row=mysqli_fetch_array($result,MYSQL_ASSOC)) {
						 
					 if(!empty($_SESSION['cart'])){

					 
						if( array_search($row['productID'], $_SESSION['cart'])){

							echo '<tr id="row'.$row['productID'].'">';
								echo ' <td>'.$row ['productName'].'</td>';
								  
								echo '</tr>';
							}
						}
					
					}
					
				?>

		         
		    </tbody>
		    <br/>

		</table>
		  <form id='form' method='post' action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  		<br/>
		  		<br/>
		  		 <b>Project:</b>
		  		 <select name='projectname'>
		  		 	<option value='
					<?php if(isset($_POST["projectname"])) echo $_POST["projectname"];?>' selected="selected"></option>
		  		 	<?php

						 
					$query="SELECT *
							  FROM projectcharter";
											 
					$result = mysqli_query($databaseConnection,$query);
					 
					while($row=mysqli_fetch_array($result,MYSQL_ASSOC)) {			
					 
		  		 	 echo 
		  		 	'<option value="'.$row['projectCharterID'].'">'.
		  		 	$row['projectName'].'</option>';

		  		 	}
		  		 	;?>
		  		 

		  		 </select>
		  		  <b>Phase:</b>
					<input type="numeric" name="phase" value='
					<?php if(isset($_POST["phase"])) echo $_POST["phase"];?>'>		  		  
				<br/>
				<br/>
		  		  
		    	 <b>Comments:</b><br/>
		    	 <textarea rows="4" cols="50" name="comments"form="form"></textarea>
		    	 <br/>
		    	 <br/>
		    	 <br/>
		    	 <input type="submit" name="submit">
		    </form>
		    	<a href="purchaserequisitionform.php">Go Back To Create Requisition Form</a>
		
	</body>
	<script>
	$(document).ready( function () {
	    		 
	    		$('#table_id1').DataTable();
			} );
				$('#table_id1').DataTable();
 
	</script>
	 
</html>

