<script type="text/javascript">
  $(document).ready(function (){
    
        $("#addcat").click(function(){
            var newCat = prompt('What should the new category be called?', 'new category');
            alert(newCat);
            if (newCat != "" && newCat != " " && newCat != null){
                
                $('#cateogries option:selected').removeAttr('selected');
               $("#cateogries").append("<option selected='selected' value=\""+newCat+"\">"+newCat+"</option>");
            }
            else{
                alert("Please select a valid name.");
            }
        });
        
            $('#title').focus();
        
        
    });
    </script>
<form method="post" id="submitnewpost" action="<?php echo URL ?>news/submitpost">
    <fieldset style="border: none">
        <table>
            <tbody>
                <tr>
                    <td class="title"><lable for="title">Title</lable></td><td class="input"><input type="text" name="title" class="required" minlength="2" maxlength="200" id="title"/>
            <inpu type="hidden" value="<?php echo WEB_ID ?>">
                </td>
                </tr>
                <tr>
                    <td class="title"><lable for="cat">Cateogry</lable></td><td>
                <select name="cat" id="cateogries">
                    <?php
                    foreach($this->categories as $var){
                        echo "<option value='".$var['cat']."'>".$var['cat']."</option>";
                    } 
                    
                    ?>
                    <option value="0">Undefined</option>
                </select><input type="button" value="+" id="addcat">
            </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <script type="text/javascript" charset="utf-8">
                            $(document).ready(function() {
          
                                elRTE.prototype.options.panels.web2pyPanel = [
                                    'bold', 'italic', 'underline', 'justifyleft', 'justifyright',
                                    'justifycenter', 'justifyfull', 'formatblock', 'insertorderedlist', 'insertunorderedlist',
                                    'link', 'image'
                                ];
                                elRTE.prototype.options.toolbars.web2pyToolbar = ['web2pyPanel', 'tables'];
          
          
                                var opts = {
                                    lang         : 'en',   // set your language
                                    styleWithCSS : false,
                                    height       : 400,
                                    width        : 850,
                                    toolbar      : 'web2pyToolbar'
                                };
                                // create editor
                                $('#editor').elrte(opts);
                                $("textarea").addClass('required');
        
    
                                $("#submitnewpost").validate();
                                // or this way
                                // var editor = new elRTE(document.getElementById('our-element'), opts);
                            });
                        </script>
                        <div id="editor">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;"><input type="button" value="Cancel" guini="buttonui" onclick="window.open('<?php echo URL ?>', '_self')"/><input type="submit" guini="buttonui"/></td>
                </tr>
                </tbody>
        </table>
    </fieldset>
</form>