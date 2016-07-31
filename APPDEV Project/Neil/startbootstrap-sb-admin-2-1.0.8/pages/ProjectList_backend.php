<?php
	  
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');
	$query = query("SELECT * FROM PROJECTCHARTER",$conn);
	$events = query("SELECT * FROM TIMETABLE WHERE ",$conn);

	 

	require 'ProjectList.php';

?>