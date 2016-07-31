<?php
	
	function encrypt($plaintext, $key="RalphNeilCloudLian"){
		$td = mcrypt_module_open('tripledes', '', 'ecb', '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$ciphertext = mcrypt_generic($td, $plaintext);
		
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		
		return base64_encode($ciphertext);
	}
	
	function decrypt($ciphertext, $key="RalphNeilCloudLian"){
		$td = mcrypt_module_open('tripledes', '', 'ecb', '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		
		$plaintext = base64_decode($ciphertext);
		$plaintext = trim(mdecrypt_generic($td, $plaintext));
		
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		
		return $plaintext;
	}
?>