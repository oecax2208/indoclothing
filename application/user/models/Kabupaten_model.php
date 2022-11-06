<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten_model extends CI_Model {
	private $jml_kabupaten=-1;
	
	public function __construct(){
		$this->load->database();
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
	
	public function cari_kabupaten_by_id_provinsi($id)
	{
		$query = $this->db->get_where("idc_kabupaten",array('id_provinsi'=>$id));
		$this->jml_kabupaten= $query->num_rows();
		return $query->result();
	}

	
	public function jumlah_kabupaten()
	{
		if($this->jml_kabupaten== -1)
			$this->jml_kabupaten= $this->db->count_all_results("idc_kabupaten");
		return $this->jml_kabupaten;
	}


}
