<?php

class Edit_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function uploadImages() {
        
    }

    public function returnCategories() {
        return $this->db->select("SELECT cat FROM clientimages
                WHERE web = :web
                GROUP BY cat", array(':web' => WEB_ID));
    }

    public function removeimage($id) {
        $data = $this->db->select("SELECT url, thumb
FROM clientimages
WHERE web = :web_id
AND id = :id LIMIT 1", $array = array(':web_id' => WEB_ID, ':id' => $id));
        $photourl = "";
        $photothumb = "";

        foreach ($data as $vr) {

            $photourl = $vr['url'];
            $photothumb = $vr['thumb'];
        }




        unlink(ROOTS . 'images/' . $photourl);
        unlink(ROOTS . $photothumb);


        return $this->db->delete('clientimages', 'web=' . WEB_ID . ' AND id = ' . $id);
    }

    public function updateLittleBox($content, $elementid) {
        $this->db->update('littleBoxes', array('content' => $content), "web_id = '" . WEB_ID . "' AND id ='" . $elementid . "'");
    }

    function createNewLittleBox() {

        $id = uniqid();

        $this->db->insert('littleBoxes', array('element_id' => $id, 'web_id' => WEB_ID, 'content' => 'This is new content.'));

        return "A new littleBox has been created with the id of: " . $id . "<br />
            <textarea> <?php echo \$this->Guini->displayLittleBox(\"$id\"); ?></textarea>";
    }

    function returnImages() {

        if (!isset($_POST['cat']) || $_POST['cat'] == 'ALL') {

            $data = $this->db->select("SELECT url, thumb, id
FROM clientimages
WHERE web = :web_id
", $array = array(':web_id' => WEB_ID));
        } else {
            $data = $this->db->select("SELECT url, thumb, id
FROM clientimages
WHERE web = :web_id
AND cat = :cat
", $array = array(':web_id' => WEB_ID, ':cat' => $_POST['cat']));
        }

        return $data;
    }

    function returnImagesCategories() {
        $data = $this->db->select("SELECT cat
FROM clientimages
WHERE web = :web_id
GROUP BY cat
", $array = array(':web_id' => WEB_ID));

        return $data;
    }

    function setEvent() {
        
        //convert to military time if set to PM
        
        if($_POST['am'] == 1){
          $star_time =  $_POST['stime_a'] + 12 . ":". $_POST['stime_b'];
        }else{
            $star_time =  $_POST['stime_a'] . ":". $_POST['stime_b'];
        }
        
         if($_POST['am1'] == 1){
          $end_time =  $_POST['stime_c'] + 12 . ":". $_POST['stime_d'];
        }else{
            $end_time =  $_POST['stime_c'] . ":". $_POST['stime_d'];
        }

        $values = array('event_id' => uniqid(),
            'web_id' => WEB_ID,
            'title' => $_POST['title'],
            's_time' => $star_time,
            'e_time' => $end_time,
            'date' => date('Y-m-d H:i:s', strtotime($_POST['sDate'])),
            'location' => $_POST['location'],
            'description' => $_POST['disc'],
            'end_date' => date('Y-m-d H:i:s', strtotime($_POST['eDate'])),
            'visible' => "on"
        );

        $this->db->insert('events', $values);
    }
    
    function removeEvent(){
        $this->db->delete('events', 'web_id=' . WEB_ID . ' AND event_id = \'' . $_POST['eid']. '\'');
    }

    
    function linkVideo(){
        //create a video id
        
        $vid = uniqid();
        $ar = array('id' => $vid, 'web_id' => WEB_ID, 'video_url' => $_POST['vurl'], 'video_name' => $_POST['name'], 'video_disc' => $_POST['disc'], 'type' => 'YouTube', 'category'=>$_POST['cats']);
        
         $this->db->insert('video_library', $ar);
        
        
    }
    
    function returnVideoCategories(){
        
         $data = $this->db->select("SELECT category AS cat
FROM video_library
WHERE web_id = :web_id
GROUP BY category", $array = array(':web_id' => WEB_ID));
        
         return $data;
         
    }
    
    function ulinkVideo(){
        
        $this->db->delete('video_library', 'web_id=' . WEB_ID . ' AND id = \'' . $_POST['id']. '\'');
   
        
    }
    
}