
<table id="content">
    <tbody>
        <tr>
            <td>
                <?php 
                    Admincontrols::plusButton('news','Add a new story.', "window.open('".URL."news/addnews', 'slef')");
                ?>
                <?php
                $stream = $this->stream;

// print_r($stream);
                if(count($stream) > 0){
                
                foreach ($stream as $var) {

                    echo "<div class='section'>";

                    echo "<div class='event_title'>
                                    <a href='" . URL . "news/post/" . $var['id'] . "'>";
                    echo $var['Title'];
                    echo "</a></div>";

                    echo "<div class='place'>";
                    echo date('M d Y', strtotime($var['date']));
                    echo "</div>";
                    echo "<div class='content'>";


                    echo substr(convert_html_to_text($var['Content']), 0, 600) . "... 
                                        
<a href='" . URL . "news/post/" . $var['id'] . "'>Continue reading</a>";
                    echo "</div>";
                    echo "</div>";
                }
                }
                else{?>
                
                <div class="section">
                    <div class='event_title'>
                        There are no news articles available at this time.
                    </div>
                    
                </div>
                <?php
                    
                }
                    
                
                ?>

            </td>
            <td>
                <div class="section">
                <iframe src="http://widgets.itunes.apple.com/itunes.html?wtype=2&app_id=526876292&country=us&partnerId=0&affiliate_id=0&wh=370" frameborder=0 style="overflow-x:hidden;overflow-y:hidden;width:250px;height:370px;border:0px" ></iframe>
                </div>
                <div class="section">
                <iframe src="http://widgets.itunes.apple.com/itunes.html?wtype=2&app_id=485081112&country=us&partnerId=0&affiliate_id=0&wh=370" frameborder=0 style="overflow-x:hidden;overflow-y:hidden;width:250px;height:370px;border:0px" ></iframe>
                </div>
                </td>
        </tr>

    </tbody>  
</table>


