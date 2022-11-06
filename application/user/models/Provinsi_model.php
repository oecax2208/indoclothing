<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi_model extends CI_Model {
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_provinsi()
	{
		$this->db->select("*")->from("idc_provinsi")->order_by("substr(id_provinsi,2,7)*1 ASC");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function jumlah_provinsi()
	{
		$count = $this->db->count_all_result("idc_provinsi");
		return $count;
	}


}
