<?php
	function mysql_connect($username, $password, $dbname){
		$conn = mysqli_connect('localhost','vp','1234','forecast');
		
		if(!$conn)
			die("Connection Failed: ".mysql_connect_error());
		return $conn;
		
	}

	function query($query){
		$results = mysqli_query($query);

		if($results){
			$rows = array();
			while($row = mysqli_fetch_array($results)){
				$rows[] = $row;
			}
			return $rows;
		}
		return false;
	}

?>