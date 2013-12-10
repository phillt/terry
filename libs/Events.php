<?php

class Events {

    function addEvent($title, $s_time, $e_time, $date, $location, $description, $cat, $visible, $lat_long) {
        //
        $con = write_database_();
        if (!$con) {
            return "error " . mysql_error();
        }

        if (!isset($_COOKIE["web_id"]) || $_COOKIE["web_id"] == "" || $_COOKIE["web_id"] == " ")
            return "Not logged in";
        mysql_select_db("phillly_controls", $con);
        $query = "INSERT INTO events VALUES('" . uniqid() . "', '" . mysql_real_escape_string($_COOKIE['web_id']) . "',
      '" . mysql_real_escape_string($title) . "', '" . mysql_real_escape_string($s_time) . ":00','" . mysql_real_escape_string($e_time) . ":00',
      '" . mysql_real_escape_string($date) . "', '" . mysql_real_escape_string($location) . "', '" . mysql_real_escape_string($description) . "', '" . mysql_real_escape_string($cat) . "',
      '" . mysql_real_escape_string($visible) . "', '" . mysql_real_escape_string($lat_long) . "')";

        $result = mysql_query($query);
        if (!$result) {
            return "There was an error while attempting to store your event<br />
            " . mysql_error();
        } else {
            return "Your event has been stored succesfully.";
        }
    }

    function deleteEvent($event_id) {
        //
        $con = write_database_();
        if (!$con) {
            return "error " . mysql_error();
        }

        if (!isset($_COOKIE["web_id"]) || $_COOKIE["web_id"] == "" || $_COOKIE["web_id"] == " ")
            return "Not logged in";
        mysql_select_db("phillly_controls", $con);
        $query = "DELETE FROM events
WHERE event_id='" . mysql_real_escape_string($event_id) . "' AND web_id='" . mysql_real_escape_string($_COOKIE['web_id']) . "'";

        $result = mysql_query($query);
        if (!$result) {
            return "There was an error while attempting to delete your event<br />
            " . mysql_error();
        } else {
            return "Your event has been deleted succesfully.";
        }
    }

    function saveChange($eventid, $title, $s_time, $e_time, $date, $location, $description, $cat, $visible, $lat_long) {
        //
        $con = write_database_();
        if (!$con) {
            return "error " . mysql_error();
        }

        if (!isset($_COOKIE["web_id"]) || $_COOKIE["web_id"] == "" || $_COOKIE["web_id"] == " ")
            return "Not logged in";
        mysql_select_db("phillly_controls", $con);
        $query = "UPDATE events SET 
      title='" . mysql_real_escape_string($title) . "', s_time='" . mysql_real_escape_string($s_time) . ":00', e_time='" . mysql_real_escape_string($e_time) . ":00',
      date='" . mysql_real_escape_string($date) . "', location='" . mysql_real_escape_string($location) . "', description='" . mysql_real_escape_string($description) . "', category='" . mysql_real_escape_string($cat) . "',
      visible='" . mysql_real_escape_string($visible) . "', lat_long='" . mysql_real_escape_string($lat_long) . "' WHERE event_id='" . mysql_real_escape_string($eventid) . "' AND web_id='" . mysql_real_escape_string($_COOKIE['web_id']) . "'";

        $result = mysql_query($query);
        if (!$result) {
            return "There was an error while attempting to save changes to your event.<br />
            " . mysql_error();
        } else {
            return "Your changes have been saved.";
        }
    }

    function returnCategories($web_id, $template_string, $variable_pairs) {
        //
        $variable_pairs = explode(",", $variable_pairs);
        $con = read_database_();
        if (!$con) {
            return "error " . mysql_error();
        }


        mysql_select_db("phillly_controls", $con);

        $query = "SELECT DISTINCT category FROM events WHERE web_id='" . mysql_real_escape_string($web_id) . "'";
        $result = mysql_query($query);
        if (!$result) {
            return false;
        } else {
            $template_stack = "";
            while ($row = mysql_fetch_array($result)) {
                $template = $template_string;
                //loop through variable array
                foreach ($variable_pairs as $a) {
                    $vparis = explode(':', $a);

                    if ($vparis[1] == 'hr_date') {
                        $template = str_replace($vparis[0], $this->value_transform($row['date'], 'mysql_to_hrf'), $template);
                    } else {
                        $template = str_replace($vparis[0], $row[$vparis[1]], $template);
                    }
                }

                $template_stack = $template_stack . $template;
            }

            return $template_stack;
        }
    }

    function return_events($web_id, $template_string, $variable_pairs) {




        $variable_pairs = explode(",", $variable_pairs);
        $con = read_database_();
        if (!$con) {
            return "error " . mysql_error();
        }


        mysql_select_db("phillly_controls", $con);

        $query = "SELECT * FROM events WHERE web_id='" . mysql_real_escape_string($web_id) . "'";
        $result = mysql_query($query);
        if (!$result) {
            return false;
        } else {
            $template_stack = "";
            while ($row = mysql_fetch_array($result)) {
                $template = $template_string;
                //loop through variable array
                foreach ($variable_pairs as $a) {
                    $vparis = explode(':', $a);

                    $template = str_replace($vparis[0], $row[$vparis[1]], $template);
                }

                $template_stack = $template_stack . $template;
            }

            return $template_stack;
        }
    }

    function value_transform($value, $transform_to) {

        //supported value transforms
        switch ($transform_to) {
            case "mysql_to_hrf":
                $value = explode('-', $value);
                $months = array("01" => "January", "02" => "Febuary", "03" => "March", "04" => "April", "05" => "May", "06" => "June", "07" => "July", "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December");

                //take away first zero

                $year = $value[0]; //year


                $month = $months[$value[1]]; //month
                $day = $value[2]; //day

                return $month . ' ' . $day . ', ' . $year;
            default:
                return 'Transform Value Not Supported, list of supported values:<br />
                        mysql_to_hrf: converts a MYSQL date to a human readable format.<br />
                    ';
        }
    }

    function return_upcomming_events($web_id, $template_string, $variable_pairs) {






        $variable_pairs = explode(",", $variable_pairs);
        $con = read_database_();
        if (!$con) {
            return "error " . mysql_error();
        }


        mysql_select_db("phillly_controls", $con);

        $query = "SELECT * FROM events WHERE web_id='" . mysql_real_escape_string($web_id) . "' AND date>=CURDATE() AND visible = 'on' ORDER BY date ASC";
        $result = mysql_query($query);
        if (!$result) {
            return false;
        } else {
            $template_stack = "";
            while ($row = mysql_fetch_array($result)) {
                $template = $template_string;
                //loop through variable array
                foreach ($variable_pairs as $a) {
                    $vparis = explode(':', $a);

                    if ($vparis[1] == 'hr_date') {
                        $template = str_replace($vparis[0], $this->value_transform($row['date'], 'mysql_to_hrf'), $template);
                    } else {
                        $template = str_replace($vparis[0], $row[$vparis[1]], $template);
                    }
                }

                $template_stack = $template_stack . $template;
            }

            return $template_stack;
        }
    }

}

?>