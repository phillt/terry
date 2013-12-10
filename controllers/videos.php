<?php

class Videos extends Controller {

	function __construct() {
		parent::__construct();
                
               
	}
	
	function index() {
            $this->view->position = $this->position;
		//echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);]
               $this->view->feature = $this->model->return_video_template('8qhsztcJtOs');
              // $testing = 'hello';
		$this->view->render('videos/index');
	}
	
        public function watch($number){
            $this->view->position = $this->position;
            $this->view->feature = $this->model->return_video_template($number);
               if (!$this->view->feature){
                   require 'controllers/error.php';
		$controller = new Error();
		$controller->index("Oops! It looks like that video doesn't exist. <a href='".URL."videos'>Go Back.</a>");
		return false;
               }
		$this->view->render('videos/videos');
        }
	
}