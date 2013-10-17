<?php
    require_once('../config/config.php');
	require_once(DIR_UP.'config/inflection.php');
	require_once(DIR_UP.'library/Base.php');

    // autoload from namespaces
    // implementing
    // Temporary function!
    function autoload($className)
    {
        $e = explode("\\", $className);
        $className = end($e);
        var_dump("load:",$className);
        if (file_exists(DIR_UP.'library/'. ucfirst(strtolower($className)) . '.class.php')) {
            require_once(DIR_UP.'library/'. ucfirst(strtolower($className)) . '.class.php');
        } else if (file_exists(DIR_UP.'application/controllers/' . strtolower($className) . '.php')) {
            require_once(DIR_UP.'application/controllers/' . strtolower($className) . '.php');
        } else if (file_exists(DIR_UP.'application/models/' . strtolower($className) . '.php')) {
            require_once(DIR_UP.'application/models/' . strtolower($className) . '.php');
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
    $Core = new library\Base();
	$Core->setReporting();
	
	//$core->gzipOutput() || ob_start("ob_gzhandler");
	
	//$cache = new Cache;
	$inflect = new library\Inflection();

    /*
     * Routing
     */
	$Core->routing($url);
