<?php
	
	require_once('../config/config.php');
	require_once('../config/inflection.php');
	require_once('../library/core.php');

    // autoload from namespaces
    // implementing
//    function __autoload($className)
//    {
//        $className = ltrim($className, '\\');
//        $fileName  = '';
//        $namespace = '';
//        if ($lastNsPos = strrpos($className, '\\')) {
//            $namespace = substr($className, 0, $lastNsPos);
//            $className = substr($className, $lastNsPos + 1);
//            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
//        }
//        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
//
//        require_once $fileName;
//    }

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


function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}


    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url = urldecode($url);
    $requested = "../public".$uri;

    // This file allows us to emulate Apache's "mod_rewrite" functionality from the
    // built-in PHP web server.
    if ($url !== '/' and file_exists($requested))
    {
        return false;
    }

    // My old way
	//if(isset($_GET['url'])) $url = $_GET['url'];
	//else $url = "home";

    $sessions = new sessions();
	$core = new CORE;
	$core->setReporting();
	
	//$core->gzipOutput() || ob_start("ob_gzhandler");
	
	$cache = new Cache;
	$inflect = new Inflection;
	
	
	$core->routing($url);
