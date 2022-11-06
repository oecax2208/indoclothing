<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));		
		$this->load->model("kategori_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."login.html");
	}

	public function index()
	{
		$data['data_kategori'] = $this->kategori_model->daftar_kategori();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kategori/kategori_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");

		$this->load->view('template/header',$data);
		$this->load->view('kategori/kategori_tambah');
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		$data['kategori'] = $this->kategori_model->cari_kategori_by_id($id);

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kategori/kategori_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$data['kategori'] = $this->kategori_model->hapus_kategori($id);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."kategori");
	}

	public function simpan()
	{
		$message= array(
			"required"    => "{field} wajib untuk diisi",
			"max_length"  => "{field} tidak boleh lebih dari {param} karakter",
			"min_length"  => "{field} setidaknya harus berisi {param} karakter",
			"integer"     => "{field} harus berupa Integer"
		);
		$this->form_validation->set_rules('txtNamaKategori', 'Nama Kategori', 'required|trim|min_length[5]|max_length[30]', $message);

		$nama_kategori = $this->input->post("txtNamaKategori");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtNamaKategori" => $nama_kategori
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."kategori/tambah-kategori.html");
			
		}else{
			$data = array(
					"nama_kategori" => anti_sql_injection($nama_kategori)
					);
			$this->kategori_model->tambah_kategori($data);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."kategori");
		}
	}
	
	public function update()
	{
		$message= array(
			"required"    => "{field} wajib untuk diisi",
			"max_length"  => "{field} tidak boleh lebih dari {param} karakter",
			"min_length"  => "{field} setidaknya harus berisi {param} karakter",
			"integer"     => "{field} harus berupa Integer"
		);
		$this->form_validation->set_rules('txtIdKategori', 'Id Kategori', 'required|trim');
		$this->form_validation->set_rules('txtNamaKategori', 'Nama Kategori', 'required|trim|min_length[5]|max_length[30]', $message);

		$id = $this->input->post("txtIdKategori");
		$nama_kategori = $this->input->post("txtNamaKategori");

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
			    "txtIdKategori" => $id_kategori,
				"txtNamaKategori" => $nama_kategori
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."kategori/ubah-kategori/".$this->input->post("txtIdKategori"));
			
		}else{
			$data = array(
				"id_kategori" => anti_sql_injection($id),
				"nama_kategori" => anti_sql_injection($nama_kategori)
			);
			$this->kategori_model->ubah_kategori($data, $id);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."kategori");
		}
	}

}
