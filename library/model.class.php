<?php
namespace library;

class Model extends Database
{
    protected $_model;

	public function __construct()
	{
        $this->_model = get_class($this);
        $this->_table = strtolower(inflection::pluralize($this->_model));

	}

    public function __destruct() {

    }
}

