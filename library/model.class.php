<?php


class Model extends Db
{
    protected $_model;
	//public $db = NULL;
    //protected $session;

	public function __construct()
	{
        global $inflect;

		//$this->db = new Db(DB_NAME);

        $this->_model = get_class($this);
        $this->_table = strtolower($inflect->pluralize($this->_model));

	}

    public function __destruct() {

    }
}

