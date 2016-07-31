<?php
	require("Cryptosystem.php");
	
?>
<html>
	<head>
		<title>Lian's Encrypter</title>
	</head>
	
	
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" >
			<input type="text" name="plaintext" /> <input type="Submit" name="encrypt" value="Encrypt" />
		</form>
		<?php 
			if(isset($_GET['encrypt'])){
				$cipher = encrypt($_GET['plaintext']);
				echo "Plaintext: {$_GET['plaintext']} <br/>";
				echo "Ciphertext: $cipher";
			}
		?>
	</body>

</html>