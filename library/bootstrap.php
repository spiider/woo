<?php
    use library\Core as core;

    require_once('../config/config.php');
	require_once('../config/inflection.php');
	require_once('../library/Base.php');

    // autoload from namespaces
    // implementing
//    function autoload($className)
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
//    spl_autoload_register("autoload");

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


    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url = urldecode($url);
    $requested = "../public".$url;

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
    $Core = new core\Base();
	$Core->setReporting();
	
	//$core->gzipOutput() || ob_start("ob_gzhandler");
	
	$cache = new Cache;
	$inflect = new Inflection;

    /*
     * Routing
     */
	$Core->routing($url);
