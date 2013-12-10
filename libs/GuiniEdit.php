<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GuiniEdit extends Database {

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
    }

    public function displayLittleBox($id) {

        $content = $this->select("SELECT element_id, id, content FROM littleBoxes WHERE web_id= :web AND element_id = :e_id", array(':web' => WEB_ID, ':e_id' => $id));



        $con = "";
        $id = "";
        $e_id = "";

        foreach ($content as $var) {
            $con = $var['content'];
            $e_id = $var['element_id'];
            $id = $var['id'];
        }

        if (Admincontrols::isloggedin($bool = true)) {
            //return this if admin is logged in
            return "
            <div class='userui'>
            <div class='content'>
               
                    $con
           </div>
           
           
         
           
           <form method='post' action='" . URL . "edit/editor'>
           <fieldset style='border-style: none; display: inline;'>
                   <img src='" . URL . "private/images/Paper-pencil.png'>Edit this Content
           <textarea style='visibility:hidden' name='content'>$con</textarea>
           <input type='hidden' name='e_id' value='$e_id' /> 
           <input type='hidden' name='id' value='$id' />
                   <input type='hidden' name='return' value='' />
                   <script type=\"text/javascript\">
$(\"[name=return]\").val(document.URL);
</script>
           <input style='' guini='buttonui' type='submit' value='Edit this content' />
           </fieldset>
           </form>
    </div>";
        } else {
            //return this if admin is logged in

            return "<div class='content'>
               
                    $con
    </div>";
        }
    }

    public function displayLittleBoxImage($id) {

        $content = $this->select("SELECT element_id, id, content FROM littleBoxes WHERE web_id= :web AND element_id = :e_id", array(':web' => WEB_ID, ':e_id' => $id));



        $con = "";
        $id = "";
        $e_id = "";

        foreach ($content as $var) {
            $con = $var['content'];
            $e_id = $var['element_id'];
            $id = $var['id'];
        }

        if (Admincontrols::isloggedin($bool = true)) {
            //return this if admin is logged in
            return "
<div class='userui'>                
<div class='content'>
               
                    <img src=\"" . URL . "$con\" style=\"width: auto; height: auto; max-width: 100%; max-height: 100%;\">
           </div>
           
           
         
           
           <form method='post' action='" . URL . "edit/imagebrowser'>
           <fieldset style='border-style: none; display: inline;'>
                   <img src='" . URL . "private/images/image.png'>Change this Image
           <textarea style='visibility:hidden' name='content'>$con</textarea>
           <input type='hidden' name='e_id' value='$e_id' /> 
           <input type='hidden' name='id' value='$id' />
                   <input type='hidden' name='return' value='' />
                   <script type=\"text/javascript\">
$(\"[name=return]\").val(document.URL);
</script>
           <input style='' guini='buttonui' type='submit' value='Change This Image' />
           </fieldset>
           </form>
    </div>";
        } else {
            //return this if admin is logged in

            return "<div class='content'>
               
                  <img src=\"" . URL . "$con\" style=\"width: auto; height: auto; max-width: 100%; max-height: 100%;\">
    </div>";
        }
    }

}

?>