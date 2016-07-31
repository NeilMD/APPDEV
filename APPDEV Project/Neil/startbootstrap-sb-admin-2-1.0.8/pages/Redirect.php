<?php
session_start();

	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/createtimetable_backend.php?project=".$_GET['project']);

?>