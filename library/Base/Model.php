<?php
namespace library\Base;
use library\Storage\Database;

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

