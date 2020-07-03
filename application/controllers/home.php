<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('cart_model');
	}

	public function index()
	{
		$data['data']=$this->cart_model->get_all_produk();
		$this->load->view('header');
		$this->load->view('home',$data);
		$this->load->view('footer');
	}

}
