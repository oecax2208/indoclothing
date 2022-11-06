<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten_model extends CI_Model {
	private $jml_kabupaten=-1;
	
	public function __construct(){
		$this->load->database();
	}

	public function id_kabupaten_auto()
	{
		$query = $this->db->query("SELECT id_kabupaten FROM idc_kabupaten ORDER BY SUBSTR(id_kabupaten,2,5)*1 DESC LIMIT 1");
		$res = $query->row_array();
		if(empty($res)){
			return "K1";
		}else{
			$No = (int)substr($res['id_kabupaten'], 1, 7)+1;
			$No = "K".$No;
			return $No;
		}
	}

	public function daftar_kabupaten()
	{
		$this->db->select('*')->from('idc_kabupaten')
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi')
		->order_by("substr(idc_kabupaten.id_kabupaten,2,7)*1 ASC", "id_provinsi ASC");
		$query = $this->db->get();
		$this->jml_kabupaten= $query->num_rows();

		return $query->result();
	}

	public function daftar_kabupaten_limit($limit, $start)
	{
		$this->db->select('*')->from('idc_kabupaten')
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi')
		->order_by("substr(idc_kabupaten.id_kabupaten,2,7)*1 ASC", "id_provinsi ASC")
		->limit($limit, $start);
		$query = $this->db->get();

		return $query->result();
	}
	
	public function cari_kabupaten_by_id($id)
	{
		$query = $this->db->get_where("idc_kabupaten",array('id_kabupaten'=>$id));
		return $query->row();
	}

	public function cari_kabupaten_by_id_provinsi($id)
	{
		$query = $this->db->get_where("idc_kabupaten",array('id_provinsi'=>$id));
		$this->jml_kabupaten= $query->num_rows();
		return $query->result();
	}

	public function cari_kabupaten_by_nama($nama)
	{
		$term = $this->db->escape($nama);
		$query = $this->db->like("nama_kabupaten",$term)->get("idc_kabupaten");
		$this->jml_kabupaten= $query->num_rows();
		return $query->row();
	}

	public function tambah_kabupaten($data){
		return $this->db->insert("idc_kabupaten", $data);
	}

	public function ubah_kabupaten($data, $id){
		$this->db->set($data);
		$this->db->where("id_kabupaten",$id);
		return $this->db->update("idc_kabupaten", $data);
	}

	public function hapus_kabupaten($id){
		return $this->db->delete("idc_kabupaten", "id_kabupaten='$id'");
	}
	
	public function jumlah_kabupaten()
	{
		if($this->jml_kabupaten== -1)
			$this->jml_kabupaten= $this->db->count_all_results("idc_kabupaten");
		return $this->jml_kabupaten;
	}


}
