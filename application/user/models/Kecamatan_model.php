<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_model extends CI_Model {
	
	private $jml_kecamatan = 0;
	
	public function __construct(){
		$this->load->database();
	}

	public function cari_kecamatan_by_id_kabupaten($id)
	{
		$query = $this->db->get_where("idc_kecamatan",array('id_kabupaten'=>$id));
		$this->jml_kecamatan = $query->num_rows();
		return $query->result();
	}

	public function jumlah_kecamatan()
	{
		if($this->jml_kecamatan==0)
			$this->jml_kecamatan = $this->db->count_all_results("idc_kecamatan");
		return 	$this->jml_kecamatan;
	}


}
