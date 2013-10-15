<?php

class Stream extends Model
{

    public function __construct() {

    }

    public function GetStream($channel)
    {
        $mycurl = curl_init();

        curl_setopt ($mycurl, CURLOPT_HEADER, 0);
        curl_setopt ($mycurl, CURLOPT_RETURNTRANSFER, 1);

        //Build the URL
        $url = "http://api.justin.tv/api/stream/list.json?channel=" . $channel;
        curl_setopt ($mycurl, CURLOPT_URL, $url);

        $web_response =  curl_exec($mycurl);

        $results = json_decode($web_response);

        return $results;


    }
}