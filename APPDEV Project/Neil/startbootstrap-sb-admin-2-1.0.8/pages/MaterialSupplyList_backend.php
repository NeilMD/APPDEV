<?php
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');
	$list = query("SELECT * FROM product",$conn);
	 
	require 'MaterialSupplyList.php';
?>