<?php
	include "CepWebService.php";
	
	$cep = new CepWebService();
	$info = $cep->setCep("81750240")
				->setUser("usuario")
				->setPass("senha")
				->find();
	
	echo "<pre>";
	print_r($info);
	echo "</pre>";
?>