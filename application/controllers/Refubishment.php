<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
require(APPPATH.'/libraries/REST_Controller.php');
class Refubishment extends REST_Controller {
    
    /*function check($data){
        if($data != NULL)
        return $data;
        else{
            echo "invalid params";
            die;
        }
    }*/
    
    function api_put(){
        $data=array('id'.$this->put('id'));
        $data = $this->response($data);
        print_r($data);
    }  //valuation_get 
}