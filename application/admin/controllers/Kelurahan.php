<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));
		
		$this->load->model(array("kelurahan_model","provinsi_model"));
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{
		$this->load->library("pagination");

        $limit_per_page = 50;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->kelurahan_model->jumlah_kelurahan();
		
		$config['base_url'] = base_url()."admin.php/kelurahan/";
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
 
		
		$this->pagination->initialize($config);
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		if($this->session->userdata("sess_id_kabupaten")!=null){
			$id_kabupaten =$this->session->userdata("sess_id_kabupaten");
			$data['jumlah_kelurahan'] = $this->kelurahan_model->jumlah_kelurahan();
			
		}else{
			$data['data_kelurahan'] = $this->kelurahan_model->daftar_kelurahan_limit($limit_per_page, $start_index);
			$data['jumlah_kelurahan'] = $this->kelurahan_model->jumlah_kelurahan();
			
		}
		$data['links'] = $this->pagination->create_links();
		$data['start_index'] = $start_index;
		$this->load->view('kelurahan/kelurahan_view', $data);
		$this->load->view('template/footer');
	}

	public function daftar_kelurahan_kecamatan()
	{
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		if($this->session->userdata("sess_id_kabupaten")==null){
			$id_kecamatan = $this->input->post("txtIdKecamatan");
			$this->session->set_userdata("sess_id_kabupaten", $id_kecamatan);
		}
		$id_kelurahan =$this->session->userdata("sess_id_kabupaten");
		
		$data['data_kelurahan'] = $this->kelurahan_model->cari_kelurahan_by_id_kelurahan($id_kelurahan);
		$data['jumlah_kelurahan'] = $this->kelurahan_model->jumlah_kelurahan();
		$this->load->view('kelurahan/kelurahan_view', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['id_auto'] = $this->kelurahan_model->id_kelurahan_auto();
		$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kelurahan/kelurahan_tambah', $data);
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		$data['kelurahan'] = $this->kelurahan_model->cari_kelurahan_by_id($id);
		$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kelurahan/kelurahan_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$data['kelurahan'] = $this->kelurahan_model->hapus_kelurahan($id);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/kelurahan");
	}
	
	public function hapus_kelurahan_pilihan()
	{
		$id_kelurahan = $this->input->post("txtIdKelurahan");
		if(count($id_kelurahan) >0){
			for($i=0;$i<count($id_kelurahan);$i++){
				$id = $id_kelurahan[$i];
				$data['kelurahan'] = $this->kelurahan_model->hapus_kelurahan($id);
				$this->session->set_flashdata("status","Sukses-Hapus");
				redirect(base_url()."admin.php/kelurahan");
			}
		}else{
			echo "<script>alert('Tidak ada data yang dipilih')</script>";
			redirect(base_url()."admin.php/kelurahan",'refresh');

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
		
		$this->form_validation->set_rules('txtIdKelurahan', 'Id Kelurahan', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdProvinsi', 'Provinsi', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdKabupaten', 'Kabupaten', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaKelurahan', 'Nama Kelurahan', 'required|trim|min_length[5]|max_length[100]', $message);
		$this->form_validation->set_rules('txtKodePos', 'Kode Pos', 'required|trim|min_length[5]|max_length[5]|int', $message);

		$id_provinsi = $this->input->post("txtIdProvinsi");
		$id_kabupaten = $this->input->post("txtIdKabupaten");
		$id_kelurahan = $this->input->post("txtIdKelurahan");
		$nama_kelurahan = $this->input->post("txtNamaKelurahan");
		$kode_pos = $this->input->post("txtKodePos");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			
			$group_input = array(
				"txtIdProvinsi" => $id_provinsi,
				"txtIdKabupaten" => $id_kabupaten,
				"txtIdKelurahan" => $id_kelurahan,
				"txtNamaKelurahan" => $nama_kelurahan,							
				"txtKodePos" => $kode_pos							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kelurahan/tambah-kelurahan");
			
		}else{
			$data = array(
					"id_kecamatan" => ($id_kecamatan),
					"id_kelurahan" => ($id_kelurahan),
					"nama_kelurahan" => ($nama_kelurahan),
					"kode_pos" => ($kode_pos)
					);
			$this->kelurahan_model->tambah_kelurahan($data);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/kelurahan");
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
		$this->form_validation->set_rules('txtIdKelurahan', 'Id Kelurahan', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdProvinsi', 'Provinsi', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdKabupaten', 'Kabupaten', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaKelurahan', 'Nama Kelurahan', 'required|trim|min_length[5]|max_length[100]', $message);
		$this->form_validation->set_rules('txtKodePos', 'Kode Pos', 'required|trim|min_length[5]|max_length[5]|int', $message);

		$id_provinsi = $this->input->post("txtIdProvinsi");
		$id_kabupaten = $this->input->post("txtIdKabupaten");
		$id_kelurahan = $this->input->post("txtIdKelurahan");
		$nama_kelurahan = $this->input->post("txtNamaKelurahan");
		$kode_pos = $this->input->post("txtKodePos");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			
			$group_input = array(
				"txtIdProvinsi" => $id_provinsi,
				"txtIdKabupaten" => $id_kabupaten,
				"txtIdKelurahan" => $id_kelurahan,
				"txtNamaKelurahan" => $nama_kelurahan,							
				"txtKodePos" => $kode_pos							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kelurahan/ubah-kelurahan/".$this->input->post("txtIdKabupaten"));
			
		}else{
			$data = array(
					"id_kecamatan" => ($id_kecamatan),
					"id_kelurahan" => ($id_kelurahan),
					"nama_kelurahan" => ($nama_kelurahan),
					"kode_pos" => ($kode_pos)
					);
			$this->kelurahan_model->ubah_kelurahan($data, $id_kelurahan);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/kabupaten");
		}
	}

}
