<?php
class Refbikeshandler extends CI_Model{
    
    function getRefBikeId($make, $model , $variant){
        $sql = $this->db->query("select RefBikeId from Analytics.RefBikes where Make LIKE '".$make."' and Model LIKE '".$model."' and Variant LIKE '".$variant."'");
        //echo $query;
        $query = mysql_query($sql);
        //echo "qwofjxchdjk\\".$query."//dfhjkdfk";
        //echo "|||||".$sql."|||||";
        $result = mysql_fetch_array($query);
        $bike_id = $result['RefBikeId'];
        //echo "<br> bikeId: ".$bike_id; 
        return $bike_id;
    }

    function getBikeDetailsFromBikeId($bikeId){ 
        $query = $this->db->query("SELECT Make, Model, Variant, CategoryId, RefBikeId as BikeId from Analytics.RefBikes where RefBikeId = ".$bikeId);
        //echo $query;
        $result = mysql_fetch_array(mysql_query($query, $ANALYTICS));
        //print_r($result);
        return $result; 
    }

    function getMakes($bike_ids=null){
        if($bike_ids)
            $query = $this->db->query("SELECT DISTINCT Make from Analytics.RefBikes where RefBikeId in (".$bike_ids.")");
        else 
            $query = $this->db->query("SELECT DISTINCT Make from Analytics.RefBikes");
        //echo $query;
        $query_return = mysql_query($query, $ANALYTICS);
        $output = Array();
        while($result = mysql_fetch_array($query_return)){
            $output[] = $result[0];

        }

        //print_r($output);
        return $output;
    }
    function getModels($make=null,$bike_ids=null){
        if($bike_ids)
            $query = $this->db->query("SELECT DISTINCT Model from Analytics.RefBikes where Make = '$make' and RefBikeId in (".$bike_ids.")");
        else if($make)
            $query = $this->db->query("SELECT DISTINCT Model from Analytics.RefBikes where Make = '$make'");
        else
            $query = $this->db->query("SELECT DISTINCT Model from Analytics.RefBikes");

        $query_return = mysql_query($query, $ANALYTICS);
        $output = Array();
        while($result = mysql_fetch_array($query_return)){
            $output[] = $result[0];

        }

        //print_r($output);
        return $output;
    }
    function getVariants($make=null,$model=null,$bike_ids=null){ 
        if ($bike_ids)
            $query = $this->db->query("SELECT DISTINCT Variant, RefBikeId as BikeId from Analytics.RefBikes where Make = '$make' and Model = '$model' and RefBikeId in (".$bike_ids.")");
        else if($make && $model){
            $query = $this->db->query("SELECT DISTINCT Variant, RefBikeId as BikeId from Analytics.RefBikes where Make LIKE '$make' and Model LIKE '$model'");
        }
        else{
            if($model){
                $query = $this->db->query("SELECT DISTINCT Variant, RefBikeId as BikeId from Analytics.RefBikes where Model LIKE '$model'");
            }
            else{
                if($make){
                    $query = $this->db->query("SELECT DISTINCT Variant, RefBikeId as BikeId from Analytics.RefBikes where Make LIKE '$make'");
                }
                else{
                    //echo "<br>Make/Model not found.";
                    $query = $this->db->query("SELECT DISTINCT Variant, RefBikeId as BikeId from Analytics.RefBikes");
                }
            }
        }
        //echo "$query";
        $query_return = mysql_query($query, $ANALYTICS);
        $output = Array();
        while($result = mysql_fetch_array($query_return)){
            $output[$result['BikeId']] = $result['Variant'];
        }
        //print_r($output);
        return $output;
    }
    function insertPopularity($make,$model,$variant,$popularity){
        //echo " variant is $variant";
        $query = "UPDATE Analytics.RefBikes SET PopularityId = $popularity where Make LIKE '$make' and Model LIKE '$model' and Variant LIKE '$variant'";
        echo "$query";
        mysql_query($query,$ANALYTICS);

    }
    function getRating($bikeId){
        $query = $this->db->query("SELECT PopularityId from Analytics.RefBikes where RefBikeId = $bikeId");
        $popularity = $query->row();
        return $popularity->PopularityId;
    }

    function getMakeFromModel($model){
        $query = $this->db->query("SELECT DISTINCT Make from Analytics.RefBikes where Model LIKE '$model'");
        $query_return = mysql_query($query,$ANALYTICS);
        $result = mysql_fetch_array($query_return);
        $brand = $result[0];
        return $brand;
    }

    function getStandardVariantFromModel($model){
        $query = $this->db->query("SELECT DISTINCT Variant from Analytics.RefBikes where Model LIKE '$model' and Standard = 'std'");
        $query_return = mysql_query($query,$ANALYTICS);
        $result = mysql_fetch_array($query_return);
        $var = $result[0];
        return $var;
    }
    function getModelfromVariant($variant){
        $query = $this->db->query("SELECT DISTINCT Model from Analytics.RefBikes where Variant LIKE '$variant'");
        $query_return = mysql_query($query,$ANALYTICS);
        $result = mysql_fetch_array($query_return);
        $model = $result[0];
        return $model;
    }

    function getBikeId($make,$model,$variant){
        $query = $this->db->query("SELECT DISTINCT RefBikeId from Analytics.RefBikes where Model LIKE '$model' and Variant = '$variant'");
        $query_return = mysql_query($query,$ANALYTICS);
        $result = mysql_fetch_array($query_return);
        $b_id = $result[0];
        return $b_id;
    }
}