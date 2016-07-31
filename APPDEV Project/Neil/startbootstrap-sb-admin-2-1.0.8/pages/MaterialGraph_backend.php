<?php
	 
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');
	$query = query("SELECT * FROM prices P JOIN SUPPLIER S 
										     ON P.SUPPLIERID = S.SUPPLIERID
										   JOIN PRODUCT PS 
										     ON P.PRODUCTID = PS.PRODUCTID
										     WHERE PS.PRODUCTID=
										    ".$_GET['material'],$conn);

	require 'MaterialGraph.php';

?>