<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Model_Buku extends CI_Model {

	public function getDonasi(){

		$sql="SELECT a.*,b.name,b.phone FROM books a 
				LEFT JOIN accounts b ON b.id = a.account_id
				WHERE a.status = 'Donasi' ";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

    public function getKebutuhan(){

		$sql="SELECT a.*,b.name,b.phone FROM books a 
				LEFT JOIN accounts b ON b.id = a.account_id
				WHERE a.status = 'Kebutuhan' ";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

    public function simpanKebutuhan($data){
        try{
           $this->db->insert('books', $data);
           return true;
         }catch(Exception $e){
             return $e;
         }
     }

	public function getProductById($id){

		$sql="SELECT a.id,a.code,a.name,a.description,a.category,a.image,a.weight,a.size,a.price,a.stock
				FROM broadcasts a WHERE a.id = '".$id."' AND a.status = 1";

		$query = $this->db->query($sql);

		return $query->result();
	}

}
