<?php

require 'libs/htmltotext.php';
require 'config.php';
require 'libs/Get_user.php';
//require 'config/database.php';
// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
	require LIBS . $class .".php";
} 

Session::init();
  
$app = new Bootstrap();
 