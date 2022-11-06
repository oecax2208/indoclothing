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
	
	public function cari_slider_by_id($id)
	{
		$this->db->select("*")
		->from("idc_slider")
		->where("id_slider", $id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function tambah_slider($data){
		return $this->db->insert("idc_slider", $data);
	}

	public function hapus_slider($id){
		return $this->db->delete("idc_slider", "id_slider='$id'");
	}

	public function jumlah_slider()
	{
		if($this->jml_slider==-1)
			$this->jml_slider = $this->db->count_all_results("idc_slider");
		return $this->jml_slider;
	}


}
