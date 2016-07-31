<?php
	require 'functions.php';

	$conn = mysqlconnect('vp','1234','forecast');
	$query = query("SELECT * FROM dw_purchasing",$conn);
	
	require 'forecast_material.php';
?>