
<?php

Admincontrols::plusButton('video', 'Link a video to your website.', 'window.open("' . URL . 'edit/addvideo", "_self")');
?>



<?php

$template = '<div class="videoLink" onclick="window.open(\'' . URL . 'videos/watch/video_url\', \'_self\')">
                    <img class="vidthumb" src="http://img.youtube.com/vi/video_url/0.jpg">
                   <br /> v_name
                </div>';

echo $tmp->returnTemplate(WEB_ID, $template, "v_name:video_name,video_url:video_url,v_disc:video_disc");
?>