<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambar_produk_model extends CI_Model {	
	private $jml_gambar = -1;
	
	public function __construct(){
		$this->load->database();
	}
	
	public function nomor_gambar($kode){
		$this->db->select("gambar_produk_mini")
		->from("idc_gambar_produk")
		->where("kode_produk", $kode)
		->order_by("id_gambar DESC");
		$res = $this->db->get()->row();
		$no = $res->gambar_produk_mini;
		$no = explode("_",$no);
		$next = (int)$no[1]+1;
		
		return $next;
	}

	public function daftar_gambar($kode)
	{
		$this->db->select("*")
		->from("idc_gambar_produk")
		->where("kode_produk", $kode)
		->order_by("id_gambar ASC");
		$query = $this->db->get();
		$this->jml_gambar = $query->num_rows();
		return $query->result();
	}
	public function cari_gambar_by_id($id)
	{
		$this->db->select("*")
		->from("idc_gambar_produk")
		->where("id_gambar", $id);
		$query = $this->db->get();
		$this->jml_gambar = $query->num_rows();
		return $query->row();
	}
	
	public function tambah_gambar($data){
		return $this->db->insert("idc_gambar_produk", $data);
	}

	public function hapus_gambar($kode){
		return $this->db->delete("idc_gambar_produk", "id_gambar='$kode'");
	}

	public function jumlah_gambar()
	{
		if($this->jml_gambar==-1)
			$this->jml_gambar = $this->db->count_all_results("idc_gambar_produk");
		return $this->jml_gambar;
	}
}
