<?php

class StreamController extends Controller
{
    public function beforeAction()
    {


    }

    public function view($id)
    {
        $this->set("streamer",$this->Stream->GetStream($id));
    }


    public function index()
    {

    }

    public function afterAction()
    {

    }
}