<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


?>
<script type="text/javascript">
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#"+id).attr('src', e.target.result);
                
          
            }

            reader.readAsDataURL(input.files[0]);
            
            //checks for doubles
            
            
        }
    }
        count = 0;
    function addImage(){
    count++;
    
    $("#imagebox").append("<div class=\"imagestoupload\"> <img id=\"blah"+count+"\" src=\"<?php echo URL; ?>private/images/placeholder.jpg\" alt=\"your image\" style=\"max-width: 100px; max-height: 100px;\"/><br /><textarea style=\"resize:none;width: 150px; height: 50px\" name=\"disc[]\">Say something about this image.</textarea><input guini='buttonui' type=\"file\" name=\"image[]\" onchange=\"readURL(this, 'blah" + count + "')\" ></div>")
    
    }
    
    $(document).ready(function (){
    
        $("#addcat").click(function(){
            var newCat = prompt('What should the new album be called?', 'new album');
            
            if (newCat != "" || newCat != " "){
                
                $('#cateogries option:selected').removeAttr('selected');
               $("#cateogries").append("<option selected='selected' value=\""+newCat+"\">"+newCat+"</option>");
            }
            else{
                alert("Please select a valid name.");
            }
        });
        
    });
    
    
    
    
        
</script>

<form enctype="multipart/form-data" id="imageupoad" method="post" name="Submit" action="<?php echo URL; ?>edit/uploadimage">
    <fieldset style="border: none;">

        <h2>Upload Image(s)</h2>
        <div class="section">
        <lable>To Album: </lable>
        <select name="cat" id="cateogries">
            <?php
            
            foreach ($this->cat as $cat){
                
                echo "<option value=\"".$cat['cat']."\">".$cat['cat']."</option>";
            }
            
            
            ?>
        </select>
        <input type="button" value="+" id="addcat" guini="buttonui"/>
        
        </div>

        <div class="section">

        <div id="imagebox">
        
        <div class="imagestoupload">
            <img id="blah0" src="<?php echo URL; ?>private/images/placeholder.jpg" alt="your image" style="max-width: 100px; max-height: 100px;"/><br />
            <textarea name="disc[]" style="width: 150px; height: 50px;resize: none">Say something about this image.</textarea>
            <input type="file" name="image[]" onchange="readURL(this, 'blah0')" />
            
        </div>
            
            
        </div>
       



           
            
            
        
        </div>

         <input type="button" value="+" guini="buttonui" onclick="addImage()"><input type="submit" guini="buttonui" value="Upload" name="Submit"/>

    </fieldset>


</form>