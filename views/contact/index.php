<!-- <div edit=true type=image id=image3 littlebox=231121863902 style="width: inherit; opacity: 0.5;filter:alpha(opacity=40);">
            <?php // echo $get_littlebox->image_for(231121863902, WEB_ID); ?>
        </div>-->
        <div style="position: relative; margin-top: 10px;margin-bottom: 10px;">
          
           
            <div id="contactterms" littlebox=6 edit='true'>
                <?php echo $get_littlebox->content_for(6, WEB_ID, true); ?>

            </div>
            <br>
            <h3>Email:</h3>
            <br>
            <div littlebox=2 edit='true' id="emailInfo"> <?php echo $get_littlebox->content_for(2, WEB_ID, true); ?></div>
            <br>

            <h3>Phone:</h3>
            <div littlebox=3 edit='true' id="phoneNumber"> <?php echo $get_littlebox->content_for(3, WEB_ID, true); ?></div>
            <br> 
            <h3>Fax:</h3>
            <div littlebox=5 edit='true' id="faxNumber"> <?php echo $get_littlebox->content_for(5, WEB_ID, true); ?></div>

        </div>

        <div id="contactMe1" type="emailMe" edit='true' addonid='112233'>
            <?php echo $_emailMe->self_simple_ui('contact', '112233'); ?>
        </div>