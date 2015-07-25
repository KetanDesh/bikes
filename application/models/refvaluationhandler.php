<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Refvaluationhandler extends CI_Model{
    function __construct()
    {
      parent::__construct();
      //$this->another = $this->load->database('anotherdb',TRUE);
    }
    function getDepreciation($param){
        $query = $this->db->query("SELECT Value from Analytics.RefValuation where Param = ".$param);
        $result = $query->result_array();
        return $result;
    }

    function getDiscountDepreciation(){
        $query = $this->db->query("SELECT Value from Analytics.RefValuation where Description = 'Discount'");
        $discount = $query->row();
        return $discount->Value;
    }
    function getMaxDepreciation(){
        $query = $this->db->query("SELECT Value from Analytics.RefValuation where Description = 'Maximum'");
        $max = $query->row();
        return $max->Value;
    }
    function getPopularityDepreciation($pop_id){
        $query = $this->db->query("SELECT Value from Analytics.RefValuation where Description LIKE 'Popularity' and Param = '$pop_id'");
        $popularity = $query->result_array();
        return $popularity;
    }
    function getYearBreak(){
        //$this->db->database('Analytics');
        $query = $this->db->query("SELECT Value from Analytics.RefValuation where Description LIKE 'Year Break'");
        $y_break = $query->row();
        //$y_break = (mysql_fetch_array($result)[0]);
        return $y_break->Value;
    }

    function getImmediateDepreciation(){
        $query = $this->db->query("SELECT Value from Analytics.RefValuation where Description = 'Immediate'");
        $imm_dep = $query->row();
        return $imm_dep->Value;
    }

    function getYearDepreciation($year){
        $query = $this->db->query("SELECT Value from Analytics.RefValuation where Description like 'year' and Param = '$year'");//."and CategoryId = ".$cat_id;
        $result = $query->row();
        /*while($result_array = $result->row()){
            return $result_array[0];
            break;
        }*/
        return $result->Value;
    }

    function getDistanceDepreciation($distance){
        $query = $this->db->query("SELECT Value, Param from Analytics.RefValuation where Description LIKE '%Distance%'");
        $sql_return = $query->result_array();

        /*while ($result = $query->result_array()){
            //echo "";
            if(intval($distance)>intval($result['Param'])){
                $dist_dep_1 = intval($result["Value"]);
                $is_up_range = 0;
                $dist1 = intval($result['Param']);
                continue;
            }
            else{
                $dist_dep_2 = intval($result["Value"]);
                $is_up_range = 1;
                $dist2 = intval($result['Param']);
                break;            
            }
        }*/
        foreach($query->result_array() as $row){
            if(intval($distance) > intval($row['Param'])){
                $dist_dep_1 = intval($row['Value']);
                $is_up_range = 0;
                $dist1 = intval($row['Param']);
                continue;
            } else {
                $dist_dep_2 = intval($row['Value']);
                $is_up_range = 1;
                $dist2 = intval($row['Param']);
            }
        }
        if ($is_up_range){
            $dist_dep= $dist_dep_1 + ($distance -$dist1)*($dist_dep_2-$dist_dep_1)/($dist2-$dist1); 
            //echo 'Dist dep:==='.$dist_dep;
        }
        else{
            $dist_dep = $dist_dep_1;
        }
        return $dist_dep;
    }

    function insertValuationData($value,$param,$description,$categoryId){
        echo "<br> refValuationHandler call";
        global $ANALYTICS;
        $query = $this->db->query("INSERT INTO Analytics.RefValuation (Value,Param,Description,CategoryId) VALUES ('$value', '$param', '$description' ,'$categoryId')");
        echo $query;
        mysql_query($query,$ANALYTICS);

    }

    function copyValuationData($value,$param,$description,$categoryId){
        echo "<br> refValuationHandler call";
        global $ANALYTICS;
        $query = $this->db->query("INSERT INTO Analytics.RefValuation (Value,Param,Description,CategoryId,LocationId) VALUES ('$value', '$param', '$description' ,'$categoryId',$locationId)");
        mysql_query($query,$ANALYTICS);
    }
}
?>
