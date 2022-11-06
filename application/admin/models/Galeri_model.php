<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_model extends CI_Model {	
	private $jml_galeri = -1;
	
	public function __construct(){
		$this->load->database();
	}

	public function daftar_galeri()
	{
		$this->db->select("*")
		->from("idc_galeri")
		->order_by("id_galeri ASC");
		$query = $this->db->get();
		$this->jml_galeri = $query->num_rows();
		return $query->result();
	}

	public function daftar_galeri_limit($limit,$start)
	{
		$this->db->select("*")
		->from("idc_galeri")
		->order_by("id_galeri ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function cari_galeri_by_id($id)
	{
		$this->db->select("*")
		->from("idc_galeri")
		->where("id_galeri", $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah_galeri($data){
		return $this->db->insert("idc_galeri", $data);
	}

	public function hapus_galeri($id){
		return $this->db->delete("idc_galeri", "id_galeri='$id'");
	}

	public function jumlah_galeri()
	{
		if($this->jml_galeri==-1)
			$this->jml_galeri = $this->db->count_all_results("idc_galeri");
		return $this->jml_galeri;
	}


}
