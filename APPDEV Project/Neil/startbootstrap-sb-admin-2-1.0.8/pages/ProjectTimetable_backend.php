<?php
	  
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev3');
	$temp = 'SELECT * FROM PROJECTCHARTER P JOIN PHASES E ON P.PROJECTCHARTERID = E.PROJECTCHARTERID JOIN MODULES M ON E.PHASENO = M.PHASENO
	    WHERE P.PROJECTCHARTERID = '.$_GET['project'];

	$query = query($temp,$conn);
	

	 

	require 'ProjectTimetable.php';

?>