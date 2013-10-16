<?php
    use library\Core as core;
    use library\Controller as Controller;

    require_once('../config/config.php');
	require_once(DIR_UP.'config/inflection.php');
	require_once(DIR_UP.'library/Base.php');

    // autoload from namespaces
    // implementing
    // Temporary function!
    function autoload($className)
    {
//        $folder = (strpos($className,'Controller') !== false) ? 'application/controllers/' : 'library/';
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
//        require_once DIR_UP.$folder.$fileName;
        if(strpos($className,'\\') !== false) {
            $e =  explode("/", $className);
            $className = $e['1'];
        }
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
    spl_autoload_register("autoload");

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
  //  new Controller\Controller("home","index");
    $Core = new core\Base();
	$Core->setReporting();
	
	//$core->gzipOutput() || ob_start("ob_gzhandler");
	
	$cache = new Cache;
	$inflect = new Inflection;

    /*
     * Routing
     */
	$Core->routing($url);
