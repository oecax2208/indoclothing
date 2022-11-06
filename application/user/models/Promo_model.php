<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_model extends CI_Model {	
	private $jml_promo = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_promo_all()
	{
		$this->db->select("*")
		->from("idc_promo")
		->order_by("id_promo ASC");
		$query = $this->db->get();
		$this->jml_promo = $query->num_rows();
		return $query->result();
	}
	

	public function jumlah_promo()
	{
		if($this->jml_promo==-1)
			$this->jml_promo = $this->db->count_all_results("idc_promo");
		return $this->jml_promo;
	}


}
