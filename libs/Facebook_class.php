<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Facebook_class {

    public function FollowIcons() {
        $social = "<div class='social'>

";

        if (FBPAGE) {
            $social .= "<a href='" . FBPAGE . "' target='_blank'><img class='socialicons' src=\"" . URL . "private/images/facebook.png\" /></a>";
        }
        if (TWTPAGE) {
            $social .= "<a href='" . TWTPAGE . "' target='_blank'><img class='socialicons' src=\"" . URL . "private/images/twitter.png\" /></a>";
        }
        if (YTPAGE) {
            $social .= "<a href='" . YTPAGE . "' target='_blank'><img class='socialicons' src=\"" . URL . "private/images/youtube.png\"  /></a>";
        }

        echo $social . "</div>";
    }

    public function TotalSocial($ext = URL, $width = 611) {
        echo "<div class='social'><script type=\"text/javascript\" src=\"http://platform.tumblr.com/v1/share.js\"></script>
            <div class='social_title'>Share</div>
<div class='section'>            
<table>
                <tbody>
                    <tr>
                        <td>";
        $this->FBLike($ext);

        echo "</td>
                        <td>";

        $this->TwitterButton($ext, 'Check this out!');

        echo "</td><td><a href=\"http://www.tumblr.com/share\" title=\"Share on Tumblr\" style=\"display:inline-block; text-indent:-9999px; overflow:hidden; width:129px; height:20px; background:url('http://platform.tumblr.com/v1/share_3.png') top left no-repeat transparent;\">Share on Tumblr</a></td>
                   
<td>
<!-- Place this tag where you want the +1 button to render. -->
<div class=\"g-plusone\" data-annotation=\"inline\" data-width=\"120\"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type=\"text/javascript\">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</td>
</tr>
                </tbody>
            </table></div>";


        $this->FBComments($ext, $width);

        echo "</div>";
    }

    public function FBComments($ext = URL, $width = 611) {
       // $ext = str_replace("http://www.", "", $ext);

        echo '<div class="fb-comments" data-href="' . $ext . '" data-num-posts="6" data-width="' . $width . '" style="margin: auto; position: relative; width: auto;"></div>';
    }

    public function FBLike($ext = URL) {
       // $ext = str_replace("http://www.", "", $ext);
        echo '<div class="fb-like" data-href="' . $ext . '" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>';
    }

    public function TwitterButton($ext = URL, $message = 'Check out this website!') {
        echo '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $ext . '" data-text="' . $message . '">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
    }

    public static function metaTags($pt = array()) {

        $pz = array(
            "url" => URL,
            "site_name" => SITE_NAME,
            "description" => DEFAULT_DISC,
            "title" => TITLE,
            "type" => TYPE,
            "image" => array(0 => DEFAULT_IMAGE)
        );




        $p = array_merge((array) $pz, (array) $pt);


        // ."<meta property=\"fb:app_id\" content=\"".APP_ID."\" />\n"
        $stack = "<meta property=\"fb:admins\" content=\"" . ADMIN . "\" />\n";
        // $stack = "";
        foreach ($p as $key => $img) {


            if ($key == 'image') {
                foreach ($img as $pic)
                //    $pic = str_replace("http://www.", "", $pic);

                $stack .= "<meta property=\"og:$key\" content=\"$pic\" />\n";
            } else {
             //   $img = str_replace("http://www.", "", $img);

                $stack .= "<meta property=\"og:$key\" content=\"$img\" />\n";
            }
        }

        return $stack;
    }

    public static function fbJavaScriptSDK() {
        return "<div id=\"fb-root\"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '" . APP_ID . "', // App ID
      channelUrl : '" . URL . "/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = \"//connect.facebook.net/en_US/all.js\";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>";
    }

}

//$p = array("site_name" => SITE_NAME,"disc" => DEFAULT_DISC,"title" => TITLE,"type" => TYPE,"url" => URL,"image" => array(URL.DEFAULT_IMAGE))
?>