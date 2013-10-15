<?php

class sessions {

    private $langs;
    private $db;

    public function __construct() {
       // $this->langs = new language();
       // session_start();
        $this->db = new Db(DB_NAME);
    }

    public function login($email,$password) {

        if(strlen($password)<6) return "LOGIN_FAIL";
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return "LOGIN_FAIL";
        if($this->db->count("users",["email" => $email])==0) return "LOGIN_FAIL";
        $info = $this->db->get("users", ["id","uid","name","email","valid","password","picture","token","expire","groups"],["email" => $email]);

        if($info['valid']!=1) return "ACCOUNT_INACTIVE";
        if($info['groups']==0) return "NOT_ALLOWED_TO_LOGGED_HERE";

        $p = crypt($password, '$6$rounds=5000$6zZPPaJ90Cz43TVT3ODT');
        if($info['password']!=$p)  return "LOGIN_FAIL";
        session_regenerate_id();
        $this->db->insert("log_devices", ["user_id" => $info['id'], "ip" => $_SERVER['REMOTE_ADDR'], "device" => "Web", "device_name" => $_SERVER['HTTP_USER_AGENT']]);
        $this->db->update("users",["session" => session_id()],["email" => $email]);
        $_SESSION['email'] = $email;
        return TRUE;
    }


    public function isLogged()
    {
        if(!isset($_SESSION['email'])) return false;
        $info = ($this->db->count("users",["AND" => ["email" => $_SESSION['email'],"session" => session_id(),"groups[>]" => "0"]])>0) ? $this->db->get("users",["id","name","picture"],["AND" =>["email" => $_SESSION['email'],"session" => session_id(),"groups[<>]" => "0"]]) : false;

        if($info) $info['messageToRead'] = $this->db->count("mailbox", ["AND" => ["to_id" => $info['id'],"unread" => "1"] ]);
        return $info;
        //session_regenerate_id();
        //return ;
    }
}