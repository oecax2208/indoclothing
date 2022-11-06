<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','anti_sql'));
		
		$this->load->model(array("kecamatan_model", "provinsi_model"));
		if(!$this->session->userdata("id_login"))
			redirect(base_url()."admin.php/login");
	}

	public function index()
	{
		$this->load->library("pagination");

        $limit_per_page = 50;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->kecamatan_model->jumlah_kecamatan();
		
		$config['base_url'] = base_url()."admin.php/kecamatan/";
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
			$data['jumlah_kecamatan'] = $this->kecamatan_model->jumlah_kecamatan();
			
		}else{
			$data['data_kecamatan'] = $this->kecamatan_model->daftar_kecamatan_limit($limit_per_page, $start_index);
			$data['jumlah_kecamatan'] = $this->kecamatan_model->jumlah_kecamatan();
			
		}
		$data['links'] = $this->pagination->create_links();
		$data['start_index'] = $start_index;
		$this->load->view('kecamatan/kecamatan_view', $data);
		$this->load->view('template/footer');
	}

	public function daftar_kecamatan_kabupaten()
	{
		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		if($this->session->userdata("sess_id_kabupaten")==null){
			$id_kecamatan = $this->input->post("txtIdKecamatan");
			$this->session->set_userdata("sess_id_kabupaten", $id_kecamatan);
		}
		$id_kecamatan =$this->session->userdata("sess_id_kabupaten");
		
		$data['data_kecamatan'] = $this->kecamatan_model->cari_kecamatan_by_id_kecamatan($id_kecamatan);
		$data['jumlah_kecamatan'] = $this->kecamatan_model->jumlah_kecamatan();
		$this->load->view('kecamatan/kecamatan_view', $data);
		$this->load->view('template/footer');
	}

	public function cari_kecamatan_by_id_kabupaten(){
		$id = $this->input->post("txtIdKabupaten");
		$kecamatan = $this->kecamatan_model->cari_kecamatan_by_id_kabupaten($id);
		$result = json_encode($kecamatan);
		echo $result;

		
	}
	
	public function tambah()
	{
		$data['id_auto'] = $this->kecamatan_model->id_kecamatan_auto();
		$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kecamatan/kecamatan_tambah', $data);
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		$data['kecamatan'] = $this->kecamatan_model->cari_kecamatan_by_id($id);
		$data['data_provinsi'] = $this->provinsi_model->daftar_provinsi();

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('kecamatan/kecamatan_ubah', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id)
	{
		$data['kecamatan'] = $this->kecamatan_model->hapus_kecamatan($id);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/kecamatan");
	}

	function hapus_kecamatan_pilihan()
	{
		$id_kecamatan = $this->input->post("txtIdKecamatan");
		if(count($id_kecamatan)>0){
			for($i=0;$i<count($id_kecamatan);$i++){
				$id = $id_kecamatan[$i];
				$data['kecamatan'] = $this->kecamatan_model->hapus_kecamatan($id);
				$this->session->set_flashdata("status","Sukses-Hapus");
				redirect(base_url()."admin.php/kecamatan");
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
		
		$this->form_validation->set_rules('txtIdKecamatan', 'Id Kecamatan', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdProvinsi', 'Provinsi', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdKabupaten', 'Kabupaten', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaKecamatan', 'Nama Kecamatan', 'required|trim|min_length[5]|max_length[100]', $message);

		$id_provinsi = $this->input->post("txtIdProvinsi");
		$id_kabupaten = $this->input->post("txtIdKabupaten");
		$id_kecamatan = $this->input->post("txtIdKecamatan");
		$nama_kecamatan = $this->input->post("txtNamaKecamatan");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			
			$group_input = array(
				"txtIdProvinsi" => $id_provinsi,
				"txtIdKabupaten" => $id_kabupaten,
				"txtIdKecamatan" => $id_kecamatan,
				"txtNamaKecamatan" => $nama_kecamatan							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kecamatan/tambah-kecamatan");
			
		}else{
			$data = array(
					"id_kabupaten" => ($id_kabupaten),
					"nama_kecamatan" => ($nama_kecamatan),
					"id_kecamatan" => ($id_kecamatan)
					);
			$this->kecamatan_model->tambah_kecamatan($data);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/kecamatan");
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
		$this->form_validation->set_rules('txtIdKecamatan', 'Id Kecamatan', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdProvinsi', 'Provinsi', 'required|trim', $message);
		$this->form_validation->set_rules('txtIdKabupaten', 'Kabupaten', 'required|trim', $message);
		$this->form_validation->set_rules('txtNamaKecamatan', 'Nama Kecamatan', 'required|trim|min_length[5]|max_length[100]', $message);

		$id_provinsi = $this->input->post("txtIdProvinsi");
		$id_kabupaten = $this->input->post("txtIdKabupaten");
		$id_kecamatan = $this->input->post("txtIdKecamatan");
		$nama_kecamatan = $this->input->post("txtNamaKecamatan");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			
			$group_input = array(
				"txtIdProvinsi" => $id_provinsi,
				"txtIdKabupaten" => $id_kabupaten,
				"txtIdKecamatan" => $id_kecamatan,
				"txtNamaKecamatan" => $nama_kecamatan							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/kecamatan/ubah-kecamatan/".$this->input->post("txtIdKabupaten"));
			
		}else{
			$data = array(
					"id_kecamatan" => ($id_kecamatan),
					"id_kecamatan" => ($id_kecamatan),
					"nama_kecamatan" => ($nama_kecamatan)
					);
			$this->kecamatan_model->ubah_kecamatan($data, $id_kecamatan);
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/kabupaten");
		}
	}

}
