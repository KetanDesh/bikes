<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class dealer_data extends CI_Controller {
    
    function index(){
        $this->load->model("data_collection_model");
        $data['title']="Dealer Pricings";
        $data['valClass'] = "valClass";
        $this->load->view('include/header',$data);
        $data['default'] ='active';
        $this->load->view('Dealer',$data);
    }
    /*function get_dealer_list(){
       $this->load->model("data_collection_model");
       $data['$dealerlist'] = $this->data_collection_model->GetDealer();
    }*/
    function get_dealer_list(){
            $this->load->model('data_collection_model');
            $Data['dataDealerDrp'] = $this->data_collection_model->GetDealer();
            $output = null;
            echo "<option value=''>Select Dealer</option>";
            foreach ($Data['dataDealerDrp'] as $row){
                $output.="<option value='".$row->dealerID."'>".$row->dealer."</option>";
            }
            echo $output;
    }
    function get_make_list(){
            $this->load->model('data_collection_model');
            $Data['Make'] = $this->data_collection_model->GetMake();
            $output = null;
            echo "<option value=''>Select Dealer</option>";
            foreach ($Data['Make'] as $row){
                $output.="<option value='".$row->make."'>".$row->make."</option>";
            }
            echo $output;
    }
    function add_dealer_data(){
        $data['option'] =  array();
       // $this->data_collection_model->dealer_post($dealerName,$description,$pincode,$Location);
        $data['title'] = 'Add dealer';
        $this->load->view('include/header',$data);
        $this->load->model("data_collection_model");
        
        $this->form_validation->set_rules('dealerName', 'Dealer Name', 'required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'xss_clean');
        $this->form_validation->set_rules('pincode', 'Pincode', 'xss_clean');
        $this->form_validation->set_rules('location', 'Location', 'xss_clean');
        
        if($this->form_validation->run() == FALSE){
             $this->load->view('Dealer');
        }else{
        $register_array = array('dealer' =>  $this->input->post('dealerName'),
                                'description' => $this->input->post('description'),
                                'pincode' => $this->input->post('pincode'),
                                'location' => $this->input->post('location')
                        );
        $insert = $this->data_collection_model->AddDealer($register_array);
        if($insert === TRUE){
            $data['msg'] = "Dealer Data inserted Successfully";
            $data['bikeClass'] = '';
            $data['dealerClass'] = 'active';
            $data['default'] = '';
            $this->load->view('Dealer',$data);
        } else {
            $data['msg'] = "Please enter valid data";
            $this->load->view('Dealer',$data);
        }
        }
    }
    function add_bike_data(){
        $data['option'] =  array();
        $this->load->model("data_collection_model");
        $data['title'] = 'Add Bike';
        $this->load->view('include/header',$data);
        $dealer = $this->input->post('dataDealerDrp');
        $make = $this->input->post('datamakeDrp');
        $model = $this->input->post('datmodelDrp');
        $variant = $this->input->post('datavariantDrp');
        $bikeID= $this->input->post('databikeId');
        $min = $this->input->post('minPrice');
        $max = $this->input->post('maxPrice');
        $year = $this->input->post('year');
        
        $this->form_validation->set_rules('dataDealerDrp', 'Dealer Name', 'xss_clean');
        $this->form_validation->set_rules('minPrice', 'Min Price', 'xss_clean|callback_MinMax_check');
        $this->form_validation->set_rules('maxPrice', 'Max Price', 'xss_clean|callback_MinMax_check');
        $this->form_validation->set_rules('year', 'Year', 'xss_clean');
        
      

        if($this->form_validation->run() == FALSE){
             $this->load->view('Dealer');
        }else{
            $modelId = $this->data_collection_model->GetModelID($make,$model,$variant);
            
            $register_array = array('dealerID' =>$dealer,
                                    'modelID' => $modelId,
                                    'bikeid' => $bikeID,
                                    'year' => $year,
                                    'minPrice' => $min,
                                    'maxPrice' =>$max
                                );

            $insert = $this->data_collection_model->AddDealerMatrix($register_array);
            if($insert === TRUE){
                $data['msg1'] = "Bike Data inserted Successfully";
                $data['bikeClass'] = 'active';
                $data['dealerClass'] = '';
                $data['default'] = '';
                $this->load->view('Dealer',$data);
            } else {
                $data['msg'] = "Please enter valid data";
                $data['selBike'] ="select";
                $this->load->view('Dealer',$data);
            }
        }
        function MinMax_check($min,$max)
        {
            if ($max >$max)
            {
                echo "str".$str;
                $this->form_validation->set_message('Please enter valid Min Max  value', 'The %s field can not be the word "test"');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }
    
    function dealer_search(){
        function boolToText($value)
            {
                if($value)
                    return 'Yes';
                else
                    return 'No';
            }
        $this->load->model("data_collection_model");
        $dealer = $this->input->get('dealerID',true);
        $Data['yearlist'] = $this->data_collection_model->GetYear();
        $Data['distDealer'] = $this->data_collection_model->GetDistDealer($dealer);
        $output = null;
        $years_array = array();
        $output .="<table style='width:100%'><tr><td rowspan='2'><b>Make-Model-Variant</b></td><th colspan='15'><center>Specs</center></th>";
        foreach ($Data['yearlist'] as $row1){
            //array_push($years_array,$row1->year);
            $output.="<td rowspan='2'><b>{$row1->year}</b></td>";
        }
        $output .="</tr>";
        $output .="<tr><th>cc </th><th>AnalogMeter </th><th>DigitalMeter </th><th>Tachometer</th><th>DTSi</th><th>Kick Start</th> <th>Self Start</th> <th>Wheel Type</th> <th>Rear Brake</th><th>Front Brake</th><th>ABS</th><th>Digital Meter</th><th>Manufactured Year</th><th>Discontinued Year</th><th>Color</th></tr>";
        foreach ($Data['distDealer'] as $row2){
            echo "ModelID".$row2->modelId;
            $mmvlists = $this->data_collection_model->getBikeDetailsfromModelId($row2->modelId);
            foreach ($mmvlists as $mmvlist){
                $make_model_variant = $mmvlist->make."-".$mmvlist->model."-".$mmvlist->variant;
            }
                $distbikeID = $this->data_collection_model->getBikeIdfromDealMid($dealer,$row2->modelId);
                $output .="<tr>";
                $output .="<th rowspan=''>{$make_model_variant}</th>";
                
                foreach ($distbikeID as $row3){
                    $Data['results'] = $this->data_collection_model->getBikeDetailsfromBikeId($row3->bikeId);
                    foreach($Data['results'] as $result){
                        $output.="<td >{$result->cc}</td><td>".boolToText($result->analogMeter)."</td><td>".boolToText($result->digitalMeter)."</td><td>".boolToText($result->tachometer)."</td><td>".boolToText($result->dtsi)."</td><td>".boolToText($result->kickStart)."</td> <td>".boolToText($result->selfStart)."</td> <td>{$result->wheelType}</td> <td>{$result->rearBrakeType}</td><td>{$result->frontBrakeType}</td><td>".boolToText($result->abs)."</td><td>".boolToText($result->digitalMeter)."</td><td>{$result->mfgYear}</td><td>{$result->discontinuationYear}</td><td>{$result->colour}</td>";
                        foreach ($Data['yearlist'] as $row1){  
                        $Data['min_max'] = $this->data_collection_model->getMinMaxPrices($row3->bikeId, $dealer, $row1->year);
                        foreach ($Data['min_max'] as $min_max){
                                $output .= "<td>{$min_max}</td>";    
                        } 
                         //$output .= "</tr><tr>";
                        
                    }
                   }  
                   
                }
        }
        echo $output;
        
    }
}
?>
