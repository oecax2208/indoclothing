<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('file','captcha','url','email'));		
		$this->load->library(array("session","email"));
		$this->load->model(array('produk_model','merk_model','kontak_model'));
	}

	public function index()
	{

		$vals = array(
				'img_path'      => './captcha_/',
				'img_url'       => base_url().'captcha_/',
				'font_path'		=> base_url().'assets/font-awesome/4.5.0/fonts/arial.ttf',
				'img_width'     => 300,
				'img_height'    => 70,
				'expiration'    => 7200,
				'word_length'   => 8,
				'font_size'     => 100,
				'img_id'        => 'Imageid',
				'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
				// White background and border, black text and red grid
				'colors'        => array(
						'background' => array(255, 255, 255),
						'border' => array(255, 255, 255),
						'text' => array(0, 0, 0),
						'grid' => array(255, 40, 40)
				)
		);

		$cap = create_captcha($vals);
		$data['captcha'] =$cap['image'];
		$this->session->set_userdata('mycaptcha', $cap['word']);
 		
		$data['data_merk'] = $this->merk_model->daftar_merk();
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();

		$this->load->view('template/header', $data);
		$this->load->view('kontak/kontak_kami', $data);
		$this->load->view('template/footer');
	}
	
	public function kirim_pesan(){
		$message= array(
			"required"    => "{field} harus diisi",
			"max_length"  => "{field} tidak boleh lebih dari {param} karakter",
			"min_length"  => "{field} setidaknya harus berisi {param} karakter",
			"integer"     => "{field} harus berupa Integer"
		);
		
		$captcha = $this->session->userdata('mycaptcha');
		
		
		$this->form_validation->set_rules('txtNamaPengirim', 'Nama Pengirim', 'required|trim|min_length[3]|max_length[40]', $message);
		$this->form_validation->set_rules('txtEmailPengirim', 'Email', 'required|trim|valid_email', $message);
		$this->form_validation->set_rules('txtIsiPesan', 'Isi Pesan', 'required|trim|min_length[10]', $message);
		$this->form_validation->set_rules('txtKodeKeamananValid', 'Kode Keamanan', 'required|trim|min_length[5]|max_length[100]', $message);
		$this->form_validation->set_rules('txtKodeKeamanan', 'Kode Keamanan', 'required|trim|min_length[5]|max_length[100]|matches[txtKodeKeamananValid]', $message);

		$nama_pengirim = $this->input->post("txtNamaPengirim");
		$email_pengirim = $this->input->post("txtEmailPengirim");
		$isi_pesan = $this->input->post("txtIsiPesan");
		$kode_keamanan = $this->input->post("txtKodeKeamanan");
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata("status",validation_errors());
			
			$group_input = array(
				"txtNamaPengirim" => $nama_pengirim,
				"txtEmailPengirim" => $email_pengirim,
				"txtIsiPesan" => $isi_pesan							
			);
			
			$this->session->set_flashdata("group_input",$group_input);
			redirect(base_url()."kontak-kami.html");
			
		}else{
			$data = array(
					"nama_pengirim" => anti_sql_injection($nama_pengirim),
					"email_pengirim" => anti_sql_injection($email_pengirim),
					"kepada_penerima" => 'ADMIN',
					"isi_pesan" => anti_sql_injection($isi_pesan)
					);
			$this->kontak_model->kirim($data);
			
			//Kirim Email

			$this->email->from(anti_sql_injection($email_pengirim), anti_sql_injection($nama_pengirim));
			$this->email->to(array("indoclothingkarawang@yahoo.com","endysupriyatna@gmail.com"));
			
			$this->email->subject('Web Kontak');
			$this->email->message(anti_sql_injection($isi_pesan));

			$this->email->send();			
			
			$this->session->set_flashdata("status","Sukses");
			redirect(base_url()."kontak-kami.html");
		}
		
	}
}
