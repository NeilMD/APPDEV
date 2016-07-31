<?php
	  
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');
	$query = query("SELECT * FROM PROJECTCHARTER",$conn);
	

	 

	require 'Dashboard.php';

?>