<?php
/**
 * bootstrap for HTTP-based request
 * @author: markg
 * @email: markglibres@yahoo.com
 */

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

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

// Zend_Loader::loadClass('BenchmarkUtility', DEFAULT_DIR . "classes/");
// global $benchmark;
// $benchmark = new BenchmarkUtility();
// $benchmark->saveStartTime();

$front->dispatch();

// $benchmark->saveEndTime();

?>