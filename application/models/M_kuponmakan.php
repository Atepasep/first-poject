<?php
	class M_kuponmakan extends CI_Model {
		function getdepartemen(){
			$hasil = $this->db->query("select * from dept2 where apps='1' order by dept_id ");
			return $hasil->result_array();
		}
		function getdatakupon($a,$b,$c,$d,$e){
			if($d==''){
				$tgl = $c.'-'.$b.'-'.$a;
				$kuerr = $e=='' ? '' : " and departemen='$e' ";
				$hasil = $this->db->query("select * from kuponmakan where hitung>=1 and tanggal='$tgl' ".$kuerr);
			}else{
				$tgl = $c.'-'.$b.'-'.$a;
				$kuerr = $e=='' ? '' : " and departemen='$e' ";
				$hasil = $this->db->query("select * from kuponmakan where hitung>=1 and tanggal='$tgl' and shifp='$d' ".$kuerr);
			}
			return $hasil->result_array();
		}
		function getkupon($a,$b,$c){
			$hasil = $this->db->query("select * from kuponmakan where tanggal='".$a."' and departemen='".$b."' and shifp='".$c."' ");
			return $hasil;
		}
		function tambah(){
			$data = $_POST;
			$data['tanggal'] = tglmysql($data['tanggal']);
			$data['shifp'] = $data['shift2'];
			unset($data['shift']);
			unset($data['shift2']);
			$cekisi = $this->db->query("select * from kuponmakan where tanggal='".$data['tanggal']."' and departemen='".$data['departemen']."' and shifp='".$data['shifp']."' ");
			$datasudahada = $cekisi->row();
			$datasudahada = is_object($datasudahada) ? TRUE : FALSE;
			if($datasudahada){
				$this->session->set_flashdata('info',"datasudahada");
			}else{
				$this->db->insert('kuponmakan',$data);
				tulislog($this->session->userdata('username')." menambah data ".$data['departemen']." shift ".$data['shifp']." tanggal ".$data['tanggal']);
			}
		}
		function update($id){
			$data = $_POST;
			$data['tanggal'] = tglmysql($data['tanggal']);
			$data['shifp'] = $data['shift2'];
			unset($data['shift']);
			unset($data['shift2']);
			$this->db->where('id',$id);
			$this->db->update('kuponmakan',$data);
			tulislog($this->session->userdata('username')." merubah data ".$data['departemen']." shift ".$data['shifp']." tanggal ".$data['tanggal']);
		}
		function hapuskupon($id){
			$this->db->where('id',$id);
			$this->db->delete('kuponmakan');
			tulislog($this->session->userdata('username')." menghapus data ".$id);
		}
		function detailkupon($id){
			$hasil = $this->db->query("select * from kuponmakan where id ='$id' ");
			return $hasil;	
		}
		function konfirmasikupon($id){
			$query = "update kuponmakan set cek = if(cek=1,0,1) where id = '$id' ";
			$hasil = $this->db->query($query);
			$cek = $this->db->where('id',$id)->get('kuponmakan')->row();
			tulislog($this->session->userdata('username')." konfirmasi id ".$id." jadi ".$cek->cek);
			return $hasil;
		}
		function detailkuponbyid_absen($id){
			$hasil = $this->db->query("select * from kuponmakan where id_absen ='$id' ");
			return $hasil;	
		}
		function tambahkuponkembali(){
			$data = $_POST;
			$hasil = 0;
			$cek = $this->db->query("update kuponmakan set kmb = '".$data['kmb']."', ket = '".$data['ket']."' where id = '".$data['id']."' ");
			if($cek){
				$hasil = 1;
				tulislog($this->session->userdata('username')." MENGEMBALIKAN kupon makan untuk ID ".$data['id']);
			}
			return $hasil;
		}
	}
?>