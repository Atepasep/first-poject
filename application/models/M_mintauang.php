<?php
class M_mintauang extends CI_Model {
	function get_all_data(){
		$bl = $this->session->userdata('bl');
		$th = $this->session->userdata('th');
		$hasil = $this->db->query("select * from mintauang where month(tgl)='$bl' and year(tgl)='$th' order by id desc");
		return $hasil;
	}
	function simpandata(){
		$data = $_POST;
		$data['tgl'] = tglmysql($data['tgl']);
		if ($data['pemohon']=='') {
			$data['dummy'] = 'ANDA MENCOBA HACK SITUS INI ?';
		}
		$data['id_dept'] = $this->session->userdata('bagian');
		unset($data['kembali']);
		$this->db->insert('mintauang',$data);
		tulislog($this->session->userdata('username')." menambah data ".$data['pemohon'].", tanggal ".$data['tgl']);
	}
	function getdetaildata($id){
		$hasil = $this->db->query("select * from mintauang where id ='$id' ");
		return $hasil;
	}
	function hapus($a){
		$this->db->where('id',$a);
		$this->db->delete('mintauang');
		$url = base_url().'mintauang';
		redirect($url);
	}
	function getdepartemen(){
		$query = $this->db->query("select * from dept2 where dept_id = '".$this->session->userdata('bagian')."' ");
		return $query;
	}
}