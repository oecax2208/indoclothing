<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));
		
		$this->load->model(array("produk_model", "merk_model"));
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
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
		
		$config['base_url'] = base_url()."admin.php/produk/";
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

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('produk/produk_view', $data);
		$this->load->view('template/footer');
	}

	public function cari()
	{
		$nama = ($this->input->post("txtSearch"));
		if($nama!=""){
			$data['data_produk'] = $this->produk_model->cari_produk_by_nama($nama);
			$this->session->set_userdata("sess_nama_produk", $nama);
		}else{
			if($this->session->userdata("sess_nama_produk"))
				$this->session->unset_userdata("ses_nama_produk");
			redirect(base_url()."admin.php/produk");
		}
		
		// Pagination Configuration
        $limit_per_page = 50;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->produk_model->jumlah_produk();

		$data['data_produk'] = $this->produk_model->cari_produk_by_nama_limit($nama, $limit_per_page, $start_index);
		
		$config['base_url'] = base_url()."admin.php/produk/";
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

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('produk/produk_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$this->load->model("kategori_model");
		
		$data['data_kategori'] = $this->kategori_model->daftar_kategori();
		$data['id_auto'] = $this->produk_model->kode_produk_auto();
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$data['data_merk'] = $this->merk_model->daftar_merk();
		
		$this->load->view('template/header', $data);
		$this->load->view('produk/produk_tambah', $data);
		$this->load->view('template/footer');
	}

	public function ubah($kode)
	{
		$this->load->model("kategori_model");
		
		$data['data_kategori'] = $this->kategori_model->daftar_kategori();
		$data['produk'] = $this->produk_model->cari_produk_by_kode($kode);

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$data['data_merk'] = $this->merk_model->daftar_merk();
		
		$this->load->view('template/header', $data);
		$this->load->view('produk/produk_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($kode)
	{
		$data['produk'] = $this->produk_model->hapus_produk($kode);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/produk");
	}

	public function hapus_produk_pilihan()
	{
		$kode_produk = $this->input->post("txtKodeProduk");
		if(count($kode_produk)>0){
			for($i=0; $i<count($kode_produk); $i++){
				$kode = $kode_produk[$i];
				$data['produk'] = $this->produk_model->hapus_produk($kode);
			}
			$this->session->set_flashdata("status","Sukses-Hapus");
			redirect(base_url()."admin.php/produk");
		}else{
			echo "<script>alert('Tidak ada data yang dipilih')</script>";
			redirect(base_url()."admin.php/produk",'refresh');
		}
	}

	public function simpan()
	{
		$message= array(
			"required"    => "{field} wajib untuk diisi",
			"max_length"  => "{field} tidak boleh lebih dari {param} karakter",
			"min_length"  => "{field} setidaknya harus berisi {param} karakter",
			"integer"     => "{field} harus berupa Integer"
		);
		$this->form_validation->set_rules('txtKodeProduk', 'Kode Produk', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaProduk', 'Nama Produk', 'required|trim|min_length[5]|max_length[100]', $message);
		$this->form_validation->set_rules('txtMerkProduk', 'Merk Produk', 'required|trim', $message);
		$this->form_validation->set_rules('txtDeskripsiProduk', 'Deskripsi Produk', 'required|trim|min_length[5]', $message);
		$this->form_validation->set_rules('txtDiskonProduk', 'Diskon Produk', 'required|trim|integer', $message);
		$this->form_validation->set_rules('txtStokProduk', 'Stok Produk', 'required|trim|integer', $message);
		$this->form_validation->set_rules('txtHargaProduk', 'Harga Produk', 'required|trim|integer', $message);

		$kode_produk = $this->input->post("txtKodeProduk", TRUE);
		$nama_produk = $this->input->post("txtNamaProduk", TRUE);
		$id_kategori = $this->input->post("txtIdKategori", TRUE);
		$merk_produk = $this->input->post("txtMerkProduk", TRUE);
		$deskripsi_produk = $this->input->post("txtDeskripsiProduk");
		$diskon_produk = $this->input->post("txtDiskonProduk", TRUE);
		$stok_produk = $this->input->post("txtStokProduk", TRUE);
		$harga_produk = $this->input->post("txtHargaProduk", TRUE);
		$status_produk = $this->input->post("txtStatusProduk", TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtKodeProduk" => $kode_produk,
							"txtNamaProduk" => $nama_produk,
							"txtIdKategori" => $id_kategori,
							"txtMerkProduk" => $merk_produk,
							"txtDeskripsiProduk" => $deskripsi_produk,
							"txtDiskonProduk" => $diskon_produk,
							"txtStokProduk" => $stok_produk,
							"txtHargaProduk" => $harga_produk,
							"txtStatusProduk" => $status_produk
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/produk/tambah-produk");
			
		}else{
			$data = array(
					"kode_produk" => ($kode_produk),
					"nama_produk" => ($nama_produk),
					"id_kategori" => ($id_kategori),
					"id_merk" => ($merk_produk),
					"deskripsi_produk" => $deskripsi_produk,
					"diskon_produk" => ($diskon_produk),
					"stok_produk" => ($stok_produk),
					"harga_produk" => ($harga_produk),
					"status_produk" => ($status_produk),
					);
			$this->produk_model->tambah_produk($data);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/produk");
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
		$this->form_validation->set_rules('txtKodeProduk', 'Kode Produk', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaProduk', 'Nama Produk', 'required|trim|min_length[5]|max_length[100]', $message);
		$this->form_validation->set_rules('txtMerkProduk', 'Merk Produk', 'required|trim', $message);
		$this->form_validation->set_rules('txtDeskripsiProduk', 'Deskripsi Produk', 'required|trim|min_length[5]', $message);
		$this->form_validation->set_rules('txtDiskonProduk', 'Diskon Produk', 'required|trim|integer', $message);
		$this->form_validation->set_rules('txtStokProduk', 'Stok Produk', 'required|trim|integer', $message);
		$this->form_validation->set_rules('txtHargaProduk', 'Harga Produk', 'required|trim|integer', $message);

		$kode_produk = $this->input->post("txtKodeProduk", TRUE);
		$nama_produk = $this->input->post("txtNamaProduk", TRUE);
		$id_kategori = $this->input->post("txtIdKategori", TRUE);
		$merk_produk = $this->input->post("txtMerkProduk", TRUE);
		$deskripsi_produk = $this->input->post("txtDeskripsiProduk");
		$diskon_produk = $this->input->post("txtDiskonProduk");
		$stok_produk = $this->input->post("txtStokProduk", TRUE);
		$harga_produk = $this->input->post("txtHargaProduk", TRUE);
		$status_produk = $this->input->post("txtStatusProduk", TRUE);
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
							"txtKodeProduk" => $kode_produk,
							"txtNamaProduk" => $nama_produk,
							"txtIdKategori" => $id_kategori,
							"txtMerkProduk" => $merk_produk,
							"txtDeskripsiProduk" => $deskripsi_produk,
							"txtDiskonProduk" => $diskon_produk,
							"txtStokProduk" => $stok_produk,
							"txtHargaProduk" => $harga_produk,
							"txtStatusProduk" => $status_produk
						);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/produk/ubah-produk/".$kode_produk."");
			
		}else{
			$data = array(
					"kode_produk" => ($kode_produk),
					"nama_produk" => ($nama_produk),
					"id_kategori" => ($id_kategori),
					"id_merk" => ($merk_produk),
					"deskripsi_produk" => $deskripsi_produk,
					"diskon_produk" => ($diskon_produk),
					"stok_produk" => ($stok_produk),
					"harga_produk" => ($harga_produk),
					"status_produk" => ($status_produk),
					);
			$this->produk_model->ubah_produk($data, $kode_produk);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/produk");
		}
	}

}
