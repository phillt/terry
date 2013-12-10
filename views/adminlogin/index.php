

<script type="text/javascript">
    $(document).ready(function(){
        
        $("#loginsubmit").button();
        $("#user").focus();
    });
    
    
</script>

<div id="guini_welcome">
    <div class="section">
        <img id="guinilog" src="<?php echo URL; ?>private/images/GuiniWord.png" style="box-shadow: none;">   
        <br />
            Welcome to your webiste editor, please login to continue.
    </div>
    <form method="post" action="<?php echo URL ?>Adminlogin/login"> 
        <lable>Login</lable><input type="text" name="user" id="user"/>
        <lable>Password</lable><input type="password" name="pswrd" />
        <input id="loginsubmit" type="submit" value="login"><br /><div style="color: rgb(200,200, 200); font-size: 15px; text-align: center;">
            <?php
            if(!isset($_COOKIE['admin']) || $_COOKIE['admin'] == ''){?>
        Remember this computer as an admin computer <div style="display: inline;cursor: pointer;" onclick="alert('By selecting this option, your website will remember this computer and present the login option on the menu bar when you are not logged in.')">[?]</div>
        <input type="checkbox" name="remember" style="width: 20px;"/> 
        <?php
        
        }
        else{
            ?>
              Un-check  to forget this computer as an admin computer. <div style="display: inline;cursor: pointer;" onclick="alert('This computer is currently rememberd as an admin computer, making the login link on the menu bar visible for easy access. Uncheck this box to forget this computer as admin computer.')">[?]</div>
        <input type="checkbox" name="remember" checked="checked" style="width: 20px;"/>
        <?php
        }
        ?>
         </div>  
    </form>

</div>