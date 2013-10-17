<?php
namespace library;

class Controller {
	
	protected $_controller;
	protected $_action;
	protected $_template;

	public $doNotRenderHeader;
	public $render;

	public function __construct($controller, $action) {

        $this->_controller = ucfirst($controller);
		$this->_action = $action;
		
		$model = ucfirst(inflection::singularize($controller));
		$this->doNotRenderHeader = 0;
		$this->render = 1;

		$this->$model = new $model;
		$this->_template = new Template($controller,$action);
        var_dump($this->$model);
        var_dump($this->_template);
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