<?php 
if(!defined('BASEPATH'))exit('No direct access allowed');
class Pengguna extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true || substr($this->session->userdata('aksesapps'),0,1)!='1'){
			$this->session->set_flashdata('msg','akseserror');
			$url = base_url('Main');
			redirect($url);
		}
		$this->load->model('m_pengguna');
		$this->load->model('m_log');
	}
	function index(){
		$data['penggunaall'] = $this->m_pengguna->getallpengguna();
		$data['formAction'] = base_url().'pengguna/simpanpengguna';
		$data['formAction2'] = base_url().'pengguna/ubahpengguna';
		$data['bagian'] = $this->m_pengguna->getbagian();
		if(!$this->session->userdata('pgg')){
			$data['pgg'] = '';
		}else{
			$data['pgg'] = $this->session->userdata('pgg');
		}
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'pengguna';
		$this->load->view('page/header');
		$this->load->view('page/pengguna',$data);
		$this->load->view('page/footer',$footer);
	}

	function penggunaclear(){
		$this->session->unset_userdata('pgg');
		$url = base_url().'pengguna';
		redirect($url);
	}

	function simpanpengguna(){
		$this->m_pengguna->simpanpengguna();
		$url = base_url('pengguna');
		redirect($url);
	}
	function ubahpengguna(){
		$this->m_pengguna->ubahpengguna();
		$url = base_url('pengguna');
		redirect($url);	
	}
	function hapuspengguna($id){
		$this->m_pengguna->hapuspengguna($id);
		// $url = base_url('pengguna');
		// redirect($url);
	}
	function getdetail(){
		$id = $_POST['id'];
		$hasil = $this->m_pengguna->getdetail($id);
		$this->session->set_userdata('pgg',$id);
		echo json_encode($hasil);
	}
	function getpass(){
		$id = $_POST['id'];
		$hasil = $this->m_pengguna->getpass($id);
		echo json_encode($hasil);
	}
	function getmodul(){
		$id_dept = $_POST['id'];
		$hasil = $this->m_pengguna->getmodul($id_dept);
		echo json_encode($hasil);
	}
}