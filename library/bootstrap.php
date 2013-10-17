<?php
use library\Base;

require_once('config/config.php');
require_once('config/inflection.php');

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    $e = explode("\\", $className);
    $className = end($e);
    if (file_exists(DIR_UP.$fileName)) {
        require_once(DIR_UP.$fileName);
    } else if (file_exists(DIR_UP . 'application/controllers/' . strtolower($className) . '.php')) {
        require_once(DIR_UP . 'application/controllers/' . strtolower($className) . '.php');
    } else if (file_exists(DIR_UP . 'application/models/' . strtolower($className) . '.php')) {
        require_once(DIR_UP . 'application/models/' . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
    }
}

spl_autoload_register("autoload");

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = urldecode($url);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server.
if ($url !== '/' and file_exists(DIR_UP . "public" . $url)) {
    return false;
}

Base\Base::setReporting();
//$cache = new Cache;
$inflect = new library\Base\Inflection();
Base\Base::setReporting($url);
