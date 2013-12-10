
<div style="width: inherit; height: auto; text-align: center;">
    <?php echo $this->Guini->displayLittleBoxImage("50205a3fc74ab");
    ?>
</div>


<div class="section">
    <table id="tableColumns">
        <tbody>
            <tr>

                <th>
                    AlbumS
                </th>
                <th>
                    NewS
                </th>
                <th>
                    EventS
                </th>
            </tr>
            <tr>
                <td>

                    <ul>
                        <li>
                            <iframe src="http://widgets.itunes.apple.com/itunes.html?wtype=2&app_id=526876292&country=us&partnerId=0&affiliate_id=0&wh=370" style="border: none;overflow-x:hidden;overflow-y:hidden;width:250px;height:370px;border:0px" ></iframe>

                        </li>
                        <li>
                            <iframe src="http://widgets.itunes.apple.com/itunes.html?wtype=2&app_id=485081112&country=us&partnerId=0&affiliate_id=0&wh=370" style="border: none; overflow-x:hidden;overflow-y:hidden;width:250px;height:370px;border:0px" ></iframe>

                        </li>
                        <li style="text-align: center;">
                            <img src="http://www.terrybrownmusic.com/public/img/memberlogo_web_clr.gif" alt="Proud Member of The Americana Music Association" />
                        </li>
                        
                        <li>
                            <div style="text-align:center">Terry Is A Proud Member</div><div style="text-align:center">Of Western Music Association</div><div style="text-align:center"><br></div><div style="text-align:center"><a href="http://www.westernmusic.com/performers/performers-name-b.html" target="_blank"><img src="http://terrybrownmusic.com/public/images/wma.png"></a></div>  
                        </li>
                        <li style="text-align: center;">
                            <a href="http://www.wildhorsesanctuary.org/" target="_blank">
                                <img src="http://www.terrybrownmusic.com/public/img/WildHorseLogo.jpg" alt="Proud Member of The Americana Music Association" />
                            </a>
                        </li>
                        <li style="text-align: center;">
                            <a href="http://www.alamosahatworks.com/" target="_blank">
                                <img src="http://www.terrybrownmusic.com/public/img/hatworks.gif" alt="Proud Member of The Americana Music Association" />
                            </a>
                        </li>
                        
                    </ul>

 

                </td>


                <td>
                    <?php
                    Admincontrols::plusButton('news', 'Add a new story.', "window.open('" . URL . "news/addnews', '_self')");
                    ?>
                    <table>
                        <?php
                        require('models/news_model.php');

                        $news = new News_Model();

                        $stream = $news->getStream(5);

                        // print_r($stream);
                        if(count($stream) > 0){
                        
                        foreach ($stream as $var) {
                            echo "<tr>";
                            echo "<td><a href='" . URL . "news/post/" . $var['id'] . "'>";
                            echo "<div class='event_title'>";
                            echo $var['Title'];
                            echo "</div>";

                            echo "<div class='place'>";



                            echo date('M d Y', strtotime($var['date']));

                            echo "</div>";
                            echo "<div class='date'>";


                            echo (isset($var['Content']) AND $var['Content'] !== "")? substr(convert_html_to_text($var['Content']), 0, 50) . "... Click to read more.": "No Content";
                            echo "<div></a>";
                            echo "</td>";
                            echo "</tr>";






                            echo "</tr>";
                        }
                        }else{
                            ?>
                        
                        <div class="event_title">
                            There is no news available at this time.
                        </div>
                        <?php
                            
                        }
                        ?>


                    </table>




                </td>

                <td>

                    <?php
                    Admincontrols::plusButton("event", "Create a new event", "window.open('" . URL . "edit/addevent', '_self')");
                    include( 'models/tourdates_model.php');
                    $this->tourdates = new Tourdates_model();
                    ?>

                    <table>
                        <tbody>





                            <?php
                            $dates = $this->tourdates->returnTourDates();
                            
                            if (count($dates) > 0){
                            
                            foreach ($dates as $dt) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="event_title">
                                            <?php
                                            echo $dt['title'];
                                            ?>
                                        </div>

                                        <div class="sql_start_date:mysql_to_hrf">
                                            <?php
                                            
                                            if ($dt['date'] == $dt['end_date'] || $dt['end_date'] == null)
                                            {
                                            echo 'On ' . date('M d, Y', strtotime($dt['date']));
                                            }else{
                                                echo 'From ' .date('M d, Y', strtotime($dt['date'])) . '<br />
                                                    To ' .date('M d, Y', strtotime($dt['end_date']));
                                            }
                                            ?>
                                        </div>

                                        <div class="place">
                                            <?php
                                            echo $dt['location'];
                                            ?>
                                        </div>


                                    </td>
                                </tr>
                                <?php
                            }}else{
                                ?>
                        <div class="event_title">
                            There are currently no tour dates scheduled at this time.
                        </div>
                                <?php
                                
                            }
                            ?>


                        </tbody>
                    </table>


                </td>
            </tr>
        </tbody>
    </table>

</div>

<div style="text-align: right;">

<?php $this->fb->FollowIcons(); ?>
</div>

<!--<div edit='true' type='text' id='dailyMessage' littlebox='39'>
    <?php
//    echo $get_littlebox->content_for(39, WEB_ID, true);
    ?>
</div>-->