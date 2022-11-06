<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));
		$this->load->model("provinsi_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{
		$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('provinsi/provinsi_view', $data);
		$this->load->view('template/footer');
	}

	public function cari()
	{
		$nama = ($this->input->post("txtSearch"));
		if($nama!="")
			$data['data_provinsi'] = $this->provinsi_model->cari_provinsi_by_nama($nama);
		else
			$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('provinsi/provinsi_view', $data);
		$this->load->view('template/footer');
	}

	public function cari_provinsi_by_id(){
		$id = $this->input->post("txtIdProvinsi");
		$provinsi = $this->provinsi_model->cari_provinsi_by_id($id);
		$result = json_encode($provinsi);
		echo $result;		
	}

	public function tambah()
	{
		$data['id_auto'] = $this->provinsi_model->id_provinsi_auto();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('provinsi/provinsi_tambah', $data);
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		$data['provinsi'] = $this->provinsi_model->cari_provinsi_by_id($id);

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('provinsi/provinsi_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$data['provinsi'] = $this->provinsi_model->hapus_provinsi($id);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/provinsi");
	}

	public function simpan()
	{
		$message= array(
			"required" => "{field} wajib untuk diisi",
			"max_length" =>"{field} tidak boleh lebih dari {param} karakter",
			"min_length" => "{field} setidaknya harus berisi {param} karakter"
		);
		$this->form_validation->set_rules('txtIdProvinsi', 'Id Provinsi', 'required|trim');
		$this->form_validation->set_rules('txtNamaProvinsi', 'Nama Provinsi', 'required|trim|min_length[5]|max_length[100]', $message);

		$id_provinsi = $this->input->post("txtIdProvinsi");
		$nama_provinsi = $this->input->post("txtNamaProvinsi");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtIdProvinsi" => $id_provinsi,
							"txtNamaProvinsi" => $nama_provinsi
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/provinsi/tambah-provinsi");
			
		}else{
			$data = array(
					"id_provinsi" => ($id_provinsi),
					"nama_provinsi" => ($nama_provinsi)
					);
			$this->provinsi_model->tambah_provinsi($data);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/provinsi");
		}
	}
	
	public function update()
	{
		$message= array(
			"required" => "{field} wajib untuk diisi",
			"max_length" =>"{field} tidak boleh lebih dari {param} karakter",
			"min_length" => "{field} setidaknya harus berisi {param} karakter"
		);
		$this->form_validation->set_rules('txtIdProvinsi', 'Id Provinsi', 'required|trim');
		$this->form_validation->set_rules('txtNamaProvinsi', 'Nama Provinsi', 'required|trim|min_length[5]|max_length[100]', $message);

		$id = $this->input->post("txtIdProvinsi");
		$nama_provinsi = $this->input->post("txtNamaProvinsi");

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtIdProvinsi" => ($id_provinsi),
							"txtNamaProvinsi" => ($nama_provinsi)
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/provinsi/ubah-provinsi/".$this->input->post("txtIdProvinsi"));
			
		}else{
			$data = array(
					"id_provinsi" => $id_provinsi,
					"nama_provinsi" => $nama_provinsi
					);
			$this->provinsi_model->ubah_provinsi($data, $id_provinsi);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/provinsi");
		}
	}

}
