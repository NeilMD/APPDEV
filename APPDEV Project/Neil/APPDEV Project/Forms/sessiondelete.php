<?php
 session_start();	


if(!empty($_POST['deleteValue'])){
		$needle = $_POST['deleteValue'];
		unset($_SESSION['cart'][$array_search($needle, $_SESSION['cart'])]);	
}
 
echo $_SESSION['cart'];
print_r($_SESSION['cart']);
echo $_SESSION['cart'][0].'wla?';
?>

