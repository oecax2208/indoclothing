<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ganti_sandi_model extends CI_Model {
	
	public function __construct(){
		$this->load->database();
	}
	
	public function cari_admin_by_id($id)
	{
		$query = $this->db->get_where("idc_admin__",array('id_login'=>$id));
		return $query->row();
	}
	
	public function ganti_sandi($data, $id){
		$this->db->set($data);
		$this->db->where("id_login",$id);
		return $this->db->update("idc_admin__", $data);
	}

	public function hapus_admin($id){
		return $this->db->delete("idc_admin__", "id_login='$id'");
	}

	public function jumlah_admin()
	{
		$count = $this->db->count_all_result("idc_admin__");
		return $count;
	}


}
