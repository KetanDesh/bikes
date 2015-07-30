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
        //$query = $this->db->query("SELECT Source FROM CRM_Data.MeetingDispositions where source = 'Campaign'");
        return $query->result();
    }
    function get_query($type){
        $query = $this->db->query("SELECT * from CRM_Data.CrmQuery WHERE queryType = '{$type}'");
        //echo $this->db->last_query();
        return $query->result();
    }
    function main_query($sqlQuery_init,$source,$start_data,$end_date,$debug){
        $sqlQuery = $sqlQuery_init. " AND (addedDate BETWEEN '{$start_data}' AND '{$end_date}') AND Source='{$source}'";
        $sqlQuery = str_replace('WHEREAND', 'WHERE', $sqlQuery);
        $sqlQuery = str_replace('WHERE AND', 'WHERE', $sqlQuery);
        if($debug == 1){
            echo $sqlQuery."</br>";
        }
         //echo $sqlQuery."<br>";
         $query1 = $this->db->query($sqlQuery);  
         $result = $query1->result();
         $result = json_decode(json_encode($result),true); 
         //echo "Count".$result[0]['count']."-".$sqlQuery."</br>";
         return $result[0]['count'];

    }
    
}
?>