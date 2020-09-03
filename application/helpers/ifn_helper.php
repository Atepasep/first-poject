<?php
	define('HOME', base_url());
	function namabulan($i){
		$bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		return $bulan[(int)$i];
	}
	function rupiah($nomor,$dec){
		if($nomor == '0' || $nomor == ''){
			$hasil = '';
		}else{
			$hasil = number_format($nomor,$dec,'.',',');
		}
		return $hasil;
	}
	function rupiahslip($nomor,$dec){
		$hasil = number_format($nomor,$dec,'.',',');
		return $hasil;
	}
	function namashift($sh){
		switch ($sh) {
			case 'p':
				$shift = 'PAGI';
				break;
			case 's':
				$shift = 'SIANG';
				break;
			case 'm':
				$shift = 'MALAM';
				break;
			case 'n':
				$shift = 'NON SHIFT';
				break;
			default:
				$shift = 'ERROR';
				break;
		}
		return $shift;
	}
	function tglmysql($tgl){
		if($tgl == ''){
			$rubah = '';
		}else{
			$x = explode('-',$tgl);
			$rubah = $x[2].'-'.$x[1].'-'.$x[0];
		}
		return $rubah;
	}
	function namadepartemen($dep){
		$CI = & get_instance();
		$datadep = $CI->m_departemen->getdepartemen($dep);
		return $datadep->departemen;
	}
	function isnol($hit){
		if($hit==0){
			$hit = '';
		}
		return $hit;
	}
	function tulislog($log){
		$CI = & get_instance();
		$server = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$lokasi = $_SERVER['REMOTE_ADDR'];
		$hasil = $CI->m_log->isidata($server,$log,$lokasi);
		return $hasil;
	}
	function infomintauang($a){
		$hasil = "";
		switch($a){
			case 0 :
				$hasil = "Tunggu Approve";
			break;
			case 2 :
				$hasil = "Sudah Approve";
			break;
			case 3 :
				$hasil = "Execute";
			break;
		}
		return $hasil;
	}
	function bulanindo($tgl,$mode){
		$hasil = '';
		$datahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
		$namahari = date('w',strtotime($tgl));
		$pisah = explode('-', $tgl);
		$bulan = namabulan($pisah[1]);
		if ($mode=1) {
			$hasil = $datahari[$namahari].", ".$pisah[0]." ".$bulan." ".$pisah[2];
		}
		return $hasil;
	}
	function bll($x){
		$hasil = $x;
		if (strlen($x)<=1) {
			$hasil = '0'.$x;
		}
		return $hasil;
	}
?>