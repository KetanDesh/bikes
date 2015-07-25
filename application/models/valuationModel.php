<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ValuationModel extends CI_Model{
    function getvaluation($model,$make){
        echo $make;
        //$query=$this->db->query('select distinct(make) from bike');
        //return $query->result_array();
    }
    function getOnRoadPrice($bikeId, $locId)
    {
        $bike_price = $this->db->query("Select onRoadPrice from BikeValuation.Prices where BikeID='$bikeId' and locID ='$locId'");
        $row = $bike_price->row();
        return $row->onRoadPrice;
    }
}
?>
