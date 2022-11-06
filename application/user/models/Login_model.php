<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {	
	
	public function __construct(){
		$this->load->database();
	}

	
	public function cari_pengguna($id_login, $kata_sandi)
	{
		$query = $this->db->select("*")
		->from("idc_admin__")
		->where("id_login", $id_login)
		->where("kata_sandi", $kata_sandi)
		->get();
		return $query->row_array();
	}
	
}
