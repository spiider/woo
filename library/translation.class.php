<?php

class language {

    public $lang = null;
    public $db = null;

    public function __construct() {

        $this->lang = "pt_PT";
        $this->db = new  Db(DB_NAME);
    }

    public function get ($e) {
       return $this->db->get("translate","txt",["AND" => ["locale" => $this->lang, "name"=> $e]]);
    }

}