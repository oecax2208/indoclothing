<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model {	
	private $jml_pesan = -1;
	
	public function __construct(){
		$this->load->database();
	}

	
	public function pesan_masuk()
	{
		$this->db->select("*")
		->from("idc_pesan")
		->where("idc_pesan.kepada_penerima","ADMIN")
		->order_by("id_pesan DESC");
		$query = $this->db->get();
		$this->jml_pesan = $query->num_rows();
		return $query->result();
	}

	public function pesan_masuk_limit($limit, $start)
	{
		$this->db->select("*")
		->from("idc_pesan")
		->where("idc_pesan.kepada_penerima","ADMIN")
		->order_by("id_pesan DESC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_pesan = $query->num_rows();
		return $query->result();
	}

	public function pesan_keluar()
	{
		$this->db->select("*")
		->from("idc_pesan")
		->where("idc_pesan.kepada_penerima != 'ADMIN'")
		->order_by("id_pesan DESC");
		$query = $this->db->get();
		$this->jml_pesan = $query->num_rows();
		return $query->result();
	}

	public function pesan_keluar_limit($limit, $start)
	{
		$this->db->select("*")
		->from("idc_pesan")
		->where("idc_pesan.kepada_penerima !='ADMIN'")
		->order_by("id_pesan DESC")
		->limit($limit, $start);
		$query = $this->db->get();
		$this->jml_pesan = $query->num_rows();
		return $query->result();
	}

	public function cari_pesan_by_id($id)
	{
		$this->db->select("*")
		->from("idc_pesan")
		->where("idc_pesan.id_pesan",$id);
		$query = $this->db->get();
		$this->jml_pesan = $query->num_rows();
		return $query->row();
	}	
	
	
	public function kirim($data){
		return $this->db->insert("idc_pesan", $data);
	}

	public function update_status_baca($data, $id){
		$this->db->set($data);
		$this->db->where("id_pesan",$id);
		return $this->db->update("idc_pesan", $data);	}


	public function hapus_pesan($kode){
		return $this->db->delete("idc_pesan", "id_pesan='$kode'");
	}

	public function jumlah_pesan()
	{
		if($this->jml_pesan==-1)
			$this->jml_pesan = $this->db->count_all_results("idc_pesan");
		return $this->jml_pesan;
	}


}
