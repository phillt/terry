<script type="text/javascript">
    
$(document).ready(function (){
    
    $(window).scrollTop(500);
});
</script>

<div class="section">
   <h2><?php
echo $this->title;
        echo " / ";
        echo $this->cat;
        ?></h2>
            <div class="boxshadow"><?php
    echo $this->album;
        
    Admincontrols::plusButton('delete', "Remove this image.", " (confirm('You are about to delete this image, an action that cannot be undone. click ok to continue, cancle to cancle.') == true) ? window.open('".URL."edit/removeimage/".$this->photoid."', '_self') : false;", "-")
    ?>

            </div>
</div>
<?php
 $this->fb->TotalSocial($this->position, $width = 850)
?>