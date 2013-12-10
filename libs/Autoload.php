<?php

/**
 * Philllware free open source code.
 * the following file autoloads external Javascript files
 * and will autoload files from the libs
 * folder if the method is class is not already loaded 
 */
//auto loads items js and CSS files in a views folder called auto, it will automatically go through sub directories
//define('URL', 'http://www.philllware.com/TerryMVC/');

final class AutoLoad {

    function __construct() {
        
    }

    /**
     *
     * @param string $controller is expecting the the $controller to be in this format controler/file.php
     * @return boolean or string  
     */
    public function checkIfAutoExists($controller) {
        $c = explode('/', $controller);
        $files = 'views/' . $c[0] . "/auto";

        if (file_exists($files)) {
            $exclude_list = array('.', '..');
            $directories = array_diff(scandir($files), $exclude_list);
            return $this->createExternalPaths($directories, $files);
        } else {
            return false;
        }
    }

    /**
     *
     * @return string returns a list of external files all in the autoload public folder
     * please note that it won't look through a folder called images. 
     */
    public function loadPublic() {
        $files = 'public';
        if (file_exists($files)) {
            $exclude_list = array('.', '..');
            $directories = array_diff(scandir($files), $exclude_list);
            return $this->createExternalPaths($directories, $files);
        } else {
            return false;
        }
    }

    public function loadPrivate() {
        $files = 'private';
        if (file_exists($files)) {
            $exclude_list = array('.', '..');
            $directories = array_diff(scandir($files), $exclude_list);
            return $this->createExternalPaths($directories, $files);
        } else {
            return false;
        }
    }

    private function createExternalPaths($files, $f) {

        $_stack_of_file_includes = "";



        foreach ($files as $ext) {
            //split the file name into two;
            if (filetype($f . '/' . $ext) == 'dir') {
                $exclude_list = array('.', '..', 'images', 'fonts');
                $directories = array_diff(scandir($f . '/' . $ext), $exclude_list);


                $_stack_of_file_includes = $_stack_of_file_includes . $this->createExternalPaths($directories, $f . '/' . $ext);
            } else {





                $fileName = explode('.', $ext); //issue fixed

                switch ($fileName[1]) {
                    case "js":
                        //if file is javascript
                        $_stack_of_file_includes = $_stack_of_file_includes . "<script type='text/javascript' src='" . URL . $f . '/' . $ext . "'></script>\n";

                        break;
                    case "css"; //if file is css
                        $_stack_of_file_includes = $_stack_of_file_includes . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . URL . $f . "/" . $ext . "\" />\n";
                        break;
                    default://if file type is unkown
                       // $_stack_of_file_includes = $_stack_of_file_includes . "<!-- File: " . $ext . " was not included-->";
                }
            }
        }
        return $_stack_of_file_includes;
    }

    public static function load($classname) {
        require 'libs/' . $classname . '.php';
    }

    public function buildForHeader($rootDir) {
        $files = $this->loadPublic($rootDir);

        if ($files != flase) {
            echo $files;
        }



//autoloads files from a folder called 'auto' in the view directory for the controller.    
        $files = $this->checkIfAutoExists($rootDir);

        if ($files != flase) {
            echo $files;
        }
    }

    /*/@params:$files string, indicate what root directory to look for the font files.
     * @return: string, returns a string in CSS with the files already imported.
     */
    public function autoIncludeCSS3fonts($files) {
        $top = "<style>";
        $fontFam = "";
        if (file_exists($files)) {
            $exclude_list = array('.', '..');
            $directories = array_diff(scandir($files), $exclude_list);

            $fonts = array();




            //scan directories

            $new_data = array();
            foreach ($directories as $value) {
                $tmp = explode('.', $value);

                $new_data[$tmp[0]][] = $tmp[0] . '.' . $tmp[1];
            }

         

            foreach ($new_data as $key => $t) {

                   $fonts = "";
                   
                   foreach ($t as $font){
                       
                       $fonts .=',url("'.URL.'public/fonts/'.$font.'")';  
                   }
                  $fonts = ltrim($fonts, ', ');
                $fontFam .= "@font-face
                               {
                               font-family: $key;
                               src: $fonts;
                               }";
            }




            return $top . $fontFam . "</style>";
        } else {
            return false;
        }
    }

    

}

spl_autoload_register(array('autoload', 'load'));
?>