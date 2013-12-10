<?php

class News_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function submitPost() {

        $title = $_POST['title'];
        $cat = $_POST['cat'];
        $cont = utf8_encode($_POST['editor']);
        $data = array('web_id' => WEB_ID, 'Title' => $title, 'Content' => $cont, 'cat' => $cat);

        $this->db->insert('Blog_posts', $data);
    }

    public function getNews($newsID) {

        $array = array(':id' => $newsID, ':web_id' => WEB_ID);

        $data = $this->db->select('SELECT Title, Content, date FROM Blog_posts WHERE id=:id AND web_id = :web_id LIMIT 1', $array);

        $content = array();

        foreach ($data as $nws) {
            $content['title'] = $nws['Title'];
            $content['date'] = $nws['date'];
            // Check if the news is empty
            if ($nws['Content'] === null || $nws['Content'] === "")
                $content['cont'] = "No Content";
            else {
                $content['cont'] = $nws['Content']; 
            }
        }
         
        
        return $content;
    }

    public function getStream($limit = 4) {

        $array = array(':web_id' => WEB_ID);

        $data = $this->db->select("SELECT Title, date, Content, id 
                FROM Blog_posts  
                WHERE web_id = :web_id
                ORDER BY date DESC
                LIMIT $limit", $array);

        return $data;
    }

    public function removenews($id) {
        return $this->db->delete('Blog_posts', 'web_id=' . WEB_ID . ' AND id = ' . $id);
    }

    public function returnCategories() {
        $array = array(':web_id' => WEB_ID);
        return $this->db->select('SELECT cat FROM Blog_posts WHERE web_id = :web_id GROUP BY cat', $array);
    }

}

?>
