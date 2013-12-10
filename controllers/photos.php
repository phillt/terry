<?php

class Photos extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		//echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
                $this->view->title = "Albums";
                $this->view->album = $this->model->return_image_albums();
		$this->view->render('photos/index');
	}
	
	function album($album) {
          $album = str_replace("-", " ", $album);
          //$album = urldecode($albume);
         $this->view->title = "<a href='".URL."/photos'>Albums</a> / ".$album;
            $this->view->album = $this->model->return_images($album);
		$this->view->render('photos/index');
	}
        
        function photo($photo = 'test'){
            $this->view->photoid = $photo;
            $this->view->position = $this->position;
            $this->view->title = "<a href='".URL."/photos'>Albums</a>";
             $temp= $this->model->return_photo($photo);
             $this->view->album = $temp[0];
             $this->view->cat = $this->model->cat;
             
//             $this->view->metaTags = Facebook_class::metaTAgs('photos/photo/'.$photo, URL. 'images/'.$temp[1], $temp[2]);
            // 'url' => $this->view->position, 'image'=> array(0=>URL. 'images/'.$temp[1]));
             $this->view->metaTags = Facebook_class::metaTAgs( array('url' => $this->view->position, 'image'=> array(0=>URL. 'images/'.$temp[1])));
            $this->view->render('photos/photo');
            
        }
	
}