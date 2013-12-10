<?php

class Error extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index($msg = 'This page doesnt exist') {
		$this->view->msg = $msg;
		$this->view->render('error/index');
	}
        
        

}