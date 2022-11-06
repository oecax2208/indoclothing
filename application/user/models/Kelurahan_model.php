<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan_model extends CI_Model {
	
	private $jml_kelurahan = 0;
	
	public function __construct(){
		$this->load->database();
	}

	public function cari_kelurahan_by_id_kecamatan($id){
		$query = $this->db->get_where("idc_kelurahan", array("id_kecamatan" => $id);
		$this->jml_kelurahan = $query->num_rows();
		return $query->result();
	}

	public function jumlah_kelurahan()
	{
		if($this->jml_kelurahan==0)
			$this->jml_kelurahan = $this->db->count_all_results("idc_kelurahan");
		return 	$this->jml_kelurahan;
	}


}
