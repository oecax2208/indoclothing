<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->database();
		
	}

	public function index()
	{
		$this->db->select("*")
		->from("idc_kabupaten")
		->join("idc_provinsi","idc_kabupaten.id_provinsi=idc_provinsi.id_provinsi")
		->join("idc_kecamatan", "idc_kabupaten.id_kabupaten=idc_kecamatan.id_kabupaten")
		->order_by("substr(id_kecamatan,2,8)*1 ASC");
		//->limit(2000, 0);
		$kecamatan = $this->db->get()->result();
		$no = 1;
		foreach($kecamatan as $kc){
			$np = $kc->nama_provinsi;
			$nk = $kc->nama_kabupaten;
			$nc = $kc->nama_kecamatan;
			$ik = $kc->id_kecamatan;
		

			$this->db
			->select("*")
			->from("wilayah")
			->where("provinsi",$np)
			->where("kabupaten", $nk)
			->where("kecamatan", $nc)
			//->group_by("kecamatan,kabupaten, provinsi")
			->order_by("id");
			
			$kelurahan = $this->db->get()->result();
			
			foreach($kelurahan as $kl){
				$n = "L".$no;
				$nl = $kl->kelurahan;
				$kp = $kl->kode_pos;
				$data = array(
				"id_kelurahan" => $n,
				"id_kecamatan" => $ik,
				"nama_kelurahan" => $nl,
				"kode_pos" => $kp
				);
				$this->db->insert("idc_kelurahan", $data);
				echo "$n. $kc->nama_provinsi - $kc->nama_kabupaten- $kc->nama_kecamatan - $nl  - $kp <br />";
				$no++;
			}
		}
	}
}
