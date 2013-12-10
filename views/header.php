<?php Session::init(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta charset="UTF-8">
        <?php
        echo $this->metaTags;
        ?>

        <title>Terry Brown Music <?php
            $list = explode('/', $name);

            if ($list[0] != 'index')
                echo "| " . ucfirst($list[0]);
            ?></title>	



        <?php
//autoload external files for all.
        echo $AL->autoIncludeCSS3fonts('public/fonts/');
        echo $AL->loadPublic();
        echo $AL->checkIfAutoExists($name);
        if (Session::get('loggedIn') == true) {
            //load all files in private
            echo $AL->loadPrivate();
        }
        ?> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=335087329894506";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>


        <div id="menu" style="">

            <a href="<?php echo URL ?>" style="text-decoration: none; text-align: center;">
                <img src="<?php echo URL ?>public/images/terrylogoembed.png" id="log_inner_img" style="width: 200px;" alt="Terry Brown Official Logo">    
            </a>


            <hr />
            <div id="titleCSS">       
                <!--[if IE]><div id="Title"><![endif]-->
                Terry Brown Music
                <!--[if IE]></div><![endif]-->
            </div>
            <hr />

            <div class="side_to_side" id="brandedname">
                <ul id="menubar">
                    <li><a href="<?php echo URL ?>">Home</a></li>
                    <li><a href="<?php echo URL ?>about">About</a></li>
                    <li><a href="<?php echo URL ?>music">Music</a></li>
                    <li><a href="<?php echo URL ?>tourdates">Tour Dates</a></li>
                    <li><a href="<?php echo URL ?>photos">Photos</a></li>
                    <li><a href="<?php echo URL ?>videos">Videos</a></li>
                    <li><a href="<?php echo URL ?>news">News</a></li>
                    <?php if (Admincontrols::isloggedin(true) == TRUE) { ?>
                        <li><a href='<?php echo URL ?>adminlogin/logout'>Logout</a></li>
                        <?php
                    } else {
                        if (isset($_COOKIE['admin']) && $_COOKIE['admin'] == true) {
                            ?>
                            <li><a href='<?php echo URL ?>adminlogin'>Login</a></li>
                            <?php
                        }
                    }
                    ?>



                </ul></div>



        </div>




        <div id="main">


            <div id="bodmain">
                <?php
                switch ($list[0]) {
                    case "index":

                        break;
                    case "tourdates":
                        ?>
                        <h1>Tour Dates</h1>
                        <?php
                        break;
                    default:
                        ?>
                        <h1>
                            <?php
                            echo ucfirst($list[0]);
                            ?>
                        </h1><?php
                        break;
                }
                ?>






