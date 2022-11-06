<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan_model extends CI_Model {
	
	private $jml_kelurahan = 0;
	
	public function __construct(){
		$this->load->database();
	}

	public function id_kelurahan_auto()
	{
		$query = $this->db->query("SELECT id_kelurahan FROM idc_kelurahan ORDER BY SUBSTR(id_kelurahan,2,8)*1 DESC LIMIT 1");
		$res = $query->row_array();
		if(empty($res)){
			return "L1";
		}else{
			$No = (int)substr($res['id_kelurahan'], 1, 10)+1;
			$No = "L".$No;
			return $No;
		}
	}

	public function daftar_kelurahan()
	{
		$this->db->select('*')->from('idc_kelurahan')
		->join('idc_kecamatan', 'idc_kelurahan.id_kecamatan = idc_kecamatan.id_kecamatan', "INNER")
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->order_by("substr(idc_kelurahan.id_kelurahan,2,8)*1 ASC", "idc_kelurahan.id_kecamatan ASC");
		$query = $this->db->get();
		$this->jml_kelurahan = $query->num_rows();

		return $query->result();
	}

	public function daftar_kelurahan_limit($limit, $start)
	{
		$this->db->select('*')->from('idc_kelurahan')
		->join('idc_kecamatan', 'idc_kelurahan.id_kecamatan = idc_kecamatan.id_kecamatan', "INNER")
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->order_by("substr(idc_kelurahan.id_kelurahan,2,8)*1 ASC", "idc_kelurahan.id_kecamatan ASC")
		->limit($limit,$start);
		$query = $this->db->get();

		return $query->result();
	}
	
	public function cari_kelurahan_by_id($id)
	{
		$query = $this->db->get_where("idc_kelurahan",array('id_kelurahan'=>$id));
		return $query->row();
	}

	public function cari_kelurahan_by_nama($nama)
	{
		$term = $this->db->escape($nama);

		$this->db->select('*')->from('idc_kelurahan')
		->join('idc_kecamatan', 'idc_kelurahan.id_kecamatan = idc_kecamatan.id_kecamatan', "INNER")
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->like("idc_kelurahan.nama_kelurahan",$term)
		->order_by("substr(idc_kelurahan.id_kelurahan,2,8)*1 ASC", "idc_kelurahan.id_kabupaten ASC");
		$query = $this->db->get();
		$this->jml_kelurahan = $query->num_rows();
		return $query->row();
	}
	
	public function cari_kelurahan_by_nama_limit($nama, $limit, $start)
	{
		$term = $this->db->escape($nama);

		$this->db->select('*')->from('idc_kelurahan')
		->join('idc_kecamatan', 'idc_kelurahan.id_kecamatan = idc_kecamatan.id_kecamatan', "INNER")
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->like("idc_kelurahan.nama_kelurahan",$term)
		->order_by("substr(idc_kelurahan.id_kelurahan,2,8)*1 ASC", "idc_kelurahan.id_kabupaten ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah_kelurahan($data){
		return $this->db->insert("idc_kelurahan", $data);
	}

	public function ubah_kelurahan($data, $id){
		$this->db->set($data);
		$this->db->where("id_kelurahan",$id);
		return $this->db->update("idc_kelurahan", $data);
	}

	public function hapus_kelurahan($id){
		return $this->db->delete("idc_kelurahan", "id_kelurahan='$id'");
	}
	
	public function jumlah_kelurahan()
	{
		if($this->jml_kelurahan==0)
			$this->jml_kelurahan = $this->db->count_all_results("idc_kelurahan");
		return 	$this->jml_kelurahan;
	}


}
