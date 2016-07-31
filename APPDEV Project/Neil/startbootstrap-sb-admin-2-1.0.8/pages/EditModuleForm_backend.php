<?php
	session_start();
	$_SESSION['project']=$_GET['project'];
	$_SESSION['moduleno']=$_GET['moduleno'];
	require 'functions.php';

	$conn = mysqlconnect('root','1234','appdev');

	$query = query("SELECT * 
					  FROM MODULES 
					 WHERE MODULESNO =".$_SESSION['moduleno'],$conn); //real
 	$query2 = query("SELECT * 
					  FROM PROJECTCHARTER PC JOIN PHASES P 
					 WHERE PC.PROJECTCHARTERID =".$_SESSION['project'],$conn);

	 echo $_GET['project'].'asdasdasd';	
	 $des = $query[0]['description'];
 
	 

	require 'EditModuleForm.php';

?>