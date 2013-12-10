<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        echo $AL->autoIncludeCSS3fonts('public/fonts/');
        echo $AL->loadPublic();
        echo $AL->checkIfAutoExists($name);
        if (Session::get('loggedIn') == true) {
            //load all files in private
            echo $AL->loadPrivate();
        }
        ?> 
    </head>
    <body style="background-color: black; background-image: none;">
        <div class="guinimain">
