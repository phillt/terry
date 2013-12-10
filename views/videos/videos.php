




<div class="section">
    <table>
        <tbody>
        <td  style="border-right: solid thin #C8C8C8;">
            <div class="section">


                <?php
                echo $this->feature;
                ?>

            </div>
           

            <?php
            $this->fb->TotalSocial($this->position, 615);
            ?>
        </td>

        <td>
            <div id="videoplist" >
                <h2 style="text-align: center;">More Videos</h2>

                <?php
                $template = '<div class="videoLink" onclick="window.open(\'' . URL . 'videos/watch/video_url\', \'_self\')">
                    <img class="vidthumb" src="http://img.youtube.com/vi/video_url/0.jpg">
                    <div class="vname">v_name</div>
                </div>';

                echo $tmp->returnTemplate(WEB_ID, $template, "v_name:video_name,video_url:video_url,v_disc:video_disc");
                ?>

            </div>

        </td>

        </tbody>
    </table>


</div>
