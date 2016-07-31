<?php
	$databaseConnection = mysqli_connect('localhost','root','1234','appdev');

	if (!$databaseConnection) {
		die('Could not connect: '.mysql_error());
	}

?>	