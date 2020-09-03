<?php
class M_aplikasi extends CI_Model {
	function getallapps(){
		$hasil = $this->db->query("select * from modul_dept");
		return $hasil->result_array();
	}
	function getapps($dep){
		$query = "select a.id,a.namamodul,a.id_dept,b.nama_apps,b.url,b.img from modul_dept a
				  left join namaapps b on b.id=a.namamodul";
		$d = " where id_dept = '$dep' ";
		$hasil = $this->db->query($query.$d);
		return $hasil->result_array();
	}
}