<div class="container-fluid">
	<div class="content">
		<div id="header-app">DEPARTEMEN<small class="ml-sm-1"> data departemen & Aplikasi Pendukung</small></div>
		<hr class="pendek">
		<div class="row">
			<div class="col-sm-4">
				<div id="isitabel" style="height: 420px !important; overflow: auto;">
				<table class="table table-condensed table-bordered tabelku">
					<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Bagian</th>
					</tr>
					</thead>
					<tbody id="data-tabelku">
						<?php $no=0; foreach ($departemenall as $departemen) { $no++; ?>
							<tr rel="<?= $departemen['dept_id'] ?>" class="<?php if($depx==''){if($no==1){ echo 'aktif'; }}else{if($departemen['dept_id']==$this->session->userdata('depx')){ echo 'aktif'; }} ?>">
								<td><?= $no ?></td>
								<td><?= $departemen['dept_id'] ?></td>
								<td><?= $departemen['departemen'] ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
			</div>
			<div class="col-sm-8">
				<div id="header-app">Daftar Aplikasi</div>
				<div style="height: 300px !important; overflow: auto;">
				<table class="table table-condensed table-bordered tabelku">
					<thead>
						<tr>
							<th>No</th>
							<th>Dept</th>
							<th>Nama Aplikasi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody id="data-tabelku2">
						<tr>
							<td colspan="4" style="text-align: center;">Belum ada Aplikasi</td>
						</tr>
					</tbody>
				</table>
				</div>
				<hr class="small">
				<a href="#" class="btn btn-sm btn-success flat huruf-kecil" id="adddepartemen" data-target="#modalBox" data-toggle="modal" data-remote="false" data-title="Tambah data" ><i class="fa fa-plus"></i> Tambah</a>
				<a href="#" class="btn btn-sm btn-primary flat huruf-kecil" id="cetakdepartemen"><i class="fa fa-print"></i> Cetak</a>
			</div>
		</div>
	</div>
</div>