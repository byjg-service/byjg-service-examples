<?php
//----------------------------------------------------------------------
//
// Classe para envio de SMS utilizaçao o WebService ByJG
// 2009-01-19
//
// Joao Gilberto Magalhaes
// http://www.byjg.com.br/
//


/**
 * @param string $ddd
 * @param string $celular
 * @param string $mensagem
 * @param string $username
 * @param string $password
 * @return string
 */
function enviarSMS($ddd, $celular, $mensagem, $username, $password)
{
	// Definindo o webservice
	$client = new SoapClient(NULL,
	array(
		"location" => "http://www.byjg.com.br/xmlnuke-php/webservice.php/ws/sms",
		"uri"      => "urn:xmethods-delayed-quotes",
		"style"    => SOAP_RPC,
		"use"      => SOAP_ENCODED
		)
	);

	// Chamando método do webservice
	$result = $client->__call(
		"enviarSMS",
	        array(
		    new SoapParam($ddd, "ddd"),
		    new SoapParam($celular, "celular"),
		    new SoapParam(utf8_encode($mensagem), "mensagem"),
		    new SoapParam($username, "usuario"),
		    new SoapParam($password, "senha"),
	        ),
	        // Opções
	        array(
	            "uri" => "urn:xmethods-delayed-quotes",
	            "soapaction" => "urn:xmethods-delayed-quotes#getQuote"
	        )
	);

	return $result;
}
?>
