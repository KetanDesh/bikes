<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Data_collection_model extends CI_Model{
    function AddDealer($register_array){
        $sql = $this->db->insert_string('BikeValuation.DealerDetails',$register_array);
        $query = $this->db->query($sql);
        if($query === TRUE){
            return TRUE;
        } else {
            echo "outside";
            
            $register_array = array();
            //return FALSE;
        }
    }
    function GetDealer(){
        $query = $this->db->query("SELECT dealerID,dealer from BikeValuation.DealerDetails");
        return $query->result();
    }
    public function GetMake(){
        $query = $this->db->query("SELECT distinct make from BikeValuation.Models");
        return $query->result();
    }
    public function GetModelID($make,$model,$variant){
        $query = $this->db->query("SELECT modelID from BikeValuation.Models where make = '$make' AND model='$model' AND variant='$variant'");
        //echo $this->db->last_query();
        $row = $query->row();
        $data  = $row->modelID;
        return $data;
    }
    public function AddDealerMatrix($register_array){
        $sql = $this->db->insert_string('BikeValuation.DealerMatrix',$register_array);
        echo $this->db->last_query();
        $query = $this->db->query($sql);
        if($query === TRUE){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function GetYear(){
        $query = $this->db->query("Select distinct year from BikeValuation.DealerMatrix order by `Year` ASC");
        //echo $this->db->last_query();
        return $query->result();
    }
    public function GetDistDealer($dealer){
        $query = $this->db->query("Select distinct modelId from BikeValuation.DealerMatrix where DealerId='{$dealer}'");
        //echo "GetDistDealer=".$this->db->last_query();
        return $query->result();
    }
    public function getBikeDetailsfromModelId($modelID){
        $query = $this->db->query("SELECT make, model, variant from BikeValuation.Models where modelId = '{$modelID}'");
        //echo "mmvlists=".$this->db->last_query();
        return $query->result();
    }
    public function getBikeIdfromDealMid($dealer,$modelid) {
        $query = $this->db->query("Select bikeId from BikeValuation.DealerMatrix where dealerid='{$dealer}' and modelId='{$modelid}'");
        //echo "DistinctbikeID-".$this->db->last_query();
        return $query->result();
    }
    public function getBikeDetailsfromBikeId($bikeid){
        $query = $this->db->query("SELECT * FROM BikeValuation.Specifications WHERE bikeId='{$bikeid}'");
        echo $this->db->last_query();
        return $query->result();
    }
    function getMinMaxPrices($BikeId, $DealerId, $Year){ 
        $query = $this->db->query("select minPrice, maxPrice from BikeValuation.DealerMatrix where bikeId='{$BikeId}' and dealerId='{$DealerId}' and year='{$Year}'");
        //echo $this->db->last_query()."<br>";
        
     if ($query->num_rows() > 0){
        foreach ($query->result() as $row){
           $result['Price'] = $row->minPrice."-".$row->maxPrice;
           //return $result;
        }
     } else {
        $result['Price'] = "0-0";
        
     }
        return $result; 
    }
}
?>
