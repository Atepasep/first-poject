<div class="container-fluid">
	<div class="content">
		<div id="header-app">
			Form Permintaan Uang<small> <?= $depart->departemen ?></small>
		</div>
		<hr class="pendek">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-inline" style="margin-bottom: 5px;">
					Periode :
					<select id="bulan" name="bulan" class="form-control form-control-sm huruf-kecil flat ml-sm-1">
						<?php for($x=1;$x<=12;$x++){  ?>
							<option value="<?= $x ?>" <?php if($this->session->userdata('bl')==$x){echo "selected"; } ?>><?= namabulan($x) ?></option>
						<?php } ?>
					</select>
					<select id="tahun" name="tahun" class="form-control form-control-sm huruf-kecil flat ml-sm-1">
						<?php for($x=date('Y')-2;$x<=date('Y');$x++){  ?>
							<option value="<?= $x ?>" <?php if($this->session->userdata('th')==$x){echo "selected"; } ?>><?= $x ?></option>
						<?php } ?>
					</select>
				</div>
				<div id="tabelmintauang">
					<table class="table table-condensed table-bordered tabelku">
						<thead class="huruf-tengah">
							<th style="width: 35px;">Tg</th>
							<th>Nama</th>
							<th>Info</th>
						</thead>
						<tbody id="data-tabelku">
							<?php if ($uang->num_rows() > 0) { ?>
							<?php $no=0; foreach ($uang->result_array() as $datauang) { $no++; $aktif = $no==1 ? 'aktif' : ''; ?>
								<tr rel="<?= $datauang['id'] ?>" class="<?= $aktif ?>">
									<td style="text-align: center;"><?= substr(tglmysql($datauang['tgl']),0,2)	 ?></td>
									<td><?= $datauang['pemohon'] ?></td>
									<td><?= infomintauang($datauang['cek']) ?></td>
								</tr>
							<?php } }else{ ?>
								<tr>
									<td colspan="3" style="text-align: center;">Tidak ada data</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-8">
				<a href="#" class="btn btn-sm btn-success flat huruf-kecil" id="addmintauang"><i class="fa fa-plus"></i> Tambah</a>
				<a href="#" class="btn btn-sm btn-info flat huruf-kecil" id="editmintauang"><i class="fa fa-pencil"></i> Edit</a>
				<a href="#" data-href="#" data-target="#confirm-delete" data-toggle="modal" data-remote="false" data-title="Hapus Data" class="btn btn-sm btn-danger flat huruf-kecil" id="hapusmintauang"><i class="fa fa-times"></i> Hapus</a>
				<a href="#" class="btn btn-sm btn-primary flat huruf-kecil" id="cetakmintauang"><i class="fa fa-print"></i> Cetak</a>
				<a href="#" class="btn btn-sm btn-success flat huruf-kecil hidden" id="simpanmintauang"><i class="fa fa-check"></i> Simpan</a>
				<a href="#" class="btn btn-sm btn-success flat huruf-kecil hidden" id="updatemintauang"><i class="fa fa-check"></i> Update</a>
				<a href="#" class="btn btn-sm btn-info flat huruf-kecil hidden" id="batalmintauang"><i class="fa fa-arrow-left"></i> Batal</a>
				<hr class="small">
				<input type="hidden" name="" id="simpanmu" class="text" value="<?= $formAction; ?>">
				<input type="hidden" name="" id="ubahmu" class="text" value="<?= $formAction2; ?>">
				<input type="hidden" name="waktu" id="waktu" value="<?= date('d-m-Y'); ?>">
				<form name="formmintauang" id="formmintauang" action="<?= $formAction ?>" method="POST" autocomplete="off">
					<div class="form-inline">
						<label class="justify-content-start">Tanggal</label>
						<input type="text" class="form-control form-control-sm tek-panjang huruf-kecil ml-sm-4 flat" id="tgl" name="tgl" readonly>
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Pemohon</label>
						<input type="text" class="form-control form-control-sm ml-sm-4 flat huruf-kecil normal" id="pemohon" name="pemohon">
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Rincian</label>
						<div class="ml-sm-4" style="padding: 5px; border: 1px solid #E9ECEF; width: 70% !important;">
							<div class="form-inline" style="width: 90% !important;">
								<label class="justify-content-start">Dinas Luar</label>
								<input type="text" class="form-control form-control-sm ml-sm-4 flat huruf-kecil inner-inline" id="dinas_luar" name="dinas_luar">
							</div>
							<div class="form-inline" style=" width: 90% !important;">
								<label class="justify-content-start">Belanja</label>
								<input type="text" class="form-control form-control-sm ml-sm-4 flat huruf-kecil inner-inline" id="belanja" name="belanja">
							</div>
							<div class="form-inline" style=" width: 90% !important;">
								<label class="justify-content-start">Uang Saku</label>
								<input type="text" class="form-control form-control-sm ml-sm-4 flat huruf-kecil inner-inline" id="uang_saku" name="uang_saku">
							</div>
							<div class="form-inline" style=" width: 90% !important;">
								<label class="justify-content-start">Donasi</label>
								<input type="text" class="form-control form-control-sm ml-sm-4 flat huruf-kecil inner-inline" id="donasi" name="donasi">
							</div>
							<div class="form-inline" style=" width: 90% !important;">
								<label class="justify-content-start">Lain-Lain</label>
								<input type="text" class="form-control form-control-sm ml-sm-4 flat huruf-kecil inner-inline" id="lain" name="lain">
							</div>
						</div>
					</div>
					<div class="form-inline">
						<label class="justify-content-start"><strong>Jml Uang</strong></label>
						<input type="text" class="form-control form-control-sm ml-sm-4 huruf-kecil flat" style="text-align: right;" id="jumlah_uang" name="jumlah_uang">
						<div class="ml-sm-1">(Jumlah uang yang diminta)</div>
					</div>
					<div class="form-inline">
						<label class="justify-content-start"><strong>Kembali*</strong></label>
						<input type="text" class="form-control form-control-sm ml-sm-4 huruf-kecil flat" id="kembali" name="kembali">
						<div class="ml-sm-1">(Diisi jika permintaan uang berupa kasbon)</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>