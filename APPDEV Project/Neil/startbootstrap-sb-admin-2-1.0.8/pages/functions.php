<?php
	function mysqlconnect($username, $password, $dbname){
		$conn = mysqli_connect('localhost',$username,$password,$dbname);
		
		if(!$conn)
			die("Connection Failed: ".mysql_error());
		return $conn;

	}

	function query($query,$db){

		$results = mysqli_query($db,$query);
		 
		if(!is_bool($results)){
			 
			if($results){
				$rows = array();
				while($row = mysqli_fetch_array($results,MYSQL_ASSOC)){ 
							
					$rows[] = $row;
				}
				return $rows;
			}
			return false;
		}
		return true;
	}

?>