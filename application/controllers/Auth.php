<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model_Location');

	}

	public function index()
	{
		$this->form_validation->set_rules('email','trim|required');
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
	    $email = $this->input->post('email');  
	    $password = $this->input->post('password'); 

	    $user = $this->db->query("SELECT a.email,a.password,a.role_id, b.name, b.id,b.user_id FROM users a
									LEFT JOIN accounts b ON b.user_id = a.id
									WHERE a.status = 1 AND a.email = '".$email."'")->row_array();

	    if($user){

	    		if(password_verify($password,$user['password'])){
	    			$data = [
	    				'account_id' => $user['id'],
	    				'user_id' => $user['user_id'],
	    				'email' => $user['email'],
	    				'name' => $user['name'],
						'role_id' => $user['role_id']

	    			];

					$this->session->set_userdata($data);
					if($user['role_id'] == 1 || $user['role_id'] == 2){
						redirect('dashboard');
					} else {
						redirect('app');
					}
	    			
	    		}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password salah!</div>');
	    			redirect('auth');
	    		}

	    }else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>email tidak ditemukan!</div>');
	    	redirect('auth');
	    }

	}

	
	public function registerDonatur()
	{
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password1','Password','trim|required');
		$this->form_validation->set_rules('password2','Password Confirmation','trim|required');

		if($this->form_validation->run() == false){
			$data['locations'] = $this->Model_Location->getState();
			$this->load->view('auth/auth_header');
			$this->load->view('auth/register_donatur',$data); 
			$this->load->view('auth/auth_footer');
		}else{
			//validasi sukses
			$this->_process();
		}

	}

	public function registerPenerima()
	{
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password1','Password','trim|required');
		$this->form_validation->set_rules('password2','Password Confirmation','trim|required');

		if($this->form_validation->run() == false){
			$data['locations'] = $this->Model_Location->getState();
			$this->load->view('auth/auth_header');
			$this->load->view('auth/register_penerima',$data); 
			$this->load->view('auth/auth_footer');
		}else{
			//validasi sukses
			$this->_process();
		}

	}

	private function _process()
	{	
		$npm = $this->input->post('npm');
		$role = $this->input->post('role');
		$status = $this->input->post('status');
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$phone = $this->input->post('phone');  
		$email = $this->input->post('email');  
		$state = $this->input->post('state');  
		$city = $this->input->post('city');  
		$district = $this->input->post('district');  
		$address = $this->input->post('address');  
	    $password1 = $this->input->post('password1'); 
	    $password2 = $this->input->post('password2');

		if(strlen($password1) < 8 && $npm == ''){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password minimal 8 karakter!</div>');
			redirect('auth/registerPenerima');
		}

		if(strlen($password1) < 8 && $npm != ''){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password minimal 8 karakter!</div>');
			redirect('auth/registerDonatur');
		}

	    $email_user = $this->db->get_where('users', ['email' => $email])->row_array();
	    $email_member = $this->db->get_where('accounts', ['email' => $email])->row_array();
	    $check_phone = $this->db->get_where('accounts', ['phone' => $phone])->row_array();

		if($check_phone){

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nomor telepon sudah terdaftar!</div>');
			if($npm == ''){
				redirect('auth/registerPenerima');
			} else {
				redirect('auth/registerDonatur');
			}

		}

	    if($email_user || $email_member){

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email sudah terdaftar!</div>');
			if($npm == ''){
				redirect('auth/registerPenerima');
			} else {
				redirect('auth/registerDonatur');
			}

		}else{

	    	if($password1 != $password2){
	    		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak sama!</div>');
	    		if($npm == ''){
					redirect('auth/registerPenerima');
				} else {
					redirect('auth/registerDonatur');
				}

	    	}else{

	    		$data_user = array(
					'email' => $email,
					'role_id' => $role,
					'password' => password_hash($password1, PASSWORD_BCRYPT)
				);

				$this->db->insert('users',$data_user);
				$insert_id = $this->db->insert_id();

				$data_account = array(
					'user_id' => $insert_id,
					'npm' => $npm,
					'type' => ($status == '' ? 'Mahasiswa' : $status),
					'name' => $name,
					'email' => $email,
					'gender' => $gender,
					'phone' => '62'.$phone,
					'state' => $state,
					'city' => $city,
					'district' => $district,
					'address' => $address
				);

				$this->db->insert('accounts',$data_account);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran berhasil, silahkan masuk.</div>');
				redirect('auth');
			}
	    }	
	}

	
	public function update()
	{	
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$phone = $this->input->post('phone');  
		$email = $this->input->post('email');  
		$state = $this->input->post('state');  
		$city = $this->input->post('city');  
		$district = $this->input->post('district');  
		$address = $this->input->post('address');  
		$user_id = $this->session->userdata('user_id');
		$account_id = $this->session->userdata('account_id');

	    $email_user = $this->db->query("SELECT * FROM users WHERE email = '$email' AND id <> '$user_id' ")->row_array();
	    $email_member = $this->db->query("SELECT * FROM accounts WHERE email = '$email' AND id <> '$account_id' ")->row_array();
	    $check_phone = $this->db->query("SELECT * FROM accounts WHERE phone = '62$phone' AND id != '$account_id' ")->row_array();

		if($check_phone){

			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Nomor telepon sudah terdaftar!</div>');
			redirect('app/profile');

		}

	    if($email_user || $email_member){

			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email sudah terdaftar!</div>');
			redirect('app/profile');

		}else{

	    	$data_user = array(
				'email' => $email
			);

			$this->db->where(['id' => $user_id]);
			$this->db->update('users', $data_user);

			$data_account = array(
				'name' => $name,
				'email' => $email,
				'gender' => $gender,
				'phone' => '62'.$phone,
				'state' => $state,
				'city' => $city,
				'district' => $district,
				'address' => $address
			);

			$this->db->where(['id' => $account_id]);
			$this->db->update('accounts', $data_account);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Profile berhasil diupdate.</div>');
			redirect('app/profile');
	    }	
	}


	public function logout()
	{
		$this->session->unset_userdata('account_id');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('role_id');
		redirect('app');
	}

	public function forget_password(){
		$this->load->view('auth/auth_header');
		$this->load->view('auth/forgot_password'); 
		$this->load->view('auth/auth_footer');
	}

	public function reset_password(){
		$email = $this->input->post('email');

		$check_email = $this->db->query("SELECT a.*, b.name
										FROM users a 
										LEFT JOIN accounts b ON b.user_id = a.id
										WHERE a.email = '$email' AND a.role_id IN (3,4)")->row();

		if(!$check_email){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
			redirect('auth/forget_password');
		}
		
		$create_pwd = $this->Model_Location->generateRandomString(8);
		$password = password_hash($create_pwd, PASSWORD_BCRYPT);

		$update_user = $this->db->query("UPDATE users SET password = '$password' WHERE  id = '$check_email->id' ");

		if($update_user){

			$data = [
				'email' => $check_email->email,
				'password' => $create_pwd,
				'name' => $check_email->name
			];

			$this->sendEmail($data);

			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Password baru telah dikirim ke email anda.</div>');
			redirect('auth/forget_password');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password gagal diperbarui!</div>');
			redirect('auth/forget_password');
		}


	}

	function sendEmail($data){

        $this->email->from('admin@gudangbuku.com', 'Gudang Buku');

		$this->email->to($data['email']);
 
		$this->email->subject('Password Baru');
        
        $this->email->message($this->load->view('reset_password',$data, true));

		$this->email->set_mailtype('html');

		$this->email->send();
    }

}
