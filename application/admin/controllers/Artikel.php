<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('file'));
		
		$this->load->model("artikel_model");
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{

		if(!$this->session->userdata("sess_judul_artikel")){
			$data['data_artikel'] = $this->artikel_model->daftar_artikel_all();
		}else{
			$judul = $this->session->userdata("ses_judul_artikel");
			$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul($judul);
		}

		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->artikel_model->jumlah_artikel();
		
		$config['base_url'] = base_url()."admin.php/artikel/";
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

		if(!$this->session->userdata("sess_judul_artikel")){
			$data['data_artikel'] = $this->artikel_model->daftar_artikel_all();
		}else{
			$judul = $this->session->userdata("ses_judul_artikel");
			$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul_limit($judul, $limit_per_page, $start_index);
		}

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('artikel/artikel_view', $data);
		$this->load->view('template/footer');
	}

	public function cari()
	{
		$judul = ($this->input->post("txtSearch"));
		if($judul!=""){
			$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul($judul);
			$this->session->set_userdata("sess_judul_artikel", $judul);
		}else{
			if($this->session->userdata("sess_judul_artikel"))
				$this->session->unset_userdata("ses_judul_artikel");
			redirect(base_url()."admin.php/artikel");
		}
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->artikel_model->jumlah_artikel();

		$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul_limit($judul, $limit_per_page, $start_index);
		
		$config['base_url'] = base_url()."admin.php/artikel/";
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
		
		$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul_limit($judul, $limit_per_page, $start_index);

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('artikel/artikel_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('artikel/artikel_tambah');
		$this->load->view('template/footer');
	}

	public function ubah($slug)
	{
		

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);

		$data['artikel'] = $this->artikel_model->cari_artikel_by_slug($slug);
		$this->load->view('artikel/artikel_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$old_data = $this->artikel_model->cari_artikel_by_id($id);
		
		$data['artikel'] = $this->artikel_model->hapus_artikel($id);
		
		if(is_file(FCPATH.'artikel_/'.$old_data->gambar_artikel))
			unlink(FCPATH.'artikel_/'.$old_data->gambar_artikel);
		if(is_file(FCPATH.'artikel_/thumbs_artikel/'.$old_data->gambar_mini))
			unlink(FCPATH.'artikel_/thumbs_artikel/'.$old_data->gambar_mini);
		
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/artikel");
	}

	public function hapus_artikel_pilihan()
	{
		$id_artikel = $this->input->post("txtIdArtikel");
		if(count($id_artikel)>0){
			for($i=0; $i<count($id_artikel); $i++){
				$id = $id_artikel[$i];
				$old_data = $this->artikel_model->cari_artikel_by_id($id);
		
				$artikel= $this->artikel_model->hapus_artikel($id);
				
				if(is_file(FCPATH.'artikel_/'.$old_data->gambar_artikel))
					unlink(FCPATH.'artikel_/'.$old_data->gambar_artikel);
				if(is_file(FCPATH.'artikel_/thumbs_artikel/'.$old_data->gambar_mini))
					unlink(FCPATH.'artikel_/thumbs_artikel/'.$old_data->gambar_mini);
			}
			$this->session->set_flashdata("status","Sukses-Hapus");
			redirect(base_url()."admin.php/artikel");

		}else{
			echo "<script>alert('Tidak ada data yang dipilih')</script>";
			redirect(base_url()."admin.php/artikel.html","refresh");
		}

	}

	public function simpan()
	{
		$this->form_validation->set_rules('txtJudulArtikel', 'Judul Artikel', 'required|trim');
		$this->form_validation->set_rules('txtIsiSingkat', 'Isi Singkat Artikel', 'required|trim');
		$this->form_validation->set_rules('txtIsiArtikel', 'Isi Artikel', 'required|trim');
		
		$judul_artikel = $this->input->post("txtJudulArtikel", TRUE);		
		$slug_artikel = url_title($this->input->post("txtJudulArtikel", TRUE),'dash', TRUE);
		$gambar_artikel = $slug_artikel;
		$isi_artikel = $this->input->post("txtIsiArtikel", TRUE);
		$isi_singkat = $this->input->post("txtIsiSingkat", TRUE);
		$status_tampil = $this->input->post("txtStatusTampil", TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtJudulArtikel" => $judul_artikel,
							"txtIsiArtikel" => $isi_artikel,
							"txtIsiSingkat" => $isi_singkat,
							"txtStatusTampil" => $status_tampil
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/artikel/tambah-artikel");
			
		}else{
			if(!is_dir("./artikel_"))
				mkdir("./artikel_");
			
			$config['upload_path']          = './artikel_/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
			$config['overwrite'] 			= TRUE;
			$config['file_name'] 			= $gambar_artikel;
			

            $this->load->library('upload', $config);
			

            if ( ! $this->upload->do_upload('txtGambarArtikel'))
            {
				$this->session->set_flashdata("status", $this->upload->display_errors());

				$group_input = array(
								"txtJudulArtikel" => $judul_artikel,
								"txtIsiArtikel" => $isi_artikel,
								"txtIsiSingkat" => $isi_singkat,
								"txtStatusTampil" => $status_tampil
							);
				
				$this->session->set_flashdata("group_input",$group_input);
				redirect(base_url()."admin.php/artikel/tambah-artikel");
            }else{
				$uploaded_data = $this->upload->data();
				$this->create_thumbs($uploaded_data['full_path'], $gambar_artikel.$uploaded_data['file_ext']);
				$data = array(
						"judul_artikel" => ($judul_artikel),
						"isi_artikel" => ($isi_artikel),
						"isi_singkat" => ($isi_singkat),
						"gambar_artikel" => ($gambar_artikel.$uploaded_data['file_ext']),
						"gambar_mini" => ($gambar_artikel."_thumb".$uploaded_data['file_ext']),
						"slug_artikel" => ($slug_artikel),
						"status_tampil" => ($status_tampil)
						);
				$this->artikel_model->tambah_artikel($data);
				$this->session->set_flashdata("status","Sukses");
				redirect(base_url()."admin.php/artikel");
			}
		}
	}
	
	public function update()
	{
		$this->form_validation->set_rules('txtJudulArtikel', 'Judul Artikel', 'required|trim');
		$this->form_validation->set_rules('txtIsiSingkat', 'Isi Singkat Artikel', 'required|trim');
		$this->form_validation->set_rules('txtIsiArtikel', 'Isi Artikel', 'required|trim');
		
		$id_artikel = $this->input->post("txtIdArtikel", TRUE);		
		$judul_artikel = $this->input->post("txtJudulArtikel", TRUE);		
		$slug_artikel = url_title($this->input->post("txtJudulArtikel", TRUE),'dash', TRUE);
		$gambar_artikel = $slug_artikel;
		$isi_artikel = $this->input->post("txtIsiArtikel", TRUE);
		$isi_singkat = $this->input->post("txtIsiSingkat", TRUE);
		$status_tampil = $this->input->post("txtStatusTampil", TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
						"txtJudulArtikel" => $judul_artikel,
						"txtIsiArtikel" => $isi_artikel,
						"txtIsiSingkat" => $isi_singkat,
						"txtStatusTampil" => $status_tampil
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/artikel/ubah-artikel/".$id_artikel.".html");
			
		}else{
			if(!$_FILES['txtGambarArtikel']['name']==""){
				
				if(!is_dir("./artikel_"))					
					mkdir("./artikel_");
				
				$config['upload_path']          = './artikel_/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 2048;
				$config['overwrite'] 			= TRUE;
				$config['file_name'] 			= $gambar_artikel;
				

				$this->load->library('upload', $config);
				

				if ( ! $this->upload->do_upload('txtGambarArtikel'))
				{
					$this->session->set_flashdata("status", $this->upload->display_errors());

					$group_input = array(
								"txtJudulArtikel" => $judul_artikel,
								"txtIsiArtikel" => $isi_artikel,
								"txtIsiSingkat" => $isi_singkat,
								"txtStatusTampil" => $status_tampil
							);
					
					$this->session->set_flashdata("group_input",$group_input);
					redirect(base_url()."admin.php/artikel/ubah-artikel/".$id_artikel.".html");
				}else{
					$uploaded_data = $this->upload->data();
					$this->create_thumbs($uploaded_data['full_path'], $gambar_artikel.$uploaded_data['file_ext']);
					$data = array(
						"judul_artikel" => ($judul_artikel),
						"isi_artikel" => ($isi_artikel),
						"isi_singkat" => ($isi_singkat),
						"gambar_artikel" => ($gambar_artikel.$uploaded_data['file_ext']),
						"gambar_mini" => ($gambar_artikel."_thumb".$uploaded_data['file_ext']),
						"slug_artikel" => ($slug_artikel),
						"status_tampil" => ($status_tampil)
						);
				}
			}else{
				$data = array(
						"judul_artikel" => ($judul_artikel),
						"isi_artikel" => ($isi_artikel),
						"isi_singkat" => ($isi_singkat),
						"slug_artikel" => ($slug_artikel),
						"status_tampil" => ($status_tampil)
						);
			}
			$this->artikel_model->ubah_artikel($data, $id_artikel);
			
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/artikel");
		}
	}
	
	private function create_thumbs($str_source, $str_file){
		
		if(!is_dir("./artikel_/thumbs_artikel"))
			mkdir("./artikel_/thumbs_artikel");
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $str_source;
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio'] 	= FALSE;
		$config['width']         	= 250;
		$config['height']       	= 250;
		$config['new_image'] 		= "./artikel_/thumbs_artikel/".$str_file;

		$this->load->library('image_lib', $config);

		return $this->image_lib->resize();
	}

}
