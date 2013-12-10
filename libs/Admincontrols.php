 <?php
class Admincontrols {

    public static function returnImage($type) {
        $images = array(
        "news" => URL. "private/images/news.png",
        "event" => URL. "private/images/calendar_view_month.png",
        "image" => URL. "private/images/image.png",
        "video" => URL. "private/images/youtube.png",
        "delete" => URL. "private/images/bullet_delete.png"
        );

        return $images[$type];
    }

    public static function plusButton($type, $message,$action = "", $button = "+") {
        if (Session::get('loggedIn')) {

            $id = uniqid() . $type;
            ?>

            <script type="text/javascript">
                                    
                $(document).ready(function(){
                    $("[id=<?php echo $id ?>]").button();
                    $("[id=<?php echo $id ?>]").click(function (){
                                            
            <?php
            echo $action;
            ?>
                               });
                           });
            </script>
            <div class="userui">


                <img src="<?php
            echo Admincontrols::returnImage($type);
            ?>">

            <?php echo $message ?>

                <input type="button" class="addbutton" id="<?php echo $id ?>" value="<?php echo $button; ?>" />


            </div>

        <?php
        }
    }
    
    public static function isloggedin($bool = false){
        $loggedin = Session::get('loggedIn');
        
        if(!$bool){
            if ($loggedin == false){
                Session::destroy();
                        header("Location: ".URL);
                        exit;
         }
        }
        else{
            return $loggedin;
            
        }
        
    }
 
}
?>
