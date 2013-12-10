

       

<table id="content">
    <tbody >
        <tr>
            <td width="600px">
                
                
                <?php
                
                Admincontrols::plusButton("event", "Create a new event", "window.open('".URL."edit/addevent', '_self')");
                
                if(count($this->events) > 0){
                foreach($this->events as $ev){
                    
                    if(Admincontrols::isloggedin(TRUE)){
                        ?>
                        <div class='userui'>
                    <?php
                            }
                    
                    ?>
                    
                
                
                <div class="section">
                <div class="event_title">
                    <?php echo $ev['title'] ?>
                     </div>
                    <div class="place">
                        <?php
                                            
                                            if ($ev['date'] == $ev['end_date'] || $ev['end_date'] == null)
                                            {
                                            echo 'On ' . date('M d, Y', strtotime($ev['date']));
                                            }else{
                                                echo 'From ' .date('M d, Y', strtotime($ev['date'])) . '<br />
                                                    To ' .date('M d, Y', strtotime($ev['end_date']));
                                            }
                                            ?>
                    </div>
                    <div class="place">
                        <?php echo $ev['location']; ?>
                    </div>
                    <div class="content">
                        <?php echo $ev['disc']; ?>
                    </div>
               
                </div>
                    <?php
                      if(Admincontrols::isloggedin(TRUE)){
                        ?>
                            <div>
                                        <form method="post" action="<?php echo URL ?>edit/removeEvent">
                                <input type="hidden" name="eid" value="<?php echo $ev['event_id'] ?>"/>
                                <img src="<?php echo URL ?>private/images/bullet_delete.png">
                                <input type="submit" guini="buttonui" value="Delete This Event" />
                            </form>
                            </div>
                            
                        </div>
                <?php
                    }
                    
                }}
                else{
                                ?>
                        <div class="event_title">
                            There are currently no tour dates scheduled at this time.
                        </div>
                                <?php
                                
                            }
                
                ?>
            </td>
            <td width="250px">
                <div class="section">
                 <?php echo $this->Guini->displayLittleBoxImage("5026efe9566b7"); ?>
                </div>
                
                <div class="section">
                    <h3>Links</h3>
                     <?php echo $this->Guini->displayLittleBox("5026ebb738b69"); ?>
                    
                    
                </div>
                
            </td>
        </tr>
    </tbody>
    
</table>


                
          
      