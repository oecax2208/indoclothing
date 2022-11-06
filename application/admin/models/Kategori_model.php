<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {
	
	public function __construct(){
		$this->load->database();
	}


	public function daftar_kategori()
	{
		$this->db->select("*")->from("idc_kategori")->order_by("substr(id_kategori,2,7)*1 ASC");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function cari_kategori_by_id($id)
	{
		$query = $this->db->get_where("idc_kategori",array('id_kategori'=>$id));
		return $query->row();
	}
	
	public function cari_kategori_by_nama($nama)
	{
		//$term = $this->db->escape("%".$nama."%");
		$query = $this->db->like("nama_kategori", $nama)->get("idc_kategori");
		return $query->result();
	}

	public function tambah_kategori($data){
		return $this->db->insert("idc_kategori", $data);
	}

	public function ubah_kategori($data, $id){
		$this->db->set($data);
		$this->db->where("id_kategori",$id);
		return $this->db->update("idc_kategori", $data);
	}

	public function hapus_kategori($id){
		return $this->db->delete("idc_kategori", "id_kategori='$id'");
	}

	public function jumlah_kategori()
	{
		$count = $this->db->count_all_result("idc_kategori");
		return $count;
	}


}
