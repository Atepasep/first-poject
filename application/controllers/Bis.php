<?php
if(!defined('BASEPATH'))exit('No direct access Allowed');
class Bis extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true || substr($this->session->userdata('modul'),1,1)!='1'){
			$this->session->set_flashdata('msg','akseserror');
			$url = base_url('Main');
			redirect($url);
		}
		$this->load->model('m_log');
		$this->load->model('m_bis');
	}

	function index(){
		if (!$this->session->userdata('tgl')) {
			$this->session->set_userdata('tgl',date('d'));
			$this->session->set_userdata('bln',date('m'));
			$this->session->set_userdata('thn',date('Y'));
		}
		$data['data'] = $this->m_bis->get_data();
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'bis';
		$this->load->view('page/header');
		$this->load->view('page/bis',$data);
		$this->load->view('page/footer',$footer);
	}
	function ubahjam($a,$b,$c){
		$data['a'] = $a;
		$data['b'] = $b;
		$data['c'] = $c;
		$data['formAction'] = base_url().'bis/ubahstatus';
		$this->load->view('page/editbis',$data);
	}
	function bisclear(){
		$this->session->unset_userdata('tgl');
		$url = base_url('bis');
		redirect($url);
	}
	function ubahperiode(){
		$tgl = $_POST['tgl'];
		$bln = $_POST['bln'];
		$thn = $_POST['thn'];
		$this->session->set_userdata('tgl',$tgl);
		$this->session->set_userdata('bln',$bln);
		$this->session->set_userdata('thn',$thn);
		echo json_encode($bln);
	}
	function ubahstatus(){
		$this->m_bis->ubahstatus();
		$url = base_url('bis');
		redirect($url);	
	}
	function log(){
		$this->m_bis->addlog();
	}
}