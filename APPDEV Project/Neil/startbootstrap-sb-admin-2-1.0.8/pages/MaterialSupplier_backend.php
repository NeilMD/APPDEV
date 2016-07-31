<?php
	 
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');
	$query = query("SELECT * 
					  FROM prices P JOIN SUPPLIER S 
									  ON P.SUPPLIERID = S.SUPPLIERID
									JOIN PRODUCT PS 
									  ON P.PRODUCTID = PS.PRODUCTID 
					 WHERE S.SUPPLIERID = ".($_GET['supplier']+1),$conn);

	require 'MaterialSupplier.php';

?>