<?php
	 
	require 'functions.php';

	$conn = mysqlconnect('vp','1234','forecast');
	$query = query("SELECT * FROM project",$conn);
	require 'forecast.php';

?>