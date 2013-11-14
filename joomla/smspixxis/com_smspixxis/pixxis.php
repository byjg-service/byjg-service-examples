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

if( defined( 'PIXXIS_FRONTEND_PIXXIS_PHP' ) == true )
{
  return;
}

/**
 * Define our class constant to precent multipe definition
 */
define( 'PIXXIS_FRONTEND_PIXXIS_PHP', 1 );

@session_start();

//setup correct language, and get all needed globals
global $Itemid;

$mainframe =& JFactory::getApplication();
$option = JRequest::getCmd('option');

$frontend_path = dirname( __FILE__ ) . '/';
$backend_path  = dirname( __FILE__ ) .'/../../administrator/components/com_pixxis/';

DEFINE( '_PIXXIS_PATH' , 		$frontend_path );
DEFINE( '_PIXXIS_ADMIN_PATH' , 	$backend_path );

$obj  = &JFactory::getLanguage();	
$obj->load( 'com_pixxis' );
	
require_once( $mainframe->getPath('front_html') );
require_once(_PIXXIS_ADMIN_PATH . 'provider/providerfactory.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.functions.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.user.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.group.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.error.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.phonebook.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.usergroups.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.config.php' );
require_once(_PIXXIS_ADMIN_PATH . 'pixxis.crypt.php' );
require_once(_PIXXIS_PATH       . 'pixxis.frontend.php' );

//check if user is registered
$user =& JFactory::getUser();

if( $user->get('id') < 1 )
{
	PixxisNoAuth();
	return;
}

//create our sms user object
$smsUser = new PixxisUser( $user->get('id') );

//check com_pixxis user rights, is user allowed to send sms (backend)
if( $smsUser->isBlocked() == true )
{
  PixxisNoAuth();
  return;
}

$params = &JComponentHelper::getParams( 'com_component' );

//get task, setup default task to overview
$task = JRequest::getVar( 'task', 'default' );

$database =  &JFactory::getDBO();

jimport('joomla.html.pagination');
JHTML::_('behavior.mootools');

$params = array( 'PixxisUser'		=> $smsUser,
				 'mosParameters'	=> $params,
				 'mosMainframe'		=> $mainframe,
				 'mosDatabase'		=> $database,
				 'ItemId'		    => $Itemid,
				 'option'			=> $option,
				 'lang'				=> $lang
				 );

$frontend = new PixxisFrontend( $task, $params );

if( $frontend->CanHandle() )
{
	return $frontend->Execute();
}

echo JText::_('PIXXIS_ALERT_NOT_HANDLE_TASK') . $task;
?>
