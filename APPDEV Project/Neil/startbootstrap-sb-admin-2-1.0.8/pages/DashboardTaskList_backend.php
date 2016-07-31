<?php
	 session_start();
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');
	$temp = "    SELECT *
				   FROM PROJECTCHARTER PC JOIN PHASES P 
				   						   ON PC.projectcharterID = P.projectcharterID
				   						 JOIN MODULES M 
				   						   ON P.phaseno = M.phaseno
				   						 JOIN REF_STATUS S
				   						   ON M.statusid = S.statusid
			      WHERE pc.projectcharterid = ".$_GET['project'];
	$query2 = query('SELECT PROJECTNAME FROM projectcharter WHERE projectcharterid ='.$_GET['project'],$conn);
	$query = query($temp,$conn);
	 

	require 'DashboardTaskList.php';

?>