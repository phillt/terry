<?php
//user info library 1.0
/*
--------------------------------------------------------------------------------------------------------------------------------|
| $get_user->logged_in();                          | (no arguments)    | Checks if user is logged in.         | boolian true false |
|---------------------------------------------------------------------------------------------------------------------------    |
|$get_user->get_info($dataType, $individual)     | $dataType type of data to return                         returns false      |
|                                                 |         'xml'  returns the data in xml fromat                  on fail      |
|                                                 |         'string' returns data in a string.                                  |          
                                                  | $individual
                                                            '*' returns all the data in array or xml string.
                                                            'first' returns logged in user's first name.
                                                            'last' returns logged in user's lat name.
                                                            'email' returns logged in user's email.
                                                            'website_name' returns the name of the website.
                                                            'website_motto' returns the motto of the website.
                                                                
                                                            
| has_permission_to_edit()           | (No arguments)  | Returns boolian if user has permission to edit website and any of it's features.
                                                    should be used to to varify that user has permission.
| read_database_() |                    (No Arguments) | establishes a connection to a READ ONLY database and should be used when
                                                        App is accessing READ ONLY content for security reasons. returns the database
                                                        connection or a false on fail.
|write_database_() |                    (No arguments) | reads, inserts and updates databases. Should be used to update and insert any
                                                        add-on table.
*/

 function has_permission_to_edit($website_id=false){
     
    //check if user has permission to view
    $con = read_database_();
    if (!$con){
        return false;
    }
     
    //else continue
          
        
         if ($_COOKIE['usrid'] == undefined || $_COOKIE['usrid'] == null || $_COOKIE['usrid'] == "" || isset($_COOKIE['usrid']) == false){
        return true;//returns false if cookies are not declared
    }
   
     // checkForNumber_($_COOKIE['web_id']);
       // checkForNumber_($_COOKIE['usrid']);
       mysql_select_db("phillly_controls", $con);
       
        if(!$website_id)
       return false;
       else
         $query = "SELECT web_id FROM  website_spine WHERE admin_id ='" . mysql_real_escape_string((string)$_COOKIE['usrid'])."'";
            
           
            $result = mysql_query($query);
            if(mysql_num_rows($result)){
                  while($row = mysql_fetch_array($result))
                              {
                              if ($row['web_id'] == $website_id)
                              return false;
                              }
                              return false;
                
            }
            else{
                return false; //returns false if web id and website do not match (no permission)
            }
            
    
}

function read_database_(){
      $con = mysql_connect("","phillly_reader","rare!dog32");//connect to mysql
    if (!$con){
        return false;
    }
    return $con;
        
}

function write_database_(){
      $con = mysql_connect("","phillly","phill3624");//connect to mysql
    if (!$con){
        return false;
    }
    return $con;
        
}

function sercurity_one(){
    //check if user has permission to view
    $con = read_database_();
    if (!$con){
        return false;
    }
    
    //else continue
          
        
         if ($_COOKIE['usrid'] == undefined || $_COOKIE['usrid'] == null || $_COOKIE['usrid'] == " "){
        return false;//returns false if cookies are not declared
    }
   
      checkForNumber_($_COOKIE['web_id']);
        checkForNumber_($_COOKIE['usrid']);
        
        
            $query = "SELECT * FROM  website_spine WHERE admin_id =".$_COOKIE['usrid'] ." AND web_id =". $_COOKIE['web_id'];
           
            mysql_select_db("phillly_controls", $con);
            if(mysql_num_rows(mysql_query($query))){
                return true;//returns true if user has permission to view info.
            }
            else{
                return false; //returns false if web id and website do not match (no permission)
            }
            
    
}



   


function checkForNumber_($a){
    //will die if it isn't and send a message
    if (!is_numeric($a)){
    //send_security_notification($a);
    die();
 }
}

class get_user
{
    
 function has_permission_to_edit($website_id=false){
     
    //check if user has permission to view
    $con = read_database_();
    if (!$con){
        return false;
    }
    
    //else continue
          
        
         if ($_COOKIE['usrid'] == undefined || $_COOKIE['usrid'] == null || $_COOKIE['usrid'] == "" || isset($_COOKIE['usrid']) == false){
        return false;//returns false if cookies are not declared
    }
   
     // checkForNumber_($_COOKIE['web_id']);
       // checkForNumber_($_COOKIE['usrid']);
       mysql_select_db("phillly_controls", $con);
       
        if(!$website_id)
       return false;
       else
         $query = "SELECT web_id FROM  website_spine WHERE admin_id ='" . mysql_real_escape_string((string)$_COOKIE['usrid'])."'";
            
           
            $result = mysql_query($query);
            if(mysql_num_rows($result)){
                  while($row = mysql_fetch_array($result))
                              {
                              if ($row['web_id'] == $website_id)
                              return true;
                              }
                              return false;
                
            }
            else{
                return false; //returns false if web id and website do not match (no permission)
            }
            
    
}
    
