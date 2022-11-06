<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi_model extends CI_Model {
	
	public function __construct(){
		$this->load->database();
	}

	public function id_provinsi_auto()
	{
		$query = $this->db->query("SELECT id_provinsi FROM idc_provinsi ORDER BY SUBSTR(id_provinsi,2,5)*1 DESC LIMIT 1");
		$res = $query->row_array();
		if(empty($res)){
			return "P1";
		}else{
			$No = (int)substr($res['id_provinsi'], 1, 5)+1;
			$No = "P".$No;
			return $No;
		}
	}

	public function daftar_provinsi()
	{
		$this->db->select("*")->from("idc_provinsi")->order_by("substr(id_provinsi,2,7)*1 ASC");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function cari_provinsi_by_id($id)
	{
		$query = $this->db->get_where("idc_provinsi",array('id_provinsi'=>$id));
		return $query->row();
	}
	
	public function cari_provinsi_by_nama($nama)
	{
		//$term = $this->db->escape("%".$nama."%");
		$query = $this->db->like("nama_provinsi", $nama)->get("idc_provinsi");
		return $query->result();
	}

	public function tambah_provinsi($data){
		return $this->db->insert("idc_provinsi", $data);
	}

	public function ubah_provinsi($data, $id){
		$this->db->set($data);
		$this->db->where("id_provinsi",$id);
		return $this->db->update("idc_provinsi", $data);
	}

	public function hapus_provinsi($id){
		return $this->db->delete("idc_provinsi", "id_provinsi='$id'");
	}

	public function jumlah_provinsi()
	{
		$count = $this->db->count_all_result("idc_provinsi");
		return $count;
	}


}
