<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql','file'));
		
		$this->load->model("slider_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{

		$data['data_slider'] = $this->slider_model->daftar_slider();
		
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('slider/slider_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('slider/slider_tambah');
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$old_data = $this->slider_model->cari_slider_by_id($id);
		
		$data['slider'] = $this->slider_model->hapus_slider($id);
		
		unlink(FCPATH.'slider_/'.$old_data->gambar_slider);

		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/slider");
	}

	public function simpan()
	{
		
		if(!is_dir("./slider_"))
			mkdir("./slider_");
			
		$config['upload_path']          = './slider_/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
		$config['overwrite'] 			= TRUE;
		//$config['file_name'] 			= $gambar_slider;
			
        $this->load->library('upload', $config);
			
        if ( ! $this->upload->do_upload('txtGambarSlider'))
        {
			$this->session->set_flashdata("status", $this->upload->display_errors());
			redirect(base_url()."admin.php/slider/tambah-slider");
		}else{
			$uploaded_data = $this->upload->data();
			$gambar_slider = $uploaded_data['file_name'];
			$data = array(
					"gambar_slider" => ($gambar_slider),
				);
				$this->slider_model->tambah_slider($data);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/slider");
		}
		
	}
}
