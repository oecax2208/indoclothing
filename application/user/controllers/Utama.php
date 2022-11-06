<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('session');
		$this->load->model(array('produk_model','promo_model','slider_model','merk_model'));
		
	}

	public function index()
	{
		
		$data['data_promo'] = $this->promo_model->daftar_promo_all();
		$data['data_slider'] = $this->slider_model->daftar_slider();
		$data['data_merk'] = $this->merk_model->daftar_merk();
		$data['produk_kategori'] = $this->produk_model->daftar_kategori();
		$this->load->view('template/header', $data);
		$this->load->view('home');
		$this->load->view('template/footer');
	}
}
