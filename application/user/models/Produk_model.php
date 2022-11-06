<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {	
	private $jml_produk = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_produk($limit, $start)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->order_by("substr(kode_produk,3,10)*1 ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}	


	public function daftar_produk_all()
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->order_by("substr(kode_produk,3,10)*1 ASC");
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}

	public function daftar_produk_by_kategori($id)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->where("idc_kategori.id_kategori", $id)
		->order_by("substr(kode_produk,3,10)*1 ASC");
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}
	
	public function daftar_produk_by_kategori_limit($limit, $start, $id)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->where("idc_kategori.id_kategori", $id)
		->order_by("substr(kode_produk,3,10)*1 ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}	

	public function daftar_produk_by_merk($merk)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->where("idc_merk.merk", strtoupper($merk))
		->order_by("substr(kode_produk,3,10)*1 ASC");
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}
	
	public function daftar_produk_by_merk_limit($limit, $start, $merk)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->where("idc_merk.merk", strtoupper($merk))
		->order_by("substr(kode_produk,3,10)*1 ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}	
		
	public function daftar_produk_by_kategori_detail($id)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->where("idc_kategori.id_kategori", $id)
		->order_by("RAND(kode_produk)")
		->limit(12,0);
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}	
	
	public function cari_produk_by_kode($kode)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->where("idc_produk.kode_produk", $kode)
		->order_by("substr(kode_produk,3,10)*1 ASC");
		$query = $this->db->get();
		return $query->row();
	}
	
	public function cari_produk_by_nama($nama)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->like("idc_produk.nama_produk", $nama)
		->order_by("substr(kode_produk,3,10)*1 ASC");
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}	

	public function cari_produk_by_nama_limit($nama, $limit, $start)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->like("idc_produk.nama_produk", $nama)
		->order_by("substr(kode_produk,3,10)*1 ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}

	//
	//Gambar Produk
	//
	public function cari_gambar_produk($kode)
	{
		$this->db->select("*")
		->from("idc_gambar_produk")
		->where("kode_produk", $kode);
		$query = $this->db->get();
		$this->jml_produk= $query->num_rows();
		return $query->result();
	}
	//Display Galeri
	public function galeri_produk($limit=0, $start=0)
	{
		if($limit==0 && $start==0){
			$this->db->select("*")
			->from("idc_galeri")
			->order_by("id_galeri");			
		}else{
			$this->db->select("*")
			->from("idc_galeri")
			->order_by("id_galeri")
			->limit($limit, $start);
		}
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}
	
	public function daftar_kategori(){
		$query = $this->db->get("idc_kategori");
		return $query->result();
	}	
	
	public function cari_kategori_by_id($id){
		$query = $this->db->get_where("idc_kategori",array("id_kategori", $id));
		return $query->row();
	}
	
	public function jumlah_produk()
	{
		if($this->jml_produk==-1)
			$this->jml_produk = $this->db->count_all_results("idc_produk");
		return $this->jml_produk;
	}


}
