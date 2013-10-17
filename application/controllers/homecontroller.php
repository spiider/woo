<?php
//namespace application\controllers;
//use library;

class HomeController extends library\Controller
{
    public function beforeAction()
    {


    }

    public function view()
    {


    }

    public function index()
    {
        $this->doNotRenderHeader = 1;
        echo "hello world";
        $this->set("teste","Aro");
    }

    public function afterAction()
    {

    }
}
