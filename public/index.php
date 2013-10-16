<?php
    /*
     * Cross sub-domain authentitcation
     */
    ini_set('session.cookie_domain',substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));
    session_start();

    require_once('../library/bootstrap.php');