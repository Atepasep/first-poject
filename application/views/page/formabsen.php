<div class="container-fluid">
	<div class="content">
		<div id="header-app" style="overflow: hidden;">
			<div style="float: left;">
				Laporan Absensi Karyawan
				<div class="form-inline" style="font-size: 12px; line-height: 15px;">
					<div>Departemen : <?= namadepartemen($dep) ?></div>
					<div class="ml-sm-3">Shift : <?= namashift($shi) ?></div>
				</div>
			</div>
			<div style="font-size: 12px; line-height: 15px; float: right; color: black;">
				<div>Hari, Tanggal : <?= bulanindo($tgl,1) ?></div>
				<div id="loading" class="hidden" style="text-align: right; color: red;"><i class="fa fa-spinner fa-spin mr-sm-1"></i> loading (Kirim data)</div>
			</div>
		</div>
		<input type="hidden" name="urlhitungkupon" id="urlhitungkupon" value="<?= base_url().'absen/hitungkupon' ?>">
		<input type="hidden" name="urlsimpankupon" id="urlsimpankupon" value="<?= base_url().'absen/simpankupon' ?>">
		<input type="hidden" name="tanggal" id="tanggal" value="<?= $tgl ?>">
		<input type="hidden" name="dept" id="dept" value="<?= $dep ?>">
		<input type="hidden" name="shif" id="shif" value="<?= $shi ?>">
		<hr class="pendek">
		<div class="row" style="clear: both;">
			<div class="col-sm-6">
				<div style="overflow: hidden; margin-bottom: 5px;">
					<h6 style="float: left;">Absensi Karyawan</h6>
					<a href="<?= base_url().'absen/tambahkryabsen/'.$dep ?>" data-remote="false" data-title="Karyawan Absen" data-target="#modalBox" data-toggle="modal" class="btn btn-sm btn-success huruf-kecil flat" style="float: right;" id="tambahkryabsen"><i class="fa fa-plus"></i> Tambah Absen</a>
					<a href="<?= base_url().'absen' ?>" class="btn btn-sm btn-danger huruf-kecil flat" style="float: right; margin-right: 3px;"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
				<a class="hidden" href="#" id="dataabsenx" data-toggle="modal" data-target="#modalBox" data-remote="false" data-title="Set Keterangan Absen">AA</a>
				<table class="table table-condensed table-bordered tabelku">
					<thead class="huruf-tengah">
						<th>No</th>
						<th>Nama Karyawan</th>
						<th>Jabatan</th>
						<th>Ket</th>
						<th>Aksi</th>
					</thead>
					<tbody id="data-tabelku">
						<?php if($listabsen->num_rows() > 0){ 
							$no=0; foreach($listabsen->result_array() as $list){ $no++;
							$lis = $list['isiabsen']=='' ? 'XX' : $list['isiabsen'];
						?>
							<tr>
								<td><?= $no ?></td>
								<td><?= '('.$list['noinduk'].') '.$list['nama'] ?></td>
								<td><?= $list['jabatan'] ?></td>
								<td style="text-align: center; width: 60px;" class="dataabsen text-red" rel="<?= base_url().'absen/ubahabsen/'.$list['id'].'/'.$lis.'/'.$dep.'/'.$shi ?>"><?php if($lis=='XX'){echo "";}else{ echo $lis; } ?></td>
								<td class="huruf-tengah">
									<a href="#" class="huruf-kecil" data-href="<?= base_url().'absen/hapusabsenkry/'.$list['id'].'/'.$dep.'/'.$shi ?>" data-target="#confirm-delete" data-remote="false" data-toggle="modal" title="Hapus data" id="hapusabsenkry" rel="<?= $list['id'] ?>" style="color: white; background-color: #C82333; padding: 2px 3px;">Hapus data</a>
								</td>
							</tr>
						<?php }}else{ $no=0; ?>
							<tr>
								<td colspan="5" style="text-align: center;font-style: italic;">Tidak ada Absen</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="col-sm-6">
				<div style="overflow: hidden;">
					<div style="float: left">
						<h6>Permintaan Kupon Makan</h6>
					</div>
					<div style="float: right; color: black; font-size: 13px;">
						<input type="checkbox" name="cekkupon" id="cekkupon" <?php if($kupon->hitung == 1){ echo "checked"; } ?>> Tambah kupon makan
					</div>
				</div>
				<hr class="small">
				<div class="form-inline">
					<div class="form-inline">
						<label class="justify-content-start">Jumlah Kry</label>
						<input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm tek-pendek flat" value="<?= $absen->jumlahkry ?>" autocomplete="off" readonly>
					</div>
					<div class="form-inline ml-sm-4">
						<label class="justify-content-start">Jumlah Abs</label>
						<input type="text" name="absen" id="absen" class="form-control form-control-sm tek-pendek flat" value="<?= $no ?>" autocomplete="off" readonly>
					</div>
				</div>
				<div class="form-inline">
					<label class="justify-content-start">Hadir</label>
					<div id="cont-modul">
						<div class="form-inline ml-sm-1">
							<label class="justify-content-start">Indoneptune</label>
							<input type="text" name="hadir" id="hadir" class="form-control form-control-sm tek-pendek flat" value="<?= $kupon->hadir ?>" autocomplete="off">
						</div>
						<div class="form-inline ml-sm-1">
							<label class="justify-content-start">Arroza</label>
							<input type="text" name="hadirar" id="hadirar" class="form-control form-control-sm tek-pendek flat" value="<?= $kupon->hadirar ?>" autocomplete="off">
						</div>
						<div class="form-inline ml-sm-1">
							<label class="justify-content-start">Nurinda</label>
							<input type="text" name="hadirnu" id="hadirnu" class="form-control form-control-sm tek-pendek flat" value="<?= $kupon->hadirnu ?>" autocomplete="off">
						</div>
					</div>
					<label class="justify-content-start ml-sm-4">Lembur</label>
					<div id="cont-modul">
						<div class="form-inline ml-sm-1">
							<label class="justify-content-start">Indoneptune</label>
							<input type="text" name="lembur" id="lembur" class="form-control form-control-sm tek-pendek flat" value="<?= $kupon->lembur ?>" autocomplete="off">
						</div>
						<div class="form-inline ml-sm-1">
							<label class="justify-content-start">Arroza</label>
							<input type="text" name="lemburar" id="lemburar" class="form-control form-control-sm tek-pendek flat" value="<?= $kupon->lemburar ?>"autocomplete="off">
						</div>
						<div class="form-inline ml-sm-1">
							<label class="justify-content-start">Nurinda</label>
							<input type="text" name="lemburnu" id="lemburnu" class="form-control form-control-sm tek-pendek flat" value="<?= $kupon->lemburnu ?>" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="form-inline">
					<label class="justify-content-start">Kembali</label>
					<input type="text" name="kmb" id="kmb" class="form-control form-control-sm tek-pendek flat" value="<?= $kupon->kmb ?>" autocomplete="off">
				</div>
				<div class="form-inline">
					<label class="justify-content-start">Keterangan</label>
					<textarea class="form-control form-control-sm flat" id="ket" name="ket" autocomplete="off" ><?= $kupon->ket ?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>