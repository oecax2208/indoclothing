<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambar_produk extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql','file'));
		
		$this->load->model("gambar_produk_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{

		show_404();
	}

	public function daftar_gambar($kode_produk)
	{

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$data['data_gambar_produk'] = $this->gambar_produk_model->daftar_gambar($kode_produk);
		$data['kode_produk'] = $kode_produk;
		$this->load->view('gambar_produk/gambar_produk_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah($kode_produk)
	{
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$data['kode_produk'] = $kode_produk;
		
		$this->load->view('template/header', $data);
		$this->load->view('gambar_produk/gambar_produk_tambah');
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$old_data = $this->gambar_produk_model->cari_gambar_by_id($id);
		
		$data['gambar'] = $this->gambar_produk_model->hapus_gambar($id);
		
		if(file_exists(FCPATH.'gambar_produk_/'.$old_data->gambar_produk))
			unlink(FCPATH.'gambar_produk_/'.$old_data->gambar_produk);
		if(file_exists(FCPATH.'gambar_produk_/thumbs_gambar_produk/'.$old_data->gambar_produk_mini))
			unlink(FCPATH.'gambar_produk_/thumbs_gambar_produk/'.$old_data->gambar_produk_mini);
		
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/gambar-produk/".$old_data->kode_produk."");
	}

	public function simpan()
	{
		$this->form_validation->set_rules('txtKodeProduk', 'Kode Produk', 'required|trim');

		$kode_produk = $this->input->post("txtKodeProduk", TRUE);
		$gambar_produk = url_title($this->input->post("txtKodeProduk", TRUE),'dash', TRUE);
		$no = $this->gambar_produk_model->nomor_gambar($kode_produk);
		$gambar_produk = $gambar_produk."_".$no;
		

		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtKodeProduk" => $kode_produk,
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/gambar-produk/tambah-gambar-produk/".$kode_produk);
			
		}else{
			if(!is_dir("./gambar_produk_"))
				mkdir("./gambar_produk_");
			
			$config['upload_path']          = './gambar_produk_/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
			$config['overwrite'] 			= TRUE;
			$config['file_name'] 			= $gambar_produk;
			

            $this->load->library('upload', $config);
			

            if ( ! $this->upload->do_upload('txtGambarProduk'))
            {
				$this->session->set_flashdata("status", $this->upload->display_errors());

				$group_input = array(
								"txtKodeProduk" => $kode_produk,
							);
				
				$this->session->set_flashdata("group_input",$group_input);
				redirect(base_url()."admin.php/gambar-produk/tambah-gambar-produk/".$kode_produk);
            }else{
				$uploaded_data = $this->upload->data();
				$this->create_thumbs($uploaded_data['full_path'], $gambar_produk.$uploaded_data['file_ext']);
				$this->resize($uploaded_data['full_path'], $gambar_produk.$uploaded_data['file_ext']);

				$data = array(
						"kode_produk" => $kode_produk,
						"gambar_produk" => $gambar_produk.$uploaded_data['file_ext'],
						"gambar_produk_mini" => $gambar_produk."_thumb".$uploaded_data['file_ext'],
						);
				$this->gambar_produk_model->tambah_gambar($data);
				$this->session->set_flashdata("status","Sukses");
				redirect(base_url()."admin.php/gambar-produk/".$kode_produk);
			}
		}
	}
	

	private function create_thumbs($str_source, $str_file){
		
		if(!is_dir("./gambar_produk_/thumbs_gambar_produk"))
			mkdir("./gambar_produk_/thumbs_gambar_produk");
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio'] 	= FALSE;
		$config['width']         	= 200;
		$config['height']       	= 200;
		$config['new_image'] 		= "./gambar_produk_/thumbs_gambar_produk/".$str_file;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}

	private function resize($str_source, $str_file){

		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio'] 	= FALSE;
		$config['width']         	= 500;
		$config['height']       	= 500;
		$config['new_image']       	= "./gambar-produk/".$str_file;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}
}
