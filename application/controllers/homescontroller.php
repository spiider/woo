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
        $this->doNotRenderHeader = 1;
        echo "hello world";
        $this->set("teste","Aro");
    }

    public function afterAction()
    {

    }
}
