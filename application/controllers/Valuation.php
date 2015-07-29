<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Valuation extends CI_Controller {

	/*
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost/bikevaluation/index.php/Pricematrix
	 */
	public function index()
	{
	//$this->load->view('welcome_message');
            $this->load->model('drop_downhandler_model');
            $data['title']="Dealer Price Matrix";
            $this->load->view('include/header',$data);
            $data['countryDrop'] = $this->drop_downhandler_model->getMake();
            $this->load->view('dealerPriceMatrix',$data);
	}
        
        public function getModel(){
            $this->load->model('drop_downhandler_model');
            $make = $this->input->get('id',true);
            $Data['districtDrop'] = $this->drop_downhandler_model->getCityByCountry($make);
            $output = null;
            echo "<option value=''>Select Model</option>";
            foreach ($Data['districtDrop'] as $row){
                $output.="<option value='".$row->Model."'>".$row->Model."</option>";
            }
            echo $output;
        }
        public function getVariant(){
            $this->load->model('drop_downhandler_model');
            $make= $this->input->get('id',true);
            $model = $this->input->get('model',true);
            //echo "controller make-".$make ;
            $districtData['variant'] = $this->drop_downhandler_model->getVariantByModel($make,$model);
            $output = null;
            echo "<option value=''>Select Variant</option>";
            foreach ($districtData['variant'] as $row){
                    if(!$row->Variant)
                    {
                        $output.="<option value=''>-</option>";
                    } else {
                        $output.="<option value='".$row->Variant."'>".$row->Variant."</option>";
                    }
            }
            echo $output;
        }
        public function getInfo(){
            function boolToText($value)
            {
                if($value)
                    return 'Yes';
                else
                    return 'No';
            }
            $this->load->model('drop_downhandler_model');
            $make= $this->input->get('id',true);
            $model = $this->input->get('model',true);
            $variant = $this->input->get('variant',true);
            //echo "controller make-".$make."-".$model."-"."$variant" ;
            $Data['bikeid'] = $this->drop_downhandler_model->getBikeid($make,$model,$variant);
            foreach($Data['bikeid'] as $row){
                $modelID = $row->modelID;
                $Data['bikedetails'] = $this->drop_downhandler_model->getBikeDetails($modelID);
            }
            $output = null;
            
            echo "<table style='width:30%'><tr style='background-color: gray;'> <th>Select </th><th>cc </th><th>AnalogMeter </th><th>DigitalMeter </th><th>Tachometer</th><th>DTSi</th><th>Kick Start</th> <th>Self Start</th> <th>Wheel Type</th> <th>Rear Brake</th><th>Front Brake</th><th>ABS</th><th>Digital Meter</th><th>Manufactured Year</th><th>Discontinued Year</th><th>Color</th></tr>";
            foreach ($Data['bikedetails'] as $row){
                $bike_id = $row->bikeID;
                $color =($row->colour);
                $color =explode(",",$color);
                //echo "Color".$color;
                $color = array_unique($color);
                $color =implode(",",$color);
                $text ="";
                if (isset($bikeId))
                {
                    if($bike_id == $bikeId)
                        echo "<input type='radio' id='bikeId' name='bikeId' value={$bike_id} onclick='this.form.submit()' checked>";
                    else 
                        echo "<input type='radio' id='bikeId' name='bikeId' onclick='this.form.submit()' value={$bike_id} >";
                }
                else
                    
                    echo "<td><input type='radio' name='bikeId' id='bikeId' value={$bike_id}  required='true'>";
                    echo "</td> <td>{$row->cc}</td><td>".boolToText($row->analogMeter)."</td><td>".boolToText($row->digitalMeter)."</td><td>".boolToText($row->tachometer).
                        "</td><td>".boolToText($row->dtsi)."</td><td>".boolToText($row->kickStart)."</td> <td>".boolToText($row->selfStart).
                        "</td> <td>$row->wheelType</td> <td>$row->rearBrakeType</td><td>".$row->frontBrakeType.
                        "</td><td>".boolToText($row->abs).
                        "</td><td>".boolToText($row->digitalMeter)."</td><td>{$row->mfgYear}</td><td>{$row->discontinuationYear}</td><td>{$color}</td></tr>";
            }
                    echo "</table>";
                    echo $output;
        }
        public function getLocationByBikeid(){
            
             $this->load->model('drop_downhandler_model');
             $this->load->model('location_handler');
             $bikeID= $this->input->get('bikeid',true);
             echo "Bikeid".$bikeID;
             $Data['location'] = $this->drop_downhandler_model->getDistinctLocFromBikeId($bikeID);
             $output = null;
             echo "<option value=''>Select Location</option>";
                foreach ($Data['location'] as $row){
                    $key = $row->locID;
                    $locations = $this->location_handler->getLocationFromId($key);
                    
                    foreach($locations as $location){
                        if(isset($locId)){
                            if ($locId == $key){
                                    echo "<option selected value={$key}>{$location->Place}</option>";

                                } else {
                                    echo "<option value={$key}>{$location->Place}</option>";
                                }
                        } else {
                              echo "<option value={$key}>{$location->Place}</option>";
                        }
                    }
                }
                echo $output;
        }       
}