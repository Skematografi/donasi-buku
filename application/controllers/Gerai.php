<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerai extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index(){

        $data['products'] = $this->db->query("SELECT * FROM products WHERE status = 1")->result();
        $this->load->view('company',$data);

    }

}