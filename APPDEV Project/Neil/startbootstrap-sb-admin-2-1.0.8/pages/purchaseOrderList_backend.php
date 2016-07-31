<?php
	require 'functions.php';

	$conn = mysqlconnect('vp','1234','appdev');
	$list = query("SELECT * FROM purchaseorder",$conn);
	$supplier = query("SELECT * FROM supplier",$conn);
	$statusname = query("SELECT * FROM status",$conn);
	require 'purchaseOrderList.php';
?>