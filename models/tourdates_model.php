<?php

class Tourdates_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function returnTourDates(){
            
             $array = array(':web_id'=>WEB_ID);
        
        $data = $this->db->select('SELECT * FROM events WHERE web_id = :web_id AND date >= CURDATE() ORDER BY date', $array);
        
        return $data;
             
        }
        
        
}
?>
