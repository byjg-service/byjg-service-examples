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

if( defined( 'PIXXIS_BACKEND_ADMIN_PHP' ) == true )
{
  return;
}

/**
 * Define our class constant to precent multipe definition
 */
define( 'PIXXIS_BACKEND_ADMIN_PHP', 1 );

$backend_path  = dirname( __FILE__ ) . '/';
DEFINE( '_PIXXIS_ADMIN_PATH' , 	$backend_path );

$obj  = &JFactory::getLanguage();	
$obj->load( 'com_pixxis' );

require_once( _PIXXIS_ADMIN_PATH . 'pixxis.functions.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.crypt.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.config.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.error.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.backend.php' );
require_once( _PIXXIS_ADMIN_PATH . 'admin.pixxis.html.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.user.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.group.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.phonebook.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.usergroups.php' );
require_once( _PIXXIS_ADMIN_PATH . 'pixxis.prerequisite.php' );
require_once( _PIXXIS_ADMIN_PATH . '/provider/providerfactory.php' );

$task = JRequest::getVar( 'task', 'Default');
$act  = JRequest::getVar( 'act', 'Default');
$cid  = JRequest::getVar( 'cid', array(0));

$backend = new PixxisBackend( $act, $task, $cid );

if( $backend->CanHandle() )
{
	return $backend->Execute();
}

echo 'Cannot handle task: ' . $task . $act;
?>