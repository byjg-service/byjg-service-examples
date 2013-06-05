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
	$url = "http://www.byjg.com.br/site/webservice.php/ws/sms?httpmethod=enviarsms";
	$url .=	"&ddd=" . urlencode($ddd);
	$url .=	"&celular=" . urlencode($celular);
	$url .=	"&mensagem=" . urlencode(utf8_encode($mensagem));
	$url .=	"&usuario=" . urlencode($username);
	$url .=	"&senha=" . urlencode($password);

	$result = file_get_contents($url);

	return $result;
}
?>
