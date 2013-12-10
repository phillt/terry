
<?php
 Admincontrols::plusButton('delete', "Remove this post.", " (confirm('You are about to delete this post, an action that cannot be undone. click ok to continue, cancle to cancle.') == true) ? window.open('".URL."news/removepost/".$this->postid."', '_self') : false;", "-");
    
?>
<table>
    <tbody>
        <tr>
            <td style="max-width: 680px">
                
                <div class="section">
                <?php
                echo "<div class='event_title'>" . $this->content['title'] . "</div>";
                echo "<div class='place'>" . date('M d Y', strtotime($this->content['date'])) . "</div>";
                ?>
                </div>
                <div class="section">
                    <?php
                echo $this->content['cont'];
                ?>
                </div>
                
                <div class="section">
                    <?php
                                  $this->fb->TotalSocial($this->position, $width = 650);
                    ?>
                </div>
                
            </td>
      
            <td style="width: 250px; border-left: solid rgb(200, 200, 200) 1px; ">
                
                <div class="section" style="width: auto;">
                    <h2>Follow Terry</h2>
                    
                    <?php
                    $this->fb->FollowIcons();
                    ?>
                    
                </div>
                
                
            </td>
        </tr>



    </tbody>
</table>
