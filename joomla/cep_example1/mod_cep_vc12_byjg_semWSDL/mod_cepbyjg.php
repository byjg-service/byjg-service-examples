<?php
	defined( '_JEXEC' ) or die( 'Acesso restrito!' );
?>	
	<form method="post" name="buscaendereco" id="buscaendereco" >
	<p>
	<label for="cep"><B>
	<?php echo JText::_('CEP') ?></B></label><br />
	<input id="cep" type="text" name="cep"
	class="inputbox" size="8" />
	<input type="submit" name="submit" class="button" 
	value="<?php echo JText::_('Enviar') ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	</p>
	<?php 
	   if ($_POST['submit']) {
			// Obtem os parâmetros configurados na Administração do Módulo (Backend)	
			$localizacao = $params->get('localizacao'); //
			$uri		 = $params->get('uri');	
			$usa_autenticacao = $params->get('usa_autenticacao');	
			$usuario 	= $params->get('usuario');
			$senha    	= $params->get('senha');	

			$cep   = JRequest::getVar('cep');

			$cliente = new SoapClient(NULL,
					array(
						"location" => $localizacao, 
						"uri"      => $uri,
						"style"    => SOAP_RPC,
						"use"      => SOAP_ENCODED
						)
					);

				// Chama o serviço web (Web Service) da ByJG
			if ( $usa_autenticacao == 1 ) {
			    $autenticacao = 'Sim';
				$resultado = $cliente->__soapCall( "obterLogradouroAuth", // Nome do método a ser executado
											array(  // Argumentos do método
													new SoapParam($cep,"cep"),
													new SoapParam($usuario,"usuario"),
													new SoapParam($senha,"senha")
											),
											array(  // Outras opções 
													"uri" => "urn:xmethods-delayed-quotes",
													"soapaction" => "urn:xmethods-delayed-quotes#getQuote"
											)
										);
			}
			else { // Sem Autenticação
				$autenticacao = 'Não';
				$resultado = $cliente->__soapCall( "obterLogradouro", // Nome do método 
											array(  // Argumentos do método
													new SoapParam($cep,"cep")
											),
											array(  // Outras opções 
													"uri" => "urn:xmethods-delayed-quotes",
													"soapaction" => "urn:xmethods-delayed-quotes#getQuote"
											)
										);
			}
			// Converte a string $resultado em array
			$endereco = explode(', ', $resultado);
			echo $cep.'<BR>';
			echo $endereco[0].'<BR>';
			echo $endereco[1].'<BR>';
			echo $endereco[2].'<BR>';
			echo $endereco[3].'<BR>';
			echo 'Autenticacao: '.$autenticacao;
	   }
	?>
	</form>
	
