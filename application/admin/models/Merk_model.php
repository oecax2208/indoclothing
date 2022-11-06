<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk_model extends CI_Model {	
	private $jml_merk = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_merk()
	{
		$this->db->select("*")
		->from("idc_merk")
		->order_by("id_merk ASC");
		$query = $this->db->get();
		$this->jml_merk = $query->num_rows();
		return $query->result();
	}
	
	public function cari_merk_by_id($id)
	{
		$query = $this->db->get_where("idc_merk",array('id_merk'=>$id));
		return $query->row();
	}
	
	public function tambah_merk($data){
		return $this->db->insert("idc_merk", $data);
	}	
	
	public function ubah_merk($data, $id){
		$this->db->set($data);
		$this->db->where("id_merk",$id);
		return $this->db->update("idc_merk", $data);
	}
	public function hapus_merk($id){
		return $this->db->delete("idc_merk", "id_merk='$id'");
	}

	public function jumlah_merk()
	{
		if($this->jml_merk==-1)
			$this->jml_merk = $this->db->count_all_results("idc_merk");
		return $this->jml_merk;
	}


}
