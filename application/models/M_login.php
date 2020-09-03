<?php
class M_login extends CI_Model {
	function ceklogin($usr,$pss){
		$psa = encrypto($pss);
		$hasil = $this->db->query("select * from pengguna where aktif=1 and username='$usr' and password='$psa' ");
		return $hasil;
	}
}