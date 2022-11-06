<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_model extends CI_Model {	
	private $jml_promo = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_promo($limit, $start)
	{
		$this->db->select("*")
		->from("idc_promo")
		->order_by("id_promo ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_promo = $query->num_rows();
		return $query->result();
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
	
	public function cari_promo_by_id($id)
	{
		$query = $this->db->get_where("idc_promo",array('id_promo'=>$id));
		$this->jml_promo = $query->num_rows();
		return $query->row();
	}
	
	public function cari_promo_by_judul($judul)
	{
		$this->db->select("*")
		->from("idc_promo")
		->like("idc_promo.judul_promo", $judul)
		->order_by("id_promo DESC");
		$query = $this->db->get();
		$this->jml_promo = $query->num_rows();
		return $query->result();
	}

	public function cari_promo_by_judul_limit($judul, $limit, $start)
	{
		$this->db->select("*")
		->from("idc_promo")
		->like("idc_promo.judul_promo", $judul)
		->order_by("id_promo ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_promo = $query->num_rows();
		return $query->result();
	}
	
	public function tambah_promo($data){
		return $this->db->insert("idc_promo", $data);
	}

	public function ubah_promo($data, $id){
		$this->db->set($data);
		$this->db->where("id_promo",$id);
		return $this->db->update("idc_promo", $data);
	}

	public function hapus_promo($id){
		return $this->db->delete("idc_promo", "id_promo='$id'");
	}

	public function jumlah_promo()
	{
		if($this->jml_promo==-1)
			$this->jml_promo = $this->db->count_all_results("idc_promo");
		return $this->jml_promo;
	}


}
