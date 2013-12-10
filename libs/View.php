<?php

class View {

    function __construct() {
        //echo 'this is the view';
         $this->fb = new Facebook_class();
         $this->metaTags = Facebook_class::metaTAgs();
    }

    public function render($name, $noInclude = false) {


        $AL = new Autoload();
        $get_littlebox = new Get_littlebox();
        $e = new Events();
        $tmp = new Video_Upload();
        $_emailMe = new Email_Me();

       
         
       
        
        
        $this->Guini = new GuiniEdit(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        if ($noInclude == true) {
            require 'views/edit/header.php';
            require 'views/' . $name . '.php';
            require 'views/edit/footer.php';
        } else {

            require 'views/header.php';

            require 'views/' . $name . '.php';
            require 'views/footer.php';
        }
    }

}

