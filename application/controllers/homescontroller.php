<?php
use library\Base\Controller;

class HomesController extends Controller
{
    public function beforeAction()
    {


    }

    public function view()
    {


    }

    public function index()
    {
        echo "hello world";
        $this->set("teste","Aro");
    }

    public function afterAction()
    {

    }
}
