<?php 
if(!defined('BASEPATH'))exit('No direct access allowed');
class Departemen extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true || substr($this->session->userdata('aksesapps'),1,1)!='1'){
			$this->session->set_flashdata('msg','akseserror');
			$url = base_url('main');
			redirect($url);
		}
		$this->load->model('m_departemen');
		$this->load->model('m_log');
	}
	function index(){
		$data['departemenall'] = $this->m_departemen->getalldepartemen();
		$data['formAction'] = base_url().'departemen/simpandepartemen';
		$data['formAction2'] = base_url().'departemen/ubahdepartemen';
		// $data['bagian'] = $this->m_pengguna->getbagian();
		if(!$this->session->userdata('depx')){
			$data['depx'] = '';
		}else{
			$data['depx'] = $this->session->userdata('depx');
		}
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'departemen';
		$this->load->view('page/header');
		$this->load->view('page/departemen',$data);
		$this->load->view('page/footer',$footer);
	}

	function departemenclear(){
		$this->session->unset_userdata('depx');
		$url = base_url().'departemen';
		redirect($url);
	}

	function editapps($id){
		$detail = $this->m_departemen->editapps($id);
		$apps = $detail->row_array();
		$data['formAction'] = base_url().'departemen/ubahapps';
		$data['idForm'] = $apps['id'];
		$data['namamodul'] = $apps['namamodul'];
		$data['idDept'] = $apps['id_dept'];
		$data['isitombol'] = 'Update data';
		$this->load->view('page/editapps',$data);
	}
	function tambahdepartemen($dep){
		$data['formAction'] = base_url().'departemen/simpandepartemen';
		$data['idForm'] = null;
		$data['namamodul'] = null;
		$data['daftarapps'] = $this->m_departemen->getapps2();
		$data['idDept'] = $dep;
		$data['isitombol'] = 'Simpan data';
		$this->load->view('page/editapps',$data);
	}
	function simpandepartemen(){
		$this->m_departemen->simpandepartemen();
		$url = base_url('departemen');
		redirect($url);
	}
	function ubahapps(){
		$this->m_departemen->ubahapps();
		$url = base_url('departemen');
		redirect($url);	
	}
	function hapusapps($id){
		$this->m_departemen->hapusapps($id);
		$url = base_url('departemen');
		redirect($url);
	}
	function getapps(){
		$id = $_POST['id'];
		$hasil = $this->m_departemen->getapps($id);
		$this->session->set_userdata('depx',$id);
		echo json_encode($hasil);
	}
}