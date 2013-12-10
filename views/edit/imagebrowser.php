<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script type="text/javascript">



//    $(document).ready(function(){
//       
//        $(".thumb").each(function (){
//            $(this).parent().hide();
//            $(this).bind("load", function () {
//                $(this).parent().fadeIn();
//               
//                  
//        }
//        );
//        });
//        
//        
//        
//        
//        
//    });
    
    
  


        

</script>

    <div class="guinititle">
    <img style="display: inline; box-shadow: none;" src="<?php echo URL?>private/images/image.png" /> 
    Please select an image to set by clicking the 'Use This Image' button.
    </div>
<div class="section">
    <form action="<?php echo URL?>edit/imagebrowser" method="post">
        Browse By Categories:  <input type="hidden" name="id" value="<?php echo $_POST['id'];?>"/>
        <select name="cat">
            <option value="ALL" >All</option>
            <?php
                foreach($this->cats as $c){
                    $selected="";
                    if($_POST['cat'] == $c['cat']){
                        $selected = "selected='selected'";
                    }
                    echo "<option $selected value='".$c['cat']."'>".$c['cat']."</option>";
                    
                }
            ?>
        </select>
        <input type="hidden" name="littleboxid" />
        <input name="return" value="<?php echo $_POST['return']; ?>" type="hidden">
        <input type="submit" value="go">
        
    </form>
</div>


<div class="section">
    <?php
    foreach ($this->images as $var) {
        ?>
        <div class="image">
            <img src="<?php echo URL . $var['thumb'] ?>" onerror='this.onerror = null; this.src="<?php echo URL ?>"images/error.png"' class="thumb">
            <br />
            <form method="post" action="<?php echo URL ?>edit/guiniUpdate">
                <input type="hidden" name="editor" value="images/<?php echo $var['url'] ?>"/>
                <input type="hidden" name="id" value="<?php echo $_POST['id'];?>"/>
                <input name="return" value="<?php echo $_POST['return']; ?>" type="hidden">
                <input type="submit" guini="buttonui" value="Use This Image">
            </form>

        </div>


        <?php
    }
    ?>



</div >
<div style='text-align: right; padding: 20px;'>
 <input type="button" guini="buttonui" onclick="window.open('<?php echo $_POST['return']?>', '_self');"  value="Cancle" />
</div>