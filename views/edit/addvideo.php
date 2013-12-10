<script type="text/javascript">
    
    $(document).ready(function (){
        $('#submitbutton').hide();
        //        $("#videolink").jqTransform();
          
        $('#videourl').change(function (){
            
            var uri = $(this).val();
            
            uri = getParameterByName('v',uri);
                
            if(!uri){
                //not valid
                alert("I'm sorry, but the URL you provided is not valid. Please try again.");
                $('#submitbutton').hide();
                    
            }
            else{
                $('#videoupload').attr('src', 'http://www.youtube.com/embed/'+uri+'?rel=0');
                $("#viduri").val(uri);
                $('#submitbutton').show();
            }
            
            
              
        });
          
          
        $("#videoupload").load(function (){
              
            $(this).fadeIn('slow');
              
        });
              
              
        $("#addcat").click(function(){
            var newCat = prompt('What should the new album be called?', 'new album');
            
            if (newCat != "" || newCat != " "){
                
                $('#cateogries option:selected').removeAttr('selected');
                $("#cateogries").append("<option selected='selected' value=\""+newCat+"\">"+newCat+"</option>");
                //               $("#videolink").jqTransform();
            }
            else{
                alert("Please select a valid name.");
            }
        });
          
          
        
    });
  
  
    //replace name with URI
    function getParameterByName(name, url)
    {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(url);
        if(results == null)
            return false;
        else
            return decodeURIComponent(results[1].replace(/\+/g, " "));
    }

</script>

<div class="guinititle">
   <img style="display: inline; box-shadow: none;" src="<?php echo URL?>private/images/youtube.png" /> Link a YouTube Video
</div> 





<form id="videolink" class="jqtransform" method="post" action="<?PHP echo URL ?>edit/linkvideo">
    <div style="width: 700px; display: block; margin: auto;">

        <table >
            <tr>
                <td colspan="2">
                    <iframe id="videoupload" width="640" height="480" src="" frameborder="0" allowfullscreen style="display:none;"></iframe>



                </td>

            </tr>
            <tr>
                <td><lable for="videolink">Video Link </lable></td>
            <td><input name="videolink" type="text" id="videourl"/>
            <input type="hidden" name="vurl" id="viduri"/></td>
            </tr>

            <tr>
                <td><lable for="name">Video Name </lable></td>
            <td><input name="name" type="text" id="viduri"/> </td>
            </tr>

            <tr>

                <td>
            <lable for="cats">Video Category</lable>
            </td>
            <td>
                <select name="cats" id="cateogries">
                    <option value="No Category">No Category</option>
                    <?php 
                        foreach($this->vcats as $vr){
                            ?>
                    <option value="<?php echo $vr['cat']?>"><?php echo $vr['cat']?></option>
                    <?php
                        }
                    ?>
                    
                </select>
                <input guini="buttonui" type="button" id="addcat" value="+"/>
            </td>
            </tr>

            <tr>
                <td><lable for="disc">Type a Description</lable></td>
            <td>
                <textarea name="disc"></textarea>
            </td>
            </tr>

            <tr>
                <td colspan="2"><input guini="buttonui" type="button" id="addcat" value="Cancel" onclick="window.open('<?php echo URL ?>', '_self')"/><input id="submitbutton" type="submit" value="Save Video"/></td>
            </tr>

        </table>


    </div>








</form>