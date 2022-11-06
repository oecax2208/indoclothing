<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('file'));
		
		$this->load->model(array("artikel_model","produk_model","merk_model"));
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
		
		$config['base_url'] = base_url()."artikel/";
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
			$data['data_artikel'] = $this->artikel_model->daftar_artikel($limit_per_page, $start_index);
		}else{
			$judul = $this->session->userdata("ses_judul_artikel");
			$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul_limit($judul, $limit_per_page, $start_index);
		}

		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();

		
		$this->load->view('template/header', $data);
		$this->load->view('artikel/artikel_view', $data);
		$this->load->view('template/footer');
	}

	public function cari()
	{
		$judul = anti_sql_injection($this->input->post("txtSearch"));
		if($judul!=""){
			$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul($judul);
			$this->session->set_userdata("sess_judul_artikel", $judul);
		}else{
			if($this->session->userdata("sess_judul_artikel"))
				$this->session->unset_userdata("ses_judul_artikel");
			redirect(base_url()."artikel.html");
		}
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->artikel_model->jumlah_artikel();

		$data['data_artikel'] = $this->artikel_model->cari_artikel_by_judul_limit($judul, $limit_per_page, $start_index);
		
		$config['base_url'] = base_url()."artikel/";
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

		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();
		
		$this->load->view('template/header', $data);
		$this->load->view('artikel/artikel_view', $data);
		$this->load->view('template/footer');
	}	

	public function tampil_artikel($slug){
		$data['artikel']= $this->artikel_model->cari_artikel_by_slug($slug);
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();
		if(!$data['artikel']){
			show_404();
		}else{
			$this->load->view('template/header', $data);
			$this->load->view('artikel/artikel', $data);
			$this->load->view('template/footer');
		}
	}
	
	public function cara_pesan(){
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();
		
		$this->load->view('template/header', $data);
		$this->load->view('artikel/cara_pemesanan', $data);
		$this->load->view('template/footer');
		
	}
}
