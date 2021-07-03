<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Model_Profile extends CI_Model {

	public function getProfile($id){

		$sql="SELECT * FROM accounts WHERE id = '$id' ";

		$query = $this->db->query($sql);

		return $query->row();
	}

}
