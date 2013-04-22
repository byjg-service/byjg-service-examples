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
			$wsdl = $params->get('wsdl'); //
			$usa_autenticacao = $params->get('usa_autenticacao');	
			$usuario 	= $params->get('usuario');
			$senha    	= $params->get('senha');	

			$cep   = JRequest::getVar('cep');

            
			$cliente    = new SoapClient($wsdl); 
            $parametros = array("cep" => $cep,
                                "usuario" => $usuario,
                                "senha" => $senha
                                );
            

				// Chama o serviço web (Web Service) da ByJG
			if ( $usa_autenticacao == 1 ) {
			    $autenticacao = 'Sim';
				$resultado = $cliente->__soapCall( "obterLogradouroAuth", $parametros);
			}
			else { // Sem Autenticação
				$autenticacao = 'Não';
				$resultado = $cliente->__soapCall( "obterLogradouro",   // Nome do método 
											array( "cep" =>  $cep) );
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
	
