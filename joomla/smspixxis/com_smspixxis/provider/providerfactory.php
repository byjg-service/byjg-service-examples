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

if( defined( 'PIXXIS_PROVIDER_PROVIDERFACTORY_PHP' ) == true )
{
  return;
}

/**
 * Define our class constant to precent multipe definition
 */
define( 'PIXXIS_PROVIDER_PROVIDERFACTORY_PHP', 1 );

/**
*  ProviderFactory is for handling with provider objects
*
* @package Pixxis
* @subpackage Provider
**/

class ProviderFactory
{

	/*
	 *  Array of all supported providers
	 */
     var $_providers;

     /*
      * Global db object
      */
	var $_db;

   /**
   *  The constructor creates an factory object and ini the provider array.
   * 
   */
      function  ProviderFactory()
      {      
      	$this->ReadAllProvider();      	
		$this->_db = &JFactory::getDBO();
		
      }

      function ReadAllProvider()
      {
      	$dirName = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;   
      	$handle = dir( $dirName );
      	
      	if( $handle === false )
      	{
      		return;
      	}
      	
      	while( false !== ($entry = $handle->read())) 
      	{
   			if( is_dir( $entry ) )
   			{
   				continue;
   			}
   			
   			if( !preg_match( "/pixxis\.provider\.(.*)\.php/", $entry ) )
   			{
   				continue;
   			}
   			
   			$providerName = substr( $entry, strlen( 'pixxis.provider.'), strlen( $entry )  );
   			$providerName = substr( $providerName, 0, strlen( $providerName ) - strlen( '.php' ) );
   			
   			if( empty( $providerName ) )
   			{
   				continue;
   			}
   			
   			if( $providerName == 'provider' )
   			{
   				continue;
   			}
   			
   			require_once( $entry );
   			
   			$this->_providers[ $providerName ] = $entry;   			
		}
      }
      
   /**
   *  This function returns an provider instance identified by name, if no such provider exists, fals is returned
   *  @param string $name
   */
      function getInstance( $name )
      { 
      	 //$name = strtolower( $name );     	
		 
		 //Force to load Pixxis always
		 $name = strtolower( "pixxis" );     	
      	
        //check if provider exists
          if( isset($this->_providers[$name]) )
          {          	          
            //try to create an new object
             $provider = new $name();
                          
             //check object
             if( is_object( $provider ) )
             {
                   $provider->loadConfigFromDB(); //load config from db
                   return $provider;
             }
          }
          
          return false;
      }

   /**
   *  This function returns the active provider from database
   *  @param string $name
   */
      function getActiveInstance()
      {
        //get the current provider and its file name ( w2sms.php )
        /*$sql = "SELECT * FROM #__pixxis_provider where active='1' LIMIT 1";

        $this->_db->setQuery($sql);

        if(  $this->_db->query() == false ) //check error
        {
            PixxisRedirect('com_pixxis --> getActiveProvider: database query failed !!!');
            return;
        }

        //load databse object
        $row =  $this->_db->loadObject();
        return $this->getInstance( $row->name );
		*/
		return $this->getInstance( "pixxis" );
      }


   /**
   *  This function registers all providers at database, should called on installation
   *  @param string $name
   */
      function registerAllProvider()
      {
        foreach($this->_providers as $name => $file )
        {
          $obj = $this->getInstance($name);
          $obj->register();
        }
      }
}  //end class
?>
