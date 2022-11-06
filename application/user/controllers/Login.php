<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));
		$this->load->model('login_model');
		
		if($this->session->userdata('id_login'))
			redirect(base_url());
	}

	public function index()
	{

		$this->load->view('login_admin/login.php');
	}
	
	function autentikasi(){
		$this->form_validation->set_rules('txtIdLogin', 'Id Login','required|trim');
		$this->form_validation->set_rules('txtKataSandi', 'Kata Sandi','required|trim');
		
		$id_login = $this->input->post('txtIdLogin', TRUE);
		$kata_sandi = $this->input->post('txtKataSandi', TRUE);
		
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('status','Isi dahulu ID Login dan Kata Sandi');
			redirect(base_url().'login.html');
		}else{
			$user = $this->login_model->cari_pengguna($id_login, md5(sha1($kata_sandi)));
			if(empty($user)){
				$this->session->set_flashdata('status','ID Login atau Kata Sandi Keliru');
				redirect(base_url().'login.html');
				
			}else{
				$this->session->set_userdata('id_login', $user['id_login']);
				$this->session->set_userdata('nama_pengguna', $user['nama_pengguna']);
				$this->session->set_userdata('foto_pengguna', $user['foto_pengguna']);
				redirect(base_url());
				
				
			}
			
		}
	}
}
