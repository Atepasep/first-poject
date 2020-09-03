<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Mintauang extends Ci_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true || substr($this->session->userdata('modul'),2,1)!='1'){
			$this->session->set_flashdata('msg','akseserror');
			$url = base_url('Main');
			redirect($url);
		}
		$this->load->model('m_log');
		$this->load->model('m_mintauang');
	}
	function index(){
		if(!$this->session->userdata('bl')){
			$this->session->set_userdata('bl',date('m'));
			$this->session->set_userdata('th',date('Y'));
		}
		$data['bl'] = $this->session->userdata('bl');
		$data['th'] = $this->session->userdata('th');
		$data['formAction'] = base_url().'mintauang/simpandata';
		$data['formAction2'] = base_url().'mintauang/ubahdata';
		$data['uang'] = $this->m_mintauang->get_all_data();
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'mintauang';
		$data['depart'] = $this->m_mintauang->getdepartemen()->row();
		$this->load->view('page/header');
		$this->load->view('page/mintauang',$data);
		$this->load->view('page/footer',$footer);
	}
	function mintauangclear(){
		$this->session->unset_userdata('bl');
		$this->session->unset_userdata('th');
		$url = base_url().'mintauang';
		redirect($url);
	}
	function simpandata(){
		$this->m_mintauang->simpandata();
		$url = base_url().'mintauang';
		redirect($url);
	}
	function hapus($id){
		$this->m_mintauang->hapus($id);
		$url = base_url().'mintauang';
		redirect($url);	
	}
	function getdetaildata(){
		$id = $_POST['id'];
		$hasil = $this->m_mintauang->getdetaildata($id)->result();
		echo json_encode($hasil);
	}
	function ubahbulantahun(){
		$bl = $_POST['bl'];
		$th = $_POST['th'];
		$this->session->set_userdata('bl',$bl);
		$this->session->set_userdata('th',$th);
		echo json_encode($bl);
	}
}