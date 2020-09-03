<div class="container-fluid">
	<div class="content">
		<div id="header-app">PENGGUNA<small class="ml-sm-1">administrasi user aplikasi</small></div>
		<hr class="pendek">
		<div class="row">
			<div class="col-sm-4">
				<table class="table table-condensed table-bordered tabelku">
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Bagian</th>
					</tr>
					<tbody id="data-tabelku">
						<?php $no=0; foreach ($penggunaall as $pengguna) { $no++; ?>
							<tr rel="<?= $pengguna['id'] ?>" class="<?php if($pgg==''){if($no==1){ echo 'aktif'; }}else{if($pengguna['id']==$this->session->userdata('pgg')){ echo 'aktif'; }} ?>">
								<td><?= $no ?></td>
								<td><?= $pengguna['nama'] ?></td>
								<td><?= $pengguna['departemen'] ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="col-sm-8">
				<input type="text" name="" id="simpanpg" class="hidden" value="<?= $formAction; ?>">
				<input type="text" name="" id="ubahpg" class="hidden" value="<?= $formAction2; ?>">
				<form name="formpengguna" id="formpengguna" action="<?= $formAction; ?>" method="POST" autocomplete="off">
					<input type="text" name="id" id="id" class="hidden">
					<div class="form-inline">
						<label class="justify-content-start">Nama</label>
						<input type="text" class="form-control form-control-sm tek-panjang ml-sm-4 flat" id="nama" name="nama" autocomplete="off">
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Bagian</label>
						<input type="text" class="form-control form-control-sm tek-panjang ml-sm-4 flat" id="bagian" name="bagian" autocomplete="off">
						<select id="bagianpil" name="bagianpil" class="form-control form-control-sm tek-panjang ml-sm-4 flat hidden">
							<option value="">--Pilih Bagian--</option>
							<?php foreach ($bagian as $bag) { ?>
								<option value="<?= $bag['dept_id'] ?>"><?= $bag['departemen'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Jabatan</label>
						<input type="text" class="form-control form-control-sm tek-panjang ml-sm-4 flat" id="jabatan" name="jabatan" autocomplete="off">
					</div>
					<div class="form-inline">
						<label class="justify-content-start">User aktif</label>
						<input type="checkbox" class="form-control form-control-sm tek-panjang ml-sm-4 flat" id="aktif" name="aktif" value="1">
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Nama User</label>
						<input type="text" class="form-control form-control-sm tek-panjang ml-sm-4 flat" id="username" name="username" autocomplete="off">
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Password</label>
						<input type="password" class="form-control form-control-sm tek-panjang ml-sm-4 flat" id="password" name="password" autocomplete="off">
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Menu</label>
						<div class="form-inline">
							<input type="checkbox" class="form-control form-control-sm tek-panjang mr-sm-1 ml-sm-4 flat" id="menu1" name="menu1" value="1">
							<label class="justify-content-start" style="width: 30px !important">User</label>
						</div>
						<div class="form-inline">
							<input type="checkbox" class="form-control form-control-sm tek-panjang mr-sm-1 ml-sm-4 flat" id="menu2" name="menu2" value="1">
							<label class="justify-content-start" style="width: 30px !important">Departemen</label>
						</div>
					</div>
					<div class="form-inline">
						<label class="justify-content-start">Set Modul</label>
						<div id="cont-modul" class="ml-sm-4">
							<div class="form-inline">
								<input type="checkbox" class="form-control form-control-sm tek-panjang ml-sm-4 flat" id="modul1" name="modul1" autocomplete="off">
								<label class="justify-content-center">Modul 1</label>
							</div>
						</div>
					</div>
				</form>
				<hr class="small">
				<a href="#" class="btn btn-sm btn-success flat huruf-kecil" id="addpengguna"><i class="fa fa-plus"></i> Tambah</a>
				<a href="#" class="btn btn-sm btn-info flat huruf-kecil" id="editpengguna"><i class="fa fa-pencil"></i> Edit</a>
				<a href="#" data-href="#" data-target="#confirm-delete" data-toggle="modal" data-remote="false" data-title="Hapus Pengguna" class="btn btn-sm btn-danger flat huruf-kecil" id="hapuspengguna"><i class="fa fa-times"></i> Hapus</a>
				<a href="#" class="btn btn-sm btn-primary flat huruf-kecil" id="cetakpengguna"><i class="fa fa-print"></i> Cetak</a>
				<a href="#" class="btn btn-sm btn-success flat huruf-kecil hidden" id="simpanpengguna"><i class="fa fa-check"></i> Simpan</a>
				<a href="#" class="btn btn-sm btn-success flat huruf-kecil hidden" id="updatepengguna"><i class="fa fa-check"></i> Update</a>
				<a href="#" class="btn btn-sm btn-info flat huruf-kecil hidden" id="batalpengguna"><i class="fa fa-arrow-left"></i> Batal</a>
			</div>
		</div>
	</div>
</div>