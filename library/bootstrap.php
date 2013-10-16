<?php
    use library\Core as core;

    require_once('../config/config.php');
	require_once(DIR_UP.'config/inflection.php');
	require_once(DIR_UP.'library/Base.php');

    // autoload from namespaces
    // implementing
//    function autoload($className)
//    {
//        if($className == 'HomeController') return true;
//        var_dump($className);
//        $className = ltrim($className, '\\');
//        $fileName  = '';
//        $namespace = '';
//        if ($lastNsPos = strrpos($className, '\\')) {
//            $namespace = substr($className, 0, $lastNsPos);
//            $className = substr($className, $lastNsPos + 1);
//            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
//        }
//        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.class.php';
//
//        require_once DIR_UP.'library/'.$fileName;
//    }
//    spl_autoload_register("autoload");

	function __autoload($className) {
		if (file_exists(DIR_UP.'library/'. ucfirst(strtolower($className)) . '.class.php')) {
			require_once(DIR_UP.'library/'. ucfirst(strtolower($className)) . '.class.php');
			} else if (file_exists(DIR_UP.'application/controllers/' . ucfirst(strtolower($className)) . '.php')) {
			require_once(DIR_UP.'application/controllers/' . ucfirst(strtolower($className)) . '.php');
			} else if (file_exists(DIR_UP.'application/models/' . ucfirst(strtolower($className)) . '.php')) {
			require_once(DIR_UP.'application/models/' . ucfirst(strtolower($className)) . '.php');
			} else {
			/* Error Generation Code Here */
		}
	}


    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url = urldecode($url);
    $requested = DIR_UP."public".$url;

    // This file allows us to emulate Apache's "mod_rewrite" functionality from the
    // built-in PHP web server.
    if ($url !== '/' and file_exists($requested))
    {
        return false;
    }

    // My old way
	//if(isset($_GET['url'])) $url = $_GET['url'];
	//else $url = "home";

    //$sessions = new sessions();
    $Core = new core\Base();
	$Core->setReporting();
	
	//$core->gzipOutput() || ob_start("ob_gzhandler");
	
	$cache = new Cache;
	$inflect = new Inflection;

    /*
     * Routing
     */
	$Core->routing($url);
