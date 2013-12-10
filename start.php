<?php
require "config/database.php";
require "config/paths.php";
require "libs/autoload.php";

$_sub = $_POST['submit'];

if (isset($_sub)) {

    $start = new gettingStarted();

//    echo 1;
  $log = $start->userDatabaseExists();
}
?>
<!DOCTYPE html>

<html>
    <head>

        <title>
            Welcome To Guini
        </title>

    </head>
    <body>
        <h1>
            Welcome To Guini
        </h1>
        <p>Before you start, you should create a database and a user with full permissions. After doing so, go to the config/database.php file and update the information.
            Not doing so will cause Guini to encounter errors.</p>
        <p>
            Once you have created the user click run to install Guini Database system.
        </p>
        <form action="#" method="post">


            <input type="submit" value="run" name="submit" />

            <?php
            echo $log;
            ?>
            
            
            
            

        </form>


    </body>


</html>