<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Model_Konfirmasi extends CI_Model {

    public function simpanKonfDonasi($data){
        try{
           $this->db->insert('confirmations', $data);
           return true;
         }catch(Exception $e){
             return $e;
         }
     }

}
