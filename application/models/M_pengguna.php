<?php
class M_pengguna extends CI_Model {
	function getallpengguna(){
		$hasil = $this->db->query("select * from pengguna left join dept2 on pengguna.bagian=dept2.dept_id order by pengguna.id");
		return $hasil->result_array();
	}
	function getdetail($id){
		$hasil = $this->db->query("select * from pengguna  left join dept2 on pengguna.bagian=dept2.dept_id where pengguna.id ='$id' ");
		return $hasil->result();
	}
	function getpass($id){
		$hasil = $this->db->query("select password from pengguna where id = '$id' ")->row();
		return decrypto($hasil->password);
	}
	function getmodul($id){
		$query = "select a.id,a.namamodul,a.id_dept,b.nama_apps,b.url,b.img FROM modul_dept a
					  left join namaapps b on b.id=a.namamodul";
		//if($id=='AW'){
		//	$hasil = $this->db->query($query);
		//}else{
			$hasil = $this->db->query($query." where id_dept='$id' ");
		//}
		return $hasil->result_array();
	}
	function getbagian(){
		$hasil = $this->db->query("select * from dept2 order by dept_id");
		return $hasil->result_array();
	}
	function simpanpengguna(){
		$data = $_POST;
		unset($data['modul1']);
		unset($data['modul2']);
		unset($data['id']);
		$data['bagian'] = $this->input->post('bagian');
		$aktif = $this->input->post('aktif');
		if((int)$aktif==1){
			$data['aktif']='1';
		}else{
			$data['aktif']='0';
		}
		$modul = str_repeat('0', 30);
		$modul2 = str_repeat('0', 30);
		for($mx=1;$mx<=30;$mx++){
			$cekmodul = $this->input->post('menu'.$mx);
			$cekmodul2 = $this->input->post('modul'.$mx);
			if((int)$cekmodul==1){
				$modul = substr_replace($modul, '1', $mx-1,1);
			}
			if((int)$cekmodul2==1){
				$modul2 = substr_replace($modul2, '1', $mx-1,1);
			}
			unset($data['modul'.$mx]);
			unset($data['menu'.$mx]);
		}
		$data['modul1'] = $modul;
		$data['modul2'] = $modul2;
		$data['bagian'] = $data['bagianpil'];
		unset($data['bagianpil']);
		$data['username'] = strtoupper($data['username']);
		$data['password'] = $this->generatePasswordHash(strtoupper($data['password']));
		$this->db->insert('pengguna',$data);
		tulislog($this->session->userdata('username')." menambah user ".$data['nama']);
		$url = base_url('pengguna');
		redirect($url);
	}
	function ubahpengguna(){
		$data = $_POST;
		unset($data['modul1']);
		unset($data['modul2']);
		$data['bagian'] = $this->input->post('bagian');
		$aktif = $this->input->post('aktif');
		if((int)$aktif==1){
			$data['aktif']='1';
		}else{
			$data['aktif']='0';
		}
		$modul = str_repeat('0', 30);
		$modul2 = str_repeat('0', 30);
		for($mx=1;$mx<=30;$mx++){
			$cekmodul2 = $this->input->post('modul'.$mx);
			$cekmodul = $this->input->post('menu'.$mx);
			if((int)$cekmodul==1){
				$modul = substr_replace($modul, '1', $mx-1,1);
			}
			if((int)$cekmodul2==1){
				$modul2 = substr_replace($modul2, '1', $mx-1,1);
			}
			unset($data['modul'.$mx]);
			unset($data['menu'.$mx]);
		}
		$data['modul1'] = $modul;
		$data['modul2'] = $modul2;
		$data['bagian'] = $data['bagianpil'];
		unset($data['bagianpil']);
		$data['username'] = strtoupper($data['username']);
		$data['password'] = $this->generatePasswordHash(strtoupper($data['password']));
		$this->db->where('id',$data['id']);
		$this->db->update('pengguna',$data);
		tulislog($this->session->userdata('username')." mengubah user ".$data['nama']);
		$url = base_url('pengguna');
		redirect($url);
	}
	function hapuspengguna($id){
		$this->db->where('id',$id);
		$this->db->delete('pengguna');
		tulislog($this->session->userdata('username')." menghapus user ".$data['nama']);
		$url = base_url('pengguna');
		redirect($url);
	}
	private function generatePasswordHash($string)
	{
		// Pastikan inputnya adalah string
		$string = is_string($string) ? $string : strval($string);
		$pwHash = encrypto($string);
		return $pwHash;
	}
}