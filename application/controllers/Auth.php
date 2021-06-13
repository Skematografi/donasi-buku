<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run() == false){
			$this->load->view('auth/auth_header');
			$this->load->view('auth/login'); 
			$this->load->view('auth/auth_footer');
		}else{
			//validasi sukses
			$this->_login();
		}
	}


	private function _login(){
	    $username = $this->input->post('username');  
	    $password = $this->input->post('password'); 

	    $user = $this->db->query("SELECT * FROM users a
									WHERE a.status = 1 AND a.username = '".$username."'")->row_array();

	    if($user){

	    		if(password_verify($password,$user['password'])){
	    			$data = [
	    				'username' => $user['username'],
	    				'password' => $user['password'],
	    				'full_name' => $user['full_name'],
						'role_id' => $user['role_id']

	    			];

					$this->session->set_userdata($data);
					
					redirect('dashboard');
	    			
	    		}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password salah!</div>');
	    			redirect('auth');
	    		}

	    }else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>username tidak ditemukan!</div>');
	    	redirect('auth');
	    }

	}


	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('full_name');
		$this->session->unset_userdata('role_id');
		redirect('auth');
	}

}
