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

if( defined( 'PIXXIS_BACKEND_TOOLBAR_HTML_PHP' ) == true )
{
  return;
}

/**
 * Define our class constant to precent multipe definition
 */
define( 'PIXXIS_BACKEND_TOOLBAR_HTML_PHP', 1 );

/**
*  TOOLBAR_Pixxis is for the toolbar in backend
*
 * @package Pixxis
 * @subpackage Backend
**/

class PixxisToolBarHtml
{

         /**
          * Toolbar for editing a user
          *
          */
         function EditUser()
         {
         	JToolbarHelper::save();
			JToolbarHelper::spacer();
			JToolbarHelper::cancel();
         }

       /**
        * User Default toolbar
        *
        */
        function UserDefault()
        {
			JToolbarHelper::spacer();
			JToolbarHelper::custom( 'loadListPanel'	,  'forward.png'	, 'forward_f2.png'	, 'PIXXIS_LOADLIST' 	  );
			JToolbarHelper::custom( 'publish'		,  'apply.png'		, 'apply_f2.png'	, 'publish'    );
			JToolbarHelper::custom( 'unpublish'		,  'trash.png'		, 'trash_f2,png'	, 'unpublish' );
            JToolbarHelper::editListX();
	        JToolbarHelper::cancel();
        }

        /**
         * Default Provider Toolbar
         *
         */
        function ProviderDefault()
        {
			JToolbarHelper::spacer();
            JToolbarHelper::editListX();
	        JToolbarHelper::cancel();
        }

        /**
         * Toolbar when editing a provider
         *
         */
        function EditProvider()
        {
			JToolbarHelper::save();
			JToolbarHelper::spacer();
	        JToolbarHelper::cancel();
        }

        /**
         * Default toolbar when editing the advertisment
         *
         */
        function AdDefault()
        {
			JToolbarHelper::save();
			JToolbarHelper::spacer();
	        JToolbarHelper::cancel();
        }

        /**
         * Default toolbar for global settings
         *
         */
        function GlobalDefault()
        {
        	JToolbarHelper::save();
	        JToolbarHelper::cancel();
        }

        /**
         * Show only a back button
         *
         */
        function AboutDefault()
        {
	        JToolbarHelper::cancel();
        }
} //end class
?>