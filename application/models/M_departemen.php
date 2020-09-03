<?php
class M_departemen extends CI_Model {
	function getdepartemen2(){
			$hasil = $this->db->query("select * from dept2 where apps='1' order by dept_id ");
			return $hasil;
	}
	function getalldepartemen(){
		$hasil = $this->db->query("select * from dept2 order by dept_id ");
		return $hasil->result_array();
	}
	function editapps($id){
		$hasil = $this->db->query("select * from modul_dept where id = '$id' ");
		return $hasil;
	}
	function getdetail($id){
		$hasil = $this->db->query("select * from pengguna  left join dept2 on pengguna.bagian=dept2.dept_id where pengguna.id ='$id' ");
		return $hasil->result();
	}
	function getapps($id){
		$query = "select a.id,a.namamodul,a.id_dept,b.nama_apps,b.url,b.img FROM modul_dept a
					  left join namaapps b on b.id=a.namamodul";
		$filter = " where a.id_dept = '$id' ";
		$hasil = $this->db->query($query.$filter);
		return $hasil->result_array();
	}
	function getbagian(){
		$hasil = $this->db->query("select * from dept2 order by dept_id");
		return $hasil->result_array();
	}
	function ubahapps(){
		$data = $_POST;
		$id = $data['id'];
		unset($data['id_dept']);
		unset($data['namadep']);
		$data['namamodul'] = strtoupper($data['namamodul']);
		$this->db->where('id',$id);
		$this->db->update('modul_dept',$data);
		tulislog($this->session->userdata('username')." mengubah apps dep ".$data['id_dept']);
	}
	function simpandepartemen(){
		$data = $_POST;
		$data['namamodul'] = strtoupper($data['namamodul']);
		unset($data['namadep']);
		$this->db->insert('modul_dept',$data);
		tulislog($this->session->userdata('username')." menambah apps dep ".$data['id_dept'].$data['namamodul']);
	}
	function ubahpengguna(){
		$data = $_POST;
		unset($data['modul1']);
		unset($data['modul2']);
		$data['bagian'] = $this->input->post('bagian');
		$aktif = $this->input->post('aktif');
		if((int)$aktif==1){
			$data['aktif']='1';
		}
		$data['bagian'] = $data['bagianpil'];
		unset($data['bagianpil']);
		$data['username'] = strtoupper($data['username']);
		$data['password'] = $this->generatePasswordHash(strtoupper($data['password']));
		$this->db->where('id',$data['id']);
		$this->db->update('pengguna',$data);
		$url = base_url('pengguna');
		redirect($url);
	}
	function hapusapps($id){
		$this->db->where('id',$id);
		$this->db->delete('modul_dept');
		tulislog($this->session->userdata('username')." menghapus apps dep ".$id);
	}
	private function generatePasswordHash($string)
	{
		// Pastikan inputnya adalah string
		$string = is_string($string) ? $string : strval($string);
		$pwHash = encrypto($string);
		return $pwHash;
	}
	function getdepartemen($dep){
		if($dep=='OT'){
			$hasil = $this->db->query("Select * from dept_ref where dept_id = '$dep' ")->row();
		}else{
			$hasil = $this->db->query("Select * from dept2 where dept_id = '$dep' ")->row();
		}
		return $hasil;

	}
	function getapps2(){
		$hasil = $this->db->get('namaapps');
		return $hasil->result_array();
	}
}