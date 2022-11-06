<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));
		
		$this->load->model(array("kabupaten_model", "provinsi_model"));
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{

        $limit_per_page = 50;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->kabupaten_model->jumlah_kabupaten();
		
		$config['base_url'] = base_url()."admin.php/kabupaten/";
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
		
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		if(!$this->session->userdata("sess_id_provinsi")==null){
			$id_provinsi =$this->session->userdata("sess_id_provinsi");
			$data['data_kabupaten'] = $this->kabupaten_model->cari_kabupaten_by_id_provinsi($id_provinsi);
			$data['jumlah_kabupaten'] = $this->kabupaten_model->jumlah_kabupaten();
			
		}else{
			$data['data_kabupaten'] = $this->kabupaten_model->daftar_kabupaten_limit($limit_per_page, $start_index);
			$data['jumlah_kabupaten'] = $this->kabupaten_model->jumlah_kabupaten();
			
		}
		$this->load->library("pagination");
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start_index'] = $start_index;

		$this->load->view('kabupaten/kabupaten_view', $data);
		$this->load->view('template/footer');
	}

	public function daftar_kabupaten_provinsi()
	{
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		if($this->session->userdata("sess_id_provinsi")==null){
			$id_provinsi = $this->input->post("txtIdProvinsi");
			$this->session->set_userdata("sess_id_provinsi", $id_provinsi);
		}
		$id_provinsi =$this->session->userdata("sess_id_provinsi");
		
		$data['data_kabupaten'] = $this->kabupaten_model->cari_kabupaten_by_id_provinsi($id_provinsi);
		$data['jumlah_kabupaten'] = $this->kabupaten_model->jumlah_kabupaten();
		$this->load->view('kabupaten/kabupaten_view', $data);
		$this->load->view('template/footer');
	}
	
	public function cari_kabupaten_by_id(){
		$id = $this->input->post("txtIdProvinsi");
		$kabupaten = $this->kabupaten_model->cari_kabupaten_by_id_provinsi($id);
		$result = json_encode($kabupaten);
		echo $result;

		
	}

	public function tambah()
	{
		$data['id_auto'] = $this->kabupaten_model->id_kabupaten_auto();
		$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kabupaten/kabupaten_tambah', $data);
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		$data['kabupaten'] = $this->kabupaten_model->cari_kabupaten_by_id($id);
		$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kabupaten/kabupaten_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$data['kabupaten'] = $this->kabupaten_model->hapus_kabupaten($id);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/kabupaten");
	}

	function hapus_kabupaten_pilihan()
	{
		$id_kabupaten = $this->input->post("txtIdKabupaten");
		if(count($id_kabupaten)>0){
			for($i=0;$i<count($id_kabupaten);$i++){
				$id = $id_kabupaten[$i];
				$data['kabupaten'] = $this->kabupaten_model->hapus_kabupaten($id);
				$this->session->set_flashdata("status","Sukses-Hapus");
				redirect(base_url()."admin.php/kabupaten");
			}
		}else{
			echo "<script>alert('Tidak ada data yang dipilih')</script>";
			redirect(base_url()."admin.php/kecamatan",'refresh');			
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

		$this->form_validation->set_rules('txtIdKabupaten', 'Id Kabupaten', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdProvinsi', 'Provinsi', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaKabupaten', 'Nama Kabupaten', 'required|trim|min_length[5]|max_length[100]', $message);

		$id_kabupaten = $this->input->post("txtIdKabupaten");
		$id_provinsi = $this->input->post("txtIdProvinsi");
		$nama_kabupaten = $this->input->post("txtNamaKabupaten");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			
			$group_input = array(
				"txtIdKabupaten" => $id_kabupaten,
				"txtIdProvinsi" => $id_provinsi,
				"txtNamaKabupaten" => $nama_kabupaten							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kabupaten/tambah-kabupaten");
			
		}else{
			$data = array(
					"id_kabupaten" => ($id_kabupaten),
					"nama_kabupaten" => ($nama_kabupaten),
					"id_provinsi" => ($id_provinsi)
					);
			$this->kabupaten_model->tambah_kabupaten($data);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/kabupaten");
		}
	}
	
	public function update()
	{
		$this->form_validation->set_rules('txtIdKabupaten', 'Id Kabupaten', 'required|trim');
		$this->form_validation->set_rules('txtIdProvinsi', 'Provinsi', 'required|trim');
		$this->form_validation->set_rules('txtNamaKabupaten', 'Nama Kabupaten', 'required|trim|min_length[5]|max_length[100]');

		$id_kabupaten = $this->input->post("txtIdKabupaten");
		$id_provinsi = $this->input->post("txtIdProvinsi");
		$nama_kabupaten = $this->input->post("txtNamaKabupaten");

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			$group_input = array(
				"txtIdKabupaten" => $id_kabupaten,
				"txtIdProvinsi" => $id_provinsi,
				"txtNamaKabupaten" => $nama_kabupaten							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kabupaten/ubah-kabupaten/".$this->input->post("txtIdKabupaten"));
			
		}else{
			$data = array(
					"id_kabupaten" => ($id_kabupaten),
					"id_provinsi" => ($id_provinsi),
					"nama_kabupaten" => ($nama_kabupaten)
					);
			$this->kabupaten_model->ubah_kabupaten($data, $id_kabupaten);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/kabupaten");
		}
	}

}
