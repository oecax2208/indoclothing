<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql','file'));
		
		$this->load->model("kategori_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
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
		
		$this->load->view('template/header', $data);
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
		$old_data = $this->kategori_model->cari_kategori_by_id($id);
		
		$data['kategori'] = $this->kategori_model->hapus_kategori($id);
		
		unlink(FCPATH.'upload_kategori/'.$old_data->gambar_kategori);
		
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/kategori");
	}

	public function simpan()
	{
		$message= array(
			"required"    => "{field} wajib untuk diisi",
			"max_length"  => "{field} tidak boleh lebih dari {param} karakter",
			"min_length"  => "{field} setidaknya harus berisi {param} karakter",
			"integer"     => "{field} harus berupa Integer"
		);

		$this->form_validation->set_rules('txtNamaKategori', 'Nama Kategori', 'required|trim', $message);

		$nama_kategori = $this->input->post("txtNamaKategori", TRUE);
		$gambar_kategori = url_title($this->input->post("txtNamaKategori", TRUE),'dash', TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtNamaKategori" => $nama_kategori
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kategori/tambah-kategori");
			
		}else{
			if(!is_dir("./kategori_"))
				mkdir("./kategori_");
			
			$config['upload_path']          = './kategori_/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
			$config['overwrite'] 			= TRUE;
			$config['file_name'] 			= $gambar_kategori;
			

            $this->load->library('upload', $config);
			

            if ( ! $this->upload->do_upload('txtGambarKategori'))
            {
				$this->session->set_flashdata("status", $this->upload->display_errors());

				$group_input = array(
								"txtNamaKategori" => $nama_kategori
							);
				
				$this->session->set_flashdata("group_input",$group_input);
				redirect(base_url()."admin.php/kategori/tambah-kategori");
            }else{
				$uploaded_data = $this->upload->data();
				$this->create_thumbs($uploaded_data['full_path'], $gambar_kategori.$uploaded_data['file_ext']);
				$data = array(
						"nama_kategori" => ($nama_kategori),
						"gambar_kategori" => ($gambar_kategori.$uploaded_data['file_ext'])
						);
				$this->kategori_model->tambah_kategori($data);
				$this->session->set_flashdata("status","Sukses");
				redirect(base_url()."admin.php/kategori");
			}
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

		$this->form_validation->set_rules('txtIdKategori', 'ID Kategori', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaKategori', 'Nama Kategori', 'required|trim', $message);

		$id_kategori = $this->input->post("txtIdKategori", TRUE);
		$nama_kategori = $this->input->post("txtNamaKategori", TRUE);
		$gambar_kategori = url_title($this->input->post("txtNamaKategori", TRUE),'dash', TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtIdKategori" => $id_kategori,
							"txtNamaKategori" => $nama_kategori
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kategori/ubah-kategori/".$id_kategori."");
			
		}else{
			if(!$_FILES['txtGambarKategori']['name']==""){
				
				if(!is_dir("./kategori_"))					
					mkdir("./kategori_");
				
				$config['upload_path']          = './kategori_/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 2048;
				$config['overwrite'] 			= TRUE;
				$config['file_name'] 			= $gambar_kategori;
				

				$this->load->library('upload', $config);
				

				if ( ! $this->upload->do_upload('txtGambarKategori'))
				{
					$this->session->set_flashdata("status", $this->upload->display_errors());

					$group_input = array(
							"txtIdKategori" => $id_kategori,
							"txtNamaKategori" => $nama_kategori
						);
					
					$this->session->set_flashdata("group_input",$group_input);
					redirect(base_url()."admin.php/kategori/ubah-kategori/".$id_kategori."");
				}else{
					$uploaded_data = $this->upload->data();
					$this->create_thumbs($uploaded_data['full_path'], $gambar_kategori.$uploaded_data['file_ext']);
					$data = array(
							"nama_kategori" => ($nama_kategori),
							"gambar_kategori" => ($gambar_kategori.$uploaded_data['file_ext'])
							);
				}
			}else{
				$data = array(
						"nama_kategori" => ($nama_kategori),
						);
			}
			$this->kategori_model->ubah_kategori($data, $id_kategori);
			
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/kategori");
		}
	}
	
	private function create_thumbs($str_source, $str_file){
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= FALSE;
		$config['width']         	= 200;
		$config['height']       	= 200;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}

}
