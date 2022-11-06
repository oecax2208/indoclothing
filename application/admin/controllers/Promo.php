<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql','file'));
		
		$this->load->model("promo_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{

		if(!$this->session->userdata("sess_judul_promo")){
			$data['data_promo'] = $this->promo_model->daftar_promo_all();
		}else{
			$judul = $this->session->userdata("ses_judul_promo");
			$data['data_promo'] = $this->promo_model->cari_promo_by_judul($judul);
		}

		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->promo_model->jumlah_promo();
		
		$config['base_url'] = base_url()."admin.php/promo/";
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

		if(!$this->session->userdata("sess_judul_promo")){
			$data['data_promo'] = $this->promo_model->daftar_promo_all();
		}else{
			$judul = $this->session->userdata("ses_judul_promo");
			$data['data_promo'] = $this->promo_model->cari_promo_by_judul_limit($judul, $limit_per_page, $start_index);
		}

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('promo/promo_view', $data);
		$this->load->view('template/footer');
	}

	public function cari()
	{
		$judul = ($this->input->post("txtSearch"));
		if($judul!=""){
			$data['data_promo'] = $this->promo_model->cari_promo_by_judul($judul);
			$this->session->set_userdata("sess_judul_promo", $judul);
		}else{
			if($this->session->userdata("sess_judul_promo"))
				$this->session->unset_userdata("ses_judul_promo");
			redirect(base_url()."admin.php/promo");
		}
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->promo_model->jumlah_promo();

		$data['data_promo'] = $this->promo_model->cari_promo_by_judul_limit($judul, $limit_per_page, $start_index);
		
		$config['base_url'] = base_url()."admin.php/promo/";
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
		
		$data['data_promo'] = $this->promo_model->cari_promo_by_judul_limit($judul, $limit_per_page, $start_index);

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('promo/promo_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('promo/promo_tambah');
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		
		$data['promo'] = $this->promo_model->cari_promo_by_id($id);

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('promo/promo_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$old_data = $this->promo_model->cari_promo_by_id($id);
		
		$data['promo'] = $this->promo_model->hapus_promo($id);
		
		unlink(FCPATH.'promo_/'.$old_data->gambar_promo);
		
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/promo");
	}

	public function simpan()
	{
		$message= array(
			"required"    => "{field} wajib untuk diisi",
			"max_length"  => "{field} tidak boleh lebih dari {param} karakter",
			"min_length"  => "{field} setidaknya harus berisi {param} karakter",
			"integer"     => "{field} harus berupa Integer"
		);

		$this->form_validation->set_rules('txtJudulPromo', 'Judul Promo', 'required|trim', $message);
		$judul_promo = $this->input->post("txtJudulPromo", TRUE);
		$gambar_promo = url_title($this->input->post("txtJudulPromo", TRUE),'dash', TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtJudulPromo" => $judul_promo,
							"txtDeskripsiPromo" => $deskripsi_promo,
							"txtStatusAktif" => $status_aktif
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/promo/tambah-promo");
			
		}else{
			if(!is_dir("./promo_"))
				mkdir("./promo_");
			
			$config['upload_path']          = './promo_/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
			$config['overwrite'] 			= TRUE;
			$config['file_name'] 			= $gambar_promo;
			

            $this->load->library('upload', $config);
			

            if ( ! $this->upload->do_upload('txtGambarPromo'))
            {
				$this->session->set_flashdata("status", $this->upload->display_errors());

				$group_input = array(
								"txtJudulPromo" => $judul_promo,
							);
				
				$this->session->set_flashdata("group_input",$group_input);
				redirect(base_url()."admin.php/promo/tambah-promo");
            }else{
				$uploaded_data = $this->upload->data();
				$this->create_thumbs($uploaded_data['full_path'], $uploaded_data['full_path']);
				$data = array(
						"judul_promo" => ($judul_promo),
						"gambar_promo" => ($gambar_promo.$uploaded_data['file_ext']),
						);
				$this->promo_model->tambah_promo($data);
				$this->session->set_flashdata("status","Sukses");
				redirect(base_url()."admin.php/promo");
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

		$this->form_validation->set_rules('txtIdPromo', 'ID Promo', 'required|trim', $message);
		$this->form_validation->set_rules('txtJudulPromo', 'Judul Promo', 'required|trim', $message);

		$id_promo = $this->input->post("txtIdPromo", TRUE);
		$judul_promo = $this->input->post("txtJudulPromo", TRUE);
		$gambar_promo = url_title($this->input->post("txtJudulPromo", TRUE),'dash', TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtIdPromo" => $id_promo,
							"txtJudulPromo" => $judul_promo,
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/promo/ubah-promo/".$id_promo."");
			
		}else{
			if(!$_FILES['txtGambarPromo']['name']==""){
				
				if(!is_dir("./promo_"))					
					mkdir("./promo_");
				
				$config['upload_path']          = './promo_/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 2048;
				$config['overwrite'] 			= TRUE;
				$config['file_name'] 			= $gambar_promo;
				

				$this->load->library('upload', $config);
				

				if ( ! $this->upload->do_upload('txtGambarPromo'))
				{
					$this->session->set_flashdata("status", $this->upload->display_errors());

					$group_input = array(
									"txtJudulPromo" => $judul_promo,
								);
					
					$this->session->set_flashdata("group_input",$group_input);
					redirect(base_url()."admin.php/promo/ubah-promo/".$id_promo."");
				}else{
					$uploaded_data = $this->upload->data();
					$this->create_thumbs($uploaded_data['full_path'], $uploaded_data['full_path']);
					$data = array(
							"judul_promo" => ($judul_promo),
							"gambar_promo" => ($gambar_promo.$uploaded_data['file_ext']),
							);
				}
			}else{
				$data = array(
						"judul_promo" => ($judul_promo),
						);
			}
			$this->promo_model->ubah_promo($data, $id_promo);
			
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/promo");
		}
	}

	private function create_thumbs($str_source, $str_file){
		
		if(!is_dir("./promo_"))
			mkdir("./promo_");
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= FALSE;
		$config['width']         	= 450;
		$config['height']       	= 200;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}

}
