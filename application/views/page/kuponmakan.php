<div class="container-fluid">
	<div class="content">
		<div id="header-app">
			<div class="form-inline">
			KUPON MAKAN<small class="ml-sm-1"> input kupon makan departemen</small>
			<select class="form-control form-control-sm ml-sm-1 huruf-kecil flat" id="dept" name="dept">
				<?php
					if($this->session->userdata('bagian')=='AW' OR $this->session->userdata('bagian')=='SC'){
						echo "<option value=''>Semua</option>";
					}
				?>
				<?php foreach($dept as $i){ 
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
				<a href="<?= base_url().'kuponmakan/tambahkuponmakan' ?>" data-toggle="modal" data-title="Tambah data" data-remote="false" data-target="#modalBox" class="btn btn-sm btn-success huruf-kecil flat ml-sm-3" style="display: none;" id="tambahkuponmakan">Tambah</a>
				<?php if($this->session->userdata('dep')!=""){ ?>
					<a href="#" class="btn btn-sm btn-success huruf-kecil flat ml-sm-3" id="tambahkupon">Tambah</a>
				<?php } ?>
				<a href="#" class="btn btn-sm btn-primary huruf-kecil flat ml-sm-1" id="cetakkupon">Cetak</a>
				<a href="#" class="btn btn-sm btn-warning ml-sm-1 huruf-kecil flat" id="updateperiod">Refresh</a>
				<a href="<?= base_url().'kuponmakan/kuponmakanclear' ?>" class="btn btn-sm btn-info huruf-kecil ml-sm-1 flat" id="curperiod">Current</a>
		</div>
		<div class="row" style="clear: both;">
			<div class="col-sm-8">
				<div id="tabelkupon">
					<table class="table table-condensed table-bordered tabelku">
						<thead class="huruf-tengah">
							<th>Shift</th>
							<th>Departemen</th>
							<th>Jumlah</th>
							<th>Absen</th>
							<th>Hadir</th>
							<th>Lembur</th>
							<th>Kembali</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</thead>
						<tbody id="data-tabelku">
							<?php
								$xjumlah = 0; $xjumlahabsen = 0; $xjumlahhadir = 0; $xhadir = 0; $xhadirar = 0;$xhadirnu = 0;
								$xjumlahlembur = 0;$xlembur = 0; $xlemburar = 0; $xlemburnu = 0;
								$xkmb = 0;$xifn = 0;$xnu = 0; $xar = 0;$xtotjumlah = 0;
								foreach ($kupon as $datakupon) { 
								$xjumlah += $datakupon['jumlah'];
								$xjumlahabsen += $datakupon['absen'];
								$xjumlahhadir += $datakupon['hadir']+$datakupon['hadirar']+$datakupon['hadirnu'];
								$xhadir += $datakupon['hadir'];
								$xhadirar += $datakupon['hadirar'];
								$xhadirnu += $datakupon['hadirnu'];
								$xjumlahlembur += $datakupon['lembur']+$datakupon['lemburar']+$datakupon['lemburnu'];
								$xlembur += $datakupon['lembur']; 
								$xlemburar += $datakupon['lemburar']; 
								$xlemburnu += $datakupon['lemburnu'];
								$xkmb += $datakupon['kmb'];
								$xifn += $datakupon['hadir']+$datakupon['lembur'];
								$xar += $datakupon['hadirar']+$datakupon['lemburar'];
								$xnu += $datakupon['hadirnu']+$datakupon['lemburnu'];
								$xtotjumlah += $datakupon['hadir']+$datakupon['hadirar']+$datakupon['hadirnu']+$datakupon['lembur']+$datakupon['lemburnu']+$datakupon['lemburar'];
							?>
								<tr>
									<td><?= namashift($datakupon['shifp']) ?></td>
									<td><?= namadepartemen($datakupon['departemen']) ?></td>
									<td class="huruf-kanan"><?= rupiah($datakupon['jumlah'],0) ?></td>
									<td class="huruf-kanan"><?= rupiah($datakupon['absen'],0) ?></td>
									<td class="huruf-kanan"><?= rupiah($datakupon['hadir']+$datakupon['hadirar']+$datakupon['hadirnu'],0) ?></td>
									<td class="huruf-kanan"><?= rupiah($datakupon['lembur']+$datakupon['lemburar']+$datakupon['lemburnu'],0) ?></td>
									<td class="huruf-kanan"><?= rupiah($datakupon['kmb'],0) ?></td>
									<td><?= $datakupon['ket'] ?></td>
									<td class="huruf-tengah">
										<?php if ($datakupon['cek']=='0') { ?>
											<a href="#" data-href="<?= base_url().'kuponmakan/hapuskupon/'.$datakupon['id'] ?>" data-target="#confirm-delete" data-remote="false" data-toggle="modal" title="Hapus data" id="hapuskuponmakan" rel="<?= $datakupon['id'] ?>"><img src="<?= base_url().'assets/images/del.png'; ?>"></a>
											<a class="ml-sm-1" href="<?= base_url().'kuponmakan/updatekuponmakan/'.$datakupon['id'] ?>" data-toggle="modal" data-title="Edit data" data-remote="false" data-target="#modalBox" id="editkuponmakan" rel="<?= $datakupon['id'] ?>"><img src="<?= base_url().'assets/images/edit.png'; ?>"></a>
											<?php if($this->session->userdata('bagian')=='AW' || $this->session->userdata('bagian')=='SC'){ ?>
											<a class="ml-sm-1" href="#" data-href="<?= base_url().'kuponmakan/konfirmasikupon/'.$datakupon['id'] ?>" data-target="#confirm-task" data-remote="false" data-toggle="modal" title="Konfirmasi" id="konfirmasikuponmakan" rel="<?= $datakupon['id'] ?>" data-news="Konfirmasi kupon makan ?" style="background-color: #DC2422; color: white; padding: 0 5px;">Cek Security</a>
											<?php } ?>
										<?php }else{ if($this->session->userdata('bagian')=='AW' || $this->session->userdata('bagian')=='SC'){ ?>
											<a class="ml-sm-1" href="#" data-href="<?= base_url().'kuponmakan/konfirmasikupon/'.$datakupon['id'] ?>" data-target="#confirm-task" data-remote="false" data-toggle="modal" title="Konfirmasi" id="konfirmasikuponmakan" rel="<?= $datakupon['id'] ?>" data-news="Batalkan Konfirmasi ?" style="background-color: #138496; color: white; padding: 0 5px;">Batalkan Cek</a>
										<?php }else{ ?>
											Sudah dikonfirmasi Security
										<?php }} ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-4">
				Rekapitulasi Kupon Periode Ini :
				<div class="isirekap">
					<table>
						<tr class="border-bawah">
							<td style="width: 150px;">Jumlah Karyawan</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $xjumlah; ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;">Jumlah Absen</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $xjumlahabsen; ?></td>
						</tr>
						<tr>
							<td style="width: 150px;">Jumlah Hadir</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $xjumlahhadir; ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" colspan="2"></td>
							<td>
								<table class="tabel-rapat">
									<tr>
										<td style="width: 50px;">IFN</td>
										<td><?= $xhadir ?></td>
									</tr>
									<tr>
										<td>AR</td>
										<td><?= $xhadirar ?></td>
									</tr>
									<tr>
										<td>NU</td>
										<td><?= $xhadirnu ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="width: 150px;">Lembur</td>
							<td style="width: 20px;">:</td>
							<td class="font-tebal"><?= $xjumlahlembur; ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" colspan="2"></td>
							<td>
								<table class="tabel-rapat">
									<tr>
										<td style="width: 50px;">IFN</td>
										<td><?= $xlembur ?></td>
									</tr>
									<tr>
										<td>AR</td>
										<td><?= $xlemburar ?></td>
									</tr>
									<tr>
										<td>NU</td>
										<td><?= $xlemburnu ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" class="border-bawah">Kembali</td>
							<td style="width: 20px;" class="border-bawah">:</td>
							<td class="border-bawah"><?= isnol($xkmb); ?></td>
						</tr>
						<tr class="font-tebal" style="font-size: 16px;">
							<td style="width: 150px;">Total</td>
							<td style="width: 20px;">:</td>
							<td><?= $xtotjumlah; ?></td>
						</tr>
						<tr class="border-bawah">
							<td style="width: 150px;" colspan="2"></td>
							<td>
								<table class="tabel-rapat">
									<tr>
										<td style="width: 50px;">IFN</td>
										<td><?= $xifn ?></td>
									</tr>
									<tr>
										<td>AR</td>
										<td><?= $xar ?></td>
									</tr>
									<tr>
										<td>NU</td>
										<td><?= $xnu ?></td>
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