<?php
//LittleBox PHP object



//connects to database
function read_database(){
      $con = mysql_connect("","phillly_reader","rare!dog32");//connect to mysql
    if (!$con){
        return false;
    }
    return $con;
        
}

class Get_littlebox
{
    
    function content_for($element_id, $web_id, $decode = false){
    //check if there is a littlebox
    $con = read_database();
    
    if (!$con){
        return "error retrieving content, please refresh page.";
    }
    if(is_numeric($web_id) == true){ 
    
    $query = "SELECT content FROM littleBoxes WHERE web_id = $web_id AND element_id= $element_id";
    mysql_select_db("phillly_controls", $con);
    $q_exe = mysql_query("SELECT content FROM littleBoxes WHERE web_id = $web_id AND element_id='". mysql_real_escape_string($element_id)."'");
    if(mysql_num_rows($q_exe)){
//if there is a littlebox, return content
             while ($row = mysql_fetch_array($q_exe)){
                switch ($decode){
                    case true:
                         return html_entity_decode($row['content']);
                        break;
                    case false:
                         return $row['content'];
                        break;
                    case 'img':
                             return $row['content'];
                        break;
                    default:
                        return html_entity_decode($row['content']);
                    
                    
                }
              
                //by default it decodes the content
                return $row['content'];
                
             }
        }
        else{
              $con = mysql_connect("","phillly","phill3624");//connect to mysql
    if (!$con){
        return "Error connecting to database: " . mysql_error();
    }
    
        if ($decode == 'img'){
            $defaultText = 'http://www.philllware.com/basicBacks/image_add.png';
        }
        else{
            $defaultText =  'Double Click To Edit';
        }
        $element_id = (string)$element_id;
        
                mysql_select_db("phillly_controls", $con);
                
                $create = mysql_query("INSERT INTO littleBoxes (web_id, element_id, content)
VALUES ($web_id,'". mysql_real_escape_string($element_id) ."', '".mysql_real_escape_string($defaultText)."')");
    //if there isn't then make one and return default content.
    if ($create){

            if ($decode == 'img'){
            return 'http://www.philllware.com/basicBacks/image_add.png';
        }
        else{
            return  'Double Click To Edit';
        }
    }
    else{
    return "An error has occured: ". mysql_error();
    }
        
                
        
        
        }
    
    }
    else{
        return "Improper format, please make sure id and web are in numeric format.";
    }
    
    
    
    }
    
    function image_for($element_id, $web_id){
        //returns an image for the selected littlebox
        $imgsrc = $this->content_for($element_id, $web_id, 'img');
        return "<img src='$imgsrc' style='width: auto; height: auto; max-width: 100%; max-height: 100%;'>";
    }
    
    
    
    
    
}

?>