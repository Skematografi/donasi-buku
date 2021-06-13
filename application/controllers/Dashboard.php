<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Model_Order');
		$this->load->model('Model_Produk');
		$this->load->model('Model_Promo');
		$this->load->model('Model_Pelanggan');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->session->set_userdata(['sidebar' => 'dashboard']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');

		$data['pesanan']=$this->db->query("SELECT COUNT(id) as total FROM orders WHERE status = 'Menunggu Verifikasi' AND evidence_transfer IS NOT NULL")->row();
		$data['penjualan']=$this->db->query("SELECT COUNT(id) as total FROM orders WHERE status = 'Selesai' AND resi IS NOT NULL")->row();
		$data['produk']=$this->db->query('SELECT COUNT(id) as total FROM products WHERE status = 1')->row();
		$data['pelanggan']=$this->db->query("SELECT COUNT(id) as total FROM members WHERE status = 1 AND email != 'admin@gmail.com'")->row();
		$this->load->view('dashboard/index',$data);
		$this->load->view('dashboard/footer');
			
	}


	//CRUD Produk ========================================================

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

	
	//CRUD Promo ========================================================

	public function promo()
	{

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$this->load->view('dashboard/modal_promo');
		$data['promotions']= $this->getDatatablePromo();
		$data['promo'] = $this->db->query("SELECT count(id) as aktif FROM promotions WHERE end_date >= now() AND status = 1")->row();
		$this->load->view('dashboard/promo',$data);	
	}

    public function tambah_promo(){

		$id = $this->input->post('promo_id',TRUE);
		$code = strtoupper($this->input->post('code',TRUE));
		$start = new DateTime($this->input->post('start_date'));
		$end = new DateTime($this->input->post('end_date'));
		$check = $this->Model_Promo->getProductByCode($code);

		//Proses penyimpanan data
		if ($start > $end){
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Promo gagal di simpan, tanggal akhir harus lebih dari tanggal mulai</div>');

		} else {

			if(strlen($id) == 0){
					$data = [
						'code' => $code,
						'name' => htmlspecialchars($this->input->post('name',TRUE)),
						'description' => htmlspecialchars($this->input->post('description',TRUE)),
						'start_date' => $this->input->post('start_date',TRUE),
						'end_date' => $this->input->post('end_date',TRUE),
						'discount' => $this->input->post('discount',TRUE)
					];

					if($check == 0){
						$this->Model_Promo->tambah($data); //memasukan data ke database
						$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Promo berhasil di simpan</div>');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Promo gagal di simpan, Kode sudah pernah digunakan</div>');
					}

			} else {

				$data = [
					'name' => htmlspecialchars($this->input->post('name',TRUE)),
					'description' => htmlspecialchars($this->input->post('description',TRUE)),
					'start_date' => $this->input->post('start_date',TRUE),
					'end_date' => $this->input->post('end_date',TRUE),
					'discount' => $this->input->post('discount',TRUE)
				];

				$now = date('Y-m-d');

				$sql = "SELECT a.id as total FROM promotions a WHERE a.end_date > '$now' AND a.status = 1";

				$query = $this->db->query($sql);

				$num_row = $query->num_rows();

				if($num_row > 0){
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sudah ada promo yang berjalan</div>');
				} else {
					$this->Model_Promo->update($id, $data); //memasukan data ke database
					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Promo berhasil di update</div>');
				}
				
			}
		}

		redirect('dashboard/promo');
		
  	}

	public function hapus_promo(){
		$id = $this->input->post('id',TRUE);

		$this->Model_Promo->hapus($id, ["status" => 0]);
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Promo berhasil di hapus</div>');

		echo json_encode(['link' =>'Dashboard/promo']);
	}

	public function edit_promo(){
		$id = $this->input->post('id',TRUE);
		$data = $this->Model_Promo->getProductById($id);
		echo json_encode($data);
	}	


	
	//Member ========================================================

	public function member()
	{
		$this->session->set_userdata(['sidebar' => 'member']);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$data['members']= $this->getDatatableMember();
		$this->load->view('dashboard/pelanggan',$data);	
	}

	public function hapus_member(){
		$id = $this->input->post('id',TRUE);
		$this->Model_Pelanggan->hapus($id, ["status" => 0]);
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Member berhasil di hapus</div>');

		echo json_encode(['link' =>'Dashboard/member']);
	}

	//Order ========================================================

	public function pesanan()
	{
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$this->load->view('dashboard/modal_konfirmasi');
		$this->load->view('dashboard/modal_tolak');
		$this->load->view('dashboard/modal_struk');

		$get_orders = $this->Model_Order->getOrder();

		$orders = array();

		foreach($get_orders as $item){

			$orders[] = [
				'code' => $item->code,
				'date' => $item->created_at,
				'buyer' => '<b>'.$item->name.'</b><br>'.$item->address.'<br>Telp. '.$item->phone,
				'product' => $this->Model_Order->getOrderDetail($item->id),
				'evidence_transfer' => '<a href="javascript:void(0);" title="Lihat struk pembayaran" data-struck="'.$item->evidence_transfer.'"  data-toggle="modal" data-target="#modal_struk" onclick="showStruck(this)"><i class="fa fa-file-text text-secondary" style="font-size:20px;"></i></a>',
				'sender' => 'No. Rek. : <br><b>'.$item->account_number.'</b><br>Atas Nama : <br><b>'.$item->account_name.'</b><br>Nominal : <br><b>Rp '.number_format($item->total_price).'</b>',
				'shipping_cost' => '<b>Rp '.number_format($item->shipping_cost).'</b>',
				'action' => '<a href="javascript:void(0);" title="Konfirmasi pesanan" data-id="'.$item->id.'" data-toggle="modal" data-target="#modal_konfirmasi" onclick="confOrder(this)"><i class="fa fa-check-circle text-success" style="font-size:30px;"></i></a><br><br><a href="javascript:void(0);" title="Tolak pesanan" data-id="'.$item->id.'" data-toggle="modal" data-target="#modal_tolak" onclick="cancelOrder(this)"><i class="fa fa-close text-danger" style="font-size:30px;"></i></a>'
			];
		}

		$this->load->view('dashboard/pesanan', ['orders' => $orders]);	
	}

	public function konfirmasi_pesanan(){

		$id = $this->input->post('order_id');
		$resi = strtoupper($this->input->post('resi'));

		$order = $this->db->query("UPDATE orders a SET a.status = 'Selesai', a.resi = '$resi' WHERE id = '$id'");

		if(!$order){
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pesanan gagal dikonfirmasi</div>');

		} else {

			$update_product = $this->Model_Order->updateStock($id);
			
			if(!$update_product){
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Stok produk gagal diupdate</div>');
			} else {
				
				$this->sendEmailWithResi($id);

				$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pesanan berhasil dikonfimasi ke pembeli</div>');
			
			}
		}

		redirect('dashboard/pesanan');			

	}

	public function tolak_pesanan(){

		$id = $this->input->post('order_id_tolak');
		$because = strtoupper($this->input->post('because'));

		$order = $this->db->query("UPDATE orders a SET a.status = 'Ditolak', a.because = '$because' WHERE id = '$id'");

		if(!$order){
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pesanan gagal ditolak</div>');

		} else {
				
				$this->sendEmailWithBecause($id);

				$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pesanan berhasil ditolak dan pembeli telah dikirim email konfirmasi</div>');
			
		}

		redirect('dashboard/pesanan');			

	}

	public function penjualan()
	{
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/asidebar');
		$this->load->view('dashboard/modal_struk');
		$this->load->view('dashboard/modal_report');

		$get_orders = $this->Model_Order->getSales();

		$orders = array();

		foreach($get_orders as $item){

			$orders[] = [
				'code' => $item->code,
				'date' => $item->created_at,
				'buyer' => '<b>'.$item->name.'</b><br>'.$item->address.'<br>Telp. '.$item->phone,
				'product' => $this->Model_Order->getOrderDetail($item->id),
				'evidence_transfer' => '<a href="javascript:void(0);" title="Lihat struk pembayaran" data-struck="'.$item->evidence_transfer.'"  data-toggle="modal" data-target="#modal_struk" onclick="showStruck(this)"><i class="fa fa-file-text text-secondary" style="font-size:20px;"></i></a>',
				'sender' => 'No. Rek. : <br><b>'.$item->account_number.'</b><br>Atas Nama : <br><b>'.$item->account_name.'</b><br>Nominal : <br><b>Rp '.number_format($item->total_price).'</b>'
			];
		}

		$this->load->view('dashboard/penjualan', ['orders' => $orders]);	
	}

	public function laporan()
	{
		$start = new DateTime($this->input->post('start_date'));
		$end = new DateTime($this->input->post('end_date'));
		$str_start = $this->input->post('start_date');
		$str_end = $this->input->post('end_date');

		if($start > $end){
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Tanggal mulai harus kurang dari tanggal akhir</div>');
			redirect('dashboard/penjualan');
		}

		$get_orders = $this->Model_Order->getReport($str_start,$str_end);

		$orders = array();
		$total = 0;

		foreach($get_orders as $item){

			$orders[] = [
				'invoice' => $item->invoice,
				'date' => $item->created_at,
				'buyer' => '<b>'.$item->name.'</b><br>'.$item->address.'<br>Telp. '.$item->phone,
				'product' => $this->Model_Order->getOrderDetail($item->id),
				'sender' => 'No. Rek. : <br><b>'.$item->account_number.'</b><br>Atas Nama : <br><b>'.$item->account_name,
				'nominal' => '<b>'.number_format($item->total_price).'</b>'
			];

			$total += $item->total_price;
		}

		$group_id = $this->db->query("SELECT GROUP_CONCAT(a.id) as id
										FROM orders a
										WHERE a.status = 'Selesai' 
										AND a.evidence_transfer IS NOT NULL")->row();

		$sql_sale = "SELECT SUM(b.quantity) as total
						FROM order_details b 
						WHERE b.order_id IN ($group_id->id) AND (b.created_at BETWEEN '$str_start' AND '$str_end')";
		// var_dump($sql_sale); die();
		$exec_sql = $this->db->query($sql_sale)->row();

		$report =  [
			'orders' => $orders, 
			'admin' =>  $this->session->userdata('name'),
			'total' => $total,
			'start' => $this->input->post('start_date'),
			'end' => $this->input->post('end_date'),
			'total_sale' => $exec_sql->total
		];

		$this->load->library('pdf');
        $html = $this->load->view('dashboard/GeneratePdfView', $report, true);
        $this->pdf->createPDF($html, 'mypdf', false);


		// $this->load->view('dashboard/laporan',$data);
			
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
				"name" => $row['name'],
				"email" => $row['email'],
				"phone" => $row['phone'],
				"gender" => $row['gender'],
				"address" => $row['address'],
				"state" => $row['state'],
				"city" => $row['city'],
				"district" => $row['district'],
				"action" => '<a href="javascript:void(0);" title="Klik untuk menghapus" data-id="'.$row['id'].'" onclick="deleteMember(this)"><i class="fas fa-remove text-danger"></i></a>'
			];
		}

        return $data;
	}

	public function getDatatablePromo()
	{   

		$products = $this->Model_Promo->getData();
		$data = array();
		$now = new DateTime(date('Y-m-d'));
		
		foreach($products as $row) {
			
			$start = new DateTime($row['start_date']);
			$end = new DateTime($row['end_date']);

			if($end >= $now) {
				$status = '<div class="badge badge-success">Berjalan</div>';
			} else {
				$status = '<div class="badge badge-secondary">Berakhir</div>';
			}

			$data[] = [
				"code" => $row['code'],
				"name" => $row['name'],
				"description" => $row['description'],
				"discount" => $row['discount'],
				"start_date" => $row['start_date'],
				"end_date" => $row['end_date'],
				"status" => $status,
				"action" => '<a href="javascript:void(0);" title="Klik untuk melakukan perubahan" data-id="'.$row['id'].'" class="mr-1" onclick="editPromo(this)"><i class="far fa-edit text-primary"></i></a><a href="javascript:void(0);" title="Klik untuk menghapus" data-id="'.$row['id'].'" onclick="deletePromo(this)"><i class="far fa-trash-alt text-danger"></i></a>'
			];
		}

        return $data;
	}

	//Send Email to buyer
	function sendEmailWithResi($id){

		$data = $this->db->query("SELECT * FROM orders WHERE id = '$id'")->row();

        $this->email->from('admin@colornizer.co', 'Colornizer.co');

		$this->email->to($data->email);
 
		$this->email->subject('Colonizer.co');
        
        $this->email->message($this->load->view('template_email/konfirmasi',$data, true));

		$this->email->set_mailtype('html');

		$this->email->send();
    }

	function sendEmailWithBecause($id){

		$data = $this->db->query("SELECT * FROM orders WHERE id = '$id'")->row();

        $this->email->from('admin@colornizer.co', 'Colornizer.co');

		$this->email->to($data->email);
 
		$this->email->subject('Colonizer.co');
        
        $this->email->message($this->load->view('template_email/tolak',$data, true));

		$this->email->set_mailtype('html');

		$this->email->send();
    }

}
