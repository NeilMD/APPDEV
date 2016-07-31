<?php
	  
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');

	$query = query("SELECT * FROM PROJECTCHARTER PC JOIN MODULES M 
					   ON PC.projectcharterID = M.projectcharterID
					  JOIN REF_STATUS RS ON M.STATUSID = RS.STATUSID
					where PC.projectcharterID=".$_GET['project'],$conn); //real
	$query2 = query("SELECT * FROM  MODULES M 
					    
					  JOIN REF_STATUS RS ON M.STATUSID = RS.STATUSID
					 ",$conn);
 
	 
	 

	 

	require 'EditModuleList.php';

?>