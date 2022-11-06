<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel_model extends CI_Model {	
	private $jml_artikel = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_artikel($limit, $start)
	{
		$this->db->select("*")
		->from("idc_artikel")
		->order_by("id_artikel ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_artikel = $query->num_rows();
		return $query->result();
	}

	public function daftar_artikel_all()
	{
		$this->db->select("*")
		->from("idc_artikel")
		->order_by("id_artikel ASC");
		$query = $this->db->get();
		$this->jml_artikel = $query->num_rows();
		return $query->result();
	}
	
	public function cari_artikel_by_id($id)
	{
		$query = $this->db->get_where("idc_artikel",array('id_artikel'=>$id));
		$this->jml_artikel = $query->num_rows();
		return $query->row();
	}
	
	public function cari_artikel_by_slug($slug)
	{
		$query = $this->db->get_where("idc_artikel",array('slug_artikel'=>$slug));
		$this->jml_artikel = $query->num_rows();
		return $query->row();
	}

	public function cari_artikel_by_judul($judul)
	{
		$this->db->select("*")
		->from("idc_artikel")
		->like("idc_artikel.judul_artikel", $judul)
		->order_by("id_artikel ASC");
		
		$query = $this->db->get();
		$this->jml_artikel = $query->num_rows();
		return $query->result();
	}
	
	public function cari_artikel_by_judul_limit($judul, $limit, $start)
	{
		$this->db->select("*")
		->from("idc_artikel")
		->like("idc_artikel.judul_artikel", $judul)
		->order_by("id_artikel ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_artikel = $query->num_rows();
		return $query->result();
	}
	
	public function tambah_artikel($data){
		return $this->db->insert("idc_artikel", $data);
	}

	public function ubah_artikel($data, $id){
		$this->db->set($data);
		$this->db->where("id_artikel",$id);
		return $this->db->update("idc_artikel", $data);
	}

	public function hapus_artikel($id){
		return $this->db->delete("idc_artikel", "id_artikel='$id'");
	}

	public function jumlah_artikel()
	{
		if($this->jml_artikel==-1)
			$this->jml_artikel = $this->db->count_all_results("idc_kecamatan");
		return $this->jml_artikel;
	}


}
