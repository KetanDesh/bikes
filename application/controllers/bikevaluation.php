<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
require(APPPATH.'/libraries/REST_Controller.php');
class BikeValuation extends REST_Controller {
    
    function api_get(){
        error_reporting(0);
        $this->load->model('valuationModel');
        $this->load->model('refvaluationhandler');
        $this->load->model('refbikeshandler');
        
        $model = $this->get('model');
        $make = $this->get('make');
        $bikeId = $this->get('bikeId');
        $locId = $this->get('locId');
        $year = $this->get('year');
        $month = $this->get('month');
        $distance = $this->get('distance');
        $on_rd_price = $this->get('on_rd_price');
        $web =  $this->get('web');
        $datestring = "%Y";
        $time = now();
        $cur_year = mdate($datestring, $time);
        $make= $this->input->get('make',true);
        //echo "Make1------------".$make."-bikeId=".$bikeId."Model=".$model."locId=".$locId."-Year=".$year."cur_year".$cur_year.'-Month='.$month.'-Distance-'.$distance."-on_rd_price=".$on_rd_price;
        
        if(!$on_rd_price) 
        {
            $bike_price = intval($this->valuationModel->getOnRoadPrice($bikeId, $locId));  
        }
        $year_input = intval($year);
        $month_input = intval($month);
        $year = intval($cur_year) - $year_input;
        $month = 7 - $month_input;
        $year_break = $this->refvaluationhandler->getYearBreak();  //check remaining
        //echo "Year_break".$year_break."month".$month;
        
        if ($month>0){
            $month_dep = round(($this->refvaluationhandler->getYearDepreciation(intval($year)+1) - $this->refvaluationhandler->getYearDepreciation(intval($year)))*$month*(1-$year_break)/12.0,2);
            //echo "month_dep".$month_dep;
        }
        else{
            $month_dep = round(($this->refvaluationhandler->getYearDepreciation(intval($year)) - $this->refvaluationhandler->getYearDepreciation(intval($year)-1))*$month*(1-$year_break)/12.0,2);
        }
        
        $immediate_dep = $this->refvaluationhandler->getImmediateDepreciation();
        $year_dep = $this->refvaluationhandler->getYearDepreciation($year);
        $dist_dep = round($this->refvaluationhandler->getDistanceDepreciation($distance),2);
        $discount_factor = $this->refvaluationhandler->getDiscountDepreciation();
        $maximum_dep = $this->refvaluationhandler->getMaxDepreciation();
        $get_rating = $this->refbikeshandler->getRating($bikeId);
        $rating_dep = intval($this->refvaluationhandler->getPopularityDepreciation($get_rating));
        $dep = $immediate_dep+$year_dep+$dist_dep+$month_dep+$discount_factor+$rating_dep;
        if ($dep > $maximum_dep)
            $dep = $maximum_dep;
        
        if($on_rd_price){
            $dep_on_rd_price = round(($on_rd_price - $dep * $on_rd_price/100.0),1);
            //$dep_on_rd_price = 'On road price : ' .$on_rd_price;
            $data = array('On road price'=>  intval($on_rd_price), "Depreciated on road price"=>$dep_on_rd_price );
            $response=json_encode($data);
            $dataweb =$dep_on_rd_price;
        } else {
            $depreciated_price = $bike_price - $dep*$bike_price/100.0;
            $depreciated_price = round($depreciated_price);
            $data = array("Original price:"=>$bike_price,"Depreciated on road price"=>$depreciated_price );
            $response=json_encode($data);
            $dataweb =$depreciated_price;
        }
        if($web){
            if($on_rd_price){
                echo "<h3>On road price : <small> Rs.$on_rd_price</small><h3>";
                echo "<h3>Depreciated on road price:<small> Rs.$dataweb</small></h3>";
            }else{
            echo "<h3>Original price:<small> Rs.$bike_price</small><h3>";
            echo "<h3>Depreciated on road price:<small> Rs.$dataweb</small></h3>";
            }
        }else{
            echo $response;
            return $response;
        }
    }  //valuation_get 
}