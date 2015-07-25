<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PriceMatrix extends CI_Controller {

	/**Countries
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
            $this->load->model('cities_countries_model');
            $data['countryDrop'] = $this->cities_countries_model->getCountries();
            $this->load->view('dealerPriceMatrix',$data);
	}
        public function buildDropCities(){
            $this->load->model('cities_countries_model');
            echo $id_country = $this->input->post('id',true);
            $districtData['districtDrop'] = $this->cities_countries_model->getCityByCountry($id_country);
            $output = null;
            foreach ($districtData['districtDrop'] as $row){
                $output.="<option value='".$row->sub_name."'>".$row->sub_name."</option>";
            }
            echo $output;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */