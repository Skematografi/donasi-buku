<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Model_Pelanggan extends CI_Model {

	public function tambah($data){
		try{
		   $this->db->insert('members', $data);
		   return true;
		 }catch(Exception $e){
			 return $e;
		 }
	}

	public function update($id,$data){
		$this->db->where(['id' => $id]);
		$this->db->update('members', $data);
	}

	public function getData(){

		$sql="SELECT a.id,a.name,a.email,a.phone,a.gender,a.address,a.state,a.city,a.district,a.postal_code
				FROM members a WHERE a.status = 1
				ORDER BY a.created_at DESC";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function hapus($id, $data){
		$this->db->where(['id' => $id]);
		$this->db->update('members', $data);
	}

	public function getMemberById($id){

		$sql="SELECT * FROM members a WHERE a.id = '".$id."' AND a.status = 1";

		$query = $this->db->query($sql);

		return $query->result();
	}

}
