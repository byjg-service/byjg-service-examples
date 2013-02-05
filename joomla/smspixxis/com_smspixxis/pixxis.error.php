<?php
/**
* SMS PIXXIS - Componente para envio de SMS no CMS JOOMLA
*
* Ideia Original: Axel Sauerhoefer < mysms[at]quelloffen.com >
* SMS PIXXIS foi desenvolvido por Claudio Eden < sms[at]pixxis.com.br >
* http://www.pixxis.com.br
*
* Todos os direitos reservados. 
*
* @license http://www.gnu.org/licenses/lgpl.html GNU/LGPL
* SMS PIXXIS eh um software livre. Esta versao pode ter sido modificado nos termos da 
* LGPL (Library ou Lesser General Public License), e como eh distribuida inclui ou eh derivado de 
* obras licenciado sob a Licenca Publica Geral GNU ou outras licencas de software livre ou open source
*
* Este programa e distribuido na esperanca que seja util, mas SEM QUALQUER GARANTIA, 
* sem mesmo a garantia implicita de COMERCIALIZACAO ou ADEQUACAO PARA UM DETERMINADO PROPOSITO.
*
**/

//check if joomla call us
defined( '_JEXEC' ) or die( 'Restricted access' );

if( defined('PIXXIS_ERROR_PHP') == true )
{
  return;
}

/**
 * Define our class constant to precent multipe definition
 */
define('PIXXIS_ERROR_PHP', 1);

/**
*  Pixxis Error handling class
*
 * @package Pixxis
 * @subpackage Util
**/
class PixxisError {

	/**
	 * Set this value to 1 if you want to get
	 * all error message as email.
	 *
	 * @var bool
	 */
	var $errorReporting;

	/**
	 * Send error reports to this email
	 *
	 * @var string
	 */
	var $email;

	/**
	 * Configuration object
	 *
	 * @var PixxisConfig
	 */
	var $config;

	/**
	 * Constructor
	 *
	 */
	function PixxisError()
	{
		$this->config = new PixxisConfig();
		$this->errorReporting = $this->config->Get( 'mailonerror');

		if( $this->errorReporting == 1 )
		{
			$this->email = $this->config->Get( 'email' );
		}
	}

	/**
	 * Alert the message as java script box and go -1 in histroy.
	 *
	 * @param string $msg
	 */
    function  Alert( $msg, $desc = '' )
    {
          echo "<script> alert('$msg'); window.history.go(-1); </script>\n";
          $this->Mail( $msg, $desc );
          exit();
    }

    /**
     * Send a error report email
     *
     * @param string $msg
     * @param string $desc
     */
    function Mail( $msg, $desc = '' )
    {
    	if( $this->errorReporting !== 1 )
    	{
    		return;
    	}

    	$user =& JFactory::getUser();

		$subject = 'com_pixxis error alter';
		$msg  	 = "Um erro ocorreu: \r\n";
		$msg	 .= "erro: $msg \r\n";

		if( strlen( $desc ) > 0 )
		{
			$msg	 .= "detalhe: $desc \r\n";
		}

		$msg	 .= "ip:    " . $_SERVER['REMOTE_ADDR'] .  "\r\n";
		$msg	 .= "user:  " . $user->get('name')   .  "\r\n";
		$msg	 .= "email: " . $user->get('email') . "\r\n";

		mail( $this->email, $subject, $msg );
    }

}//end class
?>