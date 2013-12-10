<?php

class Photos_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function return_image_albums() {

        $data = $this->db->select("SELECT cat, COUNT(url), id
FROM clientimages
WHERE web = :web_id
GROUP BY cat", array(':web_id' => WEB_ID));

        $stackOfAlbums = "";



        foreach ($data as $cat) {
            $category = str_replace(" ", "-", $cat['cat']);
            if ($cat['COUNT(url)'] > 1) {
                $picword = " pictures";
                $picwords = " them all.";
                $link = URL . "photos/album/" . $category;
            } else {
                $picword = "picture";
                $picwords = "it.";
                $link = URL . "photos/photo/" . $cat['id'];
            }


            $firstFive = $this->db->select("SELECT url, thumb, id, disc
FROM clientimages
WHERE web = :web_id
AND cat = :cat
LIMIT 5", array(':web_id' => WEB_ID, ':cat' => $cat['cat']));


            $stackOfAlbums .= "<div onclick=\"window.open('$link', '_self')\" class='album_section'><h3>" . $cat['cat'] . "</h3>";
            $stackOfPics = "<table class='pics'><tbody><tr>";


            foreach ($firstFive as $pics) {
                $stackOfPics .= "<td><img alt=\"".$pics['disc']."\" src=\"" . URL . $pics['thumb'] . "\"></td>";
            }


            $stackOfPics .="</tr><tr><td colspan='5'>" . $cat['COUNT(url)'] . " " . $picword . " in this album, click to see $picwords</td></tr></tbody></table>";


            $stackOfAlbums .= $stackOfPics;
            $stackOfAlbums .= "</div>";
        }

        return $stackOfAlbums;
    }

    public function return_images($album) {
        $data = $this->db->select("SELECT id, url, cat, thumb, disc
FROM clientimages
WHERE web = :web_id
AND cat = :cat ORDER BY id", $array = array(':web_id' => WEB_ID, ':cat' => $album));

        $template = "";
        $count = 0;
        foreach ($data as $val) {
            $count++;

            $template .= "<a href='" . URL . "photos/photo/" . $val['id'] . "'><div class='photocat'>
                    <img alt=\"".$val['disc']."\" src='" . URL . $val['thumb'] . "'>
                       
                </div></a>";
        }

        if ($count > 0) {
            return $template;
        } else {
            return false;
        }
    }

    public function return_photo($photoid) {





        $data = $this->db->select("SELECT url, cat, disc
FROM clientimages
WHERE web = :web_id
AND id = :id", $array = array(':web_id' => WEB_ID, ':id' => $photoid));

        $template = "";
        $count = 0;

        $cat = '';
        foreach ($data as $vz) {
            $cat = $vz['cat'];
        }

        //return;


        $backURL = $this->nextback($photoid, $cat, '<');
        $nextURL = $this->nextback($photoid, $cat, '>');








        foreach ($data as $val) {
            $count++;
            $url = $val['url'];
            $disc = $val['disc'];
            $template .= "
                <table style='vetical-align: central; width: 100%;'>
                <tbody>
                    <tr>
                            <td onclick=\"window.open('" . URL . $backURL . "', '_self')\" class='backtd'>&lt;</td>
                     <td>       
                <a href='" . URL . $nextURL . "'>
                    <img src='" . URL . 'images/' . $val['url'] . "' class='showcase' alt='".htmlentities($val['disc'])."'>
                       </a>
                      <p>
" . $val['disc'] . "    </p>                   

                       </td>
                      
                       <td class='nextd' onclick=\"window.open('" . URL . $nextURL . "', '_self')\">&gt;</td>
                       </tr>
                    
                </tbody>
                </table>
                        
                ";
        }

        if ($count > 0) {
            return $template = array($template, $url, $disc);
        } else {
            return false;
        }
    }

    private function nextback($photoid, $cat, $back = '>') {


        if ($back == '<') {
            $dec = DESC;
        } else {
            $dec = "";
        }

        $next = $this->db->select("SELECT id FROM clientimages
            WHERE web = :web_id
            AND id " . $back . " :id 
            AND cat = :cat ORDER BY id $dec LIMIT 1", $array2 = array(':cat' => $cat, ':web_id' => WEB_ID, ':id' => $photoid));

        $nextURL = "";

        $count2 = 0;
        foreach ($next as $t) {
            $count2++;
            $nextURL = $t['id'];
        }
        $category = str_replace(" ", "-", $cat);
        $category = "photos/album/$category";

        if ($count2 > 0) {
            $ur = "photos/photo/" . $nextURL;
        } else {


            $ur = $category;
        }

        $this->cat = "<a href='" . URL . $category . "'>$cat</a>";


        return $ur;
    }

}