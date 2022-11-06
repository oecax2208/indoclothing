<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));
		$this->load->library("session");
		$this->load->model(array('produk_model','merk_model'));

	}

	public function index()
	{

		if(!$this->session->userdata("sess_nama_produk")){
			$data['data_produk'] = $this->produk_model->daftar_produk_all();
		}else{
			$nama = $this->session->userdata("ses_nama_produk");
			$data['data_produk'] = $this->produk_model->cari_produk_by_nama($nama);
		}

		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->produk_model->jumlah_produk();
		
		$config['base_url'] = base_url()."produk/";
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

		if(!$this->session->userdata("sess_nama_produk")){
			$data['data_produk'] = $this->produk_model->daftar_produk_all();
		}else{
			$nama = $this->session->userdata("ses_nama_produk");
			$data['data_produk'] = $this->produk_model->cari_produk_by_nama_limit($nama, $limit_per_page, $start_index);
		}
		
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();

		$this->load->view('template/header', $data);
		$this->load->view('produk/produk_view', $data);
		$this->load->view('template/footer');
	}

	public function cari()
	{
		$nama = anti_sql_injection($this->input->post("txtSearch"));
		if($nama!=""){
			$data['data_produk'] = $this->produk_model->cari_produk_by_nama($nama);
			$this->session->set_userdata("sess_nama_produk", $nama);
		}else{
			if($this->session->userdata("sess_nama_produk"))
				$this->session->unset_userdata("ses_nama_produk");
			redirect(base_url()."produk.html");
		}
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->produk_model->jumlah_produk();

		$data['data_produk'] = $this->produk_model->cari_produk_by_nama_limit($nama, $limit_per_page, $start_index);
		
		$config['base_url'] = base_url()."produk/";
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
		
		$data['data_produk'] = $this->produk_model->cari_produk_by_nama_limit($nama, $limit_per_page, $start_index);

		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();

		$this->load->view('template/header', $data);
		$this->load->view('produk/produk_view', $data);
		$this->load->view('template/footer');
	}

	public function cari_produk_by_kategori($id)
	{
		$data['data_produk'] = $this->produk_model->daftar_produk_by_kategori($id);
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->produk_model->jumlah_produk();

		$config['base_url'] = base_url()."kategori/$id/";
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
		
	
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['kat'] = $this->produk_model->cari_kategori_by_id($id);
		$data['data_merk'] = $this->merk_model->daftar_merk();

		$this->load->view('template/header', $data);
		
		$data['data_produk'] = $this->produk_model->daftar_produk_by_kategori_limit( $limit_per_page, $start_index, $id);
		$this->load->view('produk/produk_kategori_view', $data);
		$this->load->view('template/footer');
	}

public function cari_produk_by_merk($merk)
	{
		$merk = str_replace("-"," ",$merk);
		$data['data_produk'] = $this->produk_model->daftar_produk_by_merk($merk);
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->produk_model->jumlah_produk();

		$config['base_url'] = base_url()."merk/$merk/";
		$config['total_rows'] = $total_records;
		$config['per_page'] = $limit_per_page;
		$config['num_links'] = 2;
        
		$data['data_produk'] = $this->produk_model->daftar_produk_by_merk_limit( $limit_per_page, $start_index, $merk);

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
		

		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();
		$data['merk'] = $this->merk_model->cari_merk_by_merk(strtoupper(str_replace("-"," ",$merk)));

		$this->load->view('template/header', $data);
		

		$data['data_produk'] = $this->produk_model->daftar_produk_by_merk_limit( $limit_per_page, $start_index, $merk);

		$this->load->view('produk/produk_merk_view', $data);
		$this->load->view('template/footer');
	}	
	
	public function detail_produk($kode){
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();

		$this->load->view('template/header', $data);
		
		$data['data_produk'] = $this->produk_model->cari_produk_by_kode($kode);
		$data['data_produk_kat'] = $this->produk_model->daftar_produk_by_kategori_detail($data['data_produk']->id_kategori);
		
		$data['gambar_produk'] = $this->produk_model->cari_gambar_produk($kode);
		$data['jumlah_gambar'] = $this->produk_model->jumlah_produk();
		$this->load->view('produk/produk_detail', $data);
		$this->load->view('template/footer');
	}

	public function galeri()
	{

		$data['data_produk'] = $this->produk_model->galeri_produk();
		// Pagination Configuration
        $limit_per_page = 24;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->produk_model->jumlah_produk();
		
		$config['base_url'] = base_url()."galeri/";
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

		$data['data_produk'] = $this->produk_model->galeri_produk($limit_per_page, $start_index);
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$data['data_merk'] = $this->merk_model->daftar_merk();

		$this->load->view('template/header', $data);
		$this->load->view('produk/galeri', $data);
		$this->load->view('template/footer');
	}

}
