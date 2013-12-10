<?php

class Videos_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
        
        public function return_video_template($video){
            
           $data = $this->db->select("SELECT * FROM video_library WHERE web_id = :web_id  AND video_url = :video ORDER BY date", $array = array(':web_id'=>WEB_ID, ':video'=>$video));
            
       
           $count = 0;
           foreach ($data as $val) {
               $count++;
              $template = "                 
<div id='cvideo'>
                    <div id='videoTitle' class='edgework'> ".$val['video_name']."</div>
                    <div id='videocontainer' class='edgework'>
                        <iframe id='videoPlayer' width='100%' height='100%' src='http://www.youtube.com/embed/".$val['video_url']."' frameborder='0' allowfullscreen></iframe>
                    </div>
                    <div id='viddisc' class='edgework'>
                            ".$val['video_disc']."
                    </div>

                </div>"; 
              
              if(Admincontrols::isloggedin(true)){
                  $template = "<div class='userui'>" . $template;
                  $template .= " <form method='post' action='".URL."edit/unlinkVideo'><img src='".URL."/private/images/bullet_delete.png'>Unlink This Video. 
                      <input type='hidden' name='id' value='".$val['id']."'/> <input type='submit' guini='buttonui' value='-'/></form></div>";
                 
              }
              
           }
           
           if($count > 0){
              return $template;  
           }
       else{
           return false;
       }
        
        }

	
}