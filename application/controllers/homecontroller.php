<?php
namespace application\controllers;
use library\Controller as Controller;

class HomeController extends Controller
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
    }

    public function afterAction()
    {

    }
}