    //check if user is logged in and checks for permission to use webiste
    function logged_in()
    {
        return sercurity_one();
    }
    
    
    
    //get basic info
    
    function get_info($dataType, $individual){
             
             if (!sercurity_one())
                return false;
    
        $con = read_database_();
        if (!$con)
        return false;
        
        mysql_select_db("phillly_controls", $con);
        
        $query = "SELECT website_spine.*, philllwareusers.usr
        FROM website_spine
        INNER JOIN philllwareusers
        ON website_spine.admin_id = philllwareusers.uid
        WHERE website_spine.web_id=".$_COOKIE['web_id']." AND website_spine.admin_id =" . $_COOKIE['usrid'];
        $result = mysql_query($query);
            
            while ($row = mysql_fetch_array($result)){
                $_first = $row['admin_first'];
                $_last = $row['admin_last'];
                $_email = $row['usr'];
                $_websiteName = $row['website_name'];
                $_websiteMotto = $row['website_motto'];
            }
 
            switch ($individual)
            {
                case '*':
                    if ($dataType == 'xml'){
                        return "<first>$_first</first>
                                <last>$_last</last>
                                <emial>$_email</email>
                                <websitename>$_websiteName</websitename>
                                <websitemotto>$_websiteMotto</websitemotto>";
                    }
                    else{
                        return array("first"=>$_first, "last"=>$_last, "email"=>$_email, "website_name"=>$_websiteName, "website_motto"=>$_websiteMotto);
                    }
                    break;
                case 'first':
                    if ($dataType == 'xml'){
                        return "<first>$_first</first>";
                    }
                    else{
                        return $_first;
                    }
                    break;
                case 'last':
                    if ($dataType = 'xml'){
                        return "<last>$_last</last>";
                    }
                    else
                        return $_last;
                    break;
                case 'email':
                    if ($dataType == 'xml'){
                        return "<emial>$_email</email>";
                    }
                    else
                    return $_email;
                    break;
                case 'website_name':
                    if ($dataType == 'xml'){
                        return "<websitename>$_websiteName</websitename>";
                    }
                    else{
                        return $_websiteName;
                    }
                    break;
                case 'website_motto':
                    if ($dataType == "xml"){
                        return "<websitemotto>$_websiteMotto</websitemotto>";
                    }
                    else
                        return $_webisteMotto;
                    break;
                default:
                    return false;
                break;
            }

        
        //
    }
    
    function get_images($dataType){
        
        if (!sercurity_one())
                return false;
    
        $con = read_database_();
        if (!$con)
        return false;
        
        mysql_select_db("phillly_controls", $con);
        
        $query = "SELECT * FROM clientimages WHERE web=" .$_COOKIE['web_id'];
        $result = mysql_query($query);
              
                if ($dataType == 'xml'){//if data type is xml
            $xml = "<images>";
            $_cat = "";
                            while ($_rows = mysql_fetch_array($result)){
                                $_cat = $_cat . "<pic cat=\"".$_rows['cat']."\">
                                        <url>http://www.philllware.com/gal/images/".$_rows['url']."</url>
                                        <thumb>http://www.philllware.com/gal/".$_rows['thumb']."</thumb>
                                        <tags>".$_rows['tags']."</tags>
                                        <secondcat>".$_rows['cat1']."</secondcat>
                                        </pic>";
                            }
                            
                    $xml = $xml . $_cat . "</images>";
                    
                    return $xml;
                }
                else{
                    // an array of all the user's images
                    $cnt = 0;
                      while ($row = mysql_fetch_array($result)){
                                $_pics[$cnt]= array(
                                                            "category" => $row['cat'],
                                                            "url" => "http://www.philllware.com/gal/images/".$row['url'],
                                                            "thumb" => "http://www.philllware.com/gal/". $row['thumb'],
                                                            "tags" => $row['tags'],
                                                            "secondCategory" => $row['cat1']
                                                         );
                                
                               $cnt++;
                            }
                            
                            return $_pics;
                    
                }
            
        
    }
    
    
}

function check_if_entry_exists($table, $column, $entry){
    $con = read_database_();
    
    $query = "SELECT $column FROM $table WHERE $column = '$entry'";
    mysql_select_db("philly_controls", $con);
    if(mysql_num_rows(mysql_query($query))){
return true;
}
else{
    return false;
}





}




?>