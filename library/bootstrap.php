<?php
	
	require_once('../config/config.php');
	require_once('../config/inflection.php');
	require_once('../library/core.php');

	
	function __autoload($className) {
		if (file_exists('../library/'. strtolower($className) . '.class.php')) {
			require_once('../library/'. strtolower($className) . '.class.php');
			} else if (file_exists('../application/controllers/' . strtolower($className) . '.php')) {
			require_once('../application/controllers/' . strtolower($className) . '.php');
			} else if (file_exists('../application/models/' . strtolower($className) . '.php')) {
			require_once('../application/models/' . strtolower($className) . '.php');
			} else {
			/* Error Generation Code Here */
		}
	}


	if(isset($_GET['url'])) $url = $_GET['url'];
	else $url = "home";

    //$session = new session();

    $sessions = new sessions();
	$core = new CORE;
	$core->setReporting();
	
	//$core->gzipOutput() || ob_start("ob_gzhandler");
	
	$cache = new Cache;
	$inflect = new Inflection;
	
	
	$core->routing($url);
