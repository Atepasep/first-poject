<div class="container huruf-kecil">
	<div class="form-inline" style="margin-bottom: 5px;">
		<select id="modecari" name="modecari" class="form-control form-control-sm huruf-kecil flat">
			<option value="nama">Nama</option>
			<option value="nik">No Induk</option>
		</select>
		<input type="text" class="form-control form-control-sm huruf-kecil flat ml-sm-2" name="carinama" id="carinama">
	</div>
	<input type="hidden" name="urle" id="urle" value="<?= base_url().'Absen/ambildatakry' ?>">
	<input type="hidden" name="urla" id="urla" value="<?= base_url().'Absen/simpanabsen' ?>">
	<input type="hidden" name="depe" id="depe" value="<?= $dep ?>">
	<div id="modalpilih">
		<table class="table table-condensed table-hover table-bordered tabelku">
			<thead class="huruf-tengah">
				<th>No induk</th>
				<th>Nama Karyawan</th>
				<th>Bagian</th>
				<th>Grup</th>
				<th>Pilih</th>
			</thead>
			<tbody id="data-tabelku">
				<?php foreach ($karyawan->result_array() as $kar) { ?>
					<tr>
						<td><?= $kar['noinduk'] ?></td>
						<td><?= $kar['nama'] ?></td>
						<td><?= $kar['bagian'] ?></td>
						<td><?= $kar['grup'] ?></td>
						<td class="huruf-tengah"><a href="#" class="btn btn-sm btn-warning flat huruf-kecil" rel="<?= $kar['id'] ?>" id="pilihkry">Pilih</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div style="margin: 5px; text-align: right;">
		<a href="#" class="btn btn-sm btn-danger flat huruf-kecil" id="keluartambahkry" data-dismiss="modal">Keluar</a>
	</div>
</div>