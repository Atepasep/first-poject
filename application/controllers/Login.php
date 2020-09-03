<?php 
if(!defined('BASEPATH'))exit('No direct access allowed');
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('m_login');
        $this->load->model('m_log');
	}

	function index(){
		$data['formAction'] = 'Login/Auth';
		$this->load->view('page/login2.php',$data);
	}

	function auth(){
        if($this->input->post('name')!=null AND $this->input->post('pass')!=null){
	  	    $username=strip_tags(strtoupper(str_replace("'", "", $this->input->post('name'))));
            $password=strip_tags(strtoupper(str_replace("'", "", $this->input->post('pass'))));
            $u      = strtoupper($username);
            $pe     = strtoupper($password);
            // $p      = $this->encrypt->encode($pe);
            $cekadmin = $this->m_login->ceklogin($u,$pe);
            if($cekadmin->num_rows() > 0){
               $datalogin = $cekadmin->row();
            	$this->session->set_userdata('masukifncloud',TRUE);
                $this->session->set_userdata('user',$datalogin->id);
                $this->session->set_userdata('nama',$datalogin->nama);
                $this->session->set_userdata('username',$datalogin->username);
                $this->session->set_userdata('bagian',$datalogin->bagian);
                $this->session->set_userdata('modul',$datalogin->modul2);
                $this->session->set_userdata('aksesapps',$datalogin->modul1);
                tulislog($username." : berhasil login");
                redirect('login/berhasillogin');
            	// $url = base_url('Administrator');
            	// redirect($url);
            }else{
                $jml = $cekadmin->num_rows();
                tulislog($username." dan pass ".$password." : mencoba masuk BAHAYA");
                $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Perhatian!</strong> <br>Username / password yang anda masukan salah.
                    </div>');
                $url = base_url('login');
                redirect($url);
            }
        }else{
        	$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Perhatian!</strong> <br>Username dan password harus di isi
                </div>');
        	$url = base_url('login');
        	redirect($url);
        }
	}
    function berhasillogin(){
        $url = base_url();
        redirect($url);
    }
    function keluarprogram(){
        $user = $this->session->userdata('username');
        tulislog($user." : logout");
        $this->session->sess_destroy();
        $url = base_url('Login');
        redirect($url);
    }	
}