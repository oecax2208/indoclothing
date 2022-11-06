<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql','file'));
		
		$this->load->model("merk_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{

		$data['data_merk'] = $this->merk_model->daftar_merk();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('merk/merk_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('merk/merk_tambah');
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		
		$data['merk'] = $this->merk_model->cari_merk_by_id($id);

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('merk/merk_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$old_data = $this->merk_model->cari_merk_by_id($id);		
		$data['merk'] = $this->merk_model->hapus_merk($id);
		
		unlink(FCPATH.'merk_/'.$old_data->gambar_merk);		
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/merk");
	}

	public function simpan()
	{
		$this->form_validation->set_rules('txtNamaVendor', 'Nama Vendor', 'required|trim');
		$this->form_validation->set_rules('txtMerk', 'Merk', 'required|trim');

		$nama_vendor = $this->input->post("txtNamaVendor", TRUE);
		$gambar_merk = url_title(strtolower($this->input->post("txtMerk", TRUE)),'dash', TRUE);
		$merk = $this->input->post("txtMerk", TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
						"txtNamaVendor" => $nama_vendor,
						"txtMerk" => $merk,
					);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/merk/tambah-merk");
			
		}else{
			if(!is_dir("./merk_"))
				mkdir("./merk_");
			
			$config['upload_path']          = './merk_/';
            $config['allowed_types']        = 'gif|jpg|png';
			$config['overwrite'] 			= TRUE;
			$config['file_name'] 			= $gambar_merk;
			

            $this->load->library('upload', $config);
			

            if ( ! $this->upload->do_upload('txtGambarMerk'))
            {
				$this->session->set_flashdata("status", $this->upload->display_errors());

				$group_input = array(
								"txtNamaVendor" => $nama_vendor,
								"txtMerk" => $merk
							);
				
				$this->session->set_flashdata("group_input",$group_input);
				redirect(base_url()."admin.php/merk/tambah-merk");
            }else{
				$uploaded_data = $this->upload->data();
				$this->create_thumbs($uploaded_data['full_path'], $gambar_merk.$uploaded_data['file_ext']);
				$data = array(
						"merk" => strtoupper(($merk)),
						"nama_vendor" => strtoupper(($nama_vendor)),
						"gambar_merk" => ($gambar_merk.$uploaded_data['file_ext'])
						);
				$this->merk_model->tambah_merk($data);
				$this->session->set_flashdata("status","Sukses");
				redirect(base_url()."admin.php/merk");
			}
		}
	}
	
	public function update()
	{
		$this->form_validation->set_rules('txtIdMerk', 'ID Merk', 'required|trim');
		$this->form_validation->set_rules('txtNamaVendor', 'Judul Merk', 'required|trim');
		$this->form_validation->set_rules('txtMerk', 'Deskripsi Merk', 'required|trim');

		$id_merk = $this->input->post("txtIdMerk", TRUE);
		$nama_vendor = $this->input->post("txtNamaVendor", TRUE);
		$gambar_merk = url_title(strtolower($this->input->post("txtMerk", TRUE)),'dash', TRUE);
		$merk = $this->input->post("txtMerk");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtIdMerk" => $id_merk,
							"txtNamaVendor" => $nama_vendor,
							"txtMerk" => $merk
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/merk/ubah-merk/".$id_merk."");
			
		}else{
			if(!$_FILES['txtGambarMerk']['name']==""){
				if(!is_dir("./merk_"))					
					mkdir("./merk_");
				
				$config['upload_path']          = './merk_/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['overwrite'] 			= TRUE;
				$config['file_name'] 			= $gambar_merk;
				

				$this->load->library('upload', $config);
				

				if ( ! $this->upload->do_upload('txtGambarMerk'))
				{
					$this->session->set_flashdata("status", $this->upload->display_errors());

					$group_input = array(
									"txtNamaVendor" => $merk,
									"txtMerk" => $merk								);
					
					$this->session->set_flashdata("group_input",$group_input);
					redirect(base_url()."admin.php/merk/ubah-merk/".$id_merk."");
				}else{
					$uploaded_data = $this->upload->data();
					$this->create_thumbs($uploaded_data['full_path'], $gambar_merk.$uploaded_data['file_ext']);
					$data = array(
							"nama_vendor" => strtoupper(($nama_vendor)),
							"merk" => strtoupper(($merk)),
							"gambar_merk" => ($gambar_merk.$uploaded_data['file_ext']),
							);
				}
			}else{
				$data = array(
						"nama_vendor" => ($nama_vendor),
						"merk" => ($merk)
						);
			}
			$this->merk_model->ubah_merk($data, $id_merk);			
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/merk");
		}
	}

	private function create_thumbs($str_source, $str_file){
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= TRUE;
		$config['height']       	= 100;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}

}
