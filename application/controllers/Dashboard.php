<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Model_Produk');
		$this->load->model('Model_Siaran');
		$this->load->model('Model_Pelanggan');
		$this->load->model('Model_Location');
		$this->load->model('Model_Complaint');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->session->set_userdata(['sidebar' => 'dashboard']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');

		// $data['pesanan']=$this->db->query("SELECT COUNT(id) as total FROM orders WHERE status = 'Menunggu Verifikasi' AND evidence_transfer IS NOT NULL")->row();
		// $data['penjualan']=$this->db->query("SELECT COUNT(id) as total FROM orders WHERE status = 'Selesai' AND resi IS NOT NULL")->row();
		// $data['produk']=$this->db->query('SELECT COUNT(id) as total FROM products WHERE status = 1')->row();
		// $data['pelanggan']=$this->db->query("SELECT COUNT(id) as total FROM members WHERE status = 1 AND email != 'admin@gmail.com'")->row();
		$this->load->view('dashboard/index');
		$this->load->view('dashboard/footer');
			
	}


	//Produk ========================================================

	public function produk()
	{
		$this->session->set_userdata(['sidebar' => 'produk']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$this->load->view('dashboard/modal_product');
		$data['products']= $this->getDatatableProduct();
		$this->load->view('dashboard/produk',$data);	
	}

    public function do_upload(){

    	$config['upload_path'] = './assets/produk/';
    	$config['allowed_types'] = 'jpg|png|JPEG';
    	$config['max_size'] = 2048;

    	$this->upload->initialize($config);
		$this->load->library('upload');

		$id = $this->input->post('product_id',TRUE);

		if(strlen($id) == 0){
			//Proses penyimpanan data
			if (!$this->upload->do_upload('image')) {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Produk gagal di tambah</div>');
				redirect('dashboard/produk');
			} else {
				$file = $this->upload->data();
				$data = ['image' => $file['file_name'],
					'code' => strtoupper($this->input->post('code',TRUE)),
					'name' => htmlspecialchars($this->input->post('name',TRUE)),
					'category' => htmlspecialchars($this->input->post('category',TRUE)),
					'description' => htmlspecialchars($this->input->post('description',TRUE)),
					'price' => $this->input->post('price',TRUE),
					'size' => strtoupper($this->input->post('size',TRUE)),
					'weight' => $this->input->post('weight',TRUE),
					'stock' => $this->input->post('stock',TRUE)
				];
				$this->Model_Produk->tambah_produk($data); //memasukan data ke database
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Produk berhasil di tambah</div>');
				redirect('dashboard/produk');

			}

		} else {
			//Proses update data
			if($_FILES['image']['size'] == 0){	
				$data = [
					'name' => htmlspecialchars($this->input->post('name',TRUE)),
					'category' => htmlspecialchars($this->input->post('category',TRUE)),
					'description' => htmlspecialchars($this->input->post('description',TRUE)),
					'price' => $this->input->post('price',TRUE),
					'size' => strtoupper($this->input->post('size',TRUE)),
					'weight' => $this->input->post('weight',TRUE),
					'stock' => $this->input->post('stock',TRUE)
				];
				$this->Model_Produk->update($id, $data); //memasukan data ke database
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Produk berhasil di update dengan gambar sebelumnya</div>');
				redirect('dashboard/produk');

			} else {
				if (!$this->upload->do_upload('image')){
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Produk gagal di update</div>');
					redirect('dashboard/produk');
				} else {
					$file = $this->upload->data();
					$data = ['image' => $file['file_name'],
						'name' => htmlspecialchars($this->input->post('name',TRUE)),
						'category' => htmlspecialchars($this->input->post('category',TRUE)),
						'description' => htmlspecialchars($this->input->post('description',TRUE)),
						'price' => $this->input->post('price',TRUE),
						'size' => strtoupper($this->input->post('size',TRUE)),
						'weight' => $this->input->post('weight',TRUE),
						'stock' => $this->input->post('stock',TRUE)
					];
					$this->Model_Produk->update($id, $data); //memasukan data ke database
					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Produk berhasil di update dengan gambar baru</div>');
					redirect('dashboard/produk');
	
				}
			}

		}

		
  	}

	public function hapus_produk(){
		$id = $this->input->post('id',TRUE);

		$this->Model_Produk->hapus($id, ["status" => 0]);
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Produk berhasil di hapus</div>');

		echo json_encode(['link' =>'Dashboard/produk']);
	}

	public function edit_produk(){
		$id = $this->input->post('id',TRUE);
		$data = $this->Model_Produk->getProductById($id);
		echo json_encode($data);
	}	

	
	//Member ========================================================

	public function member()
	{
		$this->session->set_userdata(['sidebar' => 'member']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$locations = $this->Model_Location->getState();
		$this->load->view('dashboard/modal_member',['locations' => $locations]);
		$data['members']= $this->getDatatableMember();
		$this->load->view('dashboard/pelanggan',$data);	
	}
	
    public function tambah_member(){

		$id = $this->input->post('member_id',TRUE);
		$phone = $this->input->post('phone',TRUE);
		$email = $this->input->post('email',TRUE);
									
		//Proses penyimpanan data	
		if(strlen($id) == 0){
				$data = [
					'code' => $this->generateRandomString(6),
					'name' => htmlspecialchars($this->input->post('name',TRUE)),
					'gender' => $this->input->post('gender',TRUE),
					'phone' => $this->input->post('phone',TRUE),
					'email' => $this->input->post('email',TRUE),
					'state' => $this->input->post('state',TRUE),
					'city' => $this->input->post('city',TRUE),
					'district' => $this->input->post('district',TRUE),
					'postal_code' => $this->input->post('postal_code',TRUE),
					'address' => $this->input->post('address',TRUE)
				];

				$check_phone = $this->db->query("SELECT * FROM members WHERE phone = '$phone'")->num_rows();
				$check_email = $this->db->query("SELECT * FROM members WHERE email = '$email '")->num_rows();

				if($check_phone == 0 && $check_email == 0){
					$this->Model_Pelanggan->tambah($data); //memasukan data ke database
					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Member berhasil di simpan</div>');
				} else if($check_email > 0){
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email sudah terdaftar</div>');
				} else if($check_phone > 0){
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Telepon sudah terdaftar</div>');
				}

		} else {

			$data = [
				'name' => htmlspecialchars($this->input->post('name',TRUE)),
				'gender' => $this->input->post('gender',TRUE),
				'phone' => $this->input->post('phone',TRUE),
				'email' => $this->input->post('email',TRUE),
				'state' => $this->input->post('state',TRUE),
				'city' => $this->input->post('city',TRUE),
				'district' => $this->input->post('district',TRUE),
				'postal_code' => $this->input->post('postal_code',TRUE),
				'address' => $this->input->post('address',TRUE)
			];

			$check_phone = $this->db->query("SELECT * FROM members WHERE phone = '$phone' AND id != '$id'")->num_rows();
			$check_email = $this->db->query("SELECT * FROM members WHERE email = '$email' AND id != '$id'")->num_rows();

			if($check_phone == 0 && $check_email == 0){
				$this->Model_Pelanggan->update($id, $data); //memasukan data ke database
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Member berhasil di update</div>');
			} else if($check_email > 0){
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email sudah terdaftar</div>');
			} else if($check_phone > 0){
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Telepon sudah terdaftar</div>');
			}
			
		}

		redirect('dashboard/member');
		
  	}

	function generateRandomString($length = 10) {
		$characters = '23456789BCDEFGHJKLMNPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function edit_member(){
		$id = $this->input->post('id',TRUE);
		$data = $this->Model_Pelanggan->getMemberById($id);
		echo json_encode($data);
	}	

	public function hapus_member(){
		$id = $this->input->post('id',TRUE);
		$this->Model_Pelanggan->hapus($id, ["status" => 0]);
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Member berhasil di hapus</div>');

		echo json_encode(['link' =>'Dashboard/member']);
	}

	//Keluhan ========================================================

	public function keluhan()
	{
		$this->session->set_userdata(['sidebar' => 'keluhan']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$new['member'] = $this->Model_Pelanggan->getData();
		$new['product'] = $this->Model_Produk->getData();
		$this->load->view('dashboard/modal_keluhan',$new);
		$this->load->view('dashboard/modal_tindakan');
		$data['complaints']= $this->getDatatableComplaint();
		$this->load->view('dashboard/keluhan',$data);	
	}

	public function tambah_keluhan(){

		$data = [
			'member_id' => $this->input->post('member_id'),
			'informer' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'description' => $this->input->post('description'),
			'category' => $this->input->post('category'),
			'created_at' =>  $this->input->post('created_at').' '.date('H:m:s'),
		];

		$this->Model_Complaint->tambah($data);

		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Keluhan berhasil di simpan</div>');

		redirect('dashboard/keluhan');

	}

	public function prosesKeluhan(){

		$id = $this->input->post('id',TRUE);

		$this->sendEmailProcess($id);

		$this->db->query("UPDATE complaints SET status = 'Proses' WHERE id = '$id' ");

		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>E-Mail proses keluhan berhasil terkirim ke pelapor</div>');

		echo json_encode(['link' =>'Dashboard/keluhan']);


	}

	
	public function selesaiKeluhan(){

		$id = $this->input->post('complaint_id',TRUE);
		$action = $this->input->post('action',TRUE);
		$today = date('Y-m-d H:m:s');

		$this->db->query("UPDATE complaints SET status = 'Selesai', action = '$action', action_date = '$today' WHERE id = '$id' ");
		
		$this->sendEmailSelesai($id);

		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>E-Mail konfirmasi keluhan selesai berhasil terkirim ke pelapor</div>');

		redirect('dashboard/keluhan');


	}


	//Siaran ========================================================

	public function siaran()
	{
		$this->session->set_userdata(['sidebar' => 'siaran']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$this->load->view('dashboard/modal_siaran');
		$data['broadcast'] = $this->getDatatableSiaran();
		$this->load->view('dashboard/siaran',$data);	
	}

	public function tambah_siaran(){

    	$config['upload_path'] = './assets/siaran/';
    	$config['allowed_types'] = 'jpg|png|JPEG';
    	$config['max_size'] = 2048;

    	$this->upload->initialize($config);
		$this->load->library('upload');
		
		if (!$this->upload->do_upload('image')) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Siaran gagal di tambah</div>');
			redirect('dashboard/siaran');
		} else {
			$file = $this->upload->data();
			$data = [
				'image' => $file['file_name'],
				'title' => htmlspecialchars($this->input->post('title',TRUE)),
				'description' => htmlspecialchars($this->input->post('description',TRUE))
			];
			$this->Model_Siaran->tambah_siaran($data); //memasukan data ke database
			$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Siaran berhasil di tambah</div>');
			redirect('dashboard/siaran');

		}

		
  	}

	public function hapus_siaran(){
		$id = $this->input->post('id',TRUE);
		$this->db->query("UPDATE broadcasts SET status = 0 WHERE id = '$id' ");
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Siaran berhasil di hapus</div>');

		echo json_encode(['link' =>'Dashboard/siaran']);
	}

	public function kirim_siaran(){
		$id = $this->input->post('id',TRUE);
		$member = $this->db->query("SELECT * FROM members WHERE status = 1")->num_rows();
		$after_repeat = $this->db->query("SELECT a.repeat FROM broadcasts a WHERE a.id = '$id' ")->row();
		$repeat = (int) $after_repeat->repeat + 1;

		$this->sendEmailSiaran($id);

		$this->db->query("UPDATE broadcasts a SET a.receiver = '$member', a.repeat = '$repeat' WHERE a.id = '$id' ");
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Siaran berhasil di dikirim ke member</div>');

		echo json_encode(['link' =>'Dashboard/siaran']);
	}

	//Datatable Collection ========================================================

	public function getDatatableProduct()
	{   

		$products = $this->Model_Produk->getData();
		$data = array();
		foreach($products as $row) {
			$data[] = [
				"code" => $row['code'],
				"name" => $row['name'],
				"description" => $row['description'],
				"category" => $row['category'],
				"image" => $row['image'],
				"weight" => $row['weight'],
				"size" => $row['size'],
				"price" => $row['price'],
				"stock" => $row['stock'],
				"action" => '<a href="javascript:void(0);" title="Klik untuk melakukan perubahan" data-id="'.$row['id'].'" class="mr-1" onclick="editProduct(this)"><i class="far fa-edit text-primary"></i></a><a href="javascript:void(0);" title="Klik untuk menghapus" data-id="'.$row['id'].'" onclick="deleteProduct(this)"><i class="far fa-trash-alt text-danger"></i></a>'
			];
		}

        return $data;
	}

	public function getDatatableMember()
	{   

		$products = $this->Model_Pelanggan->getData();
		$data = array();
		foreach($products as $row) {
			$data[] = [
				"code" => $row['code'],
				"name" => $row['name'],
				"email" => $row['email'],
				"phone" => $row['phone'],
				"gender" => $row['gender'],
				"address" => $row['address'],
				"state" => $row['state'],
				"city" => $row['city'],
				"district" => $row['district'],
				"action" => '<a href="javascript:void(0);" title="Klik untuk melakukan perubahan" data-id="'.$row['id'].'" class="mr-1" onclick="editPromo(this)"><i class="far fa-edit text-primary"></i></a><a href="javascript:void(0);" title="Klik untuk menghapus" data-id="'.$row['id'].'" onclick="deletePromo(this)"><i class="far fa-trash-alt text-danger"></i></a>'
			];
		}

        return $data;
	}

	public function getDatatableComplaint()
	{   

		$complaints = $this->Model_Complaint->getData();
		$data = array();
		foreach($complaints as $row) {

			if($row['status'] == 'Menunggu Tindakan'){
				$status = '<div class="badge badge-secondary">'.$row['status'].'</div>';
				$response = '<a href="javascript:void(0);" title="Klik untuk memproses keluhan" data-id="'.$row['id'].'" class="mr-3" onclick="proses(this)"><i class="fas fa-spinner text-secondary"></i></a><a href="javascript:void(0);" title="Klik untuk memberi tindakan" data-id="'.$row['id'].'" onclick="selesai(this)"><i class="far fa-check-square text-success"></i></a>';
			} else if($row['status'] == 'Proses'){
				$status = '<div class="badge badge-warning">'.$row['status'].'</div>';
				$response = '<a href="javascript:void(0);" title="Klik untuk memberi tindakan" data-id="'.$row['id'].'" onclick="selesai(this)"><i class="far fa-check-square text-success"></i></a>';
			} else {
				$status = '<div class="badge badge-success">'.$row['status'].'</div>';
				$response = '';
			}

			$data[] = [
				"category" => $row['category'],
				"description" => 'Deskripsi :<br><b>'.$row['description'].'</b><br>Produk :<br><b>'.($row['product'] == NULL ? '-' : $row['product']).'</b>',
				"informer" => 'Nama : <br><b>'.$row['informer'].'</b><br>ID Member : <br><b>'.($row['member_id'] == NULL ? '-' : $row['member_id']).'</b><br>Email : <br><b>'.$row['email'].'</b>',
				"action" => 'Deskripsi : <br><b>'.($row['action'] == NULL ? '-' : $row['action']).'</b><br>Tgl. Tindakan :<br><b>'.($row['action_date'] == NULL ? '-' : $row['action_date']).'</b>',
				"status" => $status,
				"created_at" => $row['created_at'],
				"response" => $response
			];
		}

        return $data;
	}

	public function getDatatableSiaran()
	{   

		$broadcasts = $this->Model_Siaran->getData();
		$data = array();
		foreach($broadcasts as $row) {

			$data[] = [
				"title" => $row['title'],
				"image" => $row['image'],
				"description" => $row['description'],
				"repeat" => $row['repeat'],
				"receiver" => $row['receiver'],
				"action" =>'<a href="javascript:void(0);" title="Klik hapus siaran" data-id="'.$row['id'].'" class="mr-3" onclick="hapusSiaran(this)"><i class="fas fa-trash text-danger"></i></a><a href="javascript:void(0);" title="Klik untuk mengirim siaran" data-id="'.$row['id'].'" onclick="kirimSiaran(this)"><i class="far fa-send text-primary"></i></a>'
			];
		}

        return $data;
	}

	//Send Email to Member
	function sendEmailProcess($id){

		$getComplaint = $this->db->query("SELECT a.*,
										(SELECT b.name FROM products b WHERE b.id = a.product_id) as product
										FROM complaints a WHERE a.id = '$id' ")->row();

        $this->email->from('admin@geraifashion.com', 'Gerai Fashion');

		$this->email->to($getComplaint->email);
 
		$this->email->subject('Gerai Fashion');
        
        $this->email->message($this->load->view('template_email/proses',$getComplaint, true));

		$this->email->set_mailtype('html');

		$this->email->send();
    }

	function sendEmailSelesai($id){

		$getComplaint = $this->db->query("SELECT a.*,
										(SELECT b.name FROM products b WHERE b.id = a.product_id) as product
										FROM complaints a WHERE a.id = '$id' ")->row();

        $this->email->from('admin@geraifashion.com', 'Gerai Fashion');

		$this->email->to($getComplaint->email);
 
		$this->email->subject('Gerai Fashion');
        
        $this->email->message($this->load->view('template_email/selesai',$getComplaint, true));

		$this->email->set_mailtype('html');

		$this->email->send();
    }

	function sendEmailSiaran($id){

		$broadcast = $this->db->query("SELECT * FROM broadcasts WHERE id = '$id' ")->row();

		$members = $this->db->query("SELECT * FROM members WHERE status = 1 ")->result();

		foreach($members as $row){

			$this->email->from('admin@geraifashion.com', 'Gerai Fashion');
	
			$this->email->to($row->email);
	 
			$this->email->subject($broadcast->title);
			
			$this->email->message($this->load->view('template_email/siaran',$broadcast, true));
	
			$this->email->set_mailtype('html');
	
			$this->email->send();
		}

    }

}
