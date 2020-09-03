<?php 
if(!defined('BASEPATH'))exit('No direct access allowed');
class Kuponmakan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true || substr($this->session->userdata('modul'),0,1)!='1'){
			$this->session->set_flashdata('msg','akseserror');
			$url = base_url('Main');
			redirect($url);
		}
		$this->load->model('m_kuponmakan');
		$this->load->model('m_departemen');
		$this->load->model('m_log');
	}
	function index(){
		if($this->session->userdata('masukifncloud')!=true){
			$url = base_url('aplikasi');
			redirect($url);
		}
		if(!$this->session->userdata('bl')){
			$this->session->set_userdata('dy',date('d'));
			$this->session->set_userdata('bl',date('m'));
			$this->session->set_userdata('th',date('Y'));
			$this->session->set_userdata('shi',''); 	
			$this->session->set_userdata('dep',$this->session->userdata('bagian')=='AW' ? '' : $this->session->userdata('bagian')); 	
			$dy = $this->session->userdata('dy');
			$bl = $this->session->userdata('bl');
			$th = $this->session->userdata('th');
			$shi = $this->session->userdata('shi');
			$dep = $this->session->userdata('dep');
		}else{
			$dy = $this->session->userdata('dy');
			$bl = $this->session->userdata('bl');
			$th = $this->session->userdata('th');
			$shi = $this->session->userdata('shi');
			$dep = $this->session->userdata('dep');
		}
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'kuponmakan';
		$data['kupon'] = $this->m_kuponmakan->getdatakupon($dy,$bl,$th,$shi,$dep);
		$data['dept'] = $this->m_kuponmakan->getdepartemen();
		$data['disab'] = $this->session->userdata('bagian')=='AW' || $this->session->userdata('bagian')=='SC' ? '' : 'disabled';
		$this->load->view('page/header');
		$this->load->view('page/kuponmakan',$data);
		$this->load->view('page/footer',$footer);
	}

	function kuponmakanclear(){
		$this->session->unset_userdata('dy');
		$this->session->unset_userdata('bl');
		$this->session->unset_userdata('th');
		$this->session->unset_userdata('shi');
		$url = base_url().'kuponmakan';
		redirect($url);
	}
	function tambahkuponmakan(){
		// $data['tgl'] = $this->session->userdata('dy').'-'.$this->session->userdata('bl').'-'.$this->session->userdata('th');
		$data['tgl'] = date('d-m-Y');
		$data['shi'] = $this->session->userdata('shi');
		$data['dep'] = $this->m_kuponmakan->getdepartemen();
		$data['xdep'] = $this->session->userdata('dep');
		$data['jumlah'] = null;
		$data['absen'] = null;
		$data['hadir'] = null;
		$data['hadirar'] = null;
		$data['hadirnu'] = null;
		$data['lembur'] = null;
		$data['lemburar'] = null;
		$data['lemburnu'] = null;
		$data['kmb'] = null;
		$data['ket'] = null;
		$data['formAction'] = base_url().'Kuponmakan/tambah';
		$this->load->view('page/formkuponmakan',$data);
	}
	function updatekuponmakan($id){
		$datakupon = $this->m_kuponmakan->detailkupon($id);
		$xdatakupon = is_object($datakupon) ? true : false;
		if($xdatakupon){
			$isidata = $datakupon->row();
			$data['tgl'] = tglmysql($isidata->tanggal);
			$data['shi'] = $isidata->shifp;
			$data['xdep'] = $isidata->departemen;
			$data['dep'] = $this->m_kuponmakan->getdepartemen();
			$data['jumlah'] = $isidata->jumlah;
			$data['absen'] = $isidata->absen;
			$data['hadir'] = $isidata->hadir;
			$data['hadirar'] = $isidata->hadirar;
			$data['hadirnu'] = $isidata->hadirnu;
			$data['lembur'] = $isidata->lembur;
			$data['lemburar'] = $isidata->lemburar;
			$data['lemburnu'] = $isidata->lemburnu;
			$data['kmb'] = $isidata->kmb;
			$data['ket'] = $isidata->ket;
			$data['formAction'] = base_url().'Kuponmakan/update/'.$isidata->id;
			$this->load->view('page/formkuponmakan',$data);
		}
	}
	function hapuskupon($id){
		$this->m_kuponmakan->hapuskupon($id);
		$url = base_url().'kuponmakan';
		redirect($url);
	}
	function ubahshi(){
		$e = $_POST['ede'];
		$day = $_POST['day'];
		$bln = $_POST['bln'];
		$thn = $_POST['thn'];
		$f = $_POST['edi'];
		$this->session->set_userdata('dy',$day);
		$this->session->set_userdata('bl',$bln);
		$this->session->set_userdata('th',$thn);
		$this->session->set_userdata('shi',$e); 
		$this->session->set_userdata('dep',$f); 
		echo json_encode($e); 
	}
	function tambah(){
		$this->m_kuponmakan->tambah();
		$url = base_url().'kuponmakan';
		redirect($url);
	}
	function update($id){
		$this->m_kuponmakan->update($id);
		$url = base_url().'kuponmakan';
		redirect($url);	
	}
	function konfirmasikupon($id){
		$this->m_kuponmakan->konfirmasikupon($id);
		$url = base_url().'kuponmakan';
		redirect($url);
	}
}