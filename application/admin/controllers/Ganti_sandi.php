<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ganti_sandi extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		
		$this->load->model("ganti_sandi_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{
		$id = $this->session->userdata("id_login");

		$data['admin'] = $this->ganti_sandi_model->cari_admin_by_id($id);
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		$data['id_login'] = $id;
		
		$this->load->view('template/header', $data);
		$this->load->view('login_admin/ganti_sandi', $data);
		$this->load->view('template/footer');
	}

	public function simpan()
	{
		$message= array(
			"required" => "{field} wajib untuk diisi",
			"max_length" =>"{field} tidak boleh lebih dari {param} karakter",
			"min_length" => "{field} setidaknya harus berisi {param} karakter"
		);
		$this->form_validation->set_rules('txtIdLogin', 'Id Login', 'required|trim');
		$this->form_validation->set_rules('txtIdLoginOld', 'Id Login', 'required|trim');
		$this->form_validation->set_rules('txtNamaPengguna', 'Nama Login', 'required|trim|min_length[5]|max_length[100]', $message);
		$this->form_validation->set_rules('txtKataSandi', 'Kata Sandi', 'required', $message);

		$id_login = $this->input->post("txtIdLogin");
		$id_login_old = $this->input->post("txtIdLoginOld");
		$nama_pengguna = $this->input->post("txtNamaPengguna");
		$kata_sandi = $this->input->post("txtKataSandi");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtIdLogin" => $id_login,
							"txtIdLoginOld" => $id_login_old,
							"txtNamaPengguna" => $nama_pengguna,
							"txtKataSandi" => $kata_sandi
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/ganti-sandi");
			
		}else{
			$data = array(
					"id_login" => $id_login,
					"nama_pengguna" => $nama_pengguna,
					"kata_sandi" => md5(sha1($kata_sandi))
					);
			$this->ganti_sandi_model->ganti_sandi($data,$id_login_old);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/ganti-sandi");
		}
	}

}
