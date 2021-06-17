<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Model_Siaran extends CI_Model {

	public function tambah_siaran($data){
	   try{
	      $this->db->insert('broadcasts', $data);
	      return true;
	    }catch(Exception $e){
			return $e;
	    }
	}

	public function getData(){

		$sql="SELECT * FROM broadcasts WHERE status = 1
				ORDER BY created_at DESC";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function getProductById($id){

		$sql="SELECT a.id,a.code,a.name,a.description,a.category,a.image,a.weight,a.size,a.price,a.stock
				FROM broadcasts a WHERE a.id = '".$id."' AND a.status = 1";

		$query = $this->db->query($sql);

		return $query->result();
	}

}
