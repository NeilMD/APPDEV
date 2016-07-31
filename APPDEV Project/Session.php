<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($self)."\APPDEV Project\startbootstrap-sb-admin-2-1.0.8\pages\login.php");
?>
