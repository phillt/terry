<?php

class Termsofuse extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		//echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
		$this->view->render('termsofuse/index');
	}
	
	
	
}