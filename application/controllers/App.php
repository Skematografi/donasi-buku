<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Model_Location');
        $this->load->model('Model_Buku');
        $this->load->model('Model_Profile');
		$this->load->model('Model_Konfirmasi');
    }

    public function index(){

        $data['role_id'] = $this->session->userdata('role_id');
        $data['nav'] = 'home';
        $this->load->view('layout/header',$data);
        $data['buku_tersedia'] = $this->Model_Buku->getDonasi();
        $data['kebutuhan_buku'] = $this->Model_Buku->getKebutuhan();
        $this->load->view('index',$data);
        $this->load->view('layout/footer');

    }

    public function bukuTersedia(){

        $data['role_id'] = $this->session->userdata('role_id');
        $data['nav'] = 'tersedia';
        $this->load->view('layout/header',$data);
        $data['buku_tersedia'] = $this->Model_Buku->getDonasi();
        $this->load->view('buku_tersedia',$data);
        $this->load->view('layout/footer');

    }

    public function kebutuhanBuku(){

        $data['role_id'] = $this->session->userdata('role_id');
        $data['nav'] = 'kebutuhan';
        $this->load->view('layout/header',$data);
        $data['kebutuhan_buku'] = $this->Model_Buku->getKebutuhan();
        $this->load->view('kebutuhan_buku',$data);
        $this->load->view('layout/footer');

    }

    public function permohonan(){
        $data['role_id'] = $this->session->userdata('role_id');
        $data['nav'] = 'permohonan';
        $this->load->view('layout/header',$data);
        $this->load->view('ajukan_permohonan');
        $this->load->view('layout/footer');
    }

    public function simpanKebutuhan(){

        $config['upload_path'] = './assets/buku/';
    	$config['allowed_types'] = 'jpg|png|JPEG';
    	$config['max_size'] = 2048;

    	$this->upload->initialize($config);
		$this->load->library('upload');
		
		if (!$this->upload->do_upload('image')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Permohonan gagal dikirim</div>');
			redirect('app/permohonan');
		} else {
			$file = $this->upload->data();
			$data = [
				'image' => $file['file_name'],
				'title' => htmlspecialchars($this->input->post('title',TRUE)),
				'writer' => htmlspecialchars($this->input->post('writer',TRUE)),
				'edition' => htmlspecialchars($this->input->post('edition',TRUE)),
				'genre' => htmlspecialchars($this->input->post('genre',TRUE)),
				'pages' => htmlspecialchars($this->input->post('pages',TRUE)),
				'publisher' => htmlspecialchars($this->input->post('publisher',TRUE)),
				'year' => htmlspecialchars($this->input->post('year',TRUE)),
				'quantity' => htmlspecialchars($this->input->post('quantity',TRUE)),
				'status' => 'Kebutuhan',
				'description' => htmlspecialchars($this->input->post('description',TRUE)),
                'account_id' => $this->session->userdata('account_id')
			];
			$this->Model_Buku->simpanKebutuhan($data); //memasukan data ke database
			$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Permohonan berhasil dikirim, silahkan menunggu kontak dari donatur</div>');
			redirect('app/permohonan');

		}
    }

    public function konfirmasiKebutuhan(){

        $account_id = $this->session->userdata('account_id');
        $data['role_id'] = $this->session->userdata('role_id');

        $data['nav'] = 'donasi';
        $this->load->view('layout/header',$data);

        if($data['role_id'] == 1){
            $data['donasi'] = $this->db->query("SELECT * FROM books WHERE status = 'Kebutuhan' ")->result();
        } else {
            $data['donasi'] = $this->db->query("SELECT * FROM books WHERE account_id = '$account_id' AND status = 'Kebutuhan' ")->result();
        }

        $this->load->view('konfirmasi_kebutuhan',$data);
        $this->load->view('layout/footer');
        
    }

    public function getDonatur(){

        $phone = '62'.$this->input->post('phone');

        $data =  $this->db->query("SELECT a.* 
                                    FROM accounts a 
                                    LEFT JOIN users b ON b.id = a.user_id
                                    WHERE a.phone = '$phone' AND b.status = 1 AND b.role_id IN (1,2,3) ")->row();

        echo json_encode($data);
    }

    public function simpanKonfKebutuhan(){

        $config['upload_path'] = './assets/dokumentasi/';
    	$config['allowed_types'] = 'jpg|png|JPEG';
    	$config['max_size'] = 2048;
        $book_id = $this->input->post('book_id',TRUE);

    	$this->upload->initialize($config);
		$this->load->library('upload');
		
		if (!$this->upload->do_upload('image')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Konfirmasi gagal dikirim</div>');
			redirect('app/konfirmasiKebutuhan');
		} else {
			$file = $this->upload->data();
			$data = [
				'image' => $file['file_name'],
				'delivery_date' => $this->input->post('delivery_date',TRUE),
				'book_id' => $book_id,
				'sender_id' => htmlspecialchars($this->input->post('sender_id',TRUE)),
				'location' => $this->input->post('location',TRUE)
			];
			$this->Model_Konfirmasi->simpanKonfDonasi($data); //memasukan data ke database

            $this->db->query("UPDATE books SET status = 'Kebutuhan Selesai' WHERE id = '$book_id' ");
            
			$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Konfirmasi berhasil dikirim, kebutuhan buku anda telah dihilangkan di website</div>');
			redirect('app/konfirmasiKebutuhan');

		}
    }


    /////////////////////// Donasi

    public function donasi(){
        $data['role_id'] = $this->session->userdata('role_id');
        $data['nav'] = 'donasi';
        $this->load->view('layout/header',$data);
        $this->load->view('donasi');
        $this->load->view('layout/footer');
    }

    
    public function simpanDonasi(){

        $config['upload_path'] = './assets/buku/';
    	$config['allowed_types'] = 'jpg|png|JPEG';
    	$config['max_size'] = 2048;

    	$this->upload->initialize($config);
		$this->load->library('upload');
		
		if (!$this->upload->do_upload('image')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Donasi gagal dikirim</div>');
			redirect('app/donasi');
		} else {
			$file = $this->upload->data();
			$data = [
				'image' => $file['file_name'],
				'title' => htmlspecialchars($this->input->post('title',TRUE)),
				'writer' => htmlspecialchars($this->input->post('writer',TRUE)),
				'edition' => htmlspecialchars($this->input->post('edition',TRUE)),
				'genre' => htmlspecialchars($this->input->post('genre',TRUE)),
				'pages' => htmlspecialchars($this->input->post('pages',TRUE)),
				'publisher' => htmlspecialchars($this->input->post('publisher',TRUE)),
				'year' => htmlspecialchars($this->input->post('year',TRUE)),
				'quantity' => htmlspecialchars($this->input->post('quantity',TRUE)),
				'status' => 'Donasi',
				'description' => htmlspecialchars($this->input->post('description',TRUE)),
                'account_id' => $this->session->userdata('account_id')
			];
			$this->Model_Buku->simpanKebutuhan($data); //memasukan data ke database
			$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Donasi berhasil dikirim, silahkan menunggu kontak dari penerima donasi</div>');
			redirect('app/donasi');

		}
    }


    public function konfirmasiDonasi(){

        $account_id = $this->session->userdata('account_id');
        $data['role_id'] = $this->session->userdata('role_id');

        $data['nav'] = 'donasi';
        $this->load->view('layout/header',$data);

        if($data['role_id'] == 1){
            $data['donasi'] = $this->db->query("SELECT * FROM books WHERE status = 'Donasi' ")->result();
        } else {
            $data['donasi'] = $this->db->query("SELECT * FROM books WHERE account_id = '$account_id' AND status = 'Donasi' ")->result();
        }

        $this->load->view('konfirmasi_donasi',$data);
        $this->load->view('layout/footer');
        
    }

    public function getPenerimaDonasi(){

        $phone = '62'.$this->input->post('phone');

        $data =  $this->db->query("SELECT a.* 
                                    FROM accounts a 
                                    LEFT JOIN users b ON b.id = a.user_id
                                    WHERE a.phone = '$phone' AND b.status = 1 AND role_id IN (1,2,4) ")->row();

        echo json_encode($data);
    }

    public function simpanKonfDonasi(){

        $config['upload_path'] = './assets/dokumentasi/';
    	$config['allowed_types'] = 'jpg|png|JPEG';
    	$config['max_size'] = 2048;
        $book_id = $this->input->post('book_id',TRUE);

    	$this->upload->initialize($config);
		$this->load->library('upload');
		
		if (!$this->upload->do_upload('image')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Konfirmasi gagal dikirim</div>');
			redirect('app/konfirmasiDonasi');
		} else {
			$file = $this->upload->data();
			$data = [
				'image' => $file['file_name'],
				'delivery_date' => $this->input->post('delivery_date',TRUE),
				'book_id' => $book_id,
				'receiver_id' => htmlspecialchars($this->input->post('receiver_id',TRUE)),
				'location' => $this->input->post('location',TRUE)
			];
			$this->Model_Konfirmasi->simpanKonfDonasi($data); //memasukan data ke database

            $this->db->query("UPDATE books SET status = 'Donasi Selesai' WHERE id = '$book_id' ");
            
			$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Konfirmasi berhasil dikirim, donasi buku anda telah dihilangkan di website</div>');
			redirect('app/konfirmasiDonasi');

		}
    }


    ////////////////// Profil

    public function profile(){

        $account_id = $this->session->userdata('account_id');
        $data['role_id'] = $this->session->userdata('role_id');
        $data['nav'] = 'profile';
        $this->load->view('layout/header',$data);
        $data['profile'] = $this->Model_Profile->getProfile($account_id);
        $data['locations'] = $this->Model_Location->getState();
        $this->load->view('profile', $data);
        $this->load->view('layout/footer');

    }

}