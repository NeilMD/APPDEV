
  <?php
	 session_start();
	 if(!isset($_SESSION['project'])){
	 	$_SESSION['project']=$_GET['project'];
	 }
	require 'functions.php';
	
	
	$conn = mysqlconnect('root','1234','appdev');
	$temp = 'SELECT * FROM PROJECTCHARTER PC JOIN PHASES P
			 ON PC.PROJECTCHARTERID = P.PROJECTCHARTERID 
			 WHERE pc.PROJECTCHARTERID ='. $_SESSION['project'];
	$temp2 = 'SELECT * FROM PROJECTCHARTER PC  JOIN
			 MODULES M ON Pc.PROJECTCHARTERID = M.PROJECTCHARTERID 
			 WHERE M.EXCPECTEDSTART IS NOT NULL AND M.EXPECTEDCOMPLETION IS NOT NULL and pc.PROJECTCHARTERID ='. $_SESSION['project'];
			# AND
			 #pc.PROJECTCHARTERID ='. $_SESSION['project'];

	$query = query($temp,$conn);
	$query2=query($temp2,$conn);
 
	require 'CreateTimetable.php';

?>



