

            
            <div class="guinititle">Editor</div>
            
            <form method="post" id="submitnewpost" action="<?php echo URL ?>edit/guiniUpdate">
                <fieldset style="border: none">
                    <table>
                        <tbody>

                           <input type="hidden" value="<?php echo $_POST['id'] ?>" name="id" />
                        <tr>
                            <td colspan="2">
                                <script type="text/javascript" charset="utf-8">
                                    $(document).ready(function() {
                                        $("#savechanges").button();
          
                                        elRTE.prototype.options.panels.web2pyPanel = [
                                            'undo','redo', 'bold', 'italic', 'underline', 'justifyleft', 'justifyright',
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
                                    <?php
                                    echo $_POST['content'];
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" value="<?php echo $_POST['return']?>" name="return" />
                            </td>
                            <td style="text-align: right;"><input guini="buttonui" type="button" value="Cancel" onclick="window.open('<?php echo $_POST['return']; ?>', '_self')"> <input type="submit" id="savechanges" value="Save Changes" style="right: 0px;" /></td>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>
            </form>
      