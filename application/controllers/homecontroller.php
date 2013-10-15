<?php

class HomeController extends Controller
{
    public function beforeAction()
    {


    }

    public function view()
    {


    }

    public function dashboard()
    {
        if(!$this->logged) header("Location: /");
    }

    public function auth()
    {
        if(!empty($_POST))
        {
            $session = new sessions();

            $_SESSION["error_msg"] = $session->login($_POST['email'],$_POST['password']);
            header("Location: /");
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
    }

    public function index()
    {
        $this->set("lol_streams",$this->Home->StreamFrontPage("lol"));
        $this->set("csgo_streams",$this->Home->StreamFrontPage("csgo"));
        $this->set("sc2_streams",$this->Home->StreamFrontPage("sc2"));
        $this->set("rss_hltv",$this->Home->getFeed("http://www.hltv.org/news.rss.php"));
        $this->set("rss_frag",$this->Home->getFeed("http://fraglider.pt/rss.xml"));
        $this->set("rss_reddit",$this->Home->getFeed("http://www.reddit.com/r/leagueoflegends/.rss"));

    }

    public function afterAction()
    {

    }
}
