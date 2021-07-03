<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Location extends CI_Model {

	public function getState()
    {   
        $query = $this->db->query("SELECT state, state_id FROM locations GROUP BY state_id");
        return $query->result_array();
    }

    public function getCity($state_id){
        $query = $this->db->query("SELECT CONCAT(state_type,' ', city) as full_city, city, city_id FROM locations WHERE state_id = '".$state_id."' GROUP BY city_id");
        return $query->result_array();
    }

    public function getDistrict($city_id){
        $query = $this->db->query("SELECT district, district_id FROM locations WHERE city_id = '".$city_id."'");
        return $query->result_array();
    }

    public function generateRandomString($length = 10) {
        $characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
 
}
