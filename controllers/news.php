<?php

class News extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
    }

    function index() {
        //echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
        //echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
        $this->view->stream = $this->model->getStream(10);
        $this->view->render('news/index');
    }

    function addnews() {

        if (Session::get('loggedIn')) {
            $this->view->categories = $this->model->returnCategories();
            $this->view->render('news/addnews');
        }
        else
            $this->view->render('error/index');
    }

    function submitpost() {

        if (Session::get('loggedIn')) {
            $this->model->submitPost();

            $this->view->render('news/post');
        }
        else
            header(URL);
    }

    function post($news) {

        $this->view->position = $this->position;
        $this->view->postid = $news;

        $this->view->content = $this->model->getNews($news);


        $doc = new DOMDocument();
        $doc->loadHTML($this->view->content['cont']);
        $xml = simplexml_import_dom($doc); // just to make xpath more simple
        $images = $xml->xpath('//img');
        
        $imagesInNews = array();
        foreach ($images as $img) {
            array_push($imagesInNews, $img['src']);
        }

        $this->view->metaTags = Facebook_class::metaTAgs(array('title'=>$this->view->content['title'], 'url' => $this->position, 'description' => substr(convert_html_to_text($this->view->content['cont']), 0, 100) . "...", 'image' => $imagesInNews));

        $this->view->render('news/post');
    }

    function removepost($postID) {
        $this->model->removenews($postID);
        header("Location: " . URL);
    }

}