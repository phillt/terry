<?php

class Bootstrap {

	function __construct() {
               
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);
                
		//print_r($url);  
		
		if (empty($url[0])) {
			require 'controllers/index.php';
			$controller = new Index();
                        $controller->position = URL;
                        $controller->index();
                        
			return false;
		}
                $url[0] = strtolower($url[0]);
		$file = 'controllers/' . $url[0] . '.php';
               
		if (file_exists($file)) {
                   
			require $file; 
		} else {
                    $message = "Terrebly sorry, but it seems that  $url[0]  doesn't exist!";
			$this->error($message);
                        return false;
		}
		
		$controller = new $url[0];
                $controller->position = URL . $url[0];
		$controller->loadModel($url[0]);

		// calling methods
		if (isset($url[2])) {
			if (method_exists($controller, $url[1])) {
                                $controller->position = URL.$url[0]. '/'. $url[1]. '/'. $url[2];
				$controller->{$url[1]}($url[2]);
			} else {
				$this->error();
			}
		} else {
			if (isset($url[1])) {
				if (method_exists($controller, $url[1])) {
                                    $controller->position = URL.$url[0]. '/'. $url[1];
					$controller->{$url[1]}();
				} else {
					$this->error();
				}
			} else {
				$controller->index();
			}
		}
		
		
	}
	
	function error($error = "") {
   
		require 'controllers/error.php';
		$controller = new Error();
		$controller->index($error);
		return false;
	}

}