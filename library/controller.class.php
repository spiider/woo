<?php

class Controller {
	
	protected $_controller;
	protected $_action;
	protected $_template;

	public $doNotRenderHeader;
	public $render;
    public $logged;

	public function __construct($controller, $action) {
		
		global $inflect;

        $this->_controller = ucfirst($controller);
		$this->_action = $action;
		
		$model = ucfirst($inflect->singularize($controller));
		$this->doNotRenderHeader = 0;
		$this->render = 1;
		$this->$model = new $model;
		$this->_template = new Template($controller,$action);
        $session = new sessions();
        $this->logged = $session->isLogged();
        $this->set("loginDetails",$this->logged);
        $this->set("menuItem",$controller);

        if(isset($_SESSION["error_msg"]))
        {
            $this->set("messageError",$_SESSION["error_msg"]);
            unset($_SESSION["error_msg"]);
        }else{
            $this->set("messageError","");
        }
	}

	public function set($name,$value) {

		$this->_template->set($name,$value);
	}

	public function __destruct() {
		if ($this->render) {
			$this->_template->render($this->doNotRenderHeader);
		}
	}
		
}