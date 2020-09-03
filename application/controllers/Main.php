<?php
if(!defined('BASEPATH'))exit('No direct access allowes');
class Main extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true){
			$url = base_url('login');
			redirect($url);
		}
	}
	function index(){
		$this->load->view('page/header');
		$this->load->view('page/main');
		$this->load->view('page/footer');
	}
}
