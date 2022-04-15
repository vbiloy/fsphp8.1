<?php
/**
 * for windows compatibility on directory
 * @author: markg
 */
$root = str_replace("\\","/",realpath(dirname(__FILE__) . "/../"));
if($root[strlen($root)-1] != "/")
 	$root .= "/";
 
define("ROOT_DIR", $root);
define("DOC_ROOT",$root."docroot/");
define("LIB_DIR",ROOT_DIR . "lib/");
define("APP_CONTROLLERS",ROOT_DIR.'application/default/controllers/');

define("SMARTY_DIR",LIB_DIR . "Smarty/");
define("ZEND_DIR",LIB_DIR . "Zend/");
define("APP_DIR",ROOT_DIR.'application/');
define("DEFAULT_DIR",ROOT_DIR.'application/default/');
define("DEFAULT_PLUGINS",DEFAULT_DIR.'plugins/');
define("DEFAULT_HELPERS",DEFAULT_DIR.'helpers/');
define("CAD_DIR",LIB_DIR . "CtrlAltDelete/");
define("CAD_COMMON",CAD_DIR . "Common/");
define("CAD_CONTROLLER",CAD_DIR . "Controller/");
define("CAD_MODEL",CAD_DIR . "Model/");
define("CAD_VIEW",CAD_DIR . "View/");
define("CAD_PLUGINS",CAD_DIR . "Plugins/");
define("CAD_HELPERS",CAD_DIR . "Helpers/");

/**
*support for multiple clients using a subdomain or full url
*@author: markg
*@on: 2/20/2008
**/
$subdomainBASE = true;
if(file_exists(APP_DIR."config.ini"))
{
	$app_ini = parse_ini_file(APP_DIR."config.ini",true);
	if(isset($app_ini["clientbase"]["subdomain"]))
		$subdomainBASE = $app_ini["clientbase"]["subdomain"];
}

$url = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : false;
$https = false;
/**
 * checks if CLI execution
 * @author: markg
 * @email: markglibres@yahoo.com
 * @on: 8/25/2009
 */
if(!$url)
{
	/**
	 * @param: f = cliet folder, m = module, c = controller, a = action, p = parameters
	 * "params" should be in the format of /variable/value
	 * 
	 */
	$cli_params = getopt("f:m:c:a:p:");
	
	$cli_params["m"] = isset($cli_params["m"]) && !empty($cli_params["m"]) ? $cli_params["m"] : "default";
	$client_dir = isset($cli_params["f"]) && !empty($cli_params["f"]) ? $cli_params["f"] : "default";
	
	//print_r($parms);
	//die();
}
elseif($subdomainBASE)
{
        $aCustomIndex = array("www", "fs");
	$url = explode(".",$url);
	$config_dir = "";
	if(count($url) > 1 && substr($url[0],0,3) != "www" && !in_array($url[0], $aCustomIndex))
	{
		if($url[0] == "ssl" || $url[0] == "ssl3")
		{
			$https = true;
			$url_https = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : false;

			$url_https = explode("/",$url_https);

			if(count($url_https) > 0)
			{
				$client_dir = $url_https[1];
			}
			else
			{
				$client_dir = "default";
			}
		}
		else
		{
			$client_dir = $url[0];
		}
	}
	else
	{
            if(in_array($url[0], $aCustomIndex)) // for custom domain.
            {
                $client_dir = $url[1];
            }
            else
            {
                $client_dir = "default";
            }
	}
}
else 
{
	if(file_exists($root."clients/".$url."/"))
		$client_dir = $url;
	else
		$client_dir = "default";
}

define("CLIENT_DIR",$root."clients/".$client_dir."/");
define("CLIENTS_DIR",$root."clients/");
define("CLIENT_EXT",(string)$client_dir);
define("CLIENT_WWW","/cad_clients/".$client_dir."/");
define("TOOL_DIR",LIB_DIR . "Tools/");
define("SECURE",$https);
if($https)
	define("SSL_DIR","/coachdir");
else
	define("SSL_DIR","");

/**
 * define the names used on Zend registry
 * @author: markg
 */
define("REGISTRY_DWC","dwc_config");
define("REGISTRY_VIEW","view");
define("REGISTRY_LOG","log");
define("REGISTRY_MODEL","model");
define("REGISTRY_APP","application"); 

/**
 * define the sessions names
 * @author: markg
 * @on: 6/24/2008
 */
define("SESSION_CLIENT","session_client");

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR .
	ZEND_DIR . PATH_SEPARATOR .
	LIB_DIR . PATH_SEPARATOR .
	CAD_DIR . PATH_SEPARATOR .
	CAD_COMMON . PATH_SEPARATOR .
	CAD_CONTROLLER . PATH_SEPARATOR .
	CAD_MODEL . PATH_SEPARATOR .
	CAD_VIEW . PATH_SEPARATOR .
	CAD_PLUGINS . PATH_SEPARATOR .
	TOOL_DIR . PATH_SEPARATOR .
	SMARTY_DIR . PATH_SEPARATOR . 
	DEFAULT_PLUGINS . PATH_SEPARATOR);
	

?>
