<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Location');
    }

    public function getCityByState(){

        $state_id = $this->input->post('state_id');
        $data = $this->Model_Location->getCity($state_id);

        echo json_encode($data);
    }

    public function getDistrictByCity(){

        $city_id = $this->input->post('city_id');
        $data = $this->Model_Location->getDistrict($city_id);

        echo json_encode($data);
    }

}