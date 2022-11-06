<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {	
	private $jml_produk = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function kode_produk_auto()
	{
		$query = $this->db->query("SELECT kode_produk FROM idc_produk ORDER BY SUBSTR(kode_produk,3,5)*1 DESC LIMIT 1");
		$res = $query->row_array();
		if(empty($res)){
			return "PR1";
		}else{
			$No = (int)substr($res['kode_produk'], 2, 10)+1;
			$No = "PR".$No;
			return $No;
		}
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
	
	public function cari_produk_by_kode($kode)
	{
		$query = $this->db->get_where("idc_produk",array('kode_produk'=>$kode));
		$this->jml_produk = $query->num_rows();
		return $query->row();
	}
	
	public function cari_produk_by_nama($nama)
	{
		$this->db->select("*")
		->from("idc_produk")
		->join("idc_kategori", "idc_produk.id_kategori = idc_kategori.id_kategori")
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
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
		->join("idc_merk", "idc_merk.id_merk = idc_produk.id_merk")
		->like("idc_produk.nama_produk", $nama)
		->order_by("substr(kode_produk,3,10)*1 ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_produk = $query->num_rows();
		return $query->result();
	}
	
	public function tambah_produk($data){
		return $this->db->insert("idc_produk", $data);
	}

	public function ubah_produk($data, $kode){
		$this->db->set($data);
		$this->db->where("kode_produk",$kode);
		return $this->db->update("idc_produk", $data);
	}

	public function hapus_produk($kode){
		return $this->db->delete("idc_produk", "kode_produk='$kode'");
	}

	public function jumlah_produk()
	{
		if($this->jml_produk==-1)
			$this->jml_produk = $this->db->count_all_results("idc_kecamatan");
		return $this->jml_produk;
	}


}
