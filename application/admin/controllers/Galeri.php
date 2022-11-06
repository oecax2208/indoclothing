<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','file'));
		
		$this->load->model("galeri_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{

		$data['data_galeri'] = $this->galeri_model->daftar_galeri();
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->galeri_model->jumlah_galeri();
		
		$config['base_url'] = base_url()."admin.php/galeri/";
		$config['total_rows'] = $total_records;
		$config['per_page'] = $limit_per_page;
		$config['num_links'] = 2;
        
        $config['first_link']       = 'Pertama';
        $config['last_link']        = 'Terakhir';
        $config['next_link']        = 'Selanjutnya';
        $config['prev_link']        = 'Sebelumnya';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="TRUE">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';	

		$this->load->library("pagination");
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start_index'] = $start_index;
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);

		$data['data_galeri'] = $this->galeri_model->daftar_galeri_limit($limit_per_page, $start_index);

		$this->load->view('galeri/galeri_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('galeri/galeri_tambah');
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$old_data = $this->galeri_model->cari_galeri_by_id($id);
		
		$data['galeri'] = $this->galeri_model->hapus_galeri($id);
		
		unlink(FCPATH.'galeri_/'.$old_data->gambar_galeri);
		unlink(FCPATH.'galeri_/thumbs_galeri/'.$old_data->gambar_mini_galeri);

		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/galeri");
	}

	public function hapus_galeri_pilihan()
	{
		$id_galeri = $this->input->post("txtIdGaleri");
		if(count($id_galeri)>0){
			for($i=0;$i<count($id_galeri);$i++){
				$id = $id_galeri[$i];
				$old_data = $this->galeri_model->cari_galeri_by_id($id);
				
				$data['galeri'] = $this->galeri_model->hapus_galeri($id);
				
				unlink(FCPATH.'galeri_/'.$old_data->gambar_galeri);
				unlink(FCPATH.'galeri_/thumbs_galeri/'.$old_data->gambar_mini_galeri);
			}
			$this->session->set_flashdata("status","Sukses-Hapus");
			redirect(base_url()."admin.php/galeri");
		}else{
			echo "<script>alert('Tidak ada data yang dipilih')</script>";
			redirect(base_url()."admin.php/galeri",'refresh');	
		}

	}
	public function simpan()
	{
		$this->form_validation->set_rules('txtJudulGaleri', 'Nama Vendor', 'required|trim');
		
		$judul_galeri = $this->input->post("txtJudulGaleri", TRUE);
		$deskripsi_galeri = $this->input->post("txtDeskripsiGaleri", TRUE);
		$gambar_galeri = url_title($this->input->post("txtJudulGaleri", TRUE),'dash', TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtJudulGaleri" => $judul_galeri,
							"txtDeskripsiGaleri" => $deskripsi_galeri
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/galeri/tambah-galeri");
			
		}else{
			if(!is_dir("./galeri_"))
				mkdir("./galeri_");
			
			$config['upload_path']          = './galeri_/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
			$config['overwrite'] 			= TRUE;
			$config['file_name'] 			= $gambar_galeri;
			

            $this->load->library('upload', $config);
			

            if ( ! $this->upload->do_upload('txtGambarGaleri'))
            {
				$this->session->set_flashdata("status", $this->upload->display_errors());

				$group_input = array(
								"txtJudulGaleri" => $judul_galeri,
								"txtDeskripsiGaleri" => $deskripsi_galeri
							);
				
				$this->session->set_flashdata("group_input",$group_input);
				redirect(base_url()."admin.php/galeri/tambah-galeri");
            }else{
				$uploaded_data = $this->upload->data();
				$this->create_thumbs($uploaded_data['full_path'], $gambar_galeri.$uploaded_data['file_ext']);
				$this->resize($uploaded_data['full_path']);
				$data = array(
						"judul_galeri" => ($judul_galeri),
						"deskripsi_galeri" => ($deskripsi_galeri),
						"gambar_galeri" => ($gambar_galeri.$uploaded_data['file_ext']),
						"gambar_mini_galeri" => ($gambar_galeri."_thumb".$uploaded_data['file_ext'])
						);
				$this->galeri_model->tambah_galeri($data);
				$this->session->set_flashdata("status","Sukses");
				redirect(base_url()."admin.php/galeri");
			}
		}
	}
	
	private function create_thumbs($str_source, $str_file){
		
		if(!is_dir("./galeri_/thumbs_galeri"))
			mkdir("./galeri_/thumbs_galeri");
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio'] 	= FALSE;
		$config['width']         	= 200;
		$config['height']       	= 200;
		$config['new_image'] 		= "./galeri_/thumbs_galeri/".$str_file;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}

	private function resize($str_source){
		
		if(!is_dir("./galeri_/"))
			mkdir("./galeri_/");
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= FALSE;
		$config['width']         	= 600;
		$config['height']       	= 600;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}

}
