<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model {
	
	public function __construct(){
		$this->load->database();
	}


	public function daftar_pesan()
	{
		$this->db->select("*")->from("idc_pesan")->order_by("substr(id_pesan,2,7)*1 ASC");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function cari_pesan_by_id($id)
	{
		$query = $this->db->get_where("idc_pesan",array('id_pesan'=>$id));
		return $query->row();
	}
	
	public function cari_pesan_by_nama($nama)
	{
		//$term = $this->db->escape("%".$nama."%");
		$query = $this->db->like("nama_pesan", $nama)->get("idc_pesan");
		return $query->result();
	}

	public function tambah_pesan($data){
		return $this->db->insert("idc_pesan", $data);
	}

	public function ubah_pesan($data, $id){
		$this->db->set($data);
		$this->db->where("id_pesan",$id);
		return $this->db->update("idc_pesan", $data);
	}

	public function hapus_pesan($id){
		return $this->db->delete("idc_pesan", "id_pesan='$id'");
	}

	public function jumlah_pesan()
	{
		$count = $this->db->count_all_result("idc_pesan");
		return $count;
	}


}
