<?php 
if(!defined('BASEPATH'))exit('No direct access allowed');
class Aplikasi extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true){
			$this->session->set_flashdata('msg','akseserror');
			$url = base_url('Main');
			redirect($url);
		}
		$this->load->model('m_aplikasi');
		$this->load->model('m_departemen');
		$this->load->model('m_log');
	}
	function index(){
		$this->session->unset_userdata('dy');
		$this->session->unset_userdata('bl');
		$this->session->unset_userdata('th');
		$this->session->unset_userdata('shi');
		$this->session->unset_userdata('dep');
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'aplikasi';
		$data['apli'] = $this->m_aplikasi->getapps($this->session->userdata('bagian'));
		$this->load->view('page/header');
		$this->load->view('page/aplikasi',$data);
		$this->load->view('page/footer',$footer);
	}
}