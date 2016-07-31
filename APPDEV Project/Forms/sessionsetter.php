<?php
 session_start();	
if(!empty($_POST['sendCellValue'])){
	array_push($_SESSION['cart'], 	$_POST['sendCellValue']);
}
print_r($_SESSION['cart']);
echo $_SESSION['cart'][0].'wla?';
?>
<html>
	<title>
		
	</title>
	<body>
		
	</body>
</html>

