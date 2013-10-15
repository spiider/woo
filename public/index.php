<?php
ini_set('session.cookie_domain',
    substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));
session_start();
//$_SESSION['email'] = "eu@ibt.pt";
require_once('../library/bootstrap.php');