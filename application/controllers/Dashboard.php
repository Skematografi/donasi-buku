<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Model_Buku');
        $this->load->model('Model_Profile');
		$this->load->model('Model_Konfirmasi');
	}

	public function index()
	{
		$this->session->set_userdata(['sidebar' => 'dashboard']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');

		$data['donatur']=$this->db->query('SELECT COUNT(a.id) as total FROM accounts a 
											LEFT JOIN users b ON b.id = a.user_id
											WHERE a.status = 1 AND b.role_id = 3')->row();
		$data['penerima']=$this->db->query('SELECT COUNT(a.id) as total FROM accounts a 
											LEFT JOIN users b ON b.id = a.user_id
											WHERE a.status = 1 AND b.role_id = 4')->row();
		$data['donasi']=$this->db->query("SELECT COUNT(id) as total FROM books WHERE status = 'Donasi'")->row();
		$data['kebutuhan']=$this->db->query("SELECT COUNT(id) as total FROM books WHERE status = 'Kebutuhan'")->row();
		$this->load->view('dashboard/index',$data);
		$this->load->view('dashboard/footer');
			
	}

	public function donatur()
	{
		$this->session->set_userdata(['sidebar' => 'donatur']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$data['role_id'] = $this->session->userdata('role_id');
		$data['donatur']=$this->db->query('SELECT a.* FROM accounts a 
											LEFT JOIN users b ON b.id = a.user_id
											WHERE a.status = 1 AND b.role_id = 3')->result_array();
		$this->load->view('dashboard/donatur',$data);
			
	}

	public function penerima()
	{
		$this->session->set_userdata(['sidebar' => 'penerima']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$data['role_id'] = $this->session->userdata('role_id');
		$data['penerima']=$this->db->query('SELECT a.* FROM accounts a 
											LEFT JOIN users b ON b.id = a.user_id
											WHERE a.status = 1 AND b.role_id = 4')->result_array();
		$this->load->view('dashboard/penerima',$data);
			
	}

	public function deleteDonatur($id){
		$this->db->query("UPDATE accounts SET status = 0 WHERE id = '$id' ");
		$this->db->query("UPDATE users SET status = 0 WHERE id = '$id' ");
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Donatur berhasil dihapus</div>');
		redirect('dashboard/donatur');
	}

	public function deletePenerima($id){
		$this->db->query("UPDATE accounts SET status = 0 WHERE id = '$id' ");
		$this->db->query("UPDATE users SET status = 0 WHERE id = '$id' ");
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Penerima donasi berhasil dihapus</div>');
		redirect('dashboard/penerima');
	}
	

	public function donasi()
	{
		$this->session->set_userdata(['sidebar' => 'donasi']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');

		$data['donasi']=$this->db->query("SELECT a.*,
										(SELECT b.name FROM accounts b WHERE b.id = a.account_id) as donatur
										FROM books a 
										WHERE a.status LIKE 'Donasi%'
										ORDER BY a.status")->result_array();
		$this->load->view('dashboard/donasi',$data);
			
	}

	public function kebutuhan()
	{
		$this->session->set_userdata(['sidebar' => 'kebutuhan']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');

		$data['kebutuhan']=$this->db->query("SELECT a.*,
										(SELECT b.name FROM accounts b WHERE b.id = a.account_id) as penerima
										FROM books a 
										WHERE a.status LIKE 'Kebutuhan%'
										ORDER BY a.status")->result_array();
		$this->load->view('dashboard/kebutuhan',$data);
			
	}

	public function laporan()
	{
		$this->session->set_userdata(['sidebar' => 'laporan']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');

		$data['kebutuhan']=$this->db->query("SELECT a.*,
										(SELECT b.name FROM accounts b WHERE b.id = a.account_id) as penerima
										FROM books a 
										WHERE a.status LIKE 'Kebutuhan%'
										ORDER BY a.status")->result_array();
		$this->load->view('dashboard/laporan',$data);
			
	}

	public function cetakLaporan(){

		$category = $this->input->post('category');
		$status = $this->input->post('status');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$a = new DateTime($start_date);
        $a->modify("+1 day");
        $start = $a->format("Y-m-d");

		$b = new DateTime($end_date);
        $b->modify("+1 day");
        $end = $b->format("Y-m-d");

		if($a > $b){
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Tanggal mulai harus kurang dari tanggal akhir</div>');
			redirect('dashboard/laporan');
		}

		$sql = "SELECT a.*, 
		(SELECT b.name FROM accounts b WHERE b.id = a.account_id) as account_name,
		c.delivery_date, c.location,
		(SELECT b.name FROM accounts b WHERE b.id = c.sender_id) as sender,
		(SELECT b.phone FROM accounts b WHERE b.id = c.sender_id) as sender_phone,
		(SELECT b.name FROM accounts b WHERE b.id = c.receiver_id) as receiver,
		(SELECT b.phone FROM accounts b WHERE b.id = c.receiver_id) as receiver_phone
		FROM books a
		LEFT JOIN confirmations c ON c.book_id = a.id
		WHERE a.status = '$status' AND (a.created_at BETWEEN '$start' AND '$end')";


		$data['report'] = $this->db->query($sql)->result_array();
		$data['start'] = $a;
		$data['end'] = $b;
		$data['jenis_buku'] = ($category == 'Donasi' ? 'Buku Donasi' : 'Kebutuhan Buku');

		switch($status){
			case 'Donasi':
				$status_buku = 'Masih Tersedia';
				break;
			case 'Donasi Selesai':
				$status_buku = 'Tidak ada';
				break;
			case 'Kebutuhan':
				$status_buku = 'Belum Terpenuhi';
				break;
			case 'Kebutuhan Selesai':
				$status_buku = 'Sudah Terpenuhi';
				break;
			default:
				$status_buku = 'Tidak ada';
		}

		$data['status_buku'] = $status_buku;

		// var_dump($data); die();

		$this->load->library('pdf');
        $html = $this->load->view('dashboard/laporanPdf', $data, true);
        $this->pdf->createPDF($html, 'mypdf', false);
	}

}
