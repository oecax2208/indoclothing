<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_model extends CI_Model {
	
	private $jml_kecamatan = 0;
	
	public function __construct(){
		$this->load->database();
	}

	public function id_kecamatan_auto()
	{
		$query = $this->db->query("SELECT id_kecamatan FROM idc_kecamatan ORDER BY SUBSTR(id_kecamatan,2,8)*1 DESC LIMIT 1");
		$res = $query->row_array();
		if(empty($res)){
			return "C1";
		}else{
			$No = (int)substr($res['id_kecamatan'], 1, 10)+1;
			$No = "C".$No;
			return $No;
		}
	}

	public function daftar_kecamatan()
	{
		$this->db->select('*')->from('idc_kecamatan')
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->order_by("substr(idc_kecamatan.id_kecamatan,1,8)*1 ASC", "idc_kecamatan.id_provinsi ASC");
		$query = $this->db->get();
		$this->jml_kecamatan = $query->num_rows();

		return $query->result();
	}

	public function daftar_kecamatan_limit($limit, $start)
	{
		$this->db->select('*')->from('idc_kecamatan')
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->order_by("substr(idc_kecamatan.id_kecamatan,2,8)*1 ASC", "idc_kecamatan.id_provinsi ASC")
		->limit($limit,$start);
		$query = $this->db->get();

		return $query->result();
	}
	
	public function cari_kecamatan_by_id($id)
	{
		$query = $this->db->get_where("idc_kecamatan",array('id_kecamatan'=>$id));
		return $query->row();
	}

	public function cari_kecamatan_by_id_kabupaten($id)
	{
		$query = $this->db->get_where("idc_kecamatan",array('id_kabupaten'=>$id));
		$this->jml_kecamatan = $query->num_rows();
		return $query->result();
	}

	public function cari_kecamatan_by_nama($nama)
	{
		$term = $this->db->escape($nama);

		$this->db->select('*')->from('idc_kecamatan')
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->like("idc_kecamatan.nama_kecamatan",$term)
		->order_by("substr(idc_kecamatan.id_kecamatan,1,8)*1 ASC", "idc_kecamatan.id_provinsi ASC");
		$query = $this->db->get();
		$this->jml_kecamatan = $query->num_rows();
		return $query->row();
	}
	
	public function cari_kecamatan_by_nama_limit($nama, $limit, $start)
	{
		$term = $this->db->escape($nama);

		$this->db->select('*')->from('idc_kecamatan')
		->join('idc_kabupaten', 'idc_kecamatan.id_kabupaten = idc_kabupaten.id_kabupaten', "INNER")
		->join('idc_provinsi', 'idc_kabupaten.id_provinsi = idc_provinsi.id_provinsi', "INNER")
		->like("idc_kecamatan.nama_kecamatan",$term)
		->order_by("substr(idc_kecamatan.id_kecamatan,1,8)*1 ASC", "idc_kecamatan.id_provinsi ASC")
		->limit($limit, $start);
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah_kecamatan($data){
		return $this->db->insert("idc_kecamatan", $data);
	}

	public function ubah_kecamatan($data, $id){
		$this->db->set($data);
		$this->db->where("id_kecamatan",$id);
		return $this->db->update("idc_kecamatan", $data);
	}

	public function hapus_kecamatan($id){
		return $this->db->delete("idc_kecamatan", "id_kecamatan='$id'");
	}
	
	public function jumlah_kecamatan()
	{
		if($this->jml_kecamatan==0)
			$this->jml_kecamatan = $this->db->count_all_results("idc_kecamatan");
		return 	$this->jml_kecamatan;
	}


}
