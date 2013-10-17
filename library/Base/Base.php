<?php
namespace library\Base;

class Base {
    public static function setReporting()
    {
        if (DEVELOPMENT_ENVIRONMENT == true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', DIR_UP.'tmp/logs/error.log');
        }
    }

    /*
     *  Routing url to work with MVC
     *  @queryString will be pass all extra parameters
     */
    public static function routing($url) {
        // Prevent Case sensitive requests
        $url = strtolower($url);
        if ($url == "/") {
            $controller = "home";
            $action = "index";
        } else {
            $queryString[] = explode("/", substr($url, 1));
            $controller = $queryString[0];
            array_shift($queryString);
            if(!empty($queryString[0])) {
                if((int)method_exists(ucfirst($controller).'sController', $queryString[0]))
                {
                    $action = $queryString[0];
                    array_shift($queryString);
                }else {
                    $action = (!empty($queryString[1])) ?  $queryString[1] : 'index';
                    unset($queryString[1]);
                }
            } else {
                $action = 'index'; // Default Action
            }
        }

        $controllerName = ucfirst($controller).'sController';
        if(file_exists(DIR_UP.'application/controllers/' . strtolower($controllerName) . '.php'))
        {
            $dispatch = new $controllerName($controller,$action);
        } else {
            $action = 'index';
            $controllerName = 'HomesController';
            $dispatch = new $controllerName('home',$action);
        }

        if ((int)method_exists($controllerName, $action)) {
            call_user_func_array(array($dispatch,"beforeAction"),$queryString);
            call_user_func_array(array($dispatch,$action),$queryString);
            call_user_func_array(array($dispatch,"afterAction"),$queryString);
        } else {
            /* Error Generation Code Here */
        }
    }

    public function gzipOutput() {
        $ua = $_SERVER['HTTP_USER_AGENT'];

        if (0 !== strpos($ua, 'Mozilla/4.0 (compatible; MSIE ')
            || false !== strpos($ua, 'Opera')) {
            return false;
        }

        $version = (float)substr($ua, 30);
        return (
            $version < 6
            || ($version == 6  && false === strpos($ua, 'SV1'))
        );
    }
}
