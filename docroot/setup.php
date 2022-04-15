<?php
/**
 * setup the framework
 * @author: Mark Gil M. Libres
 * @email: markglibres@yahoo.com,
 * @on: 1/21/2008
 */
require_once("define.php");
require_once(ZEND_DIR.'Loader/Autoloader.php');


/**
 * include simplesamlphp
 * SSO
 */
/*
 * @description: Bug 76468 - FS -Integration with Rapid Identity
 * @changes: removed, making this dynamic instead
 * @by: ozy hale
 * @date: 7/31/2018
 */
//require_once(TOOL_DIR. 'simplesamlphp-1.14.14/lib/_autoload.php');

// for dompdf
require_once(TOOL_DIR.'dompdf/dompdf_config.inc.php');
$autoloader = Zend_Loader_Autoloader::getInstance();
//$autoloader->setFallbackAutoloader(true);

/**
* Smarty/Zend compatibility fallback/smarty loader
*/
$autoloader->setFallbackAutoloader(true)->pushAutoloader(NULL, 'Smarty_' );
spl_autoload_register('DOMPDF_autoload'); 

//print_r($autoloader->getNamespaceAutoloaders());die();
//$autoloader->regisAutoload();
/**
 * autoloads a classname
 * @author: markg
 */
function __autoload($class_name)
{
	Zend_Loader::loadClass($class_name);	
}

/**
 * include classes used by setupSmarty()
 * @author: markg
 * @on: 1/23/2008
 */
//require_once(SMARTY_DIR."Smarty.class.php");

/**
* backward compatibility class
*/
require_once(SMARTY_DIR."SmartyBC.class.php");

if (file_exists(LIB_DIR."phpseclib/Crypt/RC4.php")) 
{
	require_once(LIB_DIR."phpseclib/Crypt/RC4.php");
}
?>