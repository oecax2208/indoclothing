<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {	
	private $jml_slider = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_slider()
	{
		$this->db->select("*")
		->from("idc_slider")
		->order_by("id_slider ASC");
		$query = $this->db->get();
		$this->jml_slider = $query->num_rows();
		return $query->result();
	}
	
	public function jumlah_slider()
	{
		if($this->jml_slider==-1)
			$this->jml_slider = $this->db->count_all_results("idc_slider");
		return $this->jml_slider;
	}


}
