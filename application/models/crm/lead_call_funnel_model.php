<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Lead_call_funnel_model extends CI_Model{
    
    function GetType(){
        $query = $this->db->query("SELECT DISTINCT(queryType) FROM CRM_Data.CrmQuery");
        return $query->result();
    }
    function distinct_source(){
        $query = $this->db->query("SELECT DISTINCT(Source) FROM CRM_Data.MeetingDispositions");
        return $query->result();
    }
    function get_query($type){
        $query = $this->db->query("SELECT * from CRM_Data.CrmQuery WHERE queryType = '{$type}'  ORDER BY Id ASC");
        return $query->result();
    }
    function main_query($sqlQuery,$source,$start_data,$end_date){
        $sqlQuery = $sqlQuery. "AND (addedDate BETWEEN '{$start_data}' AND '{$end_date}') AND Source='{$source}'";
        $sqlQuery = str_replace('WHEREAND', 'WHERE', $sqlQuery);
        $sqlQuery = str_replace('WHERE AND', 'WHERE', $sqlQuery);
        //echo $sqlQuery."</br>";
        //die;
        $query1 = $this->db->query($sqlQuery);  
        $result = $query1->result();
        $result = json_decode(json_encode($result),true);
        
        return $result[0]['count'];

    }
    
}
?>