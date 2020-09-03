<?php
class M_bis extends CI_Model {
	function get_data(){
		$bln = $this->session->userdata('bln');
		$thn = $this->session->userdata('thn');
		$query = "Select * from datajemputan where bulan=".$bln." and tahun=".$thn;
		$jumlah = $this->db->query($query)->num_rows();
		if($jumlah==0){
			$query = "select * from jemputan where aktif=1";
			$hasil = $this->db->query($query)->result_array();
			foreach($hasil as $data){
				$query = "insert into datajemputan(tahun,bulan,id_jemputan) values (".$thn.",".$bln.",'".$data['id']."') ";
				$this->db->query($query);
			}
		}
		$dataquery = "select * from jemputan left join datajemputan on datajemputan.id_jemputan=jemputan.id where bulan=".$bln." and tahun=".$thn;
		$hasilnya = $this->db->query($dataquery);
		return $hasilnya->result_array();
	}
	function ubahstatus(){
		$data = $_POST;
		$query = "select absen from datajemputan where id = '".$data['idjemputan']."' ";
		$hasilquery = $this->db->query($query)->row();
		$dataabsen = $hasilquery->absen;
		$data['absen'] = substr_replace($dataabsen, $data['optionabsen'], $data['norekod'],1);
		$id = $data['idjemputan'];
		unset($data['idjemputan']);
		unset($data['norekod']);
		unset($data['optionabsen']);
		$this->db->where('id',$id);
		$this->db->update('datajemputan',$data);
		tulislog($this->session->userdata('username')." merubah data absen bis tanggal ".$this->session->userdata('tgl')."-".$this->session->userdata('bln')."-".$this->session->userdata('thn')." [".$id."]");
	}
	function addlog(){
		$data = $_POST;
		tulislog($this->session->userdata('username')." masuk ke aplikasi ".$data['apps']);
	}
}