<?php

class Drop_downhandler_model extends CI_Model{
    public function getMake(){
        $query = $this->db->query("SELECT distinct Make from BikeValuation.Models");
        foreach($query->result_array() as $row){
            $data[$row['Make']] = $row['Make'];
        }
        return $data;
    }
    
    public function getCityByCountry($cat_id=string){
        $query = $this->db->query("SELECT DISTINCT Model from BikeValuation.Models where Make = '$cat_id'");
        return $query->result();
    }
    
    public function getVariantByModel($cat_id=string,$model=string){
        echo "Make=".$cat_id."-Model=".$model;
        $query = $this->db->query("SELECT DISTINCT Variant, ModelId from BikeValuation.Models where Make LIKE '$cat_id' and Model LIKE '$model'");
        return $query->result();
    }
    function getBikeid($cat_id=string,$model=string,$variant=string){
        if($variant == ""){
            $query = $this->db->query("SELECT modelID from BikeValuation.models where make ='$cat_id' AND model='$model'");
            return $query->result();
        } else {
            $query = $this->db->query("SELECT modelID from BikeValuation.models where make = '$cat_id' AND model='$model' AND variant='$variant'");
            return $query->result();
        }
     }
    function getBikeDetails($modelid=string){
            $query = $this->db->query("SELECT * from BikeValuation.Specifications where modelID ='$modelid'");
            return $query->result();
     }
     
     function getDistinctLocFromBikeId($bikeId){
        $sql = $this->db->query("Select distinct locID from BikeValuation.Prices where bikeID = {$bikeId}");
           return $sql->result();
     }

    function getOnRoadPrice($bikeId, $locId){
        $sql = $this->db->query("Select onRoadPrice from BikeValuation.Prices where BikeID={$bikeId} and locID = {$locId}");
        return $bike_price;
    }
}