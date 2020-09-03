<?php
if(!defined('BASEPATH'))exit('no direct access allowed');
class Absen extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masukifncloud')!=true || substr($this->session->userdata('modul'),3,1)!='1'){
			$this->session->set_flashdata('msg','akseserror');
			$url = base_url('Main');
			redirect($url);
		}
		$this->load->model('m_departemen');
		$this->load->model('m_absen');
		$this->load->model('m_kuponmakan');
		$this->load->model('m_log');
	}

	function index(){
		if(!$this->session->userdata('bl')){
			$this->session->set_userdata('dy',date('d'));
			$this->session->set_userdata('bl',date('m'));
			$this->session->set_userdata('th',date('Y'));
			$this->session->set_userdata('shi','');
			if($this->session->userdata('bagian')!='AW'){
				$this->session->set_userdata('dep',$this->session->userdata('bagian')); 	
			}else{
				$this->session->set_userdata('dep',''); 	
			}
			$dy = $this->session->userdata('dy');
			$bl = $this->session->userdata('bl');
			$th = $this->session->userdata('th');
			$shi = $this->session->userdata('shi');
		}else{
			$dy = $this->session->userdata('dy');
			$bl = $this->session->userdata('bl');
			$th = $this->session->userdata('th');
			$shi = $this->session->userdata('shi');
		}
		$data['dept'] = $this->m_departemen->getdepartemen2();
		$data['disab'] = $this->session->userdata('bagian')=='AW' || $this->session->userdata('bagian')=='SC' ? '' : 'disabled';
		$data['absen'] = $this->m_absen->getdata();
		$data['kupon'] = $this->m_absen->getdatakupon();
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'absen';
		$this->load->view('page/header');
		$this->load->view('page/absen',$data);
		$this->load->view('page/footer',$footer);
	}
	function absenclear(){
		$this->session->unset_userdata('dy');
		$this->session->unset_userdata('bl');
		$this->session->unset_userdata('th');
		$this->session->unset_userdata('shi');
		$this->session->unset_userdata('dep');
		$url = base_url().'absen';
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
	function ubahgrup(){
		$gru = $_POST['gru'];
		$this->session->set_userdata('grup',$gru);
		$hasil = $this->m_absen->getjumlahkry()->result();
		echo json_encode($hasil);
	}
	function tambahabsen($tgl,$dep,$shi){
		$data['tgl'] = $tgl;
		$data['dep'] = $dep;
		$data['shi'] = $shi;
		$data['listgrup'] = $this->m_absen->getgrup(namadepartemen($dep));
		$data['listabsen'] = $this->m_absen->getabsen($tgl,$dep,$shi);
		$data['absen'] = $this->m_absen->getabsen2($tgl,$dep,$shi)->row();
		$data['kupon'] = $this->m_kuponmakan->getkupon(tglmysql($tgl),$dep,$shi)->row();
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'absen';
		$this->load->view('page/header');
		$this->load->view('page/formabsen',$data);
		$this->load->view('page/footer',$footer);
	}
	function tambahabs(){
		$data['tgl'] = date('d-m-Y'); //$this->session->userdata('dy').'-'.$this->session->userdata('bl').'-'.$this->session->userdata('th');
		$data['dep'] = $this->session->userdata('dep');
		$data['shi'] = $this->session->userdata('shi');
		$data['listgrup'] = $this->m_absen->getgrup(namadepartemen($this->session->userdata('dep')));
		$data['formAction'] = base_url().'absen/isiabsenmaster';
		$this->load->view('page/tambahabs',$data);
	}
	function tambahkryabsen($dep){
		$data['karyawan'] = $this->m_absen->getkaryawan($dep);
		$data['dep'] = $dep;
		$this->load->view('page/tambahkryabsen',$data);
	}
	function ambildatakry(){
		$kunci = $_POST['kci'];
		$dep = $_POST['depe'];
		$mode = $_POST['mod'];
		if ($kunci=='@#@#') {
			$hasil = $this->m_absen->getkaryawan($dep)->result();
		}else{
			$hasil = $this->m_absen->ambildatakaryawan($kunci,$dep,$mode)->result();
		}
		echo json_encode($hasil);
	}
	function simpanabsen(){
		$tgl = $_POST['tg'];
		$dept = $_POST['dp'];
		$shi = $_POST['sh'];
		$id = $_POST['idx'];
		$this->m_absen->simpanabsen($tgl,$shi,$dept,$id);
		echo json_encode($id);
	}
	function isiabsenmaster(){
		$hasil = $this->m_absen->isiabsenmaster();
		$tgl = $this->session->userdata('dy').'-'.$this->session->userdata('bl').'-'.$this->session->userdata('th');
		$dep = $this->session->userdata('dep');
		$shi = $this->session->userdata('shi');
		if($hasil==1){
			$url = base_url().'absen/tambahabsen/'.$tgl.'/'.$dep.'/'.$shi;
		}else{
			$url = base_url().'absen';
		}
		redirect($url);
	}
	function hapusabsenkry($id,$x,$y){
		$this->m_absen->hapusabsenkry($id);
		$tgl = $this->session->userdata('dy').'-'.$this->session->userdata('bl').'-'.$this->session->userdata('th');
		$dep = $this->session->userdata('dep')=='' ? $x : $this->session->userdata('dep');
		$shi = $this->session->userdata('shi')=='' ? $y :$this->session->userdata('shi');
		$url = base_url().'absen/tambahabsen/'.$tgl.'/'.$dep.'/'.$shi;
		redirect($url);
	}
	function hitungkupon(){
		$g = 1;
		$tgl = $_POST['tgl'];
		$dep = $_POST['dep'];
		$shi = $_POST['shi'];
		$this->m_absen->hitungkupon(tglmysql($tgl),$dep,$shi);
		echo json_encode($g);
	}
	function simpankupon(){
		$hadir = $_POST['hadir'];
		$hadirar = $_POST['hadirar'];
		$hadirnu = $_POST['hadirnu'];
		$lembur = $_POST['lembur'];
		$lemburar = $_POST['lemburar'];
		$lemburnu = $_POST['lemburnu'];
		$kmb = $_POST['kmb'];
		$ket = $_POST['ket'];
		$tgl = $_POST['tgl'];
		$dep = $_POST['dep'];
		$shi = $_POST['shi'];
		$this->m_absen->simpankupon(tglmysql($tgl),$dep,$shi,$hadir,$hadirar,$hadirnu,$lembur,$lemburar,$lemburnu,$kmb,$ket);
		echo json_encode($dep);
	}
	function hapus($id){
		$this->m_absen->hapus($id);
		$url = base_url().'absen';
		redirect($url);
	}
	function ubahabsen($id,$isi,$dep,$shi){
		$data['id'] = $id;
		$data['isi'] = $isi;
		$data['formAction'] = base_url().'absen/simpandataabsen/'.$dep.'/'.$shi;
		$this->load->view('page/editabsen',$data);
	}
	function simpandataabsen($a,$b){
		$this->m_absen->simpandataabsen();
		$tgl = $this->session->userdata('dy').'-'.$this->session->userdata('bl').'-'.$this->session->userdata('th');
		$dep = $this->session->userdata('dep')=='' ? $a : $this->session->userdata('dep');
		$shi = $this->session->userdata('shi')=='' ? $b :$this->session->userdata('shi');
		$url = base_url().'absen/tambahabsen/'.$tgl.'/'.$dep.'/'.$shi;
		redirect($url);
	}
	function kirimabsen($id){
		$this->m_absen->kirimabsen($id);
		$url = base_url().'absen';
		redirect($url);	
	}
	function viewabsen($tgl,$dep,$shi){
		$data['tgl'] = $tgl;
		$data['dep'] = $dep;
		$data['shi'] = $shi;
		$data['listgrup'] = $this->m_absen->getgrup(namadepartemen($dep));
		$data['listabsen'] = $this->m_absen->getabsen($tgl,$dep,$shi);
		$data['absen'] = $this->m_absen->getabsen2($tgl,$dep,$shi)->row();
		$data['kupon'] = $this->m_kuponmakan->getkupon(tglmysql($tgl),$dep,$shi)->row();
		$footer['foot'] = 'menuatas';
		$footer['foot2'] = 'absen';
		$this->load->view('page/header');
		$this->load->view('page/formviewabsen',$data);
		$this->load->view('page/footer',$footer);
	}
	function kuponkembali($id){
		$data['kupon'] = $this->m_kuponmakan->detailkuponbyid_absen($id)->row();
		$data['formAction'] = base_url().'absen/tambahkuponkembali';
		$this->load->view('page/formkuponkembali',$data);
	}
	function tambahkuponkembali(){
		$hasil = $this->m_kuponmakan->tambahkuponkembali();
		if($hasil==1){
			$url = base_url().'absen';
			redirect($url);				
		}
	}
}
