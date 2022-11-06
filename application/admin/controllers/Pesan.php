<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('file','url','email'));		
		$this->load->library(array("session","email"));
		$this->load->model(array('pesan_model'));
	}

	public function index(){
		show_404();
	}
	
	public function pesan_masuk()
	{
		$data['data_pesan'] = $this->pesan_model->pesan_masuk();			
		
		// Pagination Configuration
	    $limit_per_page = 100;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->pesan_model->jumlah_pesan();
		
		$config['base_url'] = base_url()."admin.php/pesan/masuk/";
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
		
		$data['data_pesan'] = $this->pesan_model->pesan_masuk_limit($limit_per_page, $start_index);		
		
		$this->load->view('pesan/pesan_masuk_view', $data);
		$this->load->view('template/footer');
	}

	public function pesan_keluar()
	{
		$data['data_pesan'] = $this->pesan_model->pesan_keluar();			
        
		// Pagination Configuration
		$limit_per_page = 100;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_records = $this->pesan_model->jumlah_pesan();
		
		$config['base_url'] = base_url()."admin.php/pesan/masuk/";
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
		
		$data['data_pesan'] = $this->pesan_model->pesan_keluar_limit($limit_per_page, $start_index);		
		
		$this->load->view('pesan/pesan_keluar_view', $data);
		$this->load->view('template/footer');
	}
	

	public function balas_pesan($id)
	{
		

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		$this->load->view('template/header', $data);

		$data['pesan'] = $this->pesan_model->cari_pesan_by_id($id);
		$this->load->view('pesan/pesan_balas', $data);

		$this->load->view('template/footer');
	}	

	public function pesan_masuk_detail($id)
	{		

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		$this->load->view('template/header', $data);
		
		$data['pesan'] = $this->pesan_model->cari_pesan_by_id($id);		

		if($data['pesan']->dibaca_pada==null){
			$now = date("Y-m-d G:i:s");
			$update = array("dibaca_pada" => $now);
			$this->pesan_model->update_status_baca($update, $id);
		}

		$data['pesan'] = $this->pesan_model->cari_pesan_by_id($id);
		$this->load->view('pesan/pesan_masuk_detail', $data);

		$this->load->view('template/footer');
	}	

	public function pesan_keluar_detail($id)
	{		

		$data['id_login'] = $this->session->userdata("id_login");
		$data['nama_pengguna'] = $this->session->userdata("nama_pengguna");
		$data['foto'] = $this->session->userdata("foto_pengguna");
		
		$this->load->view('template/header', $data);
		$this->load->view('pesan/pesan_keluar_detail', $data);
		$this->load->view('template/footer');
	}

	public function hapus_pesan_masuk($id)
	{
		$data['pesan'] = $this->pesan_model->hapus_pesan($id);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/pesan/masuk");
	}

	public function hapus_pesan_masuk_pilihan()
	{
		$id_pesan = $this->input->post("txtIdPesan");
		if(count($id_pesan)>0){
			for($i=0; $i<count($id_pesan); $i++){
				$id= $id_pesan[$i];
				$data['pesan'] = $this->pesan_model->hapus_pesan($id);
				$this->session->set_flashdata("status","Sukses-Hapus");
			}
			redirect(base_url()."admin.php/pesan/masuk");
		}else{
			echo "<script>alert('Tidak ada data yang dipilih')</script>";
			redirect(base_url()."admin.php/pesan/masuk",'refresh');
		}
	}

	public function hapus_pesan_keluar($id)
	{
		$data['pesan'] = $this->pesan_model->hapus_pesan($id);
		$this->session->set_flashdata("status","Sukses-Hapus");
		redirect(base_url()."admin.php/pesan/keluar");
	}

	public function hapus_pesan_keluar_pilihan()
	{
		$id_pesan = $this->input->post("txtIdPesan");
		if(count($id_pesan)>0){
			for($i=0; $i<count($id_pesan); $i++){
				$id= $id_pesan[$i];
				$data['pesan'] = $this->pesan_model->hapus_pesan($id);
				$this->session->set_flashdata("status","Sukses-Hapus");
			}
			redirect(base_url()."admin.php/pesan/keluar");
		}else{
			echo "<script>alert('Tidak ada data yang dipilih')</script>";
			redirect(base_url()."admin.php/pesan/keluar",'refresh');
		}
	}

	public function kirim_pesan(){
		$message= array(
			"required"    => "{field} harus diisi",
			"max_length"  => "{field} tidak boleh lebih dari {param} karakter",
			"min_length"  => "{field} setidaknya harus berisi {param} karakter",
			"integer"     => "{field} harus berupa Integer"
		);
		
		$this->form_validation->set_rules('txtKepada', 'Kepada', 'required|trim|min_length[3]|max_length[40]', $message);
		$this->form_validation->set_rules('txtIsiPesan', 'Isi Pesan', 'required|trim|min_length[10]', $message);

		$kepada_penerima = $this->input->post("txtKepada");
		$isi_pesan = $this->input->post("txtIsiPesan");
		$id_pesan = $this->input->post("txtIdPesan");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			
			$group_input = array(
				"txtIdPesan" => $id_pesan,
				"txtKepada" => $kepada_penerima,
				"txtIsiPesan" => $isi_pesan							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."admin.php/pesan/balas-pesan/".$id_pesan."");
			
		}else{
			$data = array(
					"nama_pengirim" => "Admin Web Indo Clothing",
					"email_pengirim" => "admin.noreply@indo-clothing-karawang.com",
					"kepada_penerima" => $kepada_penerima,
					"isi_pesan" => $isi_pesan
					);
			$this->pesan_model->kirim($data);
			
			//Kirim Email

			$this->email->from("admin.noreply@indo-clothing-karawang.com");
			$this->email->to($kepada_penerima);
			
			$this->email->subject('Balasan Pesan Web Indo Clothing');
			$this->email->message($isi_pesan);

			$this->email->send();			
			
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."admin.php/pesan/masuk");
		}
		
	}
}
