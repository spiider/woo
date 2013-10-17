<?php
use library\Database;

class Model extends Database
{
    protected $_model;

	public function __construct()
	{
        global $inflect;

        $this->_model = get_class($this);
        $this->_table = strtolower($inflect->pluralize($this->_model));

	}

    public function __destruct() {

    }
}

