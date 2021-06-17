<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Model_Produk extends CI_Model {

	public function tambah_produk($data){
	   try{
	      $this->db->insert('products', $data);
	      return true;
	    }catch(Exception $e){
			return $e;
	    }
	}

	public function hapus($id, $data){
		$this->db->where(['id' => $id]);
		$this->db->update('products', $data);
	}

	public function update($id,$data){
		$this->db->where(['id' => $id]);
		$this->db->update('products', $data);
	}

	public function getData(){

		$sql="SELECT a.id,a.code,a.name,a.description,a.category,a.image,a.weight,a.size,a.price,a.stock
				FROM products a WHERE a.status = 1
				ORDER BY a.stock DESC";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function getProductById($id){

		$sql="SELECT a.id,a.code,a.name,a.description,a.category,a.image,a.weight,a.size,a.price,a.stock
				FROM products a WHERE a.id = '".$id."' AND a.status = 1";

		$query = $this->db->query($sql);

		return $query->result();
	}

	public function displayProduct(){
		$sql = "SELECT a.id,a.code,a.name,a.category,a.image,a.weight,a.description,a.price,
				(SELECT b.stock FROM products b WHERE b.code = a.code AND b.size = 'S') as s,
				(SELECT c.stock FROM products c WHERE c.code = a.code AND c.size = 'M') as m,
				(SELECT d.stock FROM products d WHERE d.code = a.code AND d.size = 'L') as l,
				(SELECT e.stock FROM products e WHERE e.code = a.code AND e.size = 'XL') as xl,
				(SELECT f.stock FROM products f WHERE f.code = a.code AND f.size = 'XXL') as xxl,
				(SELECT g.stock FROM products g WHERE g.code = a.code AND g.size = 'One Size') as one_size
				FROM products a 
				WHERE a.status = 1
				Group By a.code
				order by a.created_at";

		$query =  $this->db->query($sql);

		return $query->result();
	}

	public function searchProduct($key){
		$sql = "SELECT a.id,a.code,a.name,a.category,a.image,a.weight,a.description,a.price,
				(SELECT b.stock FROM products b WHERE b.code = a.code AND b.size = 'S') as s,
				(SELECT c.stock FROM products c WHERE c.code = a.code AND c.size = 'M') as m,
				(SELECT d.stock FROM products d WHERE d.code = a.code AND d.size = 'L') as l,
				(SELECT e.stock FROM products e WHERE e.code = a.code AND e.size = 'XL') as xl,
				(SELECT f.stock FROM products f WHERE f.code = a.code AND f.size = 'XXL') as xxl,
				(SELECT g.stock FROM products g WHERE g.code = a.code AND g.size = 'One Size') as one_size
				FROM products a 
				WHERE a.status = 1
				AND (a.name LIKE '%$key%'
				OR a.category LIKE '%$key%')
				Group By a.code
				order by a.created_at";

		$query =  $this->db->query($sql);

		return $query->result();
	}

	public function detailProduct($data){

		$sql = "SELECT a.id,a.code,a.name,a.category,a.image,a.weight,a.description,a.price,
				(SELECT b.stock FROM products b WHERE b.code = a.code AND b.size = 'S') as s,
				(SELECT c.stock FROM products c WHERE c.code = a.code AND c.size = 'M') as m,
				(SELECT d.stock FROM products d WHERE d.code = a.code AND d.size = 'L') as l,
				(SELECT e.stock FROM products e WHERE e.code = a.code AND e.size = 'XL') as xl,
				(SELECT f.stock FROM products f WHERE f.code = a.code AND f.size = 'XXL') as xxl,
				(SELECT g.stock FROM products g WHERE g.code = a.code AND g.size = 'One Size') as one_size
				FROM products a 
				WHERE a.status = 1 AND a.code = '".$data['code']."'
				AND a.name = '".$data['name']."'
				AND a.image = '".$data['image']."'
				LIMIT 1";

		$query =  $this->db->query($sql);

		return $query->result();
	}

}
