<?php

class Video_Upload{
    //submitVideoEntry
    function newVideoEntry($videURL, $vname, $disc, $cats){
    $con = write_database_();
    if (!$con){
        return "error ".mysql_error();
    }
   
    if (!isset($_COOKIE["web_id"]) || $_COOKIE["web_id"] == "" || $_COOKIE["web_id"] == " ") 
    return "Not logged in";
       mysql_select_db("phillly_controls", $con);
      $query = mysql_query("INSERT INTO video_library
VALUES ('".uniqid()."', '".mysql_real_escape_string($_COOKIE["web_id"])."','".mysql_real_escape_string($videURL)."', '".mysql_real_escape_string($vname)."', '".mysql_real_escape_string($disc)."', 'YouTube', '".mysql_real_escape_string($cats)."', 'none')");
       
       if(!$query){
        return "error " .mysql_error();
        }
        else{
            return "Success"; 
        }
        
   
    
    }
    
    
    function return_videos($web_id){

                $list = "";
                    $con = read_database_();
                    if (!$con)
                      {
                      return $list . "<li>ERROR</li></ul>";
                      }
                    
                    mysql_select_db("phillly_controls", $con);
                    
                    $result = mysql_query("SELECT * FROM video_library WHERE web_id='". mysql_real_escape_string($web_id)."'");
                    $list_items = "";
                    while($row = mysql_fetch_array($result))
                      {
                              $list_items = $list_items. "<li cat=\"".$row['category']."\" vidurl=\"".$row["video_url"]."\" videoid=\"".$row["id"]."\" onclick=\"$('#embededFrame').attr('src', 'http://www.youtube.com/embed/".$row["video_url"]."')\">". $row['video_name']. "</li>";
                      }
                  
                    return $list.$list_items;
    }
    
    function video_embed($web_id, $w=420, $h=315){
          $con = read_database_();
                    if (!$con)
                      {
                      return $list . "<li>ERROR</li></ul>";
                      }
                    
                    mysql_select_db("phillly_controls", $con);
                    
                    $result = mysql_query("SELECT video_url FROM video_library WHERE web_id='". mysql_real_escape_string($web_id)."' LIMIT 1");
                    $vurl = "";
                     while($row = mysql_fetch_array($result))
                      {
                        $vurl = $row['video_url'];
                      }
        
        return '<iframe id="embededFrame" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'.$vurl.'" frameborder="0" allowfullscreen></iframe>';
    }
    
    function remove_video(){
        
    }
    
    function return_options_categories($web_id){
     
     $con = write_database_();
    if (!$con){
        return "error ".mysql_error();
    }
   
       mysql_select_db("phillly_controls", $con);
      $query = mysql_query("SELECT DISTINCT category FROM video_library WHERE web_id='".mysql_real_escape_string($web_id)."'");
       
       if(!$query){
        return false;
        }
        else{
            $options = "";
            while($row = mysql_fetch_array($query))
                      {
                              $options = $options. "<option value='".$row['category']."'>".$row['category']."</option>";
                      }
                      return $options;
        }
        
    
        
    }
    
    function deleteVideo($vidid){
                    $con = write_database_();
                    if (!$con)
                      {
                      return false;
                      }
                    
                    mysql_select_db("phillly_controls", $con);
                    
                    $query = "DELETE FROM video_library
WHERE id='".mysql_real_escape_string($vidid)."' AND web_id='".mysql_real_escape_string($_COOKIE["web_id"])."'";
                    $result = mysql_query($query);
        if(!$result){
            return false;
        }
        else{
            return true;
        }
    }
    
    function returnTemplate($web_id, $template_string, $variable_pairs){
        
        $variable_pairs = explode(",", $variable_pairs);
        
        
        
        
         $con = read_database_();
                    if (!$con)
                      {
                      return false;
                      }
                      
          
                    mysql_select_db("phillly_controls", $con);
                    
                   $result = mysql_query("SELECT * FROM video_library WHERE web_id='".mysql_real_escape_string($web_id)."'");
                    //$result = mysql_query($query);
        
            $template_stack = "";
            
                       while($row = mysql_fetch_array($result))
                      {
                        $template = $template_string;
                        //loop through variable array
                        foreach ($variable_pairs as $a){
                            $vparis = explode(':', $a);
                            
                          $template = str_replace($vparis[0],$row[$vparis[1]], $template);
 
                        }
                        
                             $template_stack = $template_stack . $template;
                      }
            
        return $template_stack;
        
        
    }
}
?>
