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

if( defined( 'PIXXIS_BACKEND_USERGROUPS_PHP' ) == true )
{
  return;
}

/**
 * Define our class constant to precent multipe definition
 */
define( 'PIXXIS_BACKEND_USERGROUPS_PHP', 1 );

/**
*  Pixxis User Group class, collection of single group classes
*
 * @package Pixxis
 * @subpackage Util
**/
class PixxisUserGroups
{
     var $_groups;
     var $_ownerID;
     var $_db;

   /**
	* The constructor creates a new user group
	*
	**/
	function PixxisUserGroups($owernid)
	{
		$this->_db = &JFactory::getDBO();

       if( is_numeric($owernid) )
       {
            $this->_ownerID = $owernid;
            $this->init();
       }
	}

/**
* This function load's all user groups
*
**/
function init()
{

  $sql = "SELECT * FROM #__pixxis_groups WHERE ownerid=".$this->_ownerID;

  $this->_db->setQuery($sql);

  if( $this->_db->query() === false )
  {
        PixxisError::Alert(   JText::_( 'PIXXIS_SQLQUERY_ERROR' )  );
        exit();
  }

  $lst = $this->_db->loadObjectList();

  foreach($lst as $l)
  {
    $g = new PixxisGroup();
    $g->init( $l->name );
    $this->_groups[] = $g;
  }

}

function reload()
{
  unset($this->_groups);
  $this->init();
}

function getEntries()
{
  return $this->_groups;
}

}  //end class
?>