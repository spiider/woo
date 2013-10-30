<?php
namespace library\Base;

class Template {
	
	protected $variables = array();
	protected $_controller;
	protected $_action;
	
	function __construct($controller,$action) {
		$this->_controller = $controller;
		$this->_action = $action;
	}


	function set($name,$value) {
		$this->variables[$name] = $value;
	}
	
    function render($doNotRenderHeader = 0) {

		extract($this->variables);

		if ($doNotRenderHeader == 0) {
			
			if (file_exists('../application/views/' . $this->_controller . 's/header.php')) {
				include ('../application/views/' . $this->_controller . 's/header.php');
			} else {

					include('../application/views/header.php');
			}
		}

		if (file_exists('../application/views/' . $this->_controller . "s/" . $this->_action . '.php')) {
			include ('../application/views/' . $this->_controller ."s/". $this->_action . '.php');
		}else{
            include('../application/views/homes/index.php');
        }
			
		if ($doNotRenderHeader == 0) {
			if (file_exists('../application/views/' . $this->_controller . 's/footer.php')) {
				include ('../application/views/' . $this->_controller . 's/footer.php');
			} else {
				include('../application/views/footer.php');
			}
		}
    }

}