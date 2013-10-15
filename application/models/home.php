<?php

class Home extends Model
{

    public function __construct() {

    }

    function getFeed($feed_url) {

        $content = file_get_contents($feed_url);
        $x = new SimpleXmlElement($content);

        $t = null;
        $i = 0;
        foreach($x->channel->item as $entry) {
            $e = (strlen($entry->title)>40) ? substr($entry->title, 0,40)."..." : $entry->title;

            $t .= "<tr><td class=\"text-left\"><a href='$entry->link' title='$entry->title'>" . $e . "</a></td></tr>";
            $i++;
            if($i == 10) break;
        }
        return $t;
    }


    public function StreamFrontPage($game)
    {
        // TODO
        // need be converted to database request
        switch($game)
        {
            case "lol":
                $stream_list = "ocelote,froggen,aphromoo,therainman,Kaostv,imaqtpie,voyboy,tsm_dyrus,riotgames,salce,edwardlol,vman7,sivhd,puszu";
            break;

            case "csgo":
                $stream_list = "brunobit1,fnaticgotv,esltv_cs,nipgamingtv,markeloff_csgo";
            break;

            case "dota2":
                $stream_list = "starladder1,beyondthesummit,joindotared,antenadota";
            break;

            case "sc2":
                $stream_list = "mlgsc2,DreamhackTV";
            break;

        }

        $MyCurl = curl_init();

        curl_setopt ($MyCurl, CURLOPT_HEADER, 0);
        curl_setopt ($MyCurl, CURLOPT_RETURNTRANSFER, 1);

        //Build the URL
        $url = "http://api.justin.tv/api/stream/list.json?channel=" . $stream_list;
        curl_setopt ($MyCurl, CURLOPT_URL, $url);

        $web_response =  curl_exec($MyCurl);

        $results = json_decode($web_response);

        return $results;


    }

}