/**
 * Exemplo com o CURL para servidores que está bloqueado o file_get_contents.
 * Contribuição de 
 * Marcio Henrique Vera Pereira (contato@cwssystem.com.br)
 */


function obterLogradouroAuth($cep, $username, $password)
{
       $url = "http://www.byjg.com.br/site/webservice.php/ws/cep?httpmethod=obterlogradouroauth";
       $url .= "&cep=" . urlencode($cep);
       $url .= "&usuario=" . urlencode($username);
       $url .= "&senha=" . urlencode($password);

       //$result = file_get_contents($url);
       $result = curl_file($url, 9999);

       return $result;
}

function curl_file($url, $timeout=0) {
       $ch = curl_init();
       curl_setopt ($ch, CURLOPT_URL, $url);
       curl_setopt ($ch, CURLOPT_HEADER, 1);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
       $conteudo = curl_exec($ch);
       curl_close($ch);
       //$arquivo = explode("\n", $conteudo);

       return $conteudo;
 }
