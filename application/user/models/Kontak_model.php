<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function kirim($data){
		return $this->db->insert("idc_pesan", $data);
	}


}
