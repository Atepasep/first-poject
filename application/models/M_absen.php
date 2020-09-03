<?php
class M_absen extends CI_Model {
	function getkaryawan($dep){
		$hasil = $this->db->query("Select * from personil where bagian = '".namadepartemen($dep)."' ");
		return $hasil;
	}
	function ambildatakaryawan($kunci,$dep,$mode){
		$kolom = $mode=='nik' ? 'noinduk' : 'nama' ;
		$hasil = $this->db->query("Select * from personil where ".$kolom." like '%".$kunci."%' and bagian = '".namadepartemen($dep)."' ");
		return $hasil;
	}
	function getgrup($dep){ 
		$hasil = $this->db->query("select grup from personil where bagian='".$dep."' group by 1");
		return $hasil;
	}
	function simpanabsen($tgl,$shi,$dept,$id){
		$cek = $this->db->query("select * from absen where tanggal = '".tglmysql($tgl)."' and id_dept = '".$dept."' and shif = '".$shi."' ");
		$dataabsen = $cek->row();
		$ida = $dataabsen->id;
		$cekkaryawan = $this->db->query("select * from personil where id = $id ")->row();
		$this->db->query("insert into detail_absen (id_absen,noinduk,nama,bagian,jabatan) values ('".$ida."','".$cekkaryawan->noinduk."','".$cekkaryawan->nama."','".$cekkaryawan->bagian."','".$cekkaryawan->jabatan."') ");
		// hitung jumlah detail
		$jum = $this->db->query("select count(*) as jumlah from detail_absen where id_absen ='".$ida."' ")->row();
		$hasil = $this->db->query("update absen set absen = $jum->jumlah where id = '".$ida."' ");
		$this->db->query("update kuponmakan set absen = $jum->jumlah where id_absen = '".$ida."' ");
		tulislog($this->session->userdata('username')." MENAMBAH data absensi atasnama ".trim($cekkaryawan->nama)." (".$cekkaryawan->noinduk.")");
		return $hasil;
	}
	function getdata(){
		$tgl = $this->session->userdata('th')."-".$this->session->userdata('bl')."-".$this->session->userdata('dy');
		$kuerr = '';
		if($this->session->userdata('dep')!=''){
			$kuerr .= " and id_dept = '".$this->session->userdata('dep')."' ";
		}
		if ($this->session->userdata('shi')!='') {
			$kuerr .= " and shif = '".$this->session->userdata('shi')."' ";
		}
		//$hasil = $this->db->query("select * from absen where tanggal = '".$tgl."' ".$kuerr);
		$hasil = $this->db->query("select absen.*,(if(kuponmakan.hitung>=1,kuponmakan.hadir+kuponmakan.hadirar+kuponmakan.hadirnu,0)) AS jmhadir,(if(kuponmakan.hitung>=1,kuponmakan.lembur+kuponmakan.lemburar+kuponmakan.lemburnu,0)) AS jmlembur,kuponmakan.kmb AS kmb,kuponmakan.cek as kupcek from absen left join kuponmakan on absen.id=kuponmakan.id_absen where absen.tanggal = '".$tgl."' ".$kuerr);
		return $hasil; //"select * from absen where tanggal = '".$tgl."' ".$kuerr;
	}
	function getdatakupon(){
		$tgl = $this->session->userdata('th')."-".$this->session->userdata('bl')."-".$this->session->userdata('dy');
		$kuerr = '';
		if($this->session->userdata('dep')!=''){
			$kuerr .= " and departemen = '".$this->session->userdata('dep')."' ";
		}
		if ($this->session->userdata('shi')!='') {
			$kuerr .= " and shifp = '".$this->session->userdata('shi')."' ";
		}
		$hasil = $this->db->query("select * from kuponmakan where hitung>=1 and tanggal = '".$tgl."' ".$kuerr);
		return $hasil; //"select * from absen where tanggal = '".$tgl."' ".$kuerr;
	}
	function getjumlahkry(){
		$bag = $this->session->userdata('dep');
		$gru = $this->session->userdata('grup');
		$hasil = $this->db->query("select count(*) as jumlah from personil where bagian = '".namadepartemen($bag)."' and grup = '".$gru."' ");
		return $hasil;
	}
	function getabsen2($tgl,$dep,$shi){
		$cek = $this->db->query("select * from absen where tanggal = '".tglmysql($tgl)."'  AND id_dept = '".$dep."' AND shif = '".$shi."' ");
		return $cek;
	}
	function getabsen($tgl,$dep,$shi){
		$cek = $this->db->query("select * from absen where tanggal = '".tglmysql($tgl)."'  AND id_dept = '".$dep."' AND shif = '".$shi."' ")->row();
		if ($cek) {
			$hasil = $this->db->query("select * from detail_absen where id_absen = $cek->id ");
		}
		return $hasil;
	}
	function isiabsenmaster(){
		$data = $_POST;
		$data['tanggal'] = tglmysql($data['tanggal']);
		unset($data['shift']);
		unset($data['dept']);
		$cek = $this->db->query("select * from absen where tanggal ='".$data['tanggal']."' and id_dept = '".$data['id_dept']."' and shif = '".$data['shif']."' ");
		$hasil = 0;
		if($cek->num_rows() > 0){
			$this->session->set_flashdata('info','datasudahada');
		}else{
			$this->db->insert('absen',$data);
			$data['shifp'] = $data['shif'];
			$data['departemen'] = $data['id_dept'];
			$data['jumlah'] = $data['jumlahkry'];
			$cek = $this->db->query("select * from absen where tanggal ='".$data['tanggal']."' and id_dept = '".$data['id_dept']."' and shif = '".$data['shif']."' ")->row();
			$idnya = $cek->id;
			$data['id_absen'] = $idnya;
			unset($data['id_dept']);
			unset($data['shif']);
			unset($data['grup']);
			unset($data['jumlahkry']);
			$this->db->insert('kuponmakan',$data);
			tulislog($this->session->userdata('username')." MENAMBAH data MASTER ABSENSI untuk departemen ".namadepartemen($data['departemen'])." shift ".namashift($data['shifp']));
			$hasil = 1;
		}
		return $hasil;
	}
	function hapusabsenkry($id){
		$cek = $this->db->query("select * from detail_absen where id=$id")->row();
		$ida = $cek->id_absen;
		$this->db->where('id',$id);
		$this->db->delete('detail_absen');
		$jum = $this->db->query("select count(*) as jumlah from detail_absen where id_absen ='".$ida."' ")->row();
		$hasil = $this->db->query("update absen set absen = $jum->jumlah where id = '".$ida."' ");
		$this->db->query("update kuponmakan set absen = $jum->jumlah where id_absen = '".$ida."' ");
		tulislog($this->session->userdata('username')." MENGHAPUS data absensi atasnama ".trim($cek->nama)." (".$cek->noinduk.") ");
	}
	function hapus($id){
		$this->db->where('id_absen',$id);
		$this->db->delete('kuponmakan');
		$this->db->where('id_absen',$id);
		$this->db->delete('detail_absen');
		$cek = $this->db->query("select * from absen where id = $id")->row();
		$tgl = tglmysql($cek->tanggal);
		$dep = namadepartemen($cek->id_dept);
		$shi = namashift($cek->shif);
		$this->db->where('id',$id);
		$this->db->delete('absen');
		tulislog($this->session->userdata('username')." MENGHAPUS data MASTER ABSENSI dengan ID ".$id." tanggal ".$tgl.", departemen = ".$dep." shift ".$shi);
	}
	function hitungkupon($a,$b,$c){
		$hasil = 0;
		$cek = $this->db->query("update kuponmakan set hitung = if(hitung=1,0,1) where tanggal = '".$a."' and departemen = '".$b."' and shifp = '".$c."' ");
		if ($cek) {
			$hasil = 1;
			tulislog($this->session->userdata('username')." MERUBAH status HITUNG pada kuponmakan untuk departemen ".namadepartemen($b).", tanggal ".tglmysql($a)." shift ".namashift($c));
		}
		return $hasil;
	}
	function simpankupon($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k){ //,ket = $k
		$hasil = $this->db->query("update kuponmakan set hadir = $d,hadirar = $e,hadirnu = $f,lembur = $g,lemburar = $h,lemburnu = $i,kmb = $j,ket = '".$k."'  where tanggal = '".$a."' and departemen = '".$b."' and shifp = '".$c."' ");
		return $hasil;
	}
	function simpandataabsen(){
		$data = $_POST;
		$data['isiabsen'] = $data['optionabsen'];
		unset($data['optionmenu']);
		$this->db->query("update detail_absen set isiabsen = '".$data['isiabsen']."' where id = ".$data['id']);
	}
	function kirimabsen($id){
		$this->db->query("update absen set cek = if(cek=1,0,1) where id = $id ");
		$this->db->query("update kuponmakan set hitung = if(hitung=1,2,1) where id_absen = $id ");
		$cek = $this->db->query("select * from absen where id = $id")->row();
		$tgl = tglmysql($cek->tanggal);
		$dep = namadepartemen($cek->id_dept);
		$shi = namashift($cek->shif);
		tulislog($this->session->userdata('username')." MENGIRIM data ABSENSI untuk ID ".$id." tanggal ".$tgl.", departemen = ".$dep." shift ".$shi);
	}
}