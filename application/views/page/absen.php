<div class="container-fluid">
	<div class="content">
		<div id="header-app">
			<div class="form-inline">
			Absensi Karyawan<small class="ml-sm-1"> departemen </small>
			<select class="form-control form-control-sm ml-sm-1 huruf-kecil flat" id="dept" name="dept">
				<?php
					if($this->session->userdata('bagian')=='AW' OR $this->session->userdata('bagian')=='SC'){
						echo "<option value=''>Semua</option>";
					}
				?>
				<?php foreach($dept->result_array() as $i){ 
					if($i['dept_id']==$this->session->userdata('bagian') OR $this->session->userdata('bagian')=='AW' ){
				?>
					<option value="<?= $i['dept_id'] ?>" <?php if($this->session->userdata('dep')==$i['dept_id']){ echo "selected"; } ?>><?= $i['departemen'] ?></option>
				<?php }} ?>
				<?php
					if($this->session->userdata('bagian')=='AW' OR $this->session->userdata('bagian')=='SC'){
						echo "<option value='OT'>Lain - Lain</option>";
					}
				?>
			</select>
			</div>
		</div>
		<hr class="pendek">
		<div class="form-inline" style="margin-bottom: 5px; float: left;">
				Periode :
				<input type="text" name="tglperiod" id="tglperiod" class="form-control form-control-sm tek-pendek-xs ml-sm-1 huruf-kecil flat" value="<?= $this->session->userdata('dy') ?>" style="text-align: right;">
				<select id="bulperiod" name="bulperiod" class="form-control form-control-sm ml-sm-1 huruf-kecil flat">
					<?php
						for($xi=1;$xi<=12;$xi++){ $pilih = $xi==$this->session->userdata('bl') ? 'selected' : ''; ?>
							<option value="<?= $xi; ?>" <?= $pilih; ?>><?= namabulan($xi); ?></option>
					<?php } 
					?>
				</select>
				<input type="text" name="thperiod" id="thperiod" class="form-control form-control-sm tek-pendek ml-sm-1 huruf-kecil flat" value="<?= $this->session->userdata('th') ?>" style="text-align: right;">
				<label class="justify-content-start ml-sm-1" style="width: 40px !important;">, Shift :</label>
				<select id="shiperi" name="shiperi" class="form-control form-control-sm ml-sm-1 huruf-kecil flat">
					<option value="" <?php if($this->session->userdata('shi')==''){ echo "selected"; } ?>>Semua</option>
					<option value="p" <?php if($this->session->userdata('shi')=='p'){ echo "selected"; } ?>>Pagi</option>
					<option value="s" <?php if($this->session->userdata('shi')=='s'){ echo "selected"; } ?>>Siang</option>
					<option value="m" <?php if($this->session->userdata('shi')=='m'){ echo "selected"; } ?>>Malam</option>
					<option value="n" <?php if($this->session->userdata('shi')=='n'){ echo "selected"; } ?>>Non Shift</option>
				</select>
				<?php if(date('d-m-Y')==($this->session->userdata('dy').'-'.bll($this->session->userdata('bl')).'-'.$this->session->userdata('th'))){ ?>
				<?php if(($this->session->userdata('dep')!='') && ($this->session->userdata('shi')!='' )){ ?>
					<a href="<?= base_url().'absen/tambahabs' ?>" data-remote="false" data-toggle="modal" data-title="Tambah data" data-target="#modalBox" class="btn btn-sm btn-success huruf-kecil flat ml-sm-3" id="tambahabsenx">Tambah</a>
				<?php }} ?>
				<a href="#" class="btn btn-sm btn-primary huruf-kecil flat ml-sm-1" id="cetakabsen">Cetak</a>
				<a href="<?= base_url().'absen' ?>" class="btn btn-sm btn-warning ml-sm-1 huruf-kecil flat" id="updateperiod">Refresh</a>
				<a href="<?= base_url().'absen/absenclear' ?>" class="btn btn-sm btn-info huruf-kecil ml-sm-1 flat" id="curperiod">Current</a>
		</div>
		<div class="row" style="clear: both;">
			<div class="col-sm-8">
				<div id="tabelkupon">
					<table class="table table-condensed table-bordered tabelku">
						<thead class="huruf-tengah">
							<th>Shift</th>
							<th>Departemen</th>
							<th>Jml Kry</th>
							<th>Absen</th>
							<th>Hadir</th>
							<th>Kupon</th>
							<th>Lembur</th>
							<th>Kmb</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</thead>
						<tbody id="data-tabelku">
							<?php foreach($absen->result_array() as $abs){ ?>
								<tr>
									<td><?= namashift($abs['shif']) ?></td>
									<td><?= namadepartemen($abs['id_dept']) ?></td>
									<td style="text-align: right;"><?= $abs['jumlahkry'] ?></td>
									<td style="text-align: right;"><?= $abs['absen'] ?></td>
									<td style="text-align: right;"><?= $abs['jumlahkry']-$abs['absen'] ?></td>
									<td style="text-align: right;"><?= $abs['jmhadir'] ?></td>
									<td style="text-align: right;"><?= $abs['jmlembur'] ?></td>
									<td style="text-align: right;"><?= $abs['kmb'] ?></td>
									<td><?= $abs['ket'] ?></td>
									<td class="huruf-tengah">
										<?php if($abs['cek']=='0'){ ?>
											<a href="#" data-href="<?= base_url().'absen/kirimabsen/'.$abs['id'] ?>" data-remote="false" data-toggle="modal" data-target="#confirm-task" data-news="Kirim data ini, anda tidak bisa edit kembali ?" class="bg-warning" style="color: black; padding: 1px 2px;"><i class="fa fa-send"></i> Kirim data </a><br>
											<a href="<?= base_url().'absen/tambahabsen/'.tglmysql($abs['tanggal']).'/'.$abs['id_dept'].'/'.$abs['shif'] ?>" class="bg-info ml-sm-1" style="color: white; padding: 1px 2px;" ><i class="fa fa-search"></i> View & Edit</a>
											<a href="#" data-href="<?= base_url().'absen/hapus/'.$abs['id'] ?>" data-remote="false" data-toggle="modal" data-target="#confirm-delete" data-title="Hapus data ini, akan menghapus data kupon dan detail absen ?" class="bg-danger" style="color:white;padding: 1px 2px;"><i class="fa fa-trash"></i> Hapus</a>
										<?php }else{ ?>
											<a href="<?= base_url().'absen/viewabsen/'.tglmysql($abs['tanggal']).'/'.$abs['id_dept'].'/'.$abs['shif'] ?>" class="bg-info ml-sm-1" style="color: white; padding: 1px 2px;" ><i class="fa fa-eye"></i> View</a><br>
											<?php if($abs['kupcek']<=1){ ?>
												<a href="<?= base_url().'absen/kuponkembali/'.$abs['id'] ?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Pengembalian Kupon" class="bg-success ml-sm-1" style="color: white; padding: 1px 2px;" ><i class="fa fa-mail-forward"></i> Kembalikan Kupon</a>
											<?php } ?>
										<?php  } ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-4">
				<?php
					$jmkry = 0;$jmabs=0;$jmhadir=0;$jmhadirar=0;$jmhadirnu=0;$jmlembur=0;$jmlemburar=0;$jmlemburnu=0;
					$jmkmb=0;$tot1=0;$tot2=0;$tot3=0;
					foreach($kupon->result_array() as $kupon){
						$jmkry += $kupon['jumlah'];
						$jmabs += $kupon['absen'];
						$jmhadir += $kupon['hadir'];
						$jmhadirar += $kupon['hadirar'];
						$jmhadirnu += $kupon['hadirnu'];
						$jmlembur += $kupon['lembur'];
						$jmlemburar += $kupon['lemburar'];
						$jmlemburnu += $kupon['lemburnu'];
						$jmkmb += $kupon['kmb'];
						$tot1 += ($jmhadir+$jmlembur);
						$tot2 += ($jmhadirar+$jmlemburar);
						$tot3 += ($jmhadirnu+$jmlemburnu);
					} 
				?>
				Rekap Permintaan Kupon :
				<div class="isirekap">
					<table>
						<tr class="border-bawah">
							<td style="width: 150px;">Jumlah Karyawan</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $jmkry ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;">Jumlah Absen</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $jmabs ?></td>
						</tr>
						<tr>
							<td style="width: 150px;">Jumlah Hadir</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $jmhadir+$jmhadirar+$jmhadirnu ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" colspan="2"></td>
							<td>
								<table class="tabel-rapat">
									<tr>
										<td style="width: 50px;">IFN</td>
										<td><?= $jmhadir ?></td>
									</tr>
									<tr>
										<td>AR</td>
										<td><?= $jmhadirar ?></td>
									</tr>
									<tr>
										<td>NU</td>
										<td><?= $jmhadirnu ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="width: 150px;">Lembur</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $jmlembur+$jmlemburar+$jmlemburnu ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" colspan="2"></td>
							<td>
								<table class="tabel-rapat">
									<tr>
										<td style="width: 50px;">IFN</td>
										<td><?= $jmlembur ?></td>
									</tr>
									<tr>
										<td>AR</td>
										<td><?= $jmlemburar ?></td>
									</tr>
									<tr>
										<td>NU</td>
										<td><?= $jmlemburnu ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" class="border-bawah">Kembali</td>
							<td style="width: 20px;" class="border-bawah">:</td>
							<td class="border-bawah"><?= $jmkmb ?></td>
						</tr>
						<tr class="font-tebal" style="font-size: 16px;">
							<td style="width: 150px;">Total</td>
							<td style="width: 20px;">:</td>
							<td><?= $tot1+$tot2+$tot3 ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" colspan="2"></td>
							<td>
								<table class="tabel-rapat">
									<tr>
										<td style="width: 50px;">IFN</td>
										<td><?= $tot1 ?></td>
									</tr>
									<tr>
										<td>AR</td>
										<td><?= $tot2 ?></td>
									</tr>
									<tr>
										<td>NU</td>
										<td><?= $tot3 ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>