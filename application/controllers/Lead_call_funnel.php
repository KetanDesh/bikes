<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Lead_call_funnel extends CI_Controller {
    public function index()
	{
            $data['title']="Lead Call funnel";
            $this->load->view('include/header',$data);
            $this->load->view('lead_call_funnel_view');
	}
        function get_type(){
            $this->load->model('crm/lead_call_funnel_model');
            $Data['type'] = $this->lead_call_funnel_model->GetType();
            $output = null;
            echo "<option value=''>Select Type</option>";
            foreach ($Data['type'] as $row){
                $output.="<option value='".$row->queryType."'>".$row->queryType."</option>";
            }
            echo $output;
        }
        public function download(){
            error_reporting(0);
            $this->load->helper('csv');
            $this->load->model('crm/lead_call_funnel_model');
//            $data['title']="Lead Call funnel";
//            $this->load->view('include/header',$data);
//            $this->load->view('lead_call_funnel_view');
            $leadCallData = array();

            //$fh = @fopen( 'php://output', 'w' );
            $start_data = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $type =  $this->input->post('type');
            $distinct_source = $this->lead_call_funnel_model->distinct_source();
            //print_r($distinct_source);
            $first_iteration = 1;
            $rows = array(array());
            $rows[0][0] = 'sources';
            $row_count =0;
            foreach ($distinct_source as $row){
                $source = (string)($row->Source);
                $rows[][0] = $source;
                $getQueries = $this->lead_call_funnel_model->get_query($type);

                if($first_iteration)
                {
                    $first_iteration =0;
                    foreach ($getQueries as $getQuery){
                        $columnName = $getQuery->columnName;
                        //echo $columnName;
                       $rows[$row_count][] = $columnName; 
                    
                    }
                    $row_count = $row_count +1;
                    continue;
                }
                foreach ($getQueries as $getQuery){
                        $sqlQuery = $getQuery->sqlQuery;
                        //echo $columnName;
                       $rows[$row_count][] = $this->lead_call_funnel_model->main_query($sqlQuery,$source,$start_data,$end_date);
                    
                    }
                              $row_count = $row_count +1;
                
            }
            //print_r($first_row);
            $list = array (
                    array('aaa', 'bbb', 'ccc', 'dddd'),
                    array('123', '456', '789'),
                    array('"aaa"', '"bbb"')
                );
            array_to_csv($rows,'toto.csv');
            //fputcsv($fh, $first_row);
            //fclose($fh);
                            

               
        
        }

}
  
  /*              $source = $row->Source;
                $getQueries = $this->lead_call_funnel_model->get_query($type);
                foreach ($getQueries as $getQuery){
                    $columnName = $getQuery->columnName;
                    $sqlQuery = $getQuery->sqlQuery;
                    
                    $mainQueries[$columnName] = $this->lead_call_funnel_model->main_query($columnName,$sqlQuery,$source,$start_data,$end_date);
                    
                    
                    //$leadCallData = $leadCallData;
                    //print_r($leadCallData);
                $this->load->helper('csv');
                print_r($mainQueries);
                array_to_csv($mainQueries[$columnName],'toto.csv');
                }
                array_push($leadCallData,$mainQueries);
                array_push($leadCallData,$source);
                print_r($leadCallData);
            }
            
            
        }
        
        
}*/
?>
