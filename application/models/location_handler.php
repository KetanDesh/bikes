<?php
class Location_Handler extends CI_Model{

    function getLocation($place) {
        global $ANALYTICS;
        $query = "select LocId from Location where Search LIKE '%".$place."%'";
        $result = mysql_fetch_array(mysql_query($query, $ANALYTICS));
        $loc_id = $result['LocId'];
        if (!isset($loc_id)){
            $query1 = "select LocId, Search from Location";
            $query_return = mysql_query($query1, $ANALYTICS);
            $max = 0.0;
            $place = strtoupper($place);
            $location = '';
            $loc_id = 0;
            while ($result1 = mysql_fetch_array($query_return)){
                $match = 0.0;
                $loc = strtoupper($result1['Search']);
                similar_text($place, $loc, $match);
                if (($match > 80) && ($match > $max))
                {
                    $max = $match;
                    $location = $result1['Search'];
                    $loc_id = $result1['LocId'];
                }
            }
        }
        return $loc_id;
    }


    function getLocationFromId($locId) { 
        $query = $this->db->query("select Place from Location.CitySearch where LocId ='$locId'");
        return $query->result();
    }
}

