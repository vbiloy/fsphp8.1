<?php
/**
 * bootstrap for CLI-based request
 * @author: markg
 * @email: markglibres@yahoo.com
 */
error_reporting(E_ALL);

$cli_params = null;

require_once("setup.php");
$front = Zend_Controller_Front::getInstance();
$front->registerPlugin(new CADInitialize('production'));
$front->registerPlugin(new CADModels());
$front->registerPlugin(new CADViews());
$front->registerPlugin(new CADControllers());
$front->registerPlugin(new CADModules());
$front->registerPlugin(new CADPlugins());
$front->registerPlugin(new CADCache());
$front->registerPlugin(new CADHelpers());
$front->registerPlugin(new CADCli($cli_params));

$front->dispatch();
?>
