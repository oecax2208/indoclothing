<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		if($this->session->userdata('id_login')){
			$this->session->unset_userdata('id_login');
			$this->session->unset_userdata('nama_pengguna');
			$this->session->unset_userdata('foto');
			redirect(base_url().'login.html');
		}
	}

}
