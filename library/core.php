<?php 

	class CORE {
		private $default = array("controller" => 'home', "action" => 'index');
		
		
		public function setReporting()
		{
			if (DEVELOPMENT_ENVIRONMENT == true) {
				error_reporting(E_ALL);
				ini_set('display_errors','On');
			} else {
				error_reporting(E_ALL);
				ini_set('display_errors','Off');
				ini_set('log_errors', 'On');
				ini_set('error_log', '../tmp/logs/error.log');
			}
		}
		
		
		private function routeURL($url) {
			$routing = array();

			foreach ( $routing as $pattern => $result ) {
					if ( preg_match( $pattern, $url ) ) {
						return preg_replace( $pattern, $result, $url );
					}
			}
			return ($url);
		}


		public function routing($url) {

			$queryString = array();
			if (!isset($url)) {
				$controller = $this->default['controller'];
				$action = $this->default['action'];
			} else {
				$url = strtolower($this->routeURL($url));
				$urlArray = explode("/",$url);
				$controller = $urlArray[0];
				array_shift($urlArray);

				if(!empty($urlArray[0])) {
                    if((int)method_exists(ucfirst($controller).'Controller', $urlArray[0]))
                    {
                        $action = $urlArray[0];
                        array_shift($urlArray);
                    }else{
                        if(!empty($urlArray[1]))
                        {
                            $action = $urlArray[1];
                            unset($urlArray[1]);
                        }else{
                            $action = 'index';
                        }
                    }

				} else {
					$action = 'index'; // Default Action
				}
				$queryString = $urlArray;
			}

            $controllerName = ucfirst($controller).'Controller';

            //var_dump($controllerName,$controller,$action);
            //exit;

			if(file_exists('../application/controllers/' . strtolower($controllerName) . '.php'))	$dispatch = new $controllerName($controller,$action);
			else $dispatch = new HomeController("home","index");

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